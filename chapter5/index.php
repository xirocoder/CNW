<?php
// Controller: điều phối toàn bộ luồng MVC cho chương 5

require_once __DIR__ . '/models/SinhVienModel.php';

$host = '127.0.0.1';
$dbname = 'cse485_web';
$username = 'root';
$password = '';
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Kết nối thất bại: ' . $e->getMessage());
}

$thong_bao = '';
$is_success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten = trim($_POST['ten_sinh_vien'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($ten !== '' && $email !== '') {
        addSinhVien($pdo, $ten, $email);
        header('Location: index.php?success=1');
        exit;
    }

    $thong_bao = 'Vui lòng nhập đầy đủ tên và email.';
}

if (isset($_GET['success'])) {
    $is_success = true;
    $thong_bao = '✓ Thêm sinh viên thành công!';
}

$danh_sach_sv = getAllSinhVien($pdo);

include __DIR__ . '/views/sinhvien_view.php';
