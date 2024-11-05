<?php
require_once "../php/connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


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
        while($row = $result_file->fetch_assoc()){
            
        }
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
    <form action="export.php" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>
                    <input type="submit" value="submit">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>