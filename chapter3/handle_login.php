<?php
// Khởi động session (luôn ở đầu file PHP nếu dùng SESSION)
session_start();

// Kiểm tra xem form đã được gửi bằng POST chưa
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Lấy dữ liệu từ form
    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);

    // Giả lập kiểm tra đăng nhập (hard-code)
    if ($user === 'admin' && $pass === '123') {
        // Lưu trạng thái đăng nhập vào SESSION
        $_SESSION['logged_in_user'] = $user;
        // Chuyển hướng đến trang chào mừng
        header('Location: welcome.php');
        exit;
    } else {
        // Sai thông tin đăng nhập -> quay lại form với thông báo lỗi
        header('Location: login.html?error=1');
        exit;
    }
} else {
    // Truy cập trực tiếp file xử lý mà không gửi form -> quay về trang đăng nhập
    header('Location: login.html');
    exit;
}
?>