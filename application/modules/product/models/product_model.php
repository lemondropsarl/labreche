<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class product_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_all_products()
    {
        # code...
        $query = $this->db->get('product');       
        return $query->result_array();      
    }
    public function update_product($id, $data)
    {
        $this->db->update('product', $data, array('product_id'=>$id));
        
    }
    public function add_category($data)
    {
        $this->db->insert('categories', $data);
        return $this->db->insert_id();
        
    }
    public function add_vehicule($data)
    {
        $this->db->insert('vehicule', $data);
        return $this->db->insert_id();

    }
    public function add_product($data)
    {
        $this->db->insert('product', $data);
        return $this->db->insert_id();
    }
    public function get_product_by_code($code)
    {
        $query = $this->db->get_where('product', array('product_code'=>$code));
        return $query->row_array();
 
    }
    //get categories list
    public function get_categories()
    {
        $query = $this->db->get('categories');
        return $query->result_array();
    }
    //get vehicules list
    public function get_vehicules()
    {
        $query = $this->db->get('vehicule');
        return $query->result_array();
    }
    public function get_uoms()
    {
        # code...
        $query = $this->db->get('uom');
        return $query->result_array();
        
    }
}

/* End of file filename.php */
