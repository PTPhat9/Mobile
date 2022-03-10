<?php foreach (array_slice($suggestItems, 0, 5) as $suggestItem): ?>
<div class="box-suggest-item">
    <a href="index.php?c=product&a=show&id=<?=$suggestItem->getId()?>" class="suggest-item">
        <img src="public/images/product/<?=$suggestItem->getFeaturedImage() ?>" alt="">
        <div class="suggest-item-info">
            <h3 class="suggest-item-name"><?=$suggestItem->getName() ?></h3>
            <span class="suggest-item-price"><?=number_format($suggestItem->getPrice()) ?></span>
        </div>
    </a>
</div>
<?php endforeach ?>