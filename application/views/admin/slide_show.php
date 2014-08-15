<div class="slide-show-list">
    <?php foreach($slides as $s):?>
    <div class="item-container">
        <a href="<?php echo base_url().$s['img'];?>" target="_blank"><img src="<?php echo base_url().$s['img'];?>" height="100"/></a><br/>
		<a href="<?php echo base_url().$s['link'];?>" target="_blank"><button>LINK</button></a>
        <button class="del-slide" id="<?php echo $s['slide_id'];?>">Del</button>
    </div>
    <?php endforeach;?>
    
    <form class="add-slide">
        Link: <?php echo base_url();?><input type="text" name="link" size="50"/>
        <input id="img-name" type="hidden" name="img-name"/>
        <div class="img-upload"></div>
        <input type="button" class="add-slide-btn" value="Add"/>
    </form>
</div>

<script>
$(function(){
    
    create_upload_form('.slide-show-list .add-slide .img-upload', function(response){
        $('.slide-show-list .add-slide #img-name').val(response);
    }, function(err)
    {
        alert(err);
    });
    
    
    
//    ajax_upload_form('.slide-show-list .img-upload', '.slide-show-list .add-slide input[name="img-name"]', '<input type="button" value="Upload Img"/>');
    $('.slide-show-list .add-slide .add-slide-btn').click(function(){
        $.post(base_url+'index.php/admin/add_slideshow', $('.slide-show-list .add-slide').serialize(),
            function(data){
                $('.slide-show-list').parent().load(base_url+'index.php/admin/slideshow');
            });
    });
    $('.slide-show-list .del-slide').click(function(){
        if(confirm("Delete the slide?"))
		{
			$.post(base_url+'index.php/admin/del_slideshow', {'slide-id': $(this).attr('id')}, function(){
				$('.slide-show-list').parent().load(base_url+'index.php/admin/slideshow');
			});
		}
    });
});    
</script>