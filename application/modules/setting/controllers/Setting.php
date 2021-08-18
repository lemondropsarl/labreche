<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends 	MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('nav_model');
		$this->load->model('product/product_model');
        $this->load->model('warehouse/warehouse_model');
        $this->load->model('pos/pos_model');  
		$this->load->model('setting_model');
		
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
		$data['title']					=  'Paramètres';
		$data['store']					= $this->setting_model->get_store_infos();
		$data['warehouses']				= $this->warehouse_model->get_warehouses();
		$data['pos']					= $this->pos_model->get_pos();
		$data['c_rate']					= $this->setting_model->get_rate(1);

        $this->load->view('templates/header', $data);
        $this->load->view('index', $data);
        $this->load->view('templates/footer');    
    }
	public function create_store()
	{
		
		// get inputs
		$store_name = $this->input->get('store_name');
		$rccm	= $this->input->get('rccm');
		$id_nat	= $this->input->get('id_nat');
		$nif	= $this->input->get('nif');

		if ($this->setting_model->is_store_exist()) {
			$store = $this->setting_model->get_store_infos();
			$store_id = $store['store_id'];

			$this->setting_model->update_store($store_id,$store_name,$id_nat,$rccm, $nif);
		}else {
			# code...
			$model = array(
				'Store_name' => $store_name,
				'rccm'	=> $rccm,
				'id_nat'	=> $id_nat,
				'nif'	=>  $nif 
			);
			
			$this->setting_model->add_store($model);	
		}
			
	}
	public function update_rate()
	{
		$rate = $this->input->post('rate');
		$this->setting_model->update_rate($rate,1);
		
		redirect('setting','refresh');
		
		
	}
	

}

/* End of file Setting.php */

