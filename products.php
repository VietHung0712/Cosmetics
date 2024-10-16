<?php
require_once "./php/connect.php";
require_once "./php/class.php";

use ClassProject\Categories;
use ClassProject\Product;

$sql_categories = "SELECT * FROM categories";
$categoriesArr = [];
$result_categories = $connect->query($sql_categories);
if ($result_categories->num_rows > 0) {
    while ($row = $result_categories->fetch_assoc()) {
        $categories = new Categories($row['id'], $row['name']);
        $categoriesArr[] = $categories;
    }
}

$indexFilterCategories = 0;
if (isset($_GET['this_categories'])) {
    $filterCategories = $_GET['this_categories'];
    foreach ($categoriesArr as $index => $categories) {
        if ($categories->getId() == $filterCategories) {
            $indexFilterCategories = ($index + 1);
        }
    }
}

$sql_product = "SELECT * FROM product ORDER BY stt DESC";
$products = [];
$result_product = $connect->query($sql_product);
if ($result_product->num_rows > 0) {
    while ($row = $result_product->fetch_assoc()) {
        $product = new Product($row['id'], $row['name'], $row['categories'], $row['brand'], $row['review'], $row['rank'], $row['sum'], $row['sold'], $row['price'], $row['stt']);
        $products[] = $product;
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
    <div id="products">
        <div class="banner">
            <div class="banner__img" style="background-image: url(./image/products.jpg);"></div>
            <div class="banner__info flex-column justify-content-center align-items-center d-flex">
                <h1>EVE</h1>
                <p>"Đẹp mỗi ngày, tỏa sáng mọi khoảnh khắc."</p>
            </div>
        </div>
        <div class="banner__product">
            <a href="product_select.php?this_product=judydollPN01" style="background-image: url(./image/judydollPN01_banner.webp);"></a>    
            <button><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div id="searchForm" class="filter__products">
            <div class="filter__products--list">
                <h5 style="font-weight: bold; height: 50px;"><i class="fa-solid fa-list"></i> Danh mục</h5>
                <div class="filter__products--categories">
                    <a class='active' href='#searchForm'>Tất cả</a>
                    <?php
                    foreach ($categoriesArr as $categories) {
                        echo "<a href='#searchForm'>" . $categories->getName() . "</a>";
                    }
                    ?>
                </div>
            </div>
            <div class="filter__products--sort">
                <h5 style="font-weight: bold; margin-right: 10px;"><i class="fa-solid fa-filter"></i> Sắp xếp theo</h5>

                <a href="#searchForm" class="active">Mới nhất</a>
                <a href="#searchForm">Bán chạy</a>
                <a href="#searchForm">Xếp hạng</a>

                <h5 style="font-weight: bold; margin: 0 10px;"><i class="fa-solid fa-tag"></i> Giá</h5>

                <select name="sort__price" style="margin-left: 10px;padding: 10px;">
                    <option style="display: none;">____________</option>
                    <option style="background-color: white;">Giá: Thấp đến cao</option>
                    <option style="background-color: white;">Giá: Cao đến thấp</option>
                </select>
            </div>
            <div class="filter__products--search">
                <input style="border: none; border-bottom: 1px solid black; font-size: 1.2vw; text-align: center" type="text" name="search" placeholder="Tìm kiếm">
                <a href="#searchForm"><i class='fa-solid fa-magnifying-glass'></i></a>
            </div>
        </div>
        <div class="products__main">
            <?php
            foreach ($products as $product) {
                $rank = $product->getRank();
                $star = "";
                for ($i = 0; $i < 5; $i++) {
                    if ($i < $rank) {
                        $star .= "<i style='color: orange;' class='fa-solid fa-star'></i>";
                    } else {
                        $star .= "<i class='fa-regular fa-star'></i>";
                    }
                }

                echo "<a href='product_select.php?this_product=" . $product->getId() . "' class='product transition'
                    data-name='" . $product->getName() . "    '
                    data-categories='" . $product->getCategories() . "'
                    data-rank='" . $product->getRank() . "'
                    data-sold='" . $product->getSold() . "'
                    data-price='" . $product->getPrice() . "'
                    data-stt='" . $product->getStt() . "'>
                    <p></p>
                    <div class='product__img transition' style='background-image: url(./image/" . $product->getId() . "_0.webp);'></div>
                    <div class='product__info'>
                        <h3>" . $product->getName() . "</h3>
                        <h3>" . $star . "</h3>
                        <h3>Đã bán: " . $product->getSold() . "</h3>
                        <h4>Giá: " . $product->getPrice() / 1000 . " 000 VND</h4>
                    </div>
                </a>";
            }
            ?>
        </div>
    </div>
</body>

</html>
<script src="./js/function.js"></script>
<script>
    let indexCategories = 0;

    const categories = ['all',
        <?php
        foreach ($categoriesArr as $index => $categories) {
            echo " '" . $categories->getId() . "'";
            if ($index != count($categoriesArr)) {
                echo ",";
            }
        }
        ?>
    ];


    function filterSearch() {
        const searchValue = $('.filter__products--search>input').value.trim().toLowerCase();
        $$('.products__main .product').forEach((product) => {
            const matchesCategory = indexCategories === 0 || product.dataset.categories.includes(categories[indexCategories]);
            const matchesSearch = searchValue === '' || product.dataset.name.trim().toLowerCase().includes(searchValue);
            if (matchesCategory && matchesSearch) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    }

    function chooseCategories() {
        <?php
        if ($indexFilterCategories != 0) {
            echo "
            const categoriesElement = $$('.filter__products--categories>a');
            $('.filter__products--categories>a.active').classList.remove('active');
            EventAddActive(categoriesElement[$indexFilterCategories]);
            indexCategories = $indexFilterCategories;
            filterSearch();";
        }
        ?>
    }
    chooseCategories()

    $$('.filter__products--categories>a').forEach((element, index) => {
        element.addEventListener('click', () => {
            $('.filter__products--categories>a.active').classList.remove('active');
            EventAddActive(element);
            indexCategories = index;
            filterSearch();
        })
    });


    $('.filter__products--search>a').addEventListener('click', filterSearch);
    $('.filter__products--search>input').addEventListener('change', filterSearch);

    $$('.filter__products--sort>a').forEach((element, index) => {
        element.addEventListener('click', () => {
            $('.filter__products--sort>a.active')?.classList.remove('active');
            $('.filter__products--sort>select.active')?.classList.remove('active');
            $('.filter__products--sort>select').selectedIndex = 0;
            EventAddActive(element);

            const productsElement = Array.from($$('.products__main .product'));

            if (index == 0) {
                productsElement.sort((a, b) => b.dataset.stt - a.dataset.stt);
            } else if (index == 1) {
                productsElement.sort((a, b) => b.dataset.sold - a.dataset.sold);
            } else if (index == 2) {
                productsElement.sort((a, b) => b.dataset.rank - a.dataset.rank);
            }

            const parent = document.querySelector('.products__main');
            parent.innerHTML = '';
            productsElement.forEach((product) => {
                parent.appendChild(product);
            });
        });
    });


    $('.filter__products--sort>select').addEventListener('change', (event) => {
        const productsElement = Array.from($$('.products__main .product'));
        $('.filter__products--sort>a.active')?.classList.remove('active');
        EventAddActive($('.filter__products--sort>select'));

        if ($('.filter__products--sort>select').selectedIndex == 1) {
            productsElement.sort((a, b) => a.dataset.price - b.dataset.price);
        } else if ($('.filter__products--sort>select').selectedIndex == 2) {
            productsElement.sort((a, b) => b.dataset.price - a.dataset.price);
        }

        const parent = document.querySelector('.products__main');
        parent.innerHTML = '';
        productsElement.forEach((product) => {
            parent.appendChild(product);
        });
    });



    const productImgs = [
        [
            <?php
            foreach ($products as $index => $product) {
                echo "'" . $product->getId() . "_0.webp'";
                if ($index != count($products)) {
                    echo ",";
                }
            }
            ?>
        ],
        [
            <?php
            foreach ($products as $product) {
                echo "'" . $product->getId() . "_1.webp'";
                if ($i != 0) {
                    echo ",";
                }
            }
            ?>
        ]
    ];

    $$('.products__main .product').forEach((element, index) => {
        const productImg = $$('.products__main>.product>.product__img');
        element.addEventListener('mouseover', () => {
            productImg[index].style.backgroundImage = `url(./image/${productImgs[1][index]})`;
        });

        element.addEventListener('mouseout', () => {
            productImg[index].style.backgroundImage = `url(./image/${productImgs[0][index]})`;
        });
    });

    $('.banner__product>button').addEventListener('click', () => {
        $('.banner__product').style.display = 'none';
    })
</script>