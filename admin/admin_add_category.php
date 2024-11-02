<?php
require_once "../php/connect.php";
require_once "../php/class.php";
require_once "../php/Manager_Categories.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['category'];

    $sql = "INSERT INTO categories VALUES ('','$name')";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        header("Location: ./admin_add_category.php");
        exit();
    } else {
        echo "<script>alert('Đã có lỗi!')</script>";
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
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 10vh;
    }

    input[type="submit"] {
        padding: 2vh 10vw;
        background-color: #fff;
        border: 1px solid #ec6b81;
        margin-bottom: 10vh;
        border-radius: 5px;
        font-weight: bold;
        color: #ec6b81;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ec6b81;
        border-radius: 5px;
        box-sizing: border-box;
        margin-bottom: 15px;
        transition: border-color 0.3s;
    }

    input[type="text"]:focus {
        border-color: #ff9aa2;
        outline: none;
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
    }

    th {
        text-align: left;
        padding: 12px;
        color: #333;
        background-color: #ff9aa2;
    }

    td {
        padding: 12px;
        color: #555;
    }

    table td a {
        color: #ec6b81;
        text-decoration: none;
        padding: 5px 10px;
        border: 1px solid #ec6b81;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
    }

    table td a:hover {
        background-color: #ec6b81;
        color: white;
    }

    tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tbody tr:hover {
        background-color: #ffebee;
    }
</style>

<body>
    <?php require_once "./admin_header.php"; ?>
    <div id="main">
        <a style="background-color: #ec6b81; color: white; padding: 5px;" href="./admin_product.php">Quay lại</a>

        <form action="" method="POST">
            <input type="text" required name="category" placeholder="Nhập tên thể loại cần thêm">
            <input type="submit" value="Thêm">
        </form>
        <table>
            <caption>Thể loại</caption>
            <thead>
                <th>Mã thể loại</th>
                <th>Tên thể loại</th>
                <th>Thao tác</th>
            </thead>
            <tbody>
                <?php foreach ($categoriesArr as $item) { ?>
                    <tr>
                        <td>
                            <?php echo $item->getId(); ?>
                        </td>
                        <td>
                            <?php echo $item->getName(); ?>
                        </td>
                        <td>
                            <a href="admin_delete_category.php?id=<?php echo $item->getId(); ?>">Xóa</a>
                            <a href="admin_update_category.php?id=<?php echo $item->getId(); ?>&name=<?php echo $item->getName(); ?>">Sửa</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>