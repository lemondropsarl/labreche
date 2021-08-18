<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class setting_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_store_infos()
    {
        $query = $this->db->get('store_information');
        return $query->row_array();
    }
    public function add_store($model)
    {
        $this->db->insert('store_information', $model);
    }
    public function update_store($id,$store_name, $id_nat, $rccm,$nif)
	{
        $this->db->set('Store_name', $store_name);
        $this->db->set('rccm' ,$rccm);
        $this->db->set('id_nat' ,$id_nat);
        $this->db->set('nif', $nif);
        $this->db->where('store_id', $id);
		$this->db->update('sore_information');
		
	}
    public function is_store_exist()
    {
        $q = $this->db->get('store_information');
        if ($q->num_rows() > 0) {
            return true;
        }else{
            return false;
        }
        
    }
    public function get_rate($id)
    {
        $this->db->select('rate');
        $this->db->from('currency_rate');
        $this->db->where('rate_id', 1);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function update_rate($rate,$id)
    {
        $this->db->set('rate',$rate);
        $this->db->where('rate_id', $id);
        $this->db->update('currency_rate');
        
        
    }
    public function get_users_by_group($group_id = 3)
    {
        $query = ' SELECT `users_groups`.`user_id` as `user_id`,
                          `users`.`username` as `username` 
                          from (`users`, `users_groups`)
                          where (`users`.`id` = `users_groups`.`user_id`) and (`users_groups`.`group_id` = '.$group_id.')';
        return $this->db->query($query)->result_array();
    }
    public function add_user_pos($model)
    {
        $this->db->insert('user_pos', $model);
        
    }
    
}

/* End of file setting_model.php */
