<?php
/**
 * Created by PhpStorm.
 * User: Potterat Thierry
 * Date: 01.06.14
 * Time: 12:48
 */
class security
{
    private $password;
    private $result;
    //conection
    const GDS               = "Y9TQWV4RB9ITC8ZFR6ZSQWHEZUYESQCD";
    const GDS_FILE_PATH     = "9ZRHVXV4K7W1X142RZ6IO3ABKZ7RYS5O";
    const GDS_IMG_NAME      = "R1TEGVFU1VQAY3XL67P478APZTGPY0DX";

    // Données sortantes
    public static function html($string)
    {
        $string = htmlentities($string);
        return $string;
    }
    public static function hash($string)
    {
        $string = sha1($string.self::GDS);
        return $string;
    }
    public static function imgPathHash($globalPath, $userName, $directoryPath, $imgName = 1)
    {
        $userName =  self::hashPath($userName);
        //si le nom de l'imageà pas été set
        if($imgName)
        {
            $imgName = self::hashImgName(rand(10000,99999));
        }
        else
        {
            $imgName = self::hashImgName($imgName);
        }
        return $globalPath.$userName.$directoryPath.$imgName;
    }
    public static function hashImgName($string)
    {
        $string = sha1($string.self::GDS_IMG_NAME);
        return $string;
    }
    public static function hashPath($string)
    {
        $string = sha1($string.self::GDS_FILE_PATH);
        return $string;
    }
    public static function passwordComplexity($password)
    {
        $result = 0;
        //valdation de la longueur
        if ( strlen($password) >= 6 )
        {
           //validation d'au moins une lettre
            if (preg_match("/[a-z]/", $password))
            {
                //validation d'au moins une lettre Majuscule
                if (preg_match("/[A-Z]/", $password))
                {
                    //validation d'au moins d'un nombre
                    if (preg_match("/\d/", $password))
                    {
                        $result = 1;
                        /*//validation d'au moins un caractère spécial
                        if (preg_match("/\W/", $password))
                        {

                        }*/
                    }
                }
            }
        }
        return $result;
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

}