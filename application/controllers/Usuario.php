<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
    //include(APPPATH . '/autentica_ajax.php');
}

class Usuario extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('usuario_model', 'usuarios');
        $this->load->model('servicios_model'); //trabajadores_bancoi_model y rol_model
        $this->load->model('Contratos_model', 'contrato');
        $this->load->model('log_model'); //bitacora
        $this->load->model('rol_model'); //bitacora
        $this->load->library('Pdf');
        $this->load->library('excel');
        $this->load->helper(array('form', 'url'));
        //session_start();
        //$this->load->library('session');   
    }
    
    public function index() {
        $correcto = $this->utilidades->chequear_loggin();
        if($correcto <> true){  
            $permiso = '';
            if(in_array("47", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 47);                
            }
            if($permiso == true){ 
                $data['usuarios_sistema'] = $this->usuarios->get_usuario_sistema();
                $data['usuarios'] = $this->usuarios->get_trabajadores(); 
                $data['roles'] = $this->usuarios->get_roles_sistema();    
                $data['page_title'] = 'Usuarios';
                $data['main'] = 'Gestion_Usuarios/index_usuario';
                $this->load->view('template/layout', $data);
            }
        }
    } 
    
    //agrega un usuario
    function add() {
        $this->form_validation->set_rules('idUsuario', 'idUsuario', 'required');
        $this->form_validation->set_rules('idRol', 'idRol', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('ms_eliminar', 'No se ha creado el usuario');
            redirect('usuario');
        } else {            
            //si existe el usuario no se puede insertar de nuevo en la base de datos
            if ($this->usuarios->check_usuario($this->input->post('idUsuario'))) {
                $this->log_model->registrar_log('Ya existe el usuario que intenta insertar');
                $this->session->set_flashdata('ms_eliminar', 'Ya existe el usuario en el sistema');
                redirect('usuario');
            } else {
                $this->usuarios->insert_usuario($this->input->post());
                $id =  $this->input->post();
                $user = $this->usuarios->show_user($id['idUsuario']);               
               
                $this->log_model->registrar_log('Se ha insertado el usuario: '.$this->input->post('idUsuario'));
                $this->session->set_flashdata('ms_insertar', 'Se ha creado el usuario correctamente');
                redirect('usuario');
            }
        }
    }

    //modifica el rol de un usuario
    function change_rol() {
        $id_usuario = $this->input->post('id_usuario');
        $id_roles = $this->input->post('rol');
        $this->usuarios->change_rol($id_usuario, $id_roles);
        $this->log_model->registrar_log('Cambio de rol un usuario: '.$this->input->post('idUsuario'));
        $this->session->set_flashdata('ms_insertar', 'Se ha cambiado el rol del usuario correctamente');
        redirect('usuario');
    }

    //activa los permisos de un usuario
    function activar_permisos($id) {
        $estado = '1';
        $this->usuarios->estado_usuario($id, $estado);
        
        //$user = $this->servicios_model->usuario_by_id($this->input->post('id_usuario'));
        $this->log_model->registrar_log('Activacion del usuario: '.$this->input->post('idUsuario'));
        $this->session->set_flashdata('ms_insertar', 'Se ha activado los permisos del usuario en el sistema');
        redirect('usuario');
    }

    //cancela los permisos de un usuario
    function cancelar_permisos($id) {
        $estado = '0';
        $this->usuarios->estado_usuario($id, $estado);
        
        //$user = $this->servicios_model->usuario_by_id($this->input->post('id_usuario'));
        $this->log_model->registrar_log('Cancelacion de un usuario: '.$this->input->post('idUsuario'));
        $this->session->set_flashdata('ms_insertar', 'Se ha cancelado los permisos del usuario en el sistema');
        redirect('usuario');
    }

    function delete($id) {
        $this->usuarios->delete_user($id);
        
        //$user = $this->servicios_model->usuario_by_id($this->input->post('id_usuario'));
        $this->log_model->registrar_log('Eliminacion un usuario: '.$this->input->post('idUsuario'));
        $this->session->set_flashdata('ms_insertar', 'Se ha eliminado el usuario del sistema');
        redirect('usuario');
    }
    
    function exportar_pdf() { // muestra en formato PDF el listado de contrato vigentes
        $datos = $this->usuarios->get_usuario_sistema();
        $html = '
            <table width="965" border="1" align="left">
                <tr>
                    <th>Nombre y apellidos</th>
                    <th>Área</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Correo</th>
                    <th>Estado</th>
                </tr>';
        foreach ($datos as $row) {
            $html .= '
                <tr>
                    <td>' . $row['nombre_apellidos'] . '</td>
                    <td>' . $row['nombre_area'] . '</td>
                    <td>' . $row['usuario'] . '</td>                    
                    <td>'; 
                        $valores = explode('_', $row['nombre_rol']); 
            $html .= ' 
                        '.$valores[0].'</td>
                    <td>'.$row['correo'].'</td>';  
                            
        if ($row['estado_permiso'] == 0) {
            $html .= '<td>Inactivo</td>';
        }else {
            $html .= '<td>Activo</td>';
        }
            
            $html .= '</tr>';
        }
        $html .= '</table>';

        $encabezado = '<img src="./assets/imagenes/logo200.png" width="125" height="50" >
                       <h4>Listado de Usuarios del sistema</h4><hr>';
        $nombre = '';
        $eltitulo = '';
        $doc = $this->contrato->rep_generar(array('encabezado' => $encabezado, 'cuerpo' => $html, 'nombre' => $nombre, 'titulo' => $eltitulo));
    }
    
    public function exportar_excel() {

        $datos = $this->usuarios->get_usuario_sistema();

        $objPHPExcel = new PHPExcel();

// Set document properties
//        echo date('H:i:s'), " Set document properties", EOL;
        $objPHPExcel->getProperties()->setCreator("BANCOI")
                ->setLastModifiedBy("Maarten Balliauw")
                ->setTitle("Listado de usuarios del sistema")
                ->setSubject("Listado")
                ->setDescription("Listado de usuarios del sistema")
                ->setKeywords("Listado usuarios ")
                ->setCategory("archivo");
//
//ID	NO_CONTRATO	NO_SUPLEMENTO	ID_EMPRESA	EMPRESA	ID_SERVICIO	SERVICIO	FECHA_FIRMA	VIGENCIA	PERIODO	FECHA_EXPIRA	ID_PROCESO	PROCESO
// Add some data
//        echo date('H:i:s'), " Add some data", EOL;
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'NOMBRE Y APELLIDOS')
                ->setCellValue('B1', 'ÁREA')
                ->setCellValue('C1', 'USUARIO')
                ->setCellValue('D1', 'ROL')
                ->setCellValue('E1', 'CORREO')
                ->setCellValue('F1', 'ESTADO');
        $n = 2;
        for ($i = 0; $i < count($datos); $i++) {
            $a = 'A' . $n;
            $b = 'B' . $n;
            $c = 'C' . $n;
            $d = 'D' . $n;
            $e = 'E' . $n;
            $f = 'F' . $n;
            $objPHPExcel->getActiveSheet()->setCellValue($a, $datos[$i]['nombre_apellidos']);
            $objPHPExcel->getActiveSheet()->setCellValue($b, $datos[$i]['nombre_area']);
            $objPHPExcel->getActiveSheet()->setCellValue($c, $datos[$i]['usuario']);
            
            $valores = explode('_', $datos[$i]['nombre_rol']);
            
            $objPHPExcel->getActiveSheet()->setCellValue($d, $valores[0]);
            $objPHPExcel->getActiveSheet()->setCellValue($e, $datos[$i]['correo']);
            
            if ($datos[$i]['estado_permiso'] == 0) {
                $objPHPExcel->getActiveSheet()->setCellValue($f, 'Inactivo');
            }else {
                $objPHPExcel->getActiveSheet()->setCellValue($f, 'Activo');
            }           
            $n++;
        }


        $objPHPExcel->getActiveSheet()->setTitle('Listado de usuarios del sistema');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);




        $filename = "Listado_usuarios.xls"; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
//      header('Content-Type: application/vnd.ms-excel');
//header('Content-Disposition: attachment;filename="01simple.xls"');
//header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    

}

/* End of file Usuario.php */
/* Location: ./application/controllers/Usuario.php */
