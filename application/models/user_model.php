<?php

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
		$this->load->helper('cookie');
    }
    
    public function current($field = NULL)
    {
		$uid = get_cookie('login_cookie');
		if(!empty($uid))
		{
			$query = $this->db->get_where('customer', array('customer_id' => $uid));
			if($query->num_rows()>0)
			{
				$user_info = $query->row();
			}
		}
		if(empty($user_info))
		{
			return null;
		}
        if(empty($field))
        {
            return $user_info;
        }
        else
        {
            return $user_info->$field;
        }
    }
    
    public function login($email, $pass, $remember)
    {
        $query = $this->db->get_where('customer', array('email' => $email, 'pass' => $pass));
        if ($query->num_rows() > 0)
        {
			$user_info = $query->row();
			$cookie = array(
				'name'   => 'login_cookie',
				'value'  => $user_info->customer_id,
				'secure' => FALSE,
				'expire' => 0,
			);
			if($remember)
			{
				$cookie['expire'] = mktime(0, 0, 0, 0, 0, 10);
			}
			$this->input->set_cookie($cookie);
			
            return TRUE;
        }
		else
        {
            return FALSE;
        }
    }
    
    public function logout()
    {
		delete_cookie('login_cookie');
    }
    
    public function register($user_info)
    {
		$pass = $user_info["pass"];
		$fullname = $user_info["name"];
		$addr = $user_info["addr"];
		$tel = $user_info["tel"];
		$email = $user_info["email"];
        
        if(!$this->email_exists($email))
        {
            $data = array(
                'fullname' => $fullname,
                'addr' => $addr,
                'tel' => $tel,
                'email' => $email,
                'registered_date' => date('Y-m-d'),
                'pass' => $pass,
             );
            $this->db->insert('customer', $data); 
            $this->session->set_userdata('IS_LOGGED_IN', FALSE);
            return $this->db->insert_id();
        }
        else
        {
            return FALSE;
        }
    }
    
    
    /**
     * Record guest customer information
     * @param type $user_info
     * @return type
     */
    public function record_customer($user_info)
    {
        $fullname = $user_info["name"];
		$addr = $user_info["addr"];
		$tel = $user_info["tel"];
		$email = $user_info["email"];
        
        $data = array(
            'fullname' => $fullname,
            'addr' => $addr,
            'tel' => $tel,
            'email' => $email,
            'registered_date' => date('Y-m-d')
         );
        $this->db->insert('customer', $data); 
        return $this->db->insert_id();
    }
    
    public function email_exists($email)
    {
        $query = $this->db->get_where('customer', array('email' => $email));
        return $query->num_rows() > 0;
    }
    
    public function is_logged_in()
    {
		return $this->current() != null;
    }
    
    public function is_admin()
    {
        if($this->is_logged_in() && $this->current('email') == ___config('admin_email'))
        {
            return true;
        }
        return false;
    }
    
    public function get_coupon($cid = NULL, $only_valid_coupon = TRUE)
    {
        if($cid == NULL)
        {
            $cid = $this->current('customer_id');
        }
        
        $query = $this->db->get_where('_customer_coupon_display', array('customer_id' => $cid));
        
		$coupon = $query->result_array();
		$count = count($coupon);
		for($i=0;$i<$count;$i++)
		{
			if($only_valid_coupon && 
					($coupon[$i]['remain'] == 0 || is_expired($coupon[$i]['expired_date'])))
			{
				unset($coupon[$i]);
				continue;
			}
			else
			{
				$coupon[$i]['icon'] = base_url().'images/discount_icons/'.$coupon[$i]['amount'].'.png';
			}
		}
		$coupon = array_values($coupon);
        
        return $coupon;
    }
    
    public function edit_info($user_info)
    {
        $this->db->where('customer_id', $this->current('customer_id'));
        $this->db->update('customer', $user_info);
        return (!$this->db->_error_message()); 
    }
    
    public function change_pass($old, $new)
    {
        $cus_id = $this->current('customer_id');
        $query = $this->db->get_where('customer', array('customer_id' => $cus_id, 'pass' => $old));
        if ($query->num_rows() == 0)
        {
            return FALSE;
        }
        
        $this->db->where('customer_id', $cus_id);
        $this->db->where('pass', $old);
        $this->db->update('customer', array('pass' => $new));
        return (!$this->db->_error_message()); 
    }

    public function get($customer_id = null)
	{
		if($customer_id == null)
		{
			return $this->db->get('customer')->result_array();
		}
		$res = $this->db->get_where('customer', array('customer_id' => $customer_id))->result_array();
		if(count($res)>0)
		{
			return $res[0];
		}
		return null;
	}
}
