<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bitacora extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('log_model');   
        $this->load->model('Usuario_model', 'usuarios'); 
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
            }else if(in_array("49", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 49); 
            }
            if($permiso == true){               
                $data['datos'] = $this->log_model->mostrar_logs();        
                $data['main'] = 'clasificadores/bitacora_view';
                $this->load->view('template/layout', $data);
            }
        }
    }

}

/* End of file Bitacora.php */
/* Location: ./application/controllers/Bitacora.php */
