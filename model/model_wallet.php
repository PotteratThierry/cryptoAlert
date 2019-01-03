<?php
class wallet
{
    private $result;
    private $wallet;
    private $jsonWallet;
    private $idUser;
    private $idWallet;
    private $moneyWallet;
    private $nameWallet;
    private $keyWallet;
    private $walletBalance = 0;

    private $tabWallet = array();
    private $tabUser = array();

    private $walletKey;

    private $money;
    private $moneyCode;
    private $moneyValue;

    private $balanceValue;
    private $originalValue;

    private $lstWalletValue = array();
    private $lstBalance = array();
    private $lstCode = array();

    public function __construct()
    {

    }
    public function add($connector)
    {
        //générer le tableau de wallet à partie de old wallet
        $tabWallet = json_decode($this->jsonWallet);
        $nbWallet = count($tabWallet);
        $tabWallet[$nbWallet] = array(WALL_NAME =>$this->nameWallet,WALL_MONEY=>$this->moneyWallet,WALL_KEY=>$this->keyWallet);

        $jsonWallet = json_encode($tabWallet);

        $request = new requestBuilder()  ;
        $request->setTable( TABLE_USER) ;
        $request->setParam( COLUMN_USER_ID , $this->idUser) ;
        $request->setParam( COLUMN_USER_WALLET , $jsonWallet) ;

        $this->result = dbManager::update($connector, $request) ;

    }
    public function create($connector, $refresh=0)
    {
        //générer le tableau de wallet à partie d'un nouveau tableau vide
        if(!$refresh)
        {
            $wallet = array(WALL_NAME =>$this->nameWallet,WALL_MONEY=>$this->moneyWallet,WALL_KEY=>$this->keyWallet);
            $this->tabWallet[0] = $wallet;
        }
        if($this->tabWallet != array())
        {
            $jsonWallet = json_encode ($this->tabWallet);
        }
        else
        {
            $jsonWallet = '';
        }
        $request = new requestBuilder()  ;
        $request->setTable( TABLE_USER) ;
        $request->setParam( COLUMN_USER_ID , $this->idUser) ;
        $request->setParam( COLUMN_USER_WALLET , $jsonWallet) ;

        $this->result = dbManager::update($connector, $request) ;
    }
    public function loadByTab()
    {
        $this->result = json_decode($this->tabUser[COLUMN_USER_WALLET]);
    }
    public function loadOnceByName()
    {
        $tabWallet = json_decode($this->tabUser[COLUMN_USER_WALLET]);
        foreach ($tabWallet as $key=>$value)
        {
            var_dump($value);
            /*if($value[WALL_NAME] == $this->nameWallet)
            {

                $tabWallet[$key][WALL_BALANCE] = $this->balanceValue;
            }*/
        }
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
        $request->setTable( TABLE_USER) ;
        $request->setParam( COLUMN_USER_ID , $this->idUser) ;
        $request->setParam( COLUMN_USER_WALLET , '') ;

        $this->result = dbManager::update($connector, $request) ;
    }
    public function getCodeOfMoney()
    {
        $tmp1 = strrchr($this->money, '(');
        $this->moneyCode =  str_replace(')','',str_replace('(', '', substr($tmp1, 0, strpos($tmp1, ')') + 1)));

    }
    public  function getBalance()
    {

        //recuperation de l'adressse pour le sold. et remplacement des paramètres par les valeurs
        $addressQuery = param::searchParam(INI_PATH, 'apiQueryTwoParam');
        $addressQuery = str_replace('*'.API_CRYPTO_COIN.'*',$this->moneyCode,$addressQuery);
        $addressQuery = str_replace('*'.API_CRYPTO_QUERY.'*',BALANCE,$addressQuery);
        $addressQuery = str_replace('*'.API_CRYPTO_ADDRESS.'*',$this->walletKey,$addressQuery);

        //récupère le sold depuis l'api
        $this->balanceValue = utf8_encode(file_get_contents($addressQuery));
    }
    public function getValueOfMoney()
    {
        //recuperation de l'adressse pour la valeur de la  Monnaie. et remplacement des paramètres par les valeurs
        $addressQuery = param::searchParam(INI_PATH, 'apiQueryOneParam');
        $addressQuery = str_replace('*'.API_CRYPTO_COIN.'*',$this->moneyCode,$addressQuery);
        $addressQuery = str_replace('*'.API_CRYPTO_QUERY.'*',VALUE,$addressQuery);
        $addressQuery = str_replace('*'.API_CRYPTO_ADDRESS.'*','',$addressQuery);

        //récupère la valeur de la monnaie depuis l'api
        $this->moneyValue = utf8_encode(file_get_contents($addressQuery));
    }
    public function getOneBalance()
    {
        $this->money = $this->tabWallet[0]->{WALL_MONEY};
        $this->walletKey = $this->tabWallet[0]->{WALL_KEY};
        self::getCodeOfMoney();
        self::getBalance();
        self::getValueOfMoney();
        self::changeCurrency();
        $this->result =  $this->balanceValue*$this->moneyValue*$this->result;
    }
    public function getAllBalance($change=0)
    {
        self::loadByTab();
        $tabWallet = $this->result;
        $balance = 0;
        $this->lstWalletValue = array();
        $this->lstBalance = array();
        $this->lstCode = array();
        foreach ($tabWallet as $key=>$value)
        {

            if(is_object($value))
            {
                $this->money = $value->{WALL_MONEY};
                $this->walletKey = $value->{WALL_KEY};
            }
            else
            {
                $this->money = $value[WALL_MONEY];
                $this->walletKey = $value[WALL_KEY];
            }
            self::getCodeOfMoney();
            self::getBalance();

            self::getValueOfMoney();

            $tempValue = $this->moneyValue*$this->balanceValue;
            //calcule la valeur du sold en us dollar
            $balance += $tempValue;
            //sauvegarde les valeur individuelle
            self::changeCurrency();
            array_push($this->lstCode,$this->moneyCode);
            array_push($this->lstBalance,$this->balanceValue);
            array_push($this->lstWalletValue,$this->balanceValue*$this->moneyValue*$this->result);
        }
        if($change)
        {
            self::changeCurrency();
            $balance = $balance*$this->result;
        }
        $this->result = $balance;
    }
    public function changeCurrency($currencyOne='', $currencyTwo='')
    {
        if($currencyOne == '' and $currencyTwo == '')
        {
            $currencyOne = param::searchParam(INI_PATH, 'defaultApiCurrency');
            $currencyTwo = param::searchParam(INI_PATH, 'defaultCurrency');
        }
        $request = $currencyOne.API_CHANGE_SEPARATOR.$currencyTwo;
        $addressQuery = param::searchParam(INI_PATH, 'apiChangeRequest');
        $addressQuery = str_replace('*'.API_CHANGE_REQUEST.'*',$request,$addressQuery);

        //recuperation de la valeur depuis l'API
        $currencyValue = json_decode(file_get_contents($addressQuery));

        $this->result = $currencyValue->{$request}->{'val'};
    }

    /**
     * @return int
     */
    public function getWalletBalance()
    {
        return $this->walletBalance;
    }

    /**
     * @param int $walletBalance
     */
    public function setWalletBalance($walletBalance)
    {
        $this->walletBalance = $walletBalance;
    }

    /**
     * @return array
     */
    public function getLstCode()
    {
        return $this->lstCode;
    }

    /**
     * @param array $lstCode
     */
    public function setLstCode($lstCode)
    {
        $this->lstCode = $lstCode;
    }

    /**
     * @return array
     */
    public function getLstBalance()
    {
        return $this->lstBalance;
    }

    /**
     * @param array $lstBalance
     */
    public function setLstBalance($lstBalance)
    {
        $this->lstBalance = $lstBalance;
    }

    /**
     * @return array
     */
    public function getLstWalletValue()
    {
        return $this->lstWalletValue;
    }

    /**
     * @param array $lstWalletValue
     */
    public function setLstWalletValue($lstWalletValue)
    {
        $this->lstWalletValue = $lstWalletValue;
    }

    /**
     * @return mixed
     */
    public function getMoneyValue()
    {
        return $this->moneyValue;
    }

    /**
     * @param mixed $moneyValue
     */
    public function setMoneyValue($moneyValue)
    {
        $this->moneyValue = $moneyValue;
    }

    /**
     * @return mixed
     */
    public function getBalanceValue()
    {
        return $this->balanceValue;
    }

    /**
     * @param mixed $balanceValue
     */
    public function setBalanceValue($balanceValue)
    {
        $this->balanceValue = $balanceValue;
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
        return $this->jsonWallet;
    }

    /**
     * @param mixed $jsonWallet
     */
    public function setJsonWallet($jsonWallet)
    {
        $this->jsonWallet = $jsonWallet;
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
    public function getWalletKey()
    {
        return $this->walletKey;
    }

    /**
     * @param mixed $walletKey
     */
    public function setWalletKey($walletKey)
    {
        $this->walletKey = $walletKey;
    }

    /**
     * @return mixed
     */
    public function getMoney()
    {
        return $this->money;
    }

    /**
     * @param mixed $money
     */
    public function setMoney($money)
    {
        $this->money = $money;
    }

    /**
     * @return mixed
     */
    public function getMoneyCode()
    {
        return $this->moneyCode;
    }

    /**
     * @param mixed $moneyCode
     */
    public function setMoneyCode($moneyCode)
    {
        $this->moneyCode = $moneyCode;
    }

    /**
     * @return mixed
     */
    public function getOriginalValue()
    {
        return $this->originalValue;
    }

    /**
     * @param mixed $originalValue
     */
    public function setOriginalValue($originalValue)
    {
        $this->originalValue = $originalValue;
    }
}