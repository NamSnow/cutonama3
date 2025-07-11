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

$celebrity_news = null;
$error = '';
$success = '';

// Check if an ID is provided in the URL
if (isset($_GET['id'])) {
    $celebrity_news_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch the celebrity news article from the database
    $stmt = $pdo->prepare("SELECT * FROM celebrity_news WHERE celebrity_news_id = ?");
    $stmt->execute([$celebrity_news_id]);
    $celebrity_news = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$celebrity_news) {
        $error = 'Tin tức người nổi tiếng không tồn tại.';
    }
} else {
    $error = 'Không có ID tin tức người nổi tiếng được cung cấp.';
}

// Handle form submission for updating celebrity news
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $celebrity_news) {
    $title = trim($_POST['title']);
    $summary = trim($_POST['summary']);
    $content = trim($_POST['content']);
    $is_published = isset($_POST['is_published']) ? 1 : 0;
    $current_image = $celebrity_news['image']; // Get existing image path

    // Validate inputs
    if (empty($title) || empty($summary) || empty($content)) {
        $error = 'Tiêu đề, tóm tắt và nội dung không được để trống.';
    } else {
        $image_path = $current_image; // Default to current image

        // --- Handle image via URL first ---
        if (!empty($_POST['image_url'])) {
            $image_url = filter_var($_POST['image_url'], FILTER_SANITIZE_URL);
            if (filter_var($image_url, FILTER_VALIDATE_URL)) {
                // Set the image path to the provided URL
                $image_path = $image_url;

                // If a new URL is provided, and there was a previously uploaded file, delete it.
                // This ensures old local files aren't left behind if switching to a URL.
                if ($current_image && file_exists($current_image) && !filter_var($current_image, FILTER_VALIDATE_URL) && !strpos($current_image, 'default_image.jpg')) {
                    unlink($current_image);
                }
            } else {
                $error = "URL hình ảnh không hợp lệ.";
            }
        }
        // --- Then handle file upload if no URL is provided ---
        // This 'elseif' ensures file upload only happens if no URL is given.
        elseif (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $target_dir = "../uploads/";
            $image_name = uniqid() . '_' . basename($_FILES["image"]["name"]);
            $target_file = $target_dir . $image_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check === false) {
                $error = "File không phải là hình ảnh.";
            } elseif ($_FILES["image"]["size"] > 5000000) { // 5MB limit
                $error = "Kích thước hình ảnh quá lớn (tối đa 5MB).";
            } elseif (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
                $error = "Chỉ cho phép JPG, JPEG, PNG & GIF.";
            } else {
                // Delete old image if it exists, is a local file, and not the default.
                // Ensures old local files are removed when a new one is uploaded.
                if ($current_image && file_exists($current_image) && !filter_var($current_image, FILTER_VALIDATE_URL) && !strpos($current_image, 'default_image.jpg')) {
                    unlink($current_image);
                }
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image_path = $target_file;
                } else {
                    $error = "Có lỗi khi tải lên hình ảnh.";
                }
            }
        }
        // --- Handle image removal if requested and no new image/URL is provided ---
        elseif (isset($_POST['remove_image']) && $_POST['remove_image'] === '1') {
            // Only remove if it's a local file and not the default image.
            if ($current_image && file_exists($current_image) && !filter_var($current_image, FILTER_VALIDATE_URL) && !strpos($current_image, 'default_image.jpg')) {
                unlink($current_image);
            }
            $image_path = null; // Set image path to null in DB
        }

        if (empty($error)) {
            try {
                $stmt = $pdo->prepare("UPDATE celebrity_news SET title = ?, summary = ?, content = ?, image = ?, is_published = ? WHERE celebrity_news_id = ?");
                $stmt->execute([$title, $summary, $content, $image_path, $is_published, $celebrity_news_id]);
                $success = 'Tin tức người nổi tiếng đã được cập nhật thành công!';
                // Refresh celebrity news data to show updated info immediately
                $stmt = $pdo->prepare("SELECT * FROM celebrity_news WHERE celebrity_news_id = ?");
                $stmt->execute([$celebrity_news_id]);
                $celebrity_news = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                $error = "Lỗi cơ sở dữ liệu: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa Tin tức Người nổi tiếng</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif; /* Modern font */
            background-color: #ffffff; /* White background */
            color: #1a202c; /* Dark text */
        }
        .form-input, .form-textarea, .form-select {
            /* Added border and changed colors for light theme */
            @apply shadow-sm bg-white border border-gray-300 rounded-lg py-3 px-4 text-gray-800 leading-tight focus:outline-none focus:ring-4 focus:ring-pink-300 focus:border-pink-500 transition duration-300 ease-in-out; /* Pink focus for celebrity theme */
        }
        .form-checkbox {
            /* Changed colors for light theme */
            @apply h-5 w-5 text-pink-600 focus:ring-pink-500 border-gray-400 rounded-md bg-white; /* Pink checkbox for celebrity theme */
        }
        /* Custom scrollbar for textareas */
        textarea::-webkit-scrollbar {
            width: 8px;
        }
        textarea::-webkit-scrollbar-track {
            background: #f1f5f9; /* Lighter track */
            border-radius: 10px;
        }
        textarea::-webkit-scrollbar-thumb {
            background: #cbd5e1; /* Scrollbar color */
            border-radius: 10px;
        }
        textarea::-webkit-scrollbar-thumb:hover {
            background: #a0aec0; /* Darker on hover */
        }
        /* Animation for alerts */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen text-gray-800">
    <?php include_once '../navbar/header_admin.php'; ?>

    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8 max-w-4xl">
        <h1 class="text-5xl font-extrabold text-gray-900 mb-10 text-center tracking-tight">Cập nhật Tin tức Người nổi tiếng</h1>

        <div class="bg-white shadow-2xl rounded-xl p-8 mb-8 border border-gray-200">
            <div class="flex justify-between items-center mb-8">
                <a href="/cutonama3/admin/index.php?filter=celebrity" class="inline-flex items-center px-6 py-3 bg-pink-600 hover:bg-pink-700 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-pink-500 focus:ring-opacity-50">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Quay lại danh sách
                </a>
            </div>

            <?php if ($error): ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-md animate-fade-in" role="alert">
                    <p class="font-bold">Lỗi!</p>
                    <p><?php echo htmlspecialchars($error); ?></p>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md animate-fade-in" role="alert">
                    <p class="font-bold">Thành công!</p>
                    <p><?php echo htmlspecialchars($success); ?></p>
                </div>
            <?php endif; ?>

            <?php if ($celebrity_news): ?>
                <form action="edit_celebrity.php?id=<?php echo htmlspecialchars($celebrity_news['celebrity_news_id']); ?>" method="POST" enctype="multipart/form-data" class="space-y-7">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Tiêu đề:</label>
                        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($celebrity_news['title']); ?>" required class="form-input w-full" placeholder="Nhập tiêu đề tin tức người nổi tiếng">
                    </div>

                    <div>
                        <label for="summary" class="block text-sm font-medium text-gray-700 mb-2">Tóm tắt:</label>
                        <textarea id="summary" name="summary" rows="4" required class="form-textarea w-full" placeholder="Nhập tóm tắt tin tức người nổi tiếng"><?php echo htmlspecialchars($celebrity_news['summary']); ?></textarea>
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Nội dung:</label>
                        <textarea id="content" name="content" rows="12" required class="form-textarea w-full" placeholder="Nhập nội dung đầy đủ của tin tức người nổi tiếng"><?php echo htmlspecialchars($celebrity_news['content']); ?></textarea>
                    </div>

                    <div>
                        <label for="image_url" class="block text-sm font-medium text-gray-700 mb-2">Hình ảnh (URL):</label>
                        <input type="url" id="image_url" name="image_url" value="<?php echo filter_var($celebrity_news['image'], FILTER_VALIDATE_URL) ? htmlspecialchars($celebrity_news['image']) : ''; ?>" class="form-input w-full" placeholder="Dán URL hình ảnh vào đây">
                    </div>

                    <?php if (!empty($celebrity_news['image'])): ?>
                        <div class="mt-6 flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6 bg-gray-100 p-4 rounded-lg shadow-inner">
                            <p class="text-sm text-gray-600">Hình ảnh hiện tại:</p>
                            <img src="<?php echo htmlspecialchars($celebrity_news['image']); ?>" alt="Current Image" class="w-40 h-40 object-cover rounded-md shadow-lg border border-gray-300">
                            
                        </div>
                    <?php endif; ?>

                    <div class="flex items-center">
                        <input type="checkbox" id="is_published" name="is_published" value="1" <?php echo $celebrity_news['is_published'] ? 'checked' : ''; ?> class="form-checkbox">
                        <label for="is_published" class="ml-3 block text-base font-medium text-gray-700 cursor-pointer">Đăng tin tức</label>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="inline-flex items-center px-8 py-4 border border-transparent text-lg font-bold rounded-lg shadow-xl text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-4 focus:ring-pink-500 focus:ring-opacity-50 transition duration-300 ease-in-out transform hover:scale-105">
                            <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414L7 9.586 5.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            Cập nhật Tin tức Người nổi tiếng
                        </button>
                    </div>
                </form>
            <?php else: ?>
                <p class="text-red-600 text-center text-xl font-semibold bg-gray-100 p-6 rounded-lg shadow-md border border-red-300">Không tìm thấy tin tức người nổi tiếng để chỉnh sửa.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>