<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pos extends MX_Controller
{
	private $posID;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('nav_model');
		$this->load->model('product/product_model');
		$this->load->model('warehouse/warehouse_model');
		$this->load->model('setting/setting_model');

		$this->load->model('pos_model');

		$this->load->helper('url');
		$this->load->helper('path');
		$this->load->helper('form');
		$this->load->helper('mainpage_helper');
		$this->load->library('form_validation');
		$this->load->library('ion_auth');
		$this->load->library('ion_auth_acl');

		$user_id 	= $this->session->userdata('user_id');
		$query =  $this->pos_model->get_pos_by_userID($user_id);
		$this->posID = $query['pos_id'];


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
		$pos_id = $this->posID;
		if (!$this->posID) {
			# code...
			$pos_id = 1; //find a way to get the warehouse_id
		} else {
			$pos_id = $this->posID;
		}

		// il faut utiliser la deuxieme fonction pour avoir la bonne liste de stock par POS
		//reference POs_model
		$data["product_stock"] = $this->pos_model->get_list_pr_stock();
		//$data['product_stock'] = $this->pos_model->get_list_stock_by_wsID($this->posID);
		$data['pos'] = $this->pos_model->get_pos_byID($pos_id);
		$this->load->view('invoicing', $data);
		$this->load->view('templates/footer');
	}
	public function check()
	{
		$pos_id = $this->posID;
		if (!$this->posID) {
			# code...
			$pos_id = 1; //find a way to get the warehouse_id
		} else {
			$pos_id = $this->posID;
		}
		# code...
		$data['user_groups']           =   $this->ion_auth->get_users_groups()->result();
		$data['user_permissions']      =   $this->ion_auth_acl->build_Acl();
		$data['menus']			  	   =   $this->nav_model->get_nav_menus();
		$data['subs']				   =   $data['menus'];
		$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
		$data['title']					=  'Point de vente';
		$data['pos']             		= $this->pos_model->get_pos();
		//	$data['list_stock']           = $this->pos_model->get_list_stock_by_wsID($pos_id);
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
		$pos_id = $this->posID;
		$code = strtoupper($this->input->get('code'));
		$product_stock = $this->pos_model->get_list_stock_by_wsID($code, $pos_id);

		foreach ($product_stock as $items) {
?>
			<tr class="ligne_pr_fact_search pointer_hover" data-pr_id="<?php echo $items['pid']; ?>" data-pr_code="<?php echo $items['pcode']; ?>" data-pr_name="<?php echo $items['pname']; ?>" data-pr_price="<?php echo $items['price']; ?>" data-pr_qty="<?php echo $items['actual_qty'];  ?>" data-pr_devise="<?php echo $items['currency']; ?>">
				<td><?php echo $items['pcode']; ?></td>
				<td><?php echo $items['pname']; ?></td>
				<td><?php echo $items['price'] . " " . $items["currency"]; ?></td>
				<td class="ligne_pr_fact_search<?php echo $items['pid']; ?>"><?php echo $items['actual_qty']; ?></td>
				<td><a href="#" target="#" rel="noopener noreferrer"><i class="fas fa-plus"></i></a></td>
			</tr>
		<?php
		}
	}
	public function refresh_list_pr_stock()
	{
		$pos_id = $this->posID;
		$product_stock = $this->pos_model->get_list_stock_by_wsID(1, $pos_id);
		foreach ($product_stock as $items) {
		?>
			<tr class="ligne_pr_fact_search pointer_hover" data-pr_id="<?php echo $items['pid']; ?>" data-pr_code="<?php echo $items['pcode']; ?>" data-pr_name="<?php echo $items['pname']; ?>" data-pr_price="<?php echo $items['price']; ?>" data-pr_qty="<?php echo $items['actual_qty'];  ?>" data-pr_devise="<?php echo $items['currency']; ?>">
				<td><?php echo $items['pcode']; ?></td>
				<td><?php echo $items['pname']; ?></td>
				<td><?php echo $items['price'] . " " . $items["currency"]; ?></td>
				<td class="ligne_pr_fact_search<?php echo $items['pid']; ?>"><?php echo $items['actual_qty']; ?></td>
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
	public function create_pos()
	{
		$pos_id = $this->input->post('pos_id');
		$pos_name = $this->input->post('pos_name');
		$pos_address = $this->input->post('pos_address');

		$model = array(
			'pos_ws_id' => $pos_id,
			'pos_name' => $pos_name,
			'pos_address' => $pos_address

		);
		$this->pos_model->add_pos($model);

		redirect('setting/index', 'refresh');
	}
	public function assign_user_pos()
	{
		$pos_id 	=  $this->input->post('pos');
		$user_id	= $this->input->post('user');
		//must check if exist update or add
		$model = array(
			'user_id' => $user_id,
			'pos_id'	=> $pos_id
		);
		$this->setting_model->add_user_pos($model);

		redirect('setting/index', 'refresh');
	}
	public function get_posID_session()
	{
		# code...
	}
}

/* End of file Pos.php */
