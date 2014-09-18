<div class="promocode-list">
    <table class="admin-table table table-striped">
        <thead>
		<th>(ID) Code</th>
		<th>Desc</th>
		<th>Type</th>
		<th>Value</th>
		<th>Amount Threshold</th>
                <th>Customer</th>
		<th>Expiring Datetime</th>
		<th>Used Datetime</th>
		<th>Actions</th>
        </thead>
        <tbody>
            <?php foreach ($promocodes as $i => $p) :?>
                <tr class="" code_id="<?php echo $p['id']; ?>">
                    <td>(<?php echo $p['id']; ?>) <?php echo $p['code'];?></td>
                    <td><?php echo $p['desc'];?></td>
                    <td><?php echo ($p['type'] == Promocode_model::$TYPE_PERCENT ? 'Percent' : 'Value') ?></td>
                    <td><?php echo $p['value'];?></td>
                    <td><?php echo $p['amount_threshold'];?></td>
                    <td><?php echo ($p['customer_id'] == NULL ? 'Any':$p['customer_id']);?></td>
                    <td><?php echo $p['expire_datetime'];?></td>
                    <td><?php echo $p['used_datetime'];?></td>
                    <td>&nbsp;</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <div>
        <form id="add-promo-code">
            Type : <select name="type">
                <option value="<?php echo Promocode_model::$TYPE_PERCENT;?>">Percent</option>
                <option value="<?php echo Promocode_model::$TYPE_VALUE;?>">Value</option>
            </select><br/>
            Value : <input type="number" name="value"/><br/>
            Amount Threshold: <input type="number" name="threshold"/> Baht<br/>
            Valid Days: <input type="number" name="valid-days"/> Days<br/>
            Customer ID: <input type="number" name="customer-id"/><br/>
            <button id="add-promo-code-submit">Submit</button>
        </form>
    </div>
</div>

<script type="text/javascript">
	$(function(){
		$('#add-promo-code #add-promo-code-submit').click(function(e){
                    e.preventDefault();
                    $('.promocode-list').waiting();
                    $.post(
                        base_url+'index.php/admin/add_promocode', 
                        $('#add-promo-code').serialize(),
                        function(){
                            $('.promocode-list').parent().load(base_url+'index.php/admin/promocodes');
                        });
                });
	});
</script>