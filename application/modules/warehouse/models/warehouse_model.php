<?php

defined('BASEPATH') or exit('No direct script access allowed');

class warehouse_model extends CI_Model
{


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
       
        $this->db->where('lus_product_id',$pid);
        $query = $this->db->get('last_update_stock');       
		if ($query->num_rows()> 0) {
			return true;
		} else {
			return false;
		}
	}
	public function get_qty_by_prodID($pid)
	{
		$query = $this->db->get('last_update_stock')
			->where('lus_product_id', $pid)
			->select('lus_quantity');

		return $query->row();
	}
	public function update_lus($id, $model)
	{
		$this->db->update('last_update_stock', $model, array("lus_product_id" => $id));
	}
	//get categories list
	public function get_products()
	{

		$query = $this->db->get('product');
		return $query->result_array();
	}
	public function get_warehouses()
	{
		$this->db->order_by('warehouse_name ASC');
		$query = $this->db->get('warehouses');
		return $query->result_array();		
	}
	public function add_warehouse($model)
	{
		$this->db->insert('warehouses', $model);
		return $this->db->insert_id();		
	}
	public function add_entry_out($model)
	{
		$this->db->insert('stock_entries_out', $model);
		
	}
	public function is_ws_stock_exist($pid, $wid)
	{
		$this->db->where('ws_product_id', $pid);
		$this->db->where('warehouse_id', $wid);
		$query = $this->db->get('warehouse_stock');

		if ($query->num_rows() > 0) {
			return true;
		}else{
			return false;
		}	
	}
	public function get_ws_byID($pid,$wid)
	{
		$this->db->where('ws_product_id', $pid);
		$this->db->where('warehouse_id', $wid);
		$query = $this->db->get('warehouse_stock');
		
		return $query->row_array();	
	}
	public function add_warehouse_stock($model)
	{
		$this->db->insert('warehouse_stock', $model);		
	}
	public function update_ws($id,$model)
	{
		$this->db->set('ws_quantity', $model);
		$this->db->where('ws_id', $id);
		$this->db->update('warehouse_stock');
		
	}
	public function get_entries_out()
	{
		$query = $this->db->get('so_entries_view');
		return $query->result_array();	
	}

}
