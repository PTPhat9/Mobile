<?php foreach ($items as $id => $item): 
    $productColorRepository = new ProductColorRepository();
    $color = $productColorRepository->find($item["color"]);
    
    ?>
        <div class="col-md-12">
            <div class="row">

            
       
            <div class="id" type="hidden" value="<?=$item["product_code"]?>"></div>
            <div class="col-md-1 item_product">
                <img src="<?=$item["img"]?>" alt="">
            </div>
            <div class="col-md-3 item_product">
                <div class="item">
                    <?=$item["name"]?>
                </div>
            </div>
            <div class="col-md-2 item_product header">
                <div class="item">
                    <?=$color->getColor()?>
                </div>
            </div>
            <div class=" col-md-2 item_product header">
                <div class="item">
                    <?=$item["qty"]?>
                </div>
            </div>
            <div class="col-md-2 item_product header">
                <div class="item">
                    <?=number_format($item["unit_price"])?>
                </div>
            </div>
            
            <div class="col-md-2 item_product header">
                <div class="item">
                    <?=number_format($item["total_price"])?> đ
                </div>
            </div>
            <div class="col-md-1 item_product ">
                <a class="btn btn-sm btn-dark delete" onclick="deleteProductInCart(<?=$item['product_code']?>)">Hủy</a>
            </div>
        
        </div>
        </div>
        <?php endforeach ?>
        <div class="cart-footer container-fluid">
            <div class="row">
                <div class="col-md-12">
                <p>
                    <span>Tổng tiền</span>
                    <span class="price-total"><?=number_format($cart->getTotalPrice())?> đ</span>
                </p>
                <input type="button" name="checkout" class="btn btn-primary" value="Đặt hàng" >

                </div>
            </div>
        </div>