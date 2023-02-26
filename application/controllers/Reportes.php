<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reportes extends CI_Controller {

    //protected $data ;
            
    function __construct() {
        parent::__construct();
//        $this->load->model('Procesos_model', 'proceso');
        $this->load->model('Contratos_model', 'contrato');
        $this->load->helper(array('form', 'url'));        
        $this->load->model('Ficha_cliente_model', 'ficha');  
        $this->load->model('Usuario_model', 'usuarios');
    }
    
    
    /**
     * Contratos caducos 
     */

    public function caducos() {
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
                $data['error'] = "";          
                //$data['cant'] = count($this->contrato->get_caducan_proxmimo_mes());
                $data['datos'] = $this->contrato->get_contratos_caducos();        
                $data['main'] = 'reportes/contratos_caducos';
                $this->load->view('template/layout', $data);
            }else{
                echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
            }
        }
    }

     public function caducan_pmes() {  
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
                $data['error'] = "";
                //$data['cant'] = count($this->contrato->get_caducan_proxmimo_mes());        
                $data['datos'] = $this->contrato->get_caducan_proxmimo_mes();       
                $data['main'] = 'reportes/contratos_caducan_pmes_view';
                $this->load->view('template/layout', $data);
            }else{
                echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
            }
        }
    }
    /**
     * muestra los contratos candelados 
     */
    public function cancelados() {
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
                $data['datos'] = $this->contrato->get_cancelados();
                $data['main'] = 'reportes/contratos_cancelados_view';
                $this->load->view('template/layout', $data);
            }else{
                echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
            }
        }
    }

    /**
     * contratos por empresa
     */
    public function por_empresa() {
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
                $this->load->model('Empresas_model', 'empresa');
                $this->form_validation->set_rules('empresa', 'Empresa', 'required');
                $data['empresas'] = $this->empresa->get_all();
                $data['contratos'] = 0;
                if ($this->form_validation->run() != FALSE) {
                    $data['contratos'] = $this->contrato->get_contratos_byempresa($this->input->post('empresa'));
                }
                $data['main'] = 'reportes/contratos_por_empresa_view';
                $this->load->view('template/layout', $data);
            }else{
                echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
            }
        }
    }

    /**
     * contrato por servicio
     */
    public function por_servicio() {
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
                $this->load->model('Servicios_model', 'servicios');
                $data['servicios'] = $this->servicios->get_all();
                $data['contratos'] = 0;
                $this->form_validation->set_rules('servicio', 'Servicio', 'requerid');
                $id = $this->input->post('servicio');
                if ($id != 0 || $id != NULL) {
                    $data['contratos'] = $this->contrato->get_contratos_byservicio($id);
                }
                $data['main'] = 'reportes/contratos_por_servicio_view';
                $this->load->view('template/layout', $data);
            }else{
                echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
            }
        }
    }

    /**
     * contrato sin escaneado
     */
    public function sin_adjunto() {
        $correcto = $this->utilidades->chequear_loggin();
        if($correcto <> true){  
            $permiso = '';
           if(in_array("48", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 48);                
            }else if(in_array("93", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 93);               
            }else if(in_array("47", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 47);                
            }
            if($permiso == true){ 
                $data['datos'] = $this->contrato->get_contratos_sinadjunto(); 
                $data['main'] = 'reportes/contratos_sin_adjuntos_view';
                $this->load->view('template/layout', $data);
            }else{
                echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
            }
        }
    }

   
    public function caducan() {
        $correcto = $this->utilidades->chequear_loggin();
        if($correcto <> true){  
            $permiso = '';
           if(in_array("48", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 48);                
            }else if(in_array("93", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 93);               
            }else if(in_array("47", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 47);                
            }
            if($permiso == true){ 
                $data['datos'] = $this->contrato->get_caducan_proxmimo_mes();
                $data['main'] = 'reportes/contratos_caducan_pmes_view';
                $this->load->view('template/layout', $data);
            }else{
                echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
            }
        }
    }
    
    public function caducos_pdf(){
        $datos = $this->contrato->get_contratos_caducos();
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
                foreach ($datos as $row){
        $html .= '<tr>
                    <td>'.$row['no_contrato'].'</td>
                    <td>'.$row['no_suplemento'].'</td>
                    <td>'.$row['fecha_firma'].'</td>
                    <td>'.$row['nombre_empresa'].'</td>
                    <td>'.$row['nombre_servicio'].'</td>';
                    if ($row['fecha_expira'] == "0000-00-00"){
        $html .= '  <td></td>';
                    }
                    if ($row['fecha_expira'] != "0000-00-00"){
        $html .= ' <td>'.$row['fecha_expira'].'</td>';
                    }
        $html .= '</tr>';            
                }
        $html .= '</table';
        $encabezado = '<img src="./assets/imagenes/logo200.png" width="125" height="50" >
                       <h4>Reporte de Contratos Caducos</h4><hr>';
        $nombre= '';  
        $eltitulo = ''; 
        $doc = $this->contrato->rep_generar(array('encabezado'=>$encabezado,'cuerpo'=>$html,'nombre'=>$nombre,'titulo'=>$eltitulo));
    }
    
    public function modificar_caduco(){        
        $this->form_validation->set_rules('fecha_expira', 'fecha_expira', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('ms_eliminar', 'No se ha modificado');
            redirect('../reportes/caducos');
        }
        else {
            $datos = array(                
                'fecha_expira' => $this->input->post('fecha_expira'),               
            );

            $id = $this->input->post('id_contrato');
            $this->contrato->actualizar_contrato($id,$datos);           
            $this->session->set_flashdata('ms_insertar', 'Se ha modificado correctamente');
            redirect('Reportes/caducos');             
        }        
    }
    
    public function adjuntar_documento(){
        $subirPDF = $this->contrato->do_upload();        
        $dfichero = $this->upload->data();
        $nfichero =explode(".", $dfichero['file_name']);
        
        if($dfichero['file_name']==""){
            echo '<script>alert("No adjunto ningun archivo");</script>';
            echo "<script>window.location.replace('../reportes/caducos');</script>";            
        }else{            
                $datos = array(              
                    'documento' => $nfichero[0],    
                );
                $id = $this->input->post('id');
                $this->contrato->actualizar_contrato($id,$datos);           
                $this->session->set_flashdata('ms_insertar', 'Se ha modificado correctamente'); 
                redirect('Contrato');
            }
    }
    
    public function por_anno(){
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
            }else if(in_array("129", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 129);                
            }
            if($permiso == true){ 
                $data['error'] = "";
                $data['firmados'] = false;
                $data['datos'] = $this->contrato->annos();
                $data['main'] = 'reportes/contratos_por_anno_view';
                $this->load->view('template/layout', $data);   
            }else{
                echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
            }
        }
    }
    
    public function firmados_por_anno(){ 
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
            }else if(in_array("129", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 129);                
            }
            if($permiso == true){ 
                $data['datos'] = 0;
                $this->form_validation->set_rules('year', 'Year', 'required');
                if ($this->form_validation->run() == true) {
                    $data['firmados'] = true;
                    $data['datos'] = $this->contrato->annos();
                    $data['f_annos'] = $this->contrato->get_contratos_anno($this->input->post('year'));        
                }
                $data['main'] = 'reportes/contratos_por_anno_view';
                $this->load->view('template/layout', $data);  
            }else{
                echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
            }
        }
    } 
    
    public function por_proceso(){
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
            }else if(in_array("129", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 129);                
            }
            if($permiso == true){ 
                $data['error'] = "";
                $data['firmados'] = false;
                $data['datos'] = $this->contrato->get_procesos();       
                $data['main'] = 'reportes/contratos_por_proceso_view';
                $this->load->view('template/layout', $data); 
            }else{
                echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
            }
        }
    }
    
    public function contratos_por_proceso(){   
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
                $data['datos'] = 0;
                $this->form_validation->set_rules('id_proceso', 'Id_proceso', 'required');
                if ($this->form_validation->run() == true) {
                    $data['firmados'] = true;
                    $data['datos'] = $this->contrato->get_procesos();
                    $data['por_proceso'] = $this->contrato->get_contrato_byproceso($this->input->post('id_proceso'));  
                }
                $data['main'] = 'reportes/contratos_por_proceso_view';
                $this->load->view('template/layout', $data);  
            }else{
                echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
            }
        }
    } 
    
    public function contratos_vigentes_sin_ficha(){
        $correcto = $this->utilidades->chequear_loggin();
        if($correcto <> true){  
            $permiso = '';
           if(in_array("48", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 48);                
            }else if(in_array("93", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 93);               
            }else if(in_array("47", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 47);                
            }
            if($permiso == true){ 
                $data['error'] = "";
                $data['datos'] = $this->contrato->get_contratos_sinFichaCliente();
                $data['main'] = 'reportes/contratos_sin_fcliente_view';
                $this->load->view('template/layout', $data); 
            }else{
                echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
            }
        }
    }
    
    public function contratos_ficha_desactualizadas(){
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
                $data['error'] = "";
                $data['fichas'] = $this->ficha->where('estado_cliente_ficha', 'activo')->get_all();       
                $data['seleccionadas'] = "";
                $data['datos'] = $this->contrato->get_contratos_fichaDesactualizada();         
                $data['main'] = 'reportes/contratos_fichaDesactualizada_view';
                $this->load->view('template/layout', $data); 
            }else{
                echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
            }
        }        
    }
    
    public function contratos_ficha_actualizar($id){
        $correcto = $this->utilidades->chequear_loggin();
        if($correcto <> true){  
            $permiso = '';
           if(in_array("48", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 48);                
            }else if(in_array("93", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 93);               
            }else if(in_array("47", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 47);                
            }
            if($permiso == true){ 
                $data['error'] = "";
                $data['fichas'] = $this->ficha->where('estado_cliente_ficha', 'activo')->get_all();       
                $data['idContrato'] = $id;  
                $data['main'] = 'reportes/contratos_ficha_actualizar_view';
                $this->load->view('template/layout', $data); 
            }else{
                echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
            }
        }
    }
    
    public function actualizar_fcliente(){
        $id_contrato = $this->input->post('idContrato');
        $this->contrato->modifificar_contrato_fichaCliente($id_contrato,$this->input->post('id_ficha'));
        $this->session->set_flashdata('ms_insertar', 'Se ha modificado correctamente'); 
        redirect('reportes/contratos_ficha_desactualizadas');
    }
      
    public function ficha_actualizar($id){
        $correcto = $this->utilidades->chequear_loggin();
        if($correcto <> true){  
            $permiso = '';
           if(in_array("48", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 48);                
            }else if(in_array("93", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 93);               
            }else if(in_array("47", $this->session->userdata('id_rol'))){
                $permiso = $this->usuarios->check_permiso($this->session->userdata('usuario'), 47);                
            }
            if($permiso == true){ 
                $data['row'] = $id;
                $data['main'] = 'actualizar_fcliente_view';
                $this->load->view('template/layout', $data); 
            }else{
                echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
            }
        }
    }
    
	public function contratos_suplementos(){
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
                $data['error'] = "";
                $data['ctrtos'] = false;                   
                $data['contratos'] = $this->contrato->get_no_contrato();
                $data['main'] = 'reportes/suplementos_por_contrato_view';
                $this->load->view('template/layout', $data);            
            }else{
                echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
            }
        }
    }
    
    public function mostrar_contratos_suplementos(){ 
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
                $data['contratos'] = 0;
                $this->form_validation->set_rules('no_contrato', 'No_contrato', 'required');
                if ($this->form_validation->run() == true) {
                    $data['ctrtos'] = true;
                    $data['contratos'] = $this->contrato->get_no_contrato();
                    $data['contratos_suplementos'] = $this->contrato->get_suplementos_por_contrato($this->input->post('no_contrato')); 
                    $data['seleccionado'] = $this->input->post('no_contrato');                    
                }
                $data['main'] = 'reportes/suplementos_por_contrato_view';
                $this->load->view('template/layout', $data);  
            }else{
                echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/registro_contrato');</script>";
            }
        }
    } 
	
//    public function actualizar_fcliente(){  
//        $id = $this->input->post('id'); 
//        $this->contrato->momodificar($id,$datos);
//       // $this->contrato->modifificar_contrato_fichaCliente($id,$this->input->post());
//    }
}

/* End of file Reportes.php */
/* Location: ./application/controllers/Reportes.php */
