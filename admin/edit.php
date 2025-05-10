<?php
session_start();

// Kiểm tra xem người dùng có phải là admin không
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /cutonama3/auth/login.php");
    exit();
}

require_once '../includes/db.php'; 

// Xử lý khi người dùng yêu cầu sửa tin tức
if (isset($_GET['id'])) {
    $news_id = $_GET['id'];

    // Lấy bài viết từ cơ sở dữ liệu
    $stmt = $pdo->prepare("SELECT * FROM news WHERE news_id = ?");
    $stmt->execute([$news_id]);
    $news = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$news) {
        echo "News not found!";
        exit();
    }
}

// Xử lý lưu thông tin đã sửa
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];
    $is_published = isset($_POST['is_published']) ? 1 : 0;
    $image = $news['image']; // Default image path if no new image is uploaded

    // Kiểm tra nếu có ảnh mới được tải lên
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        // Định nghĩa đường dẫn lưu ảnh
        $imageDir = '../assets/image';
        $imageFileName = uniqid() . '-' . basename($_FILES['image']['name']);
        $imagePath = $imageDir . $imageFileName;

        // Di chuyển file ảnh vào thư mục uploads
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            // Cập nhật đường dẫn ảnh vào biến $image
            $image = $imagePath;
        } else {
            echo "Failed to upload image.";
            exit();
        }
    }

    // Cập nhật tin tức vào cơ sở dữ liệu
    $stmt = $pdo->prepare("UPDATE news SET title = ?, summary = ?, content = ?, is_published = ?, image = ? WHERE news_id = ?");
    $stmt->execute([$title, $summary, $content, $is_published, $image, $news_id]);

    header("Location: /cutonama3/admin/index.php"); // Chuyển hướng về trang quản lý tin tức
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit News</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="min-h-screen bg-gray-100">
        <div class="max-w-7xl mx-auto p-4">
            <h1 class="text-3xl font-semibold text-gray-800">Edit News</h1>

            <form action="edit.php?id=<?php echo $news['news_id']; ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="news_id" value="<?php echo $news['news_id']; ?>">

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($news['title']); ?>" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                </div>

                <div class="mb-4">
                    <label for="summary" class="block text-sm font-medium text-gray-700">Summary</label>
                    <textarea name="summary" id="summary" class="mt-1 p-2 w-full border border-gray-300 rounded" required><?php echo htmlspecialchars($news['summary']); ?></textarea>
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea name="content" id="content" class="mt-1 p-2 w-full border border-gray-300 rounded" required><?php echo htmlspecialchars($news['content']); ?></textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" name="image" id="image" class="mt-1 p-2 w-full border border-gray-300 rounded">
                    <?php if ($news['image']): ?>
                        <div class="mt-2">
                            <p>Current Image:</p>
                            <img src="<?php echo htmlspecialchars($news['image']); ?>" alt="Current Image" class="w-32 h-auto">
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-4">
                    <label for="is_published" class="inline-flex items-center">
                        <input type="checkbox" name="is_published" id="is_published" <?php echo $news['is_published'] ? 'checked' : ''; ?>>
                        <span class="ml-2">Publish</span>
                    </label>
                </div>

                <button type="submit" name="submit" class="bg-blue-500 text-white p-2 rounded">Save Changes</button>
            </form>
        </div>
    </div>
</body>
</html>
