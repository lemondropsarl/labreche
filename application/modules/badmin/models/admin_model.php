<?php 
defined('BASEPATH') OR exit('No direct script access allowed');





class admin_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
   /**
	 * update_permission_to_group
	 *@author Cedric Mataso
	 * @param  mixed $id
	 * @param  mixed $value
	 * @return void
	 */
	public function update_permission_to_group($id,$value){
		$this->db->set('value',$value);
        $this->db->where('id',$id);
        $this->db->update('groups_permissions');
    }
    public function ggp(){
		return $this->db->get('groups_permissions')->result();
	}
    public function get_modules_permissions()
    {
        $query = $this->db->get('acl_modules');
        $matrix =array();
        foreach ($query->result_array() as $v) {
            $m_names = $v['module_name'];
            $g_names = $v['group_id'];
            $value = $v['value'];
            $matrix[$m_names][$g_names] = $value;
        }
        return $matrix;
    }
    public function get_modules()
    {

        $query = $this->db->get('modules');;
        return $Query->result_array();

    }
    public function add_acl_module($model)
    {    
        $this->db->insert('acl_modules', $model);
        
    }
    

}

/* End of file ModelName.php */

/* End of file filename.php */
