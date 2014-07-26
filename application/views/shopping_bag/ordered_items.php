<style>
    .order-review .ordered-items .qty
    {
        width: 50px;
        text-align: right;
        vertical-align: baseline;
        border: none;
		background: none;
    }
</style>

<div class="ordered-items">
    <div class="section-header">สินค้าที่เลือกทั้งหมด <span id="item-count"><?php echo $item_count; ?></span> ชิ้น</div>
    <div class="table-container">
        <?php echo $table; ?>
    </div>
    <div class="total">
        รวมราคาสินค้า <span id="total-before-discount"><?php echo number_format($this->cart->total(), 2); ?></span> บาท
    </div>
</div>

<script type="text/javascript">

	var reload = function(notif){
		
	};



    $('.order-review .ordered-items .del-btn').click(function(){
        var rowid = $(this).attr('rowid');
            $('.order-review').waiting();
        $.post(base_url+'index.php/shopping_bag/update_qty/'+rowid+'/0', function(){
            $('.coupon-deliver').parent().load(base_url+'index.php/shopping_bag/coupon_deliver', 
				function(){
					$('.ordered-items').parent().load(base_url+'index.php/shopping_bag/ordered_items', 
						function(){
						$('.order-review').waiting('done');
						notify('success', 'ลบสินค้า','ลบสินค้าที่เลือกเรียบร้อยค่ะ')
					});
				});
        });
    });
    
    
    $('.order-review .ordered-items .change-qty-btn').click(function(){
        if(!$(this).hasClass('editing-state'))
        {
            $(this).addClass('editing-state');
            $(this).html('บันทึก');
            $(this).parents('td').find('.qty').removeAttr("readonly");
            $(this).parents('td').find('.qty').spinner({min:1, stop: function(){
                if($(this).spinner('value') < 1)
                {
                    $(this).spinner('value', 1);
                }
                var qty = $(this).spinner('value');
                var unitPrice = parseFloat($(this).parents('tr').find('.unit-price').html());
                $(this).parents('tr').find('.sub-total').html(number_format(qty * unitPrice, 2));
            }});
        
        }
        else
        {
            $('.order-review').waiting();
            var qty = $(this).parents('td').find('.qty').spinner('value');
            var rowid = $(this).attr('rowid');
            console.log(base_url+'index.php/shopping_bag/update_qty/'+rowid+'/'+qty);
            $.post(base_url+'index.php/shopping_bag/update_qty/'+rowid+'/'+qty, function(){
				$('.coupon-deliver').parent().load(base_url+'index.php/shopping_bag/coupon_deliver', 
				function(){
					$('.ordered-items').parent().load(base_url+'index.php/shopping_bag/ordered_items', 
						function(){
						$('.order-review').waiting('done');
						notify('success', 'แก้ไขสินค้าที่เลือก', 'แก้ไขจำนวนสินค้าที่เลือกเรียบร้อยค่ะ');
					});
				});
			});
        }
    });
    
    themeButton('.ordered-items');
</script>