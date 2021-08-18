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
		$data['user_groups']           =   $this->ion_auth->get_users_groups()->result();
		$data['user_permissions']      =   $this->ion_auth_acl->build_Acl();
		$data['menus']			  	   =   $this->nav_model->get_nav_menus();
		$data['subs']				   =   $data['menus'];
		$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
		$data['title']					=  lang('dashboard');
		//Get different data
		
				
		$this->load->view('templates/header',$data);
		$this->load->view('index',$data);
		$this->load->view('templates/footer');
		
	}
}
