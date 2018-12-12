<?php
class generalFunction
{
    //contatnt des nom des paramètre dans le fichier .ini
    const JPG			= "ext_jpg";
    const JPEG 			= "ext_jpeg";
    const PJPG			= "ext_pjpg";
    const PJPEG 		= "ext_pjpeg";
    const GIF 			= "ext_gif";
    const PNG 			= "ext_png";
    const BMP 			= "ext_bmp";
    const LST_EXT 		= "lst_ext";
    const LST_EXT_IE 	= "lst_ext_ie";
    const EMAIL_REG_EX	= 'mailRegExt';
    const LOGIN_NAME_REG_EX	= 'loginNameRegExt';

    //variable qui contiennent les donnée des nom défini plus haut
    private $jpg;
    private $jpeg;
    private $pjpg;
    private $pjpeg;
    private $gif;
    private $png;
    private $bmp;
    private $mailRegExt;

    private $result;

    private $date;
    private $mail;

    private $width = 0;
    private $height = 0;
    private $imageName;
    private $image;
    private $newImage;
    private $imageTmp;
    private $imageSize;
    private $path;

    // list des extention MME pour tout les navigateur et IE
    private $listExtention;
    private $listExtentionIe;
    private $imageExt;


    public function __construct()
    {

    }
    public static function checkDate($date)
    {
        //format la date avant la validation
        $dateTab = explode('-', $date);
        $year = $dateTab[0];
        $month = $dateTab[1];
        $day = $dateTab[2];
        return checkdate($month, $day, $year);
    }
    public static function checkLoginName($LoginName)
    {
        $loginNameRegExt = param::searchParam(INI_PATH,self::LOGIN_NAME_REG_EX);

        if(preg_match($loginNameRegExt,$LoginName))
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }
    public static function checkMail($mail)
    {
        $mailRegExt = param::searchParam(INI_PATH,self::EMAIL_REG_EX);

        if(preg_match($mailRegExt,$mail))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    public static function numberFormat($num)
    {
        if(is_numeric($num))
        {
            if(is_float($num))
            {
                $num = number_format($num, 2, ',', '\'');
            }
            else
            {
                $num = number_format($num, 0, ',', '\'');
            }
        }
        else
        {
            $num = 0;
        }
        return $num;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param int $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $imageExt
     */
    public function setImageExt($imageExt)
    {
        $this->imageExt = $imageExt;
    }

    /**
     * @return mixed
     */
    public function getImageExt()
    {
        return $this->imageExt;
    }

    /**
     * @param mixed $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    /**
     * @return mixed
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @param mixed $imageSize
     */
    public function setImageSize($imageSize)
    {
        $this->imageSize = $imageSize;
    }

    /**
     * @return mixed
     */
    public function getImageSize()
    {
        return $this->imageSize;
    }

    /**
     * @param mixed $imageTmp
     */
    public function setImageTmp($imageTmp)
    {
        $this->imageTmp = $imageTmp;
    }

    /**
     * @return mixed
     */
    public function getImageTmp()
    {
        return $this->imageTmp;
    }

    /**
     * @param array $listExtention
     */
    public function setListExtention($listExtention)
    {
        $this->listExtention = $listExtention;
    }

    /**
     * @return array
     */
    public function getListExtention()
    {
        return $this->listExtention;
    }

    /**
     * @param array $listExtentionIe
     */
    public function setListExtentionIe($listExtentionIe)
    {
        $this->listExtentionIe = $listExtentionIe;
    }

    /**
     * @return array
     */
    public function getListExtentionIe()
    {
        return $this->listExtentionIe;
    }

    /**
     * @param mixed $newImage
     */
    public function setNewImage($newImage)
    {
        $this->newImage = $newImage;
    }

    /**
     * @return mixed
     */
    public function getNewImage()
    {
        return $this->newImage;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
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
     * @param int $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }



}
?>