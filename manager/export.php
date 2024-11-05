<?php
require_once './php/connect.php';
require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

$sheet->mergeCells('A1:E1');
$sheet->mergeCells('A2:E2');
$sheet->mergeCells('A3:E3');
$sheet->mergeCells('B5:E5');
$sheet->setCellValue('A1', 'Mỹ phẩm EVE');
$sheet->setCellValue('A2', '218 Lĩnh Nam- Hoàng Mai- Hà Nội');
$sheet->setCellValue('A3', 'LH: 0369709603');

$sheet->setCellValue('B5', 'HÓA ĐƠN MUA HÀNG');

$sheet->setCellValue('A7', 'Người mua');
$sheet->setCellValue('A8', 'Địa chỉ');
$sheet->setCellValue('A9', 'Điện thoại');

$sheet->setCellValue('A11', 'STT');
$sheet->setCellValue('B11', 'Sản phẩm');
$sheet->setCellValue('C11', 'Đơn giá');
$sheet->setCellValue('D11', 'Số lượng');
$sheet->setCellValue('E11', 'Thành tiền');

if ($row = $result_file->fetch_assoc()) {
    $sheet->mergeCells('B7:D7');
    $sheet->mergeCells('B8:D8');
    $sheet->mergeCells('B9:D9');
    $sheet->setCellValue('B7', $row['user_display']);
    $sheet->setCellValue('B8', $row['user_address']);
    $sheet->setCellValue('B9', $row['user_phone']);
}


$rowCount = 12;
$index = 1;
$total = 0;

$result_file->data_seek(0);

while ($row = $result_file->fetch_assoc()) {
    $sheet->setCellValue('A' . $rowCount, $index);
    $sheet->setCellValue('B' . $rowCount, $row['product_name']);
    $sheet->setCellValue('C' . $rowCount, $row['quantity']);
    $sheet->setCellValue('D' . $rowCount, $row['price']);
    $sheet->setCellValue('E' . $rowCount, $row['quantity'] * $row['price']);

    $total += $row['quantity'] * $row['price'];
    $rowCount++;
    $index++;
}

$sheet->setCellValue('A' . ($rowCount + 1), 'Tổng tiền:');
$sheet->setCellValue('E' . ($rowCount + 1), $total);

$writer = new Xlsx($spreadsheet);
$filename = 'hoa_don.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
$writer->save('php://output');
exit();
