<?php
require_once "./php/connect.php";
require_once "./php/class.php";
require_once "./php/Manager_Products.php";
require_once "./php/Manager_Categories.php";
require_once "./php/Manager_Brands.php";
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
    <title>EVE</title>
</head>

<body>
    <?php require_once './php/head.php'; ?>
    <div id="brands">
        <div class="brands__filter">
            <div class="brands__filter--search">
                <input type="text" name="search" placeholder="Tìm kiếm">
                <a href="#brands__list"><i class='fa-solid fa-magnifying-glass'></i></a>
            </div>
            <div class="brands__filter--sort">
                <h5 style="font-weight: bold; font-size: 1.2vw;">Sắp xếp <i class="fa-solid fa-filter"></i></h5>
                <a class="active" href="#brands__list">A->Z</a>
                <a href="#brands__list">Z->A</a>
            </div>
            <div class="brands__filter--country">
                <h5 style="font-weight: bold; font-size: 1.2vw;">Quốc gia <i class="fa-solid fa-earth-americas"></i></h5>
                <select name="country">
                    <option value="">Tất cả</option>
                    <option value="Anh">Anh</option>
                    <option value="Australia">Australia</option>
                    <option value="Brazil">Brazil</option>
                    <option value="Canada">Canada</option>
                    <option value="Đức">Đức</option>
                    <option value="Hoa Kỳ">Hoa Kỳ</option>
                    <option value="Hàn Quốc">Hàn Quốc</option>
                    <option value="Italy">Italy</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Nga">Nga</option>
                    <option value="Nhật Bản">Nhật Bản</option>
                    <option value="Pháp">Pháp</option>
                    <option value="Tây Ban Nha">Tây Ban Nha</option>
                    <option value="Thổ Nhĩ Kỳ">Thổ Nhĩ Kỳ</option>
                    <option value="Trung Quốc">Trung Quốc</option>
                    <option value="Việt Nam">Việt Nam</option>
                </select>
            </div>
        </div>

        <div class="brands__main">
            <div class="brands__banner">
                <img class="active transition" src="./images/enchanteur_theme.webp" alt="">
                <img class="transition" src="./images/aesturavn_theme.webp" alt="">
                <img class="transition" src="./images/perfectdiary_theme.webp" alt="" style="object-fit: cover;">
                <button class="transition"><i class="fa-solid fa-chevron-right"></i></button>
            </div>

            <div id="brands__list">
                <h1>Thương hiệu sản phẩm <i class="fa-solid fa-warehouse"></i></h1>
                <h4 style="display: none; text-align: center;">Không tìm thấy kết quả nào!</h4>
                <div class="brands__list--grid">
                    <?php
                    if (count($brandArr) > 0) {
                        foreach ($brandArr as $brand) {
                            echo "<a href='brand_select.php?this_brand=" . $brand->getId() . "' class='brand transition'
                            data-id='" . $brand->getId() . "'
                            data-country='" . $brand->getAddress() . "'>
                            <div class='brand__background' style='background-image: url(" . $brand->getBackgroundUrl() . ");'></div>
                            <img class='transition' src='" . $brand->getIconUrl() . "' alt=''>
                            <h5>" . $brand->getName() . "</h5>
                        </a>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <a class="ScrollToTop" href="#"><i class="fa-solid fa-angles-up"></i></a>
    </div>
    <?php require_once "./php/footer.php" ?>
</body>
<script src="./js/function.js"></script>
<script>
    let indexBanner = 0;
    const brands__bannerImg = $$('.brands__banner>img');

    function ChangeBanner() {
        $('.brands__banner>img.active')?.classList.remove('active');
        $('.brands__banner>img.past')?.classList.remove('past');
        brands__bannerImg[indexBanner].classList.add('past');
        indexBanner++;
        if (indexBanner > 2) {
            indexBanner = 0;
        }
        EventAddActive(brands__bannerImg[indexBanner]);
    }

    let bannerInterval = setInterval(ChangeBanner, 3000);

    $('.brands__banner>button').addEventListener('click', () => {
        clearInterval(bannerInterval);
        ChangeBanner();
        bannerInterval = setInterval(ChangeBanner, 3000);
    });

    $$('.brands__filter--sort>a').forEach((element, index) => {
        element.addEventListener('click', () => {
            $('.brands__filter--sort>a.active')?.classList.remove('active');
            EventAddActive(element);

            const brandsElement = Array.from($$('.brands__list--grid>.brand'));
            brandsElement.sort((a, b) => {
                return index === 0 ?
                    a.dataset.id.localeCompare(b.dataset.id) :
                    b.dataset.id.localeCompare(a.dataset.id);
            });
            const parent = $('.brands__list--grid');
            parent.innerHTML = '';
            brandsElement.forEach(brand => parent.appendChild(brand));
        });
    });

    const selectElement = $('.brands__filter--country>select');
    const optionValues = Array.from(selectElement.options).map(option => option.value);

    function filterSearch() {
        const parent = $('.brands__list--grid');

        const searchValue = $('.brands__filter--search>input').value.trim().toLowerCase();
        const indexCountry = selectElement.selectedIndex;
        $$('.brands__list--grid>.brand').forEach((brand) => {
            const matchesCountry = indexCountry === 0 || brand.dataset.country.includes(optionValues[indexCountry]);
            const matchesSearch = searchValue === '' || brand.dataset.id.trim().toLowerCase().includes(searchValue);
            if (matchesCountry && matchesSearch) {
                brand.style.display = 'block';
            } else {
                brand.style.display = 'none';
            }
        });
        if (emptyResult() === 0) {
            $('#brands__list>h4').style.display = 'block';
        } else {
            $('#brands__list>h4').style.display = 'none';
        }
    }

    function emptyResult() {
        let indexBrandsBlock = 0;
        const brands = $$('.brands__list--grid>.brand');
        brands.forEach(element => {
            if (element.style.display != 'none') {
                indexBrandsBlock++;
            }
        });
        return indexBrandsBlock;
    }


    $('.brands__filter--country>select').addEventListener('change', filterSearch);
    $('.brands__filter--search>a').addEventListener('click', filterSearch);
    $('.brands__filter--search>input').addEventListener('input', filterSearch);
</script>

</html>