<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MX_Controller {
    
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('nav_model');
        $this->load->model('product_model');
         
        $this->load->helper('url');
		$this->load->helper('path');
		$this->load->helper('form');
		$this->load->helper('file');
        $this->load->helper('unzip_helper');
        $this->load->helper('mainpage_helper');

        $this->load->library('form_validation');
        $this->load->library('ion_auth');
		$this->load->library('ion_auth_acl');
		$this->load->library('toastr');

        $siteLang = $this->session->userdata('site_lang');
        if ($siteLang) {
		  
           $this->lang->load('main',$siteLang);
           $this->lang->load('ion_auth',$siteLang);
        } else {
		  
           $this->lang->load('main','french');
           $this->lang->load('ion_auth','french');

        }
    }
    public function list()
    {
        $data['user_groups']           =   $this->ion_auth->get_users_groups()->result();
		$data['user_permissions']      =   $this->ion_auth_acl->build_Acl();
		$data['menus']			  	   =   $this->nav_model->get_nav_menus();
		$data['subs']				   =   $data['menus'];
		$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
		$data['title']					=  'Articles';
        $data['products']               = $this->product_model->get_all_products();
        # code...
        $this->load->view('templates/header',$data);
        $this->load->view('list_product',$data);
        $this->load->view('templates/footer');
    
    }
    public function create(Type $var = null)
    {
        $data['user_groups']           =   $this->ion_auth->get_users_groups()->result();
		$data['user_permissions']      =   $this->ion_auth_acl->build_Acl();
		$data['menus']			  	   =   $this->nav_model->get_nav_menus();
		$data['subs']				   =   $data['menus'];
		$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
		$data['title']					=  'Articles';
        # code...
        if ($this->form_validation->run() == FALSE) {
            # code...
            $this->load->view('templates/header',$data);
            $this->load->view('create_product');
            $this->load->view('templates/footer');
        }else{
            # code...
            //ON AJOUTE LES DONNées dans le db ici
            $model = array(
                'product_name' => $this->input->post('pname'),
                'product_code' => $this->input->post('pcode'),
                'unit_price' => $this->input->post('price'),
                'product_brand' => $this->input->post('pbrand'),
                'product_model' => $this->input->post('pmodel'),
                'cat_id_fk' => $this->input->post('pcat_id'),
                'vehicule_id_fk' => $this->input->post('pvehicule_id'),
                'product_status' => true
                
            );
            $this->product_model->add_product($model);

            //si deja on va ajouter les information du stock alors faut le faire ici
        }
    }
    public function edit(Type $var = null)
    {
        # code...
        $this->load->view('templates/header');
        $this->load->view('create_product');
        $this->load->view('templates/footer');
    }
    
    public function details(Type $var = null)
    {
        # code...
        $this->load->view('templates/header');
        $this->load->view('detail_product');
        $this->load->view('templates/fotter');
    }
    public function search(Type $var = null)
    {
        # code...
        $this->load->view('templates/header');
        $this->load->view('search_product');
        $this->load->view('templates/footer');
    }
    public function create_category(Type $var = null)
    {
        # code...
        $this->load->view('templates/header');
        $this->load->view('create_category');
        $this->load->view('templates/footer');
    }
    public function create_vehicule(Type $var = null)
    {
        # code...
        $this->load->view('templates/header');
        $this->load->view('create_category');
        $this->load->view('templates/footer');
    }
    
}

/* End of file filename.php */

