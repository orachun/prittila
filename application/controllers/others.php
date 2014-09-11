<?php

class Others extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function test()
    {
        $this->load->model('User_model');
        echo json_encode($this->User_model->current());
    }
    
    public function contact_us_form()
    {
		$this->load->model('User_model');
        $data['is_logged_in'] = $this->User_model->is_logged_in();
        $this->load->view('contactus', $data);
    }
    
    public function contact_us_submit()
    { 
		$this->load->model('User_model');
		$this->load->model('Others_model');
		
		$email = $this->User_model->current('email');
		if(empty($email))
		{
			$email = $this->input->post('email');
		}
		$tel = $this->User_model->current('tel');
		if(empty($tel))
		{
			$tel = $this->input->post('tel');
		}
		$name = $this->User_model->current('fullname');
		if(empty($name))
		{
			$name = $this->input->post('name');
		}
		
		$user_info = 'Name: '.$name.'<br/>Email: '.$email.'<br/>Tel: '.$tel.'<br/>Message:<br/><br/>';
		
		$this->Others_model->email(___config('store_email'), 
				'Contact from user', $user_info.nl2br($this->input->post('msg'))
				);
        if($this->email->send())
		{
			echo 'ok';
		}
		else
		{
			echo 'กรุณาลองใหม่ภายหลังค่ะ';
		}
    }
    
    
    function upload()
    {
        $output_dir = ___config('base_path')."uploads/temp/";
 
        if(isset($_FILES["file"]))
        {
            //Filter the file types , if you want.
            if ($_FILES["file"]["error"] > 0)
            {
              echo "Error: " . $_FILES["file"]["error"] . "<br>";
            }
            else
            {
                //move the uploaded file to uploads folder;
                $filename = uniqid().rand(0,9999).rand(0,9999).  ___config('upload_file_delim').$_FILES["file"]["name"];
                move_uploaded_file($_FILES["file"]["tmp_name"],$output_dir. $filename);

             echo $filename;
            }

        }
    }
    
    
}
