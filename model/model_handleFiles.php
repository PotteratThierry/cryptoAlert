<?php
class handleFiles
{
    public function __construct()
    {

    }

    public static function dellFile($file)
    {
        if(file_exists($file))
        {
            //detrui le fichier correspondant
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
    public static function crateNewUserFiles($name)
    {
        $userDirectory = param::searchParam(INI_PATH,'userPath').security::hashPath($name);
        if(!is_dir($userDirectory))
        {
            mkdir($userDirectory);
            mkdir($userDirectory.param::searchParam(INI_PATH,'avatar_path'));
            mkdir($userDirectory.param::searchParam(INI_PATH,'signature_path'));
        }
    }
}