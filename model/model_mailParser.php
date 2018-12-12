<?php
class mailParser
{
    private $param;
    private $value;
    private $template;

    public function __construct() {
        $this->param = array("param" => array()) ;
    }

    public function insertValue()
    {
        $strTemplate = file_get_contents($this->template);

        foreach ($this->param['param'] as $key=>$value)
        {

            $strTemplate = str_replace("$".$key."$$", $value, $strTemplate);
            //substr_replace autre metode à retester remplace tout de la postion de depart à la position d'arivée
        }
        return $strTemplate;
    }

    public function setParam($param, $value) {
        $this->param["param"][$param] = $value;
    }
    public function  getParam($param, $value) {
        return $this->param["param"][$param] ;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }






}