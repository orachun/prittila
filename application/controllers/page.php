<?php

class Page extends CI_Controller
{
    public function content($linkname)
    {
        $this->load->model('Others_model');
        $data['page'] = $this->db->get_where('page', array('link_name' => $linkname))->row_array();
        if (empty($data['page'])) 
        {
            show_404();
        }
        $data['contents'] = $this->load->view('page', $data, true);
        echo $data['contents'];
    }
}

?>