<style>
    .customer-coupons .coupon-container
    {
        margin: 5px 0px;
    }
    .customer-coupons .coupon-icon
    {
        display: inline-block;
        height: 70px;
        width: 150px;
        text-align: center;
        border: solid 1px lightgray;
        vertical-align: middle;
    }
    .customer-coupons .coupon-icon img
    {
        height: 70px;
    }
    .customer-coupons .coupon-detail-container
    {
        display: inline-block;
        vertical-align: middle;
    }
</style>

<div class="customer-coupons">
    <?php if(count($coupons) == 0):?>
    ไม่มีคูปอง
    <?php else:
        foreach($coupons as $c):?>
        <div class="coupon-container">
            <div class="coupon-icon ui-corner-all"><img src="<?php echo $c['icon'];?>"/></div>
            <div class="coupon-detail-container">
                <?php echo $c['name'];?> (เหลือ <?php echo $c['remain']?> ใบ): 
                <?php echo $c['desc'];?><br/>
                วันที่ได้รับ: <?php echo thai_date($c['received_date']);?> (<?php echo $c['received']?> ใบ) <br/>
                วันหมดอายุ: <?php echo is_expired($c['expired_date'])?'<strong>หมดอายุแล้ว</strong>':thai_date($c['expired_date']);?><br/>
                คำสั่งซื้อที่ใช้คูปองนี้:<br/>
                <?php foreach($c['usage'] as $u):?>
                <a href="<?php echo base_url().'index.php/order/display/'.$u['order_id'];?>" target="_blank"><?php echo $u['display_id'];?> เมื่อวันที่ <?php echo thai_datetime($u['ordered_datetime']);?></a><br/>
                <?php endforeach;?>
            </div>
        </div>
        <?php endforeach;?>
    <?php endif;?>
</div>