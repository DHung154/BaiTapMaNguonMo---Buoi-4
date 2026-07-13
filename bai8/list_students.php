<?php
require 'C:\laragon\www\buoi4\bai1\connect.php';

$stmt = $conn->query("SELECT * FROM students");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Họ tên</th>
        <th>Email</th>
        <th>SĐT</th>
        <th>Ngày sinh</th>
        <th>Thao tác</th>
    </tr>
    <?php foreach ($students as $row): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['phone']) ?></td>
        <td><?= htmlspecialchars($row['birthday']) ?></td>
        <td>
            <a href="edit_student.php?id=<?= $row['id'] ?>">Sửa</a> |
            <a href="../bai5/delete_student.php?id=<?= $row['id'] ?>" onclick="return confirm('Xóa?')">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
