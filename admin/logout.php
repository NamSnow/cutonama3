<?php
session_start();

// Hủy tất cả session
session_unset();

// Hủy session
session_destroy();

// Chuyển hướng về trang login
header("Location: /cutonama3/auth/login.php");
exit();
?>
