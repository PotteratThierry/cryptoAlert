<?php
define ('NAME_PAGE', "viewDb.php");
//page public
define ('TYPE_PERM', 'all');

include_once "../controller/main_controller.php";



$viewDb = "active";

//paramètre de session pour afficher les bon menu lors de la navigation sur les paramètre de compte
$_SESSION[ADMIN] = 0;

$successMsg = "";
$errorMsg = "";
$error = 0;
$success = 0;

$contact = new contact();
$contact->load($connector);
$tabUser = $contact->getResult();

if($dbConnected)
{
    if(isset($_POST[DELETE]))
    {
        $contact = new contact();
        $contact->deleteALL($connector);
    }
}

