<?php

use ClassProject\Product;
use ClassProject\ProductItem;

$sql_product = "SELECT 
    p.*, 
    pi.id AS pi_id, 
    pi.product AS pi_product, 
    pi.attributes, 
    pi.price, 
    pi.count 
    FROM 
        product p 
    LEFT JOIN 
        product_item pi ON p.id = pi.product 
    GROUP BY 
        p.id 
    ORDER BY 
        p.id DESC;";
$products = [];
$productItems = [];

$result_product = $connect->query($sql_product);
if ($result_product->num_rows > 0) {
    while ($row = $result_product->fetch_assoc()) {
        $product = new Product($row['id'], $row['name'], $row['categories'], $row['brand'], $row['review'], $row['image_url']);
        $products[] = $product;
        $productsItem = new ProductItem($row['pi_id'], $row['pi_product'], $row['attributes'], $row['price'], $row['count']);
        $productsItems[] = $productsItem;
    }
}

$sql_quantity = "SELECT 
    p.id,
    p.name,
    COALESCE(SUM(si.quantity), 0) AS total_quantity,
    COALESCE(AVG(pi.price), 0) AS average_price,
    GROUP_CONCAT(DISTINCT pi.attributes SEPARATOR ', ') AS attributes,
    GROUP_CONCAT(DISTINCT pi.count) AS item_counts
FROM 
    product p
LEFT JOIN 
    product_item pi ON p.id = pi.product
LEFT JOIN 
    sales_invoice_items si ON pi.id = si.product_item
GROUP BY 
    p.id, p.name
ORDER BY 
    p.id DESC";
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
