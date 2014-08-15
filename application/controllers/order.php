<?php

class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function display($order_id, $return = false)
    {
        $data = array();
        $data['ajax'] = $this->input->is_ajax_request()?true:false;
		$data['order_id'] = $order_id;
        $this->load->helper('color');
        $total_items = 0;
        
        ///load ordered items into this array
        $order_items = $this->db->get_where('_customer_ordered_item', 
                array('order_id' => $order_id))->result_array();
        
        $total_before_discount = 0;
        foreach ($order_items as $item)
        {
            $total_items += $item['amount'];
            $total_before_discount += $item['amount']*$item['unit_price'];
        }
        
        $data['order_items'] = $order_items;
        $data['total_before_discount'] = $total_before_discount;
        $data['item_count'] = $total_items;
        $data += $this->db->get_where('customer_order', array('order_id'=>$order_id))->row_array();
        
        $customer = $this->db->get_where('customer', array('customer_id'=>$data['customer_id']))->row_array();
        $data['tel'] = $customer['tel'];
        $data['email'] = $customer['email'];
        $data['delivering'] = $this->db->get_where('delivery_type', 
                array('delivery_type_id'=>$data['delivery_type']))->row_array();
        if($data['delivering']['free_threshold'] <=$total_items)
        {
            $data['delivering']['cost'] = 0;
        }
        else
        {
            $data['delivering']['cost'] = $data['delivering']['unit_cost']*$total_items;
        }
        return $this->load->view('order_display', $data, $return);
    }
    
    
    public function payment_inform()
    {
        $datetime = explode(' ', $this->input->post('paydatetime'));
        $dates = explode('/', $datetime[0]);
        $times = explode(':', $datetime[1]);
        
        $time = mktime(
                $times[0], 
                $times[1], 
                0, 
                $dates[1], 
                $dates[0], 
                $dates[2]-543
        );
        if($time > time())
        {
            echo 'กรุณาตรวจสอบวันที่ชำระเงินจ้า';
            return;
        }
        $query = $this->db->get_where('customer_order', array('display_id' => $this->input->post('order-id')));
        if($query->num_rows() == 0)
        {
            echo 'ไม่พบหมายเลขคำสั่งซื้อสินค้า '.$this->input->post('order-id').' กรุณาตรวจสอบหมายเลขคำสั่งซื้อสินค้าค่ะ';
            return;
        }
        $order = $query->row();
        if($order->status != 'W' && $order->status != 'P')
        {
            echo 'คำสั่งซื้อสินค้านี้ ไม่ได้อยู่ในสถานะรอชำระเงินจ้า';
            return;
        }
		
		$this->db->delete('payment_inform', array('order_id' => $order->order_id));
		
        $this->db->insert('payment_inform', array(
            'order_id' => $order->order_id,
            'amount' => $this->input->post('amount'),
            'inform_date' => date('Y-m-d H:i:s'),
            'paid_date' => date('Y-m-d H:i:s', $time),
        ));
        
        if($order->status == 'W')
        {
            $this->db->where('order_id', $order->order_id);
            $this->db->update('customer_order', array('status' => 'P'));
        }
        $file = $this->input->post('slip');
        if(!empty($file))
        {
            copy(___config('base_path').'uploads/temp/'.$file, ___config('base_path').'uploads/payment_slips/'.$order->order_id.'.jpg');
            unlink(___config('base_path').'uploads/temp/'.$file);
        }
        
        echo 'ok';
    }
}

