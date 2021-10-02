<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class report_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('pos/pos_model');
        $this->load->model('product/product_model');
        $this->load->model('warehouse/warehouse_model');
        
    }
    public function generate_daily_report($pos_id)
    {
            $this->db->where(array('status'=> 1,'inv_pos_id' => $pos_id));
            $query = $this->db->get('invoice');
            
            return $query->result_array();
    }
    

}

/* End of file report_model.php */
