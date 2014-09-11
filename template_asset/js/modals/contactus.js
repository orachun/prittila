
$(function(){
    $('#contact-modal').on('show.bs.modal', function(e){
        $.get(base_url+'index.php/user/get', function(res){
            if(res.success == 'true')
            {
                $('#contact-modal #guest-section').hide();
            }
            else
            {
                $('#contact-modal #guest-section').show();
            }
        }, 'json');
        $('#contact-modal form').validate().resetForm();
        $('#contact-modal form *').removeClass('error');
    });
    $('#contact-modal #submit-btn').click(function(e) {
        e.preventDefault();
        var form = $(this).parents('form');
        var valid = form.validate().form();
        if (valid)
        {
            $('#contact-modal .modal-body').waiting();
            $.post(base_url + 'index.php/others/contact_us_submit',
                    $(form).serialize(),
                    function(data) {
                        if (data == 'ok')
                        {
                            notify('succcess', 'ส่งข้อความ', 'บันทึกข้อความที่ส่งเรียบร้อยค่ะ');
                        }
                        else
                        {
                            notify('error', 'ส่งข้อความไม่สำเร็จ', data);
                        }
                        $('#contact-modal .modal-body').waiting('done');
                    }
            );
        }
    });
});