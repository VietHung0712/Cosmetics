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

    $sql = "INSERT INTO user VALUES('', ?, ?, ?, ?, ?, ?, ?, ?)";
    $result = mysqli_prepare($connect, $sql);
    if ($result) {
        $result->bind_param("ssssssss", $displayname, $username, $password, $gender, $address, $phone, $birthday, $image_url);
        if ($result->execute()) {
            header("Location: ../sign-in.php");
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
