<?php
require_once "../php/connect.php";
require_once "../php/class.php";
require_once "../php/function.php";
require_once "../php/Manager_Products.php";
require_once "../php/Manager_FlashDeal.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = $_POST['product'];
    $discount = $_POST['discount'];
    $time = $_POST['time'];

    $starttime = explode("/", $time)[0];
    $endtime = explode("/", $time)[1];

    $sql = "INSERT INTO flash_deal VALUES ('', ?, ?, ?, ?)";
    $result = mysqli_prepare($connect, $sql);
    if ($result) {
        $result->bind_param("iiss", $product, $discount, $starttime, $endtime);
        if ($result->execute()) {
            header("Location: ./admin_flashdeal.php");
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
        max-width: 70%;
        margin: 0 auto;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 10vh;

        a {
            display: inline-block;
            padding: 10px 15px;
            background-color: #ec6b81;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #d8586f;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            font-weight: bold;
            color: #333;
            width: 30%;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            border-color: #ec6b81;
            outline: none;
        }

        input[type="submit"],
        input[type="reset"] {
            padding: 10px 15px;
            margin-right: 10px;
            background-color: #ec6b81;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #d8586f;
        }

        input[type="reset"] {
            background-color: #f08fa1;
        }

        input[type="reset"]:hover {
            background-color: #d8586f;
        }
    }
</style>

<body>
    <?php require_once "./admin_header.php"; ?>
    <div id="main">
        <a href="./admin_flashdeal.php">Quay lại</a>
        <form action="" method="POST">
            <table>
                <caption>Thêm mới</caption>
                <tr>
                    <th>Sản phẩm</th>
                    <td>
                        <select name="product">
                            <?php foreach ($products as $item) { ?>
                                <option value="<?php echo $item->getId(); ?>"><?php echo $item->getName(); ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Giảm giá</th>
                    <td>
                        <input type="number" name="discount">
                    </td>
                </tr>
                <tr>
                    <th>Thời gian</th>
                    <td>
                        <select name="time">
                            <option value="00:00:00/03:00:00">00:00:00 - 03:00:00</option>
                            <option value="03:00:00/06:00:00">03:00:00 - 06:00:00</option>
                            <option value="06:00:00/09:00:00">06:00:00 - 09:00:00</option>
                            <option value="09:00:00/12:00:00">09:00:00 - 12:00:00</option>
                            <option value="12:00:00/15:00:00">12:00:00 - 15:00:00</option>
                            <option value="15:00:00/18:00:00">15:00:00 - 18:00:00</option>
                            <option value="18:00:00/21:00:00">18:00:00 - 21:00:00</option>
                            <option value="21:00:00/24:00:00">21:00:00 - 24:00:00</option>
                        </select>
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
    </div>
</body>

</html>