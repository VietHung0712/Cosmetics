<?php
require_once "../php/connect.php";
require_once "../php/class.php";
require_once "../php/function.php";
require_once "../php/Manager_Products.php";
require_once "../php/Manager_FlashDeal.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $this_flashDeal;
    foreach ($flashDeals as $item) {
        if ($id == $item->getID()) {
            $this_flashDeal = $item;
        }
    }
    $this_time = $this_flashDeal->getStartTime() . "/" . $this_flashDeal->getEndTime();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $discount = $_POST['discount'];
        $time = $_POST['time'];

        $starttime = explode("/", $time)[0];
        $endtime = explode("/", $time)[1];

        $sql = "UPDATE flash_deal SET discount = $discount, starttime = '$starttime', endtime = '$endtime' WHERE id = $id";
        $result = mysqli_query($connect, $sql);
        if ($result) {
            header("Location: ./admin_flashdeal.php");
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
                <tr>
                    <th>Sản phẩm</th>
                    <td>
                        <input type="text" value="<?php echo $this_flashDeal->getName(); ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <th>Giảm giá</th>
                    <td>
                        <input type="number" name="discount" value="<?php echo $this_flashDeal->getDiscount(); ?>" required>
                    </td>
                </tr>
                <tr>
                    <th>Thời gian</th>
                    <td>
                        <select name="time">
                            <option value="00:00:00/03:00:00" <?php if ($this_time == '00:00:00/03:00:00') echo 'selected'; ?>>00:00:00 - 03:00:00</option>
                            <option value="03:00:00/06:00:00" <?php if ($this_time == '03:00:00/06:00:00') echo 'selected'; ?>>03:00:00 - 06:00:00</option>
                            <option value="06:00:00/09:00:00" <?php if ($this_time == '06:00:00/09:00:00') echo 'selected'; ?>>06:00:00 - 09:00:00</option>
                            <option value="09:00:00/12:00:00" <?php if ($this_time == '09:00:00/12:00:00') echo 'selected'; ?>>09:00:00 - 12:00:00</option>
                            <option value="12:00:00/15:00:00" <?php if ($this_time == '12:00:00/15:00:00') echo 'selected'; ?>>12:00:00 - 15:00:00</option>
                            <option value="15:00:00/18:00:00" <?php if ($this_time == '15:00:00/18:00:00') echo 'selected'; ?>>15:00:00 - 18:00:00</option>
                            <option value="18:00:00/21:00:00" <?php if ($this_time == '18:00:00/21:00:00') echo 'selected'; ?>>18:00:00 - 21:00:00</option>
                            <option value="21:00:00/24:00:00" <?php if ($this_time == '21:00:00/24:00:00') echo 'selected'; ?>>21:00:00 - 24:00:00</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="Lưu">
                        <input type="reset" value="Nhập lại">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>