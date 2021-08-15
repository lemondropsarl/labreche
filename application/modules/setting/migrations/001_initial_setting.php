<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_initial_setting extends CI_Migration {
    private $tables;

    public function __construct()
    {
        $this->load->dbforge();
        $this->load->database();
        $this->load->config('setting/setting',TRUE);
        $this->tables = $this->config->item('tables','setting');
    }

    public function up() {
        $this->dbforge->drop_table($this->tables['store'],TRUE);
        $this->dbforge->add_field([
            'store_id' =>[
                'type' => 'MEDIUMINT',
                'constraint' => '4',
                'auto_increment' => TRUE
            ],
            'Store_name' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'unique' => TRUE,
                'null' => TRUE
            ],
            'rccm' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'unique' => TRUE,
                'null' => TRUE
            ],
            'id_nat' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'unique' => TRUE,
                'null' => TRUE
            ],
            'nif' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'unique' => TRUE,
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key('store_id',TRUE);
        $this->dbforge->create_table($this->tables['store'],TRUE);
        $acls = [
            [
                'module_name'   => 'setting',
                'group_id'      => 1,
                'value'         => '1'
            ],
            [
                'module_name'   => 'setting',
                'group_id'      => 2,
                'value'         => '1'
            ],
        ];
        $this->db->insert_batch('acl_modules', $acls);

        $module = [
			'module_name'		    => 'setting',
			'module_display_name'	=> 'Paramètres',
			'module_description'	=> 'Paramètre general',
			'module_status'			=>'1',
			'module_version'		=>'1.0',
			'is_preloaded'			=> '1'

		];
		$this->db->insert('modules', $module);

        $menu = [
            //Module menu
            [
                'name'	=> 'setting',
                'url'	=> '',
                'icon'  => 'fa-th-large21`',
				'icon-name'	=> 'apps',
				'text'	=> 'Paramètres',
				'parent'=> '',
				'order' => 500,
				'perm_key'=> 'A'
            ]  ,
            [
                'name'	=> 'general_setting',
                'url'	=> 'setting',
                'icon'  => 'fa-th-large21`',
				'icon-name'	=> 'apps',
				'text'	=> 'General',
				'parent'=> '',
				'order' => 510,
				'perm_key'=> 'A'
            ]        
            
        ];
        $this->db->insert_batch('navigation_menu', $menu);
    }

    public function down() {
        $this->dbforge->drop_table($this->tables['store']);
    }

}

/* End of file initial_setting.php */
