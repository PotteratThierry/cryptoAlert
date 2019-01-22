<?php
class handleFiles
{
    public function __construct()
    {

    }

    public static function dellFile($file)
    {

        //si c'est pas un dossier et qu'il existe
        if(file_exists($file) and !is_dir($file))
        {
            //détruit le fichier correspondant
            unlink($file);
        }
        else
        {
            return 0;
        }
    }
    public static function dellDirectory($directory)
    {
        $handle = opendir($directory);
        while(false !== ($entry = readdir($handle)))
        {
            if($entry != '.' && $entry != '..')
            {
                if(is_dir($directory.'/'.$entry))
                {
                    handleFiles::dellDirectory($directory.'/'.$entry);
                }
                elseif(is_file($directory.'/'.$entry)){
                    unlink($directory.'/'.$entry);
                }
            }
        }
        rmdir($directory.'/'.$entry);
        closedir($handle);
    }
    public static function createUserDir($id)
    {
        $userDirectory = param::searchParam(INI_PATH,'userPath').$id;
        if(!is_dir($userDirectory))
        {
            mkdir($userDirectory);
            mkdir($userDirectory.param::searchParam(INI_PATH,'avatar_path'));
            mkdir($userDirectory.param::searchParam(INI_PATH,'signature_path'));
        }
    }
}