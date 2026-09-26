<?php

require_once "db.php";

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$password_confirm = $_POST['password_confirm'] ?? '';

// Kiểm tra nhập đủ
if ($username === '' || $password === '' || $password_confirm === '') {
    die("Vui lòng nhập đầy đủ thông tin.");
}

// Kiểm tra mật khẩu nhập lại
if ($password !== $password_confirm) {
    die("Mật khẩu nhập lại không khớp.");
}

// Kiểm tra username đã tồn tại chưa
$sql = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    die("Tên đăng nhập đã tồn tại.");
}

// Mã hóa mật khẩu
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Thêm tài khoản mới
$sql = "INSERT INTO users (username, password, role)
        VALUES (?, ?, 'user')";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password_hash);

if ($stmt->execute()) {
    echo "Đăng ký thành công!<br>";
    echo '<a href="login.php">Đăng nhập ngay</a>';
} else {
    echo "Đăng ký thất bại: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>