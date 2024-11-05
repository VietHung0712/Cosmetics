<?php
require_once "../php/connect.php";

$user_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['selected'])) {

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

        fputcsv($output, ['MỸ PHẨM EVE']);
        fputcsv($output, []);
        fputcsv($output, ['HÓA ĐƠN BÁN HÀNG']);
        fputcsv($output, ['Ngày', date('d/m/Y H:i:s')]);
        fputcsv($output, []);
        fputcsv($output, ['Tên người mua', 'Địa chỉ người mua', 'Số điện thoại']);

        if ($row = $result_file->fetch_assoc()) {
            fputcsv($output, [
                $row['user_display'],
                $row['user_address'],
                $row['user_phone']
            ]);
        }
        fputcsv($output, []);
        fputcsv($output, ['SẢN PHẨM', 'SỐ LƯỢNG', 'GIÁ', 'THÀNH TIỀN']);

        $total = 0;
        do {
            fputcsv($output, [
                $row['name'],
                $row['quantity'],
                $row['price'],
                $row['quantity'] * $row['price']
            ]);
            $total += $row['quantity'] * $row['price'];
        } while ($row = $result_file->fetch_assoc());

        fputcsv($output, []);
        fputcsv($output, ['TỔNG CỘNG: ', '','', $total]);

        fclose($output);
        // header("Location: ../user_cart.php");
        exit();
    }
}
