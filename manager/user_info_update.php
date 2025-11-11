<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "../php/connect.php";

    $user_id = $_SESSION['user_id'];
    $displayname = $_POST['displayname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];
    $phone = $_POST['phone'];

    $sql = "UPDATE user SET displayname = '$displayname',
    username = '$username',
    password = '$password',
    gender = '$gender',
    address = '$address',
    birthday = '$birthday',
    phone = '$phone' WHERE id = $user_id";

    $result = mysqli_query($connect, $sql);
    if ($result) {
        header("Location: ../profile.php");
        exit();
    }
}
