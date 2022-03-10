<?php require "views/layout/header.php"?>

<section id="maincontent" class="page-main">
        <?php require "views/layout/navbar.php"?>
        <div class="breadcrumb-wrapper">
            <div class="breadcrumb container-fluid">
                <div class="row">
                    <a href="index.php" class="breadcrumb-item"><span>Trang chủ</span></a>
                    <span>
                        <i class="fa fa-angle-right"></i>
                    </span>
                    <a href="index.php?c=cart" class="breadcrumb-item"><span>Giỏ hàng</span></a>
                    <span>
                        <i class="fa fa-angle-right"></i>
                    </span>
                    <a href="" class="breadcrumb-item"><span>Thông tin đặt hàng</span></a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            
            <div class="row checkout-wrapper">
                <div class="col-md-6 cart-checkout">
                    <h4>Đơn hàng</h4>
                    <?php foreach ($items as $item): ?>
                    <div class="row">
                        <div class="col-md-2">
                            <img class="img-responsive" src="<?=$item["img"]?>" > 
                        </div>
                        <div class="col-md-7">
                            <a class="product-name" href=""><?=$item["name"]?></a> 
                            <br>
                            <span><?=$item["qty"]?></span> x <span><?=number_format($item["unit_price"])?>₫</span>
                        </div>
                        <div class="col-md-3 text-right">
                            <span><?=number_format($item["total_price"])?>₫</span>
                        </div>
                    </div>
                    <hr>
                    <?php endforeach ?> 
                    <div class="row">
                        <div class="col-md-6">
                            Tạm tính
                        </div>
                        <div class="col-md-6 text-right">
                            <?=number_format($cart->getTotalPrice())?>đ
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            Phí vận chuyển
                        </div>
                        <div class="col-md-6 text-right">
                            <span class="shipping-fee" data="">0₫</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            Tổng cộng
                        </div>
                        <div class="col-md-6 text-right">
                            <span class="payment-total" data="<?=$cart->getTotalPrice()?>"><?=number_format($cart->getTotalPrice())?>₫</span>
                        </div>
                    </div>
                </div>

                <div class="ship-checkout col-md-6">
                    <h4>Thông tin giao hàng</h4>
                    <?php if (empty($_SESSION["email"])): ?>
                    <div>Bạn đã có tài khoản? <a href="javascript:void(0)" class="btn-login">Đăng Nhập  </a></div>
                    <br>
                    <?php endif ?>
                    <form action="index.php?c=cart&a=order" method="POST">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <input type="text" value="" class="form-control" name="fullname" placeholder="Họ và tên" required="" >
                            </div>
                            <div class="form-group col-sm-6">
                                <input type="tel" value="" class="form-control" name="mobile" placeholder="Số điện thoại" required="" >
                            </div>
                            <div class="form-group col-sm-4">
                                <select name="province" class="form-control province" >
                                    <option value="">Tỉnh / thành phố</option>
                                    <?php foreach($provinces as $province): ?>
                                    <option value="<?=$province->getId()?>"><?=$province->getName()?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <select name="district" class="form-control district" required="" >
                                    <option value="">Quận / huyện</option>
                                    
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <select name="ward" class="form-control ward" required="" >
                                    <option value="">Phường / xã</option>
                                    
                                </select>
                            </div>
                            <div class="form-group col-sm-12">
                                <input type="text" value="" class="form-control" placeholder="Địa chỉ" name="address" required="" >
                            </div>
                        </div>
                        <h4>Phương thức thanh toán</h4>
                        <div class="form-group">
                            <label> <input type="radio" name="payment_method" checked="" value="0"> Thanh toán khi giao hàng (COD) </label>
                            <div></div>
                        </div>
                        <div class="form-group">
                            <label> <input type="radio" name="payment_method" value="1"> Chuyển khoản qua ngân hàng </label>
                            <div class="bank-info">STK: 139095731<br>Chủ TK: PHAN TAN PHAT. Ngân hàng: VP Bank <br>
                                Ghi chú chuyển khoản là tên và chụp hình gửi lại cho shop dễ kiểm tra ạ
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-sm btn-primary pull-right">Hoàn tất đơn hàng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php require "views/layout/footer.php"?>