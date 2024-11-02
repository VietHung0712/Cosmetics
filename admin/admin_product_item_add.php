<?php
require_once "../php/connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $attributes = $_POST['attributes'];
    $price = $_POST['price'];
    $count = $_POST['count'];
    $product = $_GET['product'];

    $sql = "INSERT INTO product_item VALUES ('', $product, '$attributes', '$price', $count)";
    $result = mysqli_query($connect, $sql);
    mysqli_close($connect);
    if ($result) {
        header("Location: ./admin_product_item.php?product=" . $product);
        exit();
    } else {
        echo "<script>alert('Đã có lỗi!')</script>";
    }
}
