<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Empresas_model extends MY_Model {

    public $table = "empresas";
    public $primary_key = "id_empresa";

    // public $fillable = array('nombre');

    public function __construct() {
        $this->_database_connection = "sgrc";
        $this->timestamps = FALSE;
        $this->return_as = 'array';

        parent::__construct();
    }

    public function existe($provedor) {
        $this->db_sgrc = $this->load->database('sgrc', TRUE);
//        $data = $this->get(array('nombre_empresa' => $provedor));
//        echo "<PRE>";
//        print_r($data);
//        echo "</PRE>";
//        echo $cont = count($data);
//        echo $provedor;
       $this->db_sgrc->like('nombre_empresa', $provedor);
       $query = $this->db_sgrc->get('empresas');
//       $data = $query->result();
//               echo "<PRE>";
//        print_r($data);
//        echo "</PRE>";
        if ($query->num_rows() > 0) {
            return true;
        }
        else{
            return false;
        }
        

//        if ($cont>0) {
//            return true;
//        }
//        else{
//            return false;
//        }
    }
    
    //Devuelve un listado de empresas en dependencia del tipo de empresa pasado por parametro
    public function tipo_empresa($tipo_empresa){ 
        $this->db_sgrc = $this->load->database('sgrc', TRUE);
        $this->db_sgrc->where('tipo_empresa', $tipo_empresa);        
        $this->db_sgrc->order_by('nombre_empresa asc');
        $query = $this->db_sgrc->get('empresas');
        return $query->result_array();     
    }

}

/* End of file Empresa_model.php */
/* Location: ./application/models/Empresa_model.php */
