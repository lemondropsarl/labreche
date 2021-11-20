<?php

defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class Product extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('nav_model');
		$this->load->model('product_model');
		$this->load->model('warehouse/warehouse_model');
		$this->load->model('pos/pos_model');
		$this->load->helper('url');
		$this->load->helper('path');
		$this->load->helper('form');
		$this->load->helper('mainpage_helper');
		$this->load->library('form_validation');
		$this->load->library('ion_auth');
		$this->load->library('ion_auth_acl');
		$config['upload_path'] = './uploads/files/';
        $config['allowed_types'] = 'csv|xlsx';
        $config['max_size']     = '100';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';

        $this->load->library('upload',$config);
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
	}
	public function check_product()
	{
		$pcode = $this->input->get('pcode');
		if ($this->product_model->is_pcode_exist($pcode)) {
			echo "true";
		} else {
			echo "false";
		}
		# code...
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
		$data['vehicules']               = $this->product_model->get_vehicules();
		$data["rate"] = $this->pos_model->get_rate();

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
		$data["rate"] = $this->pos_model->get_rate();
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
		$data["rate"] = $this->pos_model->get_rate();
		$data['title']					=  'Article!Détail';

		# code...
		$this->load->view('templates/header', $data);
		$this->load->view('detail_product', $data);
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

			<tr class='ligne_product' data-product_id="<?php echo $item['product_id']; ?>" data-pr_code="<?php echo $item['product_code']; ?>">
				<td class="cel-product" data-type_cel="code" data-valeur="<?php echo $item['product_code']; ?>"><?php echo $item['product_code']; ?></td>
				<td class="cel-product" data-type_cel="name" data-valeur="<?php echo $item['product_name']; ?>"><?php echo $item['product_name']; ?></td>
				<td class="cel-product" data-type_cel="uom" data-valeur="<?php echo $item['product_uom']; ?>"><?php echo $item['product_uom']; ?></td>
				<td class="cel-product" data-type_cel="price" data-valeur="<?php echo $item['unit_price']; ?>"><?php echo $item['unit_price'].' '.$item['product_currency']; ?></td>
			
			</tr>
		<?php
		}
	}
	public function search_by_id_pr_stock()
	{
		# code...

		$pos_id = $this->posID;
		$id = $this->input->get('id');
		$products = $this->product_model->get_product_by_code_detail($id, $pos_id);
		echo json_encode($products);
	}
	public function search_by_cat()
	{
		# code...
		$code = $this->input->get('id');
		$products = $this->product_model->get_product_by_cat($code);

		foreach ($products as $item) {
		?>
			<tr class='ligne_product' data-product_id="<?php echo $item['product_id']; ?>" data-pr_code="<?php echo $item['product_code']; ?>">
				<td class="cel-product" data-type_cel="code" data-valeur="<?php echo $item['product_code']; ?>"><?php echo $item['product_code']; ?></td>
				<td class="cel-product" data-type_cel="name" data-valeur="<?php echo $item['product_name']; ?>"><?php echo $item['product_name']; ?></td>
				<td class="cel-product" data-type_cel="uom" data-valeur="<?php echo $item['product_uom']; ?>"><?php echo $item['product_uom']; ?></td>
				<td class="cel-product" data-type_cel="price" data-valeur="<?php echo $item['unit_price']; ?>"><?php echo $item['unit_price']." ".$item['product_currency']; ?></td>
			
			</tr>
		<?php
		
		}
	}
	public function search_by_veh()
	{
		# code...
		$code = $this->input->get('id');
		$products = $this->product_model->get_product_by_veh($code);

		foreach ($products as $item) {
		?>
			<tr class='ligne_product' data-product_id="<?php echo $item['product_id']; ?>" data-pr_code="<?php echo $item['product_code']; ?>">
				<td class="cel-product" data-type_cel="code" data-valeur="<?php echo $item['product_code']; ?>"><?php echo $item['product_code']; ?></td>
				<td class="cel-product" data-type_cel="name" data-valeur="<?php echo $item['product_name']; ?>"><?php echo $item['product_name']; ?></td>
				<td class="cel-product" data-type_cel="uom" data-valeur="<?php echo $item['product_uom']; ?>"><?php echo $item['product_uom']; ?></td>
				<td class="cel-product" data-type_cel="price" data-valeur="<?php echo $item['unit_price']; ?>"><?php echo $item['unit_price']." ".$item['product_currency']; ?></td>
			
			</tr>
		<?php
		}
	}
	public function list_product()
	{		# code...
		$products = $this->product_model->get_all_products();


		foreach ($products as $item) {
		?>
			<tr class='ligne_product' data-product_id="<?php echo $item['product_id']; ?>" data-pr_code="<?php echo $item['product_code']; ?>">
				<td class="cel-product" data-type_cel="code" data-valeur="<?php echo $item['product_code']; ?>"><?php echo $item['product_code']; ?></td>
				<td class="cel-product" data-type_cel="name" data-valeur="<?php echo $item['product_name']; ?>"><?php echo $item['product_name']; ?></td>
				<td class="cel-product" data-type_cel="uom" data-valeur="<?php echo $item['product_uom']; ?>"><?php echo $item['product_uom']; ?></td>
				<td class="cel-product" data-type_cel="price" data-valeur="<?php echo $item['unit_price']; ?>"><?php echo $item['unit_price']." ".$item['product_currency']; ?></td>
			
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
	public function add_multiple()
	{
		if ($this->upload->do_upload('exfile')){
           
            $file_name = $this->upload->data('full_path');
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
            $spreadsheet = $reader->load($file_name);

            $sheetWork = $spreadsheet->getActiveSheet();
            $highestRow = $sheetWork->getHighestRow(); // e.g. 10
            $highestColumn = $sheetWork->getHighestColumn(); // e.g 'F'
            $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5
            $added=0;
            
            for ($row=2; $row <= $highestRow ; $row++) { 
                $model = array();
                
                for ($col=1; $col <= $highestColumnIndex ; $col++) { 
                   $model[$col] = $sheetWork->getCellByColumnAndRow($col,$row)->getValue();
                }
                $data = array(
                    'dproduct_code'=> $model[0],
                    'product_name'=> $model[1],
                    'unit_price'=> $model[2],
                    'product_uom'=> $model[3],
                    'product_cat_id'=> intval($model[4]),
                    'product_vehicule_id'=> $model[5]
                );
                
                $added++;
            }           
            //$this->session->set_flashdata('added', strval($added));           
            redirect('product/create_product','refresh');           
        }     
	}
}

/* End of file filename.php */
