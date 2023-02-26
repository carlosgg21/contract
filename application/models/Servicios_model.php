<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Servicios_model extends MY_Model {

    public $table = "tipos_servicios";
    public $primary_key = "id_servicio";
    
    protected $dbc;  

    // public $fillable = array('nombre');

    public function __construct() {        
        $this->dbc = $this->load->database('sgrc', TRUE); 
        $this->_database_connection = "sgrc";
        
        $this->timestamps = FALSE;
        $this->return_as = 'array';

        parent::__construct();
    }
    
    public function showEstado ($id){ //función que muestra el estado de un servicio dado el id
        $this->dbc->select('estado'); 
        $this->dbc->where('id_servicio',$id);         
        $query =  $this->dbc->get('tipos_servicios');
        $result = $query->result(); 
        return $result[0];
    }
    
    function update_estado($id) { //función que actualiza el estado de una servicio dado el id 
        $est_servicio = $this->servicios->showEstado($id);
        $estado = 1;
        if($est_servicio->estado == 1){ 
            $estado = 0;
        }       
        $datos = array(
            'estado' => $estado,
        );        
         $this->dbc->where('id_servicio',$id);
         $this->dbc->update('tipos_servicios',$datos);
    }
    
    public function get_servicios (){ //función que devuelve los servicios
        $this->dbc->select('*');       
        $this->dbc->order_by('nombre_servicio asc');
        $query =  $this->dbc->get('tipos_servicios');
        return $query->result_array();       
    }
    

}

/* End of file Servicios_model.php */
/* Location: ./application/models/Servicios_model.php */
