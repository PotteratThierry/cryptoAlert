<?php
define ('NAME_PAGE', "adminSettingsGeneral.php");
//page pour les admin
define ('TYPE_PERM', 'admin');

define ('COMMENT', ';');
define ('LST_EXT', 'lst_ext');
define ('LST_IE_EXT', 'lst_ext_ie');
define ('EXT', 'ext_');
define ('BMP', '[bmp]');

include_once "../controller/main_controller.php";

$AppSettings = "active";
$ok = 0;

//recherche des exertion MMe et des nom des formats
$tab_ext = array();


//recuperation du fichier de paramètre
$tab = param::recoveryParam(INI_PATH);

if (isset($_POST[VALID])) {
    $i = 0;
    $j = 0;
    $l = 0;
    //création de clef qui serrons utilisée pour l'insertion
    foreach ($tab as $key => $value) {
        if (substr($key, 0, 7) == LST_EXT && substr($key, 0, 10) != LST_IE_EXT) {
            $tabKey_lstExt[$i] = $key;
            $i++;
        }
        if (substr($key, 0, 4) == EXT) {
            $tabKey_ext[$l] = $key;
            $l++;
        }
        if (substr($key, 0, 10) == LST_IE_EXT) {
            $tabKey_ie_ext[$j] = $key;
            $j++;
        }
    }
    if (isset($_POST[P_DEFAULT_PASSWORD]) && isset($_POST[P_DEFAULT_GROUP])) {
        $defaultPassWord = security::html($_POST[P_DEFAULT_PASSWORD]);
        $defaultGroup = security::html($_POST[P_DEFAULT_GROUP]);

        //changement des paramètres
        $tab[P_DEFAULT_GROUP] = $defaultGroup;
        $tab[P_DEFAULT_PASSWORD] = $defaultPassWord;

    }
    if (isset($_POST[P_DEFAULT_LANG])) {
        $defaultLang = security::html($_POST[P_DEFAULT_LANG]);

        //changement des paramètres
        $tab[P_DEFAULT_LANG] = $defaultLang;
    }
    $k = 0;
    $j = 0;
    $nbExt = $_POST[NB_EXT];
    while ($k < $nbExt) {
        if (isset($_POST[P_EXT . $k]) && isset($_POST[P_LST_EXT . $k]) && $_POST[P_EXT . $k] != "" && $_POST[P_LST_EXT . $k] = "") {
            if (isset($tabKey_ie_ext[$k])) {
                $tab[$tabKey_ie_ext[$j]] = $_POST[P_LST_IE_EXT . $k];
            }
            $tab[$tabKey_lstExt[$j]] = security::html($_POST[P_LST_EXT . $k]);
            $tab[$tabKey_ext[$j]] = security::html($_POST[P_EXT . $k]);
            $j++;
        } else {

        }
        $k++;
    }
//sauvegarde des nouveau paramètres
    param::saveParam($tab, INI_PATH);

}
$i = 0;
$j = 0;
$l = 0;


$dbGroup->getAll();
$tabGroup = $dbGroup->getResult();

$tab_lstExt = param::searchParam(INI_PATH, 'lst_ext');
$nbExt = count($tab_lstExt);
$defaultPassWord = param::searchParam(INI_PATH, P_DEFAULT_PASSWORD);
$defaultLangage = param::searchParam(INI_PATH, P_DEFAULT_LANG);
$defaultGroup = param::searchParam(INI_PATH, P_DEFAULT_GROUP);
$imageMaxWeight = generalFunction::numberFormat(param::searchParam(INI_PATH, P_MAX_WEIGHT));

$signatureMaxHeight = generalFunction::numberFormat(param::searchParam(INI_PATH, P_SIGNATURE_MAX_HEIGHT));
$signatureMaxWidth = generalFunction::numberFormat(param::searchParam(INI_PATH, P_SIGNATURE_MAX_WIDTH));
$signaturePath = substr(param::searchParam(INI_PATH, P_SIGNATURE_PATH), 1, -1);
$signatureNoImagePrint = param::searchParam(INI_PATH, P_SIGNATURE_NO_IMAGE);
$signatureNoImage = substr(param::searchParam(INI_PATH, P_SIGNATURE_NO_IMAGE), 3);

$avatarMaxHeight = generalFunction::numberFormat(param::searchParam(INI_PATH, P_AVATAR_MAX_HEIGHT));
$avatarMaxWidth = generalFunction::numberFormat(param::searchParam(INI_PATH, P_AVATAR_MAX_WIDTH));
$avatarPath = substr(param::searchParam(INI_PATH, P_AVATAR_PATH), 1, -1);
$avatarNoImagePrint = param::searchParam(INI_PATH, P_AVATAR_NO_IMAGE);
$avatarNoImage = substr(param::searchParam(INI_PATH, P_AVATAR_NO_IMAGE), 3);

?>