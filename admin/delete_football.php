<?php
session_start();

// Check if the user is an admin; if not, redirect to login.
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /cutonama3/auth/login.php");
    exit();
}

require_once '../includes/db.php'; // Database connection

// Log access for administrative monitoring.
$ip_address = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$page_url = $_SERVER['REQUEST_URI'];

$stmt_log = $pdo->prepare("INSERT INTO access_logs (ip_address, user_agent, page_url) VALUES (?, ?, ?)");
$stmt_log->execute([$ip_address, $user_agent, $page_url]);

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $footballNewsId = intval($_GET['id']); // Sanitize input: ensure it's an integer

    try {
        // Start a transaction to ensure data integrity
        $pdo->beginTransaction();

        // 1. Retrieve the image path before deleting the record
        $stmt_select_image = $pdo->prepare("SELECT image FROM football_news WHERE football_news_id = ?");
        $stmt_select_image->execute([$footballNewsId]);
        $footballNews = $stmt_select_image->fetch(PDO::FETCH_ASSOC);

        // 2. Delete the image file from the server if it exists
        if ($footballNews && !empty($footballNews['image'])) {
            // Construct the absolute path to the image file
            // Adjust this path if your image upload directory is different
            $imagePath = __DIR__ . '/../' . $footballNews['image']; 
            
            // Check if the file exists and is not a directory before attempting to delete
            if (file_exists($imagePath) && is_file($imagePath)) {
                if (unlink($imagePath)) {
                    // File deleted successfully
                    // You could add a log here if needed
                } else {
                    // Log error if file deletion fails, but don't stop the database deletion
                    error_log("Failed to delete image file for football news ID " . $footballNewsId . ": " . $imagePath);
                }
            }
        }

        // 3. Delete the football news record from the database
        $stmt_delete = $pdo->prepare("DELETE FROM football_news WHERE football_news_id = ?");
        $stmt_delete->execute([$footballNewsId]);

        // Commit the transaction
        $pdo->commit();

        // Set a success message for the user
        $_SESSION['message'] = 'Tin tức Bóng đá đã được xóa thành công.';
        $_SESSION['message_type'] = 'success'; // 'success' or 'error' for styling

    } catch (PDOException $e) {
        // Rollback the transaction in case of an error
        $pdo->rollBack();
        // Set an error message for the user
        $_SESSION['message'] = 'Lỗi khi xóa tin tức Bóng đá: ' . $e->getMessage();
        $_SESSION['message_type'] = 'error';
        // Log the actual error for debugging
        error_log("Database error during football news deletion: " . $e->getMessage());
    }

} else {
    // If no ID is provided, set an error message
    $_SESSION['message'] = 'Không có ID tin tức Bóng đá được cung cấp để xóa.';
    $_SESSION['message_type'] = 'error';
}

// Redirect back to the news management page
header("Location: /cutonama3/admin/index.php");
exit();
?>