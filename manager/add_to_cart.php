<?php
require_once "../php/connect.php";
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_GET['product_id'];
    $sql_add =
        "INSERT INTO user_cart (id, user, product_item, quantity) VALUES
            ('',
            $user_id,
            '" . $_POST['attributes'] . "',
            " . $_POST['quantity'] . ")";
    echo $sql_add;
    $result = mysqli_query($connect, $sql_add);
    if ($result) {
        header("Location: ../user_cart.php");
        exit();
    } else {
        echo "<script>
                    alert('Thêm không thành công!');
                </script>";
    }
}
