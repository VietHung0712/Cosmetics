<?php
use ClassProject\Categories;

$sql_categories = "SELECT * FROM categories ORDER BY name";
$categoriesArr = [];
$result_categories = $connect->query($sql_categories);
if ($result_categories->num_rows > 0) {
    while ($row = $result_categories->fetch_assoc()) {
        $categories = new Categories($row['id'], $row['name']);
        $categoriesArr[] = $categories;
    }
}

?>