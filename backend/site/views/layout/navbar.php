<div class="navbar">
    <div class="container-fluid">
        <div class="row">
            <ul class="">
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="index.php?c=product">Sản phẩm</a></li>
                <li><a href="index.php?c=policy&a=returnPolicy">Chính sách đổi trả</a></li>
                <li><a href="index.php?c=policy&a=paymentPolicy">Chính sách thanh toán</a></li>
                <li><a href="index.php?c=policy&a=deliveryPolicy">Chính sách giao hàng</a></li>
                <li><a href="index.php?c=contact">Liên hệ</a></li>
            </ul>
        </div>
    </div>
</div>
<?php 
    $message = "";
    if(!empty($_SESSION["success"])) {
        $message = $_SESSION["success"];
        $messageClass = "alert-success";
        unset($_SESSION["success"]);
    } else if (!empty($_SESSION["error"])){
        $message = $_SESSION["error"];
        $messageClass = "alert-danger";
        unset($_SESSION["error"]);
    }
?>
<?php if ($message): ?>
    <div class="alert <?=$messageClass?> container-fluid">
        <?=$message?>
    </div>
<?php endif ?>
