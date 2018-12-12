<?php
class contact
{
    //propriété de class pour les valeur des camps de la base de donnée
    private $connect = 0;
    private $idUser;
    private $loginName;
    private $password;
    private $mail;
    private $status = 0;
    private $activationKey = '';
    private $creatDate = '1900-1-1 00:00:00';
    private $resetKey = '';
    private $resetDate = '1900-1-1 00:00:00';
    private $keyWallet = '';
    private $moneyWallet;
    private $nameWallet;

    private $result;


    public function save(iDatabase $connector)
    {
        $request = new requestBuilder()  ;
        $request->setTable( TABLE_USER) ;
        $request->setParam( COLUMN_ID  ,  "") ;
        $request->setParam( COLUMN_USE_MAIL  ,  $this->mail) ;
        $request->setParam( COLUMN_USE_LOGIN_NAME , $this->loginName) ;
        $request->setParam( COLUMN_USE_PASSWORD , $this->password) ;
        $request->setParam( COLUMN_USE_STATUS , $this->status) ;
        $request->setParam( COLUMN_USE_ACTIVATION_KEY , $this->activationKey) ;
        $request->setParam( COLUMN_USE_CREAT_DATE , $this->creatDate) ;
        $request->setParam( COLUMN_USE_RESET_KEY , $this->resetKey) ;
        $request->setParam( COLUMN_USE_RESET_DATE , $this->resetDate) ;
        $request->setParam( COLUMN_USE_WALLET , $this->keyWallet) ;


        $this->result = dbManager::save($connector, $request) ;
    }
    public function  load(iDatabase $connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);

        $this->result = dbManager::load($connector, $request) ;
    }
    public function connect($connector)
    {
        $result = 0;
        self::loadOnceByName($connector);

        //si le pseudo existe
        if($this->result != array())
        {

            //si les mots de passe son identique
            if($this->password === $this->result[COLUMN_USE_PASSWORD])
            {
                //si le compte est actif
                if($this->result[COLUMN_USE_STATUS])
                {
                    $result = 1;
                }
                else
                {
                    $result = 2;
                }
            }
        }
        $this->result = $result;
        $this->connect = $result;
    }
    public function addWallet($connector)
    {
        $request = new wallet;
        $request->setIdUser($this->idUser);
        $request->setKeyWallet($this->keyWallet);
        $request->setMoneyWallet($this->moneyWallet);
        $request->setNameWallet($this->nameWallet);
        //verifies si il existe déjà une liste de wallet
        self::loadOnceById( $connector);


        //si oui lance add et transmet l'ancinenne liste sinon create
        if(self::getResult()[COLUMN_USE_WALLET] != "")
        {
            $request->setOldWallet(self::getResult()[COLUMN_USE_WALLET]);
            $request->add($connector);

        }
        else
        {
            $request->create($connector);
        }
    }
    public function updateStatus(iDatabase $connector)
    {
        $request = new requestBuilder()  ;
        $request->setTable( TABLE_USER.$this->idUser) ;
        $request->setParam( COLUMN_USE_STATUS , $this->status) ;

        $this->result = dbManager::update($connector, $request) ;
    }
    public function updateResetKey(iDatabase $connector)
    {
        $request = new requestBuilder()  ;
        $request->setTable( TABLE_USER.$this->idUser) ;
        $request->setParam( COLUMN_USE_RESET_DATE , $this->resetDate) ;

        $this->result = dbManager::update($connector, $request) ;
    }
    public function updatePassword(iDatabase $connector)
    {
        $request = new requestBuilder()  ;
        $request->setTable( TABLE_USER.$this->idUser) ;
        $request->setParam( COLUMN_USE_PASSWORD , $this->password) ;

        $this->result = dbManager::update($connector, $request) ;
    }
    public function mailExist($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( COLUMN_USE_MAIL  ,  $this->mail) ;

        $this->result = dbManager::loadOnce($connector, $request) ;
    }
    public function loginNameExist($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( COLUMN_USE_LOGIN_NAME  ,  $this->loginName) ;

        $this->result = dbManager::loadOnce($connector, $request) ;
    }
    public function loadOnceById($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( COLUMN_ID  ,  $this->idUser) ;

        $this->result = dbManager::loadOnce($connector, $request) ;
    }
    public function loadOnceByName($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( COLUMN_USE_LOGIN_NAME  ,  $this->loginName) ;

        $this->result = dbManager::loadOnce($connector, $request) ;
    }
    public function loadOnceByMail($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( COLUMN_USE_MAIL  ,  $this->mail) ;

        $this->result = dbManager::loadOnce($connector, $request) ;
    }
    public function loadOnceByResetKey($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( COLUMN_USE_RESET_KEY  , $this->resetKey) ;

        $this->result = dbManager::loadOnce($connector, $request) ;
    }
    public function loadOnceByActivationKey($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( COLUMN_USE_ACTIVATION_KEY  , $this->activationKey) ;

        $this->result = dbManager::loadOnce($connector, $request) ;
    }
    public function loadOnceByCreatDate($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( COLUMN_USE_CREAT_DATE  , $this->creatDate) ;

        $this->result = dbManager::loadOnce($connector, $request) ;
    }
    public function loadOnceByStatus($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( COLUMN_USE_STATUS  , $this->status) ;

        $this->result = dbManager::loadOnce($connector, $request) ;
    }
    public function deleteByName($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( COLUMN_USE_LOGIN_NAME  ,  $this->loginName) ;

        $this->result = dbManager::delete($connector, $request) ;
    }
    public function deleteByMail($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( COLUMN_USE_MAIL  ,  $this->mail) ;

        $this->result = dbManager::delete($connector, $request) ;
    }
    public function deleteById($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( TABLE_USER_ID  ,  $this->idUser) ;

        $this->result = dbManager::delete($connector, $request) ;
    }
    public function deleteAll($connector)
    {
        dbManager::deleteAll($connector) ;
    }

    /**
     * @return int
     */
    public function getConnect()
    {
        return $this->connect;
    }

    /**
     * @param int $connect
     */
    public function setConnect($connect)
    {
        $this->connect = $connect;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getLoginName()
    {
        return $this->loginName;
    }

    /**
     * @param mixed $loginName
     */
    public function setLoginName($loginName)
    {
        $this->loginName = $loginName;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getActivationKey()
    {
        return $this->activationKey;
    }

    /**
     * @param string $activationKey
     */
    public function setActivationKey($activationKey)
    {
        $this->activationKey = $activationKey;
    }

    /**
     * @return string
     */
    public function getCreatDate()
    {
        return $this->creatDate;
    }

    /**
     * @param string $creatDate
     */
    public function setCreatDate($creatDate)
    {
        $this->creatDate = $creatDate;
    }

    /**
     * @return string
     */
    public function getResetKey()
    {
        return $this->resetKey;
    }

    /**
     * @param string $resetKey
     */
    public function setResetKey($resetKey)
    {
        $this->resetKey = $resetKey;
    }

    /**
     * @return string
     */
    public function getResetDate()
    {
        return $this->resetDate;
    }

    /**
     * @param string $resetDate
     */
    public function setResetDate($resetDate)
    {
        $this->resetDate = $resetDate;
    }

    /**
     * @return string
     */
    public function getKeyWallet()
    {
        return $this->keyWallet;
    }

    /**
     * @param string $keyWallet
     */
    public function setKeyWallet($keyWallet)
    {
        $this->keyWallet = $keyWallet;
    }

    /**
     * @return mixed
     */
    public function getMoneyWallet()
    {
        return $this->moneyWallet;
    }

    /**
     * @param mixed $moneyWallet
     */
    public function setMoneyWallet($moneyWallet)
    {
        $this->moneyWallet = $moneyWallet;
    }

    /**
     * @return mixed
     */
    public function getNameWallet()
    {
        return $this->nameWallet;
    }

    /**
     * @param mixed $nameWallet
     */
    public function setNameWallet($nameWallet)
    {
        $this->nameWallet = $nameWallet;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }



}