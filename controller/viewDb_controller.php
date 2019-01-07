<?php
define ('NAME_PAGE', "viewDb.php");
//page public
define ('TYPE_PERM', 'all');

include_once "../controller/main_controller.php";



$viewDb = "active";

//paramètre de session pour afficher les bon menu lors de la navigation sur les paramètre de compte
$_SESSION[ADMIN] = 0;




if($dbConnected)
{
    if(isset($_POST[DELETE]))
    {
        $cContact = new contact();
        $cContact->deleteALL($connector);
    }
}
$cContact = new contact();
$cContact->load($connector);
$tabUser = $cContact->getResult();
