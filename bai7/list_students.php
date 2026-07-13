<?php
require 'C:\laragon\www\buoi4\bai1\connect.php';

// Lấy từ khóa tìm kiếm
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

// Thiết lập phân trang
$limit = 5; // số bản ghi mỗi trang
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Truy vấn tổng số bản ghi (có áp dụng tìm kiếm)
$sqlCount = "SELECT COUNT(*) FROM students WHERE name LIKE :keyword";
$stmtCount = $conn->prepare($sqlCount);
$stmtCount->execute([':keyword' => "%$keyword%"]);
$totalRecords = $stmtCount->fetchColumn();
$totalPages = ceil($totalRecords / $limit);

// Truy vấn dữ liệu có phân trang và tìm kiếm
$sql = "SELECT * FROM students
        WHERE name LIKE :keyword
        ORDER BY id DESC
        LIMIT :limit OFFSET :offset";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
</head>
<body>
    <h2>Danh sách sinh viên</h2>

    <!-- Form tìm kiếm -->
    <form method="get">
        <input type="text" name="keyword" value="<?= htmlspecialchars($keyword) ?>" placeholder="Nhập tên cần tìm">
        <button type="submit">Tìm kiếm</button>
    </form>

    <!-- Bảng hiển thị dữ liệu -->
    <table border="1" cellpadding="5">
        <tr>
            <th>#</th>
            <th>Họ và tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
        </tr>
        <?php if ($students): ?>
            <?php foreach ($students as $index => $row): ?>
            <tr>
                <td><?= $offset + $index + 1 ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['phone']) ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">Không có dữ liệu</td></tr>
        <?php endif; ?>
    </table>

    <!-- Phân trang -->
    <nav>
        <ul>
            <?php if ($page > 1): ?>
                <li><a href="?keyword=<?= urlencode($keyword) ?>&page=1">Đầu</a></li>
                <li><a href="?keyword=<?= urlencode($keyword) ?>&page=<?= $page - 1 ?>">Trước</a></li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li><a href="?keyword=<?= urlencode($keyword) ?>&page=<?= $i ?>"><?= $i == $page ? "[$i]" : $i ?></a></li>
            <?php endfor; ?>
            <?php if ($page < $totalPages): ?>
                <li><a href="?keyword=<?= urlencode($keyword) ?>&page=<?= $page + 1 ?>">Sau</a></li>
                <li><a href="?keyword=<?= urlencode($keyword) ?>&page=<?= $totalPages ?>">Cuối</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</body>
</html>
