<?php
// Model: chứa toàn bộ logic tương tác với bảng sinhvien

declare(strict_types=1);

/**
 * Lấy toàn bộ sinh viên từ CSDL.
 */
function getAllSinhVien(PDO $pdo): array
{
    $sql = 'SELECT * FROM sinhvien ORDER BY id ASC';
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Thêm sinh viên mới bằng Prepared Statement để tránh SQL injection.
 */
function addSinhVien(PDO $pdo, string $ten, string $email): void
{
    $sql = 'INSERT INTO sinhvien (ten_sinh_vien, email) VALUES (?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ten, $email]);
}
