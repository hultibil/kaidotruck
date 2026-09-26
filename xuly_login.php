<?php

session_start();

require_once "db.php";
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
if ($username === '' || $password === '') {
    die("Vui lòng nhập đầy đủ thông tin.");
}


/* Tìm tài khoản */
$sql = "SELECT id, username, password, role
        FROM users
        WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();


/* Kiểm tra tài khoản */
if (!$user) {
    die("Tên đăng nhập hoặc mật khẩu không đúng.");
}


/* Kiểm tra mật khẩu */
if (!password_verify($password, $user['password'])) {
    die("Tên đăng nhập hoặc mật khẩu không đúng.");
}


/* Đăng nhập thành công */
session_regenerate_id(true);
$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['role'] = $user['role'];


/* Chuyển về trang chủ */
if ($user['role'] === 'admin') {
    header("Location: quantri.php");
    exit;
}

header("Location: index.php");
exit;
?>