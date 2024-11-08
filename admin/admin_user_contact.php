<?php
require_once "../php/connect.php";
require_once "../php/class.php";
require_once "../php/function.php";

use ClassProject\User;

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $sql = "SELECT * FROM user WHERE id = " . $user_id;
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $this_user = new User($row['id'], $row['displayname'], $row['username'], $row['password'], $row['gender'], $row['address'], $row['birthday'], $row['phone'], $row['image_url']);
        }
    }

    $sql = "SELECT * FROM contact WHERE user = " . $user_id;
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $contact = [$row['id'], $row['tilte'], $row['content']];
            $contactArr[] = $contact;
        }
    }
}
mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVE - Admin</title>
</head>
<style>
    #main {
        max-width: 80%;
        margin: 0 auto;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 10vh;

        a {
            padding: 5px;
            background-color: #d8586f;
            color: white;
            text-decoration: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        caption {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #333;
            font-weight: bold;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            font-weight: bold;
            color: #333;
            background-color: #f1f1f1;
        }

        td {
            color: #555;
        }

        td img {
            width: 50px;
            height: 50px;
            border-radius: 4px;
            object-fit: cover;
        }

        td ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        td ul li {
            display: inline;
            margin-right: 10px;
        }

        td ul li a {
            padding: 5px 10px;
            background-color: #ec6b81;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        td ul li a:hover {
            background-color: #d8586f;
        }

        input[type="submit"],
        input[type="reset"] {
            padding: 10px 15px;
            background-color: #ec6b81;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #d8586f;
        }
    }
</style>

<body>
    <?php require_once "./admin_header.php"; ?>
    <div id="main">
        <a href="./admin_user_list.php">Quay lại</a>
        <table>
            <caption>Phản ánh của người dùng <?php echo $this_user->getDisplayName() ?></caption>
            <thead>
                <th>Mã phản ánh</th>
                <th>Tiêu đề</th>
                <th>Nội dung</th>
            </thead>
            <tbody>
                <?php
                if (isset($contactArr)) {
                    foreach ($contactArr as $item) {
                ?>
                        <tr>
                            <td><?php echo $item[0]; ?></td>
                            <td><?php echo $item[1]; ?></td>
                            <td><?php echo $item[2]; ?></td>
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
</body>

</html>