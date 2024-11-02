<?php
require_once "./php/connect.php";
require_once "./php/class.php";
require_once "./php/Manager_Brands.php";
require_once "./php/Manager_Categories.php";

use ClassProject\Product;
use ClassProject\ProductItem;

if (isset($_GET['this_cart'])) {
    $this_cartID = $_GET['this_cart'];
    $this_cart = [];

    $sql_user_cart = "SELECT * FROM user_cart WHERE id = " . $this_cartID;

    $result_user_cart = $connect->query($sql_user_cart);
    if ($result_user_cart->num_rows > 0) {
        while ($row = $result_user_cart->fetch_assoc()) {
            $this_cart[] = [$row['id'], $row['product_item'], $row['quantity']];
        }
    }

    $sql_cart_product = "SELECT p.*, pi.id AS pi_id, pi.product AS pi_product, pi.attributes, pi.price, pi.count FROM product p JOIN product_item pi ON p.id = pi.product WHERE pi.id = " . $this_cart[0][1];

    $result_cart_product = $connect->query($sql_cart_product);
    if ($result_cart_product->num_rows > 0) {
        while ($row = $result_cart_product->fetch_assoc()) {
            $cart_product = new Product($row['id'], $row['name'], $row['categories'], $row['brand'], $row['review'], $row['image_url']);
            $cart_productsItem = new ProductItem($row['pi_id'], $row['pi_product'], $row['attributes'], $row['price'], $row['count']);
        }
    }

    $sql_product = "SELECT * FROM product_item WHERE product = " . $cart_product->getId();
    $result_product = $connect->query($sql_product);
    if ($result_product->num_rows > 0) {
        while ($row = $result_product->fetch_assoc()) {
            $productsItem[] = new ProductItem($row['id'], $row['product'], $row['attributes'], $row['price'], $row['count']);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sql_update = "UPDATE user_cart SET product_item = " . $_POST['product_item'] . ", quantity = " . $_POST['quantity'] . " WHERE id = " . $this_cartID;
        $result_update = $connect->query($sql_update);
        if ($result_update) {
            header("Location: ./user_cart.php");
            exit();
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
    #user_cart_update {
        width: 100%;
        max-width: 600px;
        margin: 20px auto;
        margin-top: 13vh;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    #user_cart_update form {
        width: 100%;
    }

    #user_cart_update table {
        width: 100%;
        border-collapse: collapse;
    }

    #user_cart_update th,
    #user_cart_update td {
        padding: 12px;
        text-align: left;
        font-size: 16px;
    }

    #user_cart_update th {
        background-color: #ec6b81;
        color: #fff;
        font-weight: 600;
        width: 30%;
    }

    #user_cart_update td {
        background-color: #fff;
    }

    #user_cart_update input[type="number"] {
        width: 100%;
        padding: 6px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    #user_cart_update select {
        padding: 6px;
        font-size: 16px;
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    #user_cart_update input[type="submit"],
    #user_cart_update input[type="reset"],
    table a {
        padding: 10px 20px;
        font-size: 16px;
        color: #fff;
        background-color: #ec6b81;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #user_cart_update input[type="reset"] {
        background-color: orange;
    }

    table a {
        background-color: black;
    }

    #user_cart_update input[type="submit"]:hover {
        background-color: red;
    }
</style>

<body>
    <?php require_once './php/head.php'; ?>
    <div id="user_cart_update">
        <form action="" method="POST">
            <table>
                <tr>
                    <th>Sản phẩm</th>
                    <td style="font-weight: bold;"><?php echo $cart_product->getName() ?></td>
                </tr>
                <tr>
                    <th>Loại</th>
                    <td>
                        <select name="product_item">
                            <?php
                            foreach ($productsItem as $item) {
                                if ($item->getAttributes() == $cart_productsItem->getAttributes()) {
                                    echo "<option value='" . $item->getId() . "' selected>" . $item->getAttributes() . "</option>";
                                } else {
                                    echo "<option value='" . $item->getId() . "'>" . $item->getAttributes() . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Số lượng</th>
                    <td>
                        <input name="quantity" type="number" min="1" max="<?php echo $cart_productsItem->getCount() ?>" value="<?php echo $this_cart[0][2]; ?>">
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="Lưu">
                        <input type="reset" value="Hủy">
                        <a href="./user_cart.php">Thoát</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <?php require_once "./php/footer.php" ?>
</body>

</html>