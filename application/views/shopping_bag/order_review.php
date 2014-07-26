<style>
    
    .order-review label.label
    {
        width: 200px;
        vertical-align: top;
        display: inline-block;
    }
    .order-review .coupon-detail
    {
        display: inline-block;
    }
    .order-review .coupon .coupon-icon-container
    {
        display: inline-block;
        width: 100px;
        border: solid 1px gray;
        text-align: center;
    }
    .order-review .coupon { margin: 4px 0px;}
    .order-review .coupon *,
    .order-review .coupon * *
    {
        vertical-align: middle;
    }
    .order-review .coupon img
    {
        height: 40px;
    }
    .order-review .order-submit-form .label
    {
        display: inline-block;
        width: 100px;
        vertical-align: middle;
    }
    
    .order-review #tabs
    {
        height: 100%;
    }
    
    .order-review .section-header
    {
        font-size: 1.2em;
        font-weight: bold;
        margin: 20px 0px 10px;
		color: #ce7fa0;
    }
    
    .order-review .ui-tabs-panel
    {
        min-height: 400px;
        overflow: auto;
    }
</style>

<div class="order-review">
    <div id="tabs">
        <ul>
            <li><a href="#ordered-items-tab">สินค้าที่เลือก</a></li>
            <li><a href="#coupon-deliver-tab">ส่วนลดและการจัดส่ง</a></li>
            <li><a href="#receiver-info-tab">ผู้รับสินค้า</a></li>
            <li><a href="<?php echo base_url();?>index.php/shopping_bag/order_summary">สรุป</a></li>
        </ul>
        <div id="ordered-items-tab">
            <?php echo $ordered_item_tab;?>
        </div>
        <div id="coupon-deliver-tab">
            <?php echo $coupon_deliver_tab;?>
        </div>
        <div id="receiver-info-tab">
            <?php echo $receiver_info_tab;?>
        </div>
        <div style="text-align:center"><span class="prev-tab-btn button ui-corner-all">กลับ</span><span class="next-tab-btn button ui-corner-all">ต่อไป</span><span class="order-submit-btn button ui-corner-all">ยอมรับเงื่อนไขและยืนยันสั่งซื้อสินค้า</span></div>
    </div>
</div>

<script type="text/javascript">
   
    $('.order-review .prev-tab-btn').hide(0);
    $('.order-review .order-submit-btn').hide(0);
    function setTabButtons()
    {
        var tab = $(".order-review #tabs");
        var active = tab.tabs( "option", "active" );
        if(active > 0)
        {
            $('.order-review .prev-tab-btn').show(0);
        }
        else
        {
            $('.order-review .prev-tab-btn').hide(0);
        }
        if(active < 3)
        {
            $('.order-review .next-tab-btn').show(0);
            $('.order-review .order-submit-btn').hide(0);
        }
        else
        {
            $('.order-review .next-tab-btn').hide(0);
            $('.order-review .order-submit-btn').show(0);
        }
    }
    
    $(".order-review #tabs").tabs({
        activate: setTabButtons, 
        disabled: true,
        beforeActivate:function(){
            switch($(".order-review #tabs").tabs('option', 'active'))
            {
                case 0:
                    return true;
                    break;
                case 1:
                    return true;
                    break;
                case 2:
                    return form_valid('.order-review form.receiver-info-form:first', {
                            "receiver-name": {
                                required: true,
                            },
                            "receiver-addr": {
                                required: true,
                            },
                            "receiver-email": {
                                required: true,
                                email: true
                            },
                            "receiver-tel": {
                                required: true,
                                digits: true,
                                minlength: 9
                            }
                        });
                    
                    break;
            }
        }
    });
    setTabButtons();
    $('.order-review .next-tab-btn').click(function(){
        var tab = $(".order-review #tabs");
        var active = tab.tabs( "option", "active" );
        tab.tabs("enable");
        tab.tabs( "option", "active", active+1 );
        tab.tabs("option", "disabled", true);
        setTabButtons();
    });
    $('.order-review .prev-tab-btn').click(function(){
        var tab = $(".order-review #tabs");
        tab.tabs("enable");
        var active = tab.tabs( "option", "active" );
        tab.tabs( "option", "active", active-1 );
        tab.tabs("option", "disabled", true);
        setTabButtons();
    });
    $('.order-review .order-submit-btn').click(function(){
        $('.order-review').waiting();
        var data = $('.order-review .coupon-deliver-form').serialize()+'&'+$('.order-review .receiver-info-form').serialize();
        $.post(base_url+'index.php/shopping_bag/order_submit', data, function(data){
            $('.order-review .order-summary').load(base_url+'index.php/order/display/'+data, function(){
                
                $('.order-review .next-tab-btn').hide(0);
                $('.order-review .prev-tab-btn').hide(0);
                $('.order-review .order-submit-btn').hide(0);
                
                notify('success','ส่งคำสั่งซื้อสินค้า','บันทึกการสั่งซื้อเรียบร้อยค่ะ รายละเอียดการส่งสินค้าได้ถูกส่งไปยัง Email แล้วค่ะ');
                $('.order-review').waiting('done');
            });
            
        });
    });
    
    
    themeButton('.order-review');
</script>