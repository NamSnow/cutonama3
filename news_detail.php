<?php
require_once './includes/db.php';

if (!isset($_GET['id'])) {
    echo "Không tìm thấy tin tức.";
    exit();
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
$stmt->execute([$id]);
$news = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$news) {
    echo "Tin tức không tồn tại.";
    exit();
}
?>
<!-- Hiển thị chi tiết -->
<h1><?php echo htmlspecialchars($news['title']); ?></h1>
<img src="<?php echo htmlspecialchars($news['image_url']); ?>" alt="Ảnh tin tức" style="width:100%; max-height: 400px; object-fit: cover;">
<p><em>Ngày đăng: <?php echo date('d/m/Y', strtotime($news['created_at'])); ?></em></p>
<div>
    <?php echo nl2br(htmlspecialchars($news['content'])); ?>
</div>
