<div id='head' class="w-100 position-fixed d-flex">
    <a href="./index.php" class=" d-flex h-100 justify-content-between align-items-center" style="background-color: #ec6b81; width: 15%; border-radius: 0 50px 50px 0;">
        <img class="w-50 h-75 object-fit-contain" style="filter: drop-shadow(10px 10px 10px #000000a0);" src="./images/logo_project.png" alt="">
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
                            echo "<li><a href='./products.php?this_categories=" . $categories->getId() . "#searchForm'>" . $categories->getName() . "</a></li>";
                        }
                        ?>
                    </ul>
                </li>
                <li>
                    <a class="topMenu" href="./brands.php">Thương hiệu <i class="fa-solid fa-chevron-down"></i></a>
                    <ul>
                        <?php
                        foreach ($brandArr as $brand) {
                            echo "<li><a href='./brand_select.php?this_brand=" . $brand->getId() . "'>" . $brand->getName() . "</a></li>";
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