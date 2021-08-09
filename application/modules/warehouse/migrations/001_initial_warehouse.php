<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_initial_warehouse extends CI_Migration {

    private $tables;
    private $views;
    public function __construct()
    {
        $this->load->dbforge();
        $this->load->config('warehouse/warehouse',TRUE);
        $this->tables = $this->config->item('tables','warehouse');
        $this->views = $this->config->item('views','warehouse');
    }

    public function up() {
        $this->dbforge->drop_table($this->tables['product_location'],TRUE);
        $this->dbforge->add_field([
            'prod_loc_id' =>[
                'type' => 'MEDIUMINT',
                'constraint' => '4',
                'auto_increment' => TRUE
            ],
            'prod_loc_prod_id' => [
                'type' => 'MEDIUMINT',
                'constraint' => '4',
                'unique' => TRUE
                
            ],
            'prod_loc_zone_id' => [
                'type' => 'MEDIUMINT',
                'constraint' => '4',
                
            ],
            'prod_loc_shelf_id' => [
                'type' => 'MEDIUMINT',
                'constraint' => '4',              
            ]
        ]);
        $this->dbforge->add_key('prod_loc_id',TRUE);
        $this->dbforge->create_table($this->tables['product_location'],TRUE);
        
        $this->dbforge->drop_table($this->tables['zone_location'],TRUE);
        $this->dbforge->add_field([
            'zone_id' =>[
                'type' => 'MEDIUMINT',
                'constraint' => '4',
                'auto_increment' => TRUE
            ],
            'zone_name' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
               
            ]
        ]);
        $this->dbforge->add_key('zone_id',TRUE);
        $this->dbforge->create_table($this->tables['zone_location'],TRUE);

        $this->dbforge->drop_table($this->tables['shelf_location'],TRUE);
        $this->dbforge->add_field([
            'shelf_id' =>[
                'type' => 'MEDIUMINT',
                'constraint' => '4',
                'auto_increment' => TRUE
            ],
            'shelf_name' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'unique' => TRUE
            ]
        ]);
        $this->dbforge->add_key('shelf_id',TRUE);
        $this->dbforge->create_table($this->tables['shelf_location'],TRUE);

        $this->dbforge->drop_table($this->tables['last_update_stock'],TRUE);
        $this->dbforge->add_field([
            'lus_product_id' =>[
                'type' => 'MEDIUMINT',
                'constraint' => '4',
                'unique' => TRUE
            ],
            'lus_quantity' => [
                'type' => 'int',
                'constraint' => '4'
            ],
            'lus_prod_loc_id' =>[
                'type' => 'MEDIUMINT',
                'constraint' => '4',
               
            ],
            'lus_prod_loc_description' =>[
                'type' => 'VARCHAR',
                'constraint' => '150'
            ]
            ,
            'lus_updated_date' => [
                'type' => 'date'
                
            ]
            
        ]);
        $this->dbforge->add_key('lus_product_id',TRUE);
        $this->dbforge->create_table($this->tables['last_update_stock'],TRUE);

        $this->dbforge->drop_table($this->tables['warehouses'],TRUE);
        $this->dbforge->add_field([
            'warehouse_id' =>[
                'type' => 'MEDIUMINT',
                'constraint' => '4',
                'auto_increment' => TRUE
            ],
            'warehouse_name' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'unique' => TRUE
            ],
            'warehouse_address' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ]
        ]);
        $this->dbforge->add_key('warehouse_id',TRUE);
        $this->dbforge->create_table($this->tables['warehouses'],TRUE);

        $this->dbforge->drop_table($this->tables['warehouse_stock'],TRUE);
        $this->dbforge->add_field([
            'ws_id' =>[
                'type' => 'MEDIUMINT',
                'constraint' => '4',
                'auto_increment' => TRUE
            ],
            'ws_product_id' =>[
                'type' => 'MEDIUMINT',
                'constraint' => '4',
                
            ],
            'warehouse_id' =>[
                'type' => 'MEDIUMINT',
                'constraint' => '4',
               
            ],
            'ws_quantity' => [
                'type' => 'int',
                'constraint' => '4'
            ],
            'updated_date' => [
                'type' => 'date',               
            ]
        ]);
        $this->dbforge->add_key('ws_id',TRUE);
        $this->dbforge->create_table($this->tables['warehouse_stock'],TRUE);

        $this->dbforge->drop_table($this->tables['stock_entries_in'],TRUE);
        $this->dbforge->add_field([
            'si_id' =>[
                'type' => 'MEDIUMINT',
                'constraint' => '4',
                'auto_increment' => TRUE
            ],
            'si_product_id' =>[
                'type' => 'MEDIUMINT',
                'constraint' => '4',
                
            ],
            'si_quantity' => [
                'type' => 'int',
                'constraint' => '4'
            ],
            'si_entry_date' => [
                'type' => 'date',               
            ],
            'si_user_id' =>[
                'type' => 'MEDIUMINT',
                'constraint' => '4'
            ]
        ]);
        $this->dbforge->add_key('si_id',TRUE);
        $this->dbforge->create_table($this->tables['stock_entries_in'],TRUE);

        $this->dbforge->drop_table($this->tables['stock_entries_out'],TRUE);
        $this->dbforge->add_field([
            'so_id' =>[
                'type' => 'MEDIUMINT',
                'constraint' => '4',
                'auto_increment' => TRUE
            ],
            'so_product_id' =>[
                'type' => 'MEDIUMINT',
                'constraint' => '4',
                
            ],
            'so_quantity' => [
                'type' => 'int',
                'constraint' => '4'
            ],
            'so_entry_date' => [
                'type' => 'date',               
            ],
            'so_dest_ware_id' =>[
                'type' => 'MEDIUMINT',
                'constraint' => '4'
            ],
            'so_user_id' =>[
                'type' => 'MEDIUMINT',
                'constraint' => '4'
            ]
        ]);
        $this->dbforge->add_key('so_id',TRUE);
        $this->dbforge->create_table($this->tables['stock_entries_out'],TRUE);

        //ad constraint 
        $query1 = 'ALTER TABLE'.' '. $this->tables['warehouse_stock'].'  '.
        'ADD CONSTRAINT ws_FK_ID FOREIGN KEY (warehouse_id) REFERENCES'.' '. $this->tables['warehouses'].' '.'(warehouse_id)';
        $query2 = 'ALTER TABLE'.' '. $this->tables['last_update_stock'].'  '.
        'ADD CONSTRAINT w_ID FOREIGN KEY (lus_prod_loc_id) REFERENCES'.' '. $this->tables['product_location'].' '.'(prod_loc_id)';
        $this->db->query($query1);
        $this->db->query($query2);

        //add acl modules
        $acls = [
            [
                'module_name'   => 'warehouse',
                'group_id'      => 1,
                'value'         => '1'
            ],
            [
                'module_name'   => 'warehouse',
                'group_id'      => 2,
                'value'         => '1'
            ],
        ];
        $this->db->insert_batch('acl_modules', $acls);
        
        $menus = [
            //warehouse menu
            [
                'name'	=> 'warehouse',
                'url'	=> '',
                'icon'  => 'fa-cog',
				'icon-name'	=> '',
				'text'	=> 'Gestion stock',
				'parent'=> '',
				'order' => 300,
				'perm_key'=> 'R'
            ],
            //warehouse sub menus
            [
                'name'	=> 'check_stock',
                'url'	=> 'warehouse/check',
                'icon'  => 'material-icons',
				'icon-name'	=> '',
				'text'	=> 'Voir stock',
				'parent'=> 'warehouse',
				'order' => 310,
				'perm_key'=> 'R'
            ],
            [
                'name'	=> 'entry_in',
                'url'	=> 'warehouse/entry_in',
                'icon'  => 'material-icons',
				'icon-name'	=> '',
				'text'	=> 'Entrée stock',
				'parent'=> 'warehouse',
				'order' => 320,
				'perm_key'=> 'R'
            ],
            [
                'name'	=> 'entry_out',
                'url'	=> 'warehouse/entry_out',
                'icon'  => 'material-icons',
				'icon-name'	=> '',
				'text'	=> 'Sortie stock',
				'parent'=> 'warehouse',
				'order' => 330,
				'perm_key'=> 'R'
            ]

        ];
        $this->db->insert_batch('navigation_menu', $menus);
        
        $module = [
			'module_name'		    => 'warehouse',
			'module_display_name'	=> 'Gestion stock',
			'module_description'	=> 'This extension handle all your stock operations and management',
			'module_status'			=>'1',
			'module_version'		=>'1.0.0',
			'is_preloaded'			=> '1'

		];
		$this->db->insert('modules', $module);

        //creating views
        $listStockView = 'CREATE VIEW'.' '. $this->views['list_of_stock'].' '.'AS SELECT'.' '.' 
        `product`.`product_id` AS `pid`,
        `product`.`product_code` AS `pcode`,
        `product`.`product_name` AS `pname`,
        `product`.`product_uom` AS `uom`,
        `last_update_stock`.`lus_quantity` AS `qty`
        
        FROM 
        (
            `product` join `last_update_stock`
        )
        
        WHERE 
        (
            `product`.`product_id` = `last_update_stock`.`lus_product_id`
        )';
        $this->db->query($listStockView);

        //adding wones
        $zones = [

            [
            'zone_name' => 'ZONE A'
            ],
            [
                'zone_name' => 'ZONE B'
            ],
             [
            'zone_name' => 'ZONE C'
            ],
            [
                'zone_name' => 'ZONE D'
            ],
            [
             'zone_name' => 'ZONE E'
            ],
            [
                'zone_name' => 'ZONE F'
                ]
        ];
        $this->db->insert_batch('zone_location', $zones);

        //etagere
        $shelfs = [

            [
            'shelf_name' => 'ETAGERE 1'
            ],
            [
                'shelf_name' => 'ETAGERE 2'
            ],
             [
            'shelf_name' => 'ETAGERE`3 '
            ],
            [
                'shelf_name' => 'ETAGERE 4'
            ],
            [
             'shelf_name' => 'ETAGERE 5'
            ],
            [
                'shelf_name' => 'ETAGERE 6'
            ]
        ];
        $this->db->insert_batch('shelf_location', $shelfs);

    }

    public function down() {
        $this->dbforge->drop_table($this->tables['product_location'],TRUE);

        $this->dbforge->drop_table($this->tables['zone_location'],TRUE);
        $this->dbforge->drop_table($this->tables['shelf_location'],TRUE);
        $this->dbforge->drop_table($this->tables['last_update_stock'],TRUE);
        $this->dbforge->drop_table($this->tables['warehouses'],TRUE);
        $this->dbforge->drop_table($this->tables['warehouse_stock'],TRUE);
        $this->dbforge->drop_table($this->tables['stock_entries_in'],TRUE);
        $this->dbforge->drop_table($this->tables['stock_entries_out'],TRUE);

    }

}

/* End of file initial_warehouse.php */
