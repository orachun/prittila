<?php if(!$ajax):?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-Type" content="text/html; charset=utf-8">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico?dummy=dummy"> 
        <title>Prittila: รายการสั่งซื้อสินค้า <?php echo $display_id; ?></title>
    </head>
    <body>
<?php endif;?>


<style>
    <?php if(!$ajax):?>
    @import url(http://fonts.googleapis.com/css?family=Fredericka+the+Great);
    .main-logo {
        font-family: 'Fredericka the Great', cursive; 
        font-size: 3em; 
    }
    <?php endif;?>
    .main-logo
    {
        color:#b8919e;
        margin-bottom: 20px;
        text-align: center;
    }
    .order-info
    {
        max-width: 500px;
        width: 80%;
        border: solid 1px lightgray;
        padding: 20px;
        margin: auto;
        font: 12px/150% Arial,Helvetica,sans-serif,tahoma;
    }
    .order-info .lbl
    {
        font-weight: bold;
        width: 55px;
        display: inline-block;
    }
    .order-info .section-header
    {
        margin: 5px 0px;
        font-weight: bold;
        display: inline;
    }
    .order-info .order-info-section,
    .order-info .receiver-info-section
    {
        display: inline-block;
        width: 240px;
        vertical-align: top;
    }
    .order-info .order-info-section { margin-right: 10px; }
    .ordered-item-section table, 
    .ordered-item-section table td,
    .ordered-item-section table th
    {
		margin: 0px;
        text-align: center;
    }
	
	.ordered-item-section table, 
    .ordered-item-section table th
	{
        border-bottom: solid 1px lightgray;
	}
	
    .ordered-item-section table {width: 100%;}
    .ordered-item-section table .name
    {
        text-align: left;
    }
    .ordered-item-section table .qty,
    .ordered-item-section table .unit-price,
    .ordered-item-section table .sub-total
    {
        text-align: right;
    }
    .ordered-item-section ol
    {
        padding-left: 30px;
    }
</style>

<div class="order-info">
    <div class="main-logo">*PRITTILA*</div>
    <div class="order-info-section">
        <div class="section-header">ข้อมูลการสั่งซื้อ</div>
        <div><span class="lbl">เลขที่: </span><?php echo $display_id;?></div>
        <div><span class="lbl">วันที่สั่ง: </span><?php echo $ordered_datetime;?></div>
        <div><span class="lbl">สถานะ: </span><?php echo order_status($status);?></div>
        <div><span class="lbl">วันที่ส่ง: </span><?php echo empty($delivered_date)?'-': $delivered_date;?></div>
        <div><span class="lbl">เลขพัสดุ: </span><?php echo empty($tracking_no)?'-': $tracking_no;?></div>
    </div>
    <div class="receiver-info-section">
        <div class="section-header">ข้อมูลผู้รับสินค้า</div>
        <div><span class="lbl">ชื้อผู้รับ: </span><?php echo $receiver_name;?></div>
        <div><span class="lbl">ที่อยู่ผู้รับ: </span><br/><?php echo $delivery_addr;?></div>
        <div><span class="lbl">โทร: </span><?php echo $tel;?></div>
        <div><span class="lbl">อีเมล์: </span><?php echo $email;?></div>
    </div>
    <div class="ordered-item-section">
        <div class="section-header">รายการสินค้า</div>
        <ol>
        <?php foreach($order_items as $item):?>
            <li><div class="item-name">(<?php echo $item['display_id']?>) <?php echo $item['name'];?></div>
                <div class="item-detail">
                    ขนาด <?php echo $item['size']?> 
                    สี<?php echo th_color($item['color']);?>
                    จำนวน <?php echo $item['amount'];?> ชิ้น
                </div>
                <div class="item-detail">
                    ราคาต่อชิ้น <?php echo number_format($item['unit_price'], 0);?>฿
                    รวม <?php echo number_format($item['amount']*$item['unit_price'], 0);?>฿
                </div>
            </li>
        <?php endforeach;?>
        </ol>
        
        <span class="section-header">รวม: </span>
        <?php echo number_format($total_before_discount, 0);?>฿
    </div>
    
    <div class="selected-deliver-section">
        <span class="section-header">วิธีการส่ง: </span>
        <span>
            <?php echo $delivering['name']; ?> ค่าส่ง <?php echo $delivering['cost']; ?>฿ (ค่าส่ง <?php echo number_format($delivering['unit_cost']); ?>฿ 
                <?php
                if ($delivering['free_threshold'] < 100)
                {
                    echo 'สั่งซื้อสินค้า ' . $delivering['free_threshold'] . ' ชิ้นขึ้นไป ส่งฟรี!';
                }
                ?>)
        </span>
    </div>
    <div class="net-total-section">
        <span class="section-header">รวมทั้งสิ้น: </span>
        <?php echo number_format($net_total, 0);?>฿
    </div>
	
	<div>สามารถดูหน้านี้ได้ที่ <a href="<?php echo base_url().'index.php/order/display/'.$order_id;?>" target="_blank"><?php echo base_url().'index.php/order/display/'.$order_id;?></a></div>
    <br/><br/><br/>
    <center>----- ขอบคุณค่ะ -----</center>
</div>

<?php if(!$ajax):?>
    </body>
</html>
<?php endif;?>