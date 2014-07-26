<div class="page-list">
	<table class="admin-table table table-striped">
		<thead>
			<th>Title</th>
			<th>Link Name</th>
			<th>Delete</th>
			<th>Edit</th>
		</thead>
		<tbody>
			<?php foreach($pages as $i=>$p):?>
			<tr class=""  pid="<?php echo $p['id'];?>">
				<td>
					<a href="<?php echo base_url().'index.php/page/content/'.$p['link_name'];?>" target="_blank">
						<?php echo $p['name'];?>
					</a>
				</td>
				<td><?php echo $p['link_name'];?></td>
				<td><button class="del-page" pid="<?php echo $p['id'];?>">Del</button></td>
				<td>
					<button class="edit-btn">Edit</button>
					<form class="edit-container" style="text-align: left;">
						<button class="save_page">Save</button>
						<input type="hidden" name="id" value="<?php echo $p['id'];?>"/>
						Name: 
						<input type="text" name="name" value="<?php echo $p['name'];?>" size="50"/>
						Link: 
						<input type="text" name="link_name" value="<?php echo $p['link_name'];?>"/>
						<br/>
						<textarea name="content" class="page-content">
							<?php echo $p['content'];?>
						</textarea><br/>
					</form>
				</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
    
    <br/><br/><br/>
    <form class="add-page">
        Name: <input type="text" name="name" size="50"/><br/>
        Link: <input type="text" name="link_name"/><br/>
        <textarea id="new-page-content" name="content"></textarea><br/>
		<a href="http://www.picdee.com/" target="_blank">Upload Image</a><br/>
        <input type="submit" value="Add"/>
    </form>
</div>


<script>
    $(function(){
        $('.page-list .edit-container').hide();
        $('.page-list .edit-btn').click(function(){
            if($(this).html() == 'Edit')
            {
                $(this).parent().find('.edit-container').show();
                $(this).html('Hide');
				var id = $(this).parents("tr").attr("pid");
				initEditor('.page-list tr[pid="'+id+'"] .page-content');
            }
            else
            {
                $(this).parent().find('.edit-container').hide();
                $(this).html('Edit');
            }
        });
        
		
		$('.page-list .edit-container').submit(function(){
			$('.page-list').waiting();
			$.post(base_url+'index.php/admin/edit_page', $(this).serialize(), function(){
                $('.page-list').parent().load(base_url+'index.php/admin/page');
            });
			return false;
		});
		
        $('.page-list .add-page').submit(function(){
            $('.page-list').waiting();
//			$('.page-list .add-page #new-page-content').val(tinyMCE.get('new-page-content').getContent());
            $.post(base_url+'index.php/admin/add_page', $(this).serialize(), function(){
                $('.page-list').parent().load(base_url+'index.php/admin/page');
            });
            return false;
        });
        $('.page-list .del-page').click(function(){
            if(confirm("Delete the page?"))
			{
				var btn = $(this);
				$.post(base_url+'index.php/admin/del_page', {id:$(this).attr('pid')}, function(){
					btn.parent().remove();
				});
			}
        });
		
		initEditor('.page-list .add-page #new-page-content');
    });
    
    
</script>