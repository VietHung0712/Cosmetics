<?php
require_once "../php/connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $displayname = $_POST['displayname'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $birthday = $_POST['birthday'];
    $image_url = $_POST['image_url'];

    $sql = "INSERT INTO user VALUES('', '$displayname', '$username', '$password', '$gender', '$address', '$phone', '$birthday', '$image_url')";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        header("Location: ../sign-in.php");
        exit();
    } else {
        echo "<script>
                    alert('Đăng kí không thành công!');
                </script>";
    }
}
