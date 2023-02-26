
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Update_bd extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Contratos_model', 'contrato');
        $this->load->model('Empresas_model', 'empresas');
        $this->load->model('Servicios_model', 'servicios');    
        $this->load->library('Pdf');
        $this->load->library('excel');
        $this->load->helper(array('form', 'url'));
    }

    public function index() {             
        $data['main'] = 'update_bd_view';
        $this->load->view('template/layout', $data);
    }
    
//    public function actualiza_empresas(){ //actualiza los nombres de las empresas con su id correspondiente. Usado al hacer la carga inicial
//        $empresas = $this->empresas->get_all();        
//        $contratos = $this->contrato->get_contratos(); 
//        
//        $this->contrato->update_empresas($empresas,$contratos);
//    }
    
//    public function update_servicios(){
//        $servicios = $this->servicios->get_all();        
//        $contratos = $this->contrato->get_contratos(); 
//        
//        $this->contrato->update_servicios($servicios, $contratos);
//    }
    
}    