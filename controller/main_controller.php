<?php
session_start();


include_once "../exceptions/exErrorDB.php";


//appel les interface
include_once "../interface/iUser.php";
include_once "../interface/iDataBase.php";

//appel des fichiers de modèle de la base de donnée
include_once "../model/model_db/model_dbConnect.php";
include_once "../model/model_db/model_dbRedis.php";
include_once "../model/model_db/model_dbMysql.php";

include_once "../model/model_db/model_dbGroup.php";
include_once "../model/model_db/model_dbUser.php";

include_once "../model/model_db/model_requestBuilder.php";
include_once "../model/model_db/model_databaseManager.php";

//appel les module pour les mails
include_once '../model/model_mailer.php';
include_once '../model/model_mailParser.php';
include_once '../module/PHPMailer/src/Exception.php';
include_once '../module/PHPMailer/src/PHPMailer.php';
include_once '../module/PHPMailer/src/SMTP.php';

//modèle des contacts
include_once "../model/model_contact.php";

//appel les autres modèle
include_once "../model/model_account.php";
include_once "../model/model_generalFunction.php";
include_once "../model/model_handleFiles.php";
include_once "../model/model_handleImg.php";
include_once "../model/model_log.php";
include_once "../model/model_param.php";
include_once "../model/model_security.php";
include_once "../model/model_wallet.php";
include_once "../model/model_money.php";


///////////////////////////////////////////////////////////////////
/////////    initialisation des constant et variable  /////////////
///////////////////////////////////////////////////////////////////


//défini les champs de la table contact
define ('TABLE_USER', 'user:');
define ('COLUMN_USE_MAIL', 'useMail');
define ('COLUMN_USE_PASSWORD', 'usePassword');
define ('COLUMN_ID', 'id');
define ('COLUMN_USE_LOGIN_NAME', 'useName');
define ('COLUMN_USE_ACTIVATE', 'useActivate');
define ('COLUMN_USE_STATUS', 'useStatus');
define ('COLUMN_USE_ACTIVATION_KEY', 'useActivationKey');
define ('COLUMN_USE_CREAT_DATE', 'useCreatDate');
define ('COLUMN_USE_RESET_KEY', 'useResetKey');
define ('COLUMN_USE_RESET_DATE', 'useResetDate');
define ('COLUMN_USE_WALLET', 'useWallet');

//défini les champs de la table money
define ('TAB_MONEY', 'money:');
define ('COLUMN_ID_MONEY', 'id');
define ('COLUMN_MONEY_NAME', 'moneyName');
define ('COLUMN_MONEY_POW', 'moneyPow');
define ('COLUMN_MONEY_POS', 'moneyPos');
define ('COLUMN_MONEY_HEIGHT', 'moneyHeight');
define ('COLUMN_MONEY_DIFF', 'moneyDiff');
define ('COLUMN_MONEY_SUPPLY', 'moneySupply');
define ('COLUMN_MONEY_TICKER', 'moneyTicker');
define ('COLUMN_MONEY_CODE', 'moneyTicker');

//défini les champs du tableau de wallet
define ('WALL_NAME', 'wallName');
define ('WALL_KEY', 'wallKey');
define ('WALL_MONEY', 'wallMoney');
define ('WALL_BALANCE', 'wallBalance');
define ('WALL_CODE', 'wallCode');
define ('WALL_LOGO', 'wallLogo');
define ('WALL_VALUE', 'wallValue');



//défini le paramètre pour les clef d'activation
define ('GET_ACTIVATE', 'a');
define ('GET_RESET', 'r');


//constant pour le fichier de paramètre
define ('INI_PATH', '../config.ini');
define ('LANG_PATH', '../langage/');
define ('LANG_EXT', '.ini');
define ('LANG_EXT_FILE', '../langage/lang.php');

//contant pour les fichiers de log
define ('DB_LOG_PATH', '../log/dataBase_modification.log');
define ('CONNECT_LOG_PATH', '../log/Connect.log');

//constant pour le changement de langue
define ('LANG', 'lang');
define ('CH_FR', 'ch-fr');
define ('CH_DE', 'ch-de');
define ('CH_IT', 'ch-it');
define ('UK_EN', 'uk-en');

//constant pour la connection
define ('CONNECT', 'connect');
define ('PERMISSION', "groPermission");
define ('DISCONNECT', "disconnect");
define ('PAGE', "page");
define ('ACCESS', 'access');

define ('DB_HOST', 'dbHost');
define ('DB_USER', 'dbUser');
define ('DB_PASSWORD', 'dbPassword');
define ('DB_NAME', 'dbName');
define ('DB_PORT', 'dbport');

//constant pour les rechargement de page
define ('LOCATION', 'Location:');

//constante pour la gestion du profil utilisateur
define ('LOGIN_NAME', "useLoginName");
define ('OLD_MAIL', "oldMail");
define ('NAME', "useName");
define ('LAST_NAME', "useLastName");
define ('PASSWORD', "usePassword");
define ('BIRTH_DATE', "useBirthDate");
define ('MAIL', "useMail");
define ('ID_GROUP', "idGroup");
define ('STATUS', "usrStatus");

//constant pour la gestion des images de l'utilisateur
define ('SIGNATURE', "useSignature");
define ('AVATAR', "useAvatar");
define ('DELETE_SIGNATURE', "delete_signature");
define ('DELETE_AVATAR', "delete_avatar");
define ('AVATAR_NAME', "name");
define ('SIGNATURE_NAME', "signature_name");
define ('IMG_NAME', "name");
define ('IMG_TMP_NAME', "tmp_name");
define ('ERROR', "error");
define ('SIZE', "size");

//constant pour le cookie de getion de message de success
define ('MSG_SUCCESS', "msg_success");
define ('MSG_SUCCESS_AVATAR', "successAvatar");
define ('MSG_SUCCESS_SIGNATURE', "successSignature");
define ('MSG_ERROR', "msg_error");

//contant pour les de mot de passe
define ('NEW_PASSWORD_1', "useNewPassword1");
define ('NEW_PASSWORD_2', "useNewPassword2");
define ('PASSWORD_1', "usePassword1");
define ('PASSWORD_2', "usePassword2");

//contant pour la modification des utilisateurs
define ('VALID', 'valide');
define ('PLUS', "plus");
define ('NB_USER', 'nb_user');
define ('NEW_USER', "new_user");
define ('NEW_WALLET', "new_wallet");
define ('MONEY_WALLET', "moneyWallet");
define ('VALID_PLUS', 'validePlus');
define ('VALID_NEW_USER', 'valideNew_user');
define ('USER_DELETE', 'user_delete');
define ('USER_RESET', 'user_reset');
define ('VALID_RESET', 'valide_user_reset');

//constante pour les requête ajax
define ('LOGIN_NAME_AJAX','login_name_ajax');
define ('MAIL_AJAX','mail_ajax');

//contant pour la modification des groupe
define ('GROUP_NAME', "group_name");
define ('NEW_GROUP', "new_group");
define ('NB_GROUP', 'nb_group');
define ('VALID_NEW_GROUP', 'valideNew_group');
define ('GROUP_DELETE', 'group_delete');
define ('GROUP_CHANGE', 'group_change');
define ('ID_NEW_GROUP', 'id_new_group');

//constante de nom pour les paramètres
define ('P_DEFAULT_PASSWORD', "defaultPassword");
define ('P_ACTIVATION_MAIL_EXPIRATION', "activationMailExpiration");
define ('P_RESET_MAIL_EXPIRATION', "resetMailExpiration");
define ('P_DEFAULT_LANG', "defaultLangage");
define ('P_DEFAULT_GROUP', "defaultGroup");
define ('P_MAX_WEIGHT', "maxWeight");
define ('P_SIGNATURE_MAX_HEIGHT', "maxHeight_signature");
define ('P_SIGNATURE_MAX_WIDTH', "maxWidth_signature");
define ('P_SIGNATURE_PATH', "signature_path");
define ('P_SIGNATURE_NO_IMAGE', "defaultSignature");
define ('P_SIGNATURE_NEW_NO_IMAGE', "NewDefaultSignature");

define ('P_AVATAR_MAX_HEIGHT', "maxHeight_avatar");
define ('P_AVATAR_MAX_WIDTH', "maxWidth_avatar");
define ('P_AVATAR_PATH', "avatar_path");
define ('P_AVATAR_NO_IMAGE', "defaultAvatar");
define ('P_AVATAR_NEW_NO_IMAGE', "NewDefaultAvatar");

define ('P_LST_EXT', "lst_ext");
define ('P_EXT', "ext");
define ('P_LST_IE_EXT', "lst_ext_ie");
define ('NB_EXT', "nb_ext");

//contant de droits
define ('ALL', "all");
define ('MEMBER', "member");
define ('MODERATOR', "moderator");
define ('ADMIN', "admin");

define ('ALL_KEY', 0);
define ('MEMBER_KEY', 1);
define ('MODERATOR_KEY', 2);
define ('ADMIN_KEY', 3);

define ('ADD', "add");
define ('DELETE', "delete");
define ('EDIT', "edit");

define ('EDIT_GROUP', "edit_group");
define ('ADD_GROUP', "add_group");
define ('DELETE_GROUP', "delete_group");

define ('EDIT_USER', "edit_user");
define ('ADD_USER', "add_user");
define ('DELETE_USER', "delete_user");

//champs pour les log
define ('LOG_DB', 'db');
define ('LOG_CONNEXION', 'connexion');
define ('LOG_CONTENT', 'content');
define ('LOG_DB_USER', 'dbUser');
define ('LOG_DB_GROUP', 'dbGroup');

define ('LOG_USER_MODIFY', 'user_modify');
define ('LOG_USER_MODIFY_STATUS', 'user_modifyStatus');
define ('LOG_USER_MODIFY_SETTINGS', 'modifySettings');
define ('LOG_USER_MODIFY_PROFIL', 'modifyProfil');
define ('LOG_USER_MODIFY_SIGNATURE', 'modifySignature');
define ('LOG_USER_MODIFY_AVATAR', 'modifyAvatar');
define ('LOG_USER_MODIFY_GROUP', 'modifyGroup');
define ('LOG_USER_MODIFY_ALL_GROUP', 'modifyALLGroup');
define ('LOG_USER_CREATE', 'user_create');
define ('LOG_USER_DELETE', 'user_delete');

define ('LOG_GROUP_MODIFY', 'group_modify');
define ('LOG_GROUP_CREATE', 'group_create');
define ('LOG_GROUP_DELETE', 'group_delete');



$defaultLangage = param::searchParam(INI_PATH, 'defaultLangage');
$defaultCurrency = param::searchParam(INI_PATH, 'defaultCurrency');
$defaultApiCurrency = param::searchParam(INI_PATH, 'defaultApiCurrency');
//verification de la langue séléctionée par l'utilisateur
//sinon on met la langue par default


if (isset($_SESSION[LANG])) {
    $lang = $_SESSION[LANG];
} else {
    $lang = $defaultLangage;
}

//récupère les donnée des fichirs de langues
include_once LANG_EXT_FILE;


//configuration des erreurs de connection
$loginErrorMsg = "";
$connect = 0;
$access = 0;

//variable pour l'affichage du fils d'arian
//page du site
$accueil = "";
$creatAccount = "";
$resetPassword = "";
$wallet = "";
$viewDb = "";
$money = "";
$lstWallet = "";

//page de l'administration
$admin = "";
$AccountManagement = "";
$AppSettings = "";
$AppStats = "";
//pages des paramètre de compte
$accountMenu = "";
$accountSettings = "";
$accountProfil = "";
$accountAvatar = "";

//variable liée à la base de donnée
$connector = NULL;
$dbConnected = 0;
$userConnect = new contact();

///////////////////////////////////////////////////////////////////
//////////        instantiation  des class         ////////////////
///////////////////////////////////////////////////////////////////

//class de connection à une DB
$pdo = new dbConnect();
$pdo = $pdo->connect();

try
{
    $connector = dbManager::getConnector(param::searchParam(INI_PATH, 'databaseType')) ;
    $dbConnected = 1;
}
catch ( Exception $e )
{
    echo "errorMsg =".$e->getMessage() ;
}

//class de la table utilisateur
$dbUser = new dbUser();
$dbUser->setPdo($pdo);

$dbGroup = new dbGroup();
$dbGroup->setPdo($pdo);

//classe des interaction avec les compte utilisateur
$account = new account();
$account->setDbUser($dbUser);
$account->setDbGroup($dbGroup);


///////////////////////////////////////////////////////////////////
//////////        connection à l'application       ////////////////
///////////////////////////////////////////////////////////////////

//lors de l'arrivée sur la page
if(isset($_SESSION[CONNECT]) and  $_SESSION[CONNECT] != 0)
{
    $userConnect->setConnect($_SESSION[CONNECT]);
    $userConnect->setLoginName($_SESSION[LOGIN_NAME]);
}
//lors de la reception d'un formulaire de connection
if (isset($_POST[NAME]) and isset($_POST[CONNECT])) {

    $useLoginName = security::html($_POST[NAME]);
    $usePassword = security::html($_POST[PASSWORD]);

    $userConnect = new contact();
    $userConnect->setLoginName($useLoginName);
    $userConnect->setPassword(security::hash($usePassword));
    $userConnect->connect($connector);

    $userConnect->getResult();

    //si le compte est désactivé
    if( $userConnect->getResult() == 2)
    {
        $loginErrorMsg = $lang_errorMsg_disabledAccount;
        $userConnect->setLoginName('');
        $userConnect->setConnect(0);
    }
    else
    {
        //si le mots de passe est faut
        if(!$userConnect->getResult())
        {
            $loginErrorMsg = $lang_errorMsg_connect;
            $userConnect->setLoginName('');
            $userConnect->setConnect(0);
        }
        else
        {
            if($loginErrorMsg == "")
            {
                $_SESSION[CONNECT] = 1;
                $_SESSION[LOGIN_NAME] = $useLoginName;
            }
        }
    }


}
//lors de la reception d'un formulaire de changement de langue
if (isset($_POST[LANG])) {
    $_SESSION[LANG] = security::html($_POST[LANG]);
    header(LOCATION . NAME_PAGE);
}
//lors de la reception d'un formulaire de déconnections
if (isset($_POST[DISCONNECT])) {
    $userConnect->setConnect(0);
    session_destroy();
    header(LOCATION . ' ../index.php');
}
//si il est connecté
if ($userConnect->getConnect()) {
    $useLoginName = $userConnect->getLoginName();
}
//refus d'accès
//si la page n'est pas public et que le compte n'a pas accès renvoie à la page d'accueil
if ($access == 0 && TYPE_PERM != 'all') {
    log::ConnectLog(5, 0, NAME_PAGE);
    header(LOCATION . ' ../index.php');
}
//vérifie si le compte à accès aux éléments accessible au admin
$account->setTypePerm(ADMIN);
$account->permission();
$adminAccess = $account->getAccess();
//vérifie si le compte à accès aux éléments accessible au modérateur
$account->setTypePerm(MODERATOR);
$account->permission();
$moderatorAccess = $account->getAccess();
//vérifie si le compte à accès aux éléments accessible au membres
$account->setTypePerm(MEMBER);
$account->permission();
$memberAccess = $account->getAccess();


?>