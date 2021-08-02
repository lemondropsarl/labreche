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
            've_id' =>[
                'type' => 'MEDIUMINT',
                'constraint' => '5',
                'auto_increment' => TRUE
            ],
            've_name' =>[
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            've_brand' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            've_model' =>[
                'type' => 'VARCHAR',
                'constraint' => '50'
            ]          
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('vehicule');

        $this->dbforge->drop_table('categories',TRUE);
        $this->dbforge->add_field([

            'cat_id' => [
                'type' => 'MEDUIMINT',
                'constraint' => '5',
                'auto_increment' => TRUE
            ],
            'cat_name' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ]
        ]);

    }
            
    public function down() {
        $this->dbforge->drop_table('vehicule',TRUE);
    }

}

/* Endinitial_product.php */
