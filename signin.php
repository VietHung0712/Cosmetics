<?php
require_once "./php/connect.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $connect->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        
        header("Location: profile.php");
        exit();
    } else {
        echo "<script>alert('Đăng nhập không thành công!');</script>";
    }

    $stmt->close();
    mysqli_close($connect);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <th>User name</th>
                <td>
                    <input type="text" name="username" id="" required>
                </td>
            </tr>
            <tr>
                <th>Password</th>
                <td>
                    <input type="password" name="password" id="" required>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="submit" value="Dang nhap" id="">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>