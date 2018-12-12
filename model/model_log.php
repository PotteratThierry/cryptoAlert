<?php
class log
{
    public function __construct()
    {


    }
    static  function recoveryLog($file)
    {
        if (file_exists($file) && $read_Files = file($file))
        {
            return $read_Files;
        }
        else
        {
            return 0 ;
        }
    }
    static function disconnectLog($user)
    {
        $action = "disconnect form user";
        $date = new dateTime();
        $date = $date->format('Y-m-d H:i:s');
        $log = "[".$date."] [".$_SERVER["REMOTE_ADDR"]."] [".$user."] ".$action."\r\n";
        $file = fopen(CONNECT_LOG_PATH, 'a+');
        fwrite($file, $log);
        fclose($file);
    }
    static function ConnectLog($connect, $user= 0,$page= 0)
    {
        $log = "";
        $action = "";
        $date = new dateTime();
        $date = $date->format('Y-m-d H:i:s');

        if($user == 0)
        {
            if(isset($_SESSION[MAIL]))
            {
                $user = $_SESSION[MAIL];
            }
            else
            {
                if($user == '0')
                {
                    $user = "Undefined";
                }
            }
        }

        switch($connect)
        {
            case 0:
            {
                $action = "connect fail: bad password";
                break;
            }
            case 1:
            {
                $action = "connect success";
                break;
            }
            case 2:
            {
                $action = "connect fail: Undefined user";
                break;
            }
            case 3:
            {
                $action = 'connect fail: user deactivated';
                break;
            }
            case 4:
            {
                $action = 'session integrity fail';
                break;
            }
            case 5:
            {
                $action = 'access denied to '.$page;
                break;
            }
            default:
            {
                break;
            }
        }

        $log = "[".$date."] [".$_SERVER["REMOTE_ADDR"]."] [".$user."] ".$action."\r\n";
        $file = fopen(CONNECT_LOG_PATH, 'a+');
        fwrite($file, $log);
        fclose($file);
    }
    static function dbLog($function, $table, $idElement1, $idElement2= 0, $idElement3= 0)
    {
        $Pdo = new dbConnect();
        $Pdo = $Pdo ->connect();

        $dbUser = new dbUser();
        $dbUser->setPdo($Pdo);

        $user = $_SESSION[MAIL];

        $space = "";
        $log2Row = "";
        $action = "";
        $date = new dateTime();
        $date = $date->format('Y-m-d H:i:s');
        $database = param::searchParam(INI_PATH,DB_NAME);

        if(class_exists('dbUser'))
        {
            $dbUser->setUseMail($user);
            $dbUser->getMail();
            $idUser = $dbUser->getResult()[0]->getIdUser();
        }
        else
        {
            $idUser = "undefined";
        }

        //ajoute un espace pour alligner les element dans le ficher de log
        if($table == "dbUser")
        {
            $space = " ";
        }

        switch($function)
        {
            case LOG_USER_MODIFY:
            {
                $action = "MODIFY the user     [".$idElement1."]";
                break;
            }
            case LOG_USER_MODIFY_STATUS:
            {
                //verifie si le status est activé
                if($idElement2)
                {
                    $log2Row = "[".$date."] [".$database.".".$table."] ".$space."[".$user."] activate the user   [".$idElement1."]\r\n";
                }
                else
                {
                    $log2Row = "[".$date."] [".$database.".".$table."] ".$space."[".$user."] deactivate the user [".$idElement1."]\r\n";
                }
                break;
            }
            case LOG_USER_MODIFY_SETTINGS:
            {
                $action = "MODIFY his settings";
                break;
            }
            case LOG_USER_MODIFY_PROFIL:
            {
                $action = "MODIFY his Profil";
                break;
            }
            case LOG_USER_MODIFY_SIGNATURE:
            {
                $action = "MODIFY his Profil";
                break;
            }
            case LOG_USER_MODIFY_AVATAR:
            {
                $action = "MODIFY his Avatar";
                break;
            }
            case LOG_USER_MODIFY_GROUP:
            {
                $log2Row = "[".$date."] [".$database.".".$table."] ".$space."[".$user."] move the user       [".$idElement1."] from group [".$idElement2."] to group [".$idElement3."]\r\n";
                break;
            }
            case LOG_USER_MODIFY_ALL_GROUP:
            {
                $action = "MOVE all user from  [".$idElement1."] to the group [".$idElement2."]";
                break;
            }
            case LOG_USER_CREATE:
            {
                $action = "CREATE the user     [".$idElement1."]";
                break;
            }
            case LOG_USER_DELETE:
            {
                $action = "DELETE the user     [".$idElement1."]";
                break;
            }
            case LOG_GROUP_MODIFY:
            {
                $action = "MODIFY the group    [".$idElement1."]";
                break;
            }
            case LOG_GROUP_CREATE:
            {
                $action = "CREATE the group    [".$idElement1."]";
                break;
            }
            case LOG_GROUP_DELETE:
            {
                $action = "DELETE the group    [".$idElement1."]";
                break;
            }
            default:
            {
                $action = "";
                break;
            }
        }



        $file = fopen(DB_LOG_PATH, 'a+');

        //verifie si il faut afficher une ligne personnalisée
        if($action == "")
        {
            fwrite($file, $log2Row);
        }
        else
        {
            $log = "[".$date."] [".$database.".".$table."] ".$space."[".$user."] ".$action."\r\n";
            fwrite($file, $log);
        }
        fclose($file);
    }
}