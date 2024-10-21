<?php
require_once "./php/connect.php";
require_once "./php/class.php";
require_once "./php/Manager_Brands.php";
require_once "./php/Manager_Categories.php";
require_once "./php/function.php";

use ClassProject\Product;

$productImage = [];
if (isset($_GET['this_product'])) {
    $this_productID = $_GET['this_product'];
    $sql_product_select = "SELECT * FROM product WHERE id = '$this_productID'";
    $result_sql_product_select = $connect->query($sql_product_select);
    if ($result_sql_product_select->num_rows > 0) {
        while ($row = $result_sql_product_select->fetch_assoc()) {
            $this_product = new Product($row['id'], $row['name'], $row['categories'], $row['brand'], $row['review'], $row['sum'], $row['price'], $row['image_url']);
            $productImage = ArrayProductImages($connect, $row['id']);
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./image/logo_project.png">
    <link rel="stylesheet" href="./assets/fontawesome-free-6.6.0-web/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/product_select.css">
    <link rel="stylesheet" href="./css/head_footer.css">
    <title></title>
</head>

<body>
    <?php
            require_once "./php/head.php";
            ?>
    <div id="product_select">

        <div class="product__preview">
            <div class="product__preview--img">
                <img class="transition" src="<?php echo $this_product->getImageUrl(); ?>" alt="">
                <div>
                    <?php
                    echo "<img class='transition active' src='" . $this_product->getImageUrl() . "' alt=''>";
                    for ($i = 0; $i < count($productImage); $i++) {
                        echo "<img class='transition' src='" . $productImage[$i] . "' alt=''>";
                    }
                    ?>
                </div>
            </div>
            <div class="product__preview--info">
                <h1>JUDYDOLL Son dưỡng có màu</h1>
                
            </div>
        </div>

    </div>
</body>
<script src="./js/function.js"></script>
<script>
    $$('.product__preview--img>div>img').forEach(element => {
        element.addEventListener('click', () => {
            $('.product__preview--img>div>img.active')?.classList.remove('active');
            $('.product__preview--img>img').src = element.src;
            EventAddActive(element);
        })
    });
</script>

</html>