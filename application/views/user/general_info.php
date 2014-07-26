<div class="general-info">
    <form class="user-info-form form-horizontal" role="form">
        <div class="form-group">
            <label for="input-email" class="col-sm-3 control-label">อีเมล์</label>
            <div class="col-sm-9">
                <?php echo $email; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="input-fullname" class="col-sm-3 control-label">ชื่อ-นามสกุล</label>
            <div class="col-sm-9">
                <input name="fullname" type="text" class="form-control" 
                       id="input-fullname" placeholder="ชื่อ-นามสกุล"
                       value="<?php echo $fullname;?>">
            </div>
        </div>

        <div class="form-group">
            <label for="input-addr" class="col-sm-3 control-label">ที่อยู่ในการจัดส่งสินค้า</label>
            <div class="col-sm-9">

                <textarea name="addr" type="text" class="form-control" 
                          id="input-addr" placeholder="ที่อยู่ในการจัดส่งสินค้า"><?php echo $addr;?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="input-tel" class="col-sm-3 control-label">โทรศัพท์</label>
            <div class="col-sm-9">
                <input name="tel" type="text" class="form-control" 
                       id="input-tel" placeholder="โทรศัพท์"
                       value="<?php echo $tel;?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-primary submit-btn">บันทึก</button>
            </div>
        </div>
    </form>

    <button class="btn btn-info" data-toggle="collapse" data-target="#change-pass-panel">เปลี่ยนรหัสผ่าน</button>
    <div id="change-pass-panel" class="collapse">
        <form class="change-password-form form-horizontal" role="form">
            <div class="form-group">
                <label for="input-old_pass" class="col-sm-3 control-label">รหัสผ่านเดิม</label>
                <div class="col-sm-9">
                    <input name="old_pass" type="password" class="form-control" id="input-pass" placeholder="รหัสผ่านเดิม">
                </div>
            </div>
            <div class="form-group">
                <label for="input-new_pass" class="col-sm-3 control-label">รหัสผ่านใหม่</label>
                <div class="col-sm-9">
                    <input name="new_pass" type="password" class="form-control" id="input-pass" placeholder="รหัสผ่านใหม่">
                </div>
            </div>
            <div class="form-group">
                <label for="input-new_pass_confirm" class="col-sm-3 control-label">ยืนยันรหัสผ่านใหม่</label>
                <div class="col-sm-9">
                    <input name="new_pass_confirm" type="password" class="form-control" id="input-pass" placeholder="ยืนยันรหัสผ่านใหม่">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary submit-btn">แก้ไขรหัสผ่าน</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(function() {

        $('.general-info .user-info-form .submit-btn').click(function(e) {
            e.preventDefault();
//            if (form_valid('.general-info .user-info-form', {
//                fullname: {required: true},
//                addr: {required: true},
//                tel: {required: true, digits: true, minlength: 9}
//            }))
            if(true)
            {
                $('.general-info').waiting({fixed: true});
                $.post(base_url + 'index.php/user/edit_info',
                        form_data_to_JSON('.general-info .user-info-form'),
                        function(data) {
                            if (data == 'ok')
                            {
                                $('.general-info').parent().load(base_url + 'index.php/user/general_info', function() {
                                    $('.general-info').waiting('done');
                                    notify('success', 'แก้ไขข้อมูล', 'แก้ไขข้อมูลเรียบร้อยค่ะ');
                                });
                            }
                            else
                            {
                                $('.general-info').waiting('done');
                                notify('error', 'แก้ไขข้อมูล', data);
                            }
                        });
            }
        });

        $('.general-info #change-pass-panel').on('show.bs.collapse', function(e){
            e.stopPropagation();
        });

        $('.general-info .change-password-form .submit-btn').click(function(e) {
            e.preventDefault();
//            if (form_valid('.general-info .change-password-form', {
//                old_pass: {required: true},
//                new_pass: {required: true, minlength: 4},
//                new_pass_confirm: {required: true, equalTo: '.general-info .change-password-form input[name="new_pass"]'}
//            }))
            if(true)
            {
                $('.general-info').waiting({fixed: true});
                var pass_info = form_data_to_JSON('.general-info .change-password-form');
                pass_info['old_pass'] = CryptoJS.SHA256(pass_info['old_pass']).toString();
                pass_info['new_pass'] = CryptoJS.SHA256(pass_info['new_pass']).toString();
                pass_info['new_pass_confirm'] = CryptoJS.SHA256(pass_info['new_pass_confirm']).toString();
                $.post(base_url + 'index.php/user/change_pass', pass_info,
                        function(data) {
                            if (data == 'ok')
                            {
                                $('.general-info').waiting('done');
                                notify('success', 'แก้ไขรหัสผ่าน', 'แก้ไขรหัสผ่านเรียบร้อยค่ะ');
                            }
                            else
                            {
                                $('.general-info').waiting('done');
                                notify('error', 'แก้ไขรหัสผ่าน', data);
                            }
                        });
            }
        });


        //themeButton('.general-info');
    });
</script>