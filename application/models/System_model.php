<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class System_model extends CI_Model
{
    protected $db_sgrc;

    public function __construct()
    {
        parent::__construct();

        // Carga la base de datos
        $this->db_sgrc = $this->load->database('sgrc', TRUE);

        // Ejecuta una consulta SQL al iniciar el sistema
        $this->db->query("SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
   
    }
}


