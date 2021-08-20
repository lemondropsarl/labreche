<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Module extends MX_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('nav_model');
        $this->load->model('module_model');
        
        
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
		
        if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}
		$siteLang = $this->session->userdata('site_lang');
        if ($siteLang) {
		  
           $this->lang->load('main',$siteLang);
           $this->lang->load('ion_auth',$siteLang);
        } else {
		  
           $this->lang->load('main','french');
           $this->lang->load('ion_auth','french');

        }
    }
    

    public function index()
    {
        //check if user is logged in
        if (! $this->ion_auth->logged_in()) {
            redirect('auth');
        }else{
			$data['module_name']			="";
			$data['title']					= lang('module_manage');
            $data['modules'] 				= $this->module_model->get_modules();
            $data['menus']			  	   =   $this->nav_model->get_nav_menus();
            $data['subs']				   =   $data['menus'];
            $data['acl_modules']		   =   $this->nav_model->get_acl_modules();
            $data['permissions']           =   $this->ion_auth_acl->permissions('full', 'perm_key');
            $this->load->view('templates/header', $data);
            $this->load->view('browse', $data);
            $this->load->view('templates/footer');  
        }
	}
	//File Upload 
	function do_upload() {
			
        $config['upload_path'] = './uploads/';
		$config['allowed_types'] = '*';
		$config['max_size'] = '4096';
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('extension')) {
			$error = array('error' => $this->upload->display_errors());
			return $error;
		} else {
			$data = array('upload_data' => $this->upload->data());
			return $data['upload_data'];
		}
	}
	function upload_module(){
		if (!$this->ion_auth->logged_in()) {
            redirect('auth');
        } else {	
			$file_upload = $this->do_upload(); 
			$filename= $file_upload['file_name'];
			$filname_without_ext = pathinfo($filename, PATHINFO_FILENAME);		
			if(isset($file_upload['error'])){
				$this->toastr->error($file_upload['error']);		
				
				$data['title']					= lang('module_manage');
            	$data['modules'] 				= $this->module_model->get_modules();
            	$data['menus']			  	   =   $this->nav_model->get_nav_menus();
            	$data['subs']				   =   $data['menus'];
            	$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
            	$data['permissions']           =   $this->ion_auth_acl->permissions('full', 'perm_key');
            	$this->load->view('templates/header', $data);
            	$this->load->view('browse', $data);
            	$this->load->view('templates/footer');
			}elseif($file_upload['file_ext']!='.zip'){
				$data['error'] = lang('upload_error_zip');		
				$data['title']					= lang('module_manage');
            	$data['modules'] 				= $this->module_model->get_modules();
            	$data['menus']			  	   =   $this->nav_model->get_nav_menus();
            	$data['subs']				   =   $data['menus'];
            	$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
           		$data['permissions']           =   $this->ion_auth_acl->permissions('full', 'perm_key');
            	$this->load->view('templates/header', $data);
            	$this->load->view('browse', $data);
            	$this->load->view('templates/footer');
			}elseif(preg_match('/^[a-z_]+$/',$filname_without_ext)) {
				$data['error'] = "";
				$data['module_name'] = $filname_without_ext;
				//unzip module		
				$this->unzip_module($filname_without_ext);
				$data['title']					= lang('module_manage');
            	$data['modules'] 				= $this->module_model->get_modules();
            	$data['menus']			  	   =   $this->nav_model->get_nav_menus();
            	$data['subs']				   =   $data['menus'];
            	$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
            	$data['permissions']           =   $this->ion_auth_acl->permissions('full', 'perm_key');
            	$this->load->view('templates/header', $data);
            	$this->load->view('browse', $data);
            	$this->load->view('templates/footer');
			}else{			
				$this->toastr->error(lang('upload_sp_ch_error'));		
				$data['title']					= lang('module_manage');
            	$data['modules'] 				= $this->module_model->get_modules();
            	$data['menus']			  	   =   $this->nav_model->get_nav_menus();
            	$data['subs']				   =   $data['menus'];
            	$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
            	$data['permissions']           =   $this->ion_auth_acl->permissions('full', 'perm_key');
            	$this->load->view('templates/header', $data);
            	$this->load->view('browse', $data);
            	$this->load->view('templates/footer');
			}
		}
	}
    public function unzip_module($module_name){
		$file_name = "./uploads/".$module_name.".zip";
		$uploads = "./uploads";
		//echo $uploads;
		if(unzip($file_name, $uploads, true, false)){
			//Replace Files
			full_copy($uploads."/".$module_name, "./application/modules/".$module_name);
			//echo "Unzip Successfully completed";
			delete_files($file_name,TRUE);
		}else{
			//echo "Error while unzipping the file";
		}
		
	}
	public function install_module(){
		$module_name = $this->uri->segment(3);
		
	}
    public function update_extension(){
		
		$module_name = $this->uri->segment(3);	
		$module = $this->module_model->get_module_details_by_name($module_name);
		
		$parameters = array();
		$parameters['edd_action'] = 'get_version';
		$parameters['item_name'] = $module['module_display_name'];
		$parameters['license'] = $module['license_key'];
		$parameters['url'] = base_url();
		
		$encoded = "";
		foreach($parameters as $name => $value) {
			$encoded .= urlencode($name).'='.urlencode($value).'&';
		}
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://sanskruti.net/chikitsa/');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST' );
		curl_setopt($ch, CURLOPT_POSTFIELDS, $encoded);
		

		$response = curl_exec($ch); 
		curl_close($ch);    
		$data = json_decode($response, TRUE);
		//print_r($data);
		$download_link = $data['download_link'];
		
		$destination = "./uploads/".$module_name.".zip";
		copy($download_link, $destination);
		//echo "Module Downloaded";
		$this->unzip_module($module_name);
		$this->change_log($module_name);	
	}
    

}

/* End of file Module.php */
