<?php
require_once "../php/connect.php";
if (isset($_GET['product'])) {
    $product = $_GET['product'];
    $sql = "DELETE FROM product WHERE id = $product";
    $result = mysqli_query($connect, $sql);
    mysqli_close($connect);
    if ($result) {
        header("Location: ./admin_product.php");
        exit();
    } else {
        echo "<script>alert('Đã có lỗi!')</script>";
    }
}
?>