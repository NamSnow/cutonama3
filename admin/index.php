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

// Kiểm tra và xử lý tìm kiếm
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Lấy danh sách tin tức từ các bảng khác nhau
$stmt_news = $pdo->prepare("SELECT 'general' as type, news_id, title, summary, is_published, created_at, image FROM news WHERE title LIKE ? OR summary LIKE ? ORDER BY created_at DESC");
$stmt_news->execute(['%' . $searchQuery . '%', '%' . $searchQuery . '%']);
$generalNews = $stmt_news->fetchAll(PDO::FETCH_ASSOC);

$stmt_football = $pdo->prepare("SELECT 'football' as type, football_news_id as id, title, summary, is_published, created_at, image FROM football_news WHERE title LIKE ? OR summary LIKE ? ORDER BY created_at DESC");
$stmt_football->execute(['%' . $searchQuery . '%', '%' . $searchQuery . '%']);
$footballNews = $stmt_football->fetchAll(PDO::FETCH_ASSOC);

$stmt_game = $pdo->prepare("SELECT 'game' as type, game_news_id as id, title, summary, is_published, created_at, image FROM game_news WHERE title LIKE ? OR summary LIKE ? ORDER BY created_at DESC");
$stmt_game->execute(['%' . $searchQuery . '%', '%' . $searchQuery . '%']);
$gameNews = $stmt_game->fetchAll(PDO::FETCH_ASSOC);

$stmt_celebrity = $pdo->prepare("SELECT 'celebrity' as type, celebrity_news_id as id, title, summary, is_published, created_at, image FROM celebrity_news WHERE title LIKE ? OR summary LIKE ? ORDER BY created_at DESC");
$stmt_celebrity->execute(['%' . $searchQuery . '%', '%' . $searchQuery . '%']);
$celebrityNews = $stmt_celebrity->fetchAll(PDO::FETCH_ASSOC);

// Gộp tất cả các loại tin tức và sắp xếp theo thời gian tạo
$allNews = array_merge($generalNews, $footballNews, $gameNews, $celebrityNews);
usort($allNews, function ($a, $b) {
    return strtotime($b['created_at']) - strtotime($a['created_at']);
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - News Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-gray-100">
    <div class="max-w-7xl mx-auto p-4">
        <h1 class="text-3xl font-semibold text-gray-800 mb-4">Admin Panel - News Management</h1>

        <a href="/cutonama3/admin/logout.php" class="bg-red-500 text-white p-2 rounded mt-4 inline-block hover:bg-red-700">Logout</a>

        <form action="" method="GET" class="mb-4 flex items-center mt-4">
            <input type="text" name="search" value="<?php echo htmlspecialchars($searchQuery); ?>" placeholder="Search all news..." class="p-2 border border-gray-300 rounded flex-grow" />
            <button type="submit" class="bg-blue-500 text-white p-2 rounded ml-2 hover:bg-blue-700">Search</button>
        </form>

        <h2 class="text-xl font-semibold text-gray-700 mb-2">Manage News</h2>
        <a href="/cutonama3/admin/create.php" class="bg-green-500 text-white p-2 rounded mt-2 inline-block hover:bg-green-700">Add New General News</a>
        <a href="/cutonama3/admin/create_football.php" class="bg-green-500 text-white p-2 rounded mt-2 ml-2 inline-block hover:bg-green-700">Add New Football News</a>
        <a href="/cutonama3/admin/create_game.php" class="bg-green-500 text-white p-2 rounded mt-2 ml-2 inline-block hover:bg-green-700">Add New Game News</a>
        <a href="/cutonama3/admin/create_celebrity.php" class="bg-green-500 text-white p-2 rounded mt-2 ml-2 inline-block hover:bg-green-700">Add New Celebrity News</a>

        <div class="overflow-x-auto mt-6">
            <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-md">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-700">Type</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-700">Title</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-700">Summary</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-700">Published</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-700">Created At</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-700">Image</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($allNews)): ?>
                        <tr><td colspan="7" class="py-4 px-4 text-center text-gray-500">No news found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($allNews as $news): ?>
                            <tr>
                                <td class="py-2 px-4 border-b text-sm text-gray-800"><?php echo ucfirst($news['type']); ?></td>
                                <td class="py-2 px-4 border-b text-sm text-gray-800"><?php echo htmlspecialchars($news['title']); ?></td>
                                <td class="py-2 px-4 border-b text-sm text-gray-800"><?php echo htmlspecialchars(substr($news['summary'], 0, 100)) . '...'; ?></td>
                                <td class="py-2 px-4 border-b text-sm text-gray-800">
                                    <?php echo $news['is_published'] ? '<span class="text-green-500">Published</span>' : '<span class="text-red-500">Unpublished</span>'; ?>
                                </td>
                                <td class="py-2 px-4 border-b text-sm text-gray-800"><?php echo $news['created_at']; ?></td>
                                <td class="py-2 px-4 border-b text-sm text-gray-800">
                                    <?php if ($news['image']): ?>
                                        <img src="<?php echo htmlspecialchars($news['image']); ?>" alt="Image" class="w-16 h-16 object-cover rounded">
                                    <?php else: ?>
                                        No image
                                    <?php endif; ?>
                                </td>
                                <td class="py-2 px-4 border-b text-sm text-gray-800">
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
                                    <a href="<?php echo $editUrl . $news[$idKey]; ?>" class="text-blue-500 hover:underline">Edit</a> |
                                    <a href="<?php echo $deleteUrl . $news[$idKey]; ?>" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this news?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>