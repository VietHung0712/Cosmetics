<?php

use ClassProject\Product;
use ClassProject\ProductItem;

$sql_product = "SELECT p.*, pi.attributes, pi.price, pi.count FROM product p JOIN product_item pi ON p.id = pi.product GROUP BY p.id ORDER BY id DESC";
$products = [];
$productItems = [];
$result_product = $connect->query($sql_product);
if ($result_product->num_rows > 0) {
    while ($row = $result_product->fetch_assoc()) {
        $product = new Product($row['id'], $row['name'], $row['categories'], $row['brand'], $row['review'], $row['image_url']);
        $products[] = $product;
        $prodcutsItem = new ProductItem($row['attributes'], $row['price'], $row['count']);
        $productsItems[] = $prodcutsItem;
    }
}

$sql_quantity = "SELECT p.*, SUM(si.quantity) AS total_quantity, pi.price, pi.attributes, pi.count
    FROM product p
    JOIN product_item pi ON p.id = pi.product
    JOIN sales_invoice_items si ON pi.id = si.product_item
    GROUP BY p.id, p.name
    ORDER BY p.id DESC";
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
