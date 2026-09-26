connect_error) {
    die("Kết nối Database thất bại: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>