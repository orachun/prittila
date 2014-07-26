<div class="supplier">
	<table class="admin-table table table-striped">
		<thead>
			<th>Name</th>
			<th>URL</th>
			<th>Note</th>
			<th>Delete</th>
		</thead>
		<tbody>
			<?php foreach ($suppliers as $i=>$c):?>
			<tr>
				<td><?php echo $c->name;?></td>
				<td><a href="<?php echo $c->url;?>" target="_blank"><?php echo $c->url;?></a></td>
				<td><?php echo nl2br($c->note);?></td>
				<td><button class="del_btn" sid="<?php echo $c->supplier_id;?>">Delete</button></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
    <br/><br/>
    <div class="add item-container">
        Name: <input name="name"/> URL: <input name="url" size="40"/><br/>
		Note: <br/><textarea name="note" rows="5" cols="80"></textarea><br/>
		<button class="add_btn">Add</button>
    </div>
</div>

<script type="text/javascript">
    $('.supplier .add_btn').click(function(){
        var name = $('.supplier .add input[name="name"]').val();
        var url = $('.supplier .add input[name="url"]').val();
        var note = $('.supplier .add textarea[name="note"]').val();
        $.post(base_url+'index.php/admin/supplier_add', {
            'name': name,
            'url': url,
			'note': note
        }, function(){
            $('.supplier').parent().load(base_url+'index.php/admin/supplier');
        });
    });
    $('.supplier .del_btn').click(function(){
        if(confirm("Delete?"))
		{
			var sid = $(this).attr('sid');
			$.post(base_url+'index.php/admin/supplier_del', {
				'sid': sid
			}, function(){
				$('.supplier').parent().load(base_url+'index.php/admin/supplier');
			});
		}
    });
</script>