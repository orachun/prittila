<div class="payment-checking">
	<table class="admin-table table table-striped">
		<thead>
			<th>Order ID<br/>(DB ID)</th>
			<th>Status</th>
			<th>Net Total<br/>(Baht)</th>
			<th>Paid Amount<br/>(Baht)</th>
			<th>Paid Date</th>
			<th>Payment Inform Date</th>
			<th>Delivered Date</th>
			<th>Tracking No.</th>
			<th>Action</th>
		</thead>
		<tbody>
			<?php foreach ($orders as $i=>$o):?>
			<tr>
				<td>
					<a href="<?php echo base_url().'index.php/order/display/'.$o['order_id'];?>" target="_blank">
						<?php echo $o['display_id'];?>
					</a>
					(<?php echo $o['order_id'];?>)
				</td>
				<td><?php echo $o['status'];?></td>
				<td><?php echo $o['net_total'];?></td>
				
				<?php if(isset($o['payment'])):?>
					<td><?php echo $o['payment']['amount'];?></td>
					<td>
                        <?php echo $o['payment']['inform_date'];?>
                        <?php if($o['payment']['slip'] !== FALSE)
                        {
                            echo '(<a href="'.$o['payment']['slip'].'" target="_blank">slip</a>)';
                        }
                        ?>
                    </td>
					<td><?php echo $o['payment']['paid_date'];?></td>
				<?php else:?>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				<?php endif;?>
					
				<td><?php echo $o['delivered_date'];?></td>
				<td><?php echo $o['tracking_no'];?></td>
					
				<?php if($o['status'] == 'P'):?>
					<td><button class="checked-btn" orderid ="<?php echo $o['order_id'];?>">Checked</button></td>
				<?php elseif($o['status'] == 'C'):?>
					<td style="text-align: left;">
						<input type="text" class="tracking-no" placeholder="tracking number"/><br/>
						<input type="text" class="delivered-date" placeholder="delivered date (yyyy-mm-dd)" value="<?php echo date('Y-m-d');?>" />
						<br/>
						<button class="delivered-btn" orderid ="<?php echo $o['order_id'];?>">Delivered</button>
					</td>
				<?php else: ?>
					<td>&nbsp;</td>
				<?php endif;?>
				
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
</div>

<script>
    $(function(){
		
		//$('.payment-checking .delivered-date').datepicker({ dateFormat: "yy-mm-dd" });
		
        $('.payment-checking .checked-btn').click(function(){
            $.post(base_url+'index.php/admin/order_set_checked', {order_id: $(this).attr('orderid')}, function(){
                $('.payment-checking').parent().load(base_url+'index.php/admin/payment_checking');
            });
        });
        $('.payment-checking .delivered-btn').click(function(){
            $.post(base_url+'index.php/admin/order_set_delivered', {
				order_id: $(this).attr('orderid'), 
				tracking_no:$(this).parent().find(".tracking-no").val(), 
				delivered_date:$(this).parent().find(".delivered-date").val() 
			}, function(){
                $('.payment-checking').parent().load(base_url+'index.php/admin/payment_checking');
            });
        });
    });
</script>