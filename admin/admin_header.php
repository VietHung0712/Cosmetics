<div class="top-menu">
    <h1>Danh mục quản lí</h1>
    <a href="./admin.php">Trang chủ</a>
    <a href="./admin_product.php">Sản phẩm</a>
    <a href="./admin_brand.php">Thương hiệu</a>
    <a href="./admin_user_list.php">Người dùng</a>
</div>
<style>
    .top-menu{
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 8vh;
        display: flex;
        align-items: center;
        justify-content: space-around;
        background-color: #ec6b81;
        
        & h1{
            font-weight: bold;
            color: wheat;
        }

        & a{
            display: block;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
    }
</style>