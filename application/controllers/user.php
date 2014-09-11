<?php

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('User_model');
	}	
    
    public function get()
    {
        if(!$this->User_model->is_logged_in())
        {
            echo json_encode(array(
                'success' => 'false',
                'error' => 'ยังไม่ได้ลงชื่อเข้าสู่ระบบ',
            ));
            return;
        }
        
        $user_info = $this->User_model->get($this->input->cookie('login_cookie'));
        unset($user_info['pass']);
        echo json_encode(array(
            'success' => 'true',
            'user_info' => $user_info
        ));
    }
	
	public function login()
	{
		$email = $this->input->post("email");
		$pass = $this->input->post("pass");
		$remember = ($this->input->post("remember")=='on');
        $result = $this->User_model->login($email, $pass, $remember);
		if($result !== FALSE)
        {
            $user_info = $this->User_model->get($result);
            unset($user_info['pass']);
            echo json_encode(array(
                'success' => 'true',
                'user_info' => $user_info
            ));
        }
        else
        {
            
            echo json_encode(array(
                'success' => 'false',
                'error' => 'อีเมล์หรือรหัสผ่านไม่ถูกต้อง กรุณาตรวจสอบอีเมล์และรหัสผ่านค่ะ'
            ));
        }
	}

	public function logout()
	{
		$this->User_model->logout();
	}

	public function register()
	{
        $user_info = array(
            'pass' => $this->input->post('pass'),
            'name' => $this->input->post('fullname'),
            'addr' => trim($this->input->post('addr')),
            'tel' => $this->input->post('tel'),
            'email' => $this->input->post('email'),
        );
		if($this->User_model->register($user_info) !== FALSE)
        {
            echo $this->login();
        }
        else
        {
            echo json_encode(array(
                'success' => 'false',
                'error' =>  'อีเมล์นี้ถูกผู้อื่นใช้แล้วค่ะ'
            ));
        }
	}

    public function user_detail()
    {
        $details = $this->User_model->current();
        unset($details->pass);
        echo json_encode($details);
    }
    
	public function account_info()
	{
		if(!$this->User_model->is_logged_in())
		{
			$this->load->view('user/login');
		}
        else
        {
            $data['fullname'] = $this->User_model->current('fullname');
//            $coupons = $this->User_model->get_coupon();
//            $data['coupons'] = array();
//            foreach($coupons as $c)
//            {
//                $data['coupons'][] = array(
//                    'summary' => $c['name'].': '.$c['desc'].' (หมดอายุ '.thai_date($c['expired_date']).')',
//                    'coupon_left' => $c['remain'],
//                    'icon' => $c['icon'],
//                );
//            }
            $this->load->view('user/account_info', $data);
        }
	}
    
    public function checklogin()
    {
        if($this->User_model->is_logged_in())
        {
            return 'yes';
        }
        else
        {
            return 'no';
        }
    }
    
    public function user_area($tab = NULL, $return = FALSE)
    {
        if($tab == 'general_info')
        {
            $data = $this->User_model->current();
            $this->load->view('user/general_info', $data, $return);
        }
        else if($tab == 'orders')
        {
            $data['orders'] = $this->db->get_where('_customer_order', array(
                    'customer_id'=> $this->User_model->current('customer_id'),
                ))->result_array();
            $this->load->view('user/orders', $data, $return);
        }
    }
    
    public function edit_info()
	{
        $user_info = array(
            'fullname' => $this->input->post('fullname'),
            'addr' => trim($this->input->post('addr')),
            'tel' => $this->input->post('tel'),
        );
		if($this->User_model->edit_info($user_info))
        {
            echo 'ok';
        }
        else
        {
            echo 'ไม่สามารถแก้ไขข้อมูลส่วนตัวได้ กรุณาติดต่อทางร้าน หรือลองใหม่ภายหลังจ้า';
        }
	}
    public function change_pass()
    {
        $old_pass = $this->input->post('old_pass');
        $new_pass = $this->input->post('new_pass');
        if($this->User_model->change_pass($old_pass, $new_pass))
        {
            echo 'ok';
        }
        else
        {
            echo 'ไม่สามารถแก้ไขรหัสผ่านได้ กรุณาตรวจสอบรหัสผ่านเดิม หรือติดต่อทางร้านจ้า';
        }
    }
    
	
}

?>
