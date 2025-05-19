<?php
session_start();

// Kiểm tra xem người dùng có phải là admin không
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /cutonama3/auth/login.php");
    exit();
}

require_once '../includes/db.php';

// Log access
$ip_address = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$page_url = $_SERVER['REQUEST_URI'];

$stmt_log = $pdo->prepare("INSERT INTO access_logs (ip_address, user_agent, page_url) VALUES (?, ?, ?)");
$stmt_log->execute([$ip_address, $user_agent, $page_url]);

// Kiểm tra và xử lý tìm kiếm và lọc
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$filterType = isset($_GET['filter']) ? $_GET['filter'] : 'all'; // Default to show all

// Số lượng tin tức hiển thị trên mỗi trang
$itemsPerPage = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $itemsPerPage;

// Hàm để lấy tổng số tin tức dựa trên bộ lọc và tìm kiếm
function getTotalNews($pdo, $filterType, $searchQuery) {
    $conditions = [];
    $params = [];
    if ($filterType !== 'all') {
        $conditions[] = "type = ?";
        $params[] = $filterType;
    }
    if (!empty($searchQuery)) {
        $conditions[] = "(title LIKE ? OR summary LIKE ?)";
        $params[] = '%' . $searchQuery . '%';
        $params[] = '%' . $searchQuery . '%';
    }
    $whereClause = !empty($conditions) ? 'WHERE ' . implode(' AND ', $conditions) : '';

    $sql = "SELECT COUNT(*) FROM (
                    SELECT 'general' as type, news_id as id, title, summary FROM news
                    UNION ALL
                    SELECT 'football' as type, football_news_id as id, title, summary FROM football_news
                    UNION ALL
                    SELECT 'game' as type, game_news_id as id, title, summary FROM game_news
                    UNION ALL
                    SELECT 'celebrity' as type, celebrity_news_id as id, title, summary FROM celebrity_news
                ) AS combined_news {$whereClause}";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchColumn();
}

$totalNews = getTotalNews($pdo, $filterType, $searchQuery);
$totalPages = ceil($totalNews / $itemsPerPage);

// Lấy danh sách tin tức từ các bảng khác nhau dựa trên bộ lọc và tìm kiếm có phân trang
$allNews = [];

$sql = "SELECT type, id, title, summary, is_published, created_at, image
        FROM (
            SELECT 'general' as type, news_id as id, title, summary, is_published, created_at, image FROM news
            UNION ALL
            SELECT 'football' as type, football_news_id as id, title, summary, is_published, created_at, image FROM football_news
            UNION ALL
            SELECT 'game' as type, game_news_id as id, title, summary, is_published, created_at, image FROM game_news
            UNION ALL
            SELECT 'celebrity' as type, celebrity_news_id as id, title, summary, is_published, created_at, image FROM celebrity_news
        ) AS combined_news
        WHERE (:filterType = 'all' OR type = :filterType)
        AND (combined_news.title LIKE :searchQuery OR combined_news.summary LIKE :searchQuery)
        ORDER BY created_at DESC
        LIMIT :limit OFFSET :offset";

$stmt_all = $pdo->prepare($sql);
$stmt_all->bindValue(':filterType', $filterType);
$stmt_all->bindValue(':searchQuery', '%' . $searchQuery . '%');
$stmt_all->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
$stmt_all->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt_all->execute();
$allNews = $stmt_all->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - News Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1rem;
        }
        .news-card {
            background-white shadow-md rounded-md overflow-hidden;
        }
        .news-card img {
            width: 100%;
            height: auto;
            object-fit: cover;
            max-height: 150px;
        }
        .news-card-content {
            padding: 1rem;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <?php include_once '../navbar/header_admin.php' ?>
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Admin Panel - News Management</h1>

        <div class="flex justify-between items-center mb-4">
            <a href="/cutonama3/admin/logout.php" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Logout</a>
        </div>

        <form action="" method="GET" class="mb-4 flex items-center">
            <input type="text" name="search" value="<?php echo htmlspecialchars($searchQuery); ?>" placeholder="Search all news..." class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2 focus:outline-none focus:shadow-outline">Search</button>
        </form>

        <div class="mb-4 flex flex-wrap gap-2 items-center justify-between">
            <div>
                <a href="/cutonama3/admin/create.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add General</a>
                <a href="/cutonama3/admin/create_football.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Football</a>
                <a href="/cutonama3/admin/create_game.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Game</a>
                <a href="/cutonama3/admin/create_celebrity.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Celebrity</a>
            </div>
            <div>
                <select name="filter" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" aria-label="Filter news" onchange="this.form.submit()">
                    <option value="all" <?php if ($filterType === 'all') echo 'selected'; ?>>All News</option>
                    <option value="general" <?php if ($filterType === 'general') echo 'selected'; ?>>General News</option>
                    <option value="football" <?php if ($filterType === 'football') echo 'selected'; ?>>Football News</option>
                    <option value="game" <?php if ($filterType === 'game') echo 'selected'; ?>>Game News</option>
                    <option value="celebrity" <?php if ($filterType === 'celebrity') echo 'selected'; ?>>Celebrity News</option>
                </select>
            </div>
        </div>

        <h2 class="text-xl font-semibold text-gray-700 mb-2">News List</h2>
        <?php if (empty($allNews)): ?>
            <p class="text-gray-500">No news found.</p>
        <?php else: ?>
            <div class="news-grid">
                <?php foreach ($allNews as $news): ?>
                    <div class="news-card">
                        <?php if ($news['image']): ?>
                            <img src="<?php echo htmlspecialchars($news['image']); ?>" alt="<?php echo htmlspecialchars($news['title']); ?>">
                        <?php else: ?>
                            <div class="bg-gray-200 h-32 flex items-center justify-center text-gray-500">No Image</div>
                        <?php endif; ?>
                        <div class="news-card-content">
                            <h3 class="font-semibold text-gray-800 mb-1"><?php echo htmlspecialchars($news['title']); ?></h3>
                            <p class="text-gray-600 text-sm mb-2"><?php echo htmlspecialchars(substr($news['summary'], 0, 80)) . '...'; ?></p>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>Type: <span class="font-medium"><?php echo ucfirst($news['type']); ?></span></span>
                                <span>Published: <?php echo $news['is_published'] ? '<span class="text-green-600 font-medium">Yes</span>' : '<span class="text-red-600 font-medium">No</span>'; ?></span>
                                <span>Date: <?php echo date('Y-m-d', strtotime($news['created_at'])); ?></span>
                            </div>
                            <div class="mt-2">
                                <?php
                                $editUrl = '';
                                $deleteUrl = '';
                                $idKey = '';
                                switch ($news['type']) {
                                    case 'general':
                                        $editUrl = '/cutonama3/admin/edit.php?id=';
                                        $deleteUrl = '/cutonama3/admin/delete.php?id=';
                                        $idKey = 'news_id';
                                        break;
                                    case 'football':
                                        $editUrl = '/cutonama3/admin/edit_football.php?id=';
                                        $deleteUrl = '/cutonama3/admin/delete_football.php?id=';
                                        $idKey = 'id';
                                        break;
                                    case 'game':
                                        $editUrl = '/cutonama3/admin/edit_game.php?id=';
                                        $deleteUrl = '/cutonama3/admin/delete_game.php?id=';
                                        $idKey = 'id';
                                        break;
                                    case 'celebrity':
                                        $editUrl = '/cutonama3/admin/edit_celebrity.php?id=';
                                        $deleteUrl = '/cutonama3/admin/delete_celebrity.php?id=';
                                        $idKey = 'id';
                                        break;
                                }
                                ?>
                                <a href="<?php echo $editUrl . $news[$idKey]; ?>" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs mr-1">Edit</a>
                                <a href="<?php echo $deleteUrl . $news[$idKey]; ?>" class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs" onclick="return confirm('Are you sure you want to delete this news?')">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ($totalPages > 1): ?>
                <div class="mt-6 flex justify-center">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?php echo $i; ?><?php if (!empty($searchQuery)) echo '&search=' . htmlspecialchars($searchQuery); ?><?php if ($filterType !== 'all') echo '&filter=' . $filterType; ?>"
                           class="px-3 py-2 <?php echo $page == $i ? 'bg-blue-500 text-white' : 'bg-white text-gray-700 hover:bg-gray-200'; ?> border rounded mr-1">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>

        <?php endif; ?>
    </div>
</body>
</html>
