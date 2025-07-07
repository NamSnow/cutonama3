<?php
session_start();

// Check if the user is an admin; if not, redirect to login.
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /cutonama3/auth/login.php");
    exit();
}

require_once '../includes/db.php';

// Log access for administrative monitoring.
$ip_address = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$page_url = $_SERVER['REQUEST_URI'];

$stmt_log = $pdo->prepare("INSERT INTO access_logs (ip_address, user_agent, page_url) VALUES (?, ?, ?)");
$stmt_log->execute([$ip_address, $user_agent, $page_url]);

// Handle search and filter parameters from GET request.
// These variables must be defined before including header_admin.php
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';
$filterType = isset($_GET['filter']) ? trim($_GET['filter']) : 'all'; // Default to show all news.

// Pagination settings.
$itemsPerPage = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $itemsPerPage;

/**
 * Calculates the total number of news articles based on filter and search queries.
 * @param PDO $pdo The PDO database connection object.
 * @param string $filterType The type of news to filter by ('all', 'general', 'football', etc.).
 * @param string $searchQuery The search string for titles or summaries.
 * @return int The total count of news articles.
 */
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

    // SQL query to count combined news types.
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

$allNews = [];

// Base query for combined news, prepared to handle all filtering and pagination.
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
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Quản lý Tin tức</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5; /* Lighter background */
        }
        /* Custom styles for news card images to ensure consistent height */
        .news-card-image {
            width: 100%;
            height: 180px; /* Increased height for better visual impact */
            object-fit: cover;
            border-top-left-radius: 0.5rem; /* rounded-t-lg */
            border-top-right-radius: 0.5rem; /* rounded-t-lg */
        }
        .no-image-placeholder {
            height: 180px; /* Match image height */
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e0e0e0;
            color: #757575;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
            font-size: 1rem;
            text-align: center;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <?php include_once '../navbar/header_admin.php' ?>

    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Quản lý Tin tức</h1>

        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                <a href="/cutonama3/admin/logout.php" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-75">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-2 0V4H5v12h7a1 1 0 010 2H4a1 1 0 01-1-1V3zm10 0a1 1 0 01.707.293l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L14.586 8H9a1 1 0 010-2h5.586L12.293 3.707A1 1 0 0113 3z" clip-rule="evenodd"></path></svg>
                    Đăng xuất
                </a>
                
                </div>

            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                    <span class="font-semibold text-gray-700 hidden sm:block">Tạo tin tức mới:</span>
                    <a href="/cutonama3/admin/create.php" class="flex-shrink-0 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-75">
                        <svg class="w-4 h-4 inline-block mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Trang chính
                    </a>
                    <a href="/cutonama3/admin/create_football.php" class="flex-shrink-0 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-75">
                        <svg class="w-4 h-4 inline-block mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Bóng đá
                    </a>
                    <a href="/cutonama3/admin/create_game.php" class="flex-shrink-0 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-75">
                        <svg class="w-4 h-4 inline-block mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Game
                    </a>
                    <a href="/cutonama3/admin/create_celebrity.php" class="flex-shrink-0 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-75">
                        <svg class="w-4 h-4 inline-block mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Người nổi tiếng
                    </a>
                </div>
                
                <form action="" method="GET" class="w-full md:w-auto flex items-center justify-end">
                    <span class="mr-2 text-gray-700 font-semibold hidden sm:block">Lọc theo loại:</span>
                    <input type="hidden" name="search" value="<?php echo htmlspecialchars($searchQuery); ?>">
                    <select name="filter" onchange="this.form.submit()" class="shadow-sm appearance-none border border-gray-300 rounded-lg py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                        <option value="all" <?php if ($filterType === 'all') echo 'selected'; ?>>Tất cả Tin tức</option>
                        <option value="general" <?php if ($filterType === 'general') echo 'selected'; ?>>Tin tức chung</option>
                        <option value="football" <?php if ($filterType === 'football') echo 'selected'; ?>>Tin tức bóng đá</option>
                        <option value="game" <?php if ($filterType === 'game') echo 'selected'; ?>>Tin tức Game</option>
                        <option value="celebrity" <?php if ($filterType === 'celebrity') echo 'selected'; ?>>Tin tức người nổi tiếng</option>
                    </select>
                </form>
            </div>
        </div>

        <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b-2 border-gray-200 pb-2">Danh sách Tin tức</h2>
        <?php if (empty($allNews)): ?>
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded" role="alert">
                <p class="font-bold">Không tìm thấy tin tức nào!</p>
                <p>Vui lòng thử điều chỉnh bộ lọc hoặc tìm kiếm.</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php foreach ($allNews as $news): ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-xl">
                        <?php if (!empty($news['image'])): ?>
                            <img src="<?php echo htmlspecialchars($news['image']); ?>" alt="<?php echo htmlspecialchars($news['title']); ?>" class="news-card-image">
                        <?php else: ?>
                            <div class="no-image-placeholder">Không có hình ảnh</div>
                        <?php endif; ?>
                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-800 mb-2 truncate"><?php echo htmlspecialchars($news['title']); ?></h3>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-3"><?php echo htmlspecialchars($news['summary']); ?></p>
                            
                            <div class="text-xs text-gray-500 mb-3 space-y-1">
                                <p><strong>Loại:</strong> <span class="font-semibold text-gray-700"><?php echo ucfirst($news['type']); ?></span></p>
                                <p><strong>Đăng:</strong> 
                                    <?php if ($news['is_published']): ?>
                                        <span class="text-green-600 font-semibold">Có</span>
                                    <?php else: ?>
                                        <span class="text-red-600 font-semibold">Không</span>
                                    <?php endif; ?>
                                </p>
                                <p><strong>Ngày:</strong> <?php echo date('d/m/Y', strtotime($news['created_at'])); ?></p>
                            </div>
                            
                            <div class="mt-4 flex flex-wrap gap-2">
                                <?php
                                // Determine the correct edit and delete URLs based on news type.
                                $editUrl = '';
                                $deleteUrl = '';
                                switch ($news['type']) {
                                    case 'general':
                                        $editUrl = '/cutonama3/admin/edit.php?id=';
                                        $deleteUrl = '/cutonama3/admin/delete.php?id=';
                                        break;
                                    case 'football':
                                        $editUrl = '/cutonama3/admin/edit_football.php?id=';
                                        $deleteUrl = '/cutonama3/admin/delete_football.php?id=';
                                        break;
                                    case 'game':
                                        $editUrl = '/cutonama3/admin/edit_game.php?id=';
                                        $deleteUrl = '/cutonama3/admin/delete_game.php?id=';
                                        break;
                                    case 'celebrity':
                                        $editUrl = '/cutonama3/admin/edit_celebrity.php?id=';
                                        $deleteUrl = '/cutonama3/admin/delete_celebrity.php?id=';
                                        break;
                                }
                                ?>
                                <a href="<?php echo $editUrl . $news['id']; ?>" class="inline-flex items-center px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-7.793 7.793-2.586-.586.586-2.586L13.586 3.586zM15 6L13 4 5 12l-.5.5L4 14l1.5-1.5.5-.5L15 6z"></path><path fill-rule="evenodd" d="M10 2a1 1 0 00-1 1v1h2V3a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                    Sửa
                                </a>
                                <a href="<?php echo $deleteUrl . $news['id']; ?>" class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75" onclick="return confirm('Bạn có chắc chắn muốn xóa tin tức này không?');">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zm-1 9a1 1 0 100 2h2a1 1 0 100-2H8z" clip-rule="evenodd"></path></svg>
                                    Xóa
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ($totalPages > 1): ?>
                <div class="mt-8 flex justify-center space-x-2">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?php echo $i; ?><?php if (!empty($searchQuery)) echo '&search=' . urlencode($searchQuery); ?><?php if ($filterType !== 'all') echo '&filter=' . urlencode($filterType); ?>"
                           class="px-4 py-2 rounded-lg font-semibold transition duration-300
                           <?php echo $page == $i ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'; ?>
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>

        <?php endif; ?>
    </div>
</body>
</html>