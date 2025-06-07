<?php
session_start();

// Check if the user is an admin; if not, redirect to login.
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /cutonama3/auth/login.php");
    exit();
}

require_once '../includes/db.php';

// Initialize $news to prevent errors if ID is not set or news not found.
$news = null;

// Handle GET request to fetch news for editing.
if (isset($_GET['id'])) {
    $news_id = $_GET['id'];

    // Retrieve the news article from the database using a prepared statement.
    $stmt = $pdo->prepare("SELECT * FROM news WHERE news_id = ?");
    $stmt->execute([$news_id]);
    $news = $stmt->fetch(PDO::FETCH_ASSOC);

    // If news not found, display an error and exit.
    if (!$news) {
        echo "<p class='text-red-600 text-center font-bold'>Tin tức không tìm thấy!</p>";
        exit();
    }
}

// Handle POST request to save edited news information.
if (isset($_POST['submit']) && $news) { // Ensure $news is loaded before processing POST.
    $title = trim($_POST['title']);
    $summary = trim($_POST['summary']);
    $content = trim($_POST['content']);
    $is_published = isset($_POST['is_published']) ? 1 : 0;
    
    // Store the existing image filename. This will be updated if a new image is uploaded.
    $imageFileNameInDB = $news['image'];

    // Check if a new image file has been uploaded.
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/image/'; // Define the upload directory with a trailing slash.
        
        // Generate a unique filename to prevent overwrites and security issues.
        $newImageFileName = uniqid() . '-' . basename($_FILES['image']['name']);
        $uploadedFilePath = $uploadDir . $newImageFileName;

        // Attempt to move the uploaded file.
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadedFilePath)) {
            // Update the image filename to be stored in the database.
            $imageFileNameInDB = $newImageFileName;

            // Optional: Delete old image if it exists and is different from the new one.
            if (!empty($news['image']) && $news['image'] !== $newImageFileName) {
                $oldImagePath = $uploadDir . $news['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Delete the old image file.
                }
            }
        } else {
            // Handle file upload failure.
            echo "<p class='text-red-600 text-center font-bold'>Tải lên ảnh thất bại.</p>";
            // You might want to log this error and/or redirect with a specific error message.
            exit();
        }
    }

    // Update the news article in the database using a prepared statement.
    $stmt = $pdo->prepare("UPDATE news SET title = ?, summary = ?, content = ?, is_published = ?, image = ? WHERE news_id = ?");
    $stmt->execute([$title, $summary, $content, $is_published, $imageFileNameInDB, $news['news_id']]);

    // Redirect back to the news management page after successful update.
    header("Location: /cutonama3/admin/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Sửa Tin tức</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl w-full">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Sửa Tin tức</h1>

        <?php if ($news): ?>
            <form action="edit.php?id=<?php echo htmlspecialchars($news['news_id']); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                <input type="hidden" name="news_id" value="<?php echo htmlspecialchars($news['news_id']); ?>">

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề:</label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        value="<?php echo htmlspecialchars($news['title']); ?>" 
                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                        required
                    >
                </div>

                <div>
                    <label for="summary" class="block text-sm font-medium text-gray-700 mb-1">Tóm tắt:</label>
                    <textarea 
                        name="summary" 
                        id="summary" 
                        rows="3" 
                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                        required
                    ><?php echo htmlspecialchars($news['summary']); ?></textarea>
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Nội dung:</label>
                    <textarea 
                        name="content" 
                        id="content" 
                        rows="8" 
                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                        required
                    ><?php echo htmlspecialchars($news['content']); ?></textarea>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Ảnh (để trống nếu không muốn thay đổi):</label>
                    <input 
                        type="file" 
                        name="image" 
                        id="image" 
                        accept="image/*" 
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                    >
                    <?php if (!empty($news['image'])): ?>
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-700">Ảnh hiện tại:</p>
                            <img src="/cutonama3/assets/image/<?php echo htmlspecialchars($news['image']); ?>" alt="Current Image" class="w-32 h-auto rounded-md mt-2 shadow">
                        </div>
                    <?php endif; ?>
                </div>

                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        name="is_published" 
                        id="is_published" 
                        <?php echo $news['is_published'] ? 'checked' : ''; ?>
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                    >
                    <label for="is_published" class="ml-2 block text-sm text-gray-900">
                        Xuất bản tin tức
                    </label>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="/cutonama3/admin/index.php" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Hủy
                    </a>
                    <button 
                        type="submit" 
                        name="submit" 
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        Lưu Thay đổi
                    </button>
                </div>
            </form>
        <?php else: ?>
            <p class="text-red-600 text-center font-bold">Không thể tải tin tức để chỉnh sửa. Vui lòng kiểm tra ID.</p>
        <?php endif; ?>
    </div>
</body>
</html>