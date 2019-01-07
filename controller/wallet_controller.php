<?php
define ('NAME_PAGE', "wallet.php");
//page public
define ('TYPE_PERM', 'all');

include_once "../controller/main_controller.php";

$lstWallet =  "active";


//si on arrive à ce connecter à la base de donnée
if($dbConnected)
{
    if(isset($_POST[WALL_KEY]))
    {
        $strWallet = security::html($_POST[WALL_KEY]);
        $moneyWallet = security::html($_POST[MONEY_WALLET]);
        $walletName = security::html($_POST[WALL_NAME]);

        //récupère l'id de l'utilisateur
        $cContact = new contact();
        $cContact->setLoginName($_SESSION[LOGIN_NAME]);
        $cContact->loadOnceByName( $connector);
        $idUser = $cContact->getResult()[COLUMN_USER_ID];

        if($strWallet == "")
        {
            $error = 1;
        }
        if($moneyWallet != "")
        {
            $error = 1;
        }
        if($error != 0)
        {
            $cContact = new contact();
            $cContact->setNameWallet($walletName);
            $cContact->setKeyWallet($strWallet);
            $cContact->setMoneyWallet($moneyWallet);
            $cContact->setIdUser($idUser);
            $cContact->addWallet($connector);
        }
        header(LOCATION . '../view/lstWallet.php');
    }

}

$cContact = new money();
$cContact->load($connector);
$tabMoney = $cContact->getResult();
