<?php

session_start();

// Chưa đăng nhập → quay về trang đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Không phải Admin → không cho vào
if ($_SESSION['role'] !== 'admin') {
    die("Bạn không có quyền truy cập trang quản trị.");
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản trị - KaidoTruck</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <h1>TRANG QUẢN TRỊ KAIDOTRUCK</h1>

    <p>
        Xin chào Admin:
        <strong>
            <?php echo htmlspecialchars($_SESSION['username']); ?>
        </strong>
    </p>

    <hr>

    <h2>Quản lý hệ thống</h2>

    <p>Đây là khu vực dành cho quản trị viên.</p>

    <a href="index.php">← Về trang chủ</a>
    <a href="logout.php">Đăng xuất</a>

</body>

</html>