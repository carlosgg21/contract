<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Empresa extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Empresas_model', 'empresas');
        $this->load->model('Usuario_model', 'usuarios'); 
        $this->load->model('log_model');
    }

    public function index() { // al clasificador de empresas solo acceden las areas d juridico y SAD
        $correcto = $this->utilidades->chequear_loggin();
        if($correcto <> true){  
            $permiso = '';
            if(in_array("48", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 48);                
            }else if(in_array("47", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 47);                
            }
            if($permiso == true){ 
                $data['datos'] = $this->empresas->get_all();        
                $data['main'] = 'clasificadores/empresas_view';
                $this->load->view('template/layout', $data);
            }else{
                echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
            }
        }
    }

    public function nueva() {
          
        $this->empresas->existe($this->input->post('empresa'));
        $this->form_validation->set_rules('empresa', 'Empresa', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('ms_eliminar', 'No se ha insertado');
            redirect('clasificador/empresa');
        } else {
            //compruebo que el provedor no exista en la Base de datos 
            if ($this->empresas->existe($this->input->post('empresa'))) {                
                $this->session->set_flashdata('ms_eliminar', 'Ya existe ese provedor');
                redirect('clasificador/empresa');
            }else{              
                $datos = array(
                    'nombre_empresa' => $this->input->post('empresa'),
                    'tipo_empresa' => $this->input->post('tipo'),
                    'observaciones' => $this->input->post('observaciones')
                );
                $this->empresas->insert($datos);
                $this->session->set_flashdata('ms_insertar', 'Se ha insertado correctamente');

                $this->log_model->registrar_log('Se ha insertado la empresa: '.$this->input->post('empresa'));                
                redirect('clasificador/empresa');
            }
        }
            
        
    }

    public function modificar() {

        $this->form_validation->set_rules('empresa', 'Empresa', 'required');
        $this->form_validation->set_rules('tipo_empresa', 'tipo_empresa', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('ms_eliminar', 'No se ha modificado');
            redirect('clasificador/empresa');
        } else {
            $datos = array(
                'nombre_empresa' => $this->input->post('empresa'),
                'tipo_empresa' => $this->input->post('tipo_empresa'),
                'observaciones' => $this->input->post('observaciones')
            );
            $id = $this->input->post('id');
            $this->empresas->update($datos, $id);
            $this->session->set_flashdata('ms_insertar', 'Se ha modificado correctamente');            
            $this->log_model->registrar_log('Se ha modificado la empresa: '.$id);
            redirect('clasificador/empresa');
        }
    }

    function eliminar($id) {
        if ($id != 0) {

            $this->empresas->delete($id);
            $this->session->set_flashdata('ms_insertar', 'Se ha eliminado correctamente');
            $this->log_model->registrar_log('Se ha eliminado la empresa: '.$id);
            redirect('clasificador/empresa');
        } else {
            $this->session->set_flashdata('ms_eliminar', 'No se ha eliminado');
            redirect('clasificador/empresa');
        }
    }

}

/* End of file Empresa.php */
    /* Location: ./application/controllers/Empresa.php */
    