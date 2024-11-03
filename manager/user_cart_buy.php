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

            $sql_file = "SELECT 
                u.displayname AS user_display,
                u.address AS user_address,
                u.phone AS user_phone,
                p.name,
                sit.quantity,
                sit.price,
                pi.attributes,
                si.time AS invoice_time
            FROM 
                sales_invoices si
            JOIN 
                sales_invoice_items sit ON si.id = sit.sales_invoices
            JOIN 
                product_item pi ON sit.product_item = pi.id
            JOIN 
                product p ON p.id = pi.product
            JOIN 
                user u ON si.user = u.id
            WHERE 
                si.time = (SELECT MAX(time) FROM sales_invoices)
            ORDER BY 
                sit.id DESC";
            $result_file = $connect->query($sql_file);

            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename="bill.csv"');

            $output = fopen("php://output", "w");

            fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($output, ['HÓA ĐƠN BÁN HÀNG']);
            fputcsv($output, ['Ngày', date('d/m/Y H:i:s')]);
            fputcsv($output, []);
            fputcsv($output, ['Tên người mua', 'Địa chỉ người mua', 'Số điện thoại liên hệ']);

            if ($row = $result_file->fetch_assoc()) {
                fputcsv($output, [
                    $row['user_display'],
                    $row['user_address'],
                    $row['user_phone']
                ]);
            }
            fputcsv($output, []);
            fputcsv($output, ['SẢN PHẨM', 'SỐ LƯỢNG', 'GIÁ', 'THÀNH TIỀN']);

            $total = 0; // Khởi tạo tổng tiền
            do {
                fputcsv($output, [
                    $row['name'],
                    $row['quantity'],
                    $row['price'],
                    $row['quantity'] * $row['price'] // Tính thành tiền
                ]);
                $total += $row['quantity'] * $row['price']; // Cộng dồn tổng tiền
            } while ($row = $result_file->fetch_assoc());

            fputcsv($output, []);
            fputcsv($output, ['TỔNG CỘNG: ', $total]);

            fclose($output);
            // header("Location: ../user_cart.php");
            exit();
        }
    }
}
