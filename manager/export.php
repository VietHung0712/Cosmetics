<?php
require_once '../php/connect.php';
require '../vendor/autoload.php'; // Đảm bảo bạn đã autoload composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Truy vấn dữ liệu hóa đơn
    $sql_file = "SELECT 
                    u.displayname AS user_display,
                    u.address AS user_address,
                    u.phone AS user_phone,
                    p.name AS product_name,
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

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Hóa Đơn');

    // Thiết lập thông tin cá nhân
    $sheet->setCellValue('A1', 'Tên:');
    $sheet->setCellValue('B1', 'Địa chỉ:');
    $sheet->setCellValue('C1', 'Số điện thoại:');

    // Lấy thông tin người dùng
    if ($row = $result_file->fetch_assoc()) {
        $sheet->setCellValue('A2', $row['user_display']);
        $sheet->setCellValue('B2', $row['user_address']);
        $sheet->setCellValue('C2', $row['user_phone']);
    }

    // Thiết lập tiêu đề cho bảng sản phẩm
    $sheet->setCellValue('A4', 'Tên sản phẩm');
    $sheet->setCellValue('B4', 'Số lượng');
    $sheet->setCellValue('C4', 'Giá');

    // Duyệt qua kết quả và thêm vào bảng
    $rowCount = 5; // Bắt đầu từ dòng 5 để không ghi đè lên tiêu đề
    $total = 0; // Biến tổng tiền

    // Đưa con trỏ về đầu dòng để lấy lại dữ liệu
    $result_file->data_seek(0); // Đặt lại con trỏ về đầu để lấy lại dữ liệu

    while ($row = $result_file->fetch_assoc()) {
        $sheet->setCellValue('A' . $rowCount, $row['product_name']);
        $sheet->setCellValue('B' . $rowCount, $row['quantity']);
        $sheet->setCellValue('C' . $rowCount, $row['price']);

        // Tính tổng tiền
        $total += $row['quantity'] * $row['price'];
        $rowCount++;
    }

    // Hiển thị tổng tiền hóa đơn
    $sheet->setCellValue('A' . $rowCount, 'Tổng tiền:');
    $sheet->setCellValue('B' . $rowCount, $total);

    // Xuất file Excel
    $writer = new Xlsx($spreadsheet);
    $filename = 'hoa_don.xlsx';

    // Thiết lập header cho file download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    $writer->save('php://output');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="./export.php" method="POST" enctype="multipart/form-data">
        <input type="submit" value="submit">
    </form>
</body>

</html>