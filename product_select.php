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


if (isset($_GET['this_product'])) {
    $productImage = [];

    $this_productID = $_GET['this_product'];

    $_SESSION['currentFileName'] = basename(__FILE__) . "?this_product=" . $this_productID;

    $sql_product_select = "SELECT 
        p.*, 
        pi.price, 
        pi.attributes, 
        pi.count,
        pi.id AS pi_id, 
        pi.product AS pi_product 
    FROM 
        product p 
    LEFT JOIN 
        product_item pi ON p.id = pi.product 
    WHERE 
        p.id = $this_productID;
";
    $result_sql_product_select = $connect->query($sql_product_select);
    if ($result_sql_product_select->num_rows > 0) {
        while ($row = $result_sql_product_select->fetch_assoc()) {
            $this_product = new Product($row['id'], $row['name'], $row['categories'], $row['brand'], $row['review'], $row['image_url']);
            $productImage = ArrayProductImages($connect, $row['id']);
            $this_productItems[] = new ProductItem($row['pi_id'], $row['pi_product'], $row['attributes'], $row['price'], $row['count']);
        }
    }
    $users_review = [];
    $sql_product_reviews = "SELECT * FROM `user_reviews` WHERE product = " . $this_productID;
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

    $productsLikeCategory = [];
    foreach ($products as $item) {
        if ($item->getCategories() == $this_product->getCategories()) {
            $productsLikeCategory[] = $item;
        }
    }

    $productsLikeBrand = [];
    foreach ($products as $item) {
        if ($item->getBrand() == $this_product->getBrand()) {
            $productsLikeBrand[] = $item;
        }
    }

    $discount = 0;
    if (isset($flashDeals) && count($flashDeals) > 0) {
        foreach ($flashDeals as $item) {
            if ($item->getId() == $this_productID) {
                $discount = $item->getDiscount();
            }
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
    <title>EVE</title>
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
            <form class="product__preview--info" method="POST" action="./manager/add_to_cart.php?product_id=<?php echo $this_product->getId() ?>">
                <table>
                    <caption><?php echo $this_product->getName(); ?></caption>
                    <caption>(<?php echo ($rank[$indexProduct] / 1) . "/5) " . RankNumberToStar($rank[$indexProduct]); ?> Đã bán: <?php echo $quantity[$indexProduct]; ?></caption>
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
                        <th>Loại:</th>
                        <td class="attributes">
                            <select name="attributes" id="">
                                <?php
                                foreach ($this_productItems as $item) {
                                    echo "<option value='" . $item->getId() . "'>" . $item->getAttributes() . "</option>";
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
                        <td>
                            <button class="transition submitForm" type="submit">Thêm vào giỏ hàng <i class='fa-solid fa-cart-plus'></i></button>
                            <a class="login" style="background-color: #ec6b81; color: #fff; padding: 1vh 2vw; font-weight: bold;" href="./signin.php">Đăng nhập</a>
                        </td>
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
                <a href="./brand_select.php?this_brand=<?php echo $this_product->getBrand() ?>">Xem Shop <i class="fa-solid fa-shop"></i></a>
            </div>
            <a href="./brand_select.php?this_brand=<?php echo $this_product->getBrand() ?>"><i class="fa-solid fa-arrow-right transition"></i></a>
        </div>
        <div class="product__details">
            <div class="product__details--button">
                <button class="active">Chi tiết sản phẩm</button>
                <button>Đánh giá sản phẩm</button>
            </div>
            <div class="product__details--display">
                <div class="product__details--item active">
                    <h5><?php echo $this_product->getName() ?></h5>
                    <p>Thể loại: <?php echo $categoriesArr[$indexCategories]->getName() ?></p>
                    <p>Thương hiệu: <a href="./brand_select.php?this_brand=<?php echo $this_product->getBrand() ?>"><?php echo $brandArr[$indexBrand]->getName() ?></a></p>
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
                <div class="product__details--item">
                    <table>
                        <?php
                        foreach ($users_review as $item) {

                            $userDisplayName;
                            foreach ($users as $user) {
                                if ($item[0] == $user[0]) {
                                    $userDisplayName = $user[1];
                                }
                            }
                            echo "<tr>
                            <th>" . $userDisplayName . "</th>
                            <td>" . RankNumberToStar($item[1]) . "</td>
                            <td>" . $item[3] . "</td>
                        </tr>
                        <tr>
                            <th></th>
                            <td colspan='3'>" . $item[2] . "</td>
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
                <a href="./products.php?this_categories=<?php echo $this_product->getCategories(); ?>#searchForm">Xem tất cả</a>
            </div>
            <div class="product__-like--list-border">
                <?php
                if (count($productsLikeCategory) > 0) {
                    foreach ($productsLikeCategory as $index => $item) {
                        if ($index < 4) {
                            echo "<a href='product_select.php?this_product=" . $item->getId() . "' class='product transition'>
                                <p></p>
                                <div class='product__img transition' style='background-image: url(" . $item->getImageUrl() . ");'></div>
                                <div class='product__info'>
                                    <h3>" . $item->getName() . "</h3>
                                </div>
                            </a>";
                        }
                    }
                }
                ?>
            </div>
        </div>
        <div class="product__brand-like product__-like--list">
            <div class="product__-like--list-head">
                <h1>Sản phẩm khác của hãng</h1>
                <a href="./brand_select.php?this_brand=<?php echo $this_product->getBrand(); ?>#brand__products">Xem tất cả</a>
            </div>
            <div class="product__-like--list-border">
                <?php
                if (count($productsLikeBrand) > 0) {
                    foreach ($productsLikeBrand as $index => $item) {
                        if($index < 4){
                            echo "<a href='product_select.php?this_product=" . $item->getId() . "' class='product transition'>
                                <p></p>
                                <div class='product__img transition' style='background-image: url(" . $item->getImageUrl() . ");'></div>
                                <div class='product__info'>
                                    <h3>" . $item->getName() . "</h3>
                                </div>
                            </a>";
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php require_once "./php/footer.php" ?>
</body>
<script src="./js/function.js"></script>
<script>
    $$('.product__preview--img>div>img').forEach(element => {
        element.addEventListener('click', () => {
            EventRemoveActive($('.product__preview--img>div>img.active'));
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

    $$('.product__details--button>button').forEach((element, index) => {
        const details_items = $$('.product__details--item');
        element.addEventListener('click', () => {
            EventRemoveActive($('.product__details--button>button.active'));
            EventRemoveActive($('.product__details--item.active'));
            EventAddActive(element);
            EventAddActive(details_items[index]);
        })
    });
    <?php
    if (isset($_SESSION['user_id'])) {
        echo "let login_user = true;";
    } else {
        echo "let login_user = false;";
    }
    ?>
    if (!login_user) {
        $('.submitForm').style.display = 'none';
    } else {
        $('.login').style.display = 'none';
    }
</script>

</html>