<?php

session_start();

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Tài khoản - KaidoTruck</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<?php if (!isset($_SESSION['user_id'])): ?>

    <h1>Bạn chưa đăng nhập</h1>

    <p>Vui lòng đăng nhập để sử dụng chức năng tài khoản.</p> 

    <a href="login.php" class="nut0">
        Đăng nhập
    </a>

    <a href="tienich.php" class="nut0">
        Trở về
    </a>

<?php else: ?>

    <h1>Thông tin tài khoản</h1>

    <p>
        Xin chào 
        <strong>
            <?php echo htmlspecialchars($_SESSION['username']); ?>
        </strong>
    </p>

    <p>
        Vai trò:
        <?php echo htmlspecialchars($_SESSION['role']); ?>
    </p>

    <a href="logout.php" class="nut-tienich">
        Đăng xuất
    </a>
<?php endif; ?>
</body>
</html>