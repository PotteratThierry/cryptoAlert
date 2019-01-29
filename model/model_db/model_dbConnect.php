<?php
class dbConnect
{
    private $dbHost;
    private $dbUser;
    private $dbPassWord;
    private $dbName;
    private $dbPort;
    //--------------------//
    // connection redis   //
    //--------------------//
    public function __construct()
    {
        $this->dbHost =         param::searchParam(INI_PATH,DB_HOST);
        $this->dbUser =         param::searchParam(INI_PATH,DB_USER);
        $this->dbPassWord =     param::searchParam(INI_PATH,DB_PASSWORD);
        $this->dbName =         param::searchParam(INI_PATH,DB_NAME);
        $this->dbPort =         param::searchParam(INI_PATH,DB_PORT);
    }
    public function connect()
    {

        try
        {
            $redis = new Redis();
            //return $redis->connect($this->dbHost, $this->dbPort);
        }
        catch(Exception $ex)
        {
            die("Fail to open database") ;
//            return $ex->getMessage();
        }
    }

    /**
     * @return int
     */
    public function getDbPort()
    {
        return $this->dbPort;
    }

    /**
     * @param int $dbPort
     */
    public function setDbPort($dbPort)
    {
        $this->dbPort = $dbPort;
    }
    /**
     * @return int
     */
    public function getDbHost()
    {
        return $this->dbHost;
    }

    /**
     * @param int $dbHost
     */
    public function setDbHost($dbHost)
    {
        $this->dbHost = $dbHost;
    }

    /**
     * @return int
     */
    public function getDbUser()
    {
        return $this->dbUser;
    }

    /**
     * @param int $dbUser
     */
    public function setDbUser($dbUser)
    {
        $this->dbUser = $dbUser;
    }

    /**
     * @return int
     */
    public function getDbPassWord()
    {
        return $this->dbPassWord;
    }

    /**
     * @param int $dbPassWord
     */
    public function setDbPassWord($dbPassWord)
    {
        $this->dbPassWord = $dbPassWord;
    }

    /**
     * @return int
     */
    public function getDbName()
    {
        return $this->dbName;
    }

    /**
     * @param int $dbName
     */
    public function setDbName($dbName)
    {
        $this->dbName = $dbName;
    }




}
?>