<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}
$user_id = $_SESSION['user_id'];

require_once "./php/connect.php";
require_once "./php/class.php";
require_once "./php/Manager_Brands.php";
require_once "./php/Manager_Categories.php";

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
    sit.quantity, sit.price, sit.price AS price2,
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
    WHERE si.user = " . $user_id;
$result_purchased = $connect->query($sql_purchased);
if ($result_purchased->num_rows > 0) {
    while ($row = $result_purchased->fetch_assoc()) {
        $userPurchase[] = [$row['id'], $row['name'], $row['attributes'], $row['quantity'], $row['price2'], $row['time'], $row['image_url']];
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

            & .container__item{
                display: none;

                &.active{
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

            & .user_profile{
                max-height: 80%;
                width: 100%;
                margin-top: 5%;

                & table {
                    width: 100%;
                    border-collapse: collapse;

                    & th{
                        background-color: #ec6b81;
                        color: #fff;
                        width: 10%;
                    }

                    & td{
                        width: 70%;
                        
                        & input{
                            height: 7vh;
                            width: 80%;
                        }

                        & input[type='radio']{
                            height: 2vh;
                            width: 20%;
                        }
                    }

                    & td,
                    & th {
                        height: 7vh;
                        padding: 0 5px;

                        & img {
                            width: 100%;
                            height: 100%;
                            object-fit: contain;
                        }
                    }
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
                <img src="./images/ionia_emblem.png" alt="">
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
                                        <td><?php echo $item[1]; ?></td> <!-- Tên sản phẩm -->
                                        <td><?php echo $item[2]; ?></td> <!-- Thuộc tính -->
                                        <td><?php echo $item[3]; ?></td> <!-- Số lượng -->
                                        <td><?php echo $item[4]; ?></td> <!-- Giá -->
                                        <td><?php echo $item[5]; ?></td> <!-- Thời gian -->
                                        <td><a style="text-decoration: underline;" href="./product_select.php?this_product=<?php echo $item[0]; ?>">Xem</a></td>
                                    </tr>
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
                <table>
                    <tr>
                        <th>Tên hiển thị</th>
                        <td>
                            <input type="text" name="displayname" value="<?php echo $this_user->getDisplayName() ?>" readonly required>
                        </td>
                    </tr>
                    <tr>
                        <th>Giới tinh</th>
                        <td>
                            <input type="radio" name="gender" value="Nam" <?php if($this_user->getGender() == 'Nam') echo 'checked'; ?>>Nam
                            <input type="radio" name="gender" value="Nữ" <?php if($this_user->getGender() == 'Nữ') echo 'checked'; ?>>Nữ
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
                </table>
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
</script>

</html>