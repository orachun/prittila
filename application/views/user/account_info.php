<div class="account-info">
	<h4>ยินดีต้อนรับ คุณ <?php echo $fullname;?></h4>
    
    <div class="panel-group" id="account-menu-accordion">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#account-menu-accordion" 
                 href=".account-info #general-info">
                ข้อมูลส่วนตัว
              </a>
            </h4>
          </div>
          <div id="general-info" class="panel-collapse collapse account-menu-panel"
                 data-url="<?php echo base_url('index.php/user/user_area/general_info');?>">
            <div class="panel-body">
            </div>
          </div>
        </div>
        <div class="panel panel-info">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#account-menu-accordion" 
                 href=".account-info #order-info">
                รายการสั่งซื้อสินค้า
              </a>
            </h4>
          </div>
          <div id="order-info" class="panel-collapse collapse account-menu-panel"
                 data-url="<?php echo base_url('index.php/user/user_area/orders');?>">
            <div class="panel-body">
            </div>
          </div>
        </div>
      </div>
    
    
    
    <button class="logout-btn btn btn-danger">ลงชื่อออก</button>
</div>

<script type="text/javascript">
   
        $('.account-info .logout-btn').click(function(){ 
            $('.account-info').parent().waiting();
            $.post('<?php echo base_url();?>index.php/user/logout', 
                function (data) {
                    $('.account-info').parent().waiting('done');
                    $('#account-modal .modal-header .close').click();
                    notify('success', 'ออกจากระบบ', 'ออกจากระบบเรียบร้อยค่ะ');
                    user_info = null;
                }
            );
        });
        
        $('.account-info #account-menu-accordion .account-menu-panel').on('show.bs.collapse', function(e){
            $('.account-info').waiting();
            $(this).find('.panel-body').load($(this).attr('data-url'), function(result){
                $('.account-info').waiting('done');
            });
        });
        
 
    
</script>