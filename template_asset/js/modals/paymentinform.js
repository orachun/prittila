$(function(){
    $('#main-navbar a[data-target="#payment-inform-modal"]').click(function(){
        $('#payment-inform-modal #order-id').val('');
    });
    
    $('#payment-inform-modal').on('show.bs.modal', function(e){
        $('#payment-inform-modal').waiting();
        $('#payment-inform-modal #paydatetime').val('');
        $('#payment-inform-modal #amount').val('');
        $.get(base_url+'index.php/user/user_detail', function(data){
            if(data != null)
            {
                $('#payment-inform-modal #fullname').val(data.fullname);
            }
            else
            {
                $('#payment-inform-modal #fullname').val('');
            }
            $('#payment-inform-modal').waiting('done');
        }, 'json');
    });
});