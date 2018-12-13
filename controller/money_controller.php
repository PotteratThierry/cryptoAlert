<?php
define ('NAME_PAGE', "money.php");
//page public
define ('TYPE_PERM', 'all');

include_once "../controller/main_controller.php";

$money =  "active";
$successMsg = "";
$errorMsg = "";
$error = 0;
$success = 0;
$difference_block1 = 0;


//-------------------------------------//
//-----------------block1--------------//
//-------------------------------------//
$timestampAPI1_debut = microtime( true);

if(isset($_POST[MONEY_WALLET]))
{

    $cMoney = new money();
    $cMoney->refresh($connector);
}
$contact = new money();
$contact->load($connector);
$tabMoney = $contact->getResult();

$timestampAPI1_fin = microtime( true);
$difference_block1 = $difference_block1 + $timestampAPI1_fin - $timestampAPI1_debut;
