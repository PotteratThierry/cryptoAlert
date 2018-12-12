<?php
class dbUser implements iUser
{

    private $result;
	//instance de connection
	private $pdo;
	private $redis;
    private $connector ;

	//propriété de class pour les valeur des camps de la base de donnée
	private $idUser;
	private $useNickname;
	private $usePassword;
	private $useMail;

    const TABLE_USER = "table_user";
    const COLUMN_USE_NAME = "useName";
    const COLUMN_USE_MAIL = "useMail";
    const COLUMN_USE_PASSWORD = "usePassword";

	public function __construct()
	{
        //$redis = new dbRedis();
        //$this->redis =  $redis->getInstance();

        /*$this->connector = dbManager::getConnector(2) ;
        var_dump($this->connector) ;
        //$redis = dbManager::getInstance(  eDatabase::Redis ) ;


       /*
        $this->redis  = dbManager::getInstance(  2 ) ;

        if(  $this->redis  == null )
            die("No instance") ;
*/

	}
	public function getAll()
    {

    }

    public function create()
    {

        $request = new requestBuilder()  ;
        $request->setTable( self::TABLE_USER ) ;
        $request->setParam( self::COLUMN_USE_NAME, $this->useNickname  ) ;
        $request->setParam( self::COLUMN_USE_MAIL, $this->useMail  ) ;
        $request->setParam( self::COLUMN_USE_PASSWORD, $this->usePassword  ) ;

/*
        $param = array(
            "table" => self::TABLE_USER,
            "rows" => array(
                    self::COLUMN_USE_NAME => $this->useNickname,
                    self::COLUMN_USE_MAIL => $this->useMail,
                    self::COLUMN_USE_PASSWORD => $this->usePassword)
        ) ;
*/


        dbManager::save($this->connector, $request) ;


        /*
        try
        {
            echo "<b>class dbUser</b><br>";
            echo "<u>nom de la table : </u>".self::TABLE_USER."<br>";
            echo "<u>nom de la colonne : </u>".self::COLUMN_USE_NAME."<br>";
            echo "<u>nom</u> : " .$this->useNickname."<br>";

            $this->redis->hset(self::TABLE_USER, self::COLUMN_USE_NAME, $this->useNickname);
            $this->redis->hset(self::TABLE_USER, self::COLUMN_USE_MAIL, $this->useMail);
            $this->redis->hset(self::TABLE_USER, self::COLUMN_USE_PASSWORD, $this->usePassword);
            $this->result =  true;
        }
        catch (Exception $ex)
        {
            $this->result = $ex->getMessage();
        }
        */

}
	/*
	public function getAll()
	{
        $sql = "SELECT * from `user` where `idUser` <> '0'";
		$req = $this->pdo->prepare($sql);
		$req->execute();
		$this->result = $req->fetchAll(PDO::FETCH_CLASS, "dbUser");
		$req->closeCursor();
	}
    public function getAllUserPermission()
    {
        $sql = "SELECT * FROM `user`, `userGroup` where idxGroup = idGroup  and `idUser` <> '0' ORDER BY groPermission";
        $req = $this->pdo->prepare($sql);
        $req->execute();
        $this->result = $req->fetchAll(PDO::FETCH_CLASS, "dbUser");
        $req->closeCursor();
    }
	public function getOnce()
	{
		$sql = "SELECT * FROM `user` WHERE idUser = :idUser and `idUser` <> '0'";
		$req = $this->pdo->prepare($sql);
		$req->bindValue(':idUser', $this->idUser);
		$req->execute();
		$this->result = $req->fetchAll(PDO::FETCH_CLASS, "dbUser");
		$req->closeCursor();		
	}
    public function getNickname()
    {
        $sql = "SELECT * FROM `user` WHERE `useNickname` = :useNickname and `idUser` <> '0'";
        $req = $this->pdo->prepare($sql);
        $req->bindValue(':useNickname', $this->useNickname);
        $req->execute();
        $this->result = $req->fetchAll(PDO::FETCH_CLASS, "dbUser");
        $req->closeCursor();
    }
    public function getAllGroup()
    {
        $sql = "SELECT * FROM `user` WHERE `idxGroup` = :idxGroup and `idUser` <> '0'";
        $req = $this->pdo->prepare($sql);
        $req->bindValue(':idxGroup', $this->idxGroup);
        $req->execute();
        $this->result = $req->fetchAll(PDO::FETCH_CLASS, "dbUser");
        $req->closeCursor();
    }
    public function getGroup()
    {
        $sql = "SELECT * FROM `user`, `userGroup` WHERE `useMail` = :useMail and idxGroup = idGroup";
        $req = $this->pdo->prepare($sql);
        $req->bindValue(':useMail', $this->useMail);
        $req->execute();
        $this->result = $req->fetchAll(PDO::FETCH_CLASS, "dbUser");
        $req->closeCursor();
    }
    public function getMail()
    {

        $sql = "SELECT * FROM `user` WHERE `useMail` = :useMail and `idUser` <> '0'";
        $req = $this->pdo->prepare($sql);
        $req->bindValue(':useMail', $this->useMail);
        $req->execute();
        $this->result = $req->fetchAll(PDO::FETCH_CLASS, "dbUser");
        $req->closeCursor();
    }
    public function verifyMail()
    {
    $sql = "SELECT * FROM `user` WHERE idUser <> :idUser AND `useMail` = :useMail and `idUser` <> '0' ";
    $req = $this->pdo->prepare($sql);
    $req->bindValue(':useMail', $this->useMail);
    $req->bindValue(':idUser', $this->idUser);
    $req->execute();
    $this->result = $req->fetchAll(PDO::FETCH_CLASS, "dbUser");
    $req->closeCursor();
    }
    public function modify()
    {
        //récupère le nom d'utilisateur
        $this->getOnce();

        $sql = "UPDATE `user` SET `useNickname` = :useNickname, `useMail` = :useMail, `useName` = :useName,`useLastName` = :useLastName,`useBirthDate` = :useBirthDate WHERE `idUser` = :idUser and `idUser` <> '0'";
        $req = $this->pdo->prepare($sql);
        $req->bindValue(':useNickname', $this->useNickname);
        $req->bindValue(':useMail', $this->useMail);
        $req->bindValue(':useName', $this->useName);
        $req->bindValue(':useLastName', $this->useLastName);
        $req->bindValue(':useBirthDate', $this->useBirthDate);
        $req->bindValue(':idUser', $this->idUser);
        $req->execute();
        $req->closeCursor();

        //ajout de l'event dans le fichier de log
        if(class_exists('log'))
        {
            log::dbLog(LOG_USER_MODIFY,LOG_DB_USER, $this->result[0]->getUseMail());
        }

    }
    public function modifyGroup()
    {

        //connection à la class dbGroup
        $dbGroup = new dbGroup();
        $dbGroup->setPdo($this->pdo);

        //récupère le nom d'utilisateur
        $this->getOnce();

        //récupère le nom de l'ancien group
        $dbGroup->setIdGroup($this->result[0]->getIdxGroup());
        $dbGroup->getOnce();
        $oldGroup = $dbGroup->getResult()[0]->getGroName();

        $sql = "UPDATE `user` SET `idxGroup` = :idxGroup WHERE `idUser` = :idUser";
        $req = $this->pdo->prepare($sql);
        $req->bindValue(':idxGroup', $this->idxGroup);
        $req->bindValue(':idUser', $this->idUser);
        $req->execute();
        $req->closeCursor();
        //ajout de l'event dans le fichier de log
        if(class_exists('log'))
        {
            //récupère le nom du nouveau groupe
            $dbGroup->setIdGroup($this->idxGroup);
            $dbGroup->getOnce();
            $newGroup = $dbGroup->getResult()[0]->getGroName();

            log::dbLog(LOG_USER_MODIFY_GROUP,LOG_DB_USER, $this->result[0]->getUseMail(), $oldGroup, $newGroup);
        }
    }
    public function modifyStatus()
    {
        $this->getOnce();
        $sql = "UPDATE `user` SET `useStatus` = :useStatus WHERE `idUser` = :idUser";
        $req = $this->pdo->prepare($sql);
        $req->bindValue(':useStatus', $this->useStatus);
        $req->bindValue(':idUser', $this->idUser);
        $req->execute();
        $req->closeCursor();
        //ajout de l'event dans le fichier de log
        if(class_exists('log'))
        {
            log::dbLog(LOG_USER_MODIFY_STATUS,LOG_DB_USER,$this->result[0]->getUseMail());
        }
    }
	public function modifySettings()
	{

	 	$sql = "UPDATE `user` SET `useMail` = :useMail, `usePassword` = :usePassword WHERE `idUser` = :idUser";
	 	$req = $this->pdo->prepare($sql);
	 	$req->bindValue(':useMail', $this->useMail);
	 	$req->bindValue(':usePassword', $this->usePassword);
	 	$req->bindValue(':idUser', $this->idUser);
	 	$req->execute();
	 	$req->closeCursor();
        //ajout de l'event dans le fichier de log
        if(class_exists('log'))
        {
            log::dbLog(LOG_USER_MODIFY_SETTINGS,LOG_DB_USER, $this->idUser);
        }
	}
    public function modifyProfil()
    {

        $sql = "UPDATE `user` SET `useNickname` = :useNickname, `useName` = :useName,`useLastName` = :useLastName,`useBirthDate` = :useBirthDate WHERE `idUser` = :idUser";
        $req = $this->pdo->prepare($sql);
        $req->bindValue(':useNickname', $this->useNickname);
        $req->bindValue(':useName', $this->useName);
        $req->bindValue(':useLastName', $this->useLastName);
        $req->bindValue(':useBirthDate', $this->useBirthDate);
        $req->bindValue(':idUser', $this->idUser);
        $req->execute();
        $req->closeCursor();
        //ajout de l'event dans le fichier de log
        if(class_exists('log'))
        {
            log::dbLog(LOG_USER_MODIFY_PROFIL,LOG_DB_USER, $this->idUser);
        }
    }
    public function modifySignature()
    {

        $sql = "UPDATE `user` SET `useSignature` = :useSignature WHERE `idUser` = :idUser";
        $req = $this->pdo->prepare($sql);
        $req->bindValue(':useSignature', $this->useSignature);
        $req->bindValue(':idUser', $this->idUser);
        $req->execute();
        $req->closeCursor();
        //ajout de l'event dans le fichier de log
        if(class_exists('log'))
        {
            log::dbLog(LOG_USER_MODIFY_SIGNATURE,LOG_DB_USER, $this->idUser);
        }
    }
    public function modifyAvatar()
    {

        $sql = "UPDATE `user` SET `useAvatar` = :useAvatar WHERE `idUser` = :idUser";
        $req = $this->pdo->prepare($sql);
        $req->bindValue(':useAvatar', $this->useAvatar);
        $req->bindValue(':idUser', $this->idUser);
        $req->execute();
        $req->closeCursor();
        //ajout de l'event dans le fichier de log
        if(class_exists('log'))
        {
            log::dbLog(LOG_USER_MODIFY_AVATAR,LOG_DB_USER, $this->idUser);
        }
    }
    public function modifyALLGroup()
    {
        $sql = "UPDATE `user` SET `idxGroup` = :idxGroup WHERE `idxGroup` = :oldIdxGroup";
        $req = $this->pdo->prepare($sql);
        $req->bindValue(':idxGroup', $this->idxGroup);
        $req->bindValue(':oldIdxGroup', $this->oldIdxGroup);
        $req->execute();
        $req->closeCursor();
        //ajout de l'event dans le fichier de log
        if(class_exists('log'))
        {
            //récupère les nom des deux groupes
            $dbGroup = new dbGroup();
            $dbGroup->setPdo($this->pdo);

            $dbGroup->setIdGroup($this->oldIdxGroup);
            $dbGroup->getOnce();
            $group1 = $dbGroup->getResult()[0]->getGroName();

            $dbGroup->setIdGroup($this->idxGroup);
            $dbGroup->getOnce();
            $group2 = $dbGroup->getResult()[0]->getGroName();

            log::dbLog(LOG_USER_MODIFY_ALL_GROUP,LOG_DB_USER, $group1, $group2);
        }
    }
	public function create()
	 {
	 	$sql = "INSERT INTO `user` (`useNickname`,`useName`,`useLastName`,`useMail`, `usePassword`, `idxGroup`) VALUES (:useNickname,:useName,:useLastName,:useMail,:usePassword, :idxGroup)";
	 	$req = $this->pdo->prepare($sql);
	 	$req->bindValue(':usePassword', $this->usePassword);
	 	$req->bindValue(':useNickname', $this->useNickname);
	 	$req->bindValue(':useName', $this->useName);
	 	$req->bindValue(':useLastName', $this->useLastName);
	 	$req->bindValue(':useMail', $this->useMail);
	 	$req->bindValue(':idxGroup', $this->idxGroup);
	 	$req->execute();
	 	$req->closeCursor();
         //ajout de l'event dans le fichier de log
         if(class_exists('log'))
         {
             log::dbLog(LOG_USER_CREATE,LOG_DB_USER, $this->useMail);
         }
	 }
	public function delete()
	{
	 	//récupère les infor utilisateur pouzr les logs
        $this->getOnce();
        $sql = "DELETE FROM `user` WHERE `idUser` = :idUser";
	 	$req = $this->pdo->prepare($sql);
	 	$req->bindValue(':idUser', $this->idUser);
		$req->execute();
	 	$req->closeCursor();
        //ajout de l'event dans le fichier de log
        if(class_exists('log'))
        {
            log::dbLog(LOG_USER_DELETE,LOG_DB_USER, $this->result[0]->getUseMail());
        }
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

    /**
     * @return mixed
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * @param mixed $pdo
     */
    public function setPdo($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return mixed
     */
    public function getIniPath()
    {
        return $this->iniPath;
    }

    /**
     * @param mixed $iniPath
     */
    public function setIniPath($iniPath)
    {
        $this->iniPath = $iniPath;
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
    public function getUseName()
    {
        return $this->useName;
    }

    /**
     * @param mixed $useName
     */
    public function setUseName($useName)
    {
        $this->useName = $useName;
    }

    /**
     * @return mixed
     */
    public function getUsePassword()
    {
        return $this->usePassword;
    }

    /**
     * @param mixed $usePassword
     */
    public function setUsePassword($usePassword)
    {
        $this->usePassword = $usePassword;
    }

    /**
     * @return mixed
     */
    public function getUseStatus()
    {
        return $this->useStatus;
    }

    /**
     * @param mixed $useStatus
     */
    public function setUseStatus($useStatus)
    {
        $this->useStatus = $useStatus;
    }

    /**
     * @return mixed
     */
    public function getUseNickname()
    {
        return $this->useNickname;
    }

    /**
     * @param mixed $useNickname
     */
    public function setUseNickname($useNickname)
    {
        $this->useNickname = $useNickname;
    }

    /**
     * @return mixed
     */
    public function getUseLastName()
    {
        return $this->useLastName;
    }

    /**
     * @param mixed $useLastName
     */
    public function setUseLastName($useLastName)
    {
        $this->useLastName = $useLastName;
    }

    /**
     * @return mixed
     */
    public function getUseBirthDate()
    {
        return $this->useBirthDate;
    }

    /**
     * @param mixed $useBirthDate
     */
    public function setUseBirthDate($useBirthDate)
    {
        $this->useBirthDate = $useBirthDate;
    }

    /**
     * @return mixed
     */
    public function getUseSignature()
    {
        return $this->useSignature;
    }

    /**
     * @param mixed $useSignature
     */
    public function setUseSignature($useSignature)
    {
        $this->useSignature = $useSignature;
    }

    /**
     * @return mixed
     */
    public function getUseAvatar()
    {
        return $this->useAvatar;
    }

    /**
     * @param mixed $useAvatar
     */
    public function setUseAvatar($useAvatar)
    {
        $this->useAvatar = $useAvatar;
    }

    /**
     * @return mixed
     */
    public function getUseMail()
    {
        return $this->useMail;
    }

    /**
     * @param mixed $useMail
     */
    public function setUseMail($useMail)
    {
        $this->useMail = $useMail;
    }

    /**
     * @return mixed
     */
    public function getIdxGroup()
    {
        return $this->idxGroup;
    }

    /**
     * @param mixed $idxGroup
     */
    public function setIdxGroup($idxGroup)
    {
        $this->idxGroup = $idxGroup;
    }

    /**
     * @return mixed
     */
    public function getOldIdxGroup()
    {
        return $this->oldIdxGroup;
    }

    /**
     * @param mixed $oldIdxGroup
     */
    public function setOldIdxGroup($oldIdxGroup)
    {
        $this->oldIdxGroup = $oldIdxGroup;
    }

    /**
     * @return mixed
     */
    public function getIdGroup()
    {
        return $this->idGroup;
    }

    /**
     * @param mixed $idGroup
     */
    public function setIdGroup($idGroup)
    {
        $this->idGroup = $idGroup;
    }

    /**
     * @return mixed
     */
    public function getGroName()
    {
        return $this->groName;
    }

    /**
     * @param mixed $groName
     */
    public function setGroName($groName)
    {
        $this->groName = $groName;
    }

}