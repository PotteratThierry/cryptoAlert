<?php
define ('NAME_PAGE', "lstWallet.php");
//page public
define ('TYPE_PERM', 'all');


include_once "../controller/main_controller.php";

//constante pour l'API des crypto monnaies
define ('API_CRYPTO_COIN', 'coin');
define ('API_CRYPTO_QUERY', 'query');
define ('API_CRYPTO_ADDRESS', 'address');

//constante pour l'API de change de devise
define('API_CHANGE_REQUEST', 'request');
define('API_CHANGE_SEPARATOR', '_');


//constante pour le tabeau pour l'affichage
define ('BALANCE', 'getbalance');
define ('VALUE', 'ticker.usd');

$lstWallet =  "active";
$totalWalletValue = 0;
$NewTabWallet = array();

//valeur pour l'affichage de performances
$difference_block1 = 0;
$difference_block2 = 0;
$difference_block3 = 0;
$total = 0;

//récupère l'id de l'utilisateur
$contact = new contact();
$contact->setLoginName($_SESSION[LOGIN_NAME]);
$contact->loadOnceByName( $connector);

$cWallet = new wallet();
$cWallet->setTabUser($contact->getResult());
$cWallet->loadOnceById();
$tabWallet = $cWallet->getResult();
if(isset($_POST[DELETE.'all']))
{
    $cWallet = new wallet();
    $cWallet->setIdUser($contact->getResult()[COLUMN_USER_ID]);
    $cWallet->deleteAll($connector);
}
if(isset($_POST[DELETE]))
{
    $cWallet->setIdWallet($_POST[DELETE]);
    $cWallet->setTabWallet($tabWallet);
    $cWallet->setIdUser($contact->getResult()[COLUMN_USER_ID]);
    $cWallet->delete($connector);
}

if($tabWallet != "")
{
    //-------------------------------------//
    //-----------------block1--------------//
    //-------------------------------------//
    $timestampAPI1_debut = microtime( true);

    //change de la monnaie en la devise que l'utilisateur à configurer
    $request = $defaultApiCurrency.API_CHANGE_SEPARATOR.$defaultCurrency;
    $addressQuery = param::searchParam(INI_PATH, 'apiChangeRequest');
    $addressQuery = str_replace('*'.API_CHANGE_REQUEST.'*',$request,$addressQuery);

    //recuperation de la valeur depuis l'API
    $currencyValue = json_decode(file_get_contents($addressQuery));

    $timestampAPI1_fin = microtime( true);
    $difference_block1 = $timestampAPI1_fin - $timestampAPI1_debut;
    foreach ($tabWallet as $key=>$value)
    {

        //recuperation du code de la monnaie
        $tmp1 = strrchr($value->{WALL_MONEY}, '(');
        $moneyCode = str_replace(')','',str_replace('(', '', substr($tmp1, 0, strpos($tmp1, ')') + 1)));

        //si le code de la monnaie est pas renseigner on n'affiche rien pour évitée l'affichage de la page de l'api
        if($moneyCode == "")
        {
            $balance = "";
        }
        else
        {
            //-------------------------------------//
            //-----------------block2--------------//
            //-------------------------------------//
             $timestampAPI2_debut = microtime( true);
            //recuperation de l'adressse pour le sold. et remplacement des paramètres par les valeurs
            $addressQuery = param::searchParam(INI_PATH, 'apiAddressQuery');
            $addressQuery = str_replace('*'.API_CRYPTO_COIN.'*',$moneyCode,$addressQuery);
            $addressQuery = str_replace('*'.API_CRYPTO_QUERY.'*',BALANCE,$addressQuery);
            $addressQuery = str_replace('*'.API_CRYPTO_ADDRESS.'*',$value->{WALL_KEY},$addressQuery);

            //récupère le sold depuis l'api
            $balance = utf8_encode(file_get_contents($addressQuery));
             $timestampAPI2_fin = microtime( true);




            //-------------------------------------//
            //-----------------block3--------------//
            //-------------------------------------//
             $timestampAPI3_debut = microtime( true);
            //recuperation de l'adressse pour la valeur de la  Monnaie. et remplacement des paramètres par les valeurs
            $addressQuery = param::searchParam(INI_PATH, 'apiAddressQuery');
            $addressQuery = str_replace('*'.API_CRYPTO_COIN.'*',$moneyCode,$addressQuery);
            $addressQuery = str_replace('*'.API_CRYPTO_QUERY.'*',VALUE,$addressQuery);
            $addressQuery = str_replace('*'.API_CRYPTO_ADDRESS.'*',$value->{WALL_KEY},$addressQuery);

            //récupère la valeur de la monnaie depuis l'api
            $moneyValue = utf8_encode(file_get_contents($addressQuery));
             $timestampAPI3_fin = microtime( true);


            //converti la valeur de la monnaie en devise define par l'utilisateur
            $moneyValue = $moneyValue*$currencyValue->{$request}->{'val'};


            //calcule la valeur du sold
            $walletValue = $moneyValue*$balance;
            //vérifie si il il y a besoin d'arondire ou pas
            if($walletValue<0.01 and $walletValue != 0)
            {
                $walletValue = $moneyValue*$balance;
            }
            else
            {
                $walletValue = round($moneyValue*$balance,'2');
            }
            $totalWalletValue += $walletValue;
            //création de format des nombre
            $balance = number_format($balance, 2, '.', '\'');
            $walletValue = number_format($walletValue, 2, '.', '\'');

            //création du nom de la monnaie pour le logo
            $logo = substr($value->{WALL_MONEY}, 0, strpos($value->{WALL_MONEY},'('));
        }

        //crée un nouveau tableau
        $NewTabWallet[$key][WALL_NAME] = $value->{WALL_NAME};
        $NewTabWallet[$key][WALL_LOGO] = str_replace(' ','',strtolower($logo));
        $NewTabWallet[$key][WALL_MONEY] = $value->{WALL_MONEY};
        $NewTabWallet[$key][WALL_CODE] = strtoupper($moneyCode);
        $NewTabWallet[$key][WALL_KEY] = $value->{WALL_KEY};
        $NewTabWallet[$key][WALL_BALANCE] = $balance;
        $NewTabWallet[$key][WALL_VALUE] = $walletValue;



        $difference_block2 = $difference_block2 +  $timestampAPI2_fin - $timestampAPI2_debut;
        $difference_block3 = $difference_block3 +  $timestampAPI3_fin - $timestampAPI3_debut;

    }
    $totalWalletValue = number_format($totalWalletValue, 2, '.', '\'');
    $total = $difference_block1+ $difference_block2+$difference_block3;
}
