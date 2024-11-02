<?php
require_once "../php/connect.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM categories WHERE id = $id";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        header("Location: ./admin_add_category.php");
        exit();
    } else {
        echo "<script>alert('Đã có lỗi!')</script>";
    }
}
?>