<div class="coupon-list">
	<table class="admin-table">
		<thead>
			<th>Name</th>
			<th>Desc</th>
			<th>Discount<br/>Type</th>
			<th>Amount<br/>(Baht/%)</th>
			<th>Amount<br/>Threshold<br/>(Baht)</th>
			<th>Valid<br/>Days</th>
			<th>Activate</th>
			<th>Give to<br/>Customer</th>
		</thead>
	
	
	<?php foreach($coupons as $i=>$c):?>
		<tr class="<?php echo $i%2==0?'odd':'even';?> <?php echo $c['status'] == 'I'?'disabled':'';?>" cid="<?php echo $c['coupon_id'];?>">
			<td><?php echo $c['name'];?> (<?php echo $c['status'];?>)</td>
			<td><?php echo $c['desc'];?></td>
			<td><?php echo $c['discount_type'];?></td>
			<td><?php echo $c['amount'];?></td>
			<td><?php echo $c['amount_threshold'];?></td>
			<td><?php echo $c['valid_day'];?></td>
			<?php if($c['status'] == 'A'):?>
				
				<td><button class="set-status-btn" status="I">Deactivate</button></td>
				<td><form class="give-coupon-form">
					<input type="hidden" name="coupon_id" value="<?php echo $c['coupon_id'];?>"/><input type="text" name="customer_id" placeholder="customer ID" size="11"/><input type="text" name="amount" placeholder="Number of coupons" /><input type="submit"/>
				</form></td>
			<?php else:?>
				<td><button class="set-status-btn" status="A">Activate</button></td>
				<td>&nbsp;</td>
			<?php endif;?>	
		</tr>
	<?php endforeach;?>
	</table>
	
	<form class="add-coupon-form item-container">
		<div>Name: <input type="text" name="name"/></div>
		<div>Desc: <br/><textarea name="desc" style="width: 50%; height: 100px;"></textarea></div>
		<div>Discount type: 
			<select name="discount_type">
				<option value="P">Percentage</option>
				<option value="F">Fixed amount</option>
			</select>
			Amount (Baht): <input type="text" name="amount"/>
			Amount threshold (Baht): <input type="text" name="amount_threshold"/>
		<div>Valid days: <input type="text" name="valid_day"/></div>
		</div>
		<input type="submit"/>
	</form>
</div>

<script type="text/javascript">
	var reload = function()
	{
		$('.coupon-list').parent().load(base_url+'index.php/admin/coupon_list');
	};
	$(function(){

		$('.coupon-list .add-coupon-form').submit(function(){
			$('.coupon-list').waiting();
			$.post(base_url+'index.php/admin/add_coupon', $(this).serialize(), reload);
			return false;
		});
		
		$('.coupon-list .give-coupon-form').submit(function(){
			$('.coupon-list').waiting();
			$.post(base_url+'index.php/admin/give_coupon', $(this).serialize(), reload);
			return false;
		});

		$('.coupon-list .set-status-btn').click(function(){
			var statusText = $(this).html();
			if(confirm(statusText + " the coupon?"))
			{
				var id = $(this).parents('tr').attr('cid');
				var status = $(this).attr('status');
				$('.coupon-list').waiting();
				$.post(base_url+'index.php/admin/set_coupon_status', 
					{'coupon_id':id, 'status':status}, 
					reload);
			}
		});
	});
</script>