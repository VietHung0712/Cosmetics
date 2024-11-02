<?php
require_once "../php/connect.php";
require_once "../php/class.php";
require_once "../php/function.php";
require_once "../php/Manager_Products.php";
require_once "../php/Manager_FlashDeal.php";

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
            margin-right: 10px;
        }

        a:hover {
            background-color: #d8586f;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        caption {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #333;
            font-weight: bold;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            font-weight: bold;
            color: #333;
            background-color: #f1f1f1;
        }

        td {
            color: #555;
        }

        td ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        td ul li {
            display: inline;
            margin-right: 10px;
        }

        td ul li a {
            padding: 5px 10px;
            background-color: #ec6b81;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        td ul li a:hover {
            background-color: #d8586f;
        }

        input[type="submit"],
        input[type="reset"] {
            padding: 10px 15px;
            background-color: #ec6b81;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #d8586f;
        }
    }
</style>

<body>
    <?php require_once "./admin_header.php"; ?>
    <div id="main">
        <a href="./admin_product.php">Quay lại</a>
        <a href="./admin_flashdeal_add.php">Thêm mới</a>
        <table>
            <caption>Danh mục giảm giá</caption>
            <thead>
                <th>Mã</th>
                <th>Sản phẩm</th>
                <th>Giảm</th>
                <th>Bắt đầu</th>
                <th>Kết thúc</th>
                <th>Thao tác</th>
            </thead>
            <tbody>
                <?php
                if (isset($flashDealAll)) {
                    foreach ($flashDealAll as $index => $item) {
                ?>
                        <tr>
                            <td><?php echo $flashDealIdAll[$index]; ?></td>
                            <td><?php echo $item->getName(); ?></td>
                            <td><?php echo $item->getDiscount(); ?></td>
                            <td><?php echo $item->getStartTime(); ?></td>
                            <td><?php echo $item->getEndTime(); ?></td>
                            <td>
                                <ul>
                                    <li><a href="./admin_flashdeal_update.php?id=<?php echo $flashDealIdAll[$index]; ?>">Cập nhật</a></li>
                                    <li><a href="./admin_flashdeal_delete.php?id=<?php echo $flashDealIdAll[$index]; ?>" onclick="return confirm('Bạn có chắc chắn xóa không?')">Xóa</a></li>
                                </ul>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='7'>Không có dữ liệu</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>