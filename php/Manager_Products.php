<?php
use ClassProject\Product;

$sql_product = "SELECT * FROM product ORDER BY stt DESC";
$products = [];
$result_product = $connect->query($sql_product);
if ($result_product->num_rows > 0) {
    while ($row = $result_product->fetch_assoc()) {
        $product = new Product($row['id'], $row['name'], $row['categories'], $row['classification'], $row['brand'], $row['review'], $row['rank'], $row['sum'], $row['sold'], $row['price'], $row['image_url'], $row['stt']);
        $products[] = $product;
    }
}
?>