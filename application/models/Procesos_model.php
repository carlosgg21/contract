<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Procesos_model extends CI_Model {

    /**
     * Servicio web 
     * Devuelve todos los procesos activos en el sistema de no Conformidades 
     *  "id": identificador del proceso",
        "proceso": nombre del proceso,
        "jefe_proceso": Jefe del proceso,
        "estado": estado
     * @return string
     */
    function get_all() {
        if (!$datos = file_get_contents('http://192.168.5.64/rest_api/procesos?format=json')) {
            return "HTTP request failed. Error was";
        }
        else {
            $datos = file_get_contents('http://192.168.5.64/rest_api/procesos?format=json');
            return json_decode($datos, true);
        }
    }

}

/* End of file Procesos_model.php */
/* Location: ./application/models/Procesos_model.php */
