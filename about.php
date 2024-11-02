<?php
require_once "./php/connect.php";
require_once "./php/class.php";
require_once "./php/Manager_Brands.php";
require_once "./php/Manager_Categories.php";
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
    <title>EVE</title>
</head>
<style>
    .container {
        width: 1200px;
        margin: 100px auto;

        blockquote,
        q {
            quotes: none;
        }

        blockquote:before,
        blockquote:after,
        q:before,
        q:after {
            content: "";
            content: none;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        h1 {
            font-size: 27px;
            font-weight: 600;
            background: rgb(255, 228, 232);
            padding: 15px;
            border-left: 3px solid#ec6b81;
            line-height: 1.4;
        }

        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
        }

        .about-info {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        p,
        .about_desc {
            line-height: 1.7143;
        }


    }

    .about-sup {
        display: flex;
        width: 100%;
        padding: 40px 20px;
        height: 100px;
        background-color: #e4c7cc;
        justify-content: space-around;
        align-items: center;
    }

    .icon-box {
        border: 3px solid rgba(236, 107, 129, 0.6);
        border-radius: 50%;
        height: 80px;
        line-height: 75px;
        left: 0;
        position: absolute;
        top: 0;
        text-align: center;
        transition: all 0.3s ease-out;
        width: 80px;
    }

    .icon-box::before {
        border: 3px dashed rgba(236, 107, 129, 0.6);
        content: "";
        position: absolute;
        top: -3px;
        left: -3px;
        right: -3px;
        bottom: -3px;
        border-radius: 50%;
        z-index: 10;
        opacity: 0;
        animation: spinAround 9s linear infinite;
        transform: scale(0);
        transition: all 0.3s ease-out;
    }

    .sup-img {
        vertical-align: middle;
    }

    .about-sup_group {
        display: flex;
        gap: 15px;
        align-items: center;
        position: relative;
        padding-left: 100px;
    }

    .about-sup_group:hover .icon-box::before {
        opacity: 1;
        transform: scale(1);
    }

    .about-sup_group:hover .icon-box {
        border: 3px solid transparent;
    }

    .about-sup_info {
        width: 300px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .sup-title {
        font-size: 20px;
        font-weight: 600;
    }

    .desc {
        font-size: 10px;
        line-height: 1;
    }

    @keyframes spinAround {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<body>
    <?php require_once "./php/head.php" ?>
    <div class="container">
        <div class="about-content">
            <div class="about-info">
                <h1>
                    Chào mừng đến với EVE – Điểm đến hoàn hảo cho vẻ
                    đẹp và sự tự tin
                </h1>
                <p>
                    Tại EVE, chúng tôi không chỉ cung cấp mỹ phẩm, mà
                    còn là người bạn đồng hành trên hành trình tỏa sáng và
                    chăm sóc bản thân của bạn. Hiểu rằng vẻ đẹp đích thực
                    bắt nguồn từ sự tự tin, chúng tôi luôn chọn lọc những
                    sản phẩm chất lượng cao, an toàn và phù hợp nhất, giúp
                    bạn tự tin khẳng định cá tính và phong cách riêng.
                </p>
            </div>
            <div class="about-img">
                <img src="./assets/images/about.webp" alt="" class="img" />
            </div>
            <div class="about-info">
                <h1>Sứ mệnh của chúng tôi</h1>
                <p>
                    Chúng tôi luôn đặt chất lượng và sự hài lòng của khách
                    hàng lên hàng đầu. Đội ngũ của EVE cam kết mang đến
                    sản phẩm chính hãng, xuất xứ rõ ràng từ các thương hiệu
                    nổi tiếng và uy tín trên toàn cầu. Đặc biệt, chúng tôi
                    liên tục cập nhật những xu hướng làm đẹp mới nhất, để
                    bạn luôn là người dẫn đầu trong hành trình làm đẹp.
                </p>
            </div>
            <div class="about-info">
                <h1>Trải nghiệm đa dạng và khác biệt</h1>
                <p>
                    Dù bạn là người yêu thích chăm sóc da, đam mê trang
                    điểm, hay đơn giản chỉ muốn tìm kiếm hương nước hoa
                    quyến rũ, EVE đều có thể đáp ứng mọi nhu cầu với bộ
                    sưu tập phong phú từ các sản phẩm dưỡng da, trang điểm,
                    đến chăm sóc tóc và cơ thể. Mỗi sản phẩm tại cửa hàng
                    chúng tôi không chỉ làm đẹp mà còn mang đến sự thư giãn,
                    chăm sóc và trải nghiệm riêng biệt cho từng khách hàng.
                </p>
            </div>
            <div class="about-info">
                <h1>Tại sao chọn EVE?</h1>
                <p>
                    Với cam kết chỉ cung cấp sản phẩm chính hãng và chất
                    lượng, cùng đội ngũ nhân viên tận tâm sẵn sàng hỗ trợ,
                    chúng tôi tự hào là lựa chọn hàng đầu của hàng ngàn
                    khách hàng trong và ngoài nước. Hãy để chúng tôi giúp
                    bạn tìm thấy sản phẩm hoàn hảo để tôn lên vẻ đẹp tự
                    nhiên và phong cách cá nhân của mình.
                </p>
            </div>
            <div class="about-info">
                <h1>Kết nối với chúng tôi</h1>
                <div class="about_desc">
                    Hãy ghé thăm EVE hoặc liên hệ qua các kênh sau để
                    được tư vấn và trải nghiệm sự khác biệt:
                    <ul>
                        <li>Địa chỉ: Linh Nam, Hoang Mai, Ha Noi</li>
                        <li>Điện thoại: 1900 8989</li>
                        <li>Email: lebelee@gmail.com</li>
                    </ul>
                    Bạn sẽ không chỉ mua sắm, mà còn là trải nghiệm hành
                    trình khám phá vẻ đẹp độc đáo và sự tự tin hoàn hảo.
                    Chúng tôi luôn sẵn lòng đồng hành cùng bạn!
                </div>
            </div>
        </div>
    </div>
    <div class="about-sup">
        <div class="about-sup_group">
            <div class="icon-box">
                <img src="./assets/images/fly.webp" alt="" class="sup-img" />
            </div>
            <div class="about-sup_info">
                <p class="sup-title">Miễn phí vận chuyển</p>
                <p class="desc">
                    Cung cấp giao hàng tận nhà miễn phí cho tất cả sản phẩm
                    trên 1 triệu đồng
                </p>
            </div>
        </div>
        <div class="about-sup_group">
            <div class="icon-box">
                <img src="./assets/images/f02.webp" alt="" class="sup-img" />
            </div>
            <div class="about-sup_info">
                <p class="sup-title">Hỗ trợ trực tuyến</p>
                <p class="desc">
                    Để làm hài lòng khách hàng, chúng tôi cố gắng hỗ trợ
                    trực tuyến
                </p>
            </div>
        </div>
        <div class="about-sup_group">
            <div class="icon-box">
                <img src="./assets/images/seucity.webp" alt="" class="sup-img" />
            </div>
            <div class="about-sup_info">
                <p class="sup-title">Thanh toán an toàn</p>
                <p class="desc">
                    Chúng tôi đảm bảo sản phẩm của chúng tôi luôn có chất
                    lượng tốt
                </p>
            </div>
        </div>
    </div>
    <?php require_once "./php/footer.php" ?>
</body>

</html>
<script src="./js/function.js"></script>