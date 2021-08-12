<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pos extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();

        $this->load->model('nav_model');
		$this->load->model('product/product_model');
        $this->load->model('warehouse/warehouse_model');
        $this->load->model('pos_model');
        
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
        //Do your magic here
    }
    

    public function invoicing()
    {
        $this->load->view('invoicing',FALSE);
        
    }
    public function check()
    {
        $pos_id = 1;//find a way to get the warehouse_id
        # code...
        $data['user_groups']           =   $this->ion_auth->get_users_groups()->result();
		$data['user_permissions']      =   $this->ion_auth_acl->build_Acl();
		$data['menus']			  	   =   $this->nav_model->get_nav_menus();
		$data['subs']				   =   $data['menus'];
		$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
		$data['title']					=  'Point de vente';
		$data['pos']             		= $this->pos_model->get_pos();
        $data['list_stock']           = $this->pos_model->get_list_stock_by_wsID($pos_id);
		$data['value_stock_cdf'] 	= $this->pos_model->get_value_stock_cdf($pos_id);
		$data['value_stock_usd'] 	= $this->pos_model->get_value_stock_usd($pos_id);

		//$data['count_p_moteur']			= $this->product_model->count_by_engine();
		# code...
		$this->load->view('templates/header', $data);
		$this->load->view('browse_pos', $data);
		$this->load->view('templates/footer');
    }
	public function create_invoice()
	{
		# code...
	}
	

}

/* End of file Pos.php */
