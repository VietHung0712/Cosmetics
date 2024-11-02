<?php

use ClassProject\Brand;

require_once "../php/connect.php";
require_once "../php/class.php";
require_once "../php/Manager_Brands.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql_select = "SELECT * FROM brand WHERE id = $id";
    $result_select = mysqli_query($connect, $sql_select);
    if ($result_select->num_rows > 0) {
        while ($row = $result_select->fetch_assoc()) {
            $this_brand = new Brand($row['id'], $row['name'], $row['address'], $row['phone'], $row['icon_url'], $row['background_url'], $row['theme_url']);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $icon_url = $_POST['icon_url'];
        $background_url = $_POST['background_url'];
        $theme_url = $_POST['theme_url'];

        $sql = "UPDATE brand SET name = '$name', address = '$address', phone = '$phone', icon_url = '$icon_url', background_url = '$background_url', theme_url = '$theme_url' WHERE id = $id";
        $result = mysqli_query($connect, $sql);
        if ($result) {
            header("Location: ./admin_brand.php");
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
        margin: auto;
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    #main table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
        color: #333;
    }

    #main td {
        background-color: #fdfdfd;
    }

    #main input[type="text"],
    #main input[type="tel"],
    #main input[type="file"],
    #main select {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    #main input[type="submit"],
    #main input[type="reset"],
    #main a {
        padding: 8px 16px;
        background-color: #ec6b81;
        border: none;
        color: white;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s;
        text-decoration: none;
        margin-right: 10px;
        display: inline-block;
    }

    #main input[type="submit"]:hover,
    #main input[type="reset"]:hover,
    #main a:hover {
        background-color: #d55c6d;
    }

    #main img {
        max-width: 150px;
        height: auto;
        margin-top: 10px;
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
                <tr>
                    <th>Tên sản phẩm</th>
                    <td>
                        <input type="text" name="name" value="<?php echo $this_brand->getName() ?>" required>
                    </td>
                </tr>
                <tr>
                    <th>Địa chỉ</th>
                    <td>
                        <select value="<?php echo $this_brand->getAddress() ?>" name="address" class="address">
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
                        <input type="tel" name="phone" placeholder="Nhập số điện thoại" pattern="^(03|05|07|08|09)\d{8}$" required value="<?php echo $this_brand->getPhone(); ?>">
                    </td>
                </tr>
                <tr>
                    <th>Ảnh đại diện</th>
                    <td>
                        <input type="file" class="iconFile">
                        <input type="text" class="iconInput" name="icon_url" value="<?php echo $this_brand->getIconUrl() ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <img src=".<?php echo $this_brand->getIconUrl() ?>" alt="" class="iconSRC">
                    </td>
                </tr>
                <tr>
                    <th>Ảnh nền</th>
                    <td>
                        <input type="file" class="backgroundFile">
                        <input type="text" class="backgroundInput" name="background_url" value="<?php echo $this_brand->getBackgroundUrl() ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <img src=".<?php echo $this_brand->getBackgroundUrl() ?>" alt="" class="backgroundSRC">
                    </td>
                </tr>
                <tr>
                    <th>Ảnh bìa</th>
                    <td>
                        <input type="file" class="themeFile">
                        <input type="text" class="themeInput" name="theme_url" value="<?php echo $this_brand->getThemeUrl() ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <img src=".<?php echo $this_brand->getThemeUrl() ?>" alt="" class="themeSRC">
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="Thay đổi">
                        <input type="reset" value="Hủy">
                        <a href="./admin_brand.php">Quay lại</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>
<script src="../js/function.js"></script>
<script>
    let selectedValue = '<?php echo $this_brand->getAddress(); ?>';
    $(".address").value = selectedValue;

    $('.iconFile').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const fileName = "./images/" + file.name;
            $('.iconSRC').src = "." + fileName;
            $('.iconInput').value = fileName;
        }
    });
    $('.backgroundFile').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const fileName = "./images/" + file.name;
            $('.backgroundSRC').src = "." + fileName;
            $('.backgroundInput').value = fileName;
        }
    });
    $('.themeFile').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const fileName = "./images/" + file.name;
            $('.themeSRC').src = "." + fileName;
            $('.themeInput').value = fileName;
        }
    });
</script>