<div class="product-detail product-detail-<?php echo $product_id; ?>">  
    <div class="row bottom-margin">         
        <!-- product slide show -->
        <div class="col-md-4 col-sm-6">
            <div id="product-detail-slideshow" class="carousel slide" data-ride="carousel" data-interval="false">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php for ($i = 0; $i < count($images); $i++): ?>
                        <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i;?>" class="<?php if ($i == 0) echo 'active'; ?>"></li>
                    <?php endfor; ?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php for ($i = 0; $i < count($images); $i++): ?>
                        <div class="item<?php if ($i == 0) echo ' active'; ?>">
                            <img src="<?php echo $images[$i]; ?>" />
                        </div>
                    <?php endfor; ?>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#product-detail-slideshow" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#product-detail-slideshow" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>

        </div>

        <!--product detail-->
        <div class="col-md-8 col-sm-6 product-detail-pane">
            <div class="row bottom-margin">
                <div class="col-md-12">
                    <strong><?php echo $name; ?></strong>
                    <small>
                        รหัส <span class="pcode"><?php echo $display_id; ?></span>
                        ราคา <span class="pprize"><?php echo number_format($unit_price, 2); ?> บาท</span>
                    </small>
                </div>
            </div>
            <form class="buy-form">
                <input type="hidden" name="id" value="<?php echo $product_id;?>"/>
                
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
                <div class="row bottom-margin"><div class="col-md-12">
                        <button type="button" id="buy-btn" data-loading-text="กำลังใส่ถุง" class="btn btn-success center-block btn-lg">
                            <h2><span class="glyphicon glyphicon-shopping-cart"></span> ซื้อเลย!</h2>
                        </button>
                    </div>
                </div>
            </form>
            <div class="row bottom-margin">
                <div class="col-md-12">
                    <div class="desc">
                        <?php echo $desc; ?>
                    </div>
                    <?php like_btn(base_url() . 'index.php/product/detail/' . $product_id); ?>

                    <?php fb_comments(base_url() . 'index.php/product/detail/' . $product_id); ?>
                    <?php if ($ajax): ?>
                        <script type="text/javascript">FB.XFBML.parse();</script>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>