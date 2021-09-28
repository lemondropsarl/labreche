<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_initial_report extends CI_Migration {

    public function __construct()
    {
        $this->load->dbforge();
        $this->load->database();
    }

    public function up() {
        //adding to acl module table
		$acls = [
			[
				'module_name'   => 'report',
				'group_id'      => 1,
				'value'         => '1'
			],
			[
				'module_name'   => 'report',
				'group_id'      => 2,
				'value'         => '1'
			],
			[
				'module_name'   => 'report',
				'group_id'      => 3,
				'value'         => '1'
			],
			[
				'module_name'   => 'report',
				'group_id'      => 4,
				'value'         => '1'
			]
		];
		$this->db->insert_batch('acl_modules', $acls);
        //adding to module table
		$module = [
			'module_name'		    => 'report',
			'module_display_name'	=> 'Generating report',
			'module_description'	=> 'This extension Helps you generate report',
			'module_status'			=> '1',
			'module_version'		=> '1.0',
			'is_preloaded'			=> '1'

		];
		$this->db->insert('modules', $module);
        //adding navigation menus
		$menu = [
			//Module menu
			[
				'name'	=> 'report',
				'url'	=> '',
				'icon'  => 'fa fa-stats',
				'icon-name'	=> 'apps',
				'text'	=> 'Rapports',
				'parent' => '',
				'order' => 500,
				'perm_key' => 'R'
			],
			[
				'name'	=> 'all_reports',
				'url'	=> 'report',
				'icon'  => 'material-icons',
				'icon-name'	=> 'apps',
				'text'	=> 'Générer rapports',
				'parent' => 'report',
				'order' => 510,
				'perm_key' => 'R'
			]
		];
		$this->db->insert_batch('navigation_menu', $menu);
    }

    public function down() {
        
    }

}

/* End of file initial_report.php */
