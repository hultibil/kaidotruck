<?php

require_once "db.php";

$id = $_GET['id'] ?? 0;

$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    die("Không tìm thấy sản phẩm.");
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>
        <?php echo htmlspecialchars($product['name']); ?> - Kaido Shop
    </title>
    <link rel="stylesheet" href="css/chitiet.css">
</head>

<body>

    <h1>
        <?php echo htmlspecialchars($product['name']); ?>
    </h1>

    <p>
        <?php echo htmlspecialchars($product['description']); ?>
    </p>

    <p>
        Giá:
        <strong>
            <?php echo number_format($product['price']); ?> VNĐ
        </strong>
    </p>

    <p>
        Tồn kho:
        <?php echo $product['stock']; ?>
    </p>

    <br>

    <button type="button">
        Thêm vào giỏ hàng
    </button>

    <br><br>

    <a href="shop.php">
        ← Quay lại Kaido Shop
    </a>

</body>

</html>