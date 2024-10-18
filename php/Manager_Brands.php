<?php
use ClassProject\Brand;

$sql_brand = "SELECT * FROM brand";
$result_brand = $connect->query($sql_brand);
if ($result_brand->num_rows > 0) {
    while ($row = $result_brand->fetch_assoc()) {
        $brand = new Brand($row['id'], $row['name'], $row['address'], $row['phone']);
        $brandArr[] = $brand;
    }
}
?>