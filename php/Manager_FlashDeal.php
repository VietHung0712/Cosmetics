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

$sql_flashDealAll = "SELECT 
        fd.id AS flash_deal_id,
        fd.discount,
        fd.starttime,
        fd.endtime,
        p.*
    FROM 
        flash_deal fd
    JOIN 
        product p ON fd.product = p.id";
$result_flashDealAll = $connect->query($sql_flashDealAll);
if ($result_flashDealAll->num_rows > 0) {
    while ($row = $result_flashDealAll->fetch_assoc()) {
        $flashDeal = new FlashDeal($row['id'], $row['name'], $row['categories'], $row['brand'], $row['review'], $row['image_url'], $row['starttime'], $row['endtime'], $row['discount']);
        $flashDealAll[] = $flashDeal;
        $flashDealIdAll[] = $row['flash_deal_id'];
    }
}
