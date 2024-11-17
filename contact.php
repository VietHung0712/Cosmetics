<?php
require_once "./php/connect.php";
require_once "./php/class.php";
require_once "./php/Manager_Brands.php";
require_once "./php/Manager_Categories.php";

$_SESSION['currentFileName'] = basename(__FILE__);

if (!isset($_SESSION['user_id'])) {
    header("Location: sign-in.php");
    exit();
}
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tilte = $_POST['tilte'];
    $content = $_POST['content'];

    $sql = "INSERT INTO contact VALUES ('', ?, ?, ?)";
    $result = mysqli_prepare($connect, $sql);
    if ($result) {
        $result->bind_param("iss", $user_id, $tilte, $content);
        if ($result->execute()) {
            header("Location: ./contact.php");
            exit();
        } else {
            echo "<script>alert('Đã có lỗi!')</script>";
        }
        $result->close();
    } else {
        echo "<script>alert('Không thể chuẩn bị truy vấn!')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/logo_project.png">
    <link rel="stylesheet" href="./assets/fontawesome-free-6.6.0-web/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/head_footer.css">
    <title>EVE</title>
</head>
<style>
    html,
    body,
    div,
    span,
    applet,
    object,
    iframe,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    blockquote,
    pre,
    a,
    abbr,
    acronym,
    address,
    big,
    cite,
    code,
    del,
    dfn,
    em,
    img,
    ins,
    kbd,
    q,
    s,
    samp,
    small,
    strike,
    strong,
    sub,
    sup,
    tt,
    var,
    b,
    u,
    i,
    center,
    dl,
    dt,
    dd,
    ol,
    ul,
    li,
    fieldset,
    form,
    label,
    legend,
    table,
    caption,
    tbody,
    tfoot,
    thead,
    tr,
    th,
    td,
    article,
    aside,
    canvas,
    details,
    embed,
    figure,
    figcaption,
    footer,
    header,
    hgroup,
    menu,
    nav,
    output,
    ruby,
    section,
    summary,
    time,
    mark,
    audio,
    video {
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        font: inherit;
        vertical-align: baseline;
    }

    /* HTML5 display-role reset for older browsers */
    article,
    aside,
    details,
    figcaption,
    figure,
    footer,
    header,
    hgroup,
    menu,
    nav,
    section {
        display: block;
    }

    body {
        line-height: 1;
    }

    ol,
    ul {
        list-style: none;
    }

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

    .container {
        width: 100%;
        overflow: hidden;
    }

    .container-contact {
        width: 80%;
        margin: 120px auto;
        padding: 0 40px;
    }

    .contact-row {
        display: flex;
        gap: 40px;
    }

    .form-contact {
        width: 880px;
    }

    .sub-title {
        font-weight: 400;
        font-size: 30px;
    }

    .title {
        font-weight: 600;
        font-size: 42px;
        margin-top: 10px;
        margin-bottom: 38px;
    }

    .form-row+.form-row {
        margin-top: 10px;
    }

    .form-row {
        display: flex;
        gap: 20px;
    }

    .form-input {
        padding: 10px 10px;
        flex-grow: 1;
        outline: none;
        border: 1px solid #cdc8c8;
    }

    .form-input:focus,
    .form-textarea:focus {
        border: 1px solid #ec6b81;
    }

    .btn-submit {
        font-size: 16px;
        margin-top: 20px;
        padding: 5px 30px;
        border-radius: 999px;
        border: none;
        color: #fff;
        background-color: #ec6b81;
        outline: none;
        cursor: pointer;
    }

    .form-textarea {
        width: 100%;
        outline: none;
        padding: 8px 0 14px 0;
        color: #0d0d3b;
    }

    .form-textarea {
        resize: none;
        min-height: 200px;
    }

    .form:has(:invalid) .btn-submit {
        opacity: 0.5;
        pointer-events: none;
    }

    .form-info {
        width: 300px;
        padding: 20px 40px;
        background-color: #f2f0f0;
        display: flex;
        flex-direction: column;
        gap: 10px;
        justify-content: space-around;
    }

    .info-label {
        font-size: 20px;
        font-weight: 600;
        color: #ec6b81;
        margin-bottom: 20px;
    }

    span {
        display: block;
        font-size: 16px;
        color: #676565;
    }

    span+span {
        margin-top: 10px;
    }

    .container-icon {
        width: 100vw;
        background-color: #e7a7b2;
        height: 125px;
        display: flex;
        justify-content: space-around;
        padding-top: 30px;
    }

    .icon-box {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;
    }

    .icon {
        object-fit: contain;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }

    .separator {
        width: 2px;
        height: 90px;
        background-color: #ffffff;
    }

    .info-item:hover .icon-box {
        animation: tada 1s linear infinite;
    }

    @keyframes tada {
        0% {
            transform: scale3d(1, 1, 1);
        }

        10%,
        20% {
            transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
        }

        30%,
        50%,
        70%,
        90% {
            transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
        }

        40%,
        60%,
        80% {
            transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
        }

        100% {
            transform: scale3d(1, 1, 1);
        }
    }

    .contact-socials {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 50px;
        gap: 20px;
    }

    .socials-icon {
        display: flex;
        gap: 20px;
    }

    .social-icon_item {
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        border-radius: 50%;
        transition: ease-in-out 0.25s;
    }

    .social-icon_item:hover {
        cursor: pointer;
        background-color: #ec6b81;
    }

    .heading-social {
        font-size: 28px;
        font-weight: 600;
    }
</style>

<body>
    <?php require_once "./php/head.php" ?>
    <div class="container">
        <div class="container-contact">
            <div class="contact-row">
                <div class="form-contact">
                    <span class="sub-title">Đừng lo!</span>
                    <h2 class="title">
                        Nếu bạn có bất kỳ câu hỏi nào? Hãy liên hệ với chúng
                        tôi.
                    </h2>
                    <form action="./contact.php" class="form" method="POST">
                        <div class="form-row">
                            <input
                                type="text"
                                name="tilte"
                                id=""
                                required
                                class="form-input"
                                placeholder="Tiêu đề" />
                        </div>

                        <div class="form-row">
                            <textarea
                                name="content"
                                id=""
                                required
                                class="form-textarea"
                                placeholder=" Nội dung"></textarea>
                        </div>
                        <div class="form-btn">
                            <button type="button" class="btn-submit">
                                Gửi
                            </button>
                        </div>
                    </form>
                </div>
                <div class="form-info">
                    <div class="form-info_title">
                        <p class="info-label">Số điện thoại:</p>
                        <span class="desc">(84)369709603</span>
                        <span class="desc">(84)123456789</span>
                        <span class="desc">(84)98654321</span>
                    </div>
                    <div class="form-info_title">
                        <p class="info-label">Email:</p>
                        <span class="desc">tranviethung712@gmail.com</span>
                        <span class="desc">tuaans09@gmail.com</span>
                        <span class="desc">nguyenducluong@gmail.com</span>
                    </div>
                    <div class="form-info_title">
                        <p class="info-label">Địa chỉ:</p>
                        <span class="desc">Bac Ninh, Viet Nam</span>
                        <span class="desc">Bac Giang, Viet Nam</span>
                        <span class="desc">Ha Noi, Viet Nam</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-icon">
            <div class="info-item">
                <div class="icon-box">
                    <img src="./assets/icons/tel.svg" alt="" class="icon" />
                </div>
                <p>0369709603 9AM-6PM</p>
            </div>
            <div class="separator"></div>
            <div class="info-item">
                <div class="icon-box">
                    <img src="./assets/icons/email.svg" alt="" class="icon" />
                </div>
                <p>tranviethung712@gmail.com</p>
            </div>
            <div class="separator"></div>
            <div class="info-item">
                <div class="icon-box">
                    <img src="./assets/icons/mess.svg" alt="" class="icon" />
                </div>
                <p>www.facebook.com/profile.php?id=100008502786746</p>
            </div>
        </div>
        <div class="contact-socials">
            <p class="heading-social">Let’s Connect On Social</p>
            <div class="socials-icon">
                <img src="./assets/icons/face.svg" alt="" class="social-icon_item" />
                <img
                    src="./assets/icons/twitter.svg"
                    alt=""
                    class="social-icon_item" />
                <img
                    src="./assets/icons/youtube.svg"
                    alt=""
                    class="social-icon_item" />
                <img src="./assets/icons/ins.svg" alt="" class="social-icon_item" />
            </div>
            <p class="desc">
                Follow us on your favorite platforms. Check out new launch
                teasers, how-to videos, and share your favorite looks.
            </p>
        </div>
    </div>
    <?php require_once "./php/footer.php" ?>
</body>

</html>

<script src="./js/function.js"></script>
<script>
    $('.btn-submit').addEventListener('click', () => {
        alert("Đã gửi phản ánh!");
        $('form').submit();
    })
</script>