<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_initial_product extends CI_Migration {

    
    public function __construct()
    {

        $this->load->dbforge();
        $this->load->database();
       
    }

    public function up() {
        $this->dbforge->drop_table('vehicule',TRUE);
        $this->dbforge->add_field([
            'vehicule_id' =>[
                'type' => 'MEDIUMINT',
                'constraint' => '4',
                'auto_increment' => TRUE
            ],
            'vehicule_name' =>[
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'vehicule_brand' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'vehicule_model' =>[
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'isActive' =>[
                'type' => 'boolean',
                'default' => 1
            ]          
        ]);
        $this->dbforge->add_key('vehicule_id', TRUE);
        $this->dbforge->create_table('vehicule');

        $this->dbforge->drop_table('categories',TRUE);
        $this->dbforge->add_field([

            'cat_id' => [
                'type' => 'MEDIUMINT',
                'constraint' => '4',
                'auto_increment' => TRUE
            ],
            'cat_name' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'unique' => TRUE
            ],
            'cat_description' =>[
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key('cat_id',TRUE);
        $this->dbforge->create_table('categories',TRUE);

        $this->dbforge->drop_table('product',TRUE);
        $this->dbforge->add_field([
            'product_id' => [
                'type' => 'MEDIUMINT',
                'constraint' => '4',
                'auto_increment' => TRUE
            ],
            'product_code' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'unique' => TRUE,
                'unsigned' => TRUE
            ],
            'product_name' => [
                'type' => 'VARCHAR',
                'constraint' => '20',               
            ],
            'unit_price' => [
                'type' => 'double'             
            ],
            'product_brand' => [
                'type' => 'varchar',
                'constraint' => '20',
                'null' => TRUE
            ],
            'product_model' => [
                'type' => 'varchar',
                'constraint' => '20',
                'null' => TRUE
            ],
            'cat_id_fk' => [
                'type' => 'MEDIUMINT',
                'constraint' => '4'
            ],
            'vehicule_id_fk' => [
                'type' => 'MEDIUMINT',
                'constraint' => '4'
            ],
            'product_status' =>[
                'type' => 'boolean',
                'default' => 1
            ]

        ]);
        $this->dbforge->add_key('product_id',TRUE);
        $this->dbforge->create_table('product',TRUE);

        

        $query1 = 'ALTER TABLE product'.'  '.
        'ADD CONSTRAINT fk_ve_id FOREIGN KEY (vehicule_id_fk) REFERENCES vehicule (vehicule_id)';
        $query2 = 'ALTER TABLE product'.' '.
        'ADD CONSTRAINT fk_cat_id FOREIGN KEY (cat_id_fk) REFERENCES categories (cat_id)';

        $this->db->query($query1);
        $this->db->query($query2);


        //adding to acl module table
        $acls = [
            [
                'module_name'   => 'product',
                'group_id'      => 1,
                'value'         => '1'
            ],
            [
                'module_name'   => 'product',
                'group_id'      => 2,
                'value'         => '1'
            ],
        ];
        $this->db->insert_batch('acl_modules', $acls);

        //adding to module table
        $module = [
			'module_name'		    => 'product',
			'module_display_name'	=> 'Product management',
			'module_description'	=> 'This extension Helps you manage all your products',
			'module_status'			=>'1',
			'module_version'		=>'1.0',
			'is_preloaded'			=> '1'

		];
		$this->db->insert('modules', $module);

        //adding navigation menus
        $menu = [
            //Module menu
            [
                'name'	=> 'product',
                'url'	=> '',
                'icon'  => 'fa-th-large21`',
				'icon-name'	=> 'apps',
				'text'	=> 'Articles',
				'parent'=> '',
				'order' => 200,
				'perm_key'=> 'A'
            ],
            [
                'name'	=> 'list_product',
                'url'	=> 'product/list',
                'icon'  => 'material-icons',
				'icon-name'	=> 'apps',
				'text'	=> 'Liste des articles',
				'parent'=> 'product',
				'order' => 210,
				'perm_key'=> 'A'
            ],
            [
                'name'	=> 'create_product',
                'url'	=> 'product/create',
                'icon'  => 'material-icons',
				'icon-name'	=> 'apps',
				'text'	=> 'Ajouter article',
				'parent'=> 'product',
				'order' => 220,
				'perm_key'=> 'A'
            ]
            
        ];
        $this->db->insert_batch('navigation_menu', $menu);


    }
            
    public function down() {
        $this->dbforge->drop_table('vehicule',TRUE);
        $this->dbforge->drop_table('categories',TRUE);
        $this->dbforge->drop_table('product',TRUE);

    }

}

/* Endinitial_product.php */
