<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Log_model extends MY_Model {

    public $table = "bitacora";
    public $primary_key = "id";

    public function __construct() {
        $this->_database_connection = "sgrc";
        $this->db_sgrc = $this->load->database('sgrc', TRUE);
        
        $this->timestamps = FALSE;

        $this->return_as = 'array';

        parent::__construct();
    }
//    function get_all_log() {
//        $sql = 'SELECT
//                    bitacora.id,
//                    bitacora.last_activity,
//                    bitacora.ip_address,
//                    bitacora.id_usuario,
//                    bitacora.`user`,
//                    bitacora.rol,
//                    bitacora.area,
//                    bitacora.descripcion
//                    FROM
//                    bitacora
//                    ORDER BY
//                    bitacora.last_activity DESC';
//        $query = $this->db->query($sql);
//
//        return $query->result_array();
//    }
    
    function mostrar_logs(){
        $sql = "SELECT * FROM bitacora";
        $query = $this->db_sgrc->query($sql);
        return $query->result_array();
    }

    function registrar_log($accion) {        
        $log_data = array(
            "last_activity" => date('Y-m-d H:m:s'),
            "ip_address"    => $_SERVER['REMOTE_ADDR'], //$this->session->userdata('ip_address'),
            "id_usuario"    => $this->session->userdata('id'),
            "user"          => $this->session->userdata('usuario'),            
            "area"          => $this->session->userdata('id_area'),
            "descripcion"   => $accion
        );
        $this->insert($log_data);
    }    
    
    
    function registrar_log_ficha($datos,$idcontrato) {
        $cont = count($datos);
        for ($i = 0; $i < $cont; $i++) {
            if ($datos[$i] != null || $datos[$i] != "") {
                $log_data = array(
                   "last_activity" => date('Y-m-d H:m:s'),
                    "ip_address"    => $_SERVER['REMOTE_ADDR'], //$this->session->userdata('ip_address'),
                    "id_usuario"    => $this->session->userdata('id'),
                    "user"          => $this->session->userdata('usuario'),            
                    "area"          => $this->session->userdata('id_area'),
                    "descripcion"   => 'Se ha insertado la ficha cliente: '.$datos[$i].' para el contrato: '.$idcontrato,                    
                );
                $this->insert($log_data);
            }
        }
    }

}

/* End of file Log_model.php */
/* Location: ./application/models/Log_model.php */
