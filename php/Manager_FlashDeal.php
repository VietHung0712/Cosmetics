<?php
use ClassProject\FlashDeal;
$sql_flashDeal = "SELECT p.*, pi.price, f.discount, f.starttime, f.endtime FROM product p JOIN flash_deal f ON p.id = f.product JOIN product_item pi ON pi.product = p.id WHERE NOW() BETWEEN f.starttime AND f.endtime GROUP BY p.id";
$result_flashDeal = $connect->query($sql_flashDeal);
if ($result_flashDeal->num_rows > 0) {
    while ($row = $result_flashDeal->fetch_assoc()) {
        $flashDeal = new FlashDeal($row['id'], $row['name'], $row['categories'], $row['brand'], $row['review'], $row['image_url'], $row['starttime'], $row['endtime'], $row['discount']);
        $flashDeals[] = $flashDeal;
        $flashDealPrices[] = $row['price'];
    }
}
