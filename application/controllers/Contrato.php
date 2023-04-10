<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Contrato extends CI_Controller
{

    // ', No. contrato: '.$datos['no_contrato']

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Procesos_model', 'procesos');
        $this->load->model('Contratos_model', 'contrato');
        $this->load->model('Ficha_cliente_model', 'ficha');
        $this->load->model('Empresas_model', 'empresas');
        $this->load->model('Servicios_model', 'servicios');
        $this->load->model('Usuario_model', 'usuarios');
        // $this->load->model('log_model');
        // $this->load->library('Pdf');
        // $this->load->library('excel');
        // $this->load->helper(array('form', 'url'));
    }

    public function index()
    {

        // $correcto = $this->utilidades->chequear_loggin();
        // if($correcto <> true){  
        //     $permiso = '';
        //    if(in_array("48", $this->session->userdata('id_rol'))){
        //         $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 48);                
        //     }else if(in_array("93", $this->session->userdata('id_rol'))){
        //         $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 93);               
        //     }else if(in_array("47", $this->session->userdata('id_rol'))){
        //         $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 47);                
        //     }else if(in_array("129", $this->session->userdata('id_rol'))){
        //         $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 129);                
        //     }else if(in_array("49", $this->session->userdata('id_rol'))){
        //         $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 49);                
        //     }
        //     if($permiso == true){



        $data['filtros'] = $this->contrato->dataFilter();
            //      echo ('<pre>');
            //  var_dump( $data['filtros']);
            //         echo ('</pre>');
            // die();

        if (!empty($this->input->post())) {
            // $datosPost = $this->input->post();
            //       echo ('<pre>');
            //  var_dump($datosPost);
            //         echo ('</pre>');
            // die();
            $data['datos'] = $this->contrato->getFilterQuery($this->input->post());
            $data['estadoFiltro'] = 1;
            $data['request'] = $this->input->post();
            // die('filtro');
        } else {
            
            $data['datos'] = $this->contrato->getFilterQuery();
            // echo count($this->contrato->getFilterQuery());
            // die('nomrla');
            
        }

        // echo ('<pre>');
        // var_dump($data);
        // echo ('</pre>');
        // die();

        // $data['datos'] = $this->contrato->get_contratos_vigentes();
        // //$data['servicios'] = $this->servicios->get_all();  
        $data['servicios'] = $this->servicios->get_servicios();
        $data['procesos'] = $this->procesos->get_all();
        $data['fichas'] = $this->ficha->where('estado_cliente_ficha', 'activo')->get_all(); 
        $data['laficha'] = $this->ficha->get_ficha_by_contrato();

        //  if(in_array(48, $this->session->userdata('id_rol'))){
        //     $data['area'] = 48; //juridico
        // }else{
        //     if(in_array(93, $this->session->userdata('id_rol'))){
        //         $data['area'] = 93; //logistica
        //     }else{
        //         if(in_array(47, $this->session->userdata('id_rol'))){
        //             $data['area'] = 47; //sad
        //         }else{
        //             if(in_array(49, $this->session->userdata('id_rol'))){
        //             $data['area'] = 49; //sad
        //             }else{
        //                 if(in_array(129, $this->session->userdata('id_rol'))){
        //                 $data['area'] = 129; //auditorAS
        //                 }
        //             }
        //         }
        //     }
        // }

        //  echo ('<pre>');
        // var_dump($data['procesos']);
        // echo ('</pre>');
        // die();
        $data['js'] = 'contrato-list.js';
        $data['main'] = 'contrato/contratos_view';
        $this->load->view('template/layout', $data);
        // }
        // else{
        //     echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
        //     echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
        // }
        // }
    }

    public function nuevo()
    {
        $correcto = $this->utilidades->chequear_loggin();
        if ($correcto <> true) {
            $permiso = '';
            if (in_array("47", $this->session->userdata('id_rol'))) {
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 47);
            } else if (in_array("48", $this->session->userdata('id_rol'))) {
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 48);
            } else if (in_array("93", $this->session->userdata('id_rol'))) {
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 93);
            }
            if ($permiso == true) {
                $data['empresas'] = $this->empresas->get_all();
                //$data['servicios'] = $this->servicios->get_all();
                $data['servicios'] = $this->servicios->get_servicios();
                $data['procesos'] = $this->procesos->get_all();
                $data['fichas'] = $this->ficha->where('estado_cliente_ficha', 'activo')->get_all();
                $data['error'] = '';

                $data['main'] = 'contrato/nuevo_view';
                //$data['js'] = 'contratos.js';
                $this->load->view('template/layout', $data);
            } else {
                echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
            }
        }
    }

    public function modificar_contrato($id_contrato)
    { // muestra vista para modificar un contrato   
        $correcto = $this->utilidades->chequear_loggin();
        if ($correcto <> true) {
            $permiso = '';
            if (in_array("48", $this->session->userdata('id_rol'))) {
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 48);
            } else if (in_array("93", $this->session->userdata('id_rol'))) {
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 93);
            } else if (in_array("47", $this->session->userdata('id_rol'))) {
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 47);
            }
            if ($permiso == true) {
                $data['datos'] = $this->contrato->get_contratos_vigentes();
                $data['observ'] = $this->contrato->get_observaciones_contrato($id_contrato);
                $data['ficha_contrato'] = $this->contrato->get_ficha_contrato($id_contrato);


                $data['emprs'] = $this->empresas->get_all();
                //$data['servicios'] = $this->servicios->get_all();
                $data['servicios'] = $this->servicios->get_servicios();
                $data['procesos'] = $this->procesos->get_all();
                $data['fichas'] = $this->ficha->where('estado_cliente_ficha', 'activo')->get_all();
                $data['ficha_guardada'] = $this->ficha->get_guardadas($id_contrato);



                $data['contrato'] = $id_contrato;

                if (in_array(48, $this->session->userdata('id_rol'))) {
                    $data['area'] = 48; //juridico
                } else {
                    if (in_array(93, $this->session->userdata('id_rol'))) {
                        $data['area'] = 93; //logistica
                    } else {
                        if (in_array(47, $this->session->userdata('id_rol'))) {
                            $data['area'] = 47; //sad;
                        }
                    }
                }
                $data['js'] = 'habilitar.js';
                $data['main'] = 'contrato/modificar_contratos_view';
                $this->load->view('template/layout', $data);
            } else {
                echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
            }
        }
    }

    public function suplementar_contrato($id_contrato)
    { // muestra vista para modificar un contrato   
        $correcto = $this->utilidades->chequear_loggin();
        if ($correcto <> true) {
            $permiso = '';
            if (in_array("48", $this->session->userdata('id_rol'))) {
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 48);
            } else if (in_array("93", $this->session->userdata('id_rol'))) {
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 93);
            } else if (in_array("47", $this->session->userdata('id_rol'))) {
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 47);
            }
            if ($permiso == true) {
                $data['datos'] = $this->contrato->get_contratos_vigentes();
                $data['emprs'] = $this->empresas->get_all();
                //$data['servicios'] = $this->servicios->get_all();  
                $data['servicios'] = $this->servicios->get_servicios();
                $data['procesos'] = $this->procesos->get_all();
                $data['fichas'] = $this->ficha->where('estado_cliente_ficha', 'activo')->get_all();
                $data['contrato'] = $id_contrato;

                if (in_array(48, $this->session->userdata('id_rol'))) {
                    $data['area'] = 48; //juridico
                } else {
                    if (in_array(93, $this->session->userdata('id_rol'))) {
                        $data['area'] = 93; //logistica
                    } else {
                        if (in_array(47, $this->session->userdata('id_rol'))) {
                            $data['area'] = 47; //sad;
                        }
                    }
                }
                //$data['js'] = 'habilitar.js';
                $data['js'] = 'suplemento.js';
                $data['main'] = 'contrato/suplementar_contratos_view';
                $this->load->view('template/layout', $data);
            } else {
                echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
            }
        }
    }

    public function muestra_empresas()
    { // muestra listado de empresas en dependencia del tipo de empresa seleccionado

        switch ($this->input->post('elegido')) {
            case 1:
                $tipo = 'Persona Natural';
                break;
            case 2:
                $tipo = 'Empresa Estatal';
                break;
            case 3:
                $tipo = 'Empresa No Estatal';
                break;
        }
        $html = "";
        $empresas = $this->empresas->tipo_empresa($tipo);
        $this->output->set_content_type('application/json', 'utf-8')->set_output(json_encode($empresas));
    }

    public function cancelar($id)
    { // cambia a 0 el estado de un contrato
        $this->contrato->cancelar_contrato_proveedor($id);
        $this->session->set_flashdata('ms_insertar', 'Se ha modificado correctamente');
        redirect('Contrato');
    }

    //    public function actualizar_fcliente(){
    //        $id = $this->input->post('idContrato');
    //        $this->contrato->modifificar_contrato_fichaCliente($id,$this->input->post('idFichaCliente'));
    //    }    

    public function modificar($contrato_id)
    { // modifica un contrato existente      

        $data['datos'] = $this->contrato->get_contratos_vigentes();
        $data['servicios'] = $this->servicios->get_all();
        $data['procesos'] = $this->procesos->get_all();
        $data['fichas'] = $this->ficha->where('estado_cliente_ficha', 'activo')->get_all();
        $empresa = $this->input->post('empresa');

        $subirPDF = $this->contrato->do_upload();
        $dfichero = $this->upload->data();
        $nfichero = explode(".", $dfichero['file_name']);

        if ($nfichero[0] != '') {
            $datos = array(
                'no_contrato' => $this->input->post('el_contrato'),
                'no_suplemento' => $this->input->post('no_suplemento'),
                'fecha_firma' => $this->input->post('fecha_firma'),
                'tipo_persona' => $this->input->post('tipo_persona'),
                'idEmpresa' => $this->input->post('idEmpresa'),
                'idTipoServicio' => $this->input->post('idTipoServicio'),
                'id_procesos' => $this->input->post('id_procesos'),
                'vigencia' => $this->input->post('vigencia'),
                'periodo' => $this->input->post('periodo'),
                'fecha_expira' => $this->input->post('fecha_expira'),
                'documento' => $nfichero[0],
                'observaciones' => $this->input->post('observaciones'),
                'estado_contrato' => "1"
            );
        } else {
            $datos = array(
                'no_contrato' => $this->input->post('el_contrato'),
                'no_suplemento' => $this->input->post('no_suplemento'),
                'fecha_firma' => $this->input->post('fecha_firma'),
                'tipo_persona' => $this->input->post('tipo_persona'),
                'idEmpresa' => $this->input->post('idEmpresa'),
                'idTipoServicio' => $this->input->post('idTipoServicio'),
                'id_procesos' => $this->input->post('id_procesos'),
                'vigencia' => $this->input->post('vigencia'),
                'periodo' => $this->input->post('periodo'),
                'fecha_expira' => $this->input->post('fecha_expira'),
                'observaciones' => $this->input->post('observaciones'),
                'estado_contrato' => "1"
            );
        }



        $id = $contrato_id;
        $this->contrato->modificar_contrato_proveedor($id, $datos);

        $this->contrato->modifificar_contrato_fichaCliente($id, $this->input->post('id_ficha'));
        $this->session->set_flashdata('ms_insertar', 'Se ha insertado correctamente');

        //insertando en la bitacora
        $this->log_model->registrar_log('Se ha modificado el contrato: ' . $id . ', No. contrato: ' . $datos['no_contrato']);
        $this->log_model->registrar_log_ficha($this->input->post('ficha_cliente'), $id);

        redirect('contrato');
    }


    public function suplementar($contrato_id)
    { // suplemento a  un contrato existente      

        $data['datos'] = $this->contrato->get_contratos_vigentes();
        $data['servicios'] = $this->servicios->get_all();
        $data['procesos'] = $this->procesos->get_all();
        $data['fichas'] = $this->ficha->where('estado_cliente_ficha', 'activo')->get_all();
        $empresa = $this->input->post('empresa');

        $subirPDF = $this->contrato->do_upload();
        $dfichero = $this->upload->data();
        $nfichero = explode(".", $dfichero['file_name']);

        if ($nfichero[0] != '') {
            $datos = array(
                'no_contrato' => $this->input->post('el_contrato'),
                'no_suplemento' => $this->input->post('no_suplemento'),
                'fecha_firma' => $this->input->post('fecha_firma'),
                'tipo_persona' => $this->input->post('tipo_persona'),
                'idEmpresa' => $this->input->post('idEmpresa'),
                'idTipoServicio' => $this->input->post('idTipoServicio'),
                'id_procesos' => $this->input->post('id_procesos'),
                'vigencia' => $this->input->post('vigencia'),
                'periodo' => $this->input->post('periodo'),
                'fecha_expira' => $this->input->post('fecha_expira'),
                'documento' => $nfichero[0],
                'observaciones' => $this->input->post('observaciones'),
                'estado_contrato' => "1"
            );
        } else {
            $datos = array(
                'no_contrato' => $this->input->post('el_contrato'),
                'no_suplemento' => $this->input->post('no_suplemento'),
                'fecha_firma' => $this->input->post('fecha_firma'),
                'tipo_persona' => $this->input->post('tipo_persona'),
                'idEmpresa' => $this->input->post('idEmpresa'),
                'idTipoServicio' => $this->input->post('idTipoServicio'),
                'id_procesos' => $this->input->post('id_procesos'),
                'vigencia' => $this->input->post('vigencia'),
                'periodo' => $this->input->post('periodo'),
                'fecha_expira' => $this->input->post('fecha_expira'),
                'observaciones' => $this->input->post('observaciones'),
                'estado_contrato' => "1"
            );
        }

        $idContrato = $this->contrato->add_contrato_proveedor($datos);

        //$this->contrato->modificar_contrato_proveedor($id, $datos);    
        $this->contrato->modifificar_contrato_fichaCliente($idContrato, $this->input->post('id_ficha'));


        $this->session->set_flashdata('ms_insertar', 'Se ha insertado correctamente');

        //insertando en la bitacora
        $this->log_model->registrar_log('Se ha insertado el contrato: ' . $idContrato . ', No. contrato: ' . $datos['no_contrato']);
        $this->log_model->registrar_log_ficha($this->input->post('ficha_cliente'), $idContrato);

        redirect('contrato');
    }

    public function add()
    { // agrega un nuevo contrato       
        $subirPDF = $this->contrato->do_upload();
        $dfichero = $this->upload->data();
        $nfichero = explode(".", $dfichero['file_name']);

        if ($dfichero['file_name'] == "") {
            echo '<script>alert("No adjunto ningun archivo");</script>';
            echo "<script>window.location.replace('contrato/nuevo_view');</script>";
        } else {
            $this->form_validation->set_rules('fecha_firma', 'fecha_firma', 'required');
            $this->form_validation->set_rules('idTipoServicio', 'idTipoServicio', 'required');
            $this->form_validation->set_rules('tipo_persona', 'tipo_persona', 'required');
            $this->form_validation->set_rules('idEmpresa', 'idEmpresa', 'required');
            $this->form_validation->set_rules('id_procesos', 'id_procesos', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('ms_eliminar', 'No se ha insertado');
                redirect('contrato');
            } else {
                $datos = array(
                    'no_contrato' => $this->input->post('no_contrato'),
                    'no_suplemento' => $this->input->post('no_suplemento'),
                    'fecha_firma' => $this->input->post('fecha_firma'),
                    'tipo_persona' => $this->input->post('tipo_persona'),
                    'idEmpresa' => $this->input->post('idEmpresa'),
                    'idTipoServicio' => $this->input->post('idTipoServicio'),
                    'id_procesos' => $this->input->post('id_procesos'),
                    'vigencia' => $this->input->post('vigencia'),
                    'periodo' => $this->input->post('periodo'),
                    'fecha_expira' => $this->input->post('fecha_expira'),
                    'documento' => $nfichero[0],
                    'observaciones' => $this->input->post('observaciones'),
                    'estado_contrato' => "1"
                );

                //insertar en registro contrato
                $idContrato = $this->contrato->add_contrato_proveedor($datos);
                //insertar en contrato_fichaCliente
                $this->contrato->add_contrato_fichaCliente($idContrato, $this->input->post('ficha_cliente'));
                $this->session->set_flashdata('ms_insertar', 'Se ha insertado correctamente');

                $this->log_model->registrar_log('Se ha insertado el contrato: ' . $idContrato . ', No. contrato: ' . $datos['no_contrato']);
                $this->log_model->registrar_log_ficha($this->input->post('ficha_cliente'), $idContrato);
                redirect('contrato');
            }
        }
    }

    function do_upload()
    {
        $config['upload_path'] = './documents/contratos';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        } else {
            $data = array('upload_data' => $this->upload->data());
            return $data;
        }
    }

    function exportar_pdf()
    { // muestra en formato PDF el listado de contrato vigentes
        $datos = $this->contrato->get_contratos_vigentes();
        $html = '
            <table width="965" border="1" align="left">
                <tr>
                    <th>No. contrato</th>
                    <th>No. suplemento</th>
                    <th>Fecha firma</th>
                    <th>Empresa</th>
                    <th>Servicio</th>
                    <th>Fecha expira</th>                    
                </tr>';
        foreach ($datos as $row) {
            $html .= '
                <tr>
                    <td>' . $row['no_contrato'] . '</td>
                    <td>' . $row['no_suplemento'] . '</td>
                    <td>' . $row['fecha_firma'] . '</td>
                    <td>' . $row['nombre_empresa'] . '</td>
                    <td>' . $row['nombre_servicio'] . '</td>';
            if ($row['fecha_expira'] == "0000-00-00") {
                $html .= '<td></td>';
            }
            if ($row['fecha_expira'] != "0000-00-00") {
                $html .= '<td>' . $row['fecha_expira'] . '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</table>';

        $encabezado = '<img src="./assets/imagenes/logo200.png" width="125" height="50" >
                        <h4>Reporte de Contratos Vigentes</h4><hr>';
        $nombre = '';
        $eltitulo = '';
        $doc = $this->contrato->rep_generar(array('encabezado' => $encabezado, 'cuerpo' => $html, 'nombre' => $nombre, 'titulo' => $eltitulo));
    }

    public function exportar_excel()
    {

        $datos = $this->contrato->get_contratos_vigentes();

        $objPHPExcel = new PHPExcel();

        // Set document properties
        //        echo date('H:i:s'), " Set document properties", EOL;
        $objPHPExcel->getProperties()->setCreator("BANCOI")
            ->setLastModifiedBy("Maarten Balliauw")
            ->setTitle("Listado de contratos")
            ->setSubject("Listado")
            ->setDescription("Listado de contratos vigentes")
            ->setKeywords("contratos vigentes")
            ->setCategory("archivo");
        //
        //ID	NO_CONTRATO	NO_SUPLEMENTO	ID_EMPRESA	EMPRESA	ID_SERVICIO	SERVICIO	FECHA_FIRMA	VIGENCIA	PERIODO	FECHA_EXPIRA	ID_PROCESO	PROCESO
        // Add some data
        //        echo date('H:i:s'), " Add some data", EOL;
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NO_CONTRATO')
            ->setCellValue('B1', 'NO_SUPLEMENTO')
            ->setCellValue('C1', 'FECHA FIRMA')
            ->setCellValue('D1', 'EMPRESA')
            ->setCellValue('E1', 'SERVICIO')
            ->setCellValue('F1', 'FECHA EXPIRA');
        $n = 2;
        for ($i = 0; $i < count($datos); $i++) {
            $a = 'A' . $n;
            $b = 'B' . $n;
            $c = 'C' . $n;
            $d = 'D' . $n;
            $e = 'E' . $n;
            $f = 'F' . $n;
            $objPHPExcel->getActiveSheet()->setCellValue($a, $datos[$i]['no_contrato']);
            $objPHPExcel->getActiveSheet()->setCellValue($b, $datos[$i]['no_suplemento']);
            $objPHPExcel->getActiveSheet()->setCellValue($c, $datos[$i]['fecha_firma']);
            $objPHPExcel->getActiveSheet()->setCellValue($d, $datos[$i]['nombre_empresa']);
            $objPHPExcel->getActiveSheet()->setCellValue($e, $datos[$i]['nombre_servicio']);
            $objPHPExcel->getActiveSheet()->setCellValue($f, $datos[$i]['fecha_expira']);

            $n++;
        }


        $objPHPExcel->getActiveSheet()->setTitle('Contratos vigentes');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);




        $filename = "Contratos_vigentes.xls"; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //      header('Content-Type: application/vnd.ms-excel');
        //header('Content-Disposition: attachment;filename="01simple.xls"');
        //header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }




    function logout()
    {
        $this->utilidades->close_session();
    }
}
