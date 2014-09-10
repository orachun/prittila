<div class="product-detail product-detail-<?php echo $product_id; ?>">  
    <div class="row bottom-margin">         

        <!--product detail-->
        <div class="col-md-8 col-sm-6 product-detail-pane">
            <div class="row bottom-margin">
                <div class="col-md-12">
                    <h3><?php echo $name; ?></h3>
                    <small>
                        รหัส <span class="pcode"><?php echo $display_id; ?></span>
                        ราคา <span class="pprize"><?php echo number_format($unit_price, 2); ?> บาท</span><br/>
                        <?php like_btn(base_url() . 'index.php/product/detail/' . $product_id); ?>
                    </small>
                </div>
            </div>
            <div class="row bottom-margin">
                <div class="col-md-12">
                    <div class="desc well">
                        <?php echo nl2br($desc); ?>
                    </div>
                </div>
            </div>
            <div class="row bottom-margin">
                <div class="col-md-12">
                    <form class="buy-form">
                        <input type="hidden" name="id" value="<?php echo $product_id; ?>"/>

                        <input type="hidden" name="pid" value="<?php echo $product_id; ?>"/>
                        <input type="hidden" name="price" value="<?php echo $unit_price; ?>"/>
                        <input type="hidden" name="name" value="<?php echo $name; ?>"/>
                        <div class="row bottom-margin">
                            <div class="col-md-12">
                                <span class="label label-default buy-option-label">สี</span>
                                <div class="btn-group" data-toggle="buttons">
                                    <?php
                                    $i = 0;
                                    foreach ($avail_colors as $c => $cth)
                                    {
                                        $id = 'color-' . $c;
                                        $checked = $i == 0 ? 'checked="checked"' : '';
                                        $active = $i == 0 ? ' active' : '';
                                        echo '<label class="btn btn-primary ' . $active . '">';
                                        echo '<input type="radio" id="' . $id . '" name="color" value="' . $c . '" ' . $checked . '>' . $cth;
                                        echo '</label>';
                                        $i++;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row bottom-margin">
                            <div class="col-md-12">
                                <span class="label label-default buy-option-label">ขนาด</span>
                                <div class="btn-group" data-toggle="buttons">
                                    <?php
                                    $i = 0;
                                    foreach ($avail_sizes as $s)
                                    {
                                        $checked = $i == 0 ? 'checked="checked"' : '';
                                        $active = $i == 0 ? ' active' : '';
                                        $id = 'size-' . $s;
                                        echo '<label class="btn btn-primary ' . $active . '">';
                                        echo '<input type="radio" id="' . $id . '" name="size" value="' . $s . '" ' . $checked . '>' . $s;
                                        echo '</label>';
                                        $i++;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row bottom-margin">
                            <div class="col-md-12">
                                <span class="label label-default buy-option-label">จำนวน</span>
                                <div class="btn-group" data-toggle="buttons">
                                    <?php
                                    for ($i = 1; $i <= 4; $i++)
                                    {
                                        $checked = $i == 1 ? 'checked="checked"' : '';
                                        $active = $i == 1 ? ' active' : '';
                                        $id = 'qty-' . $i;
                                        echo '<label class="btn btn-primary ' . $active . '">';
                                        echo '<input type="radio" id="' . $id . '" name="qty" value="' . $i . '" ' . $checked . '>' . $i;
                                        echo '</label>';
                                    }
                                    ?>
                                </div>
                                ชิ้น
                            </div>
                        </div>
                        
                    </form>
                </div>

                
            </div>
            <div class="row bottom-margin">
                <div class="col-md-12">
                    <button type="button" id="buy-btn" data-loading-text="กำลังใส่ถุง" class="btn btn-success center-block btn-lg">
                        <h2><span class="glyphicon glyphicon-shopping-cart"></span> ซื้อเลย!</h2>
                    </button>
                </div>
            </div>
            <div class="row bottom-margin">
                <div class="col-md-12">
                    <?php fb_comments(base_url() . 'index.php/product/detail/' . $product_id); ?>
                    <?php if ($ajax): ?>
                        <script type="text/javascript">FB.XFBML.parse();</script>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- product slide show -->
        <div class="col-md-4 col-sm-6">
            <?php for ($i = 0; $i < count($images); $i++): ?>
                <div class="col-md-12">
                    <a class="product-img" rel="fancybox-thumb" href="<?php echo $images[$i]; ?>" title="">
                        <img class="col-xs-12" src="<?php echo $images[$i]; ?>" alt="" />
                    </a>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function() {
        $(".product-detail .product-img").fancybox({
            prevEffect: 'none',
            nextEffect: 'none',
            helpers: {
                title: {
                    type: 'outside'
                },
                thumbs: {
                    width: 50,
                    height: 50
                }
            },
        });
    });
</script>