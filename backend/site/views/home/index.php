<?php require "views/layout/header.php"?>
<section>
    <?php require "views/layout/navbar.php"?>

    <div class="banner container-fluid">
        <div class="row">
            <div class="sidebar col-md-3">
                <h3>DANH MỤC SẢN PHẨM</h3>
                <ul class="main-menu">
                    <?php foreach ($categories as $category): ?>
                    <li class="main-menu-title">
                        <a href="index.php?c=product&category_id=<?=$category->getId()?>">
                            
                            <p><?=$category->getName()?></p>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                    <?php endforeach?>

                </ul>
            </div>

            <div class="slideshow col-md-9">
                <div class="banner-img">
                    <img  src="public/images/slideshow/image1.jpg" alt="" />
                </div>
                <div class="img-hot-sale">
                    <img src="public/images/slideshow/image2.jpg" alt="" />
                    <img src="public/images/slideshow/image3.jpg" alt="" />
                </div>
            </div>
        </div>
    </div>

    <div class="box-common container-fluid">
        <div class="row">
            <h2 class="title">Sản phẩm nổi bật</h2>
            <div class="list-product">
                <?php foreach ($featuredProducts as $product): ?>
                <div class="item">
                    <?php require "views/layout/item.php"?>
                </div>
                <?php endforeach?>

            </div>
        </div>
    </div>

    <?php foreach (array_slice($categoryProducts, 0, 3) as $categoryName => $products): ?>
    <div class="box-common container-fluid">
        <div class="row">
            <h2 class="title"><?=$categoryName?></h2>
            <div class="list-product">
                <?php foreach ($products as $product): 
                    
                    ?>
                <div class="item">
                    <?php require "views/layout/item.php"?>                       </div>
                <?php endforeach?>
            </div>
        </div>
    </div>
    <?php endforeach?>
</section>

<?php require "views/layout/footer.php"?>

