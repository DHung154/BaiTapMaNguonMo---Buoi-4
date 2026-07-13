<?php
require 'C:\laragon\www\buoi4\bai1\connect.php';

// Chỉ cho phép sắp xếp theo name hoặc email (tránh SQL Injection ở tên cột)
$allowedSort = ['name', 'email'];
$sortBy = isset($_GET['sort']) && in_array($_GET['sort'], $allowedSort) ? $_GET['sort'] : 'id';

// Chiều sắp xếp
$order = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'DESC' : 'ASC';

$sql = "SELECT * FROM students ORDER BY $sortBy $order";
$stmt = $conn->prepare($sql);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<p>
    Sắp xếp theo:
    <a href="?sort=name&order=asc">Tên (A-Z)</a> |
    <a href="?sort=name&order=desc">Tên (Z-A)</a> |
    <a href="?sort=email&order=asc">Email (A-Z)</a> |
    <a href="?sort=email&order=desc">Email (Z-A)</a>
</p>

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
