<?php
require 'C:\laragon\www\buoi4\bai1\connect.php';

// Trước đây bài 3 dùng $conn->query("SELECT * FROM students");
// Bài 10 chuyển sang dùng Prepared Statement cho toàn bộ truy vấn
$stmt = $conn->prepare("SELECT * FROM students");
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Họ tên</th>
        <th>Email</th>
        <th>SĐT</th>
    </tr>
    <?php foreach ($students as $row): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['phone']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
