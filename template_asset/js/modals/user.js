$(function(){
    function reload_account_modal(callback)
    {
        $('#account-modal .modal-body').load(base_url+'index.php/user/account_info', function(result){
            callback(result);
        });
    }
    
    $('#account-modal').on('show.bs.modal', function(e){
        $(this).waiting();
        reload_account_modal(function(result){
            init_user_forms();
            $('#account-modal').waiting('done');
        });
    });
    
    function init_user_forms(){
        $('#account-modal .login-form form .signin-btn').click(function(e){
            e.preventDefault();
            var user_login = form_data_to_JSON('#account-modal .login-form form');
            user_login['pass'] = CryptoJS.SHA256(user_login['pass']).toString();
            $.post(base_url+'index.php/user/login', user_login, function(res){
                if(res == 'ok')
                {
                    notify('success', 'ลงชื่อเข้าใช้', 'ลงชื่อเข้าใช้เรียบร้อย');
                    login_callback();
                }
                else
                {
                    notify('error', 'ลงชื่อเข้าใช้', res);
                }
            });
        });

        $('#account-modal .register-form form .signup-btn').click(function(e){
            e.preventDefault();
            var user_info = form_data_to_JSON('#account-modal .register-form form');
            user_info['pass'] = CryptoJS.SHA256(user_info['pass']).toString();
            $.post(base_url+'index.php/user/register', user_info, function(res){
                if(res == 'ok')
                {
                    notify('success', 'สมัครสมาชิก', 'สมัครสมาชิกเรียบร้อย');
                    login_callback();
                }
                else
                {
                    notify('error', 'สมัครสมาชิก', res);
                }
            });
        });
    }
    
    function login_callback()
    {
        reload_account_modal(function(result){
            //hide loading
        });
    }
});