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
                    <a href="" class="breadcrumb-item"><span>Sản phẩm</span></a>
                    <?php if(!empty($category)): ?>
                    <span>
                        <i class="fa fa-angle-right"></i>
                    </span>
                    <a href="" class="breadcrumb-item"><span><?=$category->getName()?></span></a>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <div class="box-common container-fluid">
            <div class="row">
                <h2 class="title"><?=empty($category) ? "" : $category->getName()?></h2>
                <div class="list-product">
                    <?php foreach($products_per_page as $product): ?>
                    <div class="item">
                        <?php require "views/layout/item.php" ?>                       </div>
                    <?php endforeach ?>
                </div>
                <div class="pagination container-fluid">

                    <ul class="">
                        <li class="pagination-item">
                            <a href="javascript:void(0)" onclick="goToPage(<?=$page != 1 ? $page-1 : 1?>)"><i class="fas fa-chevron-left"></i></a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="pagination-item active">
                            <a href="javascript:void(0)" class="<?=$page == $i ? "active": ""?>" onclick="goToPage(<?=$i?>)"><?=$i?></a>
                        </li>
                        <?php endfor ?>
                        <li class="pagination-item">
                            <a href="javascript:void(0)" onclick="goToPage(<?=$page != $totalPages ? $page+1 : $totalPages?>)"><i class="fas fa-chevron-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
                
        </div>


    </section>
    <?php require "views/layout/footer.php" ?>


