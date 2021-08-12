<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class pos_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_list_stock_by_wsID($ws_id)
    {
        $query = "SELECT 
        `product`.`product_id` as `pid`,
        `product`.`product_code` as `pcode`,
        `product`.`product_name` as `pname`,
        `product`.`product_uom` as `uom`,
        `product`.`min_qty` as `min_qty`,
        SUM(`warehouse_stock`.`ws_quantity`) as `actual_qty`
        from(
            
           `product`, `warehouse_stock`
        ) 
        WHERE (`warehouse_stock`.`warehouse_id` =".$ws_id.") and (`warehouse_stock`.`ws_product_id` = `product`.`product_id`)
         GROUP BY `product`.`product_id`";
        
        return $this->db->query($query)->result_array();
    }
    public function update_pos($id, $data)
    {
        $this->db->update('pos', $data, array('pos_ws_id' => $id));
        
    }
    public function add_pos($model)
    {
        $this->db->insert('pos', $model);    
        return $this->db->insert_id();    
    }
    public function get_pos()
    {
        $this->db->order_by('pos_name', 'asc');
        return $this->db->get('pos')->result_array();
    }

}

/* End of file pos_model.php */
