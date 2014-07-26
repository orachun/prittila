<style>
	.user-area .tabs .ui-tabs-panel
	{
		min-height: 400px;
	}
</style>

<div class="user-area">
    <div class="tabs">
        <ul>
            <li>
				<a href="<?php echo base_url(); ?>index.php/user/user_area/general_info">ข้อมูลส่วนตัว</a>
			</li>
            <li>
				<a href="<?php echo base_url(); ?>index.php/user/user_area/coupon">คูปองส่วนลด</a>
			</li>
            <li>
				<a href="<?php echo base_url(); ?>index.php/user/user_area/orders">รายการสั่งซื้อสินค้า</a>
			</li>
        </ul>
    </div>

</div>

<?php echo $random_products; ?>

<script type="text/javascript">
	$(function() {
<?php if (isset($tab)): ?>
			$('.user-area .tabs').tabs({active:<?php echo $tab; ?>});
<?php else: ?>
			$('.user-area .tabs').tabs();
<?php endif; ?>
		var logout_redirect = function() {
			window.location.href = base_url + 'index.php';
		};
		$('.user-tab').unbind('onlogout', logout_redirect);
		$('.user-tab').bind('onlogout', logout_redirect);

	});
</script>