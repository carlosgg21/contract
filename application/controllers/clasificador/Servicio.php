<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Servicio extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Servicios_model', 'servicios');
        $this->load->model('Usuario_model', 'usuarios');
        $this->load->model('log_model');
    }

    public function index() {
        $correcto = $this->utilidades->chequear_loggin();
        if($correcto <> true){  
            $permiso = '';
            if(in_array("48", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 48);                
            }else if(in_array("47", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 47);                
            }
            if($permiso == true){
                $data['datos'] = $this->servicios->get_all();   
                $data['main'] = 'clasificadores/servicios_view';
                $this->load->view('template/layout', $data);
            }
        }
    }

    public function nueva() {

        $this->form_validation->set_rules('servicio', 'Servicio', 'required|min_length[6]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('ms_eliminar', 'No se ha insertado');
            redirect('clasificador/servicio');
        }
        else {
            $datos = array(
                'nombre_servicio' => $this->input->post('servicio'),                
                'descripcion' => $this->input->post('observaciones')
            );

            $this->servicios->insert($datos);
            $this->session->set_flashdata('ms_insertar', 'Se ha insertado correctamente');
            $this->log_model->registrar_log('Se ha insertado el servicio: '.$this->input->post('servicio'));
            redirect('clasificador/servicio');
        }
    }
    public function cancelar_servicio($id) {
        $this->servicios->update_estado($id);
        $this->log_model->registrar_log('Se ha cancelado el servicio: '.$id);
        redirect('clasificador/servicio');
    }
    
    public function modificar() {
       $this->form_validation->set_rules('servicio', 'Empresa', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('ms_eliminar', 'No se ha modificado');
            redirect('clasificador/servicio');
        }
        else {

            $datos = array(
                'nombre_servicio' => $this->input->post('servicio'),                
                'descripcion' => $this->input->post('observaciones')
            );

            $id = $this->input->post('id');
            $this->servicios->update($datos, $id);
            $this->session->set_flashdata('ms_insertar', 'Se ha modificado correctamente');
            $this->log_model->registrar_log('Se ha modificado el servicio: '.$id);
            redirect('clasificador/servicio');
        }
    }

//    function eliminar($id) {
//
//        if ($id != 0) {
//
//            $this->servicios->delete($id);
//            $this->session->set_flashdata('ms_insertar', 'Se ha eliminado correctamente');
//            redirect('clasificador/servicio');
//        }
//        else {
//            $this->session->set_flashdata('ms_eliminar', 'No se ha eliminado');
//            redirect('clasificador/servicio');
//        }
//    }

}

/* End of file Empresa.php */
    /* Location: ./application/controllers/Empresa.php */
    