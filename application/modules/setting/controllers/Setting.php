<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('nav_model');
		$this->load->model('product/product_model');
        $this->load->model('warehouse/warehouse_model');
        $this->load->model('pos/pos_model');  
		$this->load->helper('url');
		$this->load->helper('path');
		$this->load->helper('form');
		$this->load->helper('mainpage_helper');
		$this->load->library('form_validation');
		$this->load->library('ion_auth');
		$this->load->library('ion_auth_acl');
		

		$siteLang = $this->session->userdata('site_lang');
		if ($siteLang) {

			$this->lang->load('main', $siteLang);
			$this->lang->load('ion_auth', $siteLang);
		} else {

			$this->lang->load('main', 'french');
			$this->lang->load('ion_auth', 'french');
		}
    }
    

    public function index()
    {
		$data['user_groups']           =   $this->ion_auth->get_users_groups()->result();
		$data['user_permissions']      =   $this->ion_auth_acl->build_Acl();
		$data['menus']			  	   =   $this->nav_model->get_nav_menus();
		$data['subs']				   =   $data['menus'];
		$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
		$data['title']					=  'Articles';
		$data['products']               = $this->product_model->get_all_products();
		$data['categories']               = $this->product_model->get_categories();
		
        $this->load->view('templates/header', $data);
        $this->load->view('index', $data);
        $this->load->view('templates/footer');    
    }

}

/* End of file Setting.php */

