<?php

class Others_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_current_store_order()
    {
		$this->db->order_by('close_date', 'asc');
		$this->db->where(array('close_date >' => date('Y-m-d')));
		$this->db->limit(1,0);
		$orders = $this->db->get('store_order')->result_array();
		if(count($orders) == 0)
		{
			$orders = array(array('close_date'=>'2099-12-31'));
		}
		$orders[0]['status'] = 'Open';
		return $orders[0];
    }
    
	private function get_store_order_status($close_date, $current = null)
	{
		$current = $current == null ? $this->get_current_store_order() : $current;
		if($current['close_date'] == $close_date)
		{
			return 'Open';
		}
		if(strtotime($current['close_date']) < strtotime($close_date))
		{
			return 'Future';
		}
		else
		{
			return 'Closed';
		}
	}
	
    public function get_store_order()
    {
        $this->db->from('store_order');
		$this->db->order_by('close_date', 'desc');
		$orders = $this->db->get()->result_array();
		$current = $this->get_current_store_order();
		foreach($orders as $i=>$o)
		{
			$orders[$i]['status'] = $this->get_store_order_status($o['close_date'], $current);
		}
		return $orders;
    }
    public function add_store_order($close_date)
    {
        $this->db->insert('store_order', array('close_date' => $close_date));
    }
    public function del_store_order($id)
    {
        $this->db->delete('store_order', array('store_order_id' => $id)); 
    }
    
    
    public function color($color_en = NULL)
    {
        static $colors = NULL;
        if(empty($colors))
        {
            $results = $this->db->get('color')->result_array();
            $colors = array();
            foreach($results as $r)
            {
                $colors[$r['color_en']] = $r['color_th'];
            }
        }
        if(empty($color_en))
        {
            return $colors;
        }
        return $colors[$color_en];
    }
    
	
	public function email($to, $subject, $message)
	{
		$this->load->library('email');
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = ___config('store_email');
        $config['smtp_pass']    = ___config('store_email_password');
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not      

		$from = ___config('store_email');
		$from_name = 'Prittila';
        $this->email->initialize($config);

        $this->email->from($from, $from_name);
        $this->email->to($to); 
        $this->email->subject($subject);
        $this->email->message($message);  
		
        return $this->email->send();
	}
}