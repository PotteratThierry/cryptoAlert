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
    static function disconnect()
    {
        if(SUCCESS_LOG)
        {
            $action = "disconnect form user";
            $ip = $_SERVER["REMOTE_ADDR"];
            $user = $_SESSION[LOGIN_NAME];
            $date = new dateTime();
            $date = $date->format('Y-m-d H:i:s');

            $log = "[".$date."] [".$ip."] [".$user."] [".$action."]\r\n";
            $file = fopen(CONNECT_SUCCESS_LOG_PATH, 'a+');
            fwrite($file, $log);
            fclose($file);
        }

    }
    static function connect($typeError=0)
    {
        if(GET_LOG)
        {
            $action = "";
            $ip = $_SERVER["REMOTE_ADDR"];
            $date = new dateTime();
            $date = $date->format('Y-m-d H:i:s');
            switch ($typeError)
            {
                case 0:
                    {
                        $action = "user unknown";
                        break;
                    }
                case 1:
                    {
                        $action = "successful connect";
                        break;
                    }
                case 2:
                    {
                        $action = "user account disabled";
                        break;
                    }
                case 3:
                    {
                        $action = "wrong password";
                        break;
                    }
            }
            if(isset($_SESSION[LOGIN_NAME]))
            {
                $user = $_SESSION[LOGIN_NAME];
            }
            else
            {
                $user = "unknown";
            }
            $log = "[".$date."] [".$ip."] [".$user."] [".$action."]\r\n";

            //si on veut log les succès
            if(SUCCESS_LOG and $typeError == 1)
            {
                $file = fopen(CONNECT_SUCCESS_LOG_PATH, 'a+');
                fwrite($file, $log);
                fclose($file);
            }
            else
            {
                $file = fopen(CONNECT_LOG_PATH, 'a+');
                fwrite($file, $log);
                fclose($file);
            }
        }

    }
    static function accessPage($typeError=0)
    {
        if(GET_LOG)
        {
            $action = "";
            $user = $_SESSION[LOGIN_NAME];
            $ip = $_SERVER["REMOTE_ADDR"];
            $date = new dateTime();
            $date = $date->format('Y-m-d H:i:s');
            //si on a fourni le nom de la page
            if(NAME_PAGE != "")
            {
                //si c'est un utilisateur connecté
                if($user != "")
                {
                    switch ($typeError)
                    {
                        case 0:
                            {
                                $action = "successful access";
                                break;
                            }
                        case 1:
                            {
                                $action = "user account disabled";
                                break;
                            }
                        case 2:
                            {
                                $action = "insufficient rights";
                                break;
                            }

                    }
                }
                else
                {
                    $user = "unknown";
                    $action = "access denied";
                }
                $log = "[".$date."] [".$ip."] [".$user."] [".$action."] [".NAME_PAGE."]\r\n";

                //si on veut log les succès
                if(SUCCESS_LOG and $typeError == 0 and $user != "")
                {
                    $file = fopen(ACCESS_SUCCESS_LOG_PATH, 'a+');
                    fwrite($file, $log);
                    fclose($file);
                }
                else
                {
                    $file = fopen(ACCESS_LOG_PATH, 'a+');
                    fwrite($file, $log);
                    fclose($file);
                }

            }
        }

    }
    /*static function dbLog($function, $table, $idElement1, $idElement2= 0, $idElement3= 0)
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
    }*/
}