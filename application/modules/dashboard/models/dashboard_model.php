<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('pos/pos_model');
        $this->load->model('product_product_model');
        
        
    }
    public function get_accumulated_sales()
    {
        # code...
    }
    

}

/* End of file ModelName.php */

