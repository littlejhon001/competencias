<?php
class Cargos_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }
    public $table = "cargos";
    public $table_id = "id";

    public function index()
    {

    }

    public function buscarExacto($nombre){
        return $this->find(['nombre' => $nombre],'id')->id;
    }

}