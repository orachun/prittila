<div class="product product-grid-item" data-toggle="tooltip" data-placement="bottom" title="<?php echo $name; ?>">
    <a class="anchor" pid="<?php echo $product_id; ?>"  href="<?php echo base_url('index.php/product/detail/' . $product_id); ?>" target="_blank">
        <div class="thumb">
            <img class="thumb-img img-responsive" src="<?php echo $img; ?>"/>
        </div>
        <div class="pprice ui-corner-top"><?php echo number_format($unit_price, 0); ?>฿</div>
    </a>
</div>