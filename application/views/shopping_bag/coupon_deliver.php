<div class="coupon-deliver">
    <form class="coupon-deliver-form">
        <div class="discount">
            <input type="hidden" id="total-before-discount" value="<?php echo $this->cart->total();?>"/>
            <div class="section-header">คูปองส่วนลด</div>
            <div class="coupon">
                    <label>
                        <input name="selected_coupon" type="radio" value="-1" amountremain="<?php echo $this->cart->total(); ?>"/>
                        <div class="coupon-icon-container ui-corner-all"><?php
                            echo img(array(
                                'src' => base_url() . 'images/discount_icons/0.png',
                                'title' => 'ไม่ใช้คูปอง'
                            ));
                            ?></div>
                        <div class="coupon-detail">
                            ไม่ใช้คูปอง<br/>
                            ส่วนลด 0.00 บาท
                            คงเหลือ <?php echo number_format($this->cart->total(),2); ?> บาท<br/>
                        </div>
                    </label>
                </div>
            <?php if (!$is_logged_in): ?>
                <span class="register-btn button ui-corner-all">สมัครสมาชิกหรือลงชื้อเข้าใช้ตอนนี้ เพื่อรับส่วนลดสำหรับใช้ในการซื้อสินค้า</span>
                <input style="display:none;" name="selected_coupon" type="radio" value="-1" amountremain="<?php echo $this->cart->total(); ?>"/>
            <?php else: ?>



                <?php foreach ($coupons as $d): ?>
                    <div class="coupon">
                        <label>
                            <input name="selected_coupon" type="radio" value="<?php echo $d['customer_coupon_id']; ?>"  amountremain="<?php echo $d['amount_remain']; ?>"/>
                            <div class="coupon-icon-container ui-corner-all"><?php echo img(array('src' => $d['icon'])); ?></div>
                            <div class="coupon-detail">
                                <?php echo $d['name']; ?>( เหลือ <?php echo $d['remain']; ?> ใบ 
                                หมดอายุ <?php echo $d['expired_date']; ?>)<br/>
                                <?php echo $d['desc']; ?><br/>
                                ส่วนลด <?php echo number_format($d['discount'],2); ?> บาท
                                คงเหลือ <?php echo number_format($d['amount_remain'],2); ?> บาท<br/>
                            </div>
                        </label>
                    </div>
                <?php endforeach; ?>

            <?php endif; ?>
        </div>
        <div class="delivering">
            <div class="section-header">วิธีการจัดส่งสินค้า</div>
            <?php foreach ($delivering as $d): ?>
            <div class="delivery-type">
                <label><input name="deliver_type" type="radio" cost="<?php echo $d['cost']; ?>" value="<?php echo $d['delivery_type_id'];?>"><?php echo $d['name']; ?> ค่าจัดส่งทั้งหมด <?php echo sprintf("%.2f", $d['cost']); ?> บาท (ค่าจัดส่งชิ้นละ <?php echo number_format($d['unit_cost'],2); ?> บาท 
                    <?php
                    if ($d['free_threshold'] < 100 || $d['free_threshold'] > 1)
                    {
                        echo 'สั่งซื้อสินค้า ' . $d['free_threshold'] . ' ชิ้นขึ้นไปส่งฟรี!';
                    }
                    ?>)
                </label>
            </div>
            <?php endforeach; ?>
        </div>
    </form>
    <div class="section-header">จำนวนเงินทั้งสิ้น <span id="net-total"></span> บาท</div>
</div>

<script type="text/javascript">
    $(function(){
    if($('.order-review .coupon-deliver input[name="deliver_type"]:checked').length == 0)
    {
        $('.order-review .coupon-deliver input[name="deliver_type"]:first').prop("checked", true);
    }
    if($('.order-review .coupon-deliver input[name="selected_coupon"]:checked').length == 0)
    {
        $('.order-review .coupon-deliver input[name="selected_coupon"]:first').prop("checked", true);
    }
    var reload_coupon_deliver_tab = function() {
        $('.order-review').waiting();
        $('.order-review .coupon-deliver').parent().
                load(base_url + 'index.php/shopping_bag/coupon_deliver/ajax',
                function(){
                    $('.order-review').waiting('done');
                }
    );
    };
    $('.user-tab').unbind('onlogin', reload_coupon_deliver_tab);
    $('.user-tab').unbind('onlogout', reload_coupon_deliver_tab);
    $('.user-tab').bind('onlogin', reload_coupon_deliver_tab);
    $('.user-tab').bind('onlogout', reload_coupon_deliver_tab);
        
    $('.order-review .coupon-deliver .register-btn').click(function() {
        
        if (!$('.opening-tab').is('.user-tab'))
        {
            closeTab($('.opening-tab'));
            openTab($('.user-tab'));
        }
    });
    function calNetTotal()
    {
        var remain = parseFloat($('.order-review .coupon-deliver input[name="selected_coupon"]:checked').attr('amountremain'));
        var deliverCost = parseFloat($('.order-review .coupon-deliver input[name="deliver_type"]:checked').attr('cost'));
        $('.order-review .coupon-deliver #net-total').html(number_format(remain+deliverCost, 2));
    }
    calNetTotal();
    $('.order-review .coupon-deliver input[name="selected_coupon"]').click(function(){
        calNetTotal();
    });
    $('.order-review .coupon-deliver input[name="deliver_type"]').click(function(){
        calNetTotal();
    });
    themeButton('.coupon-deliver');
    });
</script>