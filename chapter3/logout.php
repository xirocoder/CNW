<?php
session_start();
// Hủy toàn bộ session và quay lại trang đăng nhập
session_unset();
session_destroy();
header('Location: login.html');
exit;
?>