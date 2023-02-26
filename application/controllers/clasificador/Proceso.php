<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Proceso extends CI_Controller {

    function __construct() {
        parent::__construct();
         $this->load->model('Procesos_model', 'proceso');
    }

    public function index() {        
        $data['datos'] = $this->proceso->get_all();       
        $data['main'] = 'clasificadores/proceso_view';
        $this->load->view('template/layout', $data);
    }

}

/* End of file Procesos.php */
/* Location: ./application/controllers/Procesos.php */
