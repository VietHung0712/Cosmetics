<?php
require_once "../php/connect.php";
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $attributes = $_POST['attributes'];
    $quantity = (int)$_POST['quantity'];

    // $sql = "INSERT INTO user_cart VALUES ('', ?, ?, ?)";
    // $result = mysqli_prepare($connect, $sql);
    // if ($result) {
    //     $result->bind_param("iss", $user_id, $attributes, $quantity);
    //     if ($result->execute()) {
    //         header("Location: ../user_cart.php");
    //         exit();
    //     } else {
    //         echo "<script>alert('Đã có lỗi!')</script>";
    //     }
    //     $result->close();
    // } else {
    //     echo "<script>alert('Không thể chuẩn bị truy vấn!')</script>";
    // }

    $check_sql = "SELECT quantity FROM user_cart WHERE user = ? AND product_item = ?";
    $stmt_check = mysqli_prepare($connect, $check_sql);

    if ($stmt_check) {
        $stmt_check->bind_param("ii", $user_id, $attributes);
        $stmt_check->execute();
        $stmt_check->bind_result($existing_quantity);

        if ($stmt_check->fetch()) {
            $stmt_check->close();

            $new_quantity = $existing_quantity + $quantity;
            $update_sql = "UPDATE user_cart SET quantity = ? WHERE user = ? AND product_item = ?";
            $stmt_update = mysqli_prepare($connect, $update_sql);

            if ($stmt_update) {
                $stmt_update->bind_param("iii", $new_quantity, $user_id, $attributes);
                if ($stmt_update->execute()) {
                    header("Location: ../user_cart.php");
                    exit();
                } else {
                    echo "<script>alert('Đã có lỗi khi cập nhật số lượng!')</script>";
                }
                $stmt_update->close();
            }
        } else {
            $sql = "INSERT INTO user_cart VALUES ('', ?, ?, ?)";
            $result = mysqli_prepare($connect, $sql);
            if ($result) {
                $result->bind_param("iss", $user_id, $attributes, $quantity);
                if ($result->execute()) {
                    header("Location: ../user_cart.php");
                    exit();
                } else {
                    echo "<script>alert('Đã có lỗi!')</script>";
                }
                $result->close();
            } else {
                echo "<script>alert('Không thể chuẩn bị truy vấn!')</script>";
            }
        }
    } else {
        echo "<script>alert('Không thể chuẩn bị truy vấn kiểm tra!')</script>";
    }
}
mysqli_close($connect);
