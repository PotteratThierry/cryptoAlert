<?php
class money
{
    const ALL = 'summary';
    const NAME = 'name';
    const POW = 'PoW';
    const POS = 'PoS';
    const HEIGHT = 'height';
    const DIFF = 'diff';
    const SUPPLY = 'supply';
    const TICKER = 'ticker';
    const BTC = 'btc';

    private $apiSource;
    private $result;

    public function __construct()
    {
        $this->apiSource = param::searchParam(INI_PATH, 'apiExplorer');

    }
    public function refresh($connector)
    {
        $jsonSources = "";
        try
        {

            $jsonSources = utf8_decode(file_get_contents($this->apiSource.self::ALL));

        }
        catch(Exception $e )
        {
            $this->result =  $e->getMessage() ;
        }
        $tabMoney = json_decode($jsonSources, true);
        if($tabMoney != "")
        {
            self::deleteAll($connector);

            foreach ($tabMoney as $key=>$value)
            {
                $request = new requestBuilder();
                $request->setTable( TAB_MONEY);
                $request->setParam( COLUMN_MONEY_ID  ,  NULL) ;
                $request->setParam( COLUMN_MONEY_NAME,$value[self::NAME] );
                $request->setParam( COLUMN_MONEY_CODE,$key);
                $request->setParam( COLUMN_MONEY_POW,$value[self::POW]   );
                $request->setParam( COLUMN_MONEY_POS, $value[self::POS]   );
                $request->setParam( COLUMN_MONEY_HEIGHT, $value[self::HEIGHT]   );
                $request->setParam( COLUMN_MONEY_DIFF, $value[self::DIFF]   );
                $request->setParam( COLUMN_MONEY_SUPPLY, $value[self::SUPPLY]   );
                if(isset($value[self::TICKER]->{self::BTC}))
                {
                    $request->setParam( COLUMN_MONEY_TICKER, $value[self::TICKER]->{self::BTC});
                }
                else
                {
                    $request->setParam( COLUMN_MONEY_TICKER, NULL);
                }


                $this->result = dbManager::save($connector, $request) ;
            }
        }
    }
    public function Load($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TAB_MONEY);
        $this->result = dbManager::load($connector, $request) ;
    }
    public function deleteAll($connector)
    {
        $request = new requestBuilder();
        $request->setTable(TAB_MONEY);

        $this->result = dbManager::deleteTable($connector, $request) ;
    }

    /**
     * @return int
     */
    public function getApiSource()
    {
        return $this->apiSource;
    }

    /**
     * @param int $apiSource
     */
    public function setApiSource($apiSource)
    {
        $this->apiSource = $apiSource;
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

}