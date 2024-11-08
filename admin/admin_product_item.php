<?php
require_once "../php/connect.php";
require_once "../php/class.php";

use ClassProject\ProductItem;

if (isset($_GET['product'])) {
    $productID = $_GET['product'];

    $sql = "SELECT * FROM product_item WHERE product = $productID";
    $result = mysqli_query($connect, $sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $this_productsItem = new ProductItem($row['id'], $row['product'], $row['attributes'], $row['price'], $row['count']);
            $this_productsItems[] = $this_productsItem;
        }
    }

    $sql_image = "SELECT * FROM product_image WHERE product = $productID";
    $result_image = mysqli_query($connect, $sql_image);
    if ($result_image->num_rows > 0) {
        while ($row = $result_image->fetch_assoc()) {
            $this_image = [$row['id'], $row['image_url']];
            $this_images[] = $this_image;
        }
    }
}
mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVE - Admin</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    #main {
        max-width: 900px;
        margin: 0 auto;
        margin-top: 10vh;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    caption {
        font-size: 1.5em;
        font-weight: bold;
        padding: 10px;
        background-color: #ec6b81;
        color: white;
        border-radius: 5px;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f8f8f8;
        color: #333;
    }

    td {
        background-color: #fff;
        color: #555;
        border: 1px solid #ececec;
    }

    input[type="text"],
    input[type="number"],
    input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ec6b81;
        border-radius: 5px;
        box-sizing: border-box;
        margin-top: 5px;
        margin-bottom: 15px;
        transition: border-color 0.3s;
    }

    input[type="text"]:focus,
    input[type="number"]:focus {
        border-color: #ff9aa2;
        outline: none;
    }

    input[type="submit"],
    input[type="reset"] {
        background-color: #ec6b81;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover,
    input[type="reset"]:hover {
        background-color: #ff6f81;
    }

    img {
        max-width: 100px;
        height: auto;
        border: 1px solid #ececec;
        border-radius: 5px;
        margin-top: 5px;
    }
</style>

<body>
    <?php require_once "./admin_header.php"; ?>
    <div id="main">
        <a style="background-color: #ec6b81; color: white; padding: 5px;" href="./admin_product.php">Quay lại</a>

        <div id="product_item">
            <form action="./admin_product_item_add.php?product=<?php echo $productID; ?>" method="POST">
                <table>
                    <caption>Thêm loại mới</caption>
                    <tr>
                        <th>Tên loại</th>
                        <td>
                            <input type="text" name="attributes" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Giá</th>
                        <td>
                            <input type="number" name="price" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Số lượng</th>
                        <td>
                            <input type="number" name="count" required>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="Thêm">
                            <input type="reset" value="Hủy">
                        </td>
                    </tr>
                </table>
            </form>
            <table>
                <caption>Loại mặt hàng</caption>
                <thead>
                    <th>Tên loại</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php if (isset($this_productsItems)) { ?>
                        <?php foreach ($this_productsItems as $item) { ?>
                            <tr>
                                <td><?php echo $item->getAttributes(); ?></td>
                                <td><?php echo $item->getPrice(); ?></td>
                                <td><?php echo $item->getCount(); ?></td>
                                <td>
                                    <a href="admin_product_item_delete.php?id=<?php echo $item->getId(); ?>&product=<?php echo $productID; ?>" onclick="return confirm('Bạn có chắc chắn xóa không?')">Xóa</a>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>

        <div id="product_image">
            <form action="./admin_product_image_add.php?product=<?php echo $productID; ?>" method="POST">
                <table>
                    <caption>Thêm ảnh mô tả mới</caption>
                    <tr>
                        <th>Chọn ảnh</th>
                        <td class="selectImg">
                            <input type="file" name="" required>
                        </td>
                    </tr>
                    <tr class="selectImg">
                        <th></th>
                        <td><input type="text" name="image_url" readonly></td>
                    </tr>
                    <tr class="selectImg">
                        <th></th>
                        <td><img src="" alt=""></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="Thêm">
                            <input type="reset" value="Hủy">
                        </td>
                    </tr>
                </table>
            </form>
            <table>
                <caption>Các ảnh mô tả</caption>
                <thead>
                    <th>Ảnh mô tả</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php if (isset($this_images)) { ?>
                        <?php foreach ($this_images as $item) { ?>
                            <tr>
                                <td>
                                    <img src="../<?php echo $item[1]; ?>" alt="">
                                </td>
                                <td><a href="admin_product_image_delete.php?id=<?php echo $item[0]; ?>&product=<?php echo $productID; ?>" onclick="return confirm('Bạn có chắc chắn xóa không?')">Xóa</a></td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
<script src="../js/function.js"></script>
<script>
    $('.selectImg input[type=file]').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const fileName = "./images/" + file.name;
            $('.selectImg img').src = "." + fileName;
            $('.selectImg input[type=text]').value = fileName;
        }
    });
</script>