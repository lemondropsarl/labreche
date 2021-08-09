<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Product extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('nav_model');
		$this->load->model('product_model');
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
	}
	public function list()
	{
		$data['user_groups']           =   $this->ion_auth->get_users_groups()->result();
		$data['user_permissions']      =   $this->ion_auth_acl->build_Acl();
		$data['menus']			  	   =   $this->nav_model->get_nav_menus();
		$data['subs']				   =   $data['menus'];
		$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
		$data['title']					=  'Articles';
		$data['products']               = $this->product_model->get_all_products();
		$data['categories']               = $this->product_model->get_categories();
		//$data['count_p_moteur']			= $this->product_model->count_by_engine();
		# code...
		$this->load->view('templates/header', $data);
		$this->load->view('list_product', $data);
		$this->load->view('templates/footer');
	}
	public function create()
	{
		$data['user_groups']           =   $this->ion_auth->get_users_groups()->result();
		$data['user_permissions']      =   $this->ion_auth_acl->build_Acl();
		$data['menus']			  	   =   $this->nav_model->get_nav_menus();
		$data['subs']				   =   $data['menus'];
		$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
		$data['title']					=  'Articles';
		//get categories and vehicules for dropdown list
		$data['categories'] = $this->product_model->get_categories();
		$data['vehicules'] = $this->product_model->get_vehicules();
		$data['uoms'] = $this->product_model->get_uoms();
		# code...
		# code...
		$this->load->view('templates/header', $data);
		$this->load->view('create_product', $data);
		$this->load->view('templates/footer');
	}
	public function create_operation()
	{

		# code...
		$model = array(
			'product_code' => $this->input->get('pcode'), // $this->input->post('pcode'),
			'product_name' => strtoupper($this->input->get('pname')),
			'product_brand' => strtoupper($this->input->get('pbrand')),
			'product_model' => strtoupper($this->input->get('pmodel')),
			'unit_price' => $this->input->get('price'),
			'product_uom' => $this->input->get('prUnite'),
			'min_qty'	=> $this->input->get('pmin_qty'),
			
			'product_currency' => $this->input->get('pcurrency'),
			'product_status' => 1,
			'product_cat_id' => $this->input->get('pcat_id'), // $this->input->get('pcat_id'),
			'product_vehicule_id' => $this->input->get('vehicule')

		);

		$this->product_model->add_product($model);

		//redirect('product/list', 'refresh');
	}

	
	public function details()
	{
		$data['user_groups']           =   $this->ion_auth->get_users_groups()->result();
		$data['user_permissions']      =   $this->ion_auth_acl->build_Acl();
		$data['menus']			  	   =   $this->nav_model->get_nav_menus();
		$data['subs']				   =   $data['menus'];
		$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
		$data['title']					=  'Article!Détail';
		
		# code...
		$this->load->view('templates/header',$data);
		$this->load->view('detail_product',$data);
		$this->load->view('templates/footer');
	}
	public function search()
	{
		# code...
		$code = $this->input->get('id');
		$products = $this->product_model->get_product_like($code);
		
			foreach ($products as $item) {
				# code...
				?>

				<tr data-product_id="<?php echo $item['product_id']; ?>">
					<td class="cel-product" data-type_cel="code" data-valeur="<?php echo $item['product_code']; ?>"><?php echo $item['product_code']; ?></td>
					<td class="cel-product" data-type_cel="name" data-valeur="<?php echo $item['product_name']; ?>"><?php echo $item['product_name']; ?></td>
					<td class="cel-product" data-type_cel="brand" data-valeur="<?php echo $item['product_brand']; ?>"><?php echo $item['product_brand']; ?></td>
					<td class="cel-product" data-type_cel="model" data-valeur="<?php echo $item['product_model']; ?>"><?php echo $item['product_model']; ?></td>
					<td class="cel-product" data-type_cel="uom" data-valeur="<?php echo $item['product_uom']; ?>"><?php echo $item['product_uom']; ?></td>
					<td class="cel-product" data-type_cel="price" data-valeur="<?php echo $item['unit_price']; ?>"><?php echo $item['unit_price']; ?></td>
					<td class="cel-product" data-type_cel="currency" data-valeur="<?php echo $item['product_currency']; ?>"><?php echo $item['product_currency']; ?></td>
				</tr>
			<?php	
			}
		
	}
	public function search_by_cat()
	{
		# code...
		$code = $this->input->get('id');
		$products = $this->product_model->get_product_by_cat($code);
		foreach ($products as $item) {
		?>
			<tr data-product_id="<?php echo $item['product_id']; ?>">
				<td class="cel-product" data-type_cel="code" data-valeur="<?php echo $item['product_code']; ?>"><?php echo $item['product_code']; ?></td>
				<td class="cel-product" data-type_cel="name" data-valeur="<?php echo $item['product_name']; ?>"><?php echo $item['product_name']; ?></td>
				<td class="cel-product" data-type_cel="brand" data-valeur="<?php echo $item['product_brand']; ?>"><?php echo $item['product_brand']; ?></td>
				<td class="cel-product" data-type_cel="model" data-valeur="<?php echo $item['product_model']; ?>"><?php echo $item['product_model']; ?></td>
				<td class="cel-product" data-type_cel="uom" data-valeur="<?php echo $item['product_uom']; ?>"><?php echo $item['product_uom']; ?></td>
				<td class="cel-product" data-type_cel="price" data-valeur="<?php echo $item['unit_price']; ?>"><?php echo $item['unit_price']; ?></td>
				<td class="cel-product" data-type_cel="currency" data-valeur="<?php echo $item['product_currency']; ?>"><?php echo $item['product_currency']; ?></td>
			</tr>
		<?php
		}
	}
	public function list_product()
	{		# code...
		$products = $this->product_model->get_all_products();


		foreach ($products as $item) {
		?>
			<tr data-product_id="<?php echo $item['product_id']; ?>">
				<td class="cel-product" data-type_cel="code" data-valeur="<?php echo $item['product_code']; ?>"><?php echo $item['product_code']; ?></td>
				<td class="cel-product" data-type_cel="name" data-valeur="<?php echo $item['product_name']; ?>"><?php echo $item['product_name']; ?></td>
				<td class="cel-product" data-type_cel="brand" data-valeur="<?php echo $item['product_brand']; ?>"><?php echo $item['product_brand']; ?></td>
				<td class="cel-product" data-type_cel="model" data-valeur="<?php echo $item['product_model']; ?>"><?php echo $item['product_model']; ?></td>
				<td class="cel-product" data-type_cel="uom" data-valeur="<?php echo $item['product_uom']; ?>"><?php echo $item['product_uom']; ?></td>
				<td class="cel-product" data-type_cel="price" data-valeur="<?php echo $item['unit_price']; ?>"><?php echo $item['unit_price']; ?></td>
				<td class="cel-product" data-type_cel="currency" data-valeur="<?php echo $item['product_currency']; ?>"><?php echo $item['product_currency']; ?></td>
			</tr>
<?php
		}
	}
	public function create_category()
	{
		$model = array(
			'cat_name' => strtoupper($this->input->get('cat_name')),
			'cat_description' => $this->input->get('cat_description')
		);
		$this->product_model->add_category($model);

		//redirect('product/create', 'refresh');
	}
	public function create_vehicule()
	{
		$model = array(
			'vehicule_brand' => strtoupper($this->input->get('vehicule_brand'))
			
		);
		$this->product_model->add_vehicule($model);

		//redirect('product/create', 'refresh');
	}
	public function update_product()
	{
		$type = $this->input->get('type');
		$valeur = $this->input->get('valeur');
		$id = $this->input->get('product_id');
		switch ($type) {
			case 'code':
				$this->product_model->update_product($id, array('product_code' => $valeur));
				break;
			case 'name':
				$this->product_model->update_product($id, array('product_name' => $valeur));
				break;
			case 'brand':
				$this->product_model->update_product($id, array('product_brand' => $valeur));
				break;
			case 'model':
				$this->product_model->update_product($id, array('product_model' => $valeur));
				break;
			case 'uom':
				$this->product_model->update_product($id, array('product_uom' => $valeur));
				break;
			case 'price':
				$this->product_model->update_product($id, array('unit_price' => $valeur));
				break;
			case 'currency':
				$this->product_model->update_product($id, array('product_currency' => $valeur));
				break;
		}
	}
	
}

/* End of file filename.php */
