<?php
require_once "./php/connect.php";
require_once "./php/head.php";
require_once "./php/class.php";

use ClassProject\Categories;
use ClassProject\Product;
use ClassProject\Brand;
use ClassProject\FlashDeal;


$sql_categories = "SELECT * FROM categories";

$result_categories = $connect->query($sql_categories);
if ($result_categories->num_rows > 0) {
    while ($row = $result_categories->fetch_assoc()) {
        $categories = new Categories($row['id'], $row['name']);
        $categoriesArr[] = $categories;
    }
}

$sql_brand = "SELECT * FROM brand";

$result_brand = $connect->query($sql_brand);
if ($result_brand->num_rows > 0) {
    while ($row = $result_brand->fetch_assoc()) {
        $brand = new Brand($row['id'], $row['name'], $row['address'], $row['phone']);
        $brandArr[] = $brand;
    }
}


$sql_topbuy = "SELECT * FROM product ORDER BY sold desc LIMIT 4";

$result_topbuy = $connect->query($sql_topbuy);
if ($result_topbuy->num_rows > 0) {
    while ($row = $result_topbuy->fetch_assoc()) {
        $topbuy = new Product($row['id'], $row['name'], $row['categories'], $row['brand'], $row['review'], $row['rank'], $row['sum'], $row['sold'], $row['price'], $row['stt']);
        $topbuys[] = $topbuy;
    }
}

$sql_productNew = "SELECT * FROM product ORDER BY stt desc LIMIT 5";

$result_productNew = $connect->query($sql_productNew);
if ($result_productNew->num_rows > 0) {
    while ($row = $result_productNew->fetch_assoc()) {
        $productNew = new Product($row['id'], $row['name'], $row['categories'], $row['brand'], $row['review'], $row['rank'], $row['sum'], $row['sold'], $row['price'], $row['stt']);
        $productNews[] = $productNew;
    }
}

$sql_flashDeal = "SELECT p.*, f.discount, f.starttime, f.endtime FROM product p JOIN flash_deal f ON p.id = f.product WHERE NOW() BETWEEN f.starttime AND f.endtime";

$result_flashDeal = $connect->query($sql_flashDeal);
if ($result_flashDeal->num_rows > 0) {
    while ($row = $result_flashDeal->fetch_assoc()) {
        $flashDeal = new FlashDeal($row['id'], $row['name'], $row['categories'], $row['brand'], $row['review'], $row['rank'], $row['sum'], $row['sold'], $row['price'], $row['stt'], $row['starttime'], $row['endtime'], $row['discount']);
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
    <link rel="stylesheet" href="./css/main.css">
    <title></title>
</head>

<body>
    <div id='head' class="w-100 position-fixed d-flex">
        <a href="./index.php" class=" d-flex h-100 justify-content-between align-items-center" style="background-color: #ec6b81; width: 15%; border-radius: 0 50px 50px 0;">
            <img class="w-50 h-75 object-fit-contain" style="filter: drop-shadow(10px 10px 10px #000000a0);" src="./image/logo_project.png" alt="">
            <h1 style="height: 75%;font-weight: bold; font-size: 1.2vw; color: #fff; width: 50%; line-height: 75px;">EVE</h1>
        </a>
        <div class="head h-100  d-flex flex-row" style="width: 85%;">
            <div class="h-100" style="width: 60%;">
                <ul class="d-flex h-100 w-100 flex-row justify-content-around align-items-center">
                    <li><a class="topMenu" href="./index.php">Trang chủ</a></li>
                    <li>
                        <a class="topMenu" href="./products.php">Sản phẩm <i class="fa-solid fa-chevron-down"></i></a>
                        <ul>
                            <?php
                            foreach ($categoriesArr as $categories) {
                                echo "<li><a href='./products.php?this_categories=" . $categories->getId() . "'>" . $categories->getName() . "</a></li>";
                            }
                            ?>
                        </ul>
                    </li>
                    <li>
                        <a class="topMenu" href="./brands.php">Thương hiệu <i class="fa-solid fa-chevron-down"></i></a>
                        <ul>
                            <?php
                            foreach ($brandArr as $brand) {
                                echo "<li><a href='./brands.php?this_brand=" . $brand->getId() . "'>" . $brand->getName() . "</a></li>";
                            }
                            ?>
                        </ul>
                    </li>
                    <li><a class="topMenu" href="./contact.php">Liên hệ</a></li>
                    <li><a class="topMenu" href="./about">Giới thiệu</a></li>
                </ul>
            </div>
            <div class="h-100" style="width: 40%;">
                <ul class="d-flex h-100 w-100 flex-row justify-content-evenly align-items-center">
                    <li>
                        <a href="./profile.php"><i class="fa-solid fa-user"></i></i></a>
                    </li>
                    <li>
                        <a class="position-relative" href=""><i class="fa-solid fa-cart-shopping"></i>
                            <div class="mess__shopping position-absolute top-0 w-50 h-50" style="left: 70%; border-radius: 50%; background-color: #ec6b81;">1</div>
                        </a>
                    </li>
                    <li>
                        <a class="position-relative" href=""><i class="fa-solid fa-bell"></i></i>
                            <div class="mess__bell position-absolute top-0 w-50 h-50" style="left: 70%; border-radius: 50%; background-color: #ec6b81;">1</div>
                        </a>
                        <ul style="right: 1%; left: 80%; display: flex; flex-direction: column;">
                            <li>Thông báo 1</li>
                            <li>Thông báo 1</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="main" class="w-100">
        <section id="banner">
            <div class="banner__border">
                <img class="active" src="./image/perfectdiarySM01_2.webp" alt="">
                <img src="./image/judydollPM01_1.webp" alt="">
                <img src="./image/zeeseaKN01_1.webp" alt="">
            </div>
            <div class="banner__slogan">
                <span class="active">
                    <h3>Perfect Diary</h3>
                    <h2>Siêu mịn,<br>lâu trôi cao cấp</h2>
                    <a href="product_select.php?this_product=">Mua ngay</a>
                </span>
                <span>
                    <h3>Julydoll</h3>
                    <h2>Chuẩn tạo hiệu ứng cho<br>đôi má hồng</h2>
                    <a href="product_select.php?this_product=">Mua ngay</a>
                </span>
                <span>
                    <h3>Zeesea</h3>
                    <h2>Che khuyết điểm<br>kiềm dầu hiệu quả</h2>
                    <a href="product_select.php?this_product=">Mua ngay</a>
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
                for ($i = count($productNews) - 1; $i >= 0; $i--) {
                    echo "<a href='product_select.php?this_product=" . $productNews[$i]->getId() . "' class='product transition'>
                        <p>New</p>
                        <div class='product__img transition' style='background-image: url(./image/" . $productNews[$i]->getId() . "_0.webp);'></div>
                        <div class='product__info'>
                                <h3>" . $productNews[$i]->getName() . "</h3>
                                <h4>Giá: " . $productNews[$i]->getPrice() /1000 . " 000 VND</h4>
                        </div>
                    </a>";
                }
                ?>
            </div>
        </section>
        <section id="flashDeal" class="d-flex flex-row">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <img src="./image/flashdeal.webp" alt="">
                <div id="countdown">
                    <div class="countdownHours">00</div>:
                    <div class="countdownMinutes">00</div>:
                    <div class="countdownSeconds">00</div>
                </div>
                <?php
                if (isset($flashDeal)) {
                    echo "<h3 class='fw-bold text-white text-uppercase text-center'>" . $flashDeal->getName() . "</h3>
                    <h2 class='fw-bold text-white text-center'>Từ " . $flashDeal->getStarttime() . " đến " . $flashDeal->getEndtime() . "</h2>
                <h5 class='fw-bold text-white text-decoration-line-through'>" . $flashDeal->getPrice() . "đ </h5>
                <h2 class='fw-bold text-white'>" . $flashDeal->getPrice() - $flashDeal->getPrice() * $flashDeal->getDiscount() / 100 . " đ</h2>
                <h1 class='fw-bold text-white' style='font-size: 4vw;'>" . $flashDeal->getDiscount() . "%</h1>
                <a style='color: red; background-color: white; font-weight: bold; padding: 10px 50px; border-radius: 20px;' href='product_select.php?this_product=" . $flashDeal->getId() . "'>Mua ngay</a>";
                } else {
                    echo "<h2 class='fw-bold text-white'>Hiện tại chưa có khuyến mãi!</h2>
                            <h2 class='fw-bold text-white'> Hãy chờ đến lượt tiếp theo!</h2>";
                }
                ?>
            </div>
            <div>
                <?php
                if (isset($flashDeal)) {
                    echo "<img src='./image/" . $flashDeal->getId() . "_1.webp' alt=''>";
                } else {
                    echo "<img src='./image/logo.png' alt=''>";
                }
                ?>

            </div>
        </section>

        <section id="topbuy">
            <h1>Sản Phẩm Bán Chạy <i class="fa-solid fa-fire"></i></h1>
            <div class="topbuy__main d-flex flex-row">
                <div class="topbuy__img overflow-hidden">
                    <img class="transition" src="./image/topbuy_theme.jpg" alt="">
                </div>
                <div class="topbuy__list d-grid">
                    <?php
                    for ($i = 0 ; $i < count($topbuys); $i++) {
                        echo "<a href='product_select.php?this_product=" . $topbuys[$i]->getId() . "' class='product transition'>
                        <p>Hot</p>
                        <div class='product__img transition' style='background-image: url(./image/" . $topbuys[$i]->getId() . "_0.webp);'></div>
                        <div class='product__info'>
                                <h3>" . $topbuys[$i]->getName() . "</h3>
                                <h3>Đã bán:" . $topbuys[$i]->getSold() . "</h3>
                                <h4>Giá: " . $topbuys[$i]->getPrice() /1000 . " 000 VND</h4>
                        </div>
                    </a>";
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

    <div id="footer">
        
    </div>
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
            for ($i = count($productNews) - 1; $i >= 0; $i--) {
                echo "'" . $productNews[$i]->getId() . "_0.webp'";
                if ($i != 0) {
                    echo ",";
                }
            }
            ?>
        ],
        [
            <?php
            for ($i = count($productNews) - 1; $i >= 0; $i--) {
                echo "'" . $productNews[$i]->getId() . "_1.webp'";
                if ($i != 0) {
                    echo ",";
                }
            }
            ?>
        ]
    ];

    $$('#productNew .product').forEach((element, index) => {
        const productImg = $$('.productNew__border>.product>.product__img');
        element.addEventListener('mouseover', () => {
            productImg[index].style.backgroundImage = `url(./image/${productNewImg[1][index]})`;
        });

        element.addEventListener('mouseout', () => {
            productImg[index].style.backgroundImage = `url(./image/${productNewImg[0][index]})`;
        });

    });

    const topbuyImg = [
        [
            <?php
            for ($i = count($topbuys) - 1; $i >= 0; $i--) {
                echo "'" . $topbuys[$i]->getId() . "_0.webp'";
                if ($i != 0) {
                    echo ",";
                }
            }
            ?>
        ],
        [
            <?php
            for ($i = count($topbuys) - 1; $i >= 0; $i--) {
                echo "'" . $topbuys[$i]->getId() . "_1.webp'";
                if ($i != 0) {
                    echo ",";
                }
            }
            ?>
        ]
    ];

    $$('.topbuy__list .product').forEach((element, index) => {
        const productImg = $$('.topbuy__list>.product>.product__img');
        element.addEventListener('mouseover', () => {
            productImg[index].style.backgroundImage = `url(./image/${topbuyImg[1][index]})`;
        });

        element.addEventListener('mouseout', () => {
            productImg[index].style.backgroundImage = `url(./image/${topbuyImg[0][index]})`;
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
</script>