<?php

class Image_manip extends CI_Controller
{
	public function index()
	{
		$this->load->helper('image');
		image_thumb('http://img01.taobaocdn.com/imgextra/i1/1031225730/T2Yg7TXltXXXXXXXXX_!!1031225730.jpg', NULL, FALSE);
	}
}
		
?>
