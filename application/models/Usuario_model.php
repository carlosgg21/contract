<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Modelo para la gestión de los usuarios del sistema 
 * y los permisos 
 */
class Usuario_model extends CI_Model {
    
    function check_usuario_sistema($usuario) {
        $db_acceso = $this->load->database('acceso', TRUE);
        $db_acceso->where('usuario', $usuario);
        $db_acceso->where('idSistema', 9);
        $db_acceso->where('estado_permiso <>', '0');
        $db_acceso->join('roles', 'permisos.idRol = roles.id_roles');
        $db_acceso->join('usuarios', 'permisos.idUsuario = usuarios.id_usuario');
        $query = $db_acceso->get('permisos');

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }else{
            return FALSE;
        }        
    }
    
    function get_login_usuario($ci){      
         
        $this->db_sgrc = $this->load->database('sgrc', TRUE);         
        
        $ip = $_SERVER['REMOTE_ADDR'];
        $sql = "select * from usuario_conectado where ci='$ci' and ip !='$ip'";        
        $query = $this->db_sgrc->query($sql)->result();  
        return $query;
   }    
   
   function check_permiso($user,$rol){ 
       $db_acceso = $this->load->database('acceso', TRUE);
        
        $sql = "SELECT usuarios.id_usuario, usuarios.ci, usuarios.nombre_apellidos, usuarios.usuario, usuarios.jefe, 
                    usuarios.correo, cargo.nombre_cargo, area.identificador_area, area.nombre_area, estado.estado,
                    sistemas.nombre_sistema, roles.id_roles, roles.estado_rol
                FROM usuarios
                    INNER JOIN cargo ON (usuarios.idCargo = cargo.id_cargo)
                    INNER JOIN area ON (usuarios.idArea = area.id_area)
                    INNER JOIN estado ON (usuarios.idEstado = estado.id_estado)
                    INNER JOIN permisos ON (usuarios.id_usuario = permisos.idUsuario)
                    INNER JOIN sistemas ON (permisos.idSistema = sistemas.id_sistema)
                    INNER JOIN roles ON (permisos.idRol = roles.id_roles)
                WHERE
                  permisos.estado_permiso <> '0' AND 
                  usuarios.usuario =  '$user' AND 
                  roles.id_roles = '$rol' AND
                  estado.estado = 'ALTA' AND 
                  roles.estado_rol = '1'";
        $query = $db_acceso->query($sql)->result();
        
        if(count($query) > 0){            
            return true;
        }else{
            echo '<script>alert("Usted no tiene acceso a la URL solicitada");</script>';
            //echo "<script>window.location.replace('http://192.168.5.32/acceso_n/');</script>";
        }            
    }
    
    function get_usuario_sistema() {
        $db_acceso = $this->load->database('acceso', TRUE);
        $sql = "SELECT * FROM usuarios
                    INNER JOIN permisos ON (usuarios.id_usuario = permisos.idUsuario)
                    INNER JOIN sistemas ON (permisos.idSistema = sistemas.id_sistema)
                    INNER JOIN roles ON (permisos.idRol = roles.id_roles)
                    INNER JOIN area ON (usuarios.idArea = area.id_area)
                    INNER JOIN cargo ON (usuarios.idCargo = cargo.id_cargo)
                    INNER JOIN estado ON (usuarios.idEstado = estado.id_estado)
                WHERE  sistemas.id_sistema = '9' AND estado.estado <> 'BAJA' AND permisos.estado_permiso != '3'";

        $query = $db_acceso->query($sql);
        return $query->result_array();
    }  
    
    public function get_trabajadores() {        
        $db_acceso = $this->load->database('acceso', TRUE);
        $db_acceso->where('idEstado <>', 2);
        $db_acceso->order_by("nombre_apellidos", "asc");
        $query = $db_acceso->get('usuarios');
        return $query->result_array();
        
    }
    
    public function get_roles_sistema(){
        $db_acceso = $this->load->database('acceso', TRUE);        
        $sql="select r.nombre_rol, r.id_roles from roles r
                inner join sistemas_roles sr on r.id_roles = sr.idRol
                where sr.idSistema=9";
        $query = $db_acceso->query($sql);
        return $query->result_array();
    }
    
    /**
     * cambia el estado del usuario en la tabla permisos 
     * @param type $id_usuario
     * @param type $accion
     */
    function estado_usuario($id_usuario, $accion) {
        $db_acceso = $this->load->database('acceso', TRUE);
        $datos = array(
            'estado_permiso' => $accion,
            'fecha_cancelacion_p' => date('Y-m-d')
        );

        $db_acceso->where('idSistema', 9);
        $db_acceso->where('idUsuario', $id_usuario);
        $db_acceso->update('permisos', $datos);
    }
    
    /**
     * cambia el rol del usuario
     * @param type $id_usuario
     * @param type $id_rol
     */
    function change_rol($id_usuario, $id_rol) {
        $db_acceso = $this->load->database('acceso', TRUE);
        $datos = array(
            'idRol' => $id_rol
        );
        $db_acceso->where('idSistema', 9);
        $db_acceso->where('idUsuario', $id_usuario);
        $db_acceso->update('permisos', $datos);
    }
    
    /**
     * Verifica que el usuario exista en el sistema 
     * si existe no se puede agregar de nuevo
     * @param type $id_usuario
     * @return boolean
     */
    function check_usuario($id_usuario) {
        $db_acceso = $this->load->database('acceso', TRUE);
        //busca un usuario en la tabla permisos con el id pasado por paramtros y del sistema 9 (No conformidad)
        $db_acceso->where('idUsuario', $id_usuario);
        $db_acceso->where('idSistema', 9);
        $query = $db_acceso->get('permisos');
        //si el número de filas devuelto es mayor que cero es que existe un usuario
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //inserta en la tabla permisos, los permisos para un usuario determinado
    function insert_usuario($datos) {
            $data = array(
            'idUsuario' => $datos['idUsuario'],
            'idSistema' => 9,
            'idRol' => $datos['idRol'],
            'fecha_creacion' => date('Y-m-d'),            
            'creado_por' => $this->session->userdata('user') 
        );

        $db_acceso = $this->load->database('acceso', TRUE);
        $db_acceso->insert('permisos', $data);
    }
    
    // devuelve el nombre y los apellidos de un usuario dado su id
    function show_user($id_usuario) { 
        $db_acceso = $this->load->database('acceso', TRUE);
        //$db_acceso->select('usuario');
        $db_acceso->select('nombre_apellidos');
        $db_acceso->where('id_usuario', $id_usuario);    
        $query = $db_acceso->get('usuarios');      
        return $query->result();
    } 
    
    /**
     * Elimina al usuario de la base de datos
     * @param type $id
     */
    function delete_user($id) {
        $db_acceso = $this->load->database('acceso', TRUE);
        $db_acceso->delete('permisos', array('idUsuario' => $id,'idSistema'=>9));
    }
    
}

/* End of file newci_model.php */
/* Location: ./application/models/newci_model.php */
