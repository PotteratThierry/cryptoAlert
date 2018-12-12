<?php

class requestBuilder {

    private $a ;

    public function __construct() {
        $this->a = array("table" => "", "rows" => array() ) ;
    }

    public function setTable($table) {
        $this->a["table"] = $table ;
    }

    public function setParam($param, $value) {
        $this->a["rows"][$param] = $value;
    }

    public function  getTable() {
        return $this->a["table"] ;
    }

    public function  getParam($param) {
        return $this->a["rows"][$param] ;
    }

    public function getParams() {
        return $this->a["rows"] ;
    }

}
