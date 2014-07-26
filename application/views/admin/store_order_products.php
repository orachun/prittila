<div class="store-order-products">
	<table class="admin-table table table-striped">
		<thead>
			<th>URL</th>
			<th>Product ID</th>
			<th>Size</th>
			<th>Color</th>
			<th>Amount</th>
		</thead>
		<tbody>
			<?php foreach($products as $i=>$p):?>
			<tr>
				<td>
					<input type="checkbox"/>
					<a href="<?php echo $p['supplier_product_url'];?>" target="_blank">LINK</a>
					( <?php echo $p['supplier_product_url'];?> )
				</td>
				<td><?php echo $p['product_id'];?></td>
				<td><?php echo $p['size'];?></td>
				<td><?php echo $p['color'];?></td>
				<td><?php echo $p['amount'];?></td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
</div>