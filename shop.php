<?php

require_once "db.php";


// ============================================================
// LẤY DANH SÁCH LOẠI SẢN PHẨM
// Dùng để hiển thị các nút: Tất cả, Xe tải, Xe địa hình...
// ============================================================

$sql_categories = "SELECT * FROM categories ORDER BY id ASC";
$result_categories = $conn->query($sql_categories);


// ============================================================
// NHẬN DỮ LIỆU TỪ URL
// ============================================================

// Lấy loại sản phẩm
$category = $_GET['category'] ?? '';

// Lấy từ khóa tìm kiếm
$keyword = trim($_GET['keyword'] ?? '');


// ============================================================
// TẠO CÂU SQL LẤY SẢN PHẨM
// ============================================================

// Ban đầu lấy tất cả sản phẩm
$sql = "SELECT * FROM products WHERE 1=1";


// ============================================================
// LỌC THEO LOẠI
// ============================================================

if ($category !== '') {
    $sql .= " AND category_id = ?";
}


// ============================================================
// TÌM KIẾM THEO TỪ KHÓA
// ============================================================

if ($keyword !== '') {
    $sql .= " AND (name LIKE ? OR description LIKE ?)";
}


// ============================================================
// SẮP XẾP SẢN PHẨM
// ============================================================

$sql .= " ORDER BY id DESC";


// ============================================================
// CHUẨN BỊ SQL
// ============================================================

$stmt = $conn->prepare($sql);


// ============================================================
// GẮN DỮ LIỆU VÀO SQL
// ============================================================

$params = [];
$types = "";


// Nếu có category
if ($category !== '') {

    $params[] = $category;
    $types .= "i";
}


// Nếu có tìm kiếm
if ($keyword !== '') {
    $search = "%" . $keyword . "%";
    $params[] = $search;
    $params[] = $search;
    $types .= "ss";
}


// Nếu có dữ liệu cần gắn vào SQL
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}


// ============================================================
// THỰC THI SQL
// ============================================================

$stmt->execute();
$result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Kaido Shop</title>
    <link rel="stylesheet" href="">
</head>
<body>
    <h1>Kaido Shop</h1>


    <!-- ==================== mô đun phân loại sản phẩm ==================== -->
<div class="categories">
    <!-- Nút xem tất cả sản phẩm -->
    <a href="shop.php">
        Tất cả
    </a>
    <!-- Hiển thị các loại sản phẩm từ database -->
    <?php while ($category = $result_categories->fetch_assoc()): ?>
        <a href="shop.php?category=<?php echo $category['id']; ?>">
            <?php echo htmlspecialchars($category['name']); ?>
        </a>
    <?php endwhile; ?>
</div>

 <!-- ==================== mô đun tìm kiếm hiện trên html ==================== -->
    <form method="GET" action="shop.php">

    <input
        type="text"
        name="keyword"
        placeholder="Tìm sản phẩm..."
        value="<?php echo htmlspecialchars($_GET['keyword'] ?? ''); ?>"
    >

    <button type="submit">Tìm kiếm</button>

</form>

<!-- ==================== mô đun lọc sản phẩm theo giá hiện trên html==================== -->

<form method="GET" action="shop.php">

    <!-- Giá thấp nhất -->
    <input
        type="number"
        name="min_price"
        placeholder="Giá thấp nhất"
        value="<?php echo htmlspecialchars($_GET['min_price'] ?? ''); ?>"
    >

    <!-- Giá cao nhất -->
    <input
        type="number"
        name="max_price"
        placeholder="Giá cao nhất"
        value="<?php echo htmlspecialchars($_GET['max_price'] ?? ''); ?>"
    >

    <!-- Nút lọc -->
    <button type="submit">Lọc giá</button>

</form>

<!-- ==================== mo đun hiển thị sản phẩm lên html ==================== -->
    <div class="shop-list">
        <?php while ($product = $result->fetch_assoc()): ?>
            <div class="product-card">

    <h2>
        <?php echo htmlspecialchars($product['name']); ?>
    </h2>

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

    <a href="chitiet.php?id=<?php echo $product['id']; ?>">
        Xem chi tiết
    </a>

</div>
        <?php endwhile; ?>
    </div>
</body>
</html>