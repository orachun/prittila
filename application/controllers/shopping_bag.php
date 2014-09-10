<?php

class Shopping_bag extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		//load model
		$this->load->library('cart');
        $this->load->model('User_model');
	}
    
    public function checkout()
    {
        $data = array();
        $data['member'] = $this->User_model->is_logged_in();
        if($data['member'])
        {
            $data['receiver_info'] = array(
                'name' => $this->User_model->current('fullname'),
                'addr' => $this->User_model->current('addr'),
                'tel' => $this->User_model->current('tel'),
                'email' => $this->User_model->current('email'),
            );
        }
        else
        {
            $data['receiver_info'] = array(
                'name' => '',
                'addr' => '',
                'tel' => '',
                'email' => '',
            );
        }
        
        $data['item_count'] = $this->_total_items();
        $query = $this->db->get_where('delivery_type', array('is_discarded'=>'N', 'name' => 'EMS'));
        if ($query->num_rows() > 0)
        {
           $row = $query->row(); 
           $data['deliver_name'] = $row->name.' '.number_format($row->unit_cost, 0).' บาท สั่งซื้อ '.
                   $row->free_threshold . ' ชิ้นขึ้นไปส่งฟรี';
           $data['delivering_cost'] = $data['item_count'] > $row->free_threshold ?
                   0 : $row->unit_cost;
           $data['deliver_id'] = $row->delivery_type_id;
        }
        
        $data['subtotal'] = $this->cart->total();
        $data['total'] = $data['subtotal']+$data['delivering_cost'];
        $this->load->view('shopping_bag/checkout', $data);
    }
    
	public function add()
	{
		$data = array(
			'id'      => $this->input->post("pid").  random_string(),
			'qty'     => $this->input->post("qty"),
			'price'   => $this->input->post("price"),
			'name'    => $this->input->post("pid"),
			'options' => array(
                'name' => $this->input->post("name"),
				'size' => $this->input->post("size"), 
				'color' => $this->input->post("color"),
                'pid'   => $this->input->post("pid"),
			)
        );
		$this->cart->insert($data);
	}
	
	public function update_qty($rowid, $qty, $size = NULL, $color = NULL)
	{
		$data = array(
           'rowid' => $rowid,
           'qty'   => $qty
        );
        if(!empty($size))
        {
            $data['options']['size'] = $size;
        }
        if(!empty($color))
        {
            $data['options']['color'] = $color;
        }
		$this->cart->update($data); 
	}
	
	public function remove($rowid)
	{
		$data = array(
           'rowid' => $rowid,
           'qty'   => 0
        );
		$this->cart->update($data); 
	}
	
	public function submit()
	{
		$this->cart->destroy();
	}
	
	public function modal_content()
	{
        $response = array(
            'body' => $this->load->view('shopping_bag/summary', array(), true),
            'total' => number_format($this->cart->total(),2),
        );
		echo json_encode($response);
	}
    
    public function order_count()
    {
        echo count($this->cart->contents());
    }
    
    public function ordered_items($editable = 'editable', $return = false)
    {
        $data['editable'] = ($editable == 'editable');
        $this->load->library('table');
        $tmpl = array (
            'table_open'          => '<table class="item-list" border="0" cellpadding="4" cellspacing="0">',
            'heading_row_start'   => '<tr class="header-row">',
            'heading_row_end'     => '</tr>',
            'heading_cell_start'  => '<th>',
            'heading_cell_end'    => '</th>',

            'row_start'           => '<tr class="odd">',
            'row_end'             => '</tr>',
            'cell_start'          => '<td>',
            'cell_end'            => '</td>',

            'row_alt_start'       => '<tr class="even">',
            'row_alt_end'         => '</tr>',
            'cell_alt_start'      => '<td>',
            'cell_alt_end'        => '</td>',

            'table_close'         => '</table>'
            );
        $this->table->set_template($tmpl);
        $head = array('&nbsp;', 'ชื่อสินค้า', 'ขนาด', 'สี', 'จำนวน', 'ราคาต่อชิ้น', 'รวม', 'ลบรายการ');
        if(!$data['editable'])
        {
            unset($head[7]);
            unset($head[8]);
        }
        $this->table->set_heading($head);
        
        $total_items = 0;
        foreach ($this->cart->contents() as $items)
        {
            $options = $this->cart->product_options($items['rowid']);
            $row = array(
                img(array(
                    'src' => $options['thumb'],
                    'width' => '70',
                    )), 
                $options['name'], 
                $options['size'], 
                th_color($options['color']), 
                '<input class="qty" type="text" value="'.$items['qty'].'" rowid="'.$items['rowid'].'" readonly="readonly"/>'.
                ' <span class="button change-qty-btn ui-corner-all" rowid="'.$items['rowid'].'">แก้ไข</span>',
                '<span class="unit-price">'.number_format($items['price'], 2).'</span> บาท',
                '<span class="sub-total">'.number_format($items['qty']*$items['price'], 2).'</span> บาท',
                //'<span class="ui-corner-all button edit-btn" rowid="'.$items['rowid'].'">แก้ไขจำนวน</span> 
                '<span class="ui-corner-all button del-btn" rowid="'.$items['rowid'].'">ลบ</span>'
            );
            if(!$data['editable'])
            {
                $row[4] = $items['qty'];
                unset($row[7]);
                unset($row[8]);
            }
            $this->table->add_row($row);
            $total_items += $items['qty'];
        }
        $table = $this->table->generate();
        $data['item_count'] = $total_items;
        $data['table'] = $table;
        return $this->load->view('shopping_bag/ordered_items', $data, $return);
    }
    
    public function coupon_deliver($return = false)
    {
        $data['is_logged_in'] = $this->User_model->is_logged_in();
        if($data['is_logged_in'] === FALSE)
        {
            $data['coupons'] = NULL;
        }
        else
        {
            $data['coupons'] = $this->User_model->get_coupon();
            foreach($data['coupons'] as $i=>$d)
            {
                $discount = 0;
                if($this->cart->total() > $d['amount_threshold'])
                {
                    if($d['discount_type'] == 'P')
                    {
                        $discount = $this->cart->total()*$d['amount'];
                    }
                    else
                    {
                        $discount = $d['amount'];
                    }
                }
                $data['coupons'][$i]['expired_date'] = thai_date($d['expired_date']);
                $data['coupons'][$i]['discount'] = $discount;
                $data['coupons'][$i]['amount_remain'] = $this->cart->total()-$discount;;
            }
        }
        $data['item_count'] = $this->_total_items();
        
        $data['delivering'] = $this->db->get_where('delivery_type', array('is_discarded'=>'N'))->result_array();
        
        foreach($data['delivering'] as $key=>$d)
        {
            if($data['item_count'] >= $d['free_threshold'])
            {
                $data['delivering'][$key]['cost'] = 0;
            }
            else
            {
                $data['delivering'][$key]['cost'] = $d['unit_cost']*$data['item_count'];
            }
        }
        return $this->load->view('shopping_bag/coupon_deliver', $data, $return);
    }
    
    public function receiver_info($return = false)
    {
        $data['is_logged_in'] = $this->User_model->is_logged_in();
        if($this->User_model->is_logged_in())
        {
            $data['receiver_info'] = array(
                'name' => $this->User_model->current('fullname'),
                'addr' => $this->User_model->current('addr'),
                'tel' => $this->User_model->current('tel'),
                'email' => $this->User_model->current('email'),
            );
        }
        else
        {
            $data['receiver_info'] = array(
                'name' => '',
                'addr' => '',
                'tel' => '',
                'email' => '',
            );
        }
        return $this->load->view('shopping_bag/receiver_info', $data, $return);
    }
    
    public function order_summary($return = false)
    {
        return $this->load->view('shopping_bag/order_summary', $return);
    }
    
    public function order_review($ajax = '')
    {
        $data['ajax'] = ($ajax == 'ajax');
        $data['ordered_item_tab'] = $this->ordered_items(true, true);
        $data['coupon_deliver_tab'] = $this->coupon_deliver(true);
        $data['receiver_info_tab'] = $this->receiver_info(true);
        if($data['ajax'])
        {
            $this->load->view('shopping_bag/order_review', $data);
        }
        else
        {
            $data['title'] = 'สั่งซื้อสินค้า';
		    $data['_css'] = array(
		        'picachoose/base'
		    );
		    $data['_js'] = array(
		    	'jquery.jcarousel.min',
		    	'jquery.pikachoose.min'
		    );
            $data['contents'] = $this->load->view('shopping_bag/order_review', $data, true);
            $this->load->view('template', $data);
        }
    }
    
    public function order_submit()
    {
        $this->load->model('Others_model');
        $this->load->model('Order_model');
        
		$receiverName = $this->input->post('receiver-name');
		$receiverAddr = $this->input->post('receiver-addr');
		$receiverEmail = $this->input->post('receiver-email');
		$receiverTel = $this->input->post('receiver-tel');
//		$selectedCouponId = $this->input->post('selected_coupon');
		$selectedDeliverId = $this->input->post('deliver-type');
        $promocode = $this->input->post('promocode');
        
        $user_info = array(
            'name' => $receiverName,
            'delivery_addr' => $receiverAddr,
            'addr' => $receiverAddr,
            'tel' => $receiverTel,
            'email' => $receiverEmail,
        );
        if($this->User_model->is_logged_in())
        {
            $user_info['customer_id'] = $this->User_model->current('customer_id');
        }
        else
        {
            $user_info['customer_id'] = $this->User_model->record_customer($user_info);    
        }
        
		$store_order = $this->Others_model->get_current_store_order();
        $store_order_id = $store_order['store_order_id'];
        
        $cart_info = array(
            'items' => array(),
            'sub_total' => $this->cart->total(),
            'total_items' => 0,
        );
        
        foreach($this->cart->contents() as $i)
        {
            $options = $this->cart->product_options($i['rowid']);
            $item = array(
                'product_id' => $options['pid'],
                'amount' => $i['qty'],
                'unit_price' => $i['price'],
                'size' => $options['size'],
                'color' => $options['color'],
            );
            $item['product_id'] = $options['pid'];
            $cart_info['items'][] = $item;
            $cart_info['total_items'] += $i['qty'];
        }
        
        $order_id = $this->Order_model->add_order($user_info, $cart_info, $store_order_id, $selectedDeliverId, -1);
        
        $this->cart->destroy();
        $invoice_url = base_url('index.php/order/display/'.$order_id);
		$order_detail = file_get_contents($invoice_url);
		$header = 'เรียน คุณ '.$receiverName.'<br/><br/>'
				.'ขอบคุณที่สั่งซื้อสิ้นค้าจาก Prittila คุณสามารถดูรายละเอียดได้จากด้านล่างค่ะ <br/><br/>';
		$footer = '<br/><br/>ขอบคุณค่ะ<br/>Prittila<br/>';
		
        //Omit sending email until testing online server
        //$this->Others_model->email($receiverEmail, 'ข้อมูลการสั่งซื้อสินค้า', $header.$order_detail.$footer);
		
		echo $invoice_url;
    }
    
    
    private function _total_items()
    {
        $total_items = 0;
        foreach ($this->cart->contents() as $items)
        {
           $total_items += $items['qty'];
        }
        return $total_items;
    }
    
    public function payment_inform_upload()
    {
        $this->load->helper('general');
        $allowed = array('png', 'jpg', 'gif');
        get_upload($allowed, './uploads/from_user/1/payment_inform/', TRUE);
    }
    public function payment_inform()
    {
        $filename = $this->input->post('filename');
        $order_id = $this->input->post('order-id');
        if(!file_exists('./uploads/from_user/1/payment_inform/'.$filename)) echo 'error';
        echo $filename.$order_id;
    }
}