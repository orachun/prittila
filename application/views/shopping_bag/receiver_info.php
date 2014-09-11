<!-- unused

<style>
    .order-review .receiver-info .form-item
    {
        margin: 10px 0px;
    }
	.order-review .receiver-info input
	{
		width: 300px;
		height: 30px;
	}
    .order-review .receiver-info textarea[name="receiver-addr"]
    {
        width: 300px;
        height: 100px;
    }
    .order-review .validation-err-msg{display:inline; margin-left: 10px}
</style>

<div class="receiver-info">
    <form class="receiver-info-form">
        <div class="section-header">รายละเอียดผู้รับสินค้า</div>
        <div class="form-item form-item-receiver-name">
            <label class="label">ชื้อผู้รับ</label> 
            <input name="receiver-name" type="text" value="<?php echo $receiver_info['name']; ?>" required/>
        </div>
        <div class="form-item form-item-receiver-addr">
            <label class="label">ที่อยู่ รหัสไปรษณีย์ ผู้รับ</label> 
            <textarea name="receiver-addr" required><?php echo $receiver_info['addr']; ?></textarea>
        </div>
        <div class="form-item form-item-receiver-email">
            <label class="label">อีเมล์</label>
            <?php if ($is_logged_in === FALSE): ?>
                <input name="receiver-email" type="email" value="<?php echo $receiver_info['email']; ?>" required/>
            <?php else: ?>
                <input name="receiver-email" type="hidden"  value="<?php echo $receiver_info['email']; ?>"/>
                <input type="text" disabled="disabled"  value="<?php echo $receiver_info['email']; ?>"/>
            <?php endif; ?>
        </div>
        <div class="form-item form-item-receiver-tel">
            <label class="label">โทร.</label>
            <?php if ($is_logged_in === FALSE): ?>
                <input name="receiver-tel" type="tel"  value="<?php echo $receiver_info['tel']; ?>" required/>
            <?php else: ?>
                <input name="receiver-tel" type="hidden" value="<?php echo $receiver_info['tel']; ?>"/>
                <input type="text" disabled="disabled"  value="<?php echo $receiver_info['tel']; ?>"/>
            <?php endif; ?>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(function(){
        var reload_receiver_info_tab = function() {
            $('.order-review').waiting();
            $('.order-review .receiver-info').parent().
                    load(base_url + 'index.php/shopping_bag/receiver_info/ajax',
            function(){
                $('.order-review').waiting('done');
            }
        );
        };
        $('.user-tab').unbind('onlogin', reload_receiver_info_tab);
        $('.user-tab').unbind('onlogout', reload_receiver_info_tab);
        $('.user-tab').bind('onlogin', reload_receiver_info_tab);
        $('.user-tab').bind('onlogout', reload_receiver_info_tab);
    themeButton('.receiver-info');
    });
</script>