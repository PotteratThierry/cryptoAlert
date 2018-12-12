<?php
class param
{
    public function __construct()
    {

    }
    public static function searchParam($addTabFile,$paramName, $key = false)
    {

            if($addTabFile != "")
            {
                //si on veut recperer la clef
                if($key)
                {
                    return $paramName;
                }
                else
                {
                    $addTab_array = parse_ini_file($addTabFile, true);
                    if (isset($addTab_array[$paramName])) {
                        return $addTab_array[$paramName];
                    } else {
                        return 0;
                    }
                }
            }
            else
            {
                return 0;
            }
    }
    public static function recoveryParam($path)
    {
        $error = 0;
        $tab = array();
        if(self::getAccess($path))
        {
            $file=INI_PATH;
            $i = 0;
            $equal = "=";
            $quote = "'";
            $semicolon = ";";
            if(file_exists($file) && $read_file=file($file))
            {
                foreach($read_file as $key=>$value)
                {
                    //verifie si s'est un commantaire
                    $value = trim($value);
                    if(isset($value[0]) && $value[0] != trim($semicolon))
                    {
                        $posEqual = strpos($value, $equal);
                        $posQuote = strpos($value, $quote);
                        $paramName = trim(substr($value,0 , $posEqual));
                        $paramValue = substr(trim($value),$posQuote+1, -1);
                        $tab = array_merge($tab, array($paramName => $paramValue));
                    }
                    else
                    {
                        $paramName = $i;
                        $paramValue = trim(substr($value,1));
                        $tab = array_merge($tab, array($paramName => $paramValue));
                        $i++;
                    }
                }
            }
            else
            {
                $error = 1;
            }
        }
        if($error)
        {
            return array();
        }
        else
        {
            return $tab;
        }
    }
    public static function addParam($baseTab,$addTab,$pos){
        if(is_int($pos)) $R=array_merge(array_slice($baseTab,0,$pos+1), $addTab, array_slice($baseTab,$pos+1));
        else{
            foreach($baseTab as $k=>$v){
                $R[$k]=$v;
                if($k==$pos)$R=array_merge($R,$addTab);
            }
        }return $R;
    }
    public static function saveParam($tab, $path)
    {
        unlink ($path);
        $files = fopen($path, "a+");
        foreach($tab as $key=>$value)
        {
            //récupère les lignes sans données
            if(is_numeric($key))
            {
                //récupère les commentaires
                if($value != "")
                {
                    //écrit les commentaires dans le fichier
                    fwrite($files, ";".$value."\r\n");
                }
                else
                {
                    //effectue les retour à la lignes
                    fwrite($files, "\r\n");
                }
            }
            else
            {
                fwrite($files, $key." = '".$value."'\r\n");
            }
        }
        fclose($files);
    }
    public static function getAccess($path)
    {
        $result = 0 ;
        if(is_writable($path))
        {
            $result = 1;
        }
        else
        {
            if(!chmod ("membres.ini", 7777))
            {
                $result = 0;
            }
            else
            {
                $result = 1;
            }
        }
        return $result;
    }

}