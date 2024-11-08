<?php
require_once "../php/connect.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM flash_deal WHERE id = ?";
    $result = mysqli_prepare($connect, $sql);
    if ($result) {
        $result->bind_param("i", $id);
        if ($result->execute()) {
            header("Location: ./admin_flashdeal.php");
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
?>