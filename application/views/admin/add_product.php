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
        <label><input name="size" type="checkbox" value="R"/>Regular</label>
        <label><input name="size" type="checkbox" value="S"/>S</label>
        <label><input name="size" type="checkbox" value="M"/>M</label>
        <label><input name="size" type="checkbox" value="L"/>L</label>
        <label><input name="size" type="checkbox" value="XL"/>XL</label>
        <label><input name="size" type="checkbox" value="XXL"/>XXL</label>
		</div>
		<div>
        Color:
        <?php foreach($colors as $cen => $cth):?>
        <label><input name="color" type="checkbox" value="<?php echo $cen.':'.$cth;?>"/><?php echo $cth;?></label>
        <?php endforeach;?>
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
        <div><input class="submit-btn" type="button" value="Submit"/></div>
    </form>
</div>

<script type="text/javascript">
	$(function(){
			
		$('.add-product .submit-btn').click(function(){
			$('.add-product').waiting();

			var size = '';
			$('.add-product input[name="size"]:checked').each(function(index, element){
				size += $(element).val()+";";
			});
			var color = '';
			$('.add-product input[name="color"]:checked').each(function(index, element){
				color += $(element).val()+";";
			});
			$.post(base_url+'index.php/admin/add_product_submit', $('.add-product form').serialize()+"&color="+color+"&size="+size
                            //    +'&access_token='+fb_access_token
                        , function(data){
				var urls = $('.add-product form textarea[name="imgs"]').val().split("\n");
                                
                                fb_post_photos(urls, data.fb_desc, function(){
                                    $('.add-product').parent().load(base_url+'index.php/admin/add_product_form');
                                    $('body').append('<div>'+data+'</div>');
                                }, function(){
                                    alert('Cannot upload photo to facebook');
                                });
                                
			}, 'json');
		});

		initEditor('.add-product textarea[name="desc"]');
	});
</script>