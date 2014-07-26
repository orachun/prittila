<!-- shoppingbag modal -->
<div class="modal fade" id="shopping-bag-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">สินค้าที่เลือก</h4>
            </div>
            <div class="modal-body">
                <!-- modal body -->
                <button id="checkout-order-btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#checkout-order-modal">ส่งคำสั่งซื้อ</button>
                <span class="label label-default">รวม <span class="total-price">xxx.xx</span> บาท</span>
                <div class="margin-bottom">&nbsp;</div>

                <div class="ordered-item-list">
                    
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#shopping-bag-modal .modal-body #checkout-order-btn').click(function(e){
        $('#shopping-bag-modal').modal('hide');
    });
</script>