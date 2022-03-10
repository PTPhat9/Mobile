<?php require "views/layout/header.php" ?>
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
                    <a href="index.php?c=product" class="breadcrumb-item"><span>Sản phẩm</span></a>
                    <span>
                        <i class="fa fa-angle-right"></i>
                    </span>
                    <a href="" class="breadcrumb-item"><span><?=$product->getName()?></span></a>
                </div>
                
            </div>
        </div>
        <div class="box-detail-product container-fluid">
            <div class="row">
                <div class="box-left col-md-4">
                    <div class="row">
                        <div class="featured-img">
                            <img src="public/images/product/<?=$product->getFeaturedImage()?>" alt="">
                        </div>
                        <div class="box-thumbnail">
                            <?php foreach($product->getProductColors() as $color): ?>
                            <a href="#" class="thumbnail " >
                                <img src="public/images/product/<?=$color->getImage()?>" >
                            </a>    
                            
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="box-center col-md-5">
                    <div class="box-price">
                        <h3><?=$product->getName()?></h3>
                        <h4>Giá sản phẩm: </h4>
                        <p><?=number_format($product->getPrice(), 0, '', '.')?> đ</p>
                    </div>
                    <div class="box-capacity">
                        <?php if (!empty($product->getProductCapacities())): ?>
                            <h4>Chọn dung lượng để xem giá</h4>
                            <div class="capacity-items">
                                <ul>
                                    <?php foreach($product->getProductCapacities() as $capacity): ?>
                                        <li>
                                            <a href="" class="capacity-item" data="<?=$capacity->getPrice()?>">
                                                <strong><?=$capacity->getCapacity()?></strong>
                                                <p><?=number_format($capacity->getPrice(), 0, '', '.')?> đ</p>
                                            </a>
                                        </li>
                                    <?php endforeach ?>
                                    <?php endif ?>
                                </ul>

                            </div>
                    </div>
                    <div class="box-color">
                        <?php if (!empty($product->getProductColors())): ?>
                        <h4>Chọn màu để xem giá</h4>
                        <div class="color-items">
                            <ul>
                                <?php foreach($product->getProductColors() as $color): ?>
                                    <li>
                                        <a href="" class="color-item" data="<?=$color->getId()?>">
                                            <img src="public/images/product/<?=$color->getImage()?>" alt="">
                                            <div>
                                            <strong><?=$color->getColor()?></strong>
                                            <p><?=number_format($product->getPrice(), 0, '', '.')?> đ</p>
                                            </div>
                                        </a>

                                    </li>
                                <?php endforeach ?>

                            </ul>
                        </div>
                        <?php endif ?>
                    </div>
                    <a class="btn btn-primary buy">Thêm vào giỏ hàng</a>
                </div>
                <div class="box-right col-md-3">
                    
                    
                </div>
            </div>
                
        </div>

        <div class="box-common container-fluid">
            <div class="row">
                <h2 class="title">Sản phẩm tương tự</h2>
                <div class="list-product col-md-12">
                    <?php foreach($relatedProducts as $product): ?>
                    <div class="item">
                        <?php require "views/layout/item.php" ?>                       
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        

        <div class="box-comment container-fluid">
            <div class="box-comment-wrapper row">
                <form action="" class="form-comment" method="POST">
                    <input type="hidden" name="product_id" value="<?=$product_id?>">
                    <h3>Đánh giá của bạn</h3>
                    <div class="form-group">
                        <div class="star-rating-input">
                            <input type="text" class="star-rating" name="star-rating" value="">
                        </div>
                        <input type="text" name="fullname" placeholder="Tên" class="form-control">
                        <input type="text" name="email" placeholder="Email" class="form-control">
                        <textarea name="description" id="" rows="5" class="form-control" placeholder="Mời bạn để lại bình luận ..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </form>
                <div class="list-comment">
                    <?php $product = $productRepository->find($_GET["id"]); 
                    $comments = $product->getComments();
                    require "views/layout/comments.php"
                    ?>

                </div>
            </div>
        
        </div>
    
    <!-- Thông báo thêm vào giỏ hàng thành công -->
    <div class="modal fade cart-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Giỏ hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Thêm vào giỏ hàng thành công
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                
            </div>
            </div>
        </div>
    </div>

    </section>
    <?php require "views/layout/footer.php" ?>


