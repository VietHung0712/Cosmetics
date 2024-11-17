<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "./php/connect.php";
    $email = $_POST['email'];
    $password = $_POST['password'];
    mysqli_close($connect);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up | EVE</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #container {
        margin-top: 13vh;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 50%;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 10px;
        text-align: left;

        img {
            height: 100px;
            width: 100px;
            object-fit: contain;
        }
    }

    th {
        width: 30%;
        background-color: #ec6b81;
        color: #fff;
    }

    td {
        background-color: #f2f2f2;
        border-radius: 4px;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="date"],
    input[type="file"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input[type="submit"] {
        background-color: #ec6b81;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #d55b70;
    }

    a {
        display: inline-block;
        margin-top: 10px;
        color: #ec6b81;
        text-decoration: none;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

<body>
    <div id="container">
        <form action="./manager/sign-up_add.php" method='POST'>
            <table>
                <tr>
                    <th>Email(Tên tài khoản)</th>
                    <td>
                        <input type="email" name="username" readonly value="<?php echo $email ?>">
                        <input type="hidden" name="password" value="<?php echo $password ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <th>Tên hiển thị</th>
                    <td><input type="text" name="displayname" required></td>
                </tr>
                <tr>
                    <th>Giới tính</th>
                    <td>
                        <input type="radio" name="gender" value="Nam" checked>Nam
                        <input type="radio" name="gender" value="Nữ">Nữ
                    </td>
                </tr>
                <tr>
                    <th>Địa chỉ</th>
                    <td><input type="text" name="address" required></td>
                </tr>
                <tr>
                    <th>Điện thoại</th>
                    <td><input type="tel" id="phone" name="phone" required pattern="^0[0-9]{9}$" placeholder="Nhập 10 chữ số"></td>
                </tr>
                <tr>
                    <th>Ngày sinh</th>
                    <td><input type="date" name="birthday" required></td>
                </tr>
                <tr>
                    <th>Ảnh đại diện</th>
                    <td>
                        <input type="file" name="" id="imageFile" required>
                        <input type="text" name="image_url" id="imageInput" readonly>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td><img src="" alt="Ảnh đại diện" id="imagePreview" style="max-width: 200px;"></td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="Đăng kí">
                        <a href="./sign-up.php">Quay lại</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>

<script src="./js/function.js"></script>
<script>
    $('#imageFile').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const fileName = "./images/" + file.name;
            $('#imagePreview').src = fileName;
            $('#imageInput').value = fileName;
        }
    });
</script>