<?php 
    $totalStar = 0;
    foreach ($product->getComments() as $comment) {
        $totalStar += $comment->getStar();
    }
    $totalComment = count($product->getComments()) != "0" ? count($product->getComments()) : 1;
    $star = $totalStar/$totalComment; 
?>
<div class="item-box">
    <a class="img-hot" href="index.php?c=product&a=show&id=<?=$product->getId()?>">
        <div class="item-img">
            <img src="public/images/product/<?=$product->getFeaturedImage()?>" alt="" />
        </div>
        <h3><?=$product->getName()?></h3>
        <div class="item-price">
            <p class="price"><?=number_format($product->getPrice())?> ₫</p>
            <p class="old-price"><?=number_format($product->getOldPrice())?> ₫</p>
        </div>
        <div class="item-rating">
            <div class="">
                <!-- <i class="fas fa-star checked"></i> -->
                <input type="text" class="star-rating" name="rating" value="<?=$star?>">
            </div>
            <div class="total-rating">
                <p><?=count($product->getComments())?> đánh giá</p>
            </div>
        </div>
    </a>
</div>
