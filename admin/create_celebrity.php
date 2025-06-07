<?php
session_start();

// Kiểm tra xem người dùng có phải là admin không
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /cutonama3/auth/login.php");
    exit();
}

require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imagePath = null;
    $error = false; // Flag to check for errors before processing

    // Lấy và xác thực URL ảnh
    $imageUrl = trim($_POST['image_url'] ?? '');
    if (!empty($imageUrl)) {
        // Xác thực URL đơn giản. Bạn có thể muốn regex mạnh hơn trong thực tế.
        if (filter_var($imageUrl, FILTER_VALIDATE_URL)) {
            $imagePath = $imageUrl;
        } else {
            $_SESSION['error_message'] = "Đường dẫn ảnh không hợp lệ. Vui lòng nhập một URL hợp lệ.";
            $error = true;
        }
    } else {
        // Nếu trường URL ảnh trống
        $_SESSION['error_message'] = "Vui lòng cung cấp một URL ảnh.";
        $error = true;
    }

    $title = trim($_POST['title'] ?? '');
    $summary = trim($_POST['summary'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $celebrity_name = trim($_POST['celebrity_name'] ?? '');
    $category = trim($_POST['category'] ?? '');

    // Kiểm tra các trường trống chỉ khi không có lỗi ảnh
    if (!$error && (empty($title) || empty($summary) || empty($content) || empty($celebrity_name) || empty($category))) {
        $_SESSION['error_message'] = "Vui lòng điền đầy đủ thông tin vào các trường bắt buộc.";
        $error = true;
    }

    if (!$error) {
        try {
            $stmt = $pdo->prepare("INSERT INTO celebrity_news (title, summary, content, image, celebrity_name, category) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $summary, $content, $imagePath, $celebrity_name, $category]);

            $_SESSION['success_message'] = "Đã thêm tin tức người nổi tiếng thành công!";
            header("Location: /cutonama3/admin/index.php");
            exit();
        } catch (PDOException $e) {
            $_SESSION['error_message'] = "Lỗi khi thêm tin tức: " . $e->getMessage();
            header("Location: create_celebrity.php");
            exit();
        }
    } else {
        // Chuyển hướng lại về form nếu có lỗi
        header("Location: create_celebrity.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Thêm tin tức Người nổi tiếng</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <style>
        body {
            background-color: #f0f2f5; /* Light grey background for the page */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* A clean, modern font */
        }
        /* CKEditor might need some basic styling adjustments if it looks off */
        .ckeditor-container .cke_textarea_inline {
            border: 1px solid #e2e8f0; /* Match Tailwind's default border color */
            border-radius: 0.25rem; /* Match Tailwind's default border radius */
            padding: 0.75rem 1rem; /* Match input padding */
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); /* Match input shadow */
            transition: all 0.2s ease-in-out;
        }
        .ckeditor-container .cke_textarea_inline:focus-within {
            outline: none;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5); /* Blue focus ring */
            border-color: transparent; /* Clear border when focus ring is active */
        }
    </style>
</head>
<body class="bg-gray-100 py-10">
    <div class="max-w-4xl mx-auto p-8 bg-white rounded-xl shadow-2xl">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-8 text-center">Thêm tin tức Người nổi tiếng</h1>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Lỗi:</strong>
                <span class="block sm:inline"><?php echo htmlspecialchars($_SESSION['error_message']); ?></span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.style.display='none';">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Đóng</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <form method="POST" action="create_celebrity.php" class="space-y-6">
            <div>
                <label for="title" class="block text-gray-700 text-sm font-semibold mb-2">Tiêu đề:</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    required
                    class="shadow-sm appearance-none border border-gray-300 rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                    placeholder="Nhập tiêu đề tin tức"
                >
            </div>
            <div>
                <label for="summary" class="block text-gray-700 text-sm font-semibold mb-2">Tóm tắt:</label>
                <textarea
                    name="summary"
                    id="summary"
                    rows="3"
                    class="shadow-sm appearance-none border border-gray-300 rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                    placeholder="Tóm tắt ngắn gọn nội dung tin tức"
                ></textarea>
            </div>
            <div class="ckeditor-container"> <label for="content" class="block text-gray-700 text-sm font-semibold mb-2">Nội dung:</label>
                <textarea
                    name="content"
                    id="content"
                    class="shadow-sm appearance-none border border-gray-300 rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                ></textarea>
                <script>
                    CKEDITOR.replace('content');
                </script>
            </div>
            
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                <label for="image_url" class="block text-gray-700 text-base font-bold mb-2">URL ảnh:</label>
                <input
                    type="url"
                    name="image_url"
                    id="image_url"
                    required
                    class="shadow-sm appearance-none border border-gray-300 rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                    placeholder="http://example.com/hinh-anh-nguoi-noi-tieng.jpg"
                >
                <p class="text-sm text-gray-500 mt-2">Vui lòng dán một URL ảnh hợp lệ (ví dụ: từ Google Photos, Imgur, v.v.).</p>
            </div>

            <div>
                <label for="celebrity_name" class="block text-gray-700 text-sm font-semibold mb-2">Tên người nổi tiếng:</label>
                <input
                    type="text"
                    name="celebrity_name"
                    id="celebrity_name"
                    required
                    class="shadow-sm appearance-none border border-gray-300 rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                    placeholder="Ví dụ: Sơn Tùng M-TP"
                >
            </div>
            <div>
                <label for="category" class="block text-gray-700 text-sm font-semibold mb-2">Danh mục:</label>
                <input
                    type="text"
                    name="category"
                    id="category"
                    required
                    class="shadow-sm appearance-none border border-gray-300 rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                    placeholder="Ví dụ: Âm nhạc, Điện ảnh"
                >
            </div>

            <div class="flex space-x-4 pt-4">
                <button
                    type="submit"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75 transition duration-300 transform hover:-translate-y-0.5 shadow-md"
                >
                    <svg class="w-5 h-5 inline-block mr-2 -mt-0.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Thêm tin tức
                </button>
                <a
                    href="/cutonama3/admin/index.php"
                    class="flex-1 text-center bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-75 transition duration-300 transform hover:-translate-y-0.5 shadow-md"
                >
                    Hủy
                </a>
            </div>
        </form>
    </div>
</body>
</html>