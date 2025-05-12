<?php
session_start();

session_unset();

// Hủy session
session_destroy();

header("Location: /cutonama3/auth/login.php");

exit();
?>