<?php
require_once "../php/connect.php";
require_once "../php/class.php";
require_once "../php/Manager_Products.php";
require_once "../php/Manager_Categories.php";
require_once "../php/Manager_Brands.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $categories = $_POST['categories'];
    $brand = $_POST['brand'];
    $review = $_POST['review'];
    $imageURL = $_POST['image_url'];

    $sql = "INSERT INTO product VALUES ('', ?, ?, ?, ?, ?)";
    $result = mysqli_prepare($connect, $sql);
    if ($result) {
        $result->bind_param("siiss", $name, $categories, $brand, $review, $imageURL);
        if ($result->execute()) {
            header("Location: ./admin_product.php");
            exit();
        } else {
            echo "<script>alert('Đã có lỗi!')</script>";
        }
        $result->close();
    } else {
        echo "<script>alert('Không thể chuẩn bị truy vấn!')</script>";
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
    #main {
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 10vh;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table caption {
        font-size: 1.5em;
        font-weight: bold;
        padding: 10px;
        background-color: #ec6b81;
        color: white;
        border-radius: 8px;
    }

    th {
        text-align: left;
        padding: 12px;
        width: 25%;
        color: #333;
    }

    td {
        padding: 12px;
        color: #555;
    }

    input[type="text"],
    select,
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ec6b81;
        border-radius: 5px;
        box-sizing: border-box;
        transition: border-color 0.3s;
    }

    input[type="text"]:focus,
    select:focus,
    textarea:focus {
        border-color: #ff9aa2;
        outline: none;
    }

    textarea {
        height: 100px;
    }

    .imageFile {
        margin-bottom: 10px;
    }

    .imageInput {
        width: calc(100% - 20px);
        margin-top: 10px;
    }

    .imageSRC {
        max-width: 50%;
        height: auto;
        margin-top: 10px;
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
        margin-right: 10px;
    }

    input[type="submit"]:hover,
    input[type="reset"]:hover {
        background-color: #ff6f81;
    }
</style>

<body>
    <?php require_once "./admin_header.php"; ?>
    <div id="main">
        <form action="" method="POST">
            <table>
                <caption>Thêm mới sản phẩm</caption>
                <tr>
                    <th>Tên sản phẩm</th>
                    <td>
                        <input type="text" name="name" required>
                    </td>
                </tr>
                <tr>
                    <th>Thể loại</th>
                    <td>
                        <select name="categories">
                            <?php foreach ($categoriesArr as $item) { ?>
                                <option value="<?php echo $item->getId(); ?>"><?php echo $item->getName(); ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Thương hiệu</th>
                    <td>
                        <select name="brand">
                            <?php foreach ($brandArr as $item) { ?>
                                <option value="<?php echo $item->getId(); ?>"><?php echo $item->getName(); ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Mô tả</th>
                    <td>
                        <textarea name="review"></textarea>
                    </td>
                </tr>
                <tr>
                    <th>Ảnh bìa</th>
                    <td>
                        <input type="file" name="" class="imageFile">
                        <input type="text" name="image_url" class="imageInput" readonly>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <img src="" alt="" class="imageSRC">
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="Thêm">
                        <input type="reset" value="Nhập lại">
                    </td>
                </tr>
            </table>
        </form>
        <a style="background-color: black; color: #fff; padding: 10px;" href="./admin_product.php">Quay lại</a>
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