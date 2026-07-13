<?php
require 'C:\laragon\www\buoi4\bai1\connect.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO students (name, email, phone) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['name'], $_POST['email'], $_POST['phone']]);
    $message = "Thêm thành công!";
}
?>
<?= $message ?>
<form method="post">
    <label>Họ tên:</label> <input type="text" name="name" required><br>
    <label>Email:</label> <input type="email" name="email" required><br>
    <label>SĐT:</label> <input type="text" name="phone"><br>
    <button type="submit">Thêm</button>
</form>
