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
    <title></title>
</head>
<style>
    #container {
        width: 95vw;
        height: calc(100vh - 13vh);
        margin: auto;
        margin-top: 13vh;
        display: flex;

        & .leftMenu {
            width: 15vw;
            height: 100%;
            border-radius: 10% 10% 0 0;
            overflow: hidden;

            & .user__display {
                background-image: linear-gradient(to bottom, #0000005b, #000000), url(./images/SummonersRift.webp);
                background-position: center;
                background-size: cover;
                height: 30%;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: space-around;

                & h3 {
                    width: 100%;
                    text-align: center;
                    font-weight: bold;
                    font-size: 1vw;
                    color: #fff;
                }

                & img {
                    height: 70%;
                    border-radius: 50%;
                    object-fit: contain;
                    border: 1px solid red;
                    background-color: wheat;
                }
            }

            & .leftMenu__function {
                height: 20%;
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: space-around;

                & button {
                    width: 100%;
                    height: 5vh;

                    &.active {
                        background-color: #ec6b81;
                        color: #fff;
                    }
                }
            }

            & .others {
                height: 40%;
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: end;

                & a {
                    background-color: black;
                    color: #fff;
                    padding: 0 10px;
                }
            }
        }

        & .container {
            width: 70vw;
            height: 100%;

            & .container__item {
                display: none;

                &.active {
                    display: block;
                }
            }

            & .user_purchased {
                max-height: 80%;
                width: 100%;
                margin-top: 5%;
                overflow-y: auto;
                border: 2px solid #ec6b81;

                & table {
                    width: 100%;
                    border-collapse: collapse;

                    & td,
                    & th {
                        height: 5vh;
                        padding: 0 5px;
                        text-align: center;
                        border: 2px solid #ec6b81;

                        & img {
                            width: 100%;
                            height: 100%;
                            object-fit: contain;
                        }
                    }

                    & thead {
                        position: sticky;
                        top: 0;
                        color: white;
                        background-color: #ec6b81;
                    }

                    & tbody {
                        td {
                            border: 1px solid red;
                        }
                    }
                }
            }

            & .user_profile {
                max-height: 80%;
                width: 100%;
                margin-top: 5%;


                table {
                    width: 100%;
                    margin: 20px auto;
                    border-collapse: collapse;
                    font-family: Arial, sans-serif;
                }


                th,
                td {
                    padding: 12px;
                    text-align: left;
                    border-bottom: 1px solid #ddd;
                }


                th {
                    color: #fff;
                    background-color: #ec6b81;
                    font-weight: bold;
                    width: 150px;
                }


                td input[type="text"],
                td input[type="email"],
                td input[type="password"],
                td input[type="date"],
                td input[type="radio"],
                td input[type="reset"],
                td input[type="submit"],
                td button {
                    width: 100%;
                    padding: 8px;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                    box-sizing: border-box;
                }

                td input[type="radio"] {
                    width: 20%;
                }

                td input[type="password"] {
                    width: 80%;
                }

                button {
                    background-color: #ec6b81;
                    color: #fff;
                    border: none;
                    padding: 8px 16px;
                    border-radius: 4px;
                    cursor: pointer;
                    transition: background-color 0.3s ease;
                }

                button:hover {
                    background-color: #d45570;
                }

                input[type="submit"],
                input[type="reset"] {
                    background-color: #f5f5f5;
                    color: #333;
                    cursor: pointer;
                    border-radius: 4px;
                }

                input[type="submit"] {
                    background-color: #ec6b81;
                    color: white;
                    display: inline-block;
                }

                input[type="reset"] {
                    background-color: #ddd;
                }

                input[type="reset"]:hover,
                input[type="submit"]:hover {
                    opacity: 0.9;
                }


                tr+tr {
                    margin-top: 10px;
                }

                td:last-child {
                    display: flex;
                    gap: 10px;
                    justify-content: flex-start;
                }

            }
        }

        & .review {
            z-index: 4;
            position: fixed;
            display: none;
            align-items: center;
            justify-content: center;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            background-color: #00000022;

            &.active {
                display: flex;
            }

            & .review__border {
                position: relative;
                width: 20%;
                height: 40%;
                background-color: #fff;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;

                & button {
                    position: absolute;
                    right: 0;
                    top: 0;
                    padding: 0.3vw;
                    border: none;
                }
            }
        }
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
                    <tr>
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
                                            <a style="text-decoration: underline; color: white; background-color: green; padding: 5px;" href="./product_select.php?this_product=<?php echo $item[0]; ?>">Xem</a>
                                            <a class="btnReview" style="text-decoration: underline; color: white; background-color: orange; padding: 5px;">Đánh giá</a>
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