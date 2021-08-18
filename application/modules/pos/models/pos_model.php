<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pos_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function add_prods_in_invoice($model)
	{
		$this->db->insert('product_in_invoice',$model);
      
	}
	public function add_invoice($model)
	{
		$this->db->insert('invoice',$model);	
	}
	public function get_critical_stock($pos_id)
	{
		# code...
	}
	public function get_daily_sales($pos_id)
	{
	}
	public function get_list_pr_stock()
	{
		$sql = "SELECT *FROM product INNER JOIN last_update_stock ON product.product_id=last_update_stock.lus_product_id";
		$query = $this->db->query($sql);

		return $query->result_array();
	}
	public function get_list_pr_stock_by_id($code)
	{
		$sql = "SELECT *FROM product INNER JOIN last_update_stock ON product.product_id=last_update_stock.lus_product_id WHERE product.product_code LIKE '$code%' OR product.product_name LIKE '$code%'";
		$query = $this->db->query($sql);

		return $query->result_array();
	}
	public function get_value_stock_usd($pos_id)
	{
		$sql = "select SUM(`Result`) as total
		FROM(
		SELECT
			 SUM(`product`.`unit_price` * `warehouse_stock`.`ws_quantity`) as Result
			from (`product`,`warehouse_stock`)
		WHERE (`product`.`product_id` = `warehouse_stock`.`ws_product_id`) and (`product`.`product_currency` = 'USD')
      AND (`warehouse_stock`.`warehouse_id` =" . $pos_id . ")
		group By (`product`.`product_id`)
		) as T";

		$query = $this->db->query($sql);

		return $query->row_array();
	}
	public function get_value_stock_cdf($pos_id)
	{
		$sql = "select SUM(`Result`) as total
		FROM(
		SELECT
			 SUM(`product`.`unit_price` * `warehouse_stock`.`ws_quantity`) as Result
			from (`product`,`warehouse_stock`)
		WHERE (`product`.`product_id` = `warehouse_stock`.`ws_product_id`) and (`product`.`product_currency` = 'CDF')
      AND (`warehouse_stock`.`warehouse_id` =" . $pos_id . ")
		group By (`product`.`product_id`)
		) as T";

		$query = $this->db->query($sql);

		return $query->row_array();
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
        WHERE (`warehouse_stock`.`warehouse_id` =" . $ws_id . ") and (`warehouse_stock`.`ws_product_id` = `product`.`product_id`)
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
	//poucentage calcule
	function pourcentage($Nombre, $Total) {
		return $Nombre * 100 / $Total;
	}
	public function get_pos_by_userID($user_id)
    {
		
		$query =$this->db->where('user_id', $user_id);
        $query = $this->db->get('user_pos');
        return $query->row_array();    
    }
	public function get_pos_byID($pos_id)
	{
		$this->db->where('pos_ws_id', $pos_id);
		$query =$this->db->get('pos');
		
		return $query->row_array();	
	}
	public function get_users_pos()
	{
		$sql = 'SELECT `users`.`username` as `username`, `pos`.`pos_name` as `pos_name`
				from (`users`, `pos`, `user_pos`)
				where(`users`.`id`=`user_pos`.`user_id`) and(`pos`.`pos_ws_id`=`user_pos`.`pos_id`)';
		return $this->db->query($sql)->result_array();
	}
}

/* End of file pos_model.php */
