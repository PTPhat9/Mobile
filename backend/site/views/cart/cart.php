<?php require "views/layout/header.php"?>
<section>
    <?php 
        require "views/layout/navbar.php";
    ?>
    <div class="breadcrumb-wrapper">
        <div class="breadcrumb container-fluid">
            <div class="row">
                <a href="index.php" class="breadcrumb-item"><span>Trang chủ</span></a>
                <span>
                    <i class="fa fa-angle-right"></i>
                </span>
                <a href="" class="breadcrumb-item"><span>Giỏ hàng</span></a>
            </div>
        </div>
    </div>
    <div class="cart-header container-fluid">
        <h3 class="title ">Giỏ hàng</h3>
    </div>
    <div class="cart-body container-fluid">
        <div class="row cart-body-title">
            <div class="col-md-1">
            </div>
            <div class="col-md-3">
                <div class="">
                    Sản phẩm
                </div>
            </div>
            <div class="col-md-2 header">
                <div class="">
                    Màu sắc
                </div>
            </div>
            <div class=" col-md-2 header">
                <div class="">
                    Số lượng
                </div>
            </div>
            <div class="col-md-2 header">
                <div class="">
                    Đơn giá
                </div>
            </div>
            <div class="col-md-2 header">
                <div class="">
                    Thành tiền
                </div>
            </div>
            <div class="col-md-1 ">
            </div>
        </div>
        <div class="row cart-body-product">
        <?php require "views/cart/cartItems.php" ?>
        </div>
    </div>
    

</section>

<?php require "views/layout/footer.php"?>

