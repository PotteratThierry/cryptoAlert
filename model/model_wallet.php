<?php
class wallet
{
    private $result;
    private $wallet;
    private $oldWallet;
    private $idUser;
    private $idWallet;
    private $moneyWallet;
    private $nameWallet;
    private $keyWallet;
    private $tabWallet = array();

    private $tabUser;

    public function __construct()
    {

    }
    public function add($connector)
    {

        //générer le tableau de wallet à partie d'un nouveau tableau vide
        $tabWallet = json_decode($this->oldWallet);
        $nbWallet = count($tabWallet);
        $tabWallet[$nbWallet] = array(WALL_NAME =>$this->nameWallet,WALL_MONEY=>$this->moneyWallet,WALL_KEY=>$this->keyWallet );
        $jsonWallet = json_encode($tabWallet);

        $request = new requestBuilder()  ;
        $request->setTable( TABLE_USER.$this->idUser) ;
        $request->setParam( COLUMN_USER_WALLET , $jsonWallet) ;

        $this->result = dbManager::update($connector, $request) ;

    }
    public function create($connector, $refresh=0)
    {
        if(!$refresh)
        {
            $wallet = array(WALL_NAME =>$this->nameWallet,WALL_MONEY=>$this->moneyWallet,WALL_KEY=>$this->keyWallet);
            $this->tabWallet[0] = $wallet;
        }
        $jsonWallet = json_encode ($this->tabWallet);
        //générer le tableau de wallet à partie de old wallet
        $request = new requestBuilder()  ;
        $request->setTable( TABLE_USER.$this->idUser) ;
        $request->setParam( COLUMN_USER_WALLET , $jsonWallet) ;

        $this->result = dbManager::update($connector, $request) ;
    }
    public function loadOnceById()
    {
        $this->result = json_decode($this->tabUser[COLUMN_USER_WALLET]);
    }
    public function delete($connector)
    {
        unset($this->tabWallet[$this->idWallet]);
        //reinitialisation des id
        $tabNewWallet = array();
        $i = 0;
        foreach ($this->tabWallet as $key=>$value)
        {
            $tabNewWallet[$i][WALL_NAME] = $value->{WALL_NAME};
            $tabNewWallet[$i][WALL_MONEY] = $value->{WALL_MONEY};
            $tabNewWallet[$i][WALL_KEY] = $value->{WALL_KEY};
            $i++;
        }
        $this->tabWallet = $tabNewWallet;
        self::create($connector, 1);
    }
    public function deleteAll($connector)
    {
        $request = new requestBuilder()  ;
        $request->setTable( TABLE_USER.$this->idUser) ;
        $request->setParam( COLUMN_USER_WALLET , '') ;

        $this->result = dbManager::update($connector, $request) ;
    }

    /**
     * @return mixed
     */
    public function getIdWallet()
    {
        return $this->idWallet;
    }

    /**
     * @param mixed $idWallet
     */
    public function setIdWallet($idWallet)
    {
        $this->idWallet = $idWallet;
    }

    /**
     * @return mixed
     */
    public function getTabUser()
    {
        return $this->tabUser;
    }

    /**
     * @param mixed $tabUser
     */
    public function setTabUser($tabUser)
    {
        $this->tabUser = $tabUser;
    }

    /**
     * @return mixed
     */
    public function getKeyWallet()
    {
        return $this->keyWallet;
    }

    /**
     * @param mixed $keyWallet
     */
    public function setKeyWallet($keyWallet)
    {
        $this->keyWallet = $keyWallet;
    }

    /**
     * @return mixed
     */
    public function getNameWallet()
    {
        return $this->nameWallet;
    }

    /**
     * @param mixed $nameWallet
     */
    public function setNameWallet($nameWallet)
    {
        $this->nameWallet = $nameWallet;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
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
    public function getWallet()
    {
        return $this->wallet;
    }

    /**
     * @param mixed $wallet
     */
    public function setWallet($wallet)
    {
        $this->wallet = $wallet;
    }

    /**
     * @return mixed
     */
    public function getOldWallet()
    {
        return $this->oldWallet;
    }

    /**
     * @param mixed $oldWallet
     */
    public function setOldWallet($oldWallet)
    {
        $this->oldWallet = $oldWallet;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getMoneyWallet()
    {
        return $this->moneyWallet;
    }

    /**
     * @param mixed $moneyWallet
     */
    public function setMoneyWallet($moneyWallet)
    {
        $this->moneyWallet = $moneyWallet;
    }

    /**
     * @return array
     */
    public function getTabWallet()
    {
        return $this->tabWallet;
    }

    /**
     * @param array $tabWallet
     */
    public function setTabWallet($tabWallet)
    {
        $this->tabWallet = $tabWallet;
    }





}