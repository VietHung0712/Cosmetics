<?php
require_once "../php/connect.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM flash_deal WHERE id = $id";
    $result = mysqli_query($connect, $sql);
    mysqli_close($connect);
    if ($result) {
        header("Location: ./admin_flashdeal.php");
        exit();
    } else {
        echo "<script>alert('Đã có lỗi!')</script>";
    }
}
?>