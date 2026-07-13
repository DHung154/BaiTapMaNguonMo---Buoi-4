<?php
require 'C:\laragon\www\buoi4\bai1\connect.php';

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("DELETE FROM students WHERE id=?");
    $stmt->execute([$_GET['id']]);
}
header("Location: ../bai3/list_students.php");
exit;
?>
