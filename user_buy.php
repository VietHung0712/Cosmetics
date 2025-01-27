<?php
require_once "./php/connect.php";
require_once "./php/class.php";
require_once "./php/Manager_Brands.php";
require_once "./php/Manager_Categories.php";
require_once "./php/Manager_FlashDeal.php";

use ClassProject\Product;
use ClassProject\ProductItem;
use ClassProject\User;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/fontawesome-free-6.6.0-web/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/head_footer.css">
    <title>Document</title>
</head>
<body>
    <?php require_once "php/head.php"; ?>
    <div id="buy" style="margin-top: 15vh;">
        <form action="">
            <table>
                <th>Giao hàng đến</th>
                <td>
                    <input type="text" required>
                </td>
            </table>
        </form>
    </div>
</body>
</html>