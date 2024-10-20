<?php
function ArrayProductImages($connect, $id)
{
    $images = [];
    $sql = "SELECT image_url FROM product_image WHERE product = '" . $id . "'";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $images[] = $row['image_url'];
        }
    }
    return $images;
}
