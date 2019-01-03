<?php


class dbMySql implements iDatabase {

    private $instance = null ;
    private $result;

    public function getInstanceParam($host, $port, $user, $password , $name) {
        if($this->instance == null) {
            $this->instance = new PDO('mysql:host='.$host.':'.$port.';dbname='.$name.'', $user,$password , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }

        return $this->instance ;
    }

    public function getInstance() {
        return $this->getInstanceParam
                                    (
                                        param::searchParam(INI_PATH,MYSQL_DB_HOST),
                                        param::searchParam(INI_PATH,MYSQL_DB_PORT),
                                        param::searchParam(INI_PATH,MYSQL_DB_USER),
                                        param::searchParam(INI_PATH,MYSQL_DB_PASSWORD),
                                        param::searchParam(INI_PATH,MYSQL_DB_NAME),
                                        ''
                                    ) ;
    }

    /**
     * @param requestBuilder $param
     */
    public function save(requestBuilder $param)
    {
        $this->result = NULL;
        $i = 0;
        $c = count($param->getParams());

        $sqlKey = "INSERT INTO `".$param->getTable()."`(";
        $sqlValue = "VALUES (";
        foreach ($param->getParams() as $key => $value)
        {
            if($i+1 >= $c)
            {
                $sqlKey .= "`".$key."`)";
                $sqlValue .= ":".$key.")";
            }
            else
            {
                $sqlKey .= "`".$key."` ,";
                $sqlValue .= ":".$key.",";
            }
            $i++;
        }
        $sql = $sqlKey.$sqlValue;
        $req = $this->instance->prepare($sql);
        foreach ($param->getParams() as $key => $value)
        {
            $req->bindValue($key, $value);
        }

        $req->execute();
        $this->result = $req->errorInfo();
        $req->closeCursor();

    }
    public function update(requestBuilder $param)
    {
        $this->result = NULL;
        $i = 0;
        $c = count($param->getParams());
        $sql = "UPDATE ".$param->getTable()." SET ";
        $sqlWhere = " WHERE ";
        foreach ($param->getParams() as $key => $value)
        {
            if($key == 'id')
            {
                $sqlWhere .= "`".$key."` = ".$value ;
            }
            else
            {
                if($i == $c-1 or $i > $c-1)
                {
                    $sql .= "`".$key."` = '".$value."'";
                }
                else
                {
                    $sql .= "`".$key."` = '".$value."', ";
                }

            }
            $i++;
        }
        $sql = $sql.$sqlWhere;
        $req = $this->instance->prepare($sql);
        foreach ($param->getParams() as $key => $value)
        {
            $req->bindValue($key, $value);
        }
        $req->execute();
        $this->result = $req->errorInfo();
        $req->closeCursor();
    }
    public function load(requestBuilder $param)
    {
        $this->result = NULL;

        $sql = "SELECT * FROM `".$param->getTable()."` WHERE 1";

        $req = $this->instance->prepare($sql);
        $req->execute();

        if($req->errorInfo()[0] === '00000')
        {
            $this->result = $req->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            $this->result = $req->errorInfo();
        }
        $req->closeCursor();
    }
    public function loadOnce(requestBuilder $param)
    {
        $this->result = NULL;

        $sql = "SELECT * FROM `".$param->getTable()."` WHERE ";
        foreach ($param->getParams() as $key => $value)
        {
            $sql .= "`".$key."` = \"".$value."\"";
        }
        $req = $this->instance->prepare($sql);
        foreach ($param->getParams() as $key => $value)
        {
            $req->bindValue($key, $value);
        }
        $req->execute();

        if($req->errorInfo()[0] === '00000') {

            $result =  $req->fetchAll(PDO::FETCH_ASSOC);
            if ( $result != NULL)
            {
                $this->result = $result[0];
            }
        }
        else
        {
            $this->result = $req->errorInfo();
        }
        $req->closeCursor();
    }
    public function delete(requestBuilder $param)
    {
        $sql = "DELETE FROM `".$param->getTable()."` WHERE ";
        foreach ($param->getParams() as $key => $value)
        {
            $sql .= "`".$key."` = \"".$value."\"";
        }
        $req = $this->instance->prepare($sql);
        foreach ($param->getParams() as $key => $value)
        {
            $req->bindValue($key, $value);
        }
        $req->execute();
        $this->result = $req->errorInfo();
        $req->closeCursor();
    }
    public function deleteTable(requestBuilder $param)
    {
        $sql = "DELETE FROM `".$param->getTable()."`";
        $req = $this->instance->prepare($sql);
        $req->execute();
        $req->closeCursor();
    }
    public function deleteALL()
    {
        die;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

}
