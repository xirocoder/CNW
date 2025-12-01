<?php
$config = [
    'host' => '127.0.0.1',
    'dbname' => 'cse485_web',
    'user' => 'root',
    'pass' => ''
];

function getPdo(array $cfg)
{
    static $pdo = null;
    if ($pdo !== null) {
        return $pdo;
    }

    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', $cfg['host'], $cfg['dbname']);
    try {
        $pdo = new PDO($dsn, $cfg['user'], $cfg['pass']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die('Kết nối thất bại: ' . $e->getMessage());
    }
}

function insertStudent(PDO $pdo, string $name, string $email): void
{
    $sql = 'INSERT INTO sinhvien (ten_sinh_vien, email) VALUES (:name, :email)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':name' => $name, ':email' => $email]);
}

function fetchStudents(PDO $pdo): array
{
    $sql = 'SELECT * FROM sinhvien ORDER BY id ASC';
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$name = $_POST['ten_sinh_vien'] ?? '';
$email = $_POST['email'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($name);
    $email = trim($email);

    if ($name !== '' && $email !== '') {
        $pdo = getPdo($config);
        insertStudent($pdo, $name, $email);
        header('Location: chapter4.php?success=1');
        exit;
    }
}

$pdo = getPdo($config);
$rows = fetchStudents($pdo);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chương 4 - CSE485</title>
    <style>
        body {font-family: Arial; margin: 40px; background: #f7f7f7;}
        table, th, td {border: 1px solid #ccc; padding: 10px; border-collapse: collapse;}
        th {background: #333; color: white;}
        input, button {padding: 8px 12px; margin: 5px;}
        button {background: #0066cc; color: white; border: none; cursor: pointer;}
        .success {color: green; font-weight: bold;}
    </style>
</head>
<body>

    <?php if (isset($_GET['success'])) echo '<p class="success">✓ Thêm sinh viên thành công!</p>'; ?>

    <h2>Thêm sinh viên mới</h2>
    <form action="" method="POST">
        Tên: <input type="text" name="ten_sinh_vien" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Thêm ngay</button>
    </form>

    <h2>Danh sách sinh viên</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Tên sinh viên</th>
            <th>Email</th>
            <th>Ngày tạo</th>
        </tr>
        <?php if (count($rows) > 0): ?>
            <?php foreach ($rows as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['ten_sinh_vien']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['ngay_tao']) ?></td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>

    <?php if (count($rows) == 0): ?>
        <p><i>Chưa có dữ liệu. Thêm sinh viên đầu tiên đi nào!</i></p>
    <?php endif; ?>

</body>
</html>