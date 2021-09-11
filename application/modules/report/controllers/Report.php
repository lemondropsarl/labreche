<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
       
        $this->load->library('ion_auth');
        $this->load->library('ion_auth_acl');
        $this->load->model('nav_model');
        $this->load->model('report_model');
        

        
    }
    

    public function index()
    {
        $data['user_groups']           =   $this->ion_auth->get_users_groups()->result();
		$data['user_permissions']      =   $this->ion_auth_acl->build_Acl();
		$data['menus']			  	   =   $this->nav_model->get_nav_menus();
		$data['subs']				   =   $data['menus'];
		$data['acl_modules']		   =   $this->nav_model->get_acl_modules();
		$data['title']					=  'Rapports';

        $this->load->view('templates/header', $data);
        $this->load->view('index');
        $this->load->view('templates/footer');

        
    }
    public function daily_report()
    {
        //il ya deux facons de generer les pdf 1 avec dompdf
        $dompdf = new \Dompdf\Dompdf();
        $data['data'] = $this->report_model->generate_daily_report(1);
        $html = $this->load->view('daily_report', $data,true);
        $dompdf->loadHtml($html);
        //$dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
       // $pdf = $dompdf->output();
        $dompdf->stream();

        //avec mpdf
        //$mpdf = new \Mpdf\Mpdf();
        //$data['data'] = $this->report_model->generate_daily_report(1);
        //$html = $this->load->view('daily_report', $data, true);
        //$mpdf->WriteHTML($html);
        //$mpdf->Output();
        
    }
    public function monthly_report()
    {
            
    }
    public function weekly_report()
    {
            
    }

}

/* End of file Repost.php */
