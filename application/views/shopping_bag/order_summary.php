<div class="order-summary">
    <div class="ordered-item-section"></div>
    <div class="selected-coupon-section">
        <div class="section-header">คูปองส่วนลด</div>
    </div>
    <div class="selected-deliver-section">
        <div class="section-header">วิธีการจัดส่งสินค้า</div>
    </div>
    <div class="net-total-section">
        
    </div>
    <div class="receiver-info-section">
        <div class="section-header">ข้อมูลผู้รับสินค้า</div>
        <div><label class="label">ชื้อผู้รับ</label><span class="receiver-name"></span></div>
        <div><label class="label">ที่อยู่ผู้รับ</label><span class="receiver-addr"></span></div>
        <div><label class="label">โทร.</label><span class="receiver-tel"></span></div>
        <div><label class="label">อีเมล์</label><span class="receiver-email"></span></div>
    </div>
</div>
<script type="text/javascript">
    $('.order-review .order-summary .ordered-item-section').load(base_url+'index.php/shopping_bag/ordered_items/false', function(){
        $('.order-review .coupon-deliver input[name="selected_coupon"]:checked').parents(".coupon:first").clone()
                .appendTo('.order-review .order-summary .selected-coupon-section');
        $('.order-review .coupon-deliver input[name="deliver_type"]:checked').parents(".delivery-type:first").clone()
                .appendTo('.order-review .order-summary .selected-deliver-section');
        $('.order-review .coupon-deliver #net-total').parents('.section-header').clone()
                .appendTo('.order-review .order-summary .net-total-section');
        $('.order-review .order-summary input[type="radio"]').remove();
        $('.order-review .order-summary .receiver-name').html($('.order-review .receiver-info input[name="receiver-name"]').val());
        $('.order-review .order-summary .receiver-addr').html($('.order-review .receiver-info textarea[name="receiver-addr"]').val());
        $('.order-review .order-summary .receiver-tel').html($('.order-review .receiver-info input[name="receiver-tel"]').val());
        $('.order-review .order-summary .receiver-email').html($('.order-review .receiver-info input[name="receiver-email"]').val());
    });
    
    notify('into', 'สรุปรายการสั่งสินค้า', 'กรุณาตรวจสอบรายละเอียดการสั่งสินค้าก่อนกดปุ่มยืนยัน หลังจากยืนยันแล้วจะไม่สามารถแก้ไขรายการได้ค่ะ');
    themeButton('.order-summary');
</script>