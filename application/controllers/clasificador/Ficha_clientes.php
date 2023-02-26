<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ficha_clientes extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Ficha_cliente_model', 'fcliente'); 
        $this->load->model('Usuario_model', 'usuarios');
        $this->load->model('log_model');
    }

    public function index() { // a este clasificador solo acceden las logistica y SAD
        $correcto = $this->utilidades->chequear_loggin();
        if($correcto <> true){  
            $permiso = '';
            if(in_array("93", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 93);                
            }else if(in_array("47", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 47);                
            }else if(in_array("48", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 48);                
            }
            if($permiso == true){
                $data['trabajadores'] = $this->fcliente->get_trabajadores();  
                $data['datos'] = $this->fcliente->where('estado_cliente_ficha', 'activo')->get_all();        
                $data['main'] = 'clasificadores/ficha_cliente_view';
                $this->load->view('template/layout', $data);
            }else{
                echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
            }
        }
    }

    public function nuevo() {

        $this->form_validation->set_rules('trabajador', 'Trabajador', 'required');
        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('ms_eliminar', 'No se ha insertado en la ficha de  cliente');
            redirect('clasificador/ficha_clientes');
        }
        else {
            $datos = $this->fcliente->get_trabajador_by_id($this->input->post('trabajador'));
          
            $data = array(
                'cliente_nombre_apellidos' => $datos['nombre_apellidos'],
                'estado_cliente_ficha' => 'activo',
                'idUsuario' => $datos['id_usuario'],
            );
            $this->fcliente->insert($data);
            $this->session->set_flashdata('ms_insertar', 'Se ha insertado correctamente');
            $this->log_model->registrar_log('Se ha insertado el usuario: '.$datos['id_usuario'].' como ficha cliente');
            redirect('clasificador/ficha_clientes');
        }
    }

    public function eliminar($id) {

        $data = array(
            'estado_cliente_ficha' => "eliminado",
            'id_ficha' => $id
        );
        $this->fcliente->update($data, 'id_ficha');
        $this->session->set_flashdata('ms_eliminar', 'Se ha eliminado correctamente');
        $this->log_model->registrar_log('Se ha cancelado la ficha cliente: '.$id);
        redirect('clasificador/ficha_clientes');
    }

}

/* End of file Ficha_clientes.php */
/* Location: ./application/controllers/Ficha_clientes.php */
