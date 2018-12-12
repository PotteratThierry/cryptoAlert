<?php
define ('NAME_PAGE', "admin.php");
//page pour les admin
define ('TYPE_PERM', 'admin');

include_once "../controller/main_controller.php";
$admin = "active";

//paramètre de session pour afficher les bon menu lors de la navigation sur les paramètre de compte
$_SESSION[ADMIN] = 1;
?>