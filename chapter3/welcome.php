<?php
session_start();

// Nếu chưa đăng nhập thì chuyển hướng về trang login
if (!isset($_SESSION['logged_in_user'])) {
    header('Location: login.html');
    exit;
}

$loggedInUser = $_SESSION['logged_in_user'];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="welcome-body">
    <div class="welcome-container">
        <h1 class="welcome-title">Chào mừng trở lại, <?php echo htmlspecialchars($loggedInUser); ?>!</h1>
        <p class="welcome-text">Bạn đã đăng nhập thành công.</p>
        <a class="btn-secondary" href="logout.php">Đăng xuất</a>
    </div>
</body>
</html>