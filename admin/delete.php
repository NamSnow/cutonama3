<?php
require_once '../includes/db.php';

// Lấy thông tin bài viết để xóa ảnh (nếu có)
$stmt = $pdo->prepare("SELECT * FROM news WHERE news_id = ?");
$stmt->execute([$_GET['id']]);
$news = $stmt->fetch(PDO::FETCH_ASSOC);

if ($news) {
    // Xóa ảnh nếu có
    if ($news['image'] && file_exists($news['image'])) {
        unlink($news['image']);
    }

    // Xóa bài viết
    $stmt_delete = $pdo->prepare("DELETE FROM news WHERE news_id = ?");
    $stmt_delete->execute([$_GET['id']]);
}

// Chuyển hướng về trang quản lý tin tức
header("Location: /cutonama3/admin/index.php");
exit();
