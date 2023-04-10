<?php

/**
 * 
 */
trait ContractTrait
{
    protected $db_sg;
    protected $entity  = "current_contract";
    protected  $get_all = "all_current_contract";



    public function __construct()
    {
        parent::__construct();
        $this->db_sgrc = $this->load->database('sgrc', TRUE);
    }

    /**
     * contratos vigentes sin
     * suplemento
     *
     * @return void
     */
    public function current()
    {
        $this->db_sgrc->select('*');
        $this->db_sgrc->from($this->entity);
        return $this->db_sgrc;
    }

    /**
     * Contratos vigentes 
     * con suplementos
     *
     * @return void
     */
    public function current_all()
    {
        $this->db_sgrc->select('*');
        $this->db_sgrc->from($this->get_all);
        return $this->db_sgrc;
    }
}
