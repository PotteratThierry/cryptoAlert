<?php
class account
{
    //constant pour les type d'accé
    const ALL				= 0x01;
    const MEMBER 			= 0x02;
    const MODERATOR			= 0x04;
    const ADMIN 			= 0x08;
    //constant pour les actions
    const ADD 				= 0x010;
    const DELETE 			= 0x020;
    const EDIT 				= 0x040;
    //constant d'administration des group
    const EDIT_GROUP	    = 0x80;
    const ADD_GROUP 		= 0x100;
    const DELETE_GROUP      = 0x200;
    //constant d'administration des utilisateur
    const ADD_USER	        = 0x400;
    const EDIT_USER 	    = 0x800;
    const DELETE_USER       = 0x1000;

    const MAIL = "useMail";
    const NICKNAME = "useNickname";
    const PASSWORD = "usePassword";
    const PERMISSION = "groPermission";

    //nom de champs de droit
    private $all = 'all';
    private $member = 'member';
    private $moderator = 'moderator';
    private $admin = 'admin';

    private $add = 'add';
    private $delete = 'delete';
    private $edit = 'edit';

    private $edit_group = 'edit_group';
    private $delete_group = 'delete_group';
    private $add_group = 'add_group';

    private $add_user = 'add_user';
    private $edit_user = 'edit_user';
    private $delete_user = 'delete_user';

    //propriété de class contant le lien dui ficher de paramètre
    private $iniPath;

    private $result;
    private $access;
    private $permission;
    private $newPermission;
    private $typePerm;
    private $connect;
    private $dbUser;
    private $dbGroup;
    private $mail;
    private $password;
    private $tabUser;
    private $tabGroup;



    public function __construct()
    {

    }
    public function permission()
    {
        $this->access = 0;
        if(isset($this->permission))
        {
            //verifie si le type de permmision
            switch ($this->typePerm)
            {
                //verrifie quel type de permission il faut verifier
                case $this->all:
                {
                    //verifie si l'utilisateur à le type de permmision
                    if ($this->permission & self::ALL)
                    {
                        // donne le droit d'accé
                        $this->access = 1;
                    }
                    break;
                }
                case $this->admin:
                {
                    if ($this->permission & self::ADMIN)
                    {
                        $this->access = 1;
                    }
                    break;
                }
                case $this->member:
                {
                    if ($this->permission & self::MEMBER)
                    {
                        $this->access = 1;
                    }
                    break;
                }
                case $this->moderator:
                {
                    if ($this->permission & self::MODERATOR)
                    {
                        $this->access = 1;
                    }
                    break;
                }
                case $this->add:
                {
                    if ($this->permission & self::ADD)
                    {
                        $this->access = 1;
                    }
                    break;
                }
                case $this->delete:
                {
                    if ($this->permission & self::DELETE)
                    {
                        $this->access = 1;
                    }
                    break;
                }
                case $this->edit:
                {
                    if ($this->permission & self::EDIT)
                    {
                        $this->access = 1;
                    }
                    break;
                }
                case $this->edit_group:
                {
                    if ($this->permission & self::EDIT_GROUP)
                    {
                        $this->access = 1;
                    }
                    break;
                }
                case $this->add_group:
                {
                    if ($this->permission & self::ADD_GROUP)
                    {
                        $this->access = 1;
                    }
                    break;
                }
                case $this->delete_group:
                {
                    if ($this->permission & self::DELETE_GROUP)
                    {
                        $this->access = 1;
                    }
                    break;
                }
                case $this->add_user:
                {
                    if ($this->permission & self::ADD_USER)
                    {
                        $this->access = 1;
                    }
                    break;
                }
                case $this->edit_user:
                {
                    if ($this->permission & self::EDIT_USER)
                    {
                        $this->access = 1;
                    }
                    break;
                }
                case $this->delete_user:
                {
                    if ($this->permission & self::DELETE_USER)
                    {
                        $this->access = 1;
                    }
                    break;
                }
                default:
                    {
                    break;
                    }
            }
        }
    }
    public function modifyPermission()
    {
            //verifie si le type de permmision
            switch ($this->newPermission)
            {
                //verrifie quel type de permission il faut verifier
                case $this->all:
                {
                    $this->permission |= self::ALL;
                    break;
                }
                case $this->admin:
                {
                    $this->permission |= self::ADMIN;
                    break;
                }
                case $this->member:
                {
                    $this->permission |= self::MEMBER;
                    break;
                }
                case $this->moderator:
                {
                    $this->permission |= self::MODERATOR;
                    break;
                }
                case $this->add:
                {
                    $this->permission |= self::ADD;
                    break;
                }
                case $this->delete:
                {
                    $this->permission |= self::DELETE;
                    break;
                }
                case $this->edit:
                {
                    $this->permission |= self::EDIT;
                    break;
                }
                case $this->edit_group:
                {
                    $this->permission |= self::EDIT_GROUP;
                    break;
                }
                case $this->add_group:
                {
                    $this->permission |= self::ADD_GROUP;
                    break;
                }
                case $this->delete_group:
                {
                    $this->permission |= self::DELETE_GROUP;
                    break;
                }
                case $this->add_user:
                {
                    $this->permission |= self::ADD_USER;
                    break;
                }
                case $this->edit_user:
                {
                    $this->permission |= self::EDIT_USER;
                    break;
                }
                case $this->delete_user:
                {
                    $this->permission |= self::DELETE_USER;
                    break;
                }
                default:
                    {
                    break;
                    }
            }
    }
    public function sessionIntegrity()
    {
        $this->connect = 0;
        if(isset($_SESSION[self::MAIL]))
        {
            if(session_regenerate_id (true))
            {
                $this->connect = 1;
            }
            else
            {
                $this->connect = 4;
                log::ConnectLog($this->connect);
            }
        }
    }
    public function connect()
    {

        $this->dbUser->setUseMail($this->mail);
        $this->dbUser->getMail();
        $this->tabUser = $this->dbUser->getResult();
        //vérifie l'existante de résultats
        if(isset($this->tabUser[0]))
        {
            //verifie que le compte est pas déactivé
            if($this->tabUser[0]->getUseStatus())
            {
                //recuperation des information du groupe du compte
                $this->dbGroup->setIdGroup($this->tabUser[0]->getIdxGroup());
                $this->dbGroup->getOnce();

                //recuperation des information du groupe lier au groupe prècedament cherché
                $this->tabGroup = $this->dbGroup->getResult();
                $this->connect = 0;


                //vérifie si le mot de passe est juste(le nom d'utilisateur est deja vérifié avec la verification de résultat, si il est faut il n'y a pas de résultat)
                if(security::hash($this->password) == $this->tabUser[0]->getUsePassword())
                {
                    $mail = $this->tabUser[0]->getUseMail();
                    $nickname = $this->tabUser[0]->getUseNickname();
                    $permission = addslashes($this->tabGroup[0]->getGroPermission());

                    //stockage des information dans la session
                    $_SESSION[self::MAIL] = $mail;
                    $_SESSION[self::NICKNAME] = $nickname;
                    $_SESSION[self::PERMISSION] = $permission;

                    $this->connect = 1;
                }
                 log::ConnectLog($this->connect, $this->tabUser[0]->getUseMail());
            }
            else
            {
                //retour different pour les message d'erreur
                $this->connect = 3;
                log::ConnectLog($this->connect, $this->tabUser[0]->getUseMail());
            }
        }
        else
        {
            //retour different pour les message d'erreur
            $this->connect = 2;
            log::ConnectLog($this->connect,$this->mail);
        }
    }
    public function disconnect()
    {
        log::DisconnectLog($_SESSION[MAIL]);
        session_destroy();
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
     * @param mixed $newPermission
     */
    public function setNewPermission($newPermission)
    {
        $this->newPermission = $newPermission;
    }

    /**
     * @return mixed
     */
    public function getNewPermission()
    {
        return $this->newPermission;
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
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param mixed $permission
     */
    public function setPermission($permission)
    {
        $this->permission = $permission;
    }

    /**
     * @return mixed
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * @param mixed $access
     */
    public function setAccess($access)
    {
        $this->access = $access;
    }

    /**
     * @return mixed
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * @param mixed $connect
     */
    public function setConnect($connect)
    {
        $this->connect = $connect;
    }

    /**
     * @return mixed
     */
    public function getConnect()
    {
        return $this->connect;
    }

    /**
     * @param mixed $dbGroup
     */
    public function setDbGroup($dbGroup)
    {
        $this->dbGroup = $dbGroup;
    }

    /**
     * @return mixed
     */
    public function getDbGroup()
    {
        return $this->dbGroup;
    }

    /**
     * @param mixed $dbUser
     */
    public function setDbUser($dbUser)
    {
        $this->dbUser = $dbUser;
    }

    /**
     * @return mixed
     */
    public function getDbUser()
    {
        return $this->dbUser;
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
    public function getLoginName()
    {
        return $this->loginName;
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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $tabGroup
     */
    public function setTabGroup($tabGroup)
    {
        $this->tabGroup = $tabGroup;
    }

    /**
     * @return mixed
     */
    public function getTabGroup()
    {
        return $this->tabGroup;
    }

    /**
     * @param mixed $tabUser
     */
    public function setTabUser($tabUser)
    {
        $this->tabUser = $tabUser;
    }

    /**
     * @return mixed
     */
    public function getTabUser()
    {
        return $this->tabUser;
    }

    /**
     * @param mixed $typePerm
     */
    public function setTypePerm($typePerm)
    {
        $this->typePerm = $typePerm;
    }

    /**
     * @return mixed
     */
    public function getTypePerm()
    {
        return $this->typePerm;
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
    public function getIniPath()
    {
        return $this->iniPath;
    }


}