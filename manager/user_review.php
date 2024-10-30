<?php
require_once "../php/connect.php";

date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();
$user_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['this_product'])) {
        $this_product = $_GET['this_product'];
        $rating = $_POST['rating'];
        $text = $_POST['text'];

        $sql = "INSERT INTO user_reviews VALUES('', " . $this_product . ", " . $user_id . ", " . $rating . ", '" . $text . "', '" . date('Y-m-d H:i:s') . "')";
        $result = mysqli_query($connect, $sql);
        if ($result) {
            header("Location: ../product_select.php?this_product=" . $this_product);
            exit();
        }
    }
}
