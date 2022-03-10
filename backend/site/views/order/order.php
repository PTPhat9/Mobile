<?php require "views/layout/header.php" ?>
<section id="maincontent" class="page-main">
<?php require "views/layout/navbar.php" ?>
    <div class="breadcrumb-wrapper">
        <div class="breadcrumb container-fluid">
            <div class="row">
                <a href="index.php" class="breadcrumb-item"><span>Trang chủ</span></a>
                <span>
                    <i class="fa fa-angle-right"></i>
                </span>
                <a href="" class="breadcrumb-item"><span>Tài khoản</span></a>
            </div>
        </div>
    </div>

    <div class="container-fluid my-order">
        <div class="row">
            <div class="clearfix"></div>
            <aside class="col-md-3">
                <div class="inner-aside">
                    <div class="category">
                        <ul>
                            <li class="" >
                                <a href="index.php?c=customer&a=info" title="Thông tin tài khoản" target="_self">Thông tin tài khoản
                                </a>
                            </li>
                            <li class="active" style="font-weight: 700;">
                                <a href="index.php?c=order&a=index" target="_self">Đơn hàng của tôi
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
            <div class="col-md-9 order">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="home-title">Đơn hàng của tôi</h4>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <!-- Mỗi đơn hàng -->
                        <?php foreach ($orders as $order): ?>
                        <div class="row order-item">
                            <div class="col-md-12">
                                <h5>Đơn hàng <a href="chi-tiet-don-hang.html">#<?=$order->getId()?></a></h5>
                                <span class="date">
                                Đặt hàng ngày  <?=$order->getCreatedDate()?></span>
                                <hr>
                                <?php foreach($order->getOrderItems() as $orderItem):
                                $colors = new ProductColorRepository();
                                $color = $colors->find($orderItem->getColor());
                                $product = $orderItem->getProduct();
                                ?>
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="public/images/product/<?=$color->getImage()?>" alt="" class="img-responsive">
                                    </div>
                                    <div class="col-md-3">
                                        <a class="product-name" href="chi-tiet-san-pham.html"><?=$product->getName()?></a>
                                    </div>
                                    <div class="col-md-2">
                                        Số lượng: <?=$orderItem->getQty()?>                                    
                                    </div>
                                    <div class="col-md-2">
                                        Chờ giao hàng                                    
                                    </div>
                                    <div class="col-md-3">
                                        Giao hàng ngày <?=$order->getDeliveredDate()?>                                                                  
                                    </div>
                                </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require "views/layout/footer.php" ?>