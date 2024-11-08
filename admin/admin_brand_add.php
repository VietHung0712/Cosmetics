<?php
require_once "../php/connect.php";
require_once "../php/class.php";
require_once "../php/Manager_Products.php";
require_once "../php/Manager_Categories.php";
require_once "../php/Manager_Brands.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $icon_url = $_POST['icon_url'];
    $background_url = $_POST['background_url'];
    $theme_url = $_POST['theme_url'];

    $sql = "INSERT INTO brand VALUES ('', ?, ?, ?, ?, ?, ?)";
    $result = mysqli_prepare($connect, $sql);
    if ($result) {
        $result->bind_param("ssssss", $name, $address, $phone, $icon_url, $background_url, $theme_url);
        if ($result->execute()) {
            header("Location: ./admin_brand.php");
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
        max-width: 800px;
        margin: auto;
        padding: 20px;
        font-family: Arial, sans-serif;
        margin-top: 10vh;
    }

    #main table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    #main th,
    #main td {
        padding: 10px;
        text-align: left;
    }

    #main th {
        width: 150px;
        background-color: #f2f2f2;
        font-weight: bold;
    }

    #main td {
        background-color: #fdfdfd;
    }

    #main input[type="text"],
    #main input[type="tel"],
    #main input[type="file"],
    #main input[type="number"],
    #main input[type="submit"],
    #main select,
    #main input[type="reset"] {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    #main input[type="file"] {
        padding: 4px;
    }

    #main input[type="submit"],
    #main input[type="reset"] {
        width: auto;
        padding: 8px 16px;
        margin-right: 10px;
        background-color: #ec6b81;
        border: none;
        color: white;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    #main input[type="submit"]:hover,
    #main input[type="reset"]:hover {
        background-color: #d55c6d;
    }

    #main img {
        max-width: 150px;
        height: auto;
        margin-top: 10px;
    }

    #main a {
        display: inline-block;
        background-color: black;
        color: #fff;
        padding: 10px;
        text-decoration: none;
        border-radius: 4px;
        margin-top: 10px;
        transition: background-color 0.3s;
    }

    #main a:hover {
        background-color: #333;
    }

    #main caption {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }
</style>

<body>
    <?php require_once "./admin_header.php"; ?>
    <div id="main">
        <form action="" method="POST">
            <table>
                <caption>Thêm mới thương hiệu</caption>
                <tr>
                    <th>Tên thương hiệu</th>
                    <td>
                        <input type="text" name="name" required>
                    </td>
                </tr>
                <tr>
                    <th>Địa chỉ</th>
                    <td>
                        <select name="address">
                            <option value="Anh">Anh</option>
                            <option value="Australia">Australia</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Canada">Canada</option>
                            <option value="Đức">Đức</option>
                            <option value="Hoa Kỳ">Hoa Kỳ</option>
                            <option value="Hàn Quốc">Hàn Quốc</option>
                            <option value="Italy">Italy</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Nga">Nga</option>
                            <option value="Nhật Bản">Nhật Bản</option>
                            <option value="Pháp">Pháp</option>
                            <option value="Tây Ban Nha">Tây Ban Nha</option>
                            <option value="Thổ Nhĩ Kỳ">Thổ Nhĩ Kỳ</option>
                            <option value="Trung Quốc">Trung Quốc</option>
                            <option value="Việt Nam">Việt Nam</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Điện thoại</th>
                    <td>
                        <input type="tel" name="phone" placeholder="Nhập số điện thoại" pattern="^(03|05|07|08|09)\d{8}$" required>
                    </td>
                </tr>
                <tr>
                    <th>Ảnh đại diện</th>
                    <td>
                        <input type="file" name="" class="imageiconFile">
                        <input type="text" name="icon_url" class="imageiconInput" readonly>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <img src="" alt="" class="imageiconSRC">
                    </td>
                </tr>
                <tr>
                    <th>Ảnh nền</th>
                    <td>
                        <input type="file" name="" class="imagebackgroundFile">
                        <input type="text" name="background_url" class="imagebackgroundInput" readonly>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <img src="" alt="" class="imagebackgroundSRC">
                    </td>
                </tr>
                <tr>
                    <th>Ảnh bìa</th>
                    <td>
                        <input type="file" name="" class="imagethemeFile">
                        <input type="text" name="theme_url" class="imagethemeInput" readonly>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <img src="" alt="" class="imagethemeSRC">
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
        <a style="background-color: black; color: #fff; padding: 10px;" href="./admin_brand.php">Quay lại</a>
    </div>
</body>

</html>

<script src="../js/function.js"></script>
<script>
    $('.imageiconFile').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const fileName = "./images/" + file.name;
            $('.imageiconSRC').src = "." + fileName;
            $('.imageiconInput').value = fileName;
        }
    });
    $('.imagebackgroundFile').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const fileName = "./images/" + file.name;
            $('.imagebackgroundSRC').src = "." + fileName;
            $('.imagebackgroundInput').value = fileName;
        }
    });
    $('.imagethemeFile').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const fileName = "./images/" + file.name;
            $('.imagethemeSRC').src = "." + fileName;
            $('.imagethemeInput').value = fileName;
        }
    });
</script>