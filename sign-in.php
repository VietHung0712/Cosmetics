<?php
require_once "./php/connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $connect->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];

        $location = $_SESSION['currentFileName'];
        unset($_SESSION['currentFileName']);
        header("Location: $location");
        exit();
    } else {
        echo "<script>alert('Sai tên đăng nhập hoặc mật khẩu!');</script>";
    }

    $stmt->close();
    mysqli_close($connect);
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Sign In | EVE</title>
        <link rel="stylesheet" href="./css/login.css" />
        <script src="./assets/js/login.js"></script>
    </head>

    <body>
        <main class="auth">
            <!--Auth Intro-->

            <div class="auth__intro d-md-none">
                <!--Logo-->

                <img src="./assets/images/auth/intro.png" alt="" class="auth__intro-img" />
                <p class="auth__intro-text">
                    Giá trị thương hiệu cao cấp nhất, sản phẩm chất lượng cao và dịch vụ sáng tạo
                </p>
            </div>
            <!--Auth Content-->
            <div class="auth__content">
                <div class="auth__content-inner">
                    <!--Logo-->
                    <a href="./" class="logo">
                        <img src="./assets/icons/logo.svg" alt="grocerymart" class="img__logo" />
                        <h2 class="logo__title">EVE</h2>
                    </a>
                    <h1 class="auth__heading">Đăng nhập</h1>
                    <p class="auth__desc">Hãy đăng nhập tài khoản của bạn để thoả thích mua sắm.</p>
                    <form action="./sign-in.php" class="form auth__form" method="POST">
                        <div class="form__group">
                            <div class="form__text-input">
                                <input type="email" name="username" id="" placeholder="Email" class="form__input" required />
                                <img src="./assets/icons/message.svg" alt="" class="form__input-icon" />
                                <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                            </div>
                            <p class="form__error">Email chưa đúng định dạng</p>
                        </div>
                        <div class="form__group">
                            <div class="form__text-input">
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    placeholder="Mật khẩu"
                                    class="form__input"
                                    required
                                    minlength="8"
                                />
                                <img
                                    src="./assets/icons/lock.svg"
                                    alt=""
                                    class="form__input-icon"
                                    id="togglePassword"
                                />
                                <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                            </div>
                            <p class="form__error">Mật khẩu ít nhất 8 ký tự</p>
                        </div>

                        <div class="form__group form__group--inline">
                            <label class="form__checkbox d-none">
                                <input type="checkbox" name="" id="" class="form__checkbox-input d-none" />
                                <span class="form__checkbox-label">Set as default card</span>
                            </label>
                            
                        </div>
                        <div class="form__group auth__btn-group">
                            <button class="btn btn--primary auth__btn form__submit-btn">ĐĂNG NHẬP</button>
                        </div>
                    </form>
                    <p class="auth__text">
                        Bạn chưa có tài khoản?
                        <a href="./sign-up.php" class="auth__link auth__text-link">Đăng ký</a>
                    </p>
                    <p class="auth__text">
                        <a href="./index.php" class="auth__link auth__text-link">Trang chủ</a>
                    </p>
                </div>
            </div>
        </main>
        <script>
            window.dispatchEvent(new Event("template-loaded"));
        </script>
    </body>
</html>
