<style>
    .add-product textarea{width: 60%; height: 130px; display: block;}
</style>

<div class="add-product">
	<div>
			</div>
    <form>
		Category:
        <select name="cat_id">
        <?php foreach($cats as $c):?>
        <option value="<?php echo $c->product_cat_id;?>"><?php echo $c->name;?></option>
        <?php endforeach;?>
        </select>
        Name: <input type="text" name="name" size="40"/><br/>
        Desc: <textarea name="desc"></textarea><br/>
        Cost Unit price: <input type="text" name="cost"/> 
        Selling Unit price: <input type="text" name="unit_price"/><br/>
		<a href="http://www.bot.or.th/Thai/Statistics/FinancialMarkets/ExchangeRate/_layouts/Application/ExchangeRate/ExchangeRate.aspx#" target="_blank">Exchange rate</a>
		<div>
        Size: 
        <label><input name="size" type="checkbox" value="Regular"/>Regular</label>
        <label><input name="size" type="checkbox" value="S"/>S</label>
        <label><input name="size" type="checkbox" value="M"/>M</label>
        <label><input name="size" type="checkbox" value="L"/>L</label>
        <label><input name="size" type="checkbox" value="XL"/>XL</label>
        <label><input name="size" type="checkbox" value="XXL"/>XXL</label>
		</div>
		<div>
        Color:
        <table>
            <tr>
                <td><select multiple size="10">
                    <?php foreach($colors as $cen => $cth):?>
                        <option href="#" class="color_picker"><?php echo $cth.' ('.$cen.')';?></option>
                    <?php endforeach;?>
                    </select>
                </td>
                <td><textarea id="color-text" name="color" cols="100" rows="12"></textarea></td>
            </tr>
        </table>
        
		</div>
<!--        
        <div>Supplier</div>
        <select name="supplier">
            <?php foreach($suppliers as $c):?>
            <option value="<?php echo $c->supplier_id;?>"><?php echo $c->name;?></option>
            <?php endforeach;?>
        </select>-->
        Product URL: <input type="text" name="supplier_product_url" size="50"/><br/>
        Image URLs: <textarea name="imgs"></textarea><br/>
        Facebook Desc: (<?php echo fb_desc_placeholder_list();?>)
		<textarea name="fb_desc"><?php echo fb_default_desc();?></textarea><br/>
                <label><input type="checkbox" name="print-request">Print Request Only</label>
        <div><input class="submit-btn" type="button" value="Submit"/></div>
    </form>
    <pre id="add-product-request"></pre>
</div>
<script type="text/javascript">
	$(function(){
			
            $('.color_picker').click(function(){
                $('#color-text').val($('#color-text').val()+$(this).html()+"\n");
                return false;
            });    
            
		$('.add-product .submit-btn').click(function(){
			$('.add-product').waiting();
			var size = '';
			$('.add-product input[name="size"]:checked').each(function(index, element){
				size += $(element).val()+";";
			});
                        if(form_data_to_JSON('.add-product form')['print-request'] != 'on')
                        {
                            $.post(base_url+'index.php/admin/add_product_submit', $('.add-product form').serialize()
                        +"&size="+size
                            , function(data){
                                    fb_post_photos(data.imgs, data.fb_desc, function(){
                                        $('.add-product').parent().load(base_url+'index.php/admin/add_product_form');
                                        $('body').append('<div>'+data+'</div>');
                                    }, function(){
                                        alert('Cannot upload photo to facebook');
                                        $('.add-product').waiting('done');
                                    });
                            }, 'json');
                        }
                        else
                        {
                            var req = "$.post(base_url+'index.php/admin/add_product_submit', "+$('.add-product form').serialize()+'&size=' + size
                            + ", function(data){ "
                                    + "fb_post_photos(data.imgs, data.fb_desc, function(){ "
                                        + "$('.add-product').parent().load(base_url+'index.php/admin/add_product_form'); "
                                        + "$('body').append('<div>'+data+'</div>'); "
                                    + "}, function(){ "
                                        + "alert('Cannot upload photo to facebook'); "
                                        + "$('.add-product').waiting('done'); "
                                    + "}); "
                            + "}, 'json'); ";
                            $('.add-product #add-product-request').text(req);
                            $('.add-product form')[0].reset();
                            $('.add-product').waiting('done');
                        }
		});

	});
</script>