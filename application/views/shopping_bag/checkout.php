<div id="checkout-form-container">
    <div class="well">
        สินค้าทั้งหมด <?php echo $item_count;?> ชิ้น ราคา <?php echo number_format($subtotal);?> บาท<br/>
        ค่าจัดส่งสินค้า <?php echo number_format($delivering_cost);?> บาท<br/>
        (<?php echo $deliver_name;?>) <br/>
        <strong>รวมทั้งสิ้น <?php echo number_format($total);?> บาท</strong>
    </div>
    
    <form id="checkout-form" class="form-horizontal" role="form">
        <input type="hidden" name="deliver-type" value="<?php echo $deliver_id;?>"/>
        <div class="form-group">
            <label for="input-receiver-name" class="col-sm-3 control-label">ชื่อผู้รับ</label>
            <div class="col-sm-9">
                <input name="receiver-name" type="text" class="form-control" 
                       id="input-receiver-name" placeholder="ชื่อ-นามสกุล"
                       value="<?php echo $receiver_info['name'];?>">
            </div>
        </div>
        <div class="form-group">
            <label for="input-receiver-addr" class="col-sm-3 control-label">ที่อยู่ในการจัดส่งสินค้า</label>
            <div class="col-sm-9">
                <textarea name="receiver-addr" type="text" class="form-control" 
                          id="input-receiver-addr" placeholder="ที่อยู่ในการจัดส่งสินค้า"><?php echo $receiver_info['addr'];?></textarea>
            </div>
        </div>
        
        <?php if(!$member): ?>
        <div class="form-group">
            <label for="input-receiver-tel" class="col-sm-3 control-label">โทรศัพท์</label>
            <div class="col-sm-9">
                    <input name="receiver-tel" type="tel" class="form-control" 
                           id="input-receiver-tel" placeholder="โทรศัพท์">
            </div>
        </div>
        <div class="form-group">
            <label for="input-receiver-email" class="col-sm-3 control-label">อีเมล์</label>
            <div class="col-sm-9">
                <input name="receiver-email" type="email" class="form-control" 
                       id="input-receiver-email" placeholder="อีเมล์"
                       value="<?php echo $receiver_info['email'];?>">
            </div>
        </div>
        <?php endif;?>
        
        <div class="form-group">
            <label for="input-promocode" class="col-sm-3 control-label">รหัสโปรโมชัน</label>
            <div class="col-sm-9">
                <input name="promocode" type="text" class="form-control" 
                       id="input-promocode" placeholder="รหัสโปรโมชัน">
            </div>
        </div>
        <div class="form-group">
            <label for="input-addr" class="col-sm-3 control-label">&nbsp;</label>
            <div class="col-sm-9">
                <label>
                    <input type="checkbox" name="accept_condition" class="fomrm-control" id="input-accept_condition"/>
                    ยอมรับเงื่อนไขการสั่งซื้อสินค้า
                </label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-primary checkout-btn">ส่งคำสั่งซื้อ</button>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    $('#checkout-form-container #checkout-form .checkout-btn').click(function (e){
        e.preventDefault();
        var form_data = form_data_to_JSON('#checkout-form-container #checkout-form');
        if(form_data['accept_condition'] != 'on')
        {
            notify('error', 'ส่งคำสั่งซื้อ', 'ต้องยอมรับเงื่อนไขการสั่งซื้อสินค้าด้วยจ้า');
        }
        else
        {
            $('#checkout-form-container').waiting();
            $.post(base_url+'index.php/shopping_bag/order_submit', form_data, function(response){
                $('#checkout-form-container').load(response, function(result){
                    update_order_count(function(){
                        $('#checkout-form-container').waiting('done');
                        notify('success', 'ส่งคำสั่งซื้อ', 'บันทึกคำสั่งซื้อเรียบร้อยจ้า');
                    });
                });
            });
        }
    });
</script>