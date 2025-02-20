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



use ClassProject\User;

$sql_user = "SELECT * FROM user WHERE id = '" . $user_id . "'";
$result_user = $connect->query($sql_user);
if ($result_user->num_rows > 0) {
    while ($row = $result_user->fetch_assoc()) {
        $this_user = new User($row['id'], $row['displayname'], $row['username'], $row['password'], $row['gender'], $row['address'], $row['phone'], $row['birthday'], $row['image_url']);
    }
}

$userPurchase = [];
$sql_purchased = "SELECT
	p.*,
    sit.quantity, sit.price,
    si.time,
    pi.attributes
    
    FROM
        sales_invoice_items sit
    JOIN 
        sales_invoices si ON sit.sales_invoices = si.id
    JOIN 
        product_item pi ON sit.product_item = pi.id
    JOIN 
        product p ON pi.product = p.id
    WHERE si.user = " . $user_id . " ORDER BY sit.sales_invoices DESC";
$result_purchased = $connect->query($sql_purchased);
if ($result_purchased->num_rows > 0) {
    while ($row = $result_purchased->fetch_assoc()) {
        $userPurchase[] = [$row['id'], $row['name'], $row['attributes'], $row['quantity'], $row['price'], $row['time'], $row['image_url']];
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/fontawesome-free-6.6.0-web/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/head_footer.css">
    <title>EVE</title>
</head>
<style>

    #container {
        display: flex;
        width: 100%;
        margin: 20px auto;
        background: white;
        border-radius: 8px;
        margin-top: 13vh;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .leftMenu {
        position: fixed;
        width: 15%;
        background-color: #ec6b81;
        color: white;
        padding: 20px;
        height: 100%;
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
        z-index: 3;
    }

    .user__display {
        text-align: center;
        margin-bottom: 20px;

        h3{
            font-size: 1.5vw;
        }
    }

    .user__display img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }

    .leftMenu__function {
        margin-bottom: 20px;
    }

    .leftMenu__function button {
        width: 100%;
        background-color: transparent;
        border: none;
        color: white;
        padding: 10px;
        text-align: left;
        cursor: pointer;
        font-size: 16px;
    }

    .leftMenu__function button.active {
        background-color: rgba(255, 255, 255, 0.2);
    }

    .others a {
        color: white;
        text-decoration: none;
        padding: 10px;
        display: block;
    }

    .container {
        width: 100%;
        margin-left: 15vw;
        padding: 20px;
    }

    .container__item {
        display: none;
    }

    .container__item.active {
        display: block;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 15px;
        text-align: left;
    }

    th {
        background-color: #ec6b81;
        color: white;
    }

    td img {
        width: 50px;
        /* Adjust size for product images */
        height: 50px;
    }

    .review {
        display: none;
        /* Initially hidden, can be shown with JavaScript */
    }

    .review__border {
        border: 1px solid #ccc;
        padding: 10px;
        margin-top: 10px;
        background-color: #f9f9f9;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="date"],
    input[type="tel"],
    textarea,
    select {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button,
    input[type="submit"],
    input[type="reset"] {
        background-color: #ec6b81;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover,
    input[type="submit"]:hover,
    input[type="reset"]:hover {
        background-color: #0056b3;
    }

    input[type="checkbox"] {
        margin-right: 5px;
    }
</style>

<body>
    <?php require_once './php/head.php'; ?>
    <div id="container">
        <div class="leftMenu">
            <div class="user__display">
                <img src="<?php echo $this_user->getImageUrl(); ?>" alt="">
                <h3><?php echo $this_user->getDisplayName(); ?></h3>
            </div>
            <div class="leftMenu__function">
                <button class="active">Đơn hàng đã mua</button>
                <button>Hồ sơ của tôi</button>
            </div>
            <div class="others">
                <a href="./php/signout.php">Đăng xuất <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
            </div>
        </div>
        <div class="container">
            <div class="container__item active user_purchased">
                <table>
                    <thead>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Loại</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Thời gian</th>
                        <th>Sản phẩm</th>
                    </thead>
                    <tbody>
                        <?php
                        if (count($userPurchase) > 0) {
                            foreach ($userPurchase as $item) {
                        ?>
                                <tr>
                                    <td><img src="<?php echo $item[6]; ?>" alt=""></td>
                                    <td><?php echo $item[1]; ?></td>
                                    <td><?php echo $item[2]; ?></td>
                                    <td><?php echo $item[3]; ?></td>
                                    <td><?php echo $item[4]; ?></td>
                                    <td><?php echo $item[5]; ?></td>
                                    <td>
                                        <ul>
                                            <li><a style="text-decoration: underline; color: white; background-color: green;" href="./product_select.php?this_product=<?php echo $item[0]; ?>">Xem</a></li>
                                            <li><a class="btnReview" style="text-decoration: underline; color: white; background-color: orange;text-wrap: nowrap;">Đánh giá</a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <div class="review">
                                    <div class="review__border">
                                        <form action="./manager/user_review.php?this_product=<?php echo $item[0]; ?>" method="POST">
                                            Xếp hạng: <span>1<input type="range" name="rating" min="1" max="5" value="5">5</span><br>
                                            Phản hồi: <textarea name="text"></textarea> <br>

                                            <button type="button">X</button>
                                            <input type="submit" value="Xác nhận">
                                        </form>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='7'>Không có dữ liệu</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="container__item user_profile">
                <form action="./manager/user_info_update.php" method="POST">
                    <table>
                        <tr>
                            <th>Tên hiển thị</th>
                            <td>
                                <input type="text" name="displayname" value="<?php echo $this_user->getDisplayName() ?>" readonly required>
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>
                                <input type="email" name="username" value="<?php echo $this_user->getUserName() ?>" readonly required>
                            </td>
                        </tr>
                        <tr>
                            <th>Mật khẩu</th>
                            <td>
                                <input type="password" class="inputPassword" name="password" value="<?php echo $this_user->getPassWord() ?>" readonly required>
                                <input type="checkbox">Hiển thị
                            </td>
                        </tr>
                        <tr>
                            <th>Giới tinh</th>
                            <td>
                                <input type="radio" name="gender" value="Nam" <?php if ($this_user->getGender() == 'Nam') echo 'checked'; ?>>Nam
                                <input type="radio" name="gender" value="Nữ" <?php if ($this_user->getGender() == 'Nữ') echo 'checked'; ?>>Nữ
                            </td>
                        </tr>
                        <tr>
                            <th>Địa chỉ</th>
                            <td>
                                <input type="text" name="address" value="<?php echo $this_user->getAddress() ?>" readonly required>
                            </td>
                        </tr>
                        <tr>
                            <th>Ngày sinh</th>
                            <td>
                                <input type="date" name="birthday" value="<?php echo $this_user->getBirthday() ?>" readonly required>
                            </td>
                        </tr>
                        <tr>
                            <th>Điện thoại</th>
                            <td>
                                <input type="text" name="phone" value="<?php echo $this_user->getPhone() ?>" readonly required>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <button type="button">Sửa</button>
                                <input type="reset" value="Hủy">
                                <input style="display: none;" type="submit" value="Lưu">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <?php require_once "./php/footer.php" ?>
</body>
<script src="./js/function.js"></script>
<script>
    $$('.leftMenu__function>button').forEach((element, index) => {
        const container__items = $$('.container__item');
        element.addEventListener('click', () => {
            $('.leftMenu__function>button.active')?.classList.remove('active');
            $('.container__item.active')?.classList.remove('active');

            EventAddActive(element);
            EventAddActive(container__items[index]);
        })
    });

    $$('.btnReview').forEach((element, index) => {
        const review = $$('.review');
        element.addEventListener('click', () => {
            EventAddActive(review[index]);
        })
    })
    $$('.review button').forEach((element, index) => {
        const review = $$('.review');
        element.addEventListener('click', () => {
            EventRemoveActive(review[index]);
        })
    })

    $('.user_profile button').addEventListener('click', () => {
        $('.user_profile input[type=submit]').style.display = 'block';
        $$(".user_profile input[readonly]").forEach(input => {
            input.removeAttribute("readonly");
        });
    })

    $('.user_profile input[type="reset"]').addEventListener('click', function() {
        $('.user_profile input[type="submit"]').style.display = 'none';;
        $(".user_profile input[type=date]").readOnly = true;
        $(".user_profile input[type=email]").readOnly = true;
        $(".user_profile input[type=password]").readOnly = true;
        $$(".user_profile input[type=text]").forEach(input => {
            input.readOnly = true;
        });
    });

    $('.user_profile input[type=checkbox]').addEventListener('change', function() {
        const passwordField = $(".inputPassword");
        if (this.checked) {
            passwordField.type = 'text';
        } else {
            passwordField.type = 'password';
        }
    });
</script>

</html>