<?php
require_once "./php/connect.php";
require_once "./php/class.php";
require_once "./php/Manager_Brands.php";
require_once "./php/Manager_Categories.php";
require_once "./php/Manager_FlashDeal.php";

use ClassProject\Product;
use ClassProject\ProductItem;
use ClassProject\User;

$_SESSION['currentFileName'] = basename(__FILE__);
if (!isset($_SESSION['user_id'])) {
    header("Location: ./sign-in.php");
    exit();
}
$user_id = $_SESSION['user_id'];

$sql_user = "SELECT * FROM user WHERE id = '" . $user_id . "'";
$result_user = $connect->query($sql_user);
if ($result_user->num_rows > 0) {
    while ($row = $result_user->fetch_assoc()) {
        $this_user = new User($row['id'], $row['displayname'], $row['username'], $row['password'], $row['gender'], $row['address'], $row['phone'], $row['birthday'], $row['image_url']);
    }
}

$UserCart = [];
$infoProduct = [];
$infoProductItem = [];

$sql_user_cart = "SELECT * FROM user_cart WHERE user = " . $user_id;
$result_user_cart = $connect->query($sql_user_cart);
if ($result_user_cart->num_rows > 0) {
    while ($row = $result_user_cart->fetch_assoc()) {
        $UserCart[] = [$row['id'], $row['product_item'], $row['quantity']];
    }
}

foreach ($UserCart as $item) {
    $sql = "SELECT * FROM product_item WHERE id = " . $item[1];
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $infoProductItem[] = new ProductItem($row['id'], $row['product'], $row['attributes'], $row['price'], $row['count']);
        }
    }
}

foreach ($UserCart as $index => $item) {
    $sql = "SELECT * FROM product WHERE id = " . $infoProductItem[$index]->getProduct();
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $infoProduct[] = new Product($row['id'], $row['name'], $row['categories'], $row['brand'], $row['review'], $row['image_url']);
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/fontawesome-free-6.6.0-web/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/head_footer.css">
    <title>EVE</title>
</head>
<style>
    #user_cart {
        margin-top: 15vh;

        & .user_cart__border {
            position: relative;
            width: 100%;
            margin: auto;
            padding-bottom: 10vh;

            & input[type='text'] {
                text-align: center;
                border: none;
            }

            & table {
                width: 100%;

                & thead {
                    position: sticky;
                    top: 15vh;
                    color: #fff;
                    background-color: #ec6b81;
                }

                & tr {
                    height: 10vh;

                    & th,
                    & td {
                        width: calc(100% / 9);
                        text-align: center;
                    }

                    & img {
                        width: 10vw;
                        height: 10vw;
                        object-fit: contain;
                    }
                }

            }

            
        }
    }
</style>

<body>
    <?php require_once "./php/head.php"; ?>
    <div id="user_cart">
        <div class="user_cart__border">
            <form action="./manager/user_cart_buy.php" method="POST" autocomplete="off">
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Số thứ tự</th>
                            <th>Sản phẩm</th>
                            <th></th>
                            <th>Loại</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($UserCart) > 0) {
                            foreach ($UserCart as $index => $item) {
                                $discount = 0;
                                if(isset($flashDeals)){
                                    foreach ($flashDeals as $flashDeal) {
                                        if ($infoProduct[$index]->getId() == $flashDeal->getId()) {
                                            $discount = $flashDeal->getDiscount();
                                        }
                                    }
                                }
                                $price = ($infoProductItem[$index]->getPrice() * $item[2]) * (100 - $discount) / 100;
                                echo "
                    <tr>
                        <td>
                            <input type='checkbox' name='selected[]' value='$index'>
                            <input style='display: none;' type='text' name='user_cart_id[]' value='" . $item[0] . "' readonly>
                            <input style='display: none;' type='text' name='product_item[]' value='" . $infoProductItem[$index]->getId() . "' readonly>
                        </td>
                        <td>" . ($index + 1) . "</td>
                        <td style='font-weight: bold;'>" . $infoProduct[$index]->getName() . "</td>
                        <td><img src='" . $infoProduct[$index]->getImageUrl() . "' alt=''>  </td>
                        <td>" . $infoProductItem[$index]->getAttributes() . "</td>
                        <td><input name='quantity[]' type='text' value='$item[2]'></td>
                        <td><input name='price[]' class='price' data-price='$price' type='text' value='$price' readonly></td>
                        <td>
                            <a href='product_select.php?this_product=" . $infoProduct[$index]->getId() . "' style='background-color: orange; color: #fff; padding: 5px;'>Chi tiết</a>
                            <a style='background-color: blue; color: #fff; padding: 5px;' href='./user_cart_update.php?this_cart=$item[0]'>Sửa</a>
                            <a href='./manager/cart_delete.php?this_cart=" . $item[0] . "' style='background-color: red; color: #fff; padding: 5px;'>Xóa</a>
                        </td>
                    </tr>
                    ";
                            }
                        }
                        ?>
                        <tr>
                            <th>Giao đến</th>
                            <td colspan="2"><?php echo $this_user->getAddress() ?></td>
                            <td></td>
                            <td></td>
                            <th>Tổng giá:</th>
                            <td colspan="2"><input type="text" class="priceSum" style="font-weight: bold; text-align: center;" value="0"></td>
                        </tr>
                        <tr>
                            <td><input type="reset" style="font-weight: bold; padding: 1vh 0.5vw; background-color: #555; color: #fff;" value="Bỏ chọn tất cả"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2"><input class="btnBuy" style="font-weight: bold; padding: 1vh 2vw; background-color: #ec6b81; color: #fff;" type="button" onclick="return confirm('Bạn có chắc chắn mua không?')" value="Mua ngay"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <?php require_once "./php/footer.php" ?>
</body>

</html>
<script src="./js/function.js"></script>
<script>
    let sumPrice = 0;
    const prices = $$('.price');

    $$('input[type=checkbox]').forEach((element, index) => {
        element.addEventListener('change', () => {

            const priceValue = parseFloat(prices[index].dataset.price);

            if (element.checked) {
                sumPrice += priceValue;
            } else {
                sumPrice -= priceValue;
            }

            $('.priceSum').value = sumPrice;
        });
    });

    $('.btnBuy').addEventListener('click', () => {
        let check = 0;
        $$('input[type=checkbox]').forEach((element, index) => {
            if (element.checked) {
                check++;
            }
        });
        if (check > 0) {
            $('form').submit();
        } else {
            alert("Hãy chọn ít nhận 1 sản phẩm!");
        }
    })
</script>