<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Warehouse_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function get_stock_value_usd()
	{
		$sql = 'select SUM(`Result`) as total
		FROM(
		SELECT
			 SUM(`product`.`unit_price` * `last_update_stock`.`lus_quantity`) as Result
			from (`product`,`last_update_stock`)
		WHERE (`product`.`product_id` = `last_update_stock`.`lus_product_id`) and (`product`.`product_currency` = "USD")
		group By (`product`.`product_id`)
		) as T';

		$query = $this->db->query($sql);
		
		return $query->row_array();
	}


	public function count_stock()
	{
		 return $this->db->count_all('last_update_stock');
		
	}
	public function get_list_of_stock()
	{
		$query = $this->db->get('list_of_stock_view');
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

		$this->db->where('lus_product_id', $pid);
		$query = $this->db->get('last_update_stock');
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	/////////
	public function get_qty_prodID($pid)
	{
		$query = $this->db->select('lus_quantity');
		$query = $this->db->from('last_update_stock');
		$query = $this->db->where('lus_product_id', $pid);
		$query = $this->db->get();
		return $query->row_array();
	}
	//////////

	public function update_lus($id, $model)
	{
		$this->db->update('last_update_stock', $model, array("lus_product_id" => $id));
	}
	//get categories list
public function get_products()
	{
		$sql="SELECT * FROM product LEFT JOIN last_update_stock  
		ON product.product_id=last_update_stock.lus_product_id WHERE last_update_stock.lus_product_id IS NULL";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function get_products_like($code){
		$query = "SELECT * FROM product LEFT JOIN last_update_stock  
		ON product.product_id=last_update_stock.lus_product_id WHERE last_update_stock.lus_product_id IS NULL and product.product_code LIKE" . " " . "'" . $code . "%'";
		return $this->db->query($query)->result_array();
	}
	public function get_entries_out_like($code){
		$query = "SELECT * FROM product LEFT JOIN last_update_stock  
		ON product.product_id=last_update_stock.lus_product_id WHERE product.product_code LIKE" . " " . "'" . $code . "%'";
		return $this->db->query($query)->result_array();
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
		$query = $this->db->get('so_entries_out_view');
		return $query->result_array();	
	}

	//get liste entry stock

	public function get_list_entry($id)
	{
		$query = null;
		if ($id == 0 or $id == null) {
			$query = $this->db->select('*');
			$query = $this->db->from('stock_entries_in');
		$query = $this->db->join('product', 'stock_entries_in.si_product_id=product.product_id');
			$query = $this->db->join('vehicule', 'vehicule.vehicule_id=product.product_vehicule_id');
			$query = $this->db->get();
			return $query->result_array();
		} else {

			$query = "SELECT * FROM product INNER JOIN stock_entries_in ON stock_entries_in.si_product_id=product.product_id where product_code LIKE" . " " . "'" . $id . "%'" . " "
				. "OR product_name LIKE" . " " . "'" . $id . "%'";
			return $this->db->query($query)->result_array();
		}
	}
	public function get_critical_stock_list()
	{
		return $this->db->get('critical_stock_view')->result_array();
		
	}
	public function count_entries_out_daily($date)
	{		
		$this->db->where('so_entry_date', $date);
		return $query = $this->db->get('stock_entries_out')->num_rows();
		
	}
	public function count_critical_stock($var = null)
	{
		return $this->db->count_all('critical_stock_view');
	}
}
