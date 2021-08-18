<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_initial_admin extends MY_Migration {

    public function __construct()
    {
        $this->load->dbforge();
       
    }

    public function up() {
        $acls = [
            [
                'module_name'   => 'badmin',
                'group_id'      => 1,
                'value'         => '1'
            ],
            [
                'module_name'   => 'badmin',
                'group_id'      => 2,
                'value'         => '1'
            ],
            [
                'module_name'   => 'badmin',
                'group_id'      => 3,
                'value'         => '0'
            ],
            [
                'module_name'   => 'badmin',
                'group_id'      => 4,
                'value'         => '0'
            ]
        ];
        $this->db->insert_batch('acl_modules', $acls);
        
        $menus = [
            //admin menu
            [
                'name'	=> 'badmin',
                'url'	=> '',
                'icon'  => 'fa-cog',
				'icon-name'	=> '',
				'text'	=> 'administration',
				'parent'=> '',
				'order' => 900,
				'perm_key'=> 'A'
            ],
            //admin sub menus
            [
                'name'	=> 'users',
                'url'	=> 'badmin/users',
                'icon'  => 'material-icons',
				'icon-name'	=> '',
				'text'	=> 'Users',
				'parent'=> 'badmin',
				'order' => 910,
				'perm_key'=> 'A'
            ],
            [
                'name'	=> 'group_permission',
                'url'	=> 'badmin/groups_permissions',
                'icon'  => 'material-icons',
				'icon-name'	=> '',
				'text'	=> 'Groups & Permissions',
				'parent'=> 'badmin',
				'order' => 920,
				'perm_key'=> 'A'
            ],
            [
                'name'	=> 'module_permissions',
                'url'	=> 'badmin/module_permissions',
                'icon'  => 'material-icons',
				'icon-name'	=> '',
				'text'	=> 'Access Module',
				'parent'=> 'badmin',
				'order' => 930,
				'perm_key'=> 'A'
            ]
        ];
        $this->db->insert_batch('navigation_menu', $menus);
        
        $module = [
			'module_name'		    => 'admin',
			'module_display_name'	=> 'Administration',
			'module_description'	=> 'This extension handle all your administration operation and management',
			'module_status'			=>'1',
			'module_version'		=>'1.0.0',
			'is_preloaded'			=> '1'

		];
		$this->db->insert('modules', $module);
    }

    public function down() {
        
    }

}

/* End of file initial_admin.php */
