<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập - KaidoTruck</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Đăng nhập</h1>
    <form action="xuly_login.php" method="POST">
        <label>Tên đăng nhập:</label>
        <input
            type="text"
            name="username"
            required
        >
        <br><br>
        <label>Mật khẩu:</label>
        <input
            type="password"
            name="password"
            required
        >
        <br><br>
        <button type="submit">
            Đăng nhập
        </button>
    </form>
    <p>
        Chưa có tài khoản?
        <a href="dangky.php">Đăng ký</a>
    </p>
</body>
</html>