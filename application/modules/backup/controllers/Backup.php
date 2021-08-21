<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends MX_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('directory');
        
        $this->load->model('nav_model');
		
		$this->load->library('ion_auth');
		$this->load->library('ion_auth_acl');
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
    
    public function index()
    {
        $data['user_groups']           =   $this->ion_auth->get_users_groups()->result();
		$data['user_permissions']      =   $this->ion_auth_acl->build_Acl();
		$data['menus']			  	   =   $this->nav_model->get_nav_menus();
		$data['subs']				   =   $data['menus'];
		$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
		$data['title']					=  lang('dashboard');
        $data['backups']                = $this->get_list_backups();
        $this->load->view('templates/header', $data);
        $this->load->view('index', $data);
        $this->load->view('templates/footer'); 
    }
    public function create_backup()
    {
        $prefs = array(
            'tables'        => array(),   // Array of tables to backup.
            'ignore'        => array(),                     // List of tables to omit from the backup
            'format'        => 'txt',                       // gzip, zip, txt
            'filename'      => 'database.sql',              // File name - NEEDED ONLY WITH ZIP FILES
            'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
            'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
            'newline'       => "\n"                         // Newline character used in backup file
        );
    
        $this->dbutil->backup($prefs);
        $backup =  $this->dbutil->backup();
       $latest = time();
       write_file('db_sql/'.$latest.'_'.'database.sql',$backup);
       
       redirect('backup/index','refresh');
       
    }
    public function restore_backup(Type $var = null)
    {
        # code...
    }
    public function get_list_backups()
    {
        return directory_map(APPPATH.'/db_sql/');
    }

}

/* End of file BAckup.php */
