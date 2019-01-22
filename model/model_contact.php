<?php
class contact
{
    //propriété de class pour les valeur des camps de la base de donnée
    private $connect = 0;
    private $idUser;
    private $loginName;
    private $password;
    private $mail;
    private $name;
    private $lastName;
    private $nickName;
    private $birthDate;
    private $avatar;
    private $signature;
    private $fileName;
    private $keyWallet = '';
    private $status = 0;
    private $idxGroup = 4;
    private $activationKey = '';
    private $creatDate = '1900-1-1 00:00:00';
    private $resetKey = '';
    private $resetDate = '1900-1-1 00:00:00';

    private $moneyWallet;
    private $nameWallet;
    private $balanceWallet;

    private $result;

    public function connect($connector)
    {
        $result = 0;
        self::loadOnceByName($connector);

        //si le pseudo existe
        if($this->result != array())
        {

            //si les mots de passe son identique
            if($this->password === $this->result[COLUMN_USER_PASSWORD])
            {
                //si le compte est actif
                if($this->result[COLUMN_USER_STATUS])
                {
                    $result = 1;
                    $this->idUser = $this->result[COLUMN_USER_ID];
                    $this->loginName = $this->result[COLUMN_USER_LOGIN_NAME];
                    $this->nickName = $this->result[COLUMN_USER_NICK_NAME];
                    $this->status = $this->result[COLUMN_USER_STATUS];
                    $this->idxGroup = $this->result[COLUMN_USER_IDX_GROUP];
                    $this->mail = $this->result[COLUMN_USER_MAIL];
                    $this->moneyWallet = $this->result[COLUMN_USER_WALLET];
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
    public function save(iDatabase $connector)
    {
        $request = new requestBuilder()  ;
        $request->setTable( TABLE_USER) ;
        $request->setParam( COLUMN_USER_ID  ,  NULL) ;
        $request->setParam( COLUMN_USER_MAIL  ,  $this->mail) ;
        $request->setParam( COLUMN_USER_LOGIN_NAME , $this->loginName) ;
        $request->setParam( COLUMN_USER_PASSWORD , $this->password) ;
        $request->setParam( COLUMN_USER_STATUS , $this->status) ;
        $request->setParam( COLUMN_USER_IDX_GROUP , $this->idxGroup) ;
        $request->setParam( COLUMN_USER_ACTIVATION_KEY , $this->activationKey) ;
        $request->setParam( COLUMN_USER_CREAT_DATE , $this->creatDate) ;
        $request->setParam( COLUMN_USER_RESET_KEY , $this->resetKey) ;
        $request->setParam( COLUMN_USER_RESET_DATE , $this->resetDate) ;
        $request->setParam( COLUMN_USER_WALLET , $this->keyWallet) ;


        $this->result = dbManager::save($connector, $request) ;
    }
    public function update(iDatabase $connector)
    {
        $request = new requestBuilder()  ;
        $request->setTable( TABLE_USER) ;
        $request->setParam( COLUMN_USER_ID  ,  $this->idUser) ;
        $request->setParam( COLUMN_USER_MAIL  ,  $this->mail) ;
        $request->setParam( COLUMN_USER_LOGIN_NAME , $this->loginName);

        $this->result = dbManager::update($connector, $request) ;
    }
    public function  load(iDatabase $connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);

        $this->result = dbManager::load($connector, $request) ;
    }
    public function loadById($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( COLUMN_USER_IDX_GROUP , $this->idxGroup);

        $this->result = dbManager::loadOnce($connector, $request) ;
    }
    public function addWallet($connector)
    {
        $cWallet = new wallet;
        $cWallet->setIdUser($this->idUser);
        $cWallet->setKeyWallet($this->keyWallet);
        $cWallet->setMoneyWallet($this->moneyWallet);
        $cWallet->setNameWallet($this->nameWallet);
        $cWallet->setBalanceValue($this->balanceWallet);

        //verifies si il existe déjà une liste de wallet
        self::loadOnceById( $connector);

        //si oui lance add et transmet l'ancinenne liste sinon create
        if(self::getResult()[COLUMN_USER_WALLET] != "")
        {

            $cWallet->setJsonWallet(self::getResult()[COLUMN_USER_WALLET]);
            $cWallet->add($connector);

        }
        else
        {
            $cWallet->create($connector);
        }
    }
    public function updateUserInfo(iDatabase $connector)
    {
        $request = new requestBuilder()  ;
        $request->setTable( TABLE_USER) ;
        $request->setParam( COLUMN_USER_ID , $this->idUser) ;
        $request->setParam( COLUMN_USER_NAME , $this->name) ;
        $request->setParam( COLUMN_USER_LAST_NAME , $this->lastName) ;
        $request->setParam( COLUMN_USER_BIRTH_DATE , $this->birthDate) ;
        $request->setParam( COLUMN_USER_NICK_NAME , $this->nickName) ;

        $this->result = dbManager::update($connector, $request) ;
    }
    public function uploadAvatar(iDatabase $connector)
    {
        $request = new requestBuilder()  ;
        $request->setTable( TABLE_USER) ;
        $request->setParam( COLUMN_USER_ID , $this->idUser) ;
        $request->setParam( COLUMN_USER_AVATAR , $this->avatar) ;

        $this->result = dbManager::update($connector, $request) ;
    }
    public function uploadSignature(iDatabase $connector)
    {
        $request = new requestBuilder()  ;
        $request->setTable( TABLE_USER) ;
        $request->setParam( COLUMN_USER_ID , $this->idUser) ;
        $request->setParam( COLUMN_USER_SIGNATURE , $this->signature) ;

        $this->result = dbManager::update($connector, $request) ;
    }
    public function uploadFileName(iDatabase $connector)
    {
        $request = new requestBuilder()  ;
        $request->setTable( TABLE_USER) ;
        $request->setParam( COLUMN_USER_ID , $this->idUser) ;
        $request->setParam( COLUMN_USER_FILE_NAME , $this->fileName) ;

        $this->result = dbManager::update($connector, $request) ;
    }
    public function updateStatus(iDatabase $connector)
    {
        $request = new requestBuilder()  ;
        $request->setTable( TABLE_USER) ;
        $request->setParam( COLUMN_USER_ID , $this->idUser) ;
        $request->setParam( COLUMN_USER_STATUS , $this->status) ;

        $this->result = dbManager::update($connector, $request) ;
    }
    public function updateIdxGroup(iDatabase $connector)
    {
        $request = new requestBuilder()  ;
        $request->setTable( TABLE_USER) ;
        $request->setParam( COLUMN_USER_ID , $this->idUser) ;
        $request->setParam( COLUMN_USER_IDX_GROUP , $this->idxGroup) ;

        $this->result = dbManager::update($connector, $request) ;
    }
    public function updateResetKey(iDatabase $connector)
    {
        $request = new requestBuilder()  ;
        $request->setTable( TABLE_USER) ;
        $request->setParam( COLUMN_USER_ID , $this->idUser) ;
        $request->setParam( COLUMN_USER_RESET_DATE , $this->resetDate) ;
        $request->setParam( COLUMN_USER_RESET_KEY , $this->resetKey) ;

        $this->result = dbManager::update($connector, $request) ;
    }
    public function updatePassword(iDatabase $connector)
    {
        $request = new requestBuilder()  ;
        $request->setTable( TABLE_USER) ;
        $request->setParam( COLUMN_USER_ID , $this->idUser) ;
        $request->setParam( COLUMN_USER_PASSWORD , $this->password) ;

        $this->result = dbManager::update($connector, $request) ;
    }
    public function loadOnceById($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( COLUMN_USER_ID  ,  $this->idUser) ;

        $this->result = dbManager::loadOnce($connector, $request) ;
    }
    public function loadOnceByName($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( COLUMN_USER_LOGIN_NAME  ,  $this->loginName) ;

        $this->result = dbManager::loadOnce($connector, $request) ;
    }
    public function loadOnceByMail($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( COLUMN_USER_MAIL  ,  $this->mail) ;

        $this->result = dbManager::loadOnce($connector, $request) ;
    }
    public function loadOnceByResetKey($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( COLUMN_USER_RESET_KEY  , $this->resetKey) ;

        $this->result = dbManager::loadOnce($connector, $request) ;
    }
    public function loadOnceByActivationKey($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( COLUMN_USER_ACTIVATION_KEY  , $this->activationKey) ;

        $this->result = dbManager::loadOnce($connector, $request) ;
    }
    public function loadOnceByCreatDate($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( COLUMN_USER_CREAT_DATE  , $this->creatDate) ;

        $this->result = dbManager::loadOnce($connector, $request) ;
    }
    public function loadOnceByStatus($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( COLUMN_USER_STATUS  , $this->status) ;

        $this->result = dbManager::loadOnce($connector, $request) ;
    }
    public function deleteByName($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( COLUMN_USER_LOGIN_NAME  ,  $this->loginName) ;

        $this->result = dbManager::delete($connector, $request) ;
    }
    public function deleteByMail($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( COLUMN_USER_MAIL  ,  $this->mail) ;

        $this->result = dbManager::delete($connector, $request) ;
    }
    public function deleteById($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TABLE_USER);
        $request->setParam( COLUMN_USER_ID  ,  $this->idUser) ;

        $this->result = dbManager::delete($connector, $request) ;
    }
    public function deleteAll($connector)
    {
        dbManager::deleteAll($connector) ;
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param mixed $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return mixed
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @param mixed $signature
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;
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
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getNickName()
    {
        return $this->nickName;
    }

    /**
     * @param mixed $nickName
     */
    public function setNickName($nickName)
    {
        $this->nickName = $nickName;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
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
     * @return int
     */
    public function getIdxGroup()
    {
        return $this->idxGroup;
    }

    /**
     * @param int $idxGroup
     */
    public function setIdxGroup($idxGroup)
    {
        $this->idxGroup = $idxGroup;
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
    public function getBalanceWallet()
    {
        return $this->balanceWallet;
    }

    /**
     * @param mixed $balanceWallet
     */
    public function setBalanceWallet($balanceWallet)
    {
        $this->balanceWallet = $balanceWallet;
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