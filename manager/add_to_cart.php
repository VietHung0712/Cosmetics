<?php
require_once "../php/connect.php";
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_GET['product_id'];
    $sql = "INSERT INTO user_cart VALUES ('', ?, ?, ?)";
    $result = mysqli_prepare($connect, $sql);
    if ($result) {
        $result->bind_param("iss", $user_id, $_POST['attributes'], $_POST['quantity']);
        if ($result->execute()) {
            header("Location: ../user_cart.php");
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
