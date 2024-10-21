<?php

use ClassProject\Product;

$sql_product = "SELECT * FROM product ORDER BY id DESC";
$products = [];
$result_product = $connect->query($sql_product);
if ($result_product->num_rows > 0) {
    while ($row = $result_product->fetch_assoc()) {
        $product = new Product($row['id'], $row['name'], $row['categories'], $row['brand'], $row['review'], $row['sum'], $row['price'], $row['image_url']);
        $products[] = $product;
    }
}

$sql_quantity = "SELECT p.id, COALESCE(SUM(si.quantity), 0) AS total_quantity FROM product p LEFT JOIN sales_invoice_items si ON p.id = si.product GROUP BY p.id ORDER BY p.id DESC;";
$result_quantity = $connect->query($sql_quantity);
if ($result_quantity->num_rows > 0) {
    while ($row = $result_quantity->fetch_assoc()) {
        $quantity[] = $row['total_quantity'];
    }
}

$sql_rank = "SELECT p.id, AVG(ur.rating) AS average_rating FROM product p LEFT JOIN user_reviews ur ON p.id = ur.product GROUP BY p.id ORDER BY p.id DESC";
$result_rank = $connect->query($sql_rank);
if ($result_rank->num_rows > 0) {
    while ($row = $result_rank->fetch_assoc()) {
        $rank[] = $row['average_rating'];
    }
}
