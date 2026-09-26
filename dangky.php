<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký - KaidoTruck</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Đăng ký tài khoản</h1>
    <form action="xuly_dangky.php" method="POST">
        <label>Tên đăng nhập:</label>
        <input type="text" name="username" required>
        <br><br>
        <label>Mật khẩu:</label>
        <input type="password" name="password" required>
        <br><br>
        <label>Nhập lại mật khẩu:</label>
        <input type="password" name="password_confirm" required>
        <br><br>
        <button type="submit">Đăng ký</button>
    </form>
    <p>
        Đã có tài khoản?
        <a href="login.php">Đăng nhập</a>
    </p>
</body>
</html>