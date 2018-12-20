<?php

abstract class BasicEnum {
    private static $constCacheArray = NULL;

    private static function getConstants() {
        if (self::$constCacheArray == NULL) {
            self::$constCacheArray = [];
        }
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }
        return self::$constCacheArray[$calledClass];
    }

    public static function isValidName($name, $strict = false) {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    public static function isValidValue($value, $strict = true) {
        $values = array_values(self::getConstants());
        return in_array($value, $values, $strict);
    }
}

abstract class eDatabase extends BasicEnum
{
    const redis = 2;
    const mySql = 3;
}

class dbManager{

    private static $db ;

    public static function getConnector( $dbType ) {
        switch ($dbType) {
            case 'redis'  :
            case 2  :
                self::$db = new dbRedis();
                break ;

            case 'mySql' :
            case 3  :
                self::$db = new dbMysql();
                break ;
        }

        if( self::$db->getInstance() == null )
            throw new exErrorDB("-- !! error !! --") ;

        return  self::$db ;

    }

    public static function getInstance( $dbType) {
        return self::$db->getInstance() ;
    }

    public static function save(iDatabase $db, $param) {
        $db->save($param) ;
        return $db->getResult();
    }
    public static function load(iDatabase $db, $param) {
        $db->load($param) ;
       return $db->getResult() ;
    }
    public static function valueExist(iDatabase $db, $param) {
        $db->valueExist($param) ;
        return $db->getResult() ;
    }
    public static function loadOnce(iDatabase $db, $param) {
        $db->loadOnce($param) ;
        return $db->getResult() ;
    }
    public static function update(iDatabase $db,$param) {
        $db->update($param) ;
        return $db->getResult() ;
    }
    public static function delete(iDatabase $db, $param) {
        $db->delete($param) ;
        return $db->getResult() ;
    }
    public static function deleteTable(iDatabase $db, $param) {
        $db->deleteTable($param) ;
        return $db->getResult() ;
    }
    public static function deleteAll(iDatabase $db) {
        $db->deleteALL() ;
    }


}



