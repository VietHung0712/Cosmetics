<?php
require_once "../php/connect.php";

$user_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['selected'])) {


        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $sql_add_sale = "INSERT INTO sales_invoices VALUES ('', " . $user_id . ", '" . date('Y-m-d H:i:s') . "')";
        $result_add_sale = $connect->query($sql_add_sale);

        if ($result_add_sale) {
            $sql_sales_invoices = "SELECT id FROM sales_invoices ORDER BY id DESC LIMIT 1";
            $result_sales_invoices = $connect->query($sql_sales_invoices);
            if ($result_sales_invoices->num_rows > 0) {
                while ($row = $result_sales_invoices->fetch_assoc()) {
                    $sales_invoices_ID = $row['id'];
                }
                try {
                    foreach ($_POST['selected'] as $index) {
                        $product_item = $_POST['product_item'][$index];
                        $quantity = $_POST['quantity'][$index];
                        $price = $_POST['price'][$index];
                        $user_cart_id = $_POST['user_cart_id'][$index];

                        $sql_add_item = "INSERT INTO sales_invoice_items VALUES ('', " . $sales_invoices_ID . ", " . $product_item . ", " . $quantity . ", '" . $price . "')";
                        $result_add_item = $connect->query($sql_add_item);

                        $sql_delete_item = "DELETE FROM user_cart WHERE id = " . $user_cart_id;
                        $result_delete_item = $connect->query($sql_delete_item);
                    }
                } catch (Exception $e) {
                    echo "<script>alert('" . $e . "')</script>";
                }
            }
            echo "<script>alert('Đã mua thành công')</script>";
            header("Location: ../profile.php");
            exit();
        }
    }
}
