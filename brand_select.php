<?php

use ClassProject\Brand;
use ClassProject\Product;

require_once "./php/connect.php";
require_once "./php/class.php";
require_once "./php/Manager_Brands.php";
require_once "./php/Manager_Categories.php";
require_once "./php/Manager_Products.php";
require_once "./php/Manager_FlashDeal.php";
require_once "./php/function.php";

if (isset($_GET['this_brand'])) {
    $this_brandID = $_GET['this_brand'];
    $sql_brand_select = "SELECT * FROM brand WHERE id = " . $this_brandID;

    $result_sql_brand_select = $connect->query($sql_brand_select);
    if ($result_sql_brand_select->num_rows > 0) {
        while ($row = $result_sql_brand_select->fetch_assoc()) {
            $this_brand = new Brand($row['id'], $row['name'], $row['address'], $row['phone'], $row['icon_url'], $row['background_url'], $row['theme_url']);
        }
    }

    $ProductsInBrand = [];
    $sql_brand_products = "SELECT * FROM product WHERE brand = " . $this_brandID;
    $result_sql_brand_products = $connect->query($sql_brand_products);
    if ($result_sql_brand_products->num_rows > 0) {
        while ($row = $result_sql_brand_products->fetch_assoc()) {
            $ProductsInBrand[] = new Product($row['id'], $row['name'], $row['categories'], $row['brand'], $row['review'], $row['image_url']);
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/logo_project.png">
    <link rel="stylesheet" href="./assets/fontawesome-free-6.6.0-web/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/head_footer.css">
    <link rel="stylesheet" href="./css/brand_select.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>EVE</title>
</head>

<body>
    <?php require_once "./php/head.php" ?>
    <div id="brand_select">
        <div class="brand__head">
            <div class="brand__head--avatar">
                <div class="brand__head--avatar-border" style="background-image: url(<?php echo $this_brand->getBackgroundUrl(); ?>);"></div>
                <img src="<?php echo $this_brand->getIconUrl(); ?>" alt="">
                <p><?php echo $this_brand->getName(); ?></p>
            </div>
            <table>
                <tr>
                    <th><i class="fa-solid fa-map-location-dot"></i> Địa chỉ: </th>
                    <td><?php echo $this_brand->getAddress(); ?></td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-phone"></i> Điện thoại: </th>
                    <td><?php echo $this_brand->getPhone(); ?></td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-store"></i> Sản phẩm: </th>
                    <td><?php echo count($ProductsInBrand); ?></td>
                </tr>
            </table>
        </div>

        <div class="brand__body">
            <img src="<?php echo $this_brand->getThemeUrl(); ?>" alt="">
            <div class="brand__products">
                <h3>Sản phẩm của <?php echo $this_brand->getName(); ?></h3>
                <div class="brand__products--border">
                    <?php
                    if (count($ProductsInBrand) > 0) {
                        foreach ($ProductsInBrand as $item) {
                            echo "<a href='product_select.php?this_product=" . $item->getId() . "' class='product transition'>
                        <p></p>
                        <div class='product__img transition' style='background-image: url(" . $item->getImageUrl() . ");'></div>
                        <div class='product__info'>
                            <h3>" . $item->getName() . "</h3>
                        </div>
                    </a>";
                        }
                    }else{
                        echo "<h5>Chưa có sản phẩm!</h5>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php require_once "./php/footer.php" ?>
</body>

</html>