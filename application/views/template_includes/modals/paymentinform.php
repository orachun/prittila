<!-- payment inform modal -->
<div class="modal" id="payment-inform-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">แจ้งชำระเงิน</h4>
            </div>
            <div class="modal-body">
                <!-- modal body -->
                <form id="payment-inform-form" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="inputfullname" class="col-sm-3 control-label">ชื่อ</label>
                        <div class="col-sm-9">
                            <input type="text" name="fullname" class="form-control" id="fullname" placeholder="ชื่อ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputorder-id" class="col-sm-3 control-label">เลขที่ใบสั่งซื้อ</label>
                        <div class="col-sm-9">
                            <input type="text" name="order-id" class="form-control" id="order-id" placeholder="เลขที่ใบสั่งซื้อ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputpaydatetime" class="col-sm-3 control-label">วัน-เวลาที่ชำระ</label>
                        <div class="col-sm-9">
                            <input type="datetime" name="paydatetime" class="form-control" id="paydatetime" placeholder="เช่น 25/12/2557 15:50:00">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputamount" class="col-sm-3 control-label">จำนวนเงิน</label>
                        <div class="col-sm-9">
                            <input type="text" name="amount" class="form-control" id="amount" placeholder="จำนวนเงิน">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputslip" class="col-sm-3 control-label">สลิป (ถ้ามี)</label>
                        <div class="col-sm-9">
                            <div id="slip-uploader"></div
                            <input type="hidden" id="slip" name="slip"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" id="payment-inform-submit-btn" class="btn btn-primary">แจ้งชำระเงิน</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#payment-inform-modal #payment-inform-submit-btn').click(function(e){
        e.preventDefault();
        var info = form_data_to_JSON('#payment-inform-modal #payment-inform-form');
        $.post(base_url+'index.php/order/payment_inform', info, function(res){
            if(res == 'ok')
            {
                notify('success', 'แจ้งชำระเงิน', 'แจ้งชำระเงินเรียบร้อยจ้า');
                $('#payment-inform-modal').modal('hide');
            }
            else
            {
                notify('error', 'แจ้งชำระเงิน', res);
            }
        });
        
    });
    create_upload_form('#payment-inform-modal #slip-uploader', function(filename){
        $('#payment-inform-modal #slip').val(filename);
    }, function(errorMsg){
        alert(errorMsg);
    });
</script>