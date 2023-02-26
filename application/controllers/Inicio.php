<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');    

class Inicio extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Contratos_model', 'contrato'); 
        $this->load->model('Usuario_model', 'usuarios'); 
    //        $this->load->library('session');
    }    


    public function index() {
        $correcto = $this->utilidades->chequear_loggin();
        if($correcto <> true){  
            $permiso = '';
           if(in_array("48", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 48);                
            }else if(in_array("93", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 93);               
            }else if(in_array("47", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 47);                
            }else if(in_array("129", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 129);                
            }else if(in_array("49", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 49);                
            }
            if($permiso == true){
                if ($this->session->userdata('usuario') == NULL){
                    echo '<script>alert("Debe estar autenticado");</script>';
                    echo "<script>window.location.replace('http://192.168.5.64/intranet/');</script>";	
                }else{                       
                    $data['datos'] = $this->contrato->resumen();
                    $data['main'] = 'inicio_view';
                    $this->load->view('template/layout', $data);
                }
            }else{
                echo '<script>alert("Usted no tiene acceso a la URL solicitada1");</script>';                
            }
        }
    }
}

/* End of file Inicio.php */
/* Location: ./application/controllers/Inicio.php */
