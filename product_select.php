<?php
require_once "./php/connect.php";
require_once "./php/class.php";
require_once "./php/Manager_Brands.php";
require_once "./php/Manager_Categories.php";
require_once "./php/Manager_Products.php";
require_once "./php/Manager_FlashDeal.php";
require_once "./php/function.php";

use ClassProject\Product;
use ClassProject\ProductItem;
use ClassProject\User;

if (isset($_GET['this_product'])) {
    $productImage = [];
    $this_productID = $_GET['this_product'];

    $sql_product_select = "SELECT p.*, pi.price, pi.attributes, pi.count
        FROM product p 
        JOIN product_item pi ON p.id = pi.product WHERE p.id = '$this_productID'";
    $result_sql_product_select = $connect->query($sql_product_select);
    if ($result_sql_product_select->num_rows > 0) {
        while ($row = $result_sql_product_select->fetch_assoc()) {
            $this_product = new Product($row['id'], $row['name'], $row['categories'], $row['brand'], $row['review'], $row['image_url']);
            $productImage = ArrayProductImages($connect, $row['id']);
            $this_productItems[] = new ProductItem($row['attributes'], $row['price'], $row['count']);
        }
    }
    $users_review = [];
    $sql_product_reviews = "SELECT * FROM `user_reviews` WHERE product = " . $this_product->getId();
    $result_sql_product_reviews = $connect->query($sql_product_reviews);
    if ($result_sql_product_reviews->num_rows > 0) {
        while ($row = $result_sql_product_reviews->fetch_assoc()) {
            $users_review[] = [$row['user'], $row['rating'], $row['review_text'], $row['review_date']];
        }
    }

    $sql_users = "SELECT * FROM `user`";
    $result_sql_users = $connect->query($sql_users);
    if ($result_sql_users->num_rows > 0) {
        while ($row = $result_sql_users->fetch_assoc()) {
            $users[] = [$row['id'], $row['displayname']];
        }
    }

    foreach ($products as $index => $product) {
        if ($this_productID == $product->getId()) {
            $indexProduct = $index;
        }
    }

    foreach ($brandArr as $index => $brand) {
        if ($brand->getId() == $this_product->getBrand()) {
            $indexBrand = $index;
        }
    }

    foreach ($categoriesArr as $index => $categories) {
        if ($categories->getId() == $this_product->getCategories()) {
            $indexCategories = $index;
        }
    }

    $star = "";
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rank[$indexProduct]) {
            $star .= "<i style='color: orange;' class='fa-solid fa-star'></i>";
        } else if ($rank[$indexProduct] != 0 && $i > $rank[$indexProduct] && $i % $rank[$indexProduct] != 0) {
            $star .= "<i style='color: orange;' class='fa-solid fa-star-half-stroke'></i>";
        } else {
            $star .= "<i class='fa-regular fa-star'></i>";
        }
    }

    $discount = 0;
    if (count($flashDeals) > 0) {
        foreach ($flashDeals as $item) {
            if ($item->getId() == $this_productID) {
                $discount = $item->getDiscount();
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sql_add =
            "INSERT INTO user_cart (id, user, product, attributes, quantity, price) VALUES
            ('',
            1,
            " . $this_product->getId() . ",
            '" . $_POST['attributes'] . "',
            " . $_POST['quantity'] . ",
            " . $_POST['price'] . ")";
        echo $sql_add;
        $result = mysqli_query($connect, $sql_add);
        if ($result) {
            header("Location: user_cart.php?user_id=1");
            exit();
        } else {
            echo "<script>
                    alert('Thêm không thành công!');
                </script>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/logo_project.png">
    <link rel="stylesheet" href="./assets/fontawesome-free-6.6.0-web/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/head_footer.css">
    <link rel="stylesheet" href="./css/product_select.css">
    <link rel="stylesheet" href="./css/style.css">
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
            <form class="product__preview--info" method="POST" action="">
                <table>
                    <caption><?php echo $this_product->getName(); ?></caption>
                    <caption>(<?php echo ($rank[$indexProduct] / 1) . "/5) " . $star; ?> Đã bán: <?php echo $quantity[$indexProduct]; ?></caption>
                    <tr>
                        <th></th>
                        <td style="color: #ec6b81;">_________________________</td>
                    </tr>
                    <tr>
                        <th>Giá gốc</th>
                        <td class="price0" style="text-decoration: line-through;"><?php echo $this_productItems[0]->getPrice(); ?> VND </td>
                        <td>
                            <label style='background-color:black; color: #fff;'>-<?php echo $discount; ?> %</label>
                        </td>
                    </tr>
                    <tr>
                        <th>Đơn giá</th>
                        <td class="price1">
                            <input style="width: auto;" type="text" name="price" value="<?php echo $this_productItems[0]->getPrice() * (100 - $discount) / 100; ?>" readonly>
                        </td>
                        <td>
                            VND
                        </td>
                        <?php
                        ?>
                    </tr>
                    <tr>
                        <th>Vận chuyển:</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Loại:</th>
                        <td class="attributes">
                            <select name="attributes" id="">
                                <?php
                                foreach ($this_productItems as $item) {
                                    echo "<option value='" . $item->getAttributes() . "'>" . $item->getAttributes() . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Số lượng:</th>
                        <td class="index_amount"><button type="button">-</button><input type="number" name="quantity" value="1" min="1" max="<?php echo $this_productItems[0]->getCount(); ?>"><button type="button">+</button></td>
                        <td class="product_count"><?php echo $this_productItems[0]->getCount(); ?> sản phẩm sẵn có</td>
                    </tr>
                    <tr>
                        <th></th>
                        <td><button class="transition" type="submit">Thêm vào giỏ hàng <i class='fa-solid fa-cart-plus'></i></button></td>
                        <td></td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="product__brand">
            <div class="product__brand--img" style="background-image: url(<?php echo $brandArr[$indexBrand]->getBackgroundUrl() ?>);">
                <img src="<?php echo $brandArr[$indexBrand]->getIconUrl() ?>" alt="">
            </div>
            <div class="product__brand--name">
                <h1><?php echo $brandArr[$indexBrand]->getName() ?></h1>
                <a href="">Xem Shop <i class="fa-solid fa-shop"></i></a>
            </div>
            <a href=""><i class="fa-solid fa-arrow-right transition"></i></a>
        </div>
        <div class="product__details">
            <div class="product__details--button">
                <button>Chi tiết sản phẩm</button>
                <button>Đánh giá</button>
            </div>
            <div class="product__details--display">
                <div class="product__details--description">
                    <h1><?php echo $this_product->getName() ?></h1>
                    <p>Thể loại: <?php echo $categoriesArr[$indexCategories]->getName() ?></p>
                    <p>Thương hiệu: <a href=""><?php echo $brandArr[$indexBrand]->getName() ?></a></p>
                    <php>Phân loại:
                        <?php
                        foreach ($this_productItems as $item) {
                            echo $item->getAttributes() . "|";
                        }
                        ?>
                        </p>
                        <p>Mô tả:</p>
                        <p><?php echo $this_product->getReview() ?></p>
                </div>
                <div class="product__details--review">
                    <table>
                        <?php
                        foreach ($users_review as $item) {
                            $star = "";
                            for ($i = 0; $i < 5; $i++) {
                                if ($i < $item[1]) {
                                    $star .= "<i style='color: orange;' class='fa-solid fa-star'></i>";
                                } else {
                                    $star .= "<i class='fa-regular fa-star'></i>";
                                }
                            }
                            $userDisplayName;
                            foreach ($users as $user) {
                                if ($item[0] == $user[0]) {
                                    $userDisplayName = $user[1];
                                }
                            }
                            echo "<tr>
                            <th>" . $userDisplayName . "</th>
                            <td>" . $star . "</td>
                            <td></td>
                            <td></td>
                        </tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="product__category-like product__-like--list">
            <div class="product__-like--list-head">
                <h1>Sản phẩm tương tự</h1>
                <a href="">Xem tất cả</a>
            </div>
            <div class="product__-like--list-border">

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

    $$('.index_amount>button').forEach((element, index) => {
        element.addEventListener('click', () => {
            if (index === 0) {
                if ($('.index_amount>input').value > 1) {
                    $('.index_amount>input').value--;
                }
            } else if (index === 1) {
                $('.index_amount>input').value++;
            }
        })
    })

    const productItem = [
        <?php
        foreach ($this_productItems as $index => $item) {
            echo "['" . $item->getAttributes() . "','" . $item->getPrice() . "','" . $item->getCount() . "']";
            if ($index < count($this_productItems) - 1) {
                echo ",";
            }
        }
        ?>
    ];
    let discount = <?php echo $discount; ?>;
    $('.attributes>select').addEventListener('change', () => {
        const index = $('.attributes>select').selectedIndex;
        $('.index_amount>input').max = productItem[index][2];
        $('.index_amount>input').value = 1;
        $('.product_count').textContent = productItem[index][2] + " sản phẩm sẵn có";
        $('.price0').textContent = productItem[index][1] + "VND";
        $('.price1>input').value = productItem[index][1] * (100 - discount) / 100;
    })
</script>

</html>