$(function(){
    $('.product-grid-item .anchor').click(function(e){
        e.preventDefault();
        
        var pid = $(this).attr('pid');	
        $('#product-detail-modal .modal-body').waiting();
        $.get(base_url+'/index.php/product/detail/'+pid, function(response){
            $('#product-detail-modal .modal-title').html(response['title']);
            $('#product-detail-modal .modal-body').html(response['body']);
            $('#product-detail-modal .modal-body').waiting('done');
            finalize_product_form();
        }, 'json');
        
        $('#product-detail-modal').modal('show');
    });
});

function finalize_product_form()
{
    $('#product-detail-modal .buy-form #buy-btn').click(function() {
        $('#product-detail-modal .modal-body').waiting();
        $.post(base_url+'index.php/shopping_bag/add',
                $('.product-detail .buy-form').serialize(),
                function(data) {
                    update_order_count(function(){
                        $('#product-detail-modal .modal-body').waiting('done');
                        $('#product-detail-modal').modal('hide');
                        notify('success', 'เพิ่มสินค้าเรียบร้อย', 'เพิ่มรายการสินค้าเรียบร้อยแล้วค่ะ สามารถเลือกซื้อสินค้าอื่นๆเพิ่มเติมได้เลยนะคะ หรือตรวจสอบรายการได้ที่เมนู Order นะคะ');
                    });
                }
        );
    });
}