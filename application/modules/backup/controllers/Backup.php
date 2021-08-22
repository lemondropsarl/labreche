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
		$data['title']					=  'Sauvegarde & Réinitialisation';
        $data['files']                = $this->get_list_backups();
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
       write_file('db_sql/database_'.$latest.'.sql',$backup);
       
       redirect('backup/index','refresh');
       
    }
    public function restore_backup()
    {
        
        $sql_filename = $this->uri->segment(3);
        $sql_contents = file_get_contents(APPPATH.'/db_sql/'.$sql_filename);
        $sql_contents = explode(";", $sql_contents);
    
        foreach($sql_contents as $query)
        {
    
            $pos = strpos($query,'ci_sessions');
            var_dump($pos);
            if($pos == false)
            {
                $result = $this->db->query($query);
            }
            else
            {
                continue;
            }
    
        }
        
        redirect('backup/index','refresh');
        
    }
    public function get_list_backups()
    {
        //directory_map(APPPATH.'/db_sql/');
        $ar =[];
        $path    = './db_sql';
        chdir($path);
        array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_DESC, $files);
        foreach($files as $filename)
        {
            $ar[] = $filename;
        }

        return $ar;
        //$files = scandir($path);
        // return $files = array_diff(scandir($path), array('.', '..'));
    }

}

/* End of file BAckup.php */
