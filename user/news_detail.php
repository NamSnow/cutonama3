<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa (tùy chọn, nếu bạn muốn chỉ người dùng đã đăng nhập mới xem được)
if (!isset($_SESSION['user_id'])) {
    header("Location: /cutonama3/auth/login.php"); // Điều chỉnh đường dẫn nếu cần
    exit();
}

require_once '../includes/db.php'; // Đường dẫn đến file kết nối database

// Lấy ID của tin tức từ tham số GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $news_id = $_GET['id'];

    // Truy vấn để lấy thông tin chi tiết của tin tức
    $stmt = $pdo->prepare("SELECT * FROM news WHERE news_id = :news_id AND is_published = 1");
    $stmt->bindParam(':news_id', $news_id, PDO::PARAM_INT);
    $stmt->execute();
    $newsDetail = $stmt->fetch(PDO::FETCH_ASSOC);

    // Nếu không tìm thấy tin tức hoặc tin tức chưa được xuất bản
    if (!$newsDetail) {
        // Chuyển hướng người dùng hoặc hiển thị thông báo lỗi
        header("Location: /cutonama3/user"); // Chuyển về trang chủ
        exit();
    }

    // Tăng số lượt xem (tùy chọn)
    $updateViewCountStmt = $pdo->prepare("UPDATE news SET view_count = view_count + 1 WHERE news_id = :news_id");
    $updateViewCountStmt->bindParam(':news_id', $news_id, PDO::PARAM_INT);
    $updateViewCountStmt->execute();

} else {
    // Nếu không có ID hoặc ID không hợp lệ, chuyển hướng
    header("Location: /cutonama3/user"); // Chuyển về trang chủ
    exit();
}

// Lấy thông tin người dùng từ session (nếu đã đăng nhập)
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($newsDetail['title']); ?> - TinTucAZ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }
        .container {
            margin-top: 2rem;
        }
        .news-detail {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        .news-detail h2 {
            color: #007bff;
            border-bottom: 2px solid #007bff;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }
        .news-detail img {
            max-width: 100%;
            height: auto;
            margin-bottom: 1rem;
            border-radius: 4px;
        }
        .news-detail .created-at {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 0.5rem;
            display: block;
        }
        .news-detail .content {
            line-height: 1.8;
        }
        .back-link {
            display: inline-block;
            margin-top: 1rem;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .back-link:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="news-detail">
            <h2><?php echo htmlspecialchars($newsDetail['title']); ?></h2>
            <span class="created-at">Được đăng vào: <?php echo date('d/m/Y H:i:s', strtotime($newsDetail['created_at'])); ?></span>
            <?php if (!empty($newsDetail['image'])): ?>
                <img src="../cutonama3/<?php echo htmlspecialchars($newsDetail['image']); ?>" alt="<?php echo htmlspecialchars($newsDetail['title']); ?>">
            <?php endif; ?>
            <p class="summary"><?php echo htmlspecialchars($newsDetail['summary']); ?></p>
            <div class="content">
                <?php echo $newsDetail['content']; // Không cần htmlspecialchars vì có thể chứa HTML từ trình soạn thảo ?>
            </div>
            <a href="javascript:history.back()" class="back-link">&laquo; Quay lại</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>