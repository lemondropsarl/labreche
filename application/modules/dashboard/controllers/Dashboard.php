<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('migration');
		$this->migration->latest();
		$this->load->model('nav_model');
		$this->load->model('setting/setting_model');
		$this->load->model('pos/pos_model');
		
		
		
		$this->load->library('ion_auth');
		$this->load->library('ion_auth_acl');
		$this->migration->latest();
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}
		$siteLang = $this->session->userdata('site_lang');
        if ($siteLang) {
           $this->lang->load('main','french');
        } else {
           $this->lang->load('main','french');
		}
		

	}
	

	/**
	 * Index Page for this controller.
	 *
	
	 */
	public function index()
	{
		if (!$this->setting_model->is_store_exist()) {
			
			redirect('setting/index');		
		}
		$data['user_groups']           =   $this->ion_auth->get_users_groups()->result();
		$data['user_permissions']      =   $this->ion_auth_acl->build_Acl();
		$data['menus']			  	   =   $this->nav_model->get_nav_menus();
		$data['subs']				   =   $data['menus'];
		$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
		$data['title']					=  lang('dashboard');
		//Get different data
		$data['global_sales_chart']		= $this->global_sales_chart();
		$data['pos_sales_chart']		= $this->pos_sales_chart();
		$data['overview_chart']		= $this->product_overview_chart();
		$this->load->view('templates/header',$data);
		$this->load->view('index',$data);
		$this->load->view('templates/footer');
		
	}
	function product_overview_chart(){
		$record = $this->pos_model->get_product_sold();
		$data = [];
		foreach ($record as $row) {
			$data['label'][] = $row['pname'];
			$data['data'][] = $row['quantity'];
		}
		return json_encode($data);
	}
	function global_sales_chart()
	{
		$record = $this->pos_model->get_global_sales();
		$sales = [];
		foreach ($record as $row) {
			$sales['label'][] = $row['month_name'];
			$sales['data'][] = $row['sales'];
		}
		return json_encode($sales);
	}
	function pos_sales_chart()
	{
		$record = $this->pos_model->get_pos_sales();
		$sales = [];
		foreach ($record as $row) {
			$sales['label'][] = $row['pos'];
			$sales['data'][] = $row['sales'];
		}
		return json_encode($sales);
	}
}
