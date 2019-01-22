<?php
class handleImg
{
    public function __construct()
    {

    }
    public static function checkImg($image)
    {

        $tabExt[0] = 'image/jpg';
        $tabExt[1] = 'image/jpeg';
        $tabExt[2] = 'image/jpg';
        $tabExt[3] = 'image/pjpg';
        $tabExt[4] = 'image/png';
        $tabExt[5] = 'image/png';
        $tabExt[6] = 'image/jpg';
        $tabExt[7] = 'image/jpg';
        $result = 0;
        // Je vérifie si l'extention est valide
        $imgsize = getimagesize($image);
        //verification que le type MME correspond bien à l'extentzion de l'image
        if(in_array($imgsize['mime'],$tabExt))
        {
            $imageExt = substr($imgsize['mime'], 6);
            //verifie si l'extention fais partie des extention autorisée par le site
            $lst_ext =  param::searchParam(INI_PATH,'lst_ext');
            foreach($lst_ext as $key=>$value)
            {
                if($value == $imageExt)
                {
                    $result = 1;
                    break;
                }
                else
                {
                    $result = 0;
                }
            }
            if($result != 0)
            {
                return $imageExt;
            }
            else
            {
                return $result;
            }

        }
        else
        {
            return 1;
        }
    }
    public static function imgResize($imageTmp, $userPath ,$imgNewName,$width, $height)
    {
        //deffinition des extentions traitée par les fonction de création d'image
        $jpg = 'jpg';
        $jpeg = 'jpeg';
        $pjpg = 'pjpg';
        $pjpeg = 'pjpeg';
        $gif = 'gif';
        $png = 'png';
        $bmp = 'bmp';

        $listExtention = param::searchParam(INI_PATH,"lst_ext");

        //recuperation de la taille de l'image
        $imageSize = getimagesize($imageTmp);
        $imageExt = handleImg::checkImg($imageTmp);

        //création d'une copie de l'image
        if($imageExt == $jpg OR $imageExt == $jpeg OR $imageExt == $pjpg OR $imageExt == $pjpeg)
        {
            $imageTmp = imagecreatefromjpeg($imageTmp);
        }
        if($imageExt == $bmp)
        {
            $imageTmp = imagecreatefromwbmp($imageTmp);
        }
        if($imageExt == $gif)
        {
            $imageTmp = imagecreatefromgif($imageTmp);
        }
        if($imageExt == $png)
        {
            $imageTmp = imagecreatefrompng($imageTmp);
        }
        //crée des variable temporaire pour le teste de la longueur et de la largeur
        $tmpHeight = $imageSize[1];
        $tmpWidth = $imageSize[0];
        //si on decide de redimentinoner par à port à la hauteur
        if($width !=0 AND $height == 0)
        {
            //verifier que la hauteur de l'image est plus grande que la hauteur maximale
            if($tmpWidth > $width)
            {
                //calcule du % de redimentionnement, et crée la nouvelle hauteur et largeur
                $resize = ( ($width * 100)/$imageSize[0] );
                $height = ( ($imageSize[1] * $resize)/100 );
            }
            else
            {
                $width = $imageSize[0];
                $height = $imageSize[1];
            }
        }
        //si on decide de redimentinoner par à port à la largeur
        if($height != 0 AND $width == 0)
        {
            //verifier que la largeur de l'image est plus grande que la hauteur maximale
            if($tmpHeight > $height)
            {
                //calcule du % de redimentionnement, et crée la nouvelle hauteur et largeur
                $resize = (($height * 100)/$imageSize[1]);
                $width = ( ($imageSize[0] * $resize)/100 );
            }
            else
            {
                $width = $imageSize[0];
                $height = $imageSize[1];
            }
        }
        //si les deux paramètre sont remplit
        if($width != 0 AND $height != 0)
        {
            //verifier que la hauteur de l'image est plus grande que la hauteur maximale
            if($tmpHeight > $height)
            {
                //calcule du % de redimentionnement, et crée la nouvelle hauteur et largeur
                $resize = (($height * 100)/$imageSize[1]);
                $tmpWidth = ( ($imageSize[0] * $resize)/100 );
                $tmpHeight = $height;
            }
            //verifier que la nouvelle largeur de l'image est plus grande que la largeur maximale
            if($tmpWidth > $width)
            {
                //calcule du % de redimentionnement, et crée la nouvelle hauteur et largeur
                $resize = ( ($width * 100)/$imageSize[0] );
                $tmpHeight = ( ($imageSize[1] * $resize)/100 );
                $tmpWidth = $width;
            }
            //transfère les variable temporaire au variable finale
            $height = $tmpHeight;
            $width = $tmpWidth;
        }
        //si l'un des deux paramètre est pas null ou les deux remplit
        if($width != 0 OR $height != 0)
        {
            //crée la nouvelle image
            $newImage = imagecreatetruecolor($width, $height);

            // conservation de la transparences
            if($imageExt == "gif" OR  $imageExt == "png"){
                imagecolortransparent($newImage, imagecolorallocatealpha($newImage, 0, 0, 0, 127));
                imagealphablending($newImage, false);
                imagesavealpha($newImage, true);
            }
            //création de la nouvelle image
            imagecopyresampled($newImage, $imageTmp, 0, 0, 0, 0, $width, $height, $imageSize[0], $imageSize[1]);
            if($imageExt == $jpg OR $imageExt == $jpeg OR $imageExt == $pjpg OR$imageExt == $pjpeg)
            {
                imagejpeg($newImage, $userPath.$imgNewName.'.'.$imageExt);
            }
            if($imageExt == $gif)
            {
                imagegif($newImage, $userPath.$imgNewName.'.'.$imageExt);
            }
            if($imageExt == $bmp)
            {
                imagewbmp($newImage, $userPath.$imgNewName.'.'.$imageExt);
            }
            if($imageExt == $png)
            {
                imagepng($newImage , $userPath.$imgNewName.'.'.$imageExt);
            }
            return  $imgNewName.'.'.$imageExt;
        }
        else
        {
            return "";
        }
    }

}