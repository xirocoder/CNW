<?php
// View: chỉ chứa HTML + logic hiển thị đơn giản
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>PHT Chương 5 - MVC</title>
    <style>
        body {font-family: Arial, sans-serif; margin: 40px; background: #f7f7f7;}
        form {margin-bottom: 30px; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.08);}        
        input {padding: 8px 10px; margin-right: 10px; width: 240px;}
        button {padding: 8px 16px; background: #0066cc; color: #fff; border: none; border-radius: 4px; cursor: pointer;}
        table {width: 100%; border-collapse: collapse; background: #fff;}
        th, td {border: 1px solid #ddd; padding: 12px; text-align: left;}
        th {background-color: #f2f2f2;}
        .empty {font-style: italic; color: #555; margin-top: 15px;}
        .success {color: green; font-weight: bold; margin-bottom: 15px;}
        .warning {color: #c0392b; font-weight: bold; margin-bottom: 15px;}
    </style>
</head>
<body>
    <h2>Thêm Sinh Viên Mới (Kiến trúc MVC)</h2>
    <?php if (!empty($thong_bao)): ?>
        <p class="<?= ($is_success ?? false) ? 'success' : 'warning' ?>"><?= htmlspecialchars($thong_bao) ?></p>
    <?php endif; ?>
    <form action="" method="POST">
        <input type="text" name="ten_sinh_vien" placeholder="Tên sinh viên" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Thêm sinh viên</button>
    </form>

    <h2>Danh Sách Sinh Viên (Kiến trúc MVC)</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Tên Sinh Viên</th>
            <th>Email</th>
            <th>Ngày Tạo</th>
        </tr>
        <?php if (!empty($danh_sach_sv)): ?>
            <?php foreach ($danh_sach_sv as $sv): ?>
                <tr>
                    <td><?= htmlspecialchars($sv['id']) ?></td>
                    <td><?= htmlspecialchars($sv['ten_sinh_vien']) ?></td>
                    <td><?= htmlspecialchars($sv['email']) ?></td>
                    <td><?= htmlspecialchars($sv['ngay_tao']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="empty">Chưa có sinh viên nào. Hãy thêm bản ghi đầu tiên!</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
