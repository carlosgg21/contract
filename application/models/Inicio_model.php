<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// require_once APPPATH . 'traits\ContractTrait.php';

class Inicio_model extends CI_Model
{
    use ContractTrait;

    const CONTRACTS_LIMIT = 7;


    /**
     * Proceso el resultado para darle formato al 
     * resumen
     *
     * @param [type] $queryResult
     * @param [type] $resultKey
     * @return void
     */
    public function processQueryResult($queryResult, $resultKey)
    {
        if (empty($queryResult)) {
            return array(
                'getFiveMost' => 0,
                $resultKey => 0,
            );
        } else {
            return array(
                'getFiveMost' => array_slice($queryResult, 0, 5, true),
                $resultKey => count($queryResult),
            );
        }
    }

    /**
     * Resumen con toda la info que se muestra en la 
     * página de inicio
     */
    public function resumen()
    {

        return [
            "provedores"    => $this->processQueryResult($this->getAllByEnterprise(), 'cantEnterpriseWithContract'),
            "servicios"     => $this->processQueryResult($this->getAllByService(), 'cantServiceWithContract'),
            "procesos"      => $this->processQueryResult($this->getAllByProces(), 'cantProcesWithContract'),
            "cantContratos" => count($this->inicio->getCurrentContracts()),
            'tipoPersona'   => $this->inicio->resumen_contratos_tipo_persona(),
            'actualInfo'    => $this->inicio->resumen_contratos_actual_year(),

        ];
    }


    /**
     * Listado de contratos vigentes  por empresa (por provedor)
     * y resumen de informacion contratos - empresa
     */
    public function getAllByEnterprise()
    {

        return  $this->current()
            ->select('Count(idEmpresa) AS cant_contratos')
            ->group_by('idEmpresa')
            ->order_by('cant_contratos desc')->get()
            ->result_array();
    }

   
    // End provedores info

    /**
     * Listado de contratos vigentes  por servicio
     * y resumen de informacion contratos - servicios
     */
    public function getAllByService()
    {
        return $this->current()
            ->select('Count(idTipoServicio) AS cant_contratos')
            ->group_by('idTipoServicio')
            ->order_by('cant_contratos desc')->get()
            ->result_array();
    }
    // End servicios info

    /**
     * contratos vigentes sin los suplementos
     */
    public function getCurrentContracts()
    {
        return $this->current()->get()->result_array();
    }


    /**
     * Listado de contratos vigentes  por procesos
     * y resumen de informacion contratos - procesos
     */
    public function getAllByProces()
    {
        return $this->current()
            ->select('Count(id_procesos) AS cant_contratos')
            ->group_by('id_procesos')
            ->order_by('cant_contratos desc')->get()
            ->result_array();
    }

    // End proces info


    /**
     * Información contratos por año
     * tanto vigentes como expirados 
     */

    public function currentYearContract()
    {
        $currentYear = date('Y');

        return  $this->current()
            ->where('year_firma', $currentYear)
            ->get()
            ->result_array();
    }

    public function expireCurrentYearContract()
    {
        $currentYear = date('Y');

        return $this->current()
            ->where('year_expira', $currentYear)
            ->get()
            ->result_array();
    }

    public function resumen_contratos_actual_year()
    {
        return  [
            'firmados' => count($this->currentYearContract()),
            'expiran'  => count($this->expireCurrentYearContract()),
        ];
    }


    public function getCantContractByExpireYear()
    {
        $current_year = (new DateTime())->format('Y');

        return  $this->db_sgrc
            ->select('YEAR (fecha_expira) AS fecha_expira,COUNT(YEAR(fecha_expira)) AS cantidad')
            ->where('contratro_provedor.fecha_expira !=', '0000-00-00')
            ->where('YEAR(fecha_expira) <=', $current_year)
            ->group_by('YEAR (fecha_expira)')
            ->order_by('YEAR (fecha_expira) DESC')
            ->limit(self::CONTRACTS_LIMIT)
            ->get('contratro_provedor')
            ->result_array();
    }

    public function getCantContractBySignatureYear()
    {
        return  $this->db_sgrc
            ->select('YEAR (fecha_firma) AS fecha_firma,COUNT(YEAR(fecha_firma)) AS cantidad')
            ->where_in('contratro_provedor.estado_contrato', [1, 2])
            ->group_by('YEAR (fecha_firma)')
            ->order_by('YEAR (fecha_firma) DESC')
            ->limit(self::CONTRACTS_LIMIT)
            ->get('contratro_provedor')
            ->result_array();
    }
    //End información relacionada con fecha 


    /**
     * cantidad de contratos firmados y que exxpeiran en los ultimos 7 años
     *incluye el año actual en la primera posicion del arreglo 
     *
     * @return void
     */
    public function graficData()
    {
        $expiran  = $this->getCantContractByExpireYear();
        $firmados  = $this->getCantContractBySignatureYear();

        array_shift($expiran[0]);
        array_shift($firmados[0]);

        $cont = count(($firmados));
        $data = [];
        for ($i = 1; $i < $cont; $i++) {
            $data[] = array(
                'y' => $firmados[$i]['fecha_firma'],
                'a' =>  $firmados[$i]['cantidad'],
                'b' =>   $expiran[$i]['cantidad']
            );
        }


        return  array_reverse($data); // unset($expiran[0]); 
    }



    /**
     * Devuelve los contratos por tipo de persona 
     * 1 TCP
     * 2 Empresa Estatal
     * 3 Empresa no Estatal
     * @param [type] $tipo
     * @return void
     */

    public function resumen_contratos_tipo_persona()
    {
        $totalContratos = count($this->getCurrentContracts());

        return [
            'typeTcp'       => count($this->contratos_tipo_persona(1)),
            'tcpPercentage' => round($this->utilidades->percentage(count($this->contratos_tipo_persona(1)), $totalContratos), 2),
            'typeEe'        => count($this->contratos_tipo_persona(2)),
            'eePercentage'  => round($this->utilidades->percentage(count($this->contratos_tipo_persona(2)), $totalContratos), 2),
            'typeEnE'       => count($this->contratos_tipo_persona(3)),
            'enePercentage' => round($this->utilidades->percentage(count($this->contratos_tipo_persona(3)), $totalContratos), 2),
        ];
    }

    public function contratos_tipo_persona($tipo)
    {
        return $this->db_sgrc
            ->where('tipo_persona', $tipo)
            ->get($this->entity)->result_array();
    }
}
