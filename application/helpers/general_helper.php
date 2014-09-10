<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function ___config($key = NULL)
{
    $___config = array(
        'base_path' => config_item('base_path').'/',
        'items_per_page' => 10,
        'items_per_row' => 4,
		'store_email' => 'prittila.shopping@gmail.com',
		'store_email_password' => 'chun12345',
        'admin_email' => 'orachun.chun@gmail.com',
        'upload_file_delim' => '(][)',
		'grid_item_thumb_width' => 200,
		'grid_item_thumb_height' => 267,
		'thumb_width' => 80,
		'thumb_height' => 80,
		'watermark' => base_url().'images/watermark.png'
    );
    if(empty($key))
    {
        return $___config;
    }
    return $___config[$key];
}


if ( ! function_exists('th_color'))
{
	function th_color($col)
    {
        switch($col)
        {
            case 'red': return 'แดง';
            case 'green': return 'เขียว';
            case 'blue': return 'น้ำเงิน';
            case 'lightblue': return 'ฟ้า';
            case 'black': return 'ดำ';
            case 'white': return 'ขาว';
            case 'yellow': return 'เหลือง';
            case 'brown': return 'น้ำตาล';
            case 'purple': return 'ม่วง';
            case 'orange': return 'ส้ม';
            case 'gray': return 'เทา';
            case 'pink': return 'ชมพู';
        }
    }
}

if(!function_exists('get_upload'))
{
    function get_upload($allowed = array(), $dst_dir = './uploads/', $replace = TRUE)
    {
        if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
            $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
            if(!in_array(strtolower($extension), $allowed)){
                echo '{"status":"error"}';
            }

            if(move_uploaded_file($_FILES['upl']['tmp_name'], $dst_dir.$_FILES['upl']['name'])){
                echo '{"status":"success"}';
            }
        }
        echo '{"status":"error"}';
    }
}


if(!function_exists('to_flat_array'))
{
    function to_flat_array($array, $key)
    {
        $res = array();
        foreach($array as $a)
        {
            $res[] = $a[$key];
        }
        return $res;
    }
}



if(!function_exists('list_file_path')) {
    function list_product_img($dir)
    {
        $files = scandir(___config('base_path').$dir);
        unset($files[0]);
        unset($files[1]);
        $files = array_values($files);
        $res = array();
        for($i=0;$i<count($files);$i++)
        {
            $res[] = base_url().$dir.$files[$i];
        }
        return $res;
    }
}


function thai_date($strDate)
{
    $time = strtotime($strDate);
    $strYear = date("Y",$time)+543;
    $strMonth= date("n",$time);
    $strDay= date("j",$time);
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}

function thai_datetime($strDateTime, $delim = ' ')
{
    $time = strtotime($strDateTime);
    $strYear = date("Y",$time)+543;
    $strMonth= date("n",$time);
    $strDay= date("j",$time);
    $strHour= date("H",$time);
    $strMinute= date("i",$time);
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear$delim$strHour:$strMinute น.";
}

function download($url, $localFile) {
	try {
		$data = file_get_contents($url);
		$handle = fopen($localFile, "w");
		fwrite($handle, $data);
		fclose($handle);
		return true;	
	} catch (Exception $e) {
        echo $e->getMessage();
        return false;
	}
}

function is_expired($expired_date)
{
    return ((time()-(60*60*24)) >= strtotime($expired_date));
}

function order_status($status)
{
    switch($status)
    {
        case 'W': return 'รอแจ้งชำระเงิน';
        case 'P': return 'แจ้งชำระเงินแล้ว รอตรวจสอบ';
        case 'C': return 'ตรวจสอบการชำระเงินแล้ว รอจัดส่งสินค้า';
        case 'D': return 'จัดส่งสินค้าเรียบร้อย';
    }
}

function contact_info($newline = false)
{
	?>
	<img class="icon" src="<?php echo base_url(); ?>images/icons/mobile.png"/>: 0123456789
	<?php if($newline) echo '<br/>';?>
	<img class="icon" src="<?php echo base_url(); ?>images/icons/email.png"/>: <?php echo ___config('store_email'); ?>
	<?php if($newline) echo '<br/>';?>
	<img class="icon" src="<?php echo base_url(); ?>images/icons/line.png"/>: ___aaa        
	<div>
		<a href="https://www.facebook.com/prittila" target="_TOP" title="Prittila Fan Page"><img src="https://badge.facebook.com/badge/216408685185780.329.1577858336.png" style="border: 0px;" /></a>
	</div>
	<?php
}

