<?php
class dbGroup
{
	private $result;
	//instance de connection
	private $pdo;

	//propriété de class coréspondant aux champs de la base de données
	private $idGroup;
	private $groName;
	private $groPermission;

	public function __construct()
    {
    }
	public function getAll()
	{
		$sql = "SELECT * FROM `userGroup` ORDER BY groPermission";
		$req = $this->pdo->prepare($sql);
		$req->execute();
		$this->result = $req->fetchAll(PDO::FETCH_CLASS, "dbGroup");
		$req->closeCursor();
	}
	public function getOnce()
	{
		$sql = "SELECT * FROM `userGroup` WHERE idGroup = :idGroup";
		$req = $this->pdo->prepare($sql);
		$req->bindValue(':idGroup', $this->idGroup);
		$req->execute();
		$this->result = $req->fetchAll(PDO::FETCH_CLASS, "dbGroup");
		$req->closeCursor();
	}
	public function getName()
	{
	 	$sql = "SELECT * FROM `userGroup` WHERE `groName` = :groName";
	 	$req = $this->pdo->prepare($sql);
	 	$req->bindValue(':groName', $this->groName);
		$req->execute();
		$this->result = $req->fetchAll(PDO::FETCH_CLASS, "dbGroup");
		$req->closeCursor();	
	}
	public function modify()
	{
	 	$sql = "UPDATE `userGroup` SET `groName` = :groName, `groPermission` = :groPermission WHERE `idGroup` = :idGroup";
	 	$req = $this->pdo->prepare($sql);
	 	$req->bindValue(':groName', $this->groName);
	 	$req->bindValue(':groPermission', $this->groPermission);
	 	$req->bindValue(':idGroup', $this->idGroup);
	 	$req->execute();
	 	$req->closeCursor();
        if(class_exists('log'))
        {
            log::dbLog(LOG_GROUP_MODIFY,LOG_DB_GROUP, $this->groName);
        }
	}
	public function create()
	 {
	 	$sql = "INSERT INTO `userGroup` (`groName`, `groPermission`) VALUES (:groName,:groPermission)";
	 	$req = $this->pdo->prepare($sql);
	 	$req->bindValue(':groName', $this->groName);
	 	$req->bindValue(':groPermission', $this->groPermission);
	 	$req->execute();
	 	$req->closeCursor();
         if(class_exists('log'))
         {
             log::dbLog(LOG_GROUP_CREATE,LOG_DB_GROUP, $this->groName);
         }
	 }
	public function delete()
	{
        $this->getOnce();
        $sql = "DELETE FROM `userGroup` WHERE `idGroup` = :idGroup";
	 	$req = $this->pdo->prepare($sql);
	 	$req->bindValue(':idGroup', $this->idGroup);
		$req->execute();
	 	$req->closeCursor();
        if(class_exists('log'))
        {
            log::dbLog(LOG_GROUP_DELETE,LOG_DB_GROUP, $this->result[0]->getGroName());
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

    /**
     * @return mixed
     */
    public function getGroPermission()
    {
        return $this->groPermission;
    }

    /**
     * @param mixed $groPermission
     */
    public function setGroPermission($groPermission)
    {
        $this->groPermission = $groPermission;
    }

}