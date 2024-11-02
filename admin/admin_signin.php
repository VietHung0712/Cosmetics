<?php
require_once "../php/connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM administrator WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($connect, $sql);
    if ($result->num_rows > 0) {
        header("Location: ./admin.php");
        exit();
    } else {
        echo "<script>alert('Sai tài khoản hoặc mật khẩu!')</script>";
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

<body>
    <div id="main">
        <form action="" method="POST">
            <table>
                <caption>Đăng nhập quản trị viên</caption>
                <tr>
                    <th>Tài khoản</th>
                    <td>
                        <input type="text" name="username" required>
                    </td>
                </tr>
                <tr>
                    <th>Mật khẩu</th>
                    <td>
                        <input type="password" name="password" required>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="Đăng nhập">
                        <input type="reset" value="Nhập lại">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>
<style>
    /* Đặt nền cho toàn trang */
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
        background-color: #f5f5f5;
        font-family: Arial, sans-serif;
    }

    #main {
        width: 400px;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    #main table {
        width: 100%;
        border-collapse: collapse;
    }

    #main caption {
        font-size: 20px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
        text-align: center;
    }

    #main th,
    #main td {
        padding: 10px;
        text-align: left;
    }

    #main th {
        width: 100px;
        font-weight: bold;
        color: #666;
    }

    #main input[type="text"],
    #main input[type="password"] {
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }

    #main input[type="submit"],
    #main input[type="reset"] {
        width: 48%;
        padding: 10px;
        font-size: 14px;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-right: 4%;
        box-sizing: border-box;
    }

    #main input[type="submit"] {
        background-color: #4CAF50;
    }

    #main input[type="submit"]:hover {
        background-color: #43a047;
    }

    #main input[type="reset"] {
        background-color: #f44336;
    }

    #main input[type="reset"]:hover {
        background-color: #e53935;
    }
</style>