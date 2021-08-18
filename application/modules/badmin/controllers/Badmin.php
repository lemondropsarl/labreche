<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Badmin extends MX_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');       
        $this->load->library('ion_auth_acl');
        $this->load->library('toastr');
        
        $this->load->model('nav_model');
        $this->load->model('admin_model');
        
        $siteLang = $this->session->userdata('site_lang');
        if ($siteLang) {
		  
           $this->lang->load('main',$siteLang);
           $this->lang->load('ion_auth',$siteLang);
        } else {
		  
           $this->lang->load('main','french');
           $this->lang->load('ion_auth','french');

        }
        
        if( ! $this->ion_auth_acl->has_permission('A') )
            redirect('dashboard');
    }
    
    public function index()
    {
        redirect('badmin/users');
    }
    public function users(){
        $data['user_groups']           =   $this->ion_auth->get_users_groups()->result();
		$data['user_permissions']      =   $this->ion_auth_acl->build_Acl();
		$data['menus']			  	   =   $this->nav_model->get_nav_menus();
		$data['subs']				   =   $data['menus'];
        $data['acl_modules']		   =   $this->nav_model->get_acl_modules();
        $data['users']                 =   $this->ion_auth->users()->result();
        $data['message']                = $this->session->flashdata('message');
        $data['title']                  = 'Manage users';

        $this->load->view('templates/header', $data);      
        $this->load->view('users', $data);
        $this->load->view('templates/footer');      
    }
   
    public function group_permission()
    {
        $data['permissions']    =   $this->ion_auth_acl->permissions('full');
        $data['groups'] = $this->ion_auth->groups()->result();
        $data['title']  = '';
        $this->load->view('admin/permissions', $data);
    }

    public function add_permission()
    {
       

        $this->form_validation->set_rules('perm_key', 'key', 'required|trim');
        $this->form_validation->set_rules('perm_name', 'name', 'required|trim');

        $this->form_validation->set_message('required', 'Please enter a %s');

        if( $this->form_validation->run() === FALSE )
        {
            $data['message'] = ($this->ion_auth_acl->errors() ? $this->ion_auth_acl->errors() : $this->session->flashdata('message'));

            $this->load->view('badmin/add_permission', $data);
        }
        else
        {
            $new_permission_id = $this->ion_auth_acl->create_permission($this->input->post('perm_key'), $this->input->post('perm_name'));
            if($new_permission_id)
            {
                // check to see if we are creating the permission
                // redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("badmin/groups_permissions", 'refresh');
            }
        }
    }

    public function update_permission()
    {
        if( $this->input->post() && $this->input->post('cancel') )
            redirect('admin/permissions', 'refresh');

        $permission_id  =   $this->uri->segment(3);

        if( ! $permission_id )
        {
            $this->session->set_flashdata('message', "No permission ID passed");
            redirect("admin/permissions", 'refresh');
        }

        $permission =   $this->ion_auth_acl->permission($permission_id);

        $this->form_validation->set_rules('perm_key', 'key', 'required|trim');
        $this->form_validation->set_rules('perm_name', 'name', 'required|trim');

        $this->form_validation->set_message('required', 'Please enter a %s');

        if( $this->form_validation->run() === FALSE )
        {
            $data['message']    = ($this->ion_auth_acl->errors() ? $this->ion_auth_acl->errors() : $this->session->flashdata('message'));
            $data['permission'] = $permission;

            $this->load->view('admin/edit_permission', $data);
        }
        else
        {
            $additional_data    =   array(
                'perm_name' =>  $this->input->post('perm_name')
            );

            $update_permission = $this->ion_auth_acl->update_permission($permission_id, $this->input->post('perm_key'), $additional_data);
            if($update_permission)
            {
                // check to see if we are creating the permission
                // redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("/admin/permissions", 'refresh');
            }
        }
    }

    public function delete_permission()
    {
        if( $this->input->post() && $this->input->post('cancel') )
            redirect('/admin/permissions', 'refresh');

        $permission_id  =   $this->uri->segment(3);

        if( ! $permission_id )
        {
            $this->session->set_flashdata('message', "No permission ID passed");
            redirect("admin/permissions", 'refresh');
        }

        if( $this->input->post() && $this->input->post('delete') )
        {
            if( $this->ion_auth_acl->remove_permission($permission_id) )
            {
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("admin/permissions", 'refresh');
            }
            else
            {
                echo $this->ion_auth_acl->messages();
            }
        }
        else
        {
            $data['message'] = ($this->ion_auth_acl->errors() ? $this->ion_auth_acl->errors() : $this->session->flashdata('message'));

            $this->load->view('/admin/delete_permission', $data);
        }
    }

    public function groups_permissions()
    {
        
        $data['title']                  =  $this->lang->line('perm_management');
        $data['menus']			  	   =   $this->nav_model->get_nav_menus();
		$data['subs']				   =   $data['menus'];
        $data['acl_modules']		   =   $this->nav_model->get_acl_modules();
        $data['permissions']           =   $this->ion_auth_acl->permissions('full', 'perm_key');
        $data['groups']                =   $this->ion_auth->groups()->result();
        $data['matrix']                =  $this->ion_auth_model->get_groups_permissions();

        $this->load->view('templates/header', $data);
        $this->load->view('badmin/groups_permissions', $data);
        $this->load->view('templates/footer');
    }
    public function update_gp(){
        $gp = $this->admin_model->ggp();
        $idsYes = array();
        $idsNO = array();
            
        foreach($this->input->post() as $k =>  $v)
        {
               $string = strval($k);
               $perm_id = $string[0];
               $group_id = $string[2];
               foreach ($gp as $p) {
                  if ($p->group_id == $group_id && $p->perm_id == $perm_id) {
                     //$this->ion_auth_model->update_permission_to_group($p->id,'1');
                    $idsYes[] = $p->id;
                     
                  }
               }
        }
        foreach ($gp as $value) {
            if (!in_array($value->id,$idsYes)) {
                  $idsNo[] = $value->id;
            }
        }
        for ($i=0; $i < count($idsYes) ; $i++) { 
            
            $this->admin_model->update_permission_to_group($idsYes[$i],1);
        }
        for ($i=0; $i < count($idsNO); $i ++){
            $this->admin_model->update_permission_to_group($idsNO[$i],0);
        }

        redirect('badmin/groups_permissions');
        
    }
    public function user_permissions()
    {
        $user_id  =   $this->uri->segment(3);

       
            foreach($this->input->post() as $k => $v)
            {
                if( substr($k, 0, 5) == 'perm_' )
                {
                    $permission_id  =   str_replace("perm_","",$k);

                    if( $v == "X" )
                        $this->ion_auth_acl->remove_permission_from_user($user_id, $permission_id);
                    else
                        $this->ion_auth_acl->add_permission_to_user($user_id, $permission_id, $v);
                }
            }

            redirect("badmin/manage_user/{$user_id}", 'refresh');
        

    }
    public function manage_user()
    {
        $user_id  =   $this->uri->segment(3);

        if( ! $user_id )
        {
            $this->session->set_flashdata('message', "No user ID passed");
            redirect("badmin/users", 'refresh');
        }
        if ($this->input->post() && $this->input->post('assign')) {
           foreach ($this->input->post() as $k => $v) {
               if (substr($k,0,6) == 'group_') {
                  $group_id = str_replace("group_","",$k);
                  if ($v == "1") 
                     $this->ion_auth_model->add_to_group($group_id,$user_id);
                  else 
                    $this->ion_auth_model->remove_from_group($group_id,$user_id);
                  
               }
           }
           redirect("badmin/manage_user/{$user_id}",'refresh');
        }
        $user_groups    =   $this->ion_auth_acl->get_user_groups($user_id);
        $data['title']                  = $this->lang->line('user_detail');
        $data['menus']			  	   =   $this->nav_model->get_nav_menus();
		$data['subs']				   =   $data['menus'];
        $data['acl_modules']		   =   $this->nav_model->get_acl_modules();
        $data['user']                  =   $this->ion_auth->user($user_id)->row();
        $data['groups']                =   $this->ion_auth->groups()->result();
        $data['user_groups']           =   $this->ion_auth->get_users_groups($user_id)->result();
        $data['user_id']               =   $user_id;
        $data['permissions']           =   $this->ion_auth_acl->permissions('full', 'perm_key');
        $data['group_permissions']     =   $this->ion_auth_acl->get_group_permissions($user_groups);
        $data['user_acl']              =   $this->ion_auth_acl->build_acl($user_id);
        


        $this->load->view('templates/header', $data);
        $this->load->view('badmin/manage_user', $data);
        $this->load->view('templates/footer');
        
    }
    public function add_group(){

        $group_name = $this->input->post('name');
        $group_desc = $this->input->post('description');
        $group_id = $this->ion_auth->create_groupe($group_name,$group_desc);

        //add row acl modules value to 0
        $modules = $this->admin_model->get_modules();
        foreach ($modules as $v) {
            $mo = $v['module_name'];
           $model = array(
               'module_name' =>$mo,
               'group_id'   => (float)$group_id,
               'value'  => '0'
           ) ;
            $this->admin_model->add_acl_module($model);
            
        }
        //add raw permissions value to 0
        $perm_ids = $this->ion_Auth_acl->permissions();
        foreach ($perm_ids as $v) {
           $this->ion_auth_acl->add_permission_to_group($group_id,$v);
        }
        
        $this->toastr->success($this->lang->line('add_group_success_msg'));
        
        redirect('badmin/groups_permissions','refresh');


    }
    public function module_permissions()
    {
        $data['groups']                =   $this->ion_auth->get_groups('full');
        $data['matrix']                =  $this->admin_model->get_modules_permissions();
        $data['modules']                = $this->nav_model->get_modules();
        $data['user_groups']           =   $this->ion_auth->get_users_groups()->result();
		$data['user_permissions']      =   $this->ion_auth_acl->build_Acl();
		$data['menus']			  	   =   $this->nav_model->get_nav_menus();
		$data['subs']				   =   $data['menus'];
		$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
		$data['title']					=  'Gestion access au modules';
        $this->load->view('templates/header', $data);
        $this->load->view('module_permissions', $data);
        $this->load->view('templates/footer');  
    }
    public function update_mp()
    {
        # code...
    }


}

/* End of file Controllername.php */
