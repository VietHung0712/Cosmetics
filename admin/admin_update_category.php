<?php
require_once "../php/connect.php";
$id = $name = "";
if (isset($_GET['id']) && isset($_GET['name'])) {
    $id = $_GET['id'];
    $name = $_GET['name'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $sql = "UPDATE categories SET name = ? WHERE id = ?";
        $result = mysqli_prepare($connect, $sql);
        if ($result) {
            $result->bind_param("si", $name, $id);
            if ($result->execute()) {
                header("Location: ./admin_add_category.php");
                exit();
            } else {
                echo "<script>alert('Đã có lỗi!')</script>";
            }
            $result->close();
        } else {
            echo "<script>alert('Không thể chuẩn bị truy vấn!')</script>";
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
    #main {
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
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
    }

    td {
        padding: 12px;
        color: #555;
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

    input[type="submit"] {
        background-color: #ec6b81;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #ff6f81;
    }

    a {
        color: #ec6b81;
        text-decoration: none;
        padding: 5px 10px;
        border: 1px solid #ec6b81;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
    }

    a:hover {
        background-color: #ec6b81;
        color: white;
    }
</style>

<body>
    <div id="main">
        <form action="" method="POST">
            <table>
                <caption>Sửa Thể Loại</caption>
                <tr>
                    <th>#</th>
                    <td>
                        <?php echo $id; ?>
                    </td>
                </tr>
                <tr>
                    <th>Tên thể loại</th>
                    <td>
                        <input type="text" name="name" value="<?php echo $name ?>">
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="Lưu">
                        <a href="./admin_add_category.php">Quay lại</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>