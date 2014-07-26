<div class="delivering">
	<table class="admin-table table table-striped">
		<thead>
			<th>Name</th>
			<th>Unit Cost<br/>(Baht)</th>
			<th>Free Threshold<br/>(items)</th>
			<th>Discarded</th>
			<th>Discard</th>
		</thead>
		<tbody>
			<?php foreach($deliverings as $i=>$c):?>
			<tr class="<?php echo ($c->is_discarded=='Y'?'disabled':'')?>">
			<td><?php echo $c->name;?></td> 
			<td><?php echo $c->unit_cost;?></td>
			<td><?php echo $c->free_threshold;?></td>
			<td><?php echo $c->is_discarded;?></td>
			<td>
				<?php if($c->is_discarded=='N'):?>
					<button class="del_btn" did="<?php echo $c->delivery_type_id;?>">Discard</button> 
				<?php endif;?>
					&nbsp;
			</<td>

			<?php endforeach; ?>
		</tbody>
	</table>
	
    <form class="add">
        Name: <input name="name"/> 
        Unit cost: <input name="unit_cost"/> 
        Free threshold: <input name="free_threshold"/>
        <input type="button" class="add_btn" value="Add">
    </form>
</div>

<script type="text/javascript">
    $('.delivering .add_btn').click(function(){
        $.post(base_url+'index.php/admin/add_delivery', $('.delivering .add').serialize(), function(){
            $('.delivering').parent().load(base_url+'index.php/admin/delivering');
        });
    });
    $('.delivering .del_btn').click(function(){
        if(confirm("Can't be undone! Discard?"))
		{
			var did = $(this).attr('did');
			$.post(base_url+'index.php/admin/discard_delivery', {
				'id': did
			}, function(){
				$('.delivering').parent().load(base_url+'index.php/admin/delivering');
			});
		}
    });
</script>