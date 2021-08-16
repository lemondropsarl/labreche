<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pos extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('nav_model');
		$this->load->model('product/product_model');
		$this->load->model('warehouse/warehouse_model');
		$this->load->model('pos_model');

		$this->load->helper('url');
		$this->load->helper('path');
		$this->load->helper('form');
		$this->load->helper('mainpage_helper');
		$this->load->library('form_validation');
		$this->load->library('ion_auth');
		$this->load->library('ion_auth_acl');


		$siteLang = $this->session->userdata('site_lang');
		if ($siteLang) {

			$this->lang->load('main', $siteLang);
			$this->lang->load('ion_auth', $siteLang);
		} else {

			$this->lang->load('main', 'french');
			$this->lang->load('ion_auth', 'french');
		}
		//Do your magic here
	}


	public function invoicing()
	{

		$data["product_stock"] = $this->pos_model->get_list_pr_stock();
		$this->load->view('invoicing', $data);
		$this->load->view('templates/footer');
	}
	public function check()
	{
		$pos_id = 1; //find a way to get the warehouse_id
		# code...
		$data['user_groups']           =   $this->ion_auth->get_users_groups()->result();
		$data['user_permissions']      =   $this->ion_auth_acl->build_Acl();
		$data['menus']			  	   =   $this->nav_model->get_nav_menus();
		$data['subs']				   =   $data['menus'];
		$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
		$data['title']					=  'Point de vente';
		$data['pos']             		= $this->pos_model->get_pos();
		$data['list_stock']           = $this->pos_model->get_list_stock_by_wsID($pos_id);
		$data['value_stock_cdf'] 	= $this->pos_model->get_value_stock_cdf($pos_id);
		$data['value_stock_usd'] 	= $this->pos_model->get_value_stock_usd($pos_id);

		//$data['count_p_moteur']			= $this->product_model->count_by_engine();
		# code...
		$this->load->view('templates/header', $data);
		$this->load->view('browse_pos', $data);
		$this->load->view('templates/footer');
	}
	public function search_code_name_fac()
	{
		$code = strtoupper($this->input->get('code'));
		$product_stock = $this->pos_model->get_list_pr_stock_by_id($code);
		foreach ($product_stock as $items) {
?>
			<tr class="ligne_pr_fact_search pointer_hover" data-pr_id="<?php echo $items['product_id']; ?>" data-pr_code="<?php echo $items['product_code']; ?>" data-pr_name="<?php echo $items['product_name']; ?>" data-pr_price="<?php echo $items['unit_price']; ?>" data-pr_qty="<?php echo $items['lus_quantity']; ?>" data-pr_devise="<?php echo $items['product_currency']; ?>">
				<td><?php echo $items['product_code']; ?></td>
				<td><?php echo $items['product_name']; ?></td>
				<td><?php echo $items['unit_price'] . " " . $items["product_currency"]; ?></td>
				<td class="ligne_pr_fact_search<?php echo $items['product_id']; ?>"><?php echo $items['lus_quantity']; ?></td>
				<td><a href="#" target="#" rel="noopener noreferrer"><i class="fas fa-plus"></i></a></td>
			</tr>
		<?php
		}
	}
	public function refresh_list_pr_stock()
	{
		$product_stock = $this->pos_model->get_list_pr_stock();
		foreach ($product_stock as $items) {
		?>
			<tr class="ligne_pr_fact_search pointer_hover" data-pr_id="<?php echo $items['product_id']; ?>" data-pr_code="<?php echo $items['product_code']; ?>" data-pr_name="<?php echo $items['product_name']; ?>" data-pr_price="<?php echo $items['unit_price']; ?>" data-pr_qty="<?php echo $items['lus_quantity'];  ?>" data-pr_devise="<?php echo $items['product_currency']; ?>">
				<td><?php echo $items['product_code']; ?></td>
				<td><?php echo $items['product_name']; ?></td>
				<td><?php echo $items['unit_price'] . " " . $items["product_currency"]; ?></td>
				<td class="ligne_pr_fact_search<?php echo $items['product_id']; ?>"><?php echo $items['lus_quantity']; ?></td>
				<td><a href="#" target="#" rel="noopener noreferrer"><i class="fas fa-plus"></i></a></td>
			</tr>
<?php
		}
	}
	//pourcentage

	public function create_invoice()
	{
		//"prId": prId,
		//"prCode": prCode,
		//"prQty": prQty
		$commandes = $this->input->get('commandes'); //commandes
		$totaux = $this->input->get('totaux'); //totaux

		$this->pos_model->add_invoice(array(
			"inv_pos_id" => 1,
			"inv_total_amount" => $totaux,
			"inv_discount_amount" => 0,
			"inv_vat_amount" => ($totaux) + ($this->pos_model->pourcentage(16, $totaux)),
			"user_id" => 1

		));
		foreach ($commandes as $commande) {
			$model = array(
				'pi_invoice_id' => 0,
				'pi_product_id' => $commande["prId"],
				'pi_quantity' => (int)$commande["prQty"]
			);

			$this->pos_model->add_prods_in_invoice($model);
		}
		echo '';
	}
}

/* End of file Pos.php */
