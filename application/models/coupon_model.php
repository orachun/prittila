<?php

class Coupon_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
	public function get($coupon_id=null)
	{
		if($coupon_id == null)
		{
			return $this->db->get('discount_coupon')->result_array();
		}
		$res = $this->db->get_where('discount_coupon', array('coupon_id' => $coupon_id))->result_array();
		if(count($res) > 0)
		{
			return $res[0];
		}
		return null;
	}
	
	public function add($name, $desc, $type, $amount, $threshold, $valid_days)
	{
		$this->db->insert('discount_coupon', array(
			'name' => $name,
			'desc' => $desc,
			'discount_type' => $type,
			'amount' => $amount,
			'amount_threshold', $threshold,
			'valid_day' => $valid_days,
			'status' => 'A'
		));
	}
	
	public function setStatus($coupon_id, $status)
	{
		$this->db->where('coupon_id', $coupon_id);
		$this->db->update('discount_coupon', array('status' => $status));
	}
	
	public function give($coupon_id, $customer_id, $amount)
	{
		$coupon = $this->get($coupon_id);
		$exp_date = date("Y-m-d", time()+mktime(0, 0, 0, 0, $coupon['valid_day']));
		$this->db->insert('customer_coupon', array(
			'customer_id' => $customer_id,
			'coupon_id' => $coupon_id,
			'received_amount' => $amount,
			'received_date' => date('Y-m-d'),
			'expired_date' => $exp_date,
		));
	}
}