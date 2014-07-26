<div class="order-detail">
	<div>ID: <?php echo $order['order_id'];?></div>
	<div>Display ID: <?php echo $order['display_id'];?></div>
	<div>Store Order ID: <?php echo $order['store_order_id'];?></div>
	<div>Customer ID: <?php echo $order['customer_id'];?></div>
	<div>Customer Coupon ID: <?php echo $order['customer_coupon_id'];?></div>
	<div>Net Total: <?php echo $order['net_total'];?></div>
	<div>Receiver Name: <?php echo $order['receiver_name'];?></div>
	<div>Ordered Date: <?php echo $order['ordered_datetime'];?></div>
	<div>Deliver Address: <?php echo $order['delivery_addr'];?></div>
	<div>Delivering Type: <?php echo $order['delivery_type'];?></div>
	<div>Status: <?php echo $order['status'];?></div>
	<div>Delivered Date: <?php echo $order['delivered_date'];?></div>
	<div>Tracking No.: <?php echo $order['tracking_no'];?></div>
	<div>
		<table class="admin-table table table-striped">
			<thead>
				<th>Product ID</th>
				<th>Size</th>
				<th>Color</th>
				<th>Amount</th>
				<th>Unit Price</th>
			</thead>
			<tbody>
				<?php foreach($order['items'] as $i=>$item):?>
				<tr class="">
					<td><?php echo $item['product_id'];?></td>
					<td><?php echo $item['size'];?></td>
					<td><?php echo $item['color'];?></td>
					<td><?php echo $item['amount'];?></td>
					<td><?php echo $item['unit_price'];?></td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>