<style>
    .customer-orders .order-detail
    {
        display: inline-block;
        margin-right: 5px;
    }
    .customer-orders .order
    {
        margin-bottom: 10px;
        padding-bottom: 10px;
        border-bottom: dashed 1px lightgray;
    }
</style>
<div class="customer-orders">
    <?php foreach ($orders as $o): ?>
            <div class="order">
                <div class="order-detail">
                    <a href="<?php echo base_url() . 'index.php/order/display/' . $o['order_id']; ?>" target="_blank">
                        <?php echo $o['display_id']; ?>
                    </a> 
                </div>
                <div class="order-detail">
                    (<?php echo order_status($o['status']); ?>)
                </div>
                <br/>
                <div class="order-detail">
                    สั่งเมื่อ <?php echo thai_datetime($o['ordered_datetime'], ' '); ?>
                </div>
                <div class="order-detail">
                    ราคารวม <?php echo number_format($o['net_total'], 0); ?>฿
                </div>
                <br/>
                <?php if (!empty($o['paid_date'])): ?>
                <div class="order-detail">
                        วันที่แจ้งชำระเงิน <?php echo thai_datetime($o['paid_date'], ' '); ?>
                </div>
                <?php endif; ?>
                <?php if (!empty($o['delivered_date'])): ?>
                <div class="order-detail">
                    วันที่ส่ง <?php echo thai_datetime($o['delivered_date'], ' '); ?>
                </div>
                <br/>
                <?php endif; ?>
                <?php if (!empty($o['tracking_no'])): ?>
                <div class="order-detail">
                        เลขพัสดุ <?php echo $o['tracking_no']; ?>
                </div>
                <br/>
                <?php endif; ?>
                <?php if($o['status'] == 'W' || $o['status'] == 'P'):?>
                <button class="btn btn-xs btn-primary payment-inform-btn" orderid="<?php echo $o['display_id'];?>">
                    แจ้งชำระเงิน
                </button>
                <?php endif;?>
            </div>
    <?php endforeach; ?>
</div>

<script type="text/javascript">
    $(function(){
        $('.customer-orders .payment-inform-btn').click(function(){
            $('#account-modal').modal('hide');
            $('#payment-inform-modal').modal('show');
            $('#payment-inform-modal input#order-id').val($(this).attr("orderid"));
        });
    });
    //themeButton('.customer-orders');
</script>