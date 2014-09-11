<?php

class Order_model extends CI_Model
{
    function cal_net_total($user_info, $cart_info, $deliver_info, $coupon_info)
    {
        $sub_total = $cart_info['sub_total'];
        $total_items = $cart_info['total_items'];
        $total_after_discount  = $sub_total;
        if($coupon_info['coupon_id'] != -1 
                && $this->is_coupon_usable_by_user($coupon_info['coupon_id'], $user_info['customer_id']) 
                && $sub_total >= $coupon_info['amount_threshold'])
        {
            $discount = 0;
            if($coupon_info['discount_type'] == 'F')
            {
                $discount = $coupon_info['amount'];
            }
            else
            {
                $discount = $sub_total * $coupon_info['amount'];
            }
            $total_after_discount = $sub_total - $discount;
        }
        $deliver_cost = 0;
        if($total_items < $deliver_info['free_threshold'])
        {
            $deliver_cost = $total_items * $deliver_info['unit_cost'];
        }
        return $total_after_discount + $deliver_cost;
    }
    
    function is_coupon_usable_by_user($customer_coupon_id, $customer_id)
    {
        $query = $this->db->get_where('_coupon_usage', array(
            'customer_coupon_id' => $customer_coupon_id,
            'customer_id' => $customer_id,)
        );
        return $query->row()->remain > 0;
    }
    
    function add_order($user_info, $cart_info, $store_order_id, $deliver_id, $customer_coupon_id)
    {
        $deliver_info = $this->db->get_where('delivery_type', 
				array('delivery_type_id' => $deliver_id))
				->row_array();
        if($customer_coupon_id == -1)
        {
            $coupon_info['coupon_id'] = -1;
        }
        else
        {
            $query = $this->db->get_where('_customer_coupon_info', 
                    array(
                        'customer_coupon_id' => $customer_coupon_id,
                        'customer_id' => $user_info['customer_id'],
                        )
                    );
            if($query->num_rows() == 0)
            {
                $coupon_info['coupon_id'] = -1;
                $customer_coupon_id = -1;
            }
            else
            {
                $coupon_info = $query->row_array();
            }
        }
        
        $this->db->insert('customer_order', array(
            'customer_id' => $user_info['customer_id'], 
            'store_order_id' => $store_order_id,
            'customer_coupon_id' => $customer_coupon_id,
            'net_total' => $this->cal_net_total($user_info, $cart_info, $deliver_info, $coupon_info),
            'receiver_name' => $user_info['name'],
            'delivery_addr' => $user_info['delivery_addr'],
            'ordered_datetime' => date('Y-m-d H:i:s'),
            'delivery_type' => $deliver_info['delivery_type_id'],
            'status' => 'W',
        ));
        $order_id = $this->db->insert_id();
        
        $this->db->where('order_id', $order_id);
        $this->db->update('customer_order', array('display_id' => 'D'.date('md'). sprintf('-%d-%d', $order_id, $user_info['customer_id']))); 
        
        foreach($cart_info['items'] as $i)
        {
            $this->db->insert('order_item', array(
                'order_id' => $order_id, 
                'product_id' => $i['product_id'],
                'size' => $i['size'],
                'color' => $i['color'],
                'amount' => $i['amount'],
                'unit_price' => $i['unit_price'],
            ));
        }
        
        download(base_url().'index.php/order/display/'.$order_id, ___config('base_path').'uploads/orders/'.$order_id.'.html');
        
        return $order_id;
    }
	
	
	public function get_unordered_store_products()
	{
		return $this->db->get('_unordered_store_product')->result_array();
	}
	
	public function get_order($oid)
	{
		$orders = $this->db->get_where('customer_order', array('order_id'=>$oid))->result_array();
		if(count($orders) == 0)
		{
			return null;
		}
		$order = $orders[0];
		$order['items'] = $this->db->get_where('order_item', array('order_id'=>$oid))->result_array();
		return $order;
	}
    
    public function inform_payment($info)
    {
        
    }
}