//Modal Shown Callbacks
$(function(){
    $('#shopping-bag-modal').on('show.bs.modal', function (e) {
        load_shopping_bag_modal();
    });
    
    $('#checkout-order-modal').on('show.bs.modal', function (e) {
        $('#checkout-order-modal').waiting();
        $('#checkout-order-modal .modal-body').load(base_url+'index.php/shopping_bag/checkout', function(result){
            $('#checkout-order-modal').waiting('done');
        });
    });
});


function load_shopping_bag_modal()
{
    $('#shopping-bag-modal .modal-body').waiting();
        $.get(base_url+'index.php/shopping_bag/modal_content', function(response){
            if(response.count == 0)
            {
                $('#shopping-bag-modal .modal-body .ordered-item-list').html('ยังไม่มีสินค้าที่เลือกค่ะ');
                $('#shopping-bag-modal .modal-body .upper').hide();
            }
            else
            {
                $('#shopping-bag-modal .modal-body .upper').show();
                $('#shopping-bag-modal .modal-body .total-price').html(response['total']);
                $('#shopping-bag-modal .modal-body .ordered-item-list').html(response['body']);

                $('#shopping-bag-modal .selected-item .save-btn').hide();
                $('#shopping-bag-modal .modal-body .ordered-item-list .del-btn').click(function(){
                    if(confirm('ลบสินค้าที่เลือก'))
                    {
                        $('#shopping-bag-modal .modal-body').waiting();
                        var rowid = $(this).parents(".selected-item").attr('rowid');
                        $.post(base_url+'index.php/shopping_bag/update_qty/'+rowid+'/0', function(e){
                            load_shopping_bag_modal();
                            notify('success','ลบสินค้า', 'ลบสินค้าที่เลือกเรียบร้อยค่ะ');
                        });
                    }
                });

                $('#shopping-bag-modal .modal-body .ordered-item-list .edit-btn').click(function(){
                    var qty_span = $(this).parents('.selected-item').find('.qty');
                    var qty = qty_span.html();
                    qty_span.html('<input name="qty" type="text" value="'+qty+'"/>');
                    $('#shopping-bag-modal .selected-item .edit-btn').hide();
                    $('#shopping-bag-modal .selected-item .save-btn').show();
                    $(this).parents('.selected-item').find('input[name="qty"]').focus();
                });

                $('#shopping-bag-modal .selected-item .save-btn').click(function(){
                    var rowid = $(this).parents(".selected-item").attr('rowid');
                    var qty = $(this).parents('.selected-item').find('input[name="qty"]').val();
                    if(isNaN(qty) || qty < 1)
                    {
                        notify('error','แก้ไขจำนวน', 'กรุณากรอกตัวเลขมากกว่า 0 ค่ะ');
                    }
                    else
                    {
                        $('#shopping-bag-modal .modal-body').waiting();
                        $.post(base_url+'index.php/shopping_bag/update_qty/'+rowid+'/'+qty, function(e){
                            load_shopping_bag_modal();
                            notify('success','แก้ไขจำนวน', 'แก้ไขจำนวนเรียบร้อยค่ะ');
                        });
                    }
                });
            }
            update_order_count(function(){
                $('#shopping-bag-modal .modal-body').waiting('done');
            });
        }, 'json');
}

function update_order_count(callback_function)
{
    $.get(base_url+'index.php/shopping_bag/order_count', function(response){
        $('#main-navbar #order-count').html(response);
        callback_function();
    });
}