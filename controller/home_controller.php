<?php
define ('NAME_PAGE', "home.php");
//page public
define ('TYPE_PERM', 'all');

include_once "../controller/main_controller.php";



$accueil = "active";

//paramètre de session pour afficher les bon menu lors de la navigation sur les paramètre de compte
$_SESSION[ADMIN] = 0;

