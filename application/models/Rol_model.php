<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Rol_model extends CI_Model {

    /**
     * devulve los roles del sistema Hoy en el Mercado
     * @return type
     */
    public function get_roles_sistema() {
        $db_acceso = $this->load->database('acceso', TRUE);
        $sql = "SELECT roles.id_roles, roles.nombre_rol,roles.descripcion,sistemas.id_sistema,
                       sistemas.nombre_sistema,sistemas.estado_sistema,sistemas.administrador_informatico,
                       sistemas.administrador_sistema,sistemas.nombre_corto,roles.estado_rol
                FROM
                  roles
                  INNER JOIN sistemas_roles ON (roles.id_roles = sistemas_roles.idRol)
                  INNER JOIN sistemas ON (sistemas_roles.idSistema = sistemas.id_sistema)
                WHERE
                  sistemas.id_sistema = '9' AND 
                  roles.estado_rol  <> 0 AND
                  sistemas.estado_sistema <>0";

        $query = $db_acceso->query($sql);
        return $query->result_array();
    }

}

/* End of file rolesi_model.php */
/* Location: ./application/models/rolesi_model.php */
