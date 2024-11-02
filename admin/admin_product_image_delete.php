<?php
require_once "../php/connect.php";
if (isset($_GET['id']) && isset($_GET['product'])) {
    $id = $_GET['id'];
    $product = $_GET['product'];
    $sql = "DELETE FROM product_image WHERE id = $id";
    $result = mysqli_query($connect, $sql);
    mysqli_close($connect);
    if ($result) {
        header("Location: ./admin_product_item.php?product=" . $product);
        exit();
    } else {
        echo "<script>alert('Đã có lỗi!')</script>";
    }
}
?>