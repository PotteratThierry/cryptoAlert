<?php


class dbMySql implements iDatabase {

    private $instance = null ;
    private $result;

    public function getInstanceParam($host, $port) {
        if($this->instance == null) {
            $this->instance = new Redis();
            $this->instance->connect($host,$port ) ;
        }
        return $this->instance ;
    }

    public function getInstance() {
        return $this->getInstanceParam(param::searchParam(INI_PATH,DB_HOST),  param::searchParam(INI_PATH,DB_PORT)) ;
    }

    public function save(requestBuilder $parm) {

        //Insert update

        //foreach($parm->getParams() as $key => $value ) {
        //    $this->instance->hset($parm->getTable(), $key, $value);
        //}

    }
    public function update(requestBuilder $parm)
    {


    }
    public function load(requestBuilder $parm)
    {


    }
    public function loadOnce(requestBuilder $param)
    {

    }
    public function delete(requestBuilder $param)
    {

    }
    public function deleteTable(requestBuilder $param)
    {

    }
    public function deleteALL()
    {

    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

}
