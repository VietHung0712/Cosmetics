<?php
require_once "../php/connect.php";
require_once "../php/class.php";
require_once "../php/function.php";
require_once "../php/Manager_Products.php";
require_once "../php/Manager_FlashDeal.php";
require_once "../php/Manager_Categories.php";
require_once "../php/Manager_Brands.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVE - Admin</title>
</head>
<style>
    #product {
        display: flex;
        width: 100%;
        padding: 20px;
        box-sizing: border-box;
        margin-top: 10vh;

        .leftMenu {
            position: fixed;
            width: 15vw;
            padding: 15px;
            background-color: #ec6b81;
            color: #fff;
            border-radius: 10px;
            margin-right: 20px;
            box-shadow: 0 4px 10px rgba(236, 107, 129, 0.2);
        }

        .leftMenu a {
            display: block;
            padding: 12px 15px;
            background-color: #ff9aa2;
            color: black;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 10px;
            font-size: 16px;
            text-align: center;
            transition: background-color 0.3s, color 0.3s, transform 0.2s;
        }

        .leftMenu a:hover {
            background-color: #ff6f81;
            color: #fff;
            transform: translateY(-2px);
        }

        form {
            flex: 1;
            margin-left: 20vw;

        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table caption {
            font-size: 1.5em;
            font-weight: bold;
            padding: 10px;
            background-color: #ec6b81;
            color: white;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ec6b81;
        }

        table th {
            background-color: #ff9aa2;
            color: white;
        }

        table td {
            color: #333;
        }

        table td img {
            width: 8vw;
            height: 8vw;
            object-fit: contain;
            border-radius: 4px;
        }

        table td a {
            color: #ec6b81;
            text-decoration: none;
            font-size: 1.5vw;
            border: 1px solid #ec6b81;
            border-radius: 5px;
            background-color: transparent;
            transition: background-color 0.3s, color 0.3s;
            text-wrap: nowrap;
        }

        table td a:hover {
            background-color: #ec6b81;
            color: white;
        }
    }
</style>

<body>
    <?php require_once "./admin_header.php"; ?>
    <div id="product">
        <div class="leftMenu">
            <a href="./admin_product_add.php">Thêm mới sản phẩm</a>
            <a href="./admin_flashdeal.php">Mục giảm giá</a>
            <a href="./admin_add_category.php">Cập nhật thể loại</a>
        </div>
        <form action="" method="POST">
            <table>
                <caption>Sản phẩm</caption>
                <thead>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Thể loại</th>
                    <th>Thương hiệu</th>
                    <th>Mô tả</th>
                    <th>Ảnh bìa</th>
                    <th>Thao tác</th>
                </thead>
                <tbody>
                    <?php
                    if (isset($products)) {
                        foreach ($products as $item) {
                    ?>
                            <tr>
                                <td><?php echo $item->getID(); ?></td>
                                <td><?php echo $item->getName(); ?></td>
                                <td><?php echo getIdToName($categoriesArr, $item->getCategories()); ?></td>
                                <td><?php echo getIdToName($brandArr, $item->getBrand()); ?></td>
                                <td>
                                    <p><?php echo $item->getReview(); ?></p>
                                </td>
                                <td>
                                    <img src="../<?php echo $item->getImageUrl(); ?>" alt="">
                                </td>
                                <td>
                                    <ul>
                                        <li><a href="./admin_product_update.php?product=<?php echo $item->getID(); ?>">Cập nhật</a></li>
                                        <li><a href="./admin_product_item.php?product=<?php echo $item->getID(); ?>">Loại</a></li>
                                        <li><a href="./admin_product_delete.php?product=<?php echo $item->getID(); ?>" onclick="return confirm('Bạn có chắc chắn xóa không?')">Xóa</a></li>
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
        </form>
    </div>
</body>

</html>