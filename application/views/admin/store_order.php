<div class="store-order">
    <table class="admin-table table table-striped">
		<thead>
			<th>ID</th>
			<th>Status</th>
			<th>Closing Date</th>
			<th>Delete</th>
		</thead>
		<tbody>
			<?php foreach($orders as $i=>$c):?>
			<tr class="<?php if($c['status']=='Closed')echo 'disabled';?>" oid="<?php echo $c['store_order_id'];?>">
				<td><?php echo $c['store_order_id'];?></td>
				<td><?php echo $c['status'];?></td>
				<td><?php echo $c['close_date'];?></td>
				<td>
					<?php if($c['status'] == 'Future'):?>
						<button class="del_btn">Delete</button>	
					<?php endif;?>
					&nbsp;
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
    <div class="add">
        Next Close Date: <input name="date"/> <button class="add_btn">Add</button>
    </div>
</div>

<script type="text/javascript">
	var reload = function(){
		$('.store-order').parent().load(base_url+'index.php/admin/store_order');
	};
	
	$(function(){
		//$('.store-order input[name="date"]').datepicker({ dateFormat: "yy-mm-dd" });
		
		$('.store-order .add_btn').click(function(){
			var d = $('.store-order .add input[name="date"]').val();
			$.post(base_url+'index.php/admin/add_store_order', {
				'date': d
			}, reload);
		});
		$('.store-order .del_btn').click(function(){
			if(confirm("Delete?"))
			{
				var sid = $(this).parents('tr').attr('oid');
				$.post(base_url+'index.php/admin/del_store_order', {
					'sid': sid
				}, reload);
			}
		});
	});
</script>