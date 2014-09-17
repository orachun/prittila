<div class="product-list">
    <table class="admin-table table table-striped">
        <thead>
		<th>ID</th>
		<th>Name</th>
		<th>Link</th>
		<th>Price/Cost</th>
		<th>Avail. Color</th>
		<th>Avail. Size</th>
		<th>Status</th>
		<th>Actions</th>
        </thead>
        <tbody>
			<?php
			foreach ($products as $i => $p) :
				$link = base_url() . 'index.php/product/detail/' . $p['product_id'];
			?>
	            <tr class="<?php echo $p['status'] == 'I'?'disabled':'';?>" pid="<?php echo $p['product_id']; ?>">
	                <td><?php echo $p['product_id']; ?></td>
	                <td><?php echo $p['name']; ?></td>
	                <td><a href="<?php echo $link; ?>" target="_blank"><?php echo $link; ?></a></td>
	                <td><?php echo $p['unit_price'] . '/' . $p['cost']; ?></td>
	                <td><?php foreach ($p['avail_colors'] as $cen => $cth) echo $cen.' '; ?></td>
	                <td><?php foreach ($p['avail_sizes'] as $s) echo $s.' '; ?></td>
	                <td><?php echo $p['status']; ?></td>
	                <td>
						<button pid="<?php echo $p['product_id']; ?>" class="inactivate-btn" status="<?php echo $p['status']; ?>">
							<?php echo $p['status'] == 'A' ? 'Inactivate' : 'Activate'; ?>
						</button> 
					</td>
	            </tr>
<?php endforeach; ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
	$(function(){
		$('.product-list .inactivate-btn').click(function(){
			var pid = ($(this).attr('pid'));
			var status = $(this).attr('status');
			if(status == "A" ? confirm("Inactivate product id "+pid+"?") : confirm("Activate product id "+pid+"?"))
			{
				$.post(base_url+'index.php/admin/set_product_status', {"pid":pid, "status": status == "A" ? "I" : "A"}, function(){
					$('.product-list').parent().load(base_url+'index.php/admin/products');
				});
			}
		});
	});
</script>