<?php
require_once "./php/connect.php";

$sql = "SELECT username FROM user";
$username = [];
$result = mysqli_query($connect, $sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $username[] = $row['username'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign up | EVE</title>
    <link rel="stylesheet" href="./css/login.css" />
    <script src="./assets/js/login.js"></script>
</head>

<body>
    <main class="auth">
        <!--Auth Intro-->

        <div class="auth__intro">
            <!--Logo-->
            <a href="./" class="logo auth__intro-logo d-none d-md-flex">
                <img src="./assets/icons/logo.svg" alt="grocerymart" class="img__logo" />
                <h1 class="logo__title">Le Belle</h1>
            </a>
            <img src="./assets/images/auth/intro.png" alt="" class="auth__intro-img" />
            <p class="auth__intro-text">
                Giá trị thương hiệu cao cấp nhất, sản phẩm chất lượng cao và dịch vụ sáng tạo
            </p>
            <button class="auth__intro-next d-none d-md-flex js-toggle" toggle-target="#auth-content">
                <img src="./assets/images/auth/intro-arrow.svg" alt="" />
            </button>
        </div>
        <!--Auth Content-->
        <div id="auth-content" class="auth__content hide">
            <div class="auth__content-inner">
                <!--Logo-->
                <a href="./" class="logo">
                    <img src="./assets/icons/logo.svg" alt="grocerymart" class="img__logo" />
                    <h1 class="logo__title">Le Belle</h1>
                </a>
                <h1 class="auth__heading">Đăng kí tài khoản</h1>
                <p class="auth__desc">Hãy đăng kí tài khoản của bạn để thoả thích mua sắm.</p>
                <form action="sign-up_info.php" method="POST" class="form auth__form">
                    <div class="form__group">
                        <div class="form__text-input">
                            <input type="email" name="email" id="" placeholder="Email" class="form__input input_username" required />
                            <img src="./assets/icons/message.svg" alt="" class="form__input-icon" />
                            <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                        </div>
                        <p class="form__error">Email chưa đúng định dạng</p>
                    </div>
                    <div class="form__group">
                        <div class="form__text-input">
                            <input type="password" name="password" id="password" placeholder="Mật khẩu"
                                class="form__input" required minlength="8" />
                            <img src="./assets/icons/lock.svg" alt="" class="form__input-icon" id="togglePassword" />
                            <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                        </div>
                        <p class="form__error">Mật khẩu ít nhất 8 ký tự</p>
                    </div>
                    <div class="form__group">
                        <div class="form__text-input">
                            <input type="password" name="confirmPassword" id="confirmPassword"
                                placeholder="Xác nhận mật khẩu" class="form__input" required minlength="8" />
                            <img src="./assets/icons/lock.svg" alt="" class="form__input-icon"
                                id="toggleConfirmPassword" />
                            <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                        </div>
                        <p class="form__error">Mật khẩu ít nhất 8 ký tự</p>
                    </div>

                    <div class="form__group auth__btn-group">
                        <button type="button" class="btn btn--primary auth__btn form__submit-btn">TIẾP THEO</button>
                    </div>
                </form>
                <p class="auth__text">
                    Bạn đã có tài khoản chưa?
                    <a href="./sign-in.html" class="auth__link auth__text-link">Đăng nhập</a>
                </p>
                <p class="auth__text">
                    <a href="./index.php" class="auth__link auth__text-link">Trang chủ</a>
                </p>
            </div>
        </div>

    </main>
    <script src="./js/function.js"></script>
    <script>
        const listUserName = [
            <?php
            foreach ($username as $index => $item) {
                echo "'" . $item . "'";
                if ($index < count($username) - 1) {
                    echo ",";
                }
            }
            ?>
        ]

        $('.form__submit-btn').addEventListener('click', () => {
            temp = true;
            mess = "";

            listUserName.forEach(element => {
                if ($('.input_username').value == element) {
                    temp = false;
                    mess += "Tên tài khoản đã tồn tại!\n";
                }
            });

            if ($('#password').value != $('#confirmPassword').value) {
                temp = false;
                mess += "Mật khẩu không khớp với xác thực!\n"
            }




            if (temp) {
                $('form').submit();
            } else {
                alert(mess);
            }
        })
        window.dispatchEvent(new Event("template-loaded"));
    </script>
</body>

</html>