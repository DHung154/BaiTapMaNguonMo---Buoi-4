<?php
require 'C:\laragon\www\buoi4\bai1\connect.php';

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

$stmt = $conn->prepare("SELECT * FROM students WHERE name LIKE ?");
$stmt->execute(["%$keyword%"]);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<form method="get">
    <label>Tìm theo tên:</label>
    <input type="text" name="keyword" value="<?= htmlspecialchars($keyword) ?>">
    <button type="submit">Tìm kiếm</button>
</form>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Họ tên</th>
        <th>Email</th>
        <th>SĐT</th>
    </tr>
    <?php if ($students): ?>
        <?php foreach ($students as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="4">Không tìm thấy sinh viên nào</td></tr>
    <?php endif; ?>
</table>
