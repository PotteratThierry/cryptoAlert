<?php
define ('NAME_PAGE', "adminSettingsDb.php");
//page pour les admin
define ('TYPE_PERM', 'admin');

include_once "../controller/main_controller.php";

$AppSettings = "active";


if (isset($_POST[VALID])) {
    //recuperation du fichier de paramètre
    $tab = param::recoveryParam(INI_PATH);

    //changement des paramètres
    $tab[DB_HOST] = security::html($_POST[DB_HOST]) . ':' . security::html($_POST[DB_PORT]);
    $tab[DB_USER] = security::html($_POST[DB_USER]);
    $tab[DB_PASSWORD] = security::html($_POST[DB_PASSWORD]);
    $tab[DB_NAME] = security::html($_POST[DB_NAME]);

    //sauvegarde des nouveau paramètres
    param::saveParam($tab, INI_PATH);
}

$p_dbHost = $debut = strtok(param::searchParam(INI_PATH, DB_HOST), ':');
$p_dbPort = substr(strrchr(param::searchParam(INI_PATH, DB_HOST), ":"), 1);
$p_dbUser = param::searchParam(INI_PATH, DB_USER);
$p_dbPassword = param::searchParam(INI_PATH, DB_PASSWORD);
$p_dbName = param::searchParam(INI_PATH, DB_NAME);
?>