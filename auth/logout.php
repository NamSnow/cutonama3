<?php
session_start();

// Hủy tất cả các biến session
session_unset();

// Hủy session
session_destroy();

// Chuyển hướng về trang chủ hoặc trang đăng nhập
// Nếu bạn muốn chuyển hướng về trang chủ:
header("Location: /cutonama3/auth/login.php");

// Nếu bạn muốn chuyển hướng về trang đăng nhập (auth/login.php):
// header("Location: /cutonama3/auth/login.php");

exit();
?>