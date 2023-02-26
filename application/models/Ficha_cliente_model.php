<?php 
    if ( ! defined('BASEPATH')) 
        exit('No direct script access allowed');

class Ficha_cliente_model extends MY_Model {

    
//    protected $db_sgrc; 
	
    // public $return_type = 'array';
    public $table = "ficha_clientes";
    public $primary_key = "id_ficha";

    // public $fillable = array('nombre');

    public function __construct() {
        $this->_database_connection = "sgrc";
        $this->db_sgrc = $this->load->database('sgrc', TRUE);
        
        $this->timestamps = FALSE;

        $this->return_as = 'array';

        parent::__construct();
    }
    
    public function get_trabajadores() {
        if (!$datos = file_get_contents('http://192.168.5.64/rest_api/usuario?format=json')) {
            return "HTTP request failed. Error was";
        }
        else {
            $datos = file_get_contents('http://192.168.5.64/rest_api/usuario?format=json');
            return json_decode($datos, true);
        }
    }
    public function get_trabajador_by_id($id) {
//        http://localhost/rest_api/usuario/usuarios/id/110
          if (!$datos = file_get_contents('http://192.168.5.64/rest_api/usuario/usuario/id/'.$id.'?format=json')) {
            return "HTTP request failed. Error was";
        }
        else {
            $datos = file_get_contents('http://192.168.5.64/rest_api/usuario/usuario/id/'.$id.'?format=json');
            return json_decode($datos, true);
        }
    }     
    
    public function get_ficha_by_contrato(){
        $sql = "SELECT f.cliente_nombre_apellidos,cf.idContrato FROM contrato_fichaCliente cf
                inner join ficha_clientes f on cf.idFichaCliente = f.id_ficha";
        $query = $this->db_sgrc->query($sql)->result_array();        
        return $query;
    }
    
    public function get_guardadas($id_contrato){
         $sql = "SELECT cp.id_contrato, fc.idFichaCliente, fc.id, f.cliente_nombre_apellidos
                FROM contratro_provedor AS cp
                INNER JOIN contrato_fichaCliente AS fc ON cp.id_contrato = fc.idContrato
                INNER JOIN ficha_clientes AS f ON f.id_ficha = fc.idFichaCliente
                WHERE cp.id_contrato = '$id_contrato'";
        $query = $this->db_sgrc->query($sql)->result_array();        
        return $query;
    }
    
}

/* End of file ficha_cliente_model.php */
/* Location: ./application/models/ficha_cliente_model.php */
