<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pos_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

public function get_product_sold()
{
	$sql = "SELECT 
	`product`.`product_code` as `pcode`,
	`product`.`product_name` as `pname`,
	SUM(`product_in_invoice`.`pi_quantity`) as `quantity`
	FROM `product`, `product_in_invoice`
	WHERE `product`.`product_id` = `product_in_invoice`.`pi_product_id`
	 GROUP BY
	 `product_in_invoice`.`pi_product_id`
	 ORDER BY
	SUM(`product_in_invoice`.`pi_quantity`) DESC";
	 $query = $this->db->query($sql);	 
	 return $query->result_array();
	 
}
	public function get_pos_sales()
	{
		$sql = "SELECT 
		`pos`.`pos_name` as `pos`,
		SUM(`inv_total_amount`) as `sales`
		FROM `invoice`, `pos`
		WHERE `invoice`.`inv_pos_id` = `pos`.`pos_ws_id` AND  month(`inv_datetime`) = month(NOW()) 
		 GROUP BY
		 `invoice`.`inv_pos_id`";
		$query = $this->db->query($sql);

		return $query->result_array();
	}
	public function get_global_sales()
	{
		$sql = "SELECT 
		MONTHNAME(`inv_datetime`) as `month_name`,
		SUM(`inv_total_amount`) as `sales`
		FROM `invoice`
		WHERE year(`inv_datetime`) = year(NOW()) 
		 GROUP BY
		 MONTHNAME(`inv_datetime`)";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function get_list_refunds_admin()
	{
		$sql = "SELECT 
		`pos`.`pos_name` as `pos`,
		`invoice`.`invoice_id` as `inv_id`,
		`invoice`.`transaction_type` as `type`,
		`invoice`.`inv_total_amount` as `amount`,
		`invoice`.`devise` as `devise`,
		`invoice`.`status` as `status`,
		`invoice`.`inv_datetime` as `date`
		 FROM (`pos`, `invoice`) 
		 WHERE (`pos`.`pos_ws_id` = `invoice`.`inv_pos_id`) 
		 and `invoice`.`invoice_id` in (SELECT `ref_inv_id` FROM `refund_invoice`)
		 ORDER BY `invoice`.`inv_datetime` DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function get_list_refunds($pos_id)
	{
		$sql = "SELECT 
		`pos`.`pos_name` as `pos`,
		`invoice`.`invoice_id` as `inv_id`,
		`invoice`.`transaction_type` as `type`,
		`invoice`.`inv_total_amount` as `amount`,
		`invoice`.`devise` as `devise`,
		`invoice`.`status` as `status`,
		`invoice`.`inv_datetime` as `date`
		 FROM (`pos`, `invoice`) 
		 WHERE (`pos`.`pos_ws_id` = `invoice`.`inv_pos_id`) 
		 and (`invoice`.`inv_pos_id` =" . $pos_id . ")
		 and `invoice`.`invoice_id` in (SELECT `ref_inv_id` FROM `refund_invoice`)
		 ORDER BY `invoice`.`inv_datetime` DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function is_refund_exist($invoice_id)
	{
		$this->db->where('ref_inv_id', $invoice_id);
		$query = $this->db->get('refund_invoice');
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function add_refund($model)
	{
		$this->db->insert('refund_invoice', $model);
	}
	public function get_refund_byID($invoice_id)
	{
		$this->db->where('ref_inv_id', $invoice_id);
		$query = $this->db->get('refund_invoice');
		return $query->row_array();
	}
	public function get_inv_byID($invoice_id)
	{
		$this->db->where('invoice_id', $invoice_id);
		$query = $this->db->get('invoice');
		return $query->row_array();
	}
	public function get_inv_details($inv_id)
	{
		$sql = "SELECT 
		`product`.`product_id` as  `id`,
		`product`.`product_name` as `pname`,
		`product`.`unit_price` as `uprice`,
		`product_in_invoice`.`pi_quantity` as `quantity`,
		`product_in_invoice`.`pi_invoice_id` as `pi_invoice_id`, 
		(`product`.`unit_price` * `product_in_invoice`.`pi_quantity`) as `total`
		 FROM (`product`, `product_in_invoice`) 
		 WHERE (`product`.`product_id` = `product_in_invoice`.`pi_product_id`) and (`product_in_invoice`.`pi_invoice_id` =" . $inv_id . ")
		 and `product`.`product_id` IN ( SELECT `product_in_invoice`.`pi_product_id` FROM `product_in_invoice` WHERE `product_in_invoice`.`pi_invoice_id` =" . $inv_id . ")
		 ";
		$query = $this->db->query($sql);

		return $query->result_array();
	}
	public function get_list_invoices($pos_id)
	{
		$sql = "SELECT 
		`pos`.`pos_name` as `pos`,
		`invoice`.`invoice_id` as `inv_id`,
		`invoice`.`transaction_type` as `type`,
		`invoice`.`inv_total_amount` as `amount`,
		`invoice`.`inv_datetime` as `date`
		 FROM (`pos`, `invoice`) 
		 WHERE (`pos`.`pos_ws_id` = `invoice`.`inv_pos_id`) 
		 and (`invoice`.`inv_pos_id` =" . $pos_id . ")
		 ORDER BY `invoice`.`inv_datetime` DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function add_prods_in_invoice($model)
	{
		$this->db->insert('product_in_invoice', $model);
	}
	public function add_invoice($model)
	{
		$this->db->insert('invoice', $model);
		return $this->db->insert_id();
	}
	public function get_critical_stock_pos($pos_id)
	{
		$sql = "select
		`product`.`product_id` AS `pid`,
		`product`.`product_code` AS `pcode`,
		`product`.`product_name` AS `pname`,
		`product`.`product_uom` AS `uom`,
		`product`.`min_qty` AS `min_qty`,
		`warehouse_stock`.`ws_quantity` AS `actual_quantity`
	  from
		(
		  `product`
		  ,`warehouse_stock`
		)
	  where
		(
		  (
			`product`.`product_id` = `warehouse_stock`.`ws_product_id`
		  )
		  AND `warehouse_stock`.`warehouse_id` =" . $pos_id . "
		  and (
			`product`.`min_qty` = `warehouse_stock`.`ws_quantity`
		  )
		)
		ORDER BY
		`product`.`product_name`";
		$query = $this->db->query($sql);

		return $query->result_array();
	}
	public function count_critical_stock_pos($pos_id)
	{
		$sql = "
		select
		
		  SUM(`warehouse_stock`.`ws_product_id`) AS `total`
		  
		from
		  `warehouse_stock` join `product`
		  WHERE
		  (
			`product`.`product_id` = `warehouse_stock`.`ws_product_id` AND
			`warehouse_stock`.`warehouse_id` =" . $pos_id . "
			
			and (
			  `product`.`min_qty` = `warehouse_stock`.`ws_quantity`
			)
		  )
		  GROUP BY
		  `warehouse_stock`.`ws_product_id`";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	public function get_daily_sales($pos_id)
	{

		//retirer le taux
		$rate  = $this->db->get('currency_rate')->row_array();


		$sql = "SELECT SUM(`inv_total_amount`) as `total`
		FROM `invoice`
		 WHERE `inv_pos_id` =" . $pos_id . " and status = 1 AND DAY(inv_datetime) = DAY(NOW())";
		$usd = $this->db->query($sql);
		$sales_usd = $usd->row_array();

		/*$sql2 = "SELECT SUM(`inv_total_amount`) as `total`
		FROM `invoice`
		 WHERE `inv_pos_id` =".$pos_id." and status = 1 AND DATE(inv_datetime) ='".$date."'"." and devise= 'CDF'";
		 $cdf = $this->db->query($sql2); 
		 $sales_cdf = $usd->row_array();*/
		return $sales_usd['total'];
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
	public function get_list_stock_by_wsID($code, $ws_id)
	{
		$query = null;
		if ($code != 1) {
			$query = "SELECT 
			`product`.`product_id` as `pid`,
			`product`.`product_code` as `pcode`,
			`product`.`product_name` as `pname`,
			`product`.`product_uom` as `uom`,
			`product`.`min_qty` as `min_qty`,
			`product`.`unit_price` as `price`,
			`product`.`product_currency` as `currency`,
			SUM(`warehouse_stock`.`ws_quantity`) as `actual_qty`
			from(  
			   `product`, `warehouse_stock`
			) 
			WHERE (`warehouse_stock`.`warehouse_id` =" . $ws_id . ") and (`warehouse_stock`.`ws_product_id` = `product`.`product_id`) and (product.product_code LIKE '$code%' OR product.product_name LIKE '$code%')
			 GROUP BY `product`.`product_id`";
		} else {
			$query = "SELECT 
        `product`.`product_id` as `pid`,
        `product`.`product_code` as `pcode`,
        `product`.`product_name` as `pname`,
        `product`.`product_uom` as `uom`,
        `product`.`min_qty` as `min_qty`,
		`product`.`unit_price` as `price`,
		`product`.`product_currency` as `currency`,
        SUM(`warehouse_stock`.`ws_quantity`) as `actual_qty`
        from(  
           `product`, `warehouse_stock`
        ) 
        WHERE (`warehouse_stock`.`warehouse_id` =" . $ws_id . ") and (`warehouse_stock`.`ws_product_id` = `product`.`product_id`)
         GROUP BY `product`.`product_id` LIMIT 0,50";
		}
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
	function pourcentage($Nombre, $Total)
	{
		return $Nombre * 100 / $Total;
	}
	public function get_pos_by_userID($user_id)
	{

		$query = $this->db->where('user_id', $user_id);
		$query = $this->db->get('user_pos');
		return $query->row_array();
	}
	public function get_pos_byID($pos_id)
	{
		$this->db->where('pos_ws_id', $pos_id);
		$query = $this->db->get('pos');

		return $query->row_array();
	}
	public function get_users_pos()
	{
		$sql = 'SELECT `users`.`username` as `username`, `pos`.`pos_name` as `pos_name`
				from (`users`, `pos`, `user_pos`)
				where(`users`.`id`=`user_pos`.`user_id`) and(`pos`.`pos_ws_id`=`user_pos`.`pos_id`)';
		return $this->db->query($sql)->result_array();
	}
	//QTY POS UPDATE INVOICE
	public function update_qty_pos($prid, $posid, $data)
	{
		$this->db->update('warehouse_stock', $data, array('ws_product_id' => $prid, 'warehouse_id' => $posid));
	}
	//get rate
	public function get_rate()
	{
		$query = $this->db->query("SELECT * FROM `currency_rate`");
		$row = $query->row();
		if (isset($row)) {
			return $row->rate;
		}
	}
	public function get_store_information()
	{
		$sql = "SELECT *FROM store_information";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function get_count_in()
	{
		return $this->db->count_all('invoice');
	}
}

/* End of file pos_model.php */
