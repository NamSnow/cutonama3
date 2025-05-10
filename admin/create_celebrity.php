<?php
session_start();

// Kiểm tra xem người dùng có phải là admin không
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /cutonama3/auth/login.php");
    exit();
}

require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Xử lý tải lên ảnh
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $uploadDir = '../assets/celebrity/'; // Thư mục tải lên riêng
        $imageFileName = uniqid() . '-' . basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $imageFileName;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $_SESSION['error_message'] = "Failed to upload image.";
            header("Location: create_celebrity.php");
            exit();
        }
    }

    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];
    $celebrity_name = $_POST['celebrity_name'];
     $category = $_POST['category'];

    if (empty($title) || empty($summary) || empty($content) || empty($celebrity_name) || empty($category)) {
       $_SESSION['error_message'] = "All fields are required.";
        header("Location: create_celebrity.php");
        exit();
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO celebrity_news (title, summary, content, image, celebrity_name, category) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $summary, $content, $imagePath, $celebrity_name, $category]);

        $_SESSION['success_message'] = "Celebrity news added successfully!";
        header("Location: /cutonama3/admin/index.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Error: " . $e->getMessage();
        header("Location: create_celebrity.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Celebrity News</title>
     <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Add Celebrity News</h1>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error:</strong>
                <span class="block sm:inline"><?php echo $_SESSION['error_message']; ?></span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <form method="POST" action="create_celebrity.php" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                <input type="text" name="title" id="title" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div>
                <label for="summary" class="block text-gray-700 text-sm font-bold mb-2">Summary:</label>
                <textarea name="summary" id="summary" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            </div>
            <div>
                <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content:</label>
                <textarea name="content" id="content" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                <script>
                    CKEDITOR.replace('content');
                </script>
            </div>
            <div>
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image:</label>
                <input type="file" name="image" id="image" class="input-file">
            </div>
            <div>
                <label for="celebrity_name" class="block text-gray-700 text-sm font-bold mb-2">Celebrity Name:</label>
                <input type="text" name="celebrity_name" id="celebrity_name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div>
                <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Category:</label>
                 <input type="text" name="category" id="category" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add News</button>
             <a href="/cutonama3/admin/index.php" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancel</a>
        </form>
    </div>
</body>
</html>
