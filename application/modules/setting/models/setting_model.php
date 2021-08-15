<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class setting_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_store_infos()
    {
        $query = $this->db->get('store_information');
        return $query->row_array();
    }
    public function add_store($model)
    {
        $this->db->insert('store_information', $model);
    }
}

/* End of file setting_model.php */
