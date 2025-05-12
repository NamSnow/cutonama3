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

// Lấy danh sách tin tức từ các bảng khác nhau dựa trên bộ lọc
$generalNews = [];
$footballNews = [];
$gameNews = [];
$celebrityNews = [];

if ($filterType === 'all' || $filterType === 'general') {
    $stmt_news = $pdo->prepare("SELECT 'general' as type, news_id, title, summary, is_published, created_at, image FROM news WHERE (title LIKE ? OR summary LIKE ?) ORDER BY created_at DESC");
    $stmt_news->execute(['%' . $searchQuery . '%', '%' . $searchQuery . '%']);
    $generalNews = $stmt_news->fetchAll(PDO::FETCH_ASSOC);
}

if ($filterType === 'all' || $filterType === 'football') {
    $stmt_football = $pdo->prepare("SELECT 'football' as type, football_news_id as id, title, summary, is_published, created_at, image FROM football_news WHERE (title LIKE ? OR summary LIKE ?) ORDER BY created_at DESC");
    $stmt_football->execute(['%' . $searchQuery . '%', '%' . $searchQuery . '%']);
    $footballNews = $stmt_football->fetchAll(PDO::FETCH_ASSOC);
}

if ($filterType === 'all' || $filterType === 'game') {
    $stmt_game = $pdo->prepare("SELECT 'game' as type, game_news_id as id, title, summary, is_published, created_at, image FROM game_news WHERE (title LIKE ? OR summary LIKE ?) ORDER BY created_at DESC");
    $stmt_game->execute(['%' . $searchQuery . '%', '%' . $searchQuery . '%']);
    $gameNews = $stmt_game->fetchAll(PDO::FETCH_ASSOC);
}

if ($filterType === 'all' || $filterType === 'celebrity') {
    $stmt_celebrity = $pdo->prepare("SELECT 'celebrity' as type, celebrity_news_id as id, title, summary, is_published, created_at, image FROM celebrity_news WHERE (title LIKE ? OR summary LIKE ?) ORDER BY created_at DESC");
    $stmt_celebrity->execute(['%' . $searchQuery . '%', '%' . $searchQuery . '%']);
    $celebrityNews = $stmt_celebrity->fetchAll(PDO::FETCH_ASSOC);
}

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
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Admin Panel - News Management</h1>

        <div class="flex justify-between items-center mb-4">
            <a href="/cutonama3/admin/logout.php" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Logout</a>
        </div>

        <form action="" method="GET" class="mb-4 flex items-center">
            <input type="text" name="search" value="<?php echo htmlspecialchars($searchQuery); ?>" placeholder="Search all news..." class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2 focus:outline-none focus:shadow-outline">Search</button>
        </form>

        <h2 class="text-xl font-semibold text-gray-700 mb-2">Manage News</h2>
        <div class="mb-4 flex flex-wrap gap-2">
            <a href="/cutonama3/admin/create.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add General</a>
            <a href="/cutonama3/admin/create_football.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Football</a>
            <a href="/cutonama3/admin/create_game.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Game</a>
            <a href="/cutonama3/admin/create_celebrity.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Celebrity</a>
        </div>

        <div class="mb-4">
            <select name="filter" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" aria-label="Filter news" onchange="this.form.submit()">
                <option value="all" <?php if ($filterType === 'all') echo 'selected'; ?>>All News</option>
                <option value="general" <?php if ($filterType === 'general') echo 'selected'; ?>>General News</option>
                <option value="football" <?php if ($filterType === 'football') echo 'selected'; ?>>Football News</option>
                <option value="game" <?php if ($filterType === 'game') echo 'selected'; ?>>Game News</option>
                <option value="celebrity" <?php if ($filterType === 'celebrity') echo 'selected'; ?>>Celebrity News</option>
            </select>
        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded-md">
            <table class="min-w-full leading-normal">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Title</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Summary</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Published</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Created At</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Image</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($allNews)): ?>
                        <tr><td colspan="7" class="px-5 py-5 border-b border-gray-200 text-sm text-gray-500 text-center">No news found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($allNews as $news): ?>
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm"><?php echo ucfirst($news['type']); ?></td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm"><?php echo htmlspecialchars($news['title']); ?></td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm"><?php echo htmlspecialchars(substr($news['summary'], 0, 100)) . '...'; ?></td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <?php echo $news['is_published'] ? '<span class="inline-block bg-green-200 text-green-800 py-1 px-2 rounded-full text-xs font-semibold">Published</span>' : '<span class="inline-block bg-red-200 text-red-800 py-1 px-2 rounded-full text-xs font-semibold">Unpublished</span>'; ?>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm"><?php echo $news['created_at']; ?></td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <?php if ($news['image']): ?>
                                        <img src="<?php echo htmlspecialchars($news['image']); ?>" alt="Image" class="w-16 h-16 object-cover rounded">
                                    <?php else: ?>
                                        No image
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
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
                                    <a href="<?php echo $editUrl . $news[$idKey]; ?>" class="text-blue-500 hover:text-blue-700">Edit</a>
                                    <span class="text-gray-300">|</span>
                                    <a href="<?php echo $deleteUrl . $news[$idKey]; ?>" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this news?')">Delete</a>
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