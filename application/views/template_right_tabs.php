<div class="user-tab right-tab">
	<div class="handle ui-corner-left button" title="บัญชีลูกค้า">
		<img src="<?php echo base_url(); ?>images/user.png"/>
		<br/>Account
	</div>
	<div class="right-tab-content-container ui-corner-left">
		<div class="right-tab-content" url="<?php echo base_url(); ?>index.php/user/tab_content">

		</div>
	</div>
</div>
<div class="shopping-bag-summary-tab right-tab">
	<div class="handle ui-corner-left button" title="สินค้าที่เลือก">
		<img src="<?php echo base_url(); ?>images/shopping-bag.png"/>
		<br/>Order
	</div>
	<div class="right-tab-content-container ui-corner-left">
		<div class="right-tab-content" url="<?php echo base_url(); ?>index.php/shopping_bag/tab_content">

		</div>
	</div>
</div>
<div class="buy-info-tab right-tab">
	<div class="handle ui-corner-left button" title="วิธีการสั่งซื้อและชำระเงิน">
		<img src="<?php echo base_url(); ?>images/info.png"/>
		<br/>Buy Info
	</div>
	<div class="right-tab-content-container ui-corner-left">
		<div class="right-tab-content">
			<h1>วิธีการสั่งซื้อและชำระเงิน</h1>
			<a href="<?php echo base_url() ?>index.php/page/content/conditions" target="_blank"><span class="button ui-corner-all">ข้อตกลงและเงื่อนไขการซื้อสินค้า</span></a>
			<a href="<?php echo base_url() ?>index.php/page/content/order_info" target="_blank"><span class="button ui-corner-all">วิธีการสั่งซื้อและชำระเงิน</span></a>
			<a href="<?php echo base_url() ?>index.php/page/content/payment_info" target="_blank"><span class="button ui-corner-all">รายละเอียดการชำระเงิน</span></a>
		</div>
	</div>
</div>
<div class="payment-transfer-tab right-tab">
	<div class="handle ui-corner-left button" title="แจ้งชำระเงิน">
		<img src="<?php echo base_url(); ?>images/cash.png"/>
		<br/>Payment
	</div>
	<div class="right-tab-content-container ui-corner-left">
		<div class="right-tab-content">
			<h1>แจ้งชำระเงิน</h1>
			<form class="payment-inform-form">
				<div><label class="label">เลขที่ใบสั่งซื้อ</label><input name="order-id" type="text"/></div>
				<div><label class="label">วันที่ชำระ</label>
					<select name="paid_day">
						<?php for ($i = 1; $i <= 31; $i++)
							echo '<option vlaue="' . $i . '">' . $i . '</option>';
						?>
					</select>/
					<select name="paid_month">
						<?php for ($i = 1; $i <= 12; $i++)
							echo '<option vlaue="' . $i . '">' . $i . '</option>';
						?>
					</select>/
					<select name="paid_year">
<?php for ($i = date('Y') + 542; $i <= date('Y') + 543; $i++)
	echo '<option vlaue="' . $i . '">' . $i . '</option>';
?>
					</select>
				</div>
				<div>
					<label class="label">เวลาที่ชำระ</label>
					<select name="paid_hr">
						<?php for ($i = 0; $i <= 23; $i++)
							echo '<option vlaue="' . $i . '">' . $i . '</option>';
						?>
					</select>:
					<select name="paid_min">
<?php for ($i = 0; $i <= 59; $i++)
	echo '<option vlaue="' . $i . '">' . $i . '</option>';
?>
					</select> น.
				</div>
				<div>
					<label class="label">จำนวนเงิน</label>
					<input name="paid_amount" type="text"/>
				</div>
				<input type="hidden" name="name" value=""/>
				<div class="uploader"></div>
				<input class="button ui-corner-all payment-inform-btn" type="submit" value="แจ้งชำระเงิน"/>
			</form>
			
		</div>
	</div>
</div>
<div class="contact-us-tab right-tab">
	<div class="handle ui-corner-left button" title="ติดต่อเรา">
		<img src="<?php echo base_url(); ?>images/contact-us.png"/>
		<br/>Contact
	</div>
	<div class="right-tab-content-container ui-corner-left">
		<div class="right-tab-content" url="<?php echo base_url(); ?>index.php/others/contact_us_form">

		</div>
	</div>
</div>

<script>
	
	var reset_payment_inform_form = function()
	{
		$('.payment-transfer-tab .payment-inform-form')[0].reset();	
		$('.payment-transfer-tab .payment-inform-form select[name="paid_day"]')
				.val(<?php echo date('d'); ?>);
		$('.payment-transfer-tab .payment-inform-form select[name="paid_month"]')
				.val(<?php echo date('m'); ?>);
		$('.payment-transfer-tab .payment-inform-form select[name="paid_year"]')
				.val(<?php echo date('Y') + 543; ?>);
		$('.payment-transfer-tab .payment-inform-form select[name="paid_hr"]')
				.val(<?php echo date('H'); ?>);
		$('.payment-transfer-tab .payment-inform-form select[name="paid_min"]')
				.val(<?php echo date('i'); ?>);
	}
	
$(function(){
	
	reset_payment_inform_form();	
	ajax_upload_form('.payment-transfer-tab .payment-inform-form .uploader', '.payment-transfer-tab .payment-inform-form input[name="name"]', 'เลือกไฟล์สลิปโอนเงิน');

	$('.payment-transfer-tab .payment-inform-form').submit(function() {
		$(this).waiting();
		$.post(base_url + 'index.php/order/payment_inform', $(this).serialize(), function(data) {
			if (data == 'ok')
			{
				notify('success', 'แจ้งชำระเงิน', 'แจ้งชำระเงินเรียบร้อยค่ะ');
				reset_payment_inform_form();
			}
			else
			{
				notify('error', 'ไม่สามารถแจ้งชำระเงินได้', data);
			}
			$('.payment-transfer-tab .payment-inform-form').waiting('done');
		});
		return false;
	});
});
</script>