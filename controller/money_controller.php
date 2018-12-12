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

if(isset($_POST[MONEY_WALLET]))
{

    $cMoney = new money();
    $cMoney->refresh($connector);
}
$contact = new money();
$contact->load($connector);
$tabMoney = $contact->getResult();


