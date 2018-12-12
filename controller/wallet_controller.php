<?php
define ('NAME_PAGE', "wallet.php");
//page public
define ('TYPE_PERM', 'all');

include_once "../controller/main_controller.php";

$lstWallet =  "active";
$successMsg = "";
$errorMsg = "";
$error = 0;
$success = 0;

//si on arrive à ce connecter à la base de donnée
if($dbConnected)
{
    if(isset($_POST[WALL_KEY]))
    {
        $strWallet = security::html($_POST[WALL_KEY]);
        $moneyWallet = security::html($_POST[MONEY_WALLET]);
        $walletName = security::html($_POST[WALL_NAME]);

        //récupère l'id de l'utilisateur
        $contact = new contact();
        $contact->setLoginName($_SESSION[LOGIN_NAME]);
        $contact->loadOnceByName( $connector);
        $idUser = $contact->getResult()[COLUMN_ID];

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
            $contact = new contact();
            $contact->setNameWallet($walletName);
            $contact->setKeyWallet($strWallet);
            $contact->setMoneyWallet($moneyWallet);
            $contact->setIdUser($idUser);
            $contact->addWallet($connector);
        }
        header(LOCATION . '../view/lstWallet.php');
    }

}

$contact = new money();
$contact->load($connector);
$tabMoney = $contact->getResult();
