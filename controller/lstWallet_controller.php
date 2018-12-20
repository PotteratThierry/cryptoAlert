<?php
define ('NAME_PAGE', "lstWallet.php");
//page public
define ('TYPE_PERM', 'all');


include_once "../controller/main_controller.php";






$lstWallet =  "active";
$totalWalletValue = 0;
$NewTabWallet = array();

//récupère l'id de l'utilisateur
$contact = new contact();
$contact->setLoginName($_SESSION[LOGIN_NAME]);
$contact->loadOnceByName( $connector);

$cWallet = new wallet();
$cWallet->setTabUser($contact->getResult());
$cWallet->loadByTab();
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
    //calcul le sold total
    $cWallet->getAllBalance(1);
    $totalWalletValue = $cWallet->getResult();

    //création du tableau pour l'affichage
    foreach ($tabWallet as $key=>$value)
    {
        $logo = substr($value->{WALL_MONEY}, 0, strpos($value->{WALL_MONEY},'('));

        //crée un nouveau tableau
        $NewTabWallet[$key][WALL_NAME] = $value->{WALL_NAME};
        $NewTabWallet[$key][WALL_LOGO] = str_replace(' ','',strtolower($logo));
        $NewTabWallet[$key][WALL_MONEY] = $value->{WALL_MONEY};
        $NewTabWallet[$key][WALL_CODE] = strtoupper($cWallet->getLstCode()[$key]);
        $NewTabWallet[$key][WALL_KEY] = $value->{WALL_KEY};
        $NewTabWallet[$key][WALL_BALANCE] = generalFunction::numberFormat($cWallet->getlstBalance()[$key]);
        $NewTabWallet[$key][WALL_VALUE] = generalFunction::numberFormat($cWallet->getLstWalletValue()[$key]);

    }
    $totalWalletValue = generalFunction::numberFormat($totalWalletValue);
}
$cWallet = new wallet();
$cWallet->setTabUser($contact->getResult());
$cWallet->loadByTab();
$tabWallet = $cWallet->getResult();
