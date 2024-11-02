<?php

use ClassProject\Product;

require_once "../php/connect.php";
require_once "../php/class.php";
require_once "../php/Manager_Brands.php";
require_once "../php/Manager_Categories.php";

if (isset($_GET['product'])) {
    $product = $_GET['product'];

    $sql_select = "SELECT * FROM product WHERE id = $product";
    $result_select = mysqli_query($connect, $sql_select);
    if ($result_select->num_rows > 0) {
        while ($row = $result_select->fetch_assoc()) {
            $this_product = new Product($row['id'], $row['name'], $row['categories'], $row['brand'], $row['review'], $row['image_url']);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $categories = $_POST['categories'];
        $brand = $_POST['brand'];
        $review = $_POST['review'];
        $image_url = $_POST['image_url'];

        $sql = "UPDATE product SET name = '$name', categories = $categories, brand = $brand, review = '$review', image_url = '$image_url' WHERE id = $product";
        $result = mysqli_query($connect, $sql);
        if ($result) {
            header("Location: ./admin_product.php");
            exit();
        } else {
            echo "<script>alert('Đã có lỗi!')</script>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVE - Admin</title>
</head>
<style>
    #main {
        max-width: 800px;
        margin: 0 auto;
        margin-top: 10vh;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 12px 15px;
        text-align: left;
    }

    th {
        font-weight: bold;
        color: #333;
        width: 30%;
    }

    input[type="text"],
    textarea,
    select {
        width: 100%;
        padding: 8px 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
    }

    input[type="text"]:focus,
    textarea:focus,
    select:focus {
        border-color: #ec6b81;
        outline: none;
    }

    input[type="submit"],
    input[type="reset"],
    a {
        display: inline-block;
        padding: 10px 15px;
        margin-right: 10px;
        background-color: #ec6b81;
        color: #fff;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .imageFile,
    .imageInput {
        width: 48%;
        padding: 8px;
        box-sizing: border-box;
        border-radius: 5px;
    }

    .imageSRC {
        margin-top: 10px;
        max-width: 100px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
</style>

<body>
    <?php require_once "./admin_header.php"; ?>
    <div id="main">
        <form action="" method="POST">
            <table>
                <tr>
                    <th>Tên sản phẩm</th>
                    <td>
                        <input type="text" name="name" value="<?php echo $this_product->getName() ?>" required>
                    </td>
                </tr>
                <tr>
                    <th>Thể loại</th>
                    <td>
                        <select name="categories">
                            <?php foreach ($categoriesArr as $item) { ?>
                                <option value="<?php echo $item->getId(); ?>" <?php if ($this_product->getCategories() == $item->getID()) echo "selected"; ?>><?php echo $item->getName(); ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Thương hiệu</th>
                    <td>
                        <select name="brand">
                            <?php foreach ($brandArr as $item) { ?>
                                <option value="<?php echo $item->getId(); ?>" <?php if ($this_product->getBrand() == $item->getID()) echo "selected"; ?>><?php echo $item->getName(); ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Mô tả</th>
                    <td>
                        <textarea name="review" rows="4" cols="50"><?php echo $this_product->getReview() ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th>Hình ảnh</th>
                    <td>
                        <input type="file" class="imageFile">
                        <input type="text" class="imageInput" name="image_url" value="<?php echo $this_product->getImageUrl() ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <img src=".<?php echo $this_product->getImageUrl() ?>" alt="" class="imageSRC">
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="Thay đổi">
                        <input type="reset" value="Hủy">
                        <a href="./admin_product.php">Quay lại</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>
<script src="../js/function.js"></script>
<script>
    $('.imageFile').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const fileName = "./images/" + file.name;
            $('.imageSRC').src = "." + fileName;
            $('.imageInput').value = fileName;
        }
    });
</script>