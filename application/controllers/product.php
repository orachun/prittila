<?php

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
    }

    public function category_options() {
        $cats = $this->Product_model->get_cat();
        foreach ($cats as $c) {
            echo '<option value="' . $c->product_cat_id . '">' . $c->name . '</option>';
        }
    }

    public function search($keyword = 'none') {
        $this->index('-1', 'added_date', 'desc', $keyword, 1);
    }

    public function new_template() {
        $this->load->view('new_template');
    }

    public function index($cat = '-1', $sort = 'product_id', $sort_order = 'desc', $keyword = 'none', $page = 1) {
        $this->load->view('comming');
        
//        $this->load->library('pagination');
//
//        $data['total_products'] = $this->Product_model->total_product($cat, $keyword);
//        $data['products_per_page'] = ___config('items_per_page');
//        $data['total_pages'] = ceil($data['total_products'] / $data['products_per_page']);
//
//        $data['args'] = array(
//            'cat' => $cat,
//            'sort' => $sort,
//            'sort_order' => $sort_order,
//            'keyword' => $keyword,
//            'page' => $page
//        );
//        $data['all_cats'] = $this->Product_model->get_cat();
//        $data['pager'] = '<div class="pager">' . $this->pagination->create_links() . '</div>';
//        $data['title'] = '';
//        $data['best_seller'] = $this->Product_model->best_seller_products();
//        //$data['random_products'] = $this->Product_model->random_products();
//        $data['most_viewed'] = $this->Product_model->most_viewed_products();
//
//        $products = $this->Product_model->list_product($cat, $sort, $sort_order, $keyword, $page);
//        $data['products'] = array();
//
//        foreach ($products as $p) {
//            $data['products'][] = $this->_product_grid_item($p);
//        }
//
//        $data['_js'] = array('product');
//
//        $data['_css'] = array(
//                //'product',
//                //'product_detail'
//        );
//        $data['slideshow'] = $this->_main_slide_show();
//        $data['contents'] = $this->load->view('/product/product_grid', $data, TRUE);
//        $data['custom_contents'] = false;
//        $this->load->view('new_template', $data);
    }

    private function _product_grid_item($product) {
        $data = $product;
        return $this->load->view('product/product_grid_item', $data, TRUE);
    }

    public function detail($pid) {
        $this->load->view('comming');
        
//        $ajax = $this->input->is_ajax_request();
//        $data = $this->Product_model->get_product($pid);
//        $data['ajax'] = $ajax;
//
//        if (!$ajax) {
//            $data['_js'] = array('product');
//            $data['title'] = $data['name'];
//            $data['fullwidth_contents'] = $this->load->view('product/product_detail', $data, TRUE);
//       
//            $this->load->view('new_template', $data);
//        } else {
//            $response = array(
//                'title' => $data['name'],
//                'body' => $this->load->view('product/product_detail', $data, true),
//            );
//            echo json_encode($response);
//        }
//        $this->Product_model->increase_view($pid);
    }

    private function _main_slide_show() {
        $data['slides'] = $this->db->get('slideshow')->result_array();
        return $this->load->view('/template_includes/slide_show', $data, TRUE);
    }

}
