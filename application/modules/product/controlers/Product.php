<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MX_Copntroller {
    
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('nav_model'); 
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
    }
    public function list()
    {
        # code...
    }
    
}

/* End of file filename.php */

