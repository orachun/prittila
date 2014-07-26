<div class="category">
    <table class="admin-table table table-striped">
		<thead>
			<th>Category</th>
			<th>Delete</th>
		</thead>
	
	<?php foreach($cats as $i=>$c):?>
		<tr class="<?php echo $i%2==0?'odd':'even';?>">
			<td><?php echo $c->name;?></td>
			<td><button class="del_btn" catname="<?php echo $c->name;?>">Delete</button></td>
		</tr>
    <?php endforeach; ?>
	</table>
    <div class="add item-container">
        <input name="cat_name" placeholder="category name"/><button class="add_btn">Add</button>
    </div>
</div>

<script type="text/javascript">
    $('.category .add_btn').click(function(){
        var name = $('.category .add input').val();
        $.post(base_url+'index.php/admin/category_add', {'name':name}, function(){
            $('.category').parent().load(base_url+'index.php/admin/category');
        });
    });
    $('.category .del_btn').click(function(){
        var name = ($(this).attr('catname'));
		if(confirm("Delete category "+name+"?"))
		{
			$.post(base_url+'index.php/admin/category_del/'+name, function(){
				$('.category').parent().load(base_url+'index.php/admin/category');
			});
		}
    });
</script>