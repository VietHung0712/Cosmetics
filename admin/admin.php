<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.6.0-web/fontawesome-free-6.6.0-web/css/all.min.css">
    <title>EVE - Admin</title>
</head>
<style>
    body {
        display: flex;
        margin: 0;
        justify-content: center;
        align-items: center;
        background-image: url(../images/admin_background.jpg);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 100vh;
        width: 100%;
    }

    .section {
        margin-top: 10vh;
        display: flex;
        gap: 20px;

        .loader {
            height: 150px;
            width: 150px;
        }

        .gear {
            position: relative;
            width: 100%;
            height: 100%;
            background-color: white;
            border-radius: 100%;
        }

        .core {
            width: 50%;
            height: 50%;
            background-color: #ec6b81;
            border-radius: 100%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .tooth {
            width: 125%;
            height: 30px;
            background-color: white;
            border-radius: 4px;
            position: absolute;
            top: 40%;
            left: -13%;
        }

        .tooth:nth-child(2) {
            transform: rotate(45deg);
        }

        .tooth:nth-child(3) {
            transform: rotate(90deg);
        }

        .tooth:nth-child(4) {
            transform: rotate(135deg);
        }

        .loader:nth-child(1),
        .loader:nth-child(3) {
            animation: spin 1s linear infinite;
        }

        .loader:nth-child(2) {
            animation: reverseSpin 1s linear infinite;
        }
    }

    .linkIndex{
        position: absolute;
        top: 30%;
        padding: 10px;
        background-color: #ec6b81;
        color: white;
        font-weight: bold;
        font-size: 2vw;
        text-decoration: none;
        border-radius: 5px;

        &:hover{
            background-color: red;
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(180deg);
        }
    }

    @keyframes reverseSpin {
        0% {
            transform: rotate(-23deg);
        }

        100% {
            transform: rotate(-203deg);
        }
    }
</style>

<body>
    <?php require_once "./admin_header.php" ?>
    <a href="../index.php" class="linkIndex" target="_blank">Đến xem shop <i class="fa-solid fa-shop"></i></a>
    <section class="section">
        <div class="loader">
            <div class="gear">
                <div class="tooth"></div>
                <div class="tooth"></div>
                <div class="tooth"></div>
                <div class="tooth"></div>
                <div class="core"></div>
            </div>
        </div>
        <div class="loader">
            <div class="gear">
                <div class="tooth"></div>
                <div class="tooth"></div>
                <div class="tooth"></div>
                <div class="tooth"></div>
                <div class="core"></div>
            </div>
        </div>
        <div class="loader">
            <div class="gear">
                <div class="tooth"></div>
                <div class="tooth"></div>
                <div class="tooth"></div>
                <div class="tooth"></div>
                <div class="core"></div>
            </div>
        </div>
    </section>
</body>

</html>