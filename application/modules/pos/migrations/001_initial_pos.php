<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_initial_pos extends CI_Migration {

    private $tables;
    public function __construct()
    {
        $this->load->dbforge();
        $this->load->database();
        $this->load->config('pos/pos', TRUE);
        $this->tables = $this->config->item('tables','pos');
    }
    public function up() {
        //create pos table
        $this->dbforge->drop_table($this->tables['pos'],TRUE);
        $this->dbforge->add_field([
            'pos_ws_id' => [
                'type' => 'MEDIUMINT',
                'constraint' =>'4',
            ],
            'pos_name' => [
                'type' => 'VARCHAR',
                'constraint' =>'20',
                'unique' => TRUE
            ],
            'pos_address' => [
                'type' => 'VARCHAR',
                'constraint' =>'30',
                'null'  => TRUE
            ],

        ]);
        $this->dbforge->add_key('pos_ws_id',TRUE);
        $this->dbforge->create_table($this->tables['pos'],TRUE);

        $this->dbforge->drop_table($this->tables['invoice'],TRUE);
        $this->dbforge->add_field([
            'invoice_id' => [
                'type' => 'MEDIUMINT',
                'constraint' =>'4',
                'auto_increment' => TRUE
            ],
            'inv_pos_id' => [
                'type' => 'MEDIUMINT',
                'constraint' =>'4'
            ],
            'inv_total_amount' => [
                'type' => 'decimal'
  
            ],
            'inv_discount_amount' => [
                'type' => 'decimal'
            ],
            'inv_vat_amount' => [
                'type' => 'decimal'
            ],
            'user_id' => [
                'type' => 'MEDIUMINT',
                'constraint' =>'4'             
            ],
            'inv_datetime' => [
                'type' => 'timestamp'            
            ],
            'transaction_type' => [
                'type' => 'VARCHAR',
                'constraint' => '10'
            ],
            'devise'  =>[
                'type'  => 'VARCHAR',
                'constraint'=>'3'
            ],
            'status' =>[
                'type' => 'boolean',
                'default'   => 1
            ]
        ]);

        $this->dbforge->add_key('invoice_id',TRUE);
        $this->dbforge->create_table($this->tables['invoice'],TRUE);

        $this->dbforge->drop_table($this->tables['prods_in_inv'],TRUE);
        $this->dbforge->add_field([
            'pi_product_id' => [
                'type' => 'MEDIUMINT',
                'constraint' => '4'
            ],
            'pi_invoice_id' =>[
                'type' => 'MEDIUMINT',
                'constraint' => '4'
            ],
            'pi_quantity' =>[
                'type' => 'int',
                'constraint' => '4'
            ]
        ]);
        $this->dbforge->create_table($this->tables['prods_in_inv'],TRUE);
        $this->dbforge->drop_table($this->tables['user_pos'],TRUE);
        $this->dbforge->add_field([
            'id' => [
                'type'  => 'MEDIUMINT',
                'constraint'    => '4',
                'auto_increment'    => TRUE
            ],
            'user_id' =>[
                'type' => 'MEDIUMINT',
                'constraint'    => '4'
            ],
            'pos_id' =>[
                'type' => 'MEDIUMINT',
                'constraint'    => '4'
            ]
        ]);
        $this->dbforge->add_key('id',TRUE);
        $this->dbforge->create_table($this->tables['user_pos'],TRUE);

        $this->dbforge->drop_table($this->tables['refund_invoice'],TRUE);
        $this->dbforge->add_field([
            'refund_id' => [
                'type'  => 'MEDIUMINT',
                'constraint'    => '4',
                'auto_increment'    => TRUE
            ],
            'ref_inv_id' =>[
                'type' => 'MEDIUMINT',
                'constraint'    => '4'
            ],
            'refund_status' =>[
                'type' => 'boolean',
                'default'   => 0
            ]
        ]);
        $this->dbforge->add_key('refund_id',TRUE);
        $this->dbforge->create_table($this->tables['refund_invoice'],TRUE);

        //add one constraint
        $query = 'ALTER TABLE'.' '.$this->tables['invoice'].'  '.
        'ADD CONSTRAINT fk_pos_id FOREIGN KEY (inv_pos_id) REFERENCES'.' '.$this->tables['pos'].' '.' (pos_id)';

        //add navigation menus and acls
        $acls = [
            [
                'module_name'   => 'pos',
                'group_id'      => 1,
                'value'         => '1'
            ],
            [
                'module_name'   => 'pos',
                'group_id'      => 2,
                'value'         => '0'
            ],
            [
                'module_name'   => 'pos',
                'group_id'      => 3,
                'value'         => '1'
            ],
            [
                'module_name'   => 'pos',
                'group_id'      => 4,
                'value'         => '0'
            ],
        ];
        $this->db->insert_batch('acl_modules', $acls);

        $module = [
			'module_name'		    => 'pos',
			'module_display_name'	=> 'Point de vente',
			'module_description'	=> 'La facturation des produits',
			'module_status'			=>'1',
			'module_version'		=>'1.0',
			'is_preloaded'			=> '1'

		];
		$this->db->insert('modules', $module);

        $menu = [
            //Module menu
            [
                'name'	=> 'pos',
                'url'	=> '',
                'icon'  => 'fa fa-store',
				'icon-name'	=> 'apps',
				'text'	=> 'Points de vente',
				'parent'=> '',
				'order' => 400,
				'perm_key'=> 'W'
            ],
            [
                'name'	=> 'invocing',
                'url'	=> 'pos/invoicing',
                'icon'  => 'material-icons',
				'icon-name'	=> 'apps',
				'text'	=> 'Facturation',
				'parent'=> 'pos',
				'order' => 410,
				'perm_key'=> 'W'
            ],
            [
                'name'	=> 'check_pos',
                'url'	=> 'pos/check',
                'icon'  => 'material-icons',
				'icon-name'	=> 'apps',
				'text'	=> 'Voir dépôts',
				'parent'=> 'pos',
				'order' => 420,
				'perm_key'=> 'W'
            ],
            [
                'name'	=> 'list_invoices',
                'url'	=> 'pos/list_invoice',
                'icon'  => 'material-icons',
				'icon-name'	=> 'apps',
				'text'	=> 'Liste Factures',
				'parent'=> 'pos',
				'order' => 430,
				'perm_key'=> 'R'
            ],
            [
                'name'	=> 'refund_invoices',
                'url'	=> 'pos/list_refund',
                'icon'  => 'material-icons',
				'icon-name'	=> 'apps',
				'text'	=> 'Liste remboursement',
				'parent'=> 'pos',
				'order' => 440,
				'perm_key'=> 'R'
            ]
            
        ];
        $this->db->insert_batch('navigation_menu', $menu);

    }

    public function down() {
        $this->dbforge->drop_table($this->tables['pos'],TRUE);
        $this->dbforge->drop_table($this->tables['invoice'],TRUE);
        $this->dbforge->drop_table($this->tables['prods_in_inv'],TRUE);
        $this->dbforge->drop_table($this->tables['user_pos'],TRUE);

    }

}

