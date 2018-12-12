<?php
define ('NAME_PAGE', "adminStatsLog.php");
//page pour les admin
define ('TYPE_PERM', 'admin');

include_once "../controller/main_controller.php";

$AppStats = "active";

$db = 0;
$connexion = 0;
$content = 0;
$log_tab = array();

if (isset($_POST[LOG_DB])) {
    $db = 1;
    //recuperation du fichier de paramètre
    $tab = log::recoveryLog(DB_LOG_PATH);
    $tab = array_reverse($tab);
    foreach ($tab as $key => $value) {
        $value = explode(']', $value);


        $log_tab[$key][0] = substr(strstr($value[0], '['), 1);
        $log_tab[$key][1] = substr(strstr($value[1], '['), 1);
        $log_tab[$key][2] = substr(strstr($value[2], '['), 1);
        $log_tab[$key][3] = trim($value[3]);
    }
}
if (isset($_POST[LOG_CONNEXION])) {
    $connexion = 1;
    //recuperation du fichier de paramètre
    $tab = log::recoveryLog(CONNECT_LOG_PATH);
    $tab = array_reverse($tab);
    foreach ($tab as $key => $value) {
        $value = explode(']', $value);

        $log_tab[$key][0] = substr(strstr($value[0], '['), 1);
        $log_tab[$key][1] = substr(strstr($value[1], '['), 1);
        $log_tab[$key][2] = substr(strstr($value[2], '['), 1);
        $log_tab[$key][3] = trim($value[3]);
    }
}
if (isset($_POST[LOG_CONTENT])) {
    $content = 1;
}
?>