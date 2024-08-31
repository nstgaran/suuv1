<?php
// Khởi động session
session_start();

// Xóa tất cả dữ liệu session
session_destroy();

// Chuyển hướng người dùng về trang đăng nhập hoặc trang chính
header("Location: /freetruyen/login.php");
exit;
?>
