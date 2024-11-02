<?php
require_once "./php/connect.php";
require_once "./php/class.php";
require_once "./php/Manager_Brands.php";
require_once "./php/Manager_Categories.php";
require_once "./php/Manager_FlashDeal.php";
require_once "./php/function.php";

use ClassProject\Product;
use ClassProject\ProductItem;

$sql_topbuy = "SELECT p.*, SUM(si.quantity) AS total_quantity, pi.id AS pi_id, pi.product AS pi_product, pi.price, pi.attributes, pi.count
    FROM product p
    JOIN product_item pi ON p.id = pi.product
    JOIN sales_invoice_items si ON pi.id = si.product_item
    GROUP BY p.id, p.name
    ORDER BY total_quantity DESC
    LIMIT 4";
$result_topbuy = $connect->query($sql_topbuy);
if ($result_topbuy->num_rows > 0) {
    while ($row = $result_topbuy->fetch_assoc()) {
        $sold[] = $row['total_quantity'];
        $topbuy = new Product($row['id'], $row['name'], $row['categories'], $row['brand'], $row['review'], $row['image_url']);
        $topbuys[] = $topbuy;
        $topbuyItem = new ProductItem($row['pi_id'], $row['pi_product'], $row['attributes'], $row['price'], $row['count']);
        $topbuyItems[] = $topbuyItem;
    }
}
$topbuysImage = [];
foreach ($topbuys as $index => $topbuy) {
    $sql = "SELECT image_url FROM product_image WHERE product = '" . $topbuy->getId() . "'";
    $result = $connect->query($sql);
    $images = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $images[] = $row['image_url'];
        }
    }
    $topbuysImage[$index] = $images;
}


$sql_productNew = "SELECT p.*, pi.id AS pi_id, pi.product AS pi_product, pi.attributes, pi.price, pi.count FROM product p JOIN product_item pi ON pi.product = p.id GROUP BY p.id ORDER BY p.id DESC LIMIT 5";
$result_productNew = $connect->query($sql_productNew);
if ($result_productNew->num_rows > 0) {
    while ($row = $result_productNew->fetch_assoc()) {
        $productNewItem =  new ProductItem($row['pi_id'], $row['pi_product'], $row['attributes'], $row['price'], $row['count']);
        $productNewItems[] = $productNewItem;
        $productNew = new Product($row['id'], $row['name'], $row['categories'], $row['brand'], $row['review'], $row['image_url']);
        $productNews[] = $productNew;
    }
}

$productNewImage = [];
foreach ($productNews as $index => $productNew) {
    $sql = "SELECT image_url FROM product_image WHERE product = '" . $productNew->getId() . "'";
    $result = $connect->query($sql);
    $images = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $images[] = $row['image_url'];
        }
    }
    $productNewImage[$index] = $images;
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
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/head_footer.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>EVE</title>
</head>

<body>
    <?php require_once './php/head.php'; ?>

    <div id="main" class="w-100">
        <section id="banner">
            <div class="banner__border">
                <img class="active" src="./images/perfectdiarySM01_2.webp" alt="">
                <img src="./images/judydollPM01_1.webp" alt="">
                <img src="./images/zeeseaKN01_2.webp" alt="">
            </div>
            <div class="banner__slogan">
                <span class="active">
                    <h3>Perfect Diary</h3>
                    <h2>Siêu mịn,<br>lâu trôi cao cấp</h2>
                    <a href="product_select.php?this_product=15">Mua ngay</a>
                </span>
                <span>
                    <h3>Julydoll</h3>
                    <h2>Chuẩn tạo hiệu ứng cho<br>đôi má hồng</h2>
                    <a href="product_select.php?this_product=1">Mua ngay</a>
                </span>
                <span>
                    <h3>Zeesea</h3>
                    <h2>Che khuyết điểm<br>kiềm dầu hiệu quả</h2>
                    <a href="product_select.php?this_product=8">Mua ngay</a>
                </span>
            </div>
            <div class="banner__button">
                <button class="active"></button>
                <button></button>
                <button></button>
            </div>
        </section>
        <section id="productNew">
            <h1>Sản Phẩm Mới <i class="fa-regular fa-newspaper"></i></h1>
            <div class="productNew__border">
                <?php
                if (count($productNews) > 0) {
                    foreach ($productNews as $index => $product) {
                        echo "<a href='product_select.php?this_product=" . $product->getId() . "' class='product transition'>
                            <p>New</p>
                            <div class='product__img transition' style='background-image: url(" . $product->getImageUrl() . ");'></div>
                            <div class='product__info'>
                                    <h3>" . $product->getName() . "</h3>
                                    <h4>Giá: " . $productNewItems[$index]->getPrice() / 1000 . " 000 VND</h4>
                            </div>
                        </a>";
                    }
                } else {
                    echo "<h4>Không tìm thấy sản phẩm!</h4>";
                }
                ?>
            </div>
        </section>
        <section id="flashDeal" class="d-flex flex-row">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <img src="./images/flashdeal.webp" alt="">
                <div id="countdown">
                    <div class="countdownHours">00</div>:
                    <div class="countdownMinutes">00</div>:
                    <div class="countdownSeconds">00</div>
                </div>
                <?php
                if (isset($flashDeals)) {
                    echo "<h3 class='fw-bold text-white text-uppercase text-center'>" . $flashDeals[0]->getName() . "</h3>
                    <h2 class='fw-bold text-white text-center'>Từ " . $flashDeals[0]->getStarttime() . " đến " . $flashDeals[0]->getEndtime() . "</h2>
                <h5 class='fw-bold text-white text-decoration-line-through'>" . $flashDealPrices[0] . "đ </h5>
                <h2 class='fw-bold text-white'>" . $flashDealPrices[0] - $flashDealPrices[0] * $flashDeals[0]->getDiscount() / 100 . " đ</h2>
                <h1 class='fw-bold text-white' style='font-size: 4vw;'>" . $flashDeals[0]->getDiscount() . "%</h1>
                <a style='color: red; background-color: white; font-weight: bold; padding: 10px 50px; border-radius: 20px;' href='product_select.php?this_product=" . $flashDeals[0]->getId() . "'>Mua ngay</a>";
                } else {
                    echo "<h2 class='fw-bold text-white'>Hiện tại chưa có khuyến mãi!</h2>
                            <h2 class='fw-bold text-white'> Hãy chờ đến lượt tiếp theo!</h2>";
                }
                ?>
            </div>
            <div>
                <?php
                if (isset($flashDeals)) {
                    echo "<img src='" . $flashDeals[0]->getImageUrl() . "' alt=''>";
                    if (count($flashDeals) > 1) {
                        echo "<a class='flashDeal-more-btn transition' href='#flashDeal-more'>Xem thêm <i class='fa-solid fa-arrow-down'></i></a>";
                    }
                } else {
                    echo "<img src='./images/logo.png' alt=''>";
                }
                ?>
            </div>

        </section>

        <div id="flashDeal-more" style="display: none; height: 0;">
            <h1>Giảm giá <i class="fa-solid fa-hand-holding-dollar"></i></h1>
            <div class="productNew__border">
                <?php
                if (isset($flashDeals)) {
                    foreach ($flashDeals as $index => $product) {
                        echo "<a href='product_select.php?this_product=" . $product->getId() . "' class='product transition'>
                            <p>-" . $product->getDiscount() . "%</p>
                            <div class='product__img transition' style='background-image: url(" . $product->getImageUrl() . ");'></div>
                            <div class='product__info'>
                                    <h3>" . $product->getName() . "</h3>
                                    <h3 style='text-decoration: line-through;'>" . $flashDealPrices[$index] / 1000 . " 000 VND</h3>
                                    <h4>Giá mới: " . $flashDealPrices[$index] * (100 - $product->getDiscount()) / 100  / 1000 . " 000 VND</h4>
                            </div>
                        </a>";
                    }
                } else {
                    echo "<h5>Không có sản phẩm giảm giá!</h5>";
                }
                ?>
            </div>
        </div>
        <section id="topbuy">
            <h1>Sản Phẩm Bán Chạy <i class="fa-solid fa-fire"></i></h1>
            <div class="topbuy__main d-flex flex-row">
                <div class="topbuy__img overflow-hidden">
                    <img class="transition" src="./images/topbuy_theme.jpg" alt="">
                </div>
                <div class="topbuy__list d-grid">
                    <?php
                    if (count($topbuys) > 0) {
                        foreach ($topbuys as $index => $product) {
                            echo "<a href='product_select.php?this_product=" . $product->getId() . "' class='product transition'>
                            <p>Hot</p>
                            <div class='product__img transition' style='background-image: url(" . $product->getImageUrl() . ");'></div>
                            <div class='product__info'>
                                    <h3>" . $product->getName() . "</h3>
                                    <h3>Đã bán:" . $sold[$index] . "</h3>
                                    <h4>Giá: " . $topbuyItems[$index]->getPrice() / 1000 . " 000 VND</h4>
                            </div>
                        </a>";
                        }
                    } else {
                        echo "<h4>Không tìm thấy sản phẩm!</h4>";
                    }
                    ?>
                </div>
            </div>
        </section>

        <div class="leftMenu">
            <div class="leftMenu__background transition"></div>

            <div class="leftMenu__border">
                <div class="leftMenu__items transition">
                    <a class="active" href="#"><i class="fa-solid fa-house">
                            <div class="leftMenu__hover" data-text="EVE Shop"></div>
                        </i>
                    </a>
                    <a href="#productNew"><i class="fa-regular fa-newspaper">
                            <div class="leftMenu__hover" data-text="News"></div>
                        </i>
                    </a>
                    <a href="#flashDeal"><i class="fa-solid fa-bolt">
                            <div class="leftMenu__hover" data-text="Flash Deal"></div>
                        </i>
                    </a>
                    <a href="#topbuy"><i class="fa-solid fa-fire">
                            <div class="leftMenu__hover" data-text="Hot"></div>
                        </i>
                    </a>
                </div>
            </div>
            <button class="transition"><i class="fa-solid fa-angle-right transition"></i></button>
        </div>
    </div>
    <a class="ScrollToTop" href="#"><i class="fa-solid fa-angles-up"></i></a>
    <?php require_once "./php/footer.php" ?>
</body>

</html>
<script src="./js/function.js"></script>
<script>
    let indexBanner = 0;
    const bannerImgs = $$('.banner__border>img');
    const bannerSlogans = $$('.banner__slogan>span');
    const bannerButton = $$('.banner__button>button');

    $$('.banner__button>button').forEach((element, index) => {
        element.onclick = function() {
            indexBanner = index;
            onclickBanner();
        }
    });

    function onclickBanner() {

        $('.banner__button>button.active').classList.remove('active');
        $('.banner__border>img.active').classList.remove('active');
        $('.banner__slogan>span.active').classList.remove('active');

        EventAddActive(bannerButton[indexBanner]);
        EventAddActive(bannerImgs[indexBanner]);
        EventAddActive(bannerSlogans[indexBanner]);
    }

    function cycleBanner() {
        onclickBanner();
        indexBanner++;

        if (indexBanner >= bannerButton.length) {
            indexBanner = 0;
        }
    }

    function startBannerCycle() {
        setInterval(cycleBanner, 5000);
    }



    const productNewImg = [
        [
            <?php
            foreach ($productNews as $index => $item) {
                echo "'" . $item->getImageUrl() . "'";
                if ($index != count($productNews)) {
                    echo ",";
                }
            }
            ?>
        ],
        [
            <?php
            foreach ($productNewImage as $index => $item) {
                if (isset($item[0])) {
                    echo "'" . $item[0] . "'";
                } else {
                    echo "'" . $productNews[$index]->getImageUrl() . "'";
                }
                if ($index != count($productNewImage)) {
                    echo ",";
                }
            }
            ?>
        ]
    ];

    $$('#productNew .product').forEach((element, index) => {
        const productImg = $$('.productNew__border>.product>.product__img');
        element.addEventListener('mouseover', () => {
            productImg[index].style.backgroundImage = `url(${productNewImg[1][index]})`;
        });

        element.addEventListener('mouseout', () => {
            productImg[index].style.backgroundImage = `url(${productNewImg[0][index]})`;
        });

    });

    const topbuyImg = [
        [
            <?php
            foreach ($topbuys as $index => $item) {
                echo "'" . $item->getImageUrl() . "'";
                if ($index != count($topbuys)) {
                    echo ",";
                }
            }
            ?>
        ],
        [
            <?php
            foreach ($topbuysImage as $index => $item) {
                if (isset($item[0])) {
                    echo "'" . $item[0] . "'";
                } else {
                    echo "'" . $topbuys[$index]->getImageUrl() . "'";
                }
                if ($index != count($topbuysImage)) {
                    echo ",";
                }
            }
            ?>
        ]
    ];

    $$('.topbuy__list .product').forEach((element, index) => {
        const productImg = $$('.topbuy__list>.product>.product__img');
        element.addEventListener('mouseover', () => {
            productImg[index].style.backgroundImage = `url(${topbuyImg[1][index]})`;
        });

        element.addEventListener('mouseout', () => {
            productImg[index].style.backgroundImage = `url(${topbuyImg[0][index]})`;
        });
    });

    function startCountdown() {
        const now = new Date();
        const currentHour = now.getHours();
        const currentMinute = now.getMinutes();
        const currentSecond = now.getSeconds();

        let periodStartHour = Math.floor(currentHour / 3) * 3;
        let periodEndHour = periodStartHour + 3;


        const periodEndTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), periodEndHour, 0, 0, 0);

        let timeLeft = Math.floor((periodEndTime.getTime() - now.getTime()) / 1000);

        const countdownInterval = setInterval(() => {
            if (timeLeft <= 0) {
                clearInterval(countdownInterval);
                $('#countdown').innerText = "Time's up!";
                return;
            }

            let hours = Math.floor(timeLeft / 3600);
            let minutes = Math.floor((timeLeft % 3600) / 60);
            let seconds = timeLeft % 60;

            let countdownHours = (hours < 10 ? '0' : '') + hours;
            let countdownMinutes = (minutes < 10 ? '0' : '') + minutes;
            let countdownSeconds = (seconds < 10 ? '0' : '') + seconds;

            $('#countdown>.countdownHours').innerText = countdownHours;
            $('#countdown>.countdownMinutes').innerText = countdownMinutes;
            $('#countdown>.countdownSeconds').innerText = countdownSeconds;

            timeLeft--;
        }, 1000);
    }
    startCountdown();
    startBannerCycle();

    viewPort($$('section'), $$('.leftMenu__items>a'));

    let leftMenu = false;
    $('.leftMenu>button').addEventListener('click', () => {
        leftMenu = !leftMenu;
        if (leftMenu) {
            $('.leftMenu>button').style.left = '100%';
            $('.leftMenu>.leftMenu__border>.leftMenu__items').style.right = '0%';
            $('.leftMenu>button>i').style.transform = 'rotateZ(180deg)';
        } else {
            $('.leftMenu>button>i').style.transform = 'rotateZ(0deg)';
            $('.leftMenu>button').style.left = '0%';
            $('.leftMenu>.leftMenu__border>.leftMenu__items').style.right = '100%';
        }
    });

    $('.flashDeal-more-btn')?.addEventListener('click', () => {
        $('#flashDeal-more').style.display = 'block';
        $('#flashDeal-more').style.height = '100vh';
        $('.flashDeal-more-btn').style.display = 'none';
    })
</script>