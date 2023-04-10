<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contratos_model extends CI_Model
{
    use ContractTrait;

    // protected $db_sgrc; 
    public $cant_caducos;

    // function __construct() {
    //     parent::__construct();
    //     $this->db_sgrc = $this->load->database('sgrc', TRUE);
    // }

    public function resumen()
    {
        $vigentes = $this->get_contratos_vigentes();
        $caducos = $this->get_contratos_caducos();

        $datos = array(
            'cant_vigentes' => count($vigentes),
            'cant_caducos' => count($caducos),
        );
        return $datos;
    }

    function get_contratos_vigentes()
    {
        $fecha = date('Y') . "-" . date("m") . "-" . date("d");
        $sql = "SELECT * FROM contratro_provedor
                    INNER JOIN empresas ON contratro_provedor.idEmpresa = empresas.id_empresa
                    INNER JOIN tipos_servicios ON contratro_provedor.idTipoServicio = tipos_servicios.id_servicio
                    INNER JOIN procesos ON contratro_provedor.id_procesos = procesos.id_proceso 
                WHERE
                    (contratro_provedor.estado_contrato = '1' OR contratro_provedor.estado_contrato = '2')  
                AND (contratro_provedor.fecha_expira = '0000-00-00' OR contratro_provedor.fecha_expira >= '$fecha')";

        $query = $this->db_sgrc->query($sql);
        return $query->result_array();
    }

    function get_observaciones_contrato($id)
    {
        $sql = "SELECT observaciones FROM contratro_provedor
                WHERE id_contrato='$id'";

        $query = $this->db_sgrc->query($sql);
        $result = $query->result();
        return $result;
    }

    function get_ficha_contrato($id)
    {
        $sql = "SELECT cliente_nombre_apellidos FROM contrato_fichaCliente as c
                inner join ficha_clientes as fc on c.idFichaCliente = fc.id_ficha
                WHERE idContrato = '$id'";
        $query = $this->db_sgrc->query($sql);
        return $query->result_array();
    }

    function get_contratos_sinadjunto()
    {
        $this->db_sgrc->where('documento', NULL);
        $this->db_sgrc->or_where('documento', "");

        $this->db_sgrc->join('contratro_provedor', 'empresas.id_empresa = contratro_provedor.idEmpresa', 'left');
        $this->db_sgrc->join('tipos_servicios', 'contratro_provedor.idTipoServicio = tipos_servicios.id_servicio');
        $this->db_sgrc->order_by('fecha_firma asc');
        $query = $this->db_sgrc->get('empresas');
        return $query->result_array();
    }

    function get_contratos_caducos()
    {

        $fecha = date('Y') . "-" . date("m") . "-" . date("d");
        $sql = "SELECT *FROM   empresas
                      INNER JOIN contratro_provedor ON (empresas.id_empresa = contratro_provedor.idEmpresa)
                      INNER JOIN tipos_servicios ON (contratro_provedor.idTipoServicio = tipos_servicios.id_servicio)
                    WHERE
                      (contratro_provedor.estado_contrato = '1' OR contratro_provedor.estado_contrato = '2')AND contratro_provedor.fecha_expira <> '0000-00-00' AND 
                      contratro_provedor.fecha_expira <= '$fecha'";
        $query = $this->db_sgrc->query($sql);
        return $query->result_array();
    }

    public function cant_caducan_pm()
    {
        //$this->contrato->get_caducan_proxmimo_mes();
        return count($this->contrato->get_caducan_proxmimo_mes());
    }

    /**
     * devulve todo los contratos que caduquen dentro del rango de fecha del mes 
     * tomando como referencia el dia actual 
     * @return type
     */
    //    function get_caducan_proxmimo_mes() {
    //        // fecha de inicio (año actual / mes actual mas uno / inicio del mes)
    //        $fecha_i = date('Y') . "-" . date("m", strtotime('+1 month')) . "-" . "01";
    //        // fecha de fin (año actual / mes actual mas uno / fin del mes )
    //        $fecha_f = date('Y') . "-" . date("m", strtotime('+1 month')) . "-" . "31";
    //
    //        $this->db_sgrc->where('estado_contrato', "1");
    //        $this->db_sgrc->where('fecha_expira >=', $fecha_i); // entre fecha de inicio y fecha de fin 
    //        $this->db_sgrc->where('fecha_expira <=', $fecha_f);
    //        $this->db_sgrc->where('fecha_expira !=', "0000-00-00"); // distinto a los que no tienen fecha de expiracion 
    //        $this->db_sgrc->join('contratro_provedor', 'empresas.id_empresa = contratro_provedor.idEmpresa');
    //        $this->db_sgrc->join('tipos_servicios', 'contratro_provedor.idTipoServicio = tipos_servicios.id_servicio');
    //        $this->db_sgrc->order_by('fecha_firma desc');
    //        $query = $this->db_sgrc->get('empresas');
    //
    //        return $query->result_array();
    //    }

    function get_caducan_proxmimo_mes()
    {
        $sql = "SELECT * FROM registro_contratos.contratro_provedor
                INNER JOIN registro_contratos.tipos_servicios ON registro_contratos.contratro_provedor.idTipoServicio = registro_contratos.tipos_servicios.id_servicio
                INNER JOIN registro_contratos.empresas ON registro_contratos.contratro_provedor.idEmpresa = registro_contratos.empresas.id_empresa
                INNER JOIN bd_no_conformidad.c_procesos ON registro_contratos.contratro_provedor.id_procesos = bd_no_conformidad.c_procesos.id
                INNER JOIN bd_stmaAcceso.usuarios ON bd_no_conformidad.c_procesos.jefe_proceso = bd_stmaAcceso.usuarios.nombre_apellidos
		WHERE (DATEDIFF(registro_contratos.contratro_provedor.fecha_expira,CURDATE()))>= 1 AND 
		      (DATEDIFF(registro_contratos.contratro_provedor.fecha_expira,CURDATE())) <= 31";
        $query = $this->db_sgrc->query($sql)->result_array();
        return $query;
    }


    //DATE_SUB(contratro_provedor.fecha_expira,INTERVAL 1 MONTH) =  CURDATE() AND

    //    function delete_contrato($id) {
    //        $this->db_sgrc->where('id_contrato', $id);
    //        $this->db_sgrc->delete('contratro_provedor');
    //    }

    function get_contrato_byId($id)
    {

        $this->db_sgrc->where('id_contrato', $id);
        $this->db_sgrc->join('tipos_servicios', 'contratro_provedor.idTipoServicio = tipos_servicios.id_servicio');
        $this->db_sgrc->join('empresas', 'contratro_provedor.idEmpresa = empresas.id_empresa');
        $this->db_sgrc->join('procesos', 'contratro_provedor.id_procesos = procesos.id_proceso', 'left');
        $this->db_sgrc->order_by('fecha_firma asc');
        $query = $this->db_sgrc->get('contratro_provedor');
        return $query->row_array();
    }

    function get_fclientes_byIdcontrato($id)
    {
        $this->db_sgrc->where('id_contrato', $id);
        $this->db_sgrc->join('contrato_fichaCliente', 'contratro_provedor.id_contrato = contrato_fichaCliente.idContrato');
        $this->db_sgrc->join('ficha_clientes', 'contrato_fichaCliente.idFichaCliente = ficha_clientes.id_ficha');

        $query = $this->db_sgrc->get('contratro_provedor');
        return $query->result_array();
    }

    function add_contrato_proveedor($datos)
    {
        if ($datos['vigencia'] == 0) {
            $datos['periodo'] = " ";
        }
        if ($datos['fecha_expira'] == 0) {
            $datos['fecha_expira'] = "0000-00-00";
        }

        $this->db_sgrc->insert('contratro_provedor', $datos);
        $query = $this->db_sgrc->query('SELECT LAST_INSERT_ID()');
        $row = $query->row_array();
        return $LastIdInserted = $row['LAST_INSERT_ID()'];
    }

    function add_contrato_fichaCliente($idcontrato, $datos)
    {

        $cont = count($datos);
        for ($i = 0; $i < $cont; $i++) {
            if ($datos[$i] != null || $datos[$i] != "") {
                $data = array(
                    "idContrato" => $idcontrato,
                    "idFichaCliente" => $datos[$i]
                );
                $this->db_sgrc->insert('contrato_fichaCliente', $data);
            }
        }
    }

    function cancelar_contrato_proveedor($id)
    {
        $datos = array(
            'estado_contrato' => "0",
            'fecha_cancelacion' => date('Y-m-d')
        );
        $this->db_sgrc->where('id_contrato', $id);
        $this->db_sgrc->update('contratro_provedor', $datos);
    }

    function modificar_contrato_proveedor($id, $datos)
    {
        if ($datos['fecha_expira'] == 0 || $datos['fecha_expira'] == "" || $datos['fecha_expira'] == null) {
            $datos['fecha_expira'] = "0000-00-00";
        }

        $this->db_sgrc->where('id_contrato', $id);
        $this->db_sgrc->update('contratro_provedor', $datos);
    }

    //    function modifificar_contrato_fichaCliente1($id, $datos) {
    //        $this->delete_fichaCliente($id);
    //        $this->add_contrato_fichaCliente($id, $datos);        
    //    }

    function modifificar_contrato_fichaCliente($id_contrato, $datos)
    {
        //        $this->delete_fichaCliente($id_contrato);
        //        
        //        foreach ($datos as $row){
        //            $this->add_contrato_fichaCliente($id_contrato,$row);   
        //        };

        //        $this->db_sgrc->where('id_contrato', $id);
        //        $this->db_sgrc->where('id_ficha', $id);
        //        $this->db_sgrc->update('contrato_fichaCliente', $datos); 

        //covid19
        $this->delete_fichaCliente($id_contrato);
        $cont = count($datos);
        for ($i = 0; $i < $cont; $i++) {
            $this->add_contrato_fichaCliente($id_contrato, $datos[$i]);
        }
    }

    function delete_fichaCliente($idcontrato)
    {

        $ficha_byIdContrato = $this->get_fclientes_byIdcontrato($idcontrato);
        if (count($ficha_byIdContrato) > 0) {
            //            die('aki');
            $this->db_sgrc->where('idContrato', $idcontrato);
            $this->db_sgrc->delete('contrato_fichaCliente');
        }
        //        else
        //        {
        ////            die('uhm');
        //        }
    }

    function get_cancelados()
    {
        $this->db_sgrc->join('empresas', 'contratro_provedor.idEmpresa = empresas.id_empresa');
        $this->db_sgrc->join('tipos_servicios', 'contratro_provedor.idTipoServicio = tipos_servicios.id_servicio');
        $this->db_sgrc->where('estado_contrato', "0");
        $this->db_sgrc->order_by('fecha_cancelacion desc');
        $query = $this->db_sgrc->get('contratro_provedor');
        return $query->result_array();
    }

    /* EMPRESAS */

    function get_contratos_byempresa($id_empresa)
    {

        $this->db_sgrc->where('idEmpresa', $id_empresa);
        $this->db_sgrc->join('empresas', 'contratro_provedor.idEmpresa = empresas.id_empresa');
        $this->db_sgrc->join('tipos_servicios', 'contratro_provedor.idTipoServicio = tipos_servicios.id_servicio');
        $this->db_sgrc->order_by('fecha_firma asc');
        $query = $this->db_sgrc->get('contratro_provedor');
        return $query->result_array();
    }

    /* SERVICIOS DE LOS CONTRATOS
     * ------------------------------------
     */

    function get_contratos_byservicio($id_servicio)
    {

        $this->db_sgrc->where('id_servicio', $id_servicio);
        $this->db_sgrc->join('empresas', 'contratro_provedor.idEmpresa = empresas.id_empresa');
        $this->db_sgrc->join('tipos_servicios', 'contratro_provedor.idTipoServicio = tipos_servicios.id_servicio');
        $this->db_sgrc->order_by('fecha_firma asc');
        $query = $this->db_sgrc->get('contratro_provedor');
        return $query->result_array();
    }

    function get_contratos_byffirma($fecha)
    {

        $this->db_sgrc->where('fecha_firma', $fecha);
        $this->db_sgrc->join('empresas', 'contratro_provedor.idEmpresa = empresas.id_empresa');
        $this->db_sgrc->join('tipos_servicios', 'contratro_provedor.idTipoServicio = tipos_servicios.id_servicio');
        $this->db_sgrc->order_by('fecha_firma asc');
        $query = $this->db_sgrc->get('contratro_provedor');
        return $query->result_array();
    }

    //    function get_contrato_byproceso($idProceso) {
    //               
    //        $fecha = date('Y') . "-" . date("m") . "-" . date("d");
    //        $where = "(contratro_provedor.estado_contrato = '1' OR contratro_provedor.estado_contrato = '2')  
    //                     AND (contratro_provedor.fecha_expira = '0000-00-00' OR  contratro_provedor.fecha_expira >= '$fecha')";
    //        
    //        $this->db_sgrc->select('*');
    //        $this->db_sgrc->where('id_proceso', $idProceso);
    //        $this->db_sgrc->where($where);
    //        $this->db_sgrc->join('empresas', 'contratro_provedor.idEmpresa = empresas.id_empresa');
    //        $this->db_sgrc->join('tipos_servicios', 'contratro_provedor.idTipoServicio = tipos_servicios.id_servicio');
    //        $this->db_sgrc->join('procesos', 'contratro_provedor.id_procesos = procesos.id_proceso');
    //        //  INNER JOIN procesos ON (contratro_provedor.id_procesos = procesos.id_proceso)
    ////        $this->db_sgrc->order_by('fecha_firma asc');
    //        $query = $this->db_sgrc->get('contratro_provedor')->result_array();       
    //        return $query;
    //    }

    function get_contrato_byproceso($idProceso)
    {
        $sql = "SELECT registro_contratos.procesos.proceso, registro_contratos.contratro_provedor.id_contrato,
                       registro_contratos.contratro_provedor.no_contrato, registro_contratos.contratro_provedor.no_suplemento,
                       registro_contratos.contratro_provedor.fecha_firma, registro_contratos.empresas.nombre_empresa,
                       registro_contratos.tipos_servicios.nombre_servicio, registro_contratos.contratro_provedor.fecha_expira,
                       registro_contratos.contratro_provedor.observaciones, registro_contratos.contratro_provedor.documento
                FROM registro_contratos.contratro_provedor
                    INNER JOIN registro_contratos.empresas ON registro_contratos.contratro_provedor.idEmpresa = registro_contratos.empresas.id_empresa
                    INNER JOIN registro_contratos.tipos_servicios ON registro_contratos.contratro_provedor.idTipoServicio = registro_contratos.tipos_servicios.id_servicio
                    INNER JOIN registro_contratos.procesos ON registro_contratos.contratro_provedor.id_procesos = registro_contratos.procesos.id_proceso
                WHERE registro_contratos.contratro_provedor.id_procesos = $idProceso AND 
                ((contratro_provedor.estado_contrato = '1' OR contratro_provedor.estado_contrato = '2')  
                        AND (contratro_provedor.fecha_expira = '0000-00-00' OR  contratro_provedor.fecha_expira >= '2018-07-10'))";
        $query = $this->db_sgrc->query($sql)->result_array();
        return $query;
    }

    /**
     * contratos vigentes sin ficha de clientes
     * @param type $param
     */
    function get_contratos_sinFichaCliente()
    {
        $fecha = date('Y') . "-" . date("m") . "-" . date("d");
        $where = "(contratro_provedor.estado_contrato = '1' OR contratro_provedor.estado_contrato = '2')  
                     AND (contratro_provedor.fecha_expira = '0000-00-00' OR  contratro_provedor.fecha_expira >= '$fecha')";
        $where1 = "contrato_fichaCliente.idContrato is NULL";


        $this->db_sgrc->where($where);
        $this->db_sgrc->where($where1);
        $this->db_sgrc->join('empresas', 'contratro_provedor.idEmpresa = empresas.id_empresa');
        $this->db_sgrc->join('tipos_servicios', 'contratro_provedor.idTipoServicio = tipos_servicios.id_servicio');


        $this->db_sgrc->join('contrato_fichaCliente', 'contratro_provedor.id_contrato = contrato_fichaCliente.idContrato', 'left');
        $this->db_sgrc->join('ficha_clientes', 'contrato_fichaCliente.idFichaCliente = ficha_clientes.id_ficha', 'left');
        $this->db_sgrc->order_by('id_contrato asc');
        $query = $this->db_sgrc->get('contratro_provedor');
        return $query->result_array();
    }

    /**
     * contratos con la ficha de clientes donde esten usuarios que estan de baja 
     * @param type $param
     */
    //    function get_contratos_fichaDesactualizada() {
    //        $fecha = date('Y') . "-" . date("m") . "-" . date("d");
    //        $where = "(contratro_provedor.estado_contrato = '1' OR contratro_provedor.estado_contrato = '2')  
    //                     AND (contratro_provedor.fecha_expira = '0000-00-00' OR  contratro_provedor.fecha_expira >= '$fecha')";
    //
    //        $where1 = "usuarios.idEstado ='2'";
    //
    //        $this->db_sgrc->where($where);
    //        $this->db_sgrc->where($where1);
    //        $this->db_sgrc->join('empresas', 'contratro_provedor.idEmpresa = empresas.id_empresa');
    //        $this->db_sgrc->join('tipos_servicios', 'contratro_provedor.idTipoServicio = tipos_servicios.id_servicio');
    //        $this->db_sgrc->join('contrato_fichaCliente', 'contratro_provedor.id_contrato = contrato_fichaCliente.idContrato');
    //        $this->db_sgrc->join('ficha_clientes', 'contrato_fichaCliente.idFichaCliente = ficha_clientes.id_ficha');
    //        $this->db_sgrc->join('usuarios', 'ficha_clientes.idUsuario = usuarios.id_usuario');
    //
    //        $this->db_sgrc->order_by('id_contrato asc');
    //        $query = $this->db_sgrc->get('contratro_provedor');
    //        return $query->result_array();
    //    }

    //    function get_contratos_fichaDesactualizada() {
    //        //$db_acceso = $this->load->database('acceso', TRUE);
    //        $sql = "SELECT bd_regContrato.contratro_provedor.id_contrato, bd_regContrato.contratro_provedor.no_contrato,
    //                       bd_regContrato.contratro_provedor.no_suplemento, bd_regContrato.contratro_provedor.fecha_firma,
    //                       bd_regContrato.contratro_provedor.fecha_expira, bd_regContrato.empresas.nombre_empresa,
    //                       bd_regContrato.tipos_servicios.nombre_servicio, acceso.usuarios.nombre_apellidos
    //                FROM bd_regContrato.contratro_provedor
    //                    INNER JOIN bd_regContrato.empresas ON bd_regContrato.contratro_provedor.idEmpresa = bd_regContrato.empresas.id_empresa
    //                    INNER JOIN bd_regContrato.tipos_servicios ON bd_regContrato.contratro_provedor.idTipoServicio = bd_regContrato.tipos_servicios.id_servicio
    //                    INNER JOIN bd_regContrato.contrato_fichaCliente ON bd_regContrato.contrato_fichaCliente.idcontrato = bd_regContrato.contratro_provedor.id_contrato
    //                    INNER JOIN bd_regContrato.ficha_clientes ON bd_regContrato.contrato_fichaCliente.idFichaCliente = bd_regContrato.ficha_clientes.id
    //                    INNER JOIN acceso.usuarios ON bd_regContrato.ficha_clientes.idUsuario = acceso.usuarios.id_usuario
    //                WHERE (bd_regContrato.contratro_provedor.estado_contrato = 1 OR bd_regContrato.contratro_provedor.estado_contrato = 2) AND
    //                      (bd_regContrato.contratro_provedor.fecha_expira = '0000-00-00' OR bd_regContrato.contratro_provedor.fecha_expira >= '2014-07-13') AND
    //                      acceso.usuarios.idEstado = 2";
    //        $query = $this->db_sgrc->query($sql)->result_array();
    //        return $query;
    //    }

    function get_contratos_fichaDesactualizada()
    {
        //$db_acceso = $this->load->database('acceso', TRUE);
        $sql = "SELECT registro_contratos.contratro_provedor.id_contrato, registro_contratos.contratro_provedor.no_contrato,
                       registro_contratos.contratro_provedor.no_suplemento, registro_contratos.contratro_provedor.fecha_firma,
                       registro_contratos.contratro_provedor.fecha_expira, registro_contratos.empresas.nombre_empresa,
                       registro_contratos.tipos_servicios.nombre_servicio, bd_stmaAcceso.usuarios.nombre_apellidos
                FROM registro_contratos.contratro_provedor
                    INNER JOIN registro_contratos.empresas ON registro_contratos.contratro_provedor.idEmpresa = registro_contratos.empresas.id_empresa
                    INNER JOIN registro_contratos.tipos_servicios ON registro_contratos.contratro_provedor.idTipoServicio = registro_contratos.tipos_servicios.id_servicio
                    INNER JOIN registro_contratos.contrato_fichaCliente ON registro_contratos.contrato_fichaCliente.idcontrato = registro_contratos.contratro_provedor.id_contrato
                    INNER JOIN registro_contratos.ficha_clientes ON registro_contratos.contrato_fichaCliente.idFichaCliente = registro_contratos.ficha_clientes.id_ficha
                    INNER JOIN bd_stmaAcceso.usuarios ON registro_contratos.ficha_clientes.idUsuario = bd_stmaAcceso.usuarios.id_usuario
                WHERE (registro_contratos.contratro_provedor.estado_contrato = 1 OR registro_contratos.contratro_provedor.estado_contrato = 2) AND
                      (registro_contratos.contratro_provedor.fecha_expira = '0000-00-00' OR registro_contratos.contratro_provedor.fecha_expira >= '2014-07-13') AND
                      bd_stmaAcceso.usuarios.idEstado = 2";
        $query = $this->db_sgrc->query($sql)->result_array();
        return $query;
    }

    /* ------------------------------------- */

    //Generar PDF
    public function rep_generar($datos)
    {
        $encabezado = $datos['encabezado'];
        $cuerpo = $datos['cuerpo'];

        // Generar el PDF
        //ob_clean();       
        $this->load->library('Pdf');

        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        //$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Banco de Inversiones S.A.');
        $pdf->SetTitle('');
        $pdf->SetSubject('');
        $pdf->SetKeywords('');

        $fontname = $pdf->addTTFfont('./application/libraries/tcpdf/fonts/utils/MyriadWebPro.ttf', 'TrueTypeUnicode', '', '32');
        //$fontname = $pdf->addTTFfont('./application/third_party/tcpdf/fonts/utils/MyriadWebProBold.ttf', 'TrueTypeUnicode', '', 32);
        // datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config

        if (isset($datos['titulo'])) {
            $titulo = (string) $datos['titulo'];
        }

        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Reporte_NC", "", array(25, 57, 98), array(25, 57, 98));
        $pdf->SetHeaderData('', '', PDF_HEADER_TITLE . $titulo, '', array(0, 0, 0), array(0, 0, 0));
        $pdf->setFooterData($tc = array(0, 0, 0), $lc = array(0, 0, 0));
        //$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
        //$pdf->setPrintHeader(false);
        //$pdf->setPrintFooter(false);
        // datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        //relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


        // ---------------------------------------------------------
        // establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
        //$pdf->SetFont('helvetica', '', 10, '', true);
        // Establecer el tipo de letra
        //Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
        // Helvetica para reducir el tamaño del archivo.
        //$pdf->SetFont('freemono', '', 11, '', true);
        // Añadir una página
        // Este método tiene varias opciones, consulta la documentación para más información.
        //            if(isset($datos['posicion'])){ 
        //                  $pdf->AddPage($datos['posicion'], 'A4');                 
        //            }		
        //            else{
        $pdf->AddPage('L');
        //                  $pdf->AddPage('P', 'A4');
        //            }	  
        //fijar efecto de sombra en el texto
        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
        // Establecemos el contenido para imprimir
        //-----------------------------------------------------------------------
        //Encabezado 
        //$pdf->SetFont('helvetica', '', 10, '', true);     
        $pdf->SetFont($fontname, '', 14, '', true);
        $html = <<<EOD
            $encabezado
EOD;
        //$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);		    
        $pdf->writeHTML($html, true, false, true, false, '');
        //Cuerpo
        $pdf->SetFont($fontname, '', 10, '', true);
        $html = <<<EOD
            $cuerpo
EOD;

        //$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);		    
        //$pdf->writeHTML($html, true, false, true, false, '');

        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Cerrar el documento PDF y preparamos la salida
        // Este método tiene varias opciones, consulte la documentación para más información.

        $nombre_archivo = utf8_decode($datos['nombre'] . '.pdf');
        $pdf->Output($nombre_archivo, 'I');
    }

    function do_upload()
    {
        $config['upload_path'] = './documents/contratos';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        } else {
            $data = array('upload_data' => $this->upload->data());
            return $data;
        }
    }

    function actualizar_contrato($id, $datos)
    { //función que actualiza un contrato dado el id   
        $this->db_sgrc->where('id_contrato', $id);
        $this->db_sgrc->update('contratro_provedor', $datos);
    }

    function update_estado($id)
    { //función que actualiza el estado de una servicio dado el id 
        $estado_actual = $this->servicios->showEstado($id);
        $estado = 1;
        if ($est_servicio->estado == 1) {
            $estado = 0;
        }
        $datos = array(
            'estado' => $estado,
        );
        $this->db_sgrc->where('id_servicio', $id);
        $this->db_sgrc->update('tipos_servicios', $datos);
    }

    function annos()
    {
        $sql = "SELECT DISTINCT year(registro_contratos.contratro_provedor.fecha_firma) AS year
                FROM registro_contratos.contratro_provedor
                where (registro_contratos.contratro_provedor.fecha_firma != '') AND (registro_contratos.contratro_provedor.fecha_firma != '0000-00-00')
                order by 1 ";
        $query = $this->db_sgrc->query($sql)->result_array();
        return $query;
    }

    function get_contratos_anno($year)
    {
        $sql = "SELECT year(registro_contratos.contratro_provedor.fecha_firma) as anno, 
                    registro_contratos.contratro_provedor.id_contrato, registro_contratos.contratro_provedor.no_contrato,
                    registro_contratos.contratro_provedor.no_suplemento, registro_contratos.contratro_provedor.fecha_firma,                    
                    registro_contratos.contratro_provedor.fecha_expira, registro_contratos.empresas.nombre_empresa,
                    registro_contratos.tipos_servicios.nombre_servicio, registro_contratos.contratro_provedor.documento,
                    registro_contratos.contratro_provedor.observaciones
                FROM registro_contratos.contratro_provedor
                INNER JOIN registro_contratos.empresas ON registro_contratos.contratro_provedor.idEmpresa = registro_contratos.empresas.id_empresa
                INNER JOIN registro_contratos.tipos_servicios ON registro_contratos.contratro_provedor.idTipoServicio = registro_contratos.tipos_servicios.id_servicio
                WHERE LEFT(registro_contratos.contratro_provedor.fecha_firma, 4) = '$year'";
        $query = $this->db_sgrc->query($sql)->result_array();
        return $query;
    }

    function get_procesos()
    {
        $sql = "SELECT * FROM procesos";
        $query = $this->db_sgrc->query($sql)->result_array();
        return $query;
    }


    function get_contratos()
    {
        $sql = "SELECT * FROM contratro_provedor";
        $query = $this->db_sgrc->query($sql)->result_array();
        return $query;
    }

    function get_suplementos_por_contrato($contrato)
    {
        //consulta original que dato un numero de contrato busca los suplementos asociados
        //        $sql = "SELECT cp.no_contrato, cp.no_suplemento, e.nombre_empresa, ts.nombre_servicio, cp.fecha_expira,
        //                       cp.fecha_firma, cp.documento,cp.observaciones 
        //                FROM contratro_provedor as cp
        //                    inner join empresas as e on cp.idEmpresa = e.id_Empresa
        //                    inner join tipos_servicios as ts on cp.idTipoServicio = ts.id_servicio
        //                where no_suplemento != '' and no_contrato = '$contrato'"; 

        //solucion a tarea del periodo covid19.     
        $sql = "SELECT cp.no_contrato, cp.no_suplemento, e.nombre_empresa, ts.nombre_servicio, cp.fecha_expira,
                cp.fecha_firma, cp.documento,cp.observaciones 
                FROM contratro_provedor as cp
                    inner join empresas as e on cp.idEmpresa = e.id_Empresa
                    inner join tipos_servicios as ts on cp.idTipoServicio = ts.id_servicio
                where no_suplemento != '' and (no_contrato = '$contrato' or no_suplemento like '%$contrato%')";
        $query = $this->db_sgrc->query($sql)->result_array();
        return $query;
    }

    function get_no_contrato()
    {
        $sql = "SELECT no_contrato FROM contratro_provedor WHERE no_contrato != ''";
        $query = $this->db_sgrc->query($sql)->result_array();
        return $query;
    }

    //    function update_empresas($empresas, $contratos){ //empleado para actualizar los nombres de la empresas al hacer la carga inicial
    //        foreach ($contratos as $v_contratos){
    //            foreach ($empresas as $v_empresas){
    //                if($v_contratos['Empresa'] == $v_empresas['nombre_empresa']){
    //                    $datos = array(
    //                        'idEmpresa' => $v_empresas['id_empresa'],
    //                    );                     
    //                    $this->db_sgrc->where('Empresa',$v_contratos['Empresa']);
    //                    $this->db_sgrc->update('contratro_provedor', $datos);
    //                }                    
    //            }            
    //        }        
    //    }

    //    function update_servicios($servicios, $contratos){ //empleado para actualizar los nombres de los servicios al hacer la carga inicial
    //        foreach ($contratos as $v_contratos){
    //            foreach ($servicios as $v_servicios){
    //                if($v_contratos['Servicio'] == $v_servicios['nombre_servicio']){
    //                    $datos = array(
    //                        'idTipoServicio' => $v_servicios['id_servicio'],
    //                    );                     
    //                    $this->db_sgrc->where('Servicio',$v_contratos['Servicio']);
    //                    $this->db_sgrc->update('contratro_provedor', $datos);
    //                }                    
    //            }            
    //        }        
    //    }




    /**
     * @NOVUM 12 febrero del 2023
     */

    /**
     * Años firmas con contratos vigentes
     */

    public function getAll()
    {
        return  $this->current()->result_array();
    }

    public function dataFilter()
    {
        return  [
            'years'      => $this->getCurrentContractsYear(),
            'servicios'  => $this->getCurrentContractsService(),
            'provedores' => $this->getCurrentContractsProvider(),
            'procesos'  => $this->getCurrentContractsProces(),
        ];
    }

    public function getCurrentContractsYear()
    {
        return  $this->current()
            ->select('year_firma')
            ->group_by('year_firma')
            ->order_by('year_firma desc')->get()
            ->result_array();
    }


    /**
     * Servicios con contratos vigentes
     */
    public function getCurrentContractsService()
    {
        return  $this->current()
            ->select('idTipoServicio,nombre_servicio')
            ->group_by('idTipoServicio')
            ->order_by('nombre_servicio desc')->get()
            ->result_array();
    }

    /**
     * Provedores con contratos vigentes
     */
    public function getCurrentContractsProvider()
    {
        return  $this->current()
            ->select('idEmpresa,nombre_empresa')
            ->group_by('idEmpresa')
            ->order_by('nombre_empresa desc')->get()
            ->result_array();
    }

    /**
     * Proceso con contratos vigentes
     *
     * @return void
     */
    public function getCurrentContractsProces()
    {
        return  $this->current()
            ->select('id_procesos,proceso')
            ->group_by('id_procesos')
            ->order_by('proceso desc')->get()
            ->result_array();
    }


    /**
     * Filtral resultadps 
     *
     * @param [post request] $request
     * @return void
     */
    public function getFilterQuery($request = 0)
    {
              
        if (!empty($request['todos_contratos'])) {
            $query  = $this->current_all();     
             
        }else{
            $query = $this->current();
            if (empty($request['vigentes'])){
                $query->where('year_firma', date('Y'));
            }

            $this->applyFilters($query, $request);
     
        }
        return $query->order_by('year_firma', 'DESC')->get()->result_array();  
    }


    private function applyFilters($query, $request)
    {
        $filters = [
            'year_firma'  => 'year_firma',
            'servicio'    => 'idTipoServicio',
            'provedor'    => 'idEmpresa',
            'proceso'     => 'id_procesos',
            'fecha_firma' => 'fecha_firma',
            'fecha_vence' => 'fecha_expira',
        ];

        foreach ($filters as $requestKey => $filter) {
            if (!empty($request[$requestKey])) {
                $query->where($filter, $request[$requestKey]);
            }
        }
    }

    /**
     * Devuelve el Contrato Marco con sus suplementoslike
     *
     * @param [type] $idContrato
     * @return void
     */
    public function getContractWithSupplement($idContrato)
    {

        $this->db_sgrc->where('id_contrato', $idContrato);
        $contract = $this->db_sgrc->get('contratos_view')->row_array();

        $contract['suplementos'] = $this->getSupplement($contract['no_contrato']);

        return  $contract;
    }


    public function getSupplement($noContrato)
    {

        $this->db_sgrc->where('no_contrato', $noContrato);
        $this->db_sgrc->where('no_suplemento !=', NULL);
        $this->db_sgrc->order_by('fecha_firma desc');
        $contract = $this->db_sgrc->get('contratos_vigentes_view')->result_array();

        return  $contract;
    }
    public function getData()
    {

        $this->db_sgrc->select('no_contrato, year_firma, nombre_empresa, nombre_servicio,year_expira,contract_status,no_suplemento,contract_status');
        $contract = $this->db_sgrc->get('get_all_contratos')->result_array();

        return  $contract;
    }

    public function contractByYear()
    {

        $contract = $this->db_sgrc->get('grafica_cant_por_year')->result_array();

        return   $contract;
    }

    //   END NOVUM CODE 


}

/* End of file contratos_model.php */
/* Location: ./application/models/contratos_model.php */