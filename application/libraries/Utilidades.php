<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utilidades
 *
 * @author carlos
 */
class Utilidades
{

    /**
     * Agrupa elementos de una arrgeglo
     * resive como parametros: el arreglo y el campo dentro del arreglo por
     * el que se queire agrupar
     * @param type $array
     * @param type $key
     * 
     * @return type
     */
    function contratos_caducos()
    { //
        $CI = &get_instance();
        $CI->load->model('Contratos_model', 'contrato');

        $cant = count($CI->contrato->get_caducan_proxmimo_mes());
        return $cant;
    }

    function close_session()
    {
        $CI = &get_instance();
        $CI->load->library('session');
        $CI->session->sess_destroy();
        redirect('http://192.168.5.64/intranet/inicio');
    }

    function chequear_loggin()
    {
        $CI = &get_instance();
        $CI->load->model('Usuario_model');
        $CI->load->library('session');

        //compruebo que existe la session
        //if (!isset($_SESSION['user'])) {
        //if (!($CI->session->userdata('usuario'))) {
        if (($CI->session->userdata('usuario')) == NULL) {
            echo '<script>alert("Debe estar autenticado");</script>';
            echo "<script>window.location.replace('http://192.168.5.64/intranet/inicio');</script>";
        } else {
            //compruebo que existe ese usuario en el sistema
            $user = $CI->session->userdata('usuario');

            if (!$CI->Usuario_model->check_usuario_sistema($user)) {
                echo '<script>alert("Uds. no es usuario del sistema");</script>';
                echo "<script>window.location.replace('http://192.168.5.64/intranet/inicio');</script>";
            } else {
                // compruebo que no este logueado en otra pc  
                $conect = $CI->Usuario_model->get_login_usuario($CI->session->userdata('ci'));
                if (count($conect) != 0) {
                    echo '<script>alert("Usuario registrado en otra estacion de trabajo");</script>';
                    echo "<script>window.location.replace('http://192.168.5.64/intranet/inicio');</script>";
                } else {
                    //$CI->usuario_model->begin_session($CI->usuario_model->check_usuario_sistema($user));
                    $correcto = true;
                }
            }
        }
    }

    /**
     * agrupa los datos de un arreglo según el parametro pasado
     * $key es el campo dentro del arreglo por el que se queire agrupar
     * 
     * @param type $array
     * @param type $key
     * @return type
     */
    function group_assoc($array, $key)
    {
        $return = array();
        foreach ($array as $v) {
            $return[$v[$key]][] = $v;
        }
        return $return;
    }

    function percentage($part, $otal)
    {
        return ($part/$otal)*100;
    }
}
