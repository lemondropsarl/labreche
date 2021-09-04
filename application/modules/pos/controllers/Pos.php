<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pos extends MX_Controller
{
	private $posID;
	private $rate;

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
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}

		$user_id 	= $this->session->userdata('user_id');
		$query =  $this->pos_model->get_pos_by_userID($user_id);
		if (!$query) {
			$this->posID = 1;
		} else {
			$this->posID = $query['pos_id'];
		}



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

	public function approve_refund()
	{
		// c'est ici qu'il faut faire le reverse de la facture

	}
	public function list_refund()
	{
		$data['user_groups']           =   $this->ion_auth->get_users_groups()->result();
		$data['user_permissions']      =   $this->ion_auth_acl->build_Acl();
		$data['menus']			  	   =   $this->nav_model->get_nav_menus();
		$data['subs']				   =   $data['menus'];
		$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
		$data['title']					=  'Remboursement facture';
		if ($this->ion_auth_acl->has_permission('A')) {
		$data['invoices']				= $this->pos_model->get_list_refunds_admin();
		}else {
			
			$data['invoices']				= $this->pos_model->get_list_refunds($this->posID);
		}
		$this->load->view('templates/header', $data);
		$this->load->view('list_refund', $data);
		$this->load->view('templates/footer');
	}
	public function create_refund()
	{
		$invoice_id = $this->uri->segment(3);
		if ($this->pos_model->is_refund_exist($invoice_id) != true) {
			# code...
			$model = array('ref_inv_id' => $invoice_id );
			$this->pos_model->add_refund($model);
			
			redirect('pos/list_invoice','refresh');
		}else{
			
			redirect('pos/detail_invoice/'.$invoice_id);
			
		}
		
		
	}
	public function detail_invoice()
	{
		$invoice_id = $this->uri->segment(3);
		$data['user_groups']           =   $this->ion_auth->get_users_groups()->result();
		$data['user_permissions']      =   $this->ion_auth_acl->build_Acl();
		$data['menus']			  	   =   $this->nav_model->get_nav_menus();
		$data['subs']				   =   $data['menus'];
		$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
		$data['title']					=  'détails facture';
		$data['inv_details']			= $this->pos_model->get_inv_details($invoice_id);
		$data['inv']					= $this->pos_model->get_inv_byID($invoice_id);
		$data['invoice_id']				= $invoice_id;
		$data['refund']					= $this->pos_model->get_refund_byID($invoice_id);

		$this->load->view('templates/header', $data);
		$this->load->view('details_invoice', $data);
		$this->load->view('templates/footer');
	
	}
	public function list_invoice()
	{
		$data['user_groups']           =   $this->ion_auth->get_users_groups()->result();
		$data['user_permissions']      =   $this->ion_auth_acl->build_Acl();
		$data['menus']			  	   =   $this->nav_model->get_nav_menus();
		$data['subs']				   =   $data['menus'];
		$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
		$data['title']					=  'Point de vente';
		$data['invoices']				= $this->pos_model->get_list_invoices($this->posID);
		$this->load->view('templates/header', $data);
		$this->load->view('list_invoices', $data);
		$this->load->view('templates/footer');
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
		//$data["product_stock"] = $this->pos_model->get_list_pr_stock();
		$data['product_stock'] = $this->pos_model->get_list_stock_by_wsID(1, $this->posID);
		$data['pos'] = $this->pos_model->get_pos_byID($pos_id);
		$data["rate"] = $this->pos_model->get_rate();
		$data["store_information"] = $this->pos_model->get_store_information();
		$this->load->view('invoicing', $data);
		$this->load->view('templates/footer', $data);
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
		$data['list_stock']           = $this->pos_model->get_list_stock_by_wsID(1, $pos_id);
		$data['value_stock_cdf'] 	= $this->pos_model->get_value_stock_cdf($pos_id);
		$data['value_stock_usd'] 	= $this->pos_model->get_value_stock_usd($pos_id);
		$data['sales']		        = $this->pos_model->get_daily_sales($pos_id);
		$data['count_critical']		= $this->pos_model->count_critical_stock_pos($pos_id);

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

		$user_id 	= $this->session->userdata('user_id');
		$pos_id = $this->posID;
		$commandes = $this->input->get('commandes'); //commandes
		$totaux = $this->input->get('totaux'); //totaux
		$vat = $totaux * 0.16;
		$devise =  $this->input->get('devise'); //devise
		$discount_amount =  $this->input->get('discount_amount'); //devise
		$type_facture=$this->input->get('type_facture');//type facture
		$invoice_id = $this->pos_model->add_invoice(array(
			"inv_pos_id" => $pos_id,
			"inv_total_amount" => $totaux,
			"inv_discount_amount" => $discount_amount,
			"devise" => $devise,
			"inv_vat_amount" => $vat,
			"user_id" => $user_id,
			"transaction_type"=>$type_facture

		));
		foreach ($commandes as $commande) {
			$model = array(
				'pi_invoice_id' => $invoice_id,
				'pi_product_id' => $commande["prId"],
				'pi_quantity' => (int)$commande["prQty"]
			);
			/////////
			$this->pos_model->add_prods_in_invoice($model);
			$this->pos_model->update_qty_pos($commande["prId"], $pos_id, array('ws_quantity' => (int)$commande["qty_new"])); //invoice


		}
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
	public function count_invoice()
	{
		echo $this->pos_model->get_count_in();
	}
}

/* End of file Pos.php */
