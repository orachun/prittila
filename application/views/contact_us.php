<style>
    .contact-us .icon
    {
        vertical-align: middle;
        width: 16px;
        height: 16px;
    }
	.contact-us .contact-form .form-item input
	{
		width: 180px;
		height: 30px;
		margin-bottom: 5px;
	}
	.contact-us .contact-form .form-item textarea
	{
		width: 180px;
		height: 60px;
	}
</style>
<div class="contact-us">
    <h1>ติดต่อเรา</h1>
    <form class="contact-form">
        <?php if($is_logged_in == FALSE):?>
        <div class="form-item form-item-name"><div><input name="name" type="text" placeholder="ชื่อ"/></div></div>
        <div class="form-item form-item-email"><div><input name="email" type="text" placeholder="อีเมล์"/></div></div>
        <div class="form-item form-item-tel"><div><input name="tel" type="text" placeholder="หมายเลขโทรศัพท์"/></div></div>
        <?php endif;?>
        <div class="form-item form-item-msg"><div><textarea name="msg" placeholder="ข้อความ"></textarea></div></div>
        <div class="form-item form-item-send-btn"><span class="send-btn ui-corner-all button">ส่งข้อความ</span></div>
    </form>

    <h1>ช่องทางอื่นๆ</h1>
    <?php contact_info(true);?>
</div>
<script type="text/javascript">
    $('.contact-us .send-btn').click(function(){
        if(form_valid('.contact-us .contact-form'), {
            'name': { required: true },
            'email': { required: true, email: true },
            'tel': { required: true, digits: true, minlength: 9 },
            'msg' : {required: true}
        })
        {
            $('.contact-us').parent().waiting();
            $.post('<?php echo base_url();?>index.php/others/contact_us_submit', 
                $('.contact-us .contact-form').serialize(), 
                function(data){
                    if(data == 'ok')
                    {
                        notify('succcess','ส่งข้อความ', 'บันทึกข้อความที่ส่งเรียบร้อยค่ะ');
                    }    
                    else
                    {
                        notify('error', 'ส่งข้อความไม่สำเร็จ', data);
                    }
                    $('.contact-us').parent().waiting('done');
                }
                );
        }
    });
    themeButton('.contact-us');
</script>