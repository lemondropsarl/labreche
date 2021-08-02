<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_initial_product extends CI_Migration {

    public function __construct()
    {
        $this->load->dbforge();
        $this->load->library('migration');
    }

    public function up() {
        $this->dbforge->drop_table('vehicule',TRUE);
        $this->dbforege->add_field([
            'id' =>[
                'type' => 'MEDIUMINT',
                'constraint' => '4',
                'auto_increment' => TRUE
            ],
            'name' =>[
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'marque' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'model' =>[
                'type' => 'VARCHAR',
                'constraint' => '50'
            ]          
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('vehicule');
    }
            
    public function down() {
        $this->dbforge->drop_table('vehicule',TRUE);
    }

}

/* Endinitial_product.php */
