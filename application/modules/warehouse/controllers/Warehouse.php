<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Warehouse extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('nav_model');
		$this->load->model('product/product_model');
		$this->load->model('warehouse_model');
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
	public function entry_in()
	{
		$data['menus']			  	   =   $this->nav_model->get_nav_menus();
		$data['subs']				   =   $data['menus'];
		$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
		$data['products']		   =   $this->warehouse_model->get_products();
		$data['zones']				= $this->warehouse_model->get_zones();
		$data['shelfs']				= $this->warehouse_model->get_shelfs();
		$data['title']				   =  'Entree';
		$this->load->view('templates/header', $data);
		$this->load->view('entry_in', $data);
		$this->load->view('templates/footer');
	}

	public function check()
	{
		$data['user_groups']           =   $this->ion_auth->get_users_groups()->result();
		$data['user_permissions']      =   $this->ion_auth_acl->build_Acl();
		$data['menus']			  	   =   $this->nav_model->get_nav_menus();
		$data['subs']				   =   $data['menus'];
		$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
		$data['title']				   =  'Depot';
		$data['stock_list']			   =  $this->warehouse_model->get_list_of_stock();
		$data['zones']				= $this->warehouse_model->get_zones();
		$data['shelfs']				= $this->warehouse_model->get_shelfs();

		//get different data


		$this->load->view('templates/header', $data);
		$this->load->view('browse', $data);
		$this->load->view('templates/footer');
	}
	public function create_entry_in()
	{
		//get inpusts\s
		$product_id = $this->input->get('pid');
		$si_qty = $this->input->get('si_qty');
		$si_date = $this->input->get('si_date');
		$si_user_id = $this->session->userdata('user_id');

		//add the location
		$model = array(
			'prod_loc_prod_id' => $product_id,
			'prod_loc_zone_id' => $this->input->get('prod_zone_id'),
			'prod_loc_shelf_id' => $this->input->get('prod_shelf_id')
		);
		$prod_loc_id = $this->warehouse_model->add_product_location($model);

		// adding the entry
		$entry_model = array(
			'si_product_id' => $product_id,
			'si_quantity' => $si_qty,
			'si_entry_date' => $si_date,
			'si_user_id'    => $si_user_id
		);
		$this->warehouse_model->add_entry_in($entry_model);
		//update table stock
		if ($this->warehouse_model->is_lus_exist()) {
			//then update the record
			$_qty = $this->warehouse_model->get_qty_by_prodID($product_id);
			$final_qty = $_qty + $si_qty;
			$lus_model = array(

				'lus_quantity' => $final_qty
			);
			$this->warehouse_model->update_lus($lus_model);
		} else {
			//add the record for the first time
			$lus_model = array(
				'lus_product_id' => $prod_loc_id,
				'lus_quantity' => $si_qty,
				'lus_prod_loc_id' => $product_id,
				'lus_prod_loc_description' => $this->input->post('prod_loc_description')
			);
			$this->warehouse_model->add_lus($lus_model);
		}
	}
	public function create_entry_out()
	{
	}
}
