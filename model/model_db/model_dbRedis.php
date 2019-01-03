<?php


class dbRedis implements iDatabase {

    private $instance = null ;
    private $result;

    public function getInstanceParam($host, $port ,$user,  $password, $name) {
        if($this->instance == null) {
            $this->instance = new Redis();
            $this->instance->connect($host,$port ) ;
        }
        return $this->instance ;
    }

    public function getInstance() {
        return $this->getInstanceParam(param::searchParam(INI_PATH,REDIS_DB_HOST),  param::searchParam(INI_PATH,REDIS_DB_PORT),'','','') ;
    }

    public function idIncr($param)
    {
        if($this->getId($param) != "")
        {
            $this->getInstance()->incr($param);
        }
        else
        {
            $this->getInstance()->set($param, 0);
        }
    }
    public function getId($param)
    {
        return $this->getInstance()->get($param);
    }
    public function save(requestBuilder $param)
    {
        $this->result = NULL;
        try
        {
            $this->idIncr($param->getTable()."counter");
            $id = $this->getId($param->getTable()."counter");
            $idTable  = $param->getTable();
            foreach ($param->getParams() as $key => $value)
            {
                if($key == 'id')
                {
                    $this->getInstance()->hset($idTable, $key, $id);
                    $this->result = 1;
                }
                else
                {
                    $this->getInstance()->hset($idTable, $key, $value);
                    $this->result = 1;
                }
            }
        }
        catch(Exception $e )
        {
            $this->result =  $e->getMessage() ;
        }
    }
    public function update(requestBuilder $param)
    {
        self::loadOnce($param);
        foreach ($param->getParams() as $key=>$value)
        {
            try
            {
                $this->getInstance()->hset($param->getTable(), $key, $value);
                $this->result = 1;
            }
            catch(Exception $e )
            {
                $this->result =  $e->getMessage() ;
            }
        }
    }
    public function load(requestBuilder $param, $numKey = 0)
    {

        $maxId = $this->getId($param->getTable()."counter");

        $i = 0;
        $this->result = NULL;
        while($i <= $maxId)
        {
            //ne verifies pas les id vide
            if($this->instance->hGetAll($param->getTable()) != array())
            {
                //si on veut les clef non numeric
                if(!$numKey)
                {
                    try
                    {
                        $this->result[$i] = $this->instance->hGetAll($param->getTable());


                    }
                    catch(Exception $e ) {
                        echo $e->getMessage() ;
                    }
                }
                else
                {
                    $ip = 0;
                    foreach ($this->instance->hGetAll($param->getTable()) as $key=>$value)
                    {
                        $this->result[$i][$ip] = $value;
                        $ip++;
                    }

                }
            }
            $i++;
        }
    }
    public function loadOnce(requestBuilder $param)
    {
        $this->result = NULL;
        $exist = array();
        //recuperation de tout les utilisateurs
        $this::load($param);
        $lstKey = $this->getResult();
        if($lstKey != NULL)
        {
            foreach ($lstKey as $key=>$value)
            {
                if($value != NULL)
                {

                    foreach ($value as $keyLvl2=>$valueLvl2)
                    {
                        foreach ($param->getParams() as $keyEntry=>$valueEntry)
                        {
                            if($keyLvl2 === $keyEntry)
                            {
                                if($valueLvl2 == $valueEntry)
                                {

                                    $exist = $value;
                                    break;
                                }
                            }

                        }
                    }
                }

            }
        }
        $this->result = $exist;
    }
    public function delete(requestBuilder $param)
    {
        $this->instance->delete($param->getTable().$param->getParams()['id']);

    }
    public function deleteTable(requestBuilder $param)
    {
        $this->instance->delete( $this->instance->keys( $param->getTable().'*'));

    }
    public function deleteALL()
    {
        //vide la base
        $this->instance->FLUSHALL();
    }
    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }
}
