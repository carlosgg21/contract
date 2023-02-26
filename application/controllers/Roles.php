<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
    //include(APPPATH . '/autentica_ajax.php');
}

class Roles extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('rol_model');
        //session_start();
        //$this->load->library('session');    
    }

    public function index() {
        
        $data['roles'] = $this->rol_model->get_roles_sistema();
        $data['page_title'] = 'Roles';
        $data['main'] = 'Gestion_Usuarios/Index_roles';
        $this->load->view('template/layout', $data);
    }

}
/* End of file roles.php */
/* Location: ./application/controllers/roles.php */
