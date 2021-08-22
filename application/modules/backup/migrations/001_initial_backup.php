<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_initial_backup extends CI_Migration {

    public function __construct()
    {
        $this->load->dbforge();
        $this->load->database();
    }

    public function up() {
        $acls = [
            [
                'module_name'   => 'backup',
                'group_id'      => 1,
                'value'         => '1'
            ],
            [
                'module_name'   => 'backup',
                'group_id'      => 2,
                'value'         => '1'
            ],
            [
                'module_name'   => 'backup',
                'group_id'      => 3,
                'value'         => '0'
            ],
            [
                'module_name'   => 'backup',
                'group_id'      => 4,
                'value'         => '0'
            ]
        ];
        $this->db->insert_batch('acl_modules', $acls);
        $module = [
			'module_name'		    => 'Backup',
			'module_display_name'	=> 'Backup',
			'module_description'	=> 'Manage back up and restore data',
			'module_status'			=>'1',
			'module_version'		=>'1.0.0',
			'is_preloaded'			=> '1'

		];
		$this->db->insert('modules', $module);

        $menu = [
            //Module menu
            [
                'name'	=> 'backup',
                'url'	=> '',
                'icon'  => 'fa fa-refresh`',
				'icon-name'	=> 'refresh',
				'text'	=> 'Sauvegarde',
				'parent'=> '',
				'order' => 2000,
				'perm_key'=> 'A'
            ],
            [
                'name'	=> 'backup_restore',
                'url'	=> 'backup',
                'icon'  => 'material-icons',
				'icon-name'	=> 'apps',
				'text'	=> 'Sauvegarde & Recuperation',
				'parent'=> 'backup',
				'order' => 2100,
				'perm_key'=> 'A'
            ],
           
            
        ];
        $this->db->insert_batch('navigation_menu', $menu);
    }

    public function down() {
        
    }

}

/* End of file initial_backup.php */
