<?php

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Product_model');
		$this->load->model('Others_model');
		$this->load->helper('facebook');
	}

	public function main()
	{
		$this->load->view('admin/main');
	}

	public function category()
	{
		$data = array();
		$data['cats'] = $this->Product_model->get_cat();
		$this->load->view('admin/category', $data);
	}

	public function category_add()
	{
		$this->Product_model->add_cat($this->input->post('name'));
	}

	public function category_del($name)
	{
		$this->Product_model->del_cat($name);
	}

	public function supplier()
	{
		$data = array();
		$data['suppliers'] = $this->Product_model->get_supplier();
		$this->load->view('admin/supplier', $data);
	}

	public function supplier_add()
	{
		$this->Product_model->add_supplier($this->input->post('name'), $this->input->post('url'), $this->input->post('note'));
	}

	public function supplier_del()
	{
		$this->Product_model->del_supplier($this->input->post('sid'));
	}

	public function add_product_form()
	{
		$data = array();
		$data['suppliers'] = $this->Product_model->get_supplier();
		$data['cats'] = $this->Product_model->get_cat();
		$data['colors'] = $this->Others_model->color();
		$this->load->view('admin/add_product', $data);
	}

	public function add_product_submit()
	{
		$p = array(
			'name' => $this->input->post('name'),
			'desc' => $this->input->post('desc'),
			'cat_id' => $this->input->post('cat_id'),
			'cost' => $this->input->post('cost'),
			'unit_price' => $this->input->post('unit_price'),
			'supplier_id' => $this->input->post('supplier_id'),
			'supplier_product_url' => $this->input->post('supplier_product_url'),
			'imgs' => $this->input->post('imgs'),
		);
		$p['color'] = explode("\n", $this->input->post('color'));
		$p['size'] = explode(';', $this->input->post('size'));
		$result = $this->Product_model->add_product($p, $this->input->post('fb_desc'));
                echo json_encode($result);
	}

	public function store_order()
	{
		$data = array();
		$data['orders'] = $this->Others_model->get_store_order();
		$this->load->view('admin/store_order', $data);
	}

	public function add_store_order()
	{
		$this->Others_model->add_store_order($this->input->post('date'));
	}

	public function del_store_order()
	{
		$this->Others_model->del_store_order($this->input->post('sid'));
	}

	public function delivering()
	{
		$data['deliverings'] = $this->db->get('delivery_type')->result();
		$this->load->view('admin/delivering.php', $data);
	}

	public function add_delivery()
	{
		$this->db->insert('delivery_type', array(
			'name' => $this->input->post('name'),
			'unit_cost' => $this->input->post('unit_cost'),
			'free_threshold' => $this->input->post('free_threshold'),
			'is_discarded' => 'N',
		));
	}

	public function discard_delivery()
	{
		$this->db->where('delivery_type_id', $this->input->post('id'));
		$this->db->update('delivery_type', array('is_discarded' => 'Y'));
	}

	public function payment_checking()
	{
		$data['orders'] = $this->db->get('customer_order')->result_array();
		foreach ($data['orders'] as $i => $o)
		{
			if ($o['status'] == 'P' || $o['status'] == 'C' || $o['status'] == 'D')
			{
				$payment_inform = $this->db->get_where('payment_inform', 
                        array('order_id' => $data['orders'][$i]['order_id']))->result_array();
				$data['orders'][$i]['payment'] = $payment_inform[0];
                $slip = 'uploads/payment_slips/'.$data['orders'][$i]['order_id'].'.jpg';
                if(file_exists(___config('base_path').$slip))
                {
                    $data['orders'][$i]['payment']['slip'] = base_url($slip);
                }
                else
                {
                    $data['orders'][$i]['payment']['slip'] = FALSE;
                }
			}
		}
		$this->load->view('admin/payment_checking', $data);
	}

	public function order_detail($oid)
	{
		$this->load->model('Order_model');
		$data['order'] = $this->Order_model->get_order($oid);
		$this->load->view('admin/order_detail', $data);
	}

	public function order_set_checked()
	{
		$this->db->where('order_id', $this->input->post('order_id'));
		$this->db->update('customer_order', array('status' => 'C'));
	}

	public function order_set_delivered()
	{
		$this->db->where('order_id', $this->input->post('order_id'));
		$this->db->update('customer_order', array('status' => 'D',
			'tracking_no' => $this->input->post('tracking_no'),
			'delivered_date' => $this->input->post('delivered_date')
		));
	}

	public function slideshow()
	{
		$data['slides'] = $this->db->get('slideshow')->result_array();
		$this->load->view('admin/slide_show', $data);
	}

	public function add_slideshow()
	{
		$img = ___config('base_path') . 'uploads/slides/' . $this->input->post('img-name');
		copy(___config('base_path') . 'uploads/temp/' . $this->input->post('img-name'), $img);
		unlink(___config('base_path') . 'uploads/temp/' . $this->input->post('img-name'));
		$this->db->insert('slideshow', array(
			'img' => 'uploads/slides/' . $this->input->post('img-name'),
			'link' => $this->input->post('link'),
		));
	}

	public function del_slideshow()
	{
		$this->db->delete('slideshow', array('slide_id' => $this->input->post('slide-id')));
	}

	public function page()
	{
		$data['pages'] = $this->db->get('page')->result_array();
		$this->load->view('admin/page.php', $data);
	}

	public function add_page()
	{
		$this->db->insert('page', array(
			'name' => $this->input->post('name'),
			'link_name' => $this->input->post('link_name'),
			'content' => $this->input->post('content'),
			'edited_datetime' => date('Y-m-d t:i:s'),
		));
	}

	public function edit_page()
	{
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('page', array(
			'name' => $this->input->post('name'),
			'link_name' => $this->input->post('link_name'),
			'content' => $this->input->post('content'),
			'edited_datetime' => date('Y-m-d t:i:s'),
		));
	}

	public function del_page()
	{
		$this->db->delete('page', array('id' => $this->input->post('id')));
	}

	public function coupon_list()
	{
		$this->load->model('Coupon_model');
		$data['coupons'] = $this->Coupon_model->get();
		$this->load->view('admin/coupon.php', $data);
	}

	public function add_coupon()
	{
		$this->load->model('Coupon_model');
		$this->Coupon_model->add(
				$this->input->post('name'), $this->input->post('desc'), $this->input->post('discount_type'), $this->input->post('amount'), $this->input->post('amount_threshold'), $this->input->post('valid_day')
		);
	}

	public function set_coupon_status()
	{
		$this->load->model('Coupon_model');
		$this->Coupon_model->setStatus(
				$this->input->post('coupon_id'), $this->input->post('status')
		);
	}

	public function give_coupon()
	{
		$this->load->model('Coupon_model');
		$this->Coupon_model->give(
				$this->input->post('coupon_id'), $this->input->post('customer_id'), $this->input->post('amount')
		);
	}

	public function customer()
	{
		$data['customers'] = $this->User_model->get();
		$this->load->view('admin/customer', $data);
	}

	public function store_order_products()
	{
		$this->load->model('Order_model');
		$data['products'] = $this->Order_model->get_unordered_store_products();

		$this->load->view('admin/store_order_products', $data);
	}

	public function products()
	{
		$data['products'] = $this->Product_model->get_admin_products();
		$this->load->view('admin/products', $data);
	}
        
	
	public function set_product_status()
	{
		$pid = $this->input->post('pid');
		$status = $this->input->post('status');
		$this->db->query('update product set status="'.$status.'" where product_id="'.$pid.'"');
	}

    
    public function promocodes()
    {
        //TODO: implement this
/        $data['products'] = $this->Product_model->get_admin_products();
//		$this->load->view('admin/products', $data);
    }
}
