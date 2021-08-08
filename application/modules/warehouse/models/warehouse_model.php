<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class warehouse_model extends CI_Model {


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_list_of_stock()
    {
       $query = $this->db->get('list_of_Stock');
       return $query->result_array();
    }
    public function add_lus($model)
    {
        $this->db->insert('last_update_stock', $model);

    }
    public function get_zones()
    {
      $query = $this->db->get('zone_location');
      return $query->result_array();
    }
    public function get_shelfs()
    {
      $query = $this->db->get('shelf_location');
      return $query->result_array();
    }
    public function add_product_location($model)
    {
       $this->db->insert('product_location', $model);
       return $this->db->insert_id();
    }
    public function add_entry_in($model)
    {
        $this->db->insert('stock_entries_in', $model);

    }
    //check if this product has a record in LUS table
    public function is_lus_exist($pid)
    {
        $query = $this->db->get('last_update_stock')
        ->where('lus_product_id', $pid)
        ->select('lus_prodct_id','lus_quatity');

        if(count($query->row()) > 0){
           return true;
        }else{
            return false;
        };

    }
    public function get_qty_by_prodID($pid)
    {
        $query = $this->db->get('last_update_stock')
                        ->where('lus_product_id', $pid)
                        ->select('lus_quantity');

        return $query->row();

    }
    public function update_lus($model)
    {
        $this->db->update('last_update_stock', $model);
    }


}


