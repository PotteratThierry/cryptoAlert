<?php
session_start();


include_once "../exceptions/exErrorDB.php";


//appel les interface
include_once "../interface/iDataBase.php";
include_once "../interface/iAccess.php";
include_once "../interface/iPermission.php";

//appel des fichiers de modèle de la base de donnée
include_once "../model/model_db/model_dbConnect.php";
include_once "../model/model_db/model_dbRedis.php";
include_once "../model/model_db/model_dbMysql.php";

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
include_once "../model/model_group.php";

//model des droits utilisateur
include_once "../model/model_permission.php";
include_once "../model/model_accessLevel.php";

//les autres modèle
include_once "../model/model_generalFunction.php";
include_once "../model/model_handleFiles.php";
include_once "../model/model_handleImg.php";
include_once "../model/model_log.php";
include_once "../model/model_param.php";
include_once "../model/model_security.php";
include_once "../model/model_wallet.php";
include_once "../model/model_money.php";
include_once "../model/model_alert.php";



///////////////////////////////////////////////////////////////////
/////////    initialisation des constant et variable  /////////////
///////////////////////////////////////////////////////////////////


//défini les champs de la table contact
define ('TABLE_USER', 'user');
define ('COLUMN_USER_ID', 'id');
define ('COLUMN_USER_MAIL', 'useMail');
define ('COLUMN_USER_PASSWORD', 'usePassword');
define ('COLUMN_USER_LOGIN_NAME', 'useLoginName');
define ('COLUMN_USER_NICK_NAME', 'useNickName');
define ('COLUMN_USER_NAME', 'useName');
define ('COLUMN_USER_LAST_NAME', 'useLastName');
define ('COLUMN_USER_BIRTH_DATE', 'useBirthDate');
define ('COLUMN_USER_WALLET', 'useWallet');
define ('COLUMN_USER_SIGNATURE', 'useSignature');
define ('COLUMN_USER_AVATAR', 'useAvatar');
define ('COLUMN_USER_FILE_NAME', 'useFileName');
define ('COLUMN_USER_STATUS', 'useStatus');
define ('COLUMN_USER_IDX_GROUP', 'idxGroup');
define ('COLUMN_USER_ACTIVATION_KEY', 'useActivationKey');
define ('COLUMN_USER_CREAT_DATE', 'useCreatDate');
define ('COLUMN_USER_RESET_KEY', 'useResetKey');
define ('COLUMN_USER_RESET_DATE', 'useResetDate');


//défini les champs de la table money
define ('TAB_MONEY', 'money');
define ('COLUMN_MONEY_ID', 'id');
define ('COLUMN_MONEY_NAME', 'monName');
define ('COLUMN_MONEY_POW', 'monPow');
define ('COLUMN_MONEY_POS', 'monPos');
define ('COLUMN_MONEY_HEIGHT', 'monHeight');
define ('COLUMN_MONEY_DIFF', 'monDiff');
define ('COLUMN_MONEY_SUPPLY', 'monSupply');
define ('COLUMN_MONEY_TICKER', 'monTicker');
define ('COLUMN_MONEY_CODE', 'monCode');

//défini les champs de la table alert
define ('TABLE_ALERT', 'alert');
define ('COLUMN_ALERT_ID', 'id');
define ('COLUMN_ALERT_USER_ID', 'idUser');
define ('COLUMN_ALERT_CONCERN', 'aleConcern');
define ('COLUMN_ALERT_CONCERN_ID', 'aleConcernId');
define ('COLUMN_ALERT_CONCERN_NAME', 'aleConcernName');
define ('COLUMN_ALERT_VALUE_CONCERN', 'aleConcernValue');
define ('COLUMN_ALERT_OPERATOR', 'aleOperator');
define ('COLUMN_ALERT_VALUE', 'aleValue');
define ('COLUMN_ALERT_TIME_RANGE', 'aleTimeRange');
define ('COLUMN_ALERT_TYPE', 'aleType');
define ('COLUMN_ALERT_STATUS', 'aleStatus');
define ('COLUMN_ALERT_LAST_REFRESH', 'aleLastRefresh');

define ('TABLE_GROUP', 'groupUser');
define ('COLUMN_GROUP_ID', 'id');
define ('COLUMN_GROUP_NAME', 'groName');
define ('COLUMN_GROUP_PERMISSION', 'groPermission');

//défini les champs du tableau de wallet
define ('WALL_NAME', 'wallName');
define ('WALL_KEY', 'wallKey');
define ('WALL_MONEY', 'wallMoney');
define ('WALL_BALANCE', 'wallBalance');
define ('WALL_CODE', 'wallCode');
define ('WALL_LOGO', 'wallLogo');
define ('WALL_VALUE', 'wallValue');

//défini le tableau des type d'alert
define ('CONCERN' , array(0=>'une monnaie',1=>'le sold d\'un wallet',2=>'le sold du compte'));
//défini le tableau des opérateur
define ('OPERATOR' , array(0=>'>',1=>'<',2=>'>=',3=>'<=',4=>'=',5=>'+%',6=>'-%'));
//defini le tableau des interval
define ('TIME_RANGE' , array('+1 hour'=>'1 heure','+6 hour'=>'6 heures','+12 hour'=>'12 heures','+1 day'=>'1 jour','+7 day'=>'1 semaine'));
//defini des type de retour
define ('TYPE' , array(0=>'par Mail',1=>'par notification'));

//défini les paramètres des de selection des tableau
define('CONCERN_MONEY','0');
define('CONCERN_WALLET','1');
define('CONCERN_TOTAL','2');

define('OPERATOR_GREATER','0');
define('OPERATOR_SMALLER','1');
define('OPERATOR_G_EQUAL','2');
define('OPERATOR_S_EQUAL','3');
define('OPERATOR_EQUAL','4');
define('OPERATOR_MORE_PERCENT','5');
define('OPERATOR_LESS_PERCENT','6');

define('TIME_HOUR','+1 hour');
define('TIME_6_HOURS','+6 hour');
define('TIME_12_HOURS','+12 hour');
define('TIME_1_DAY','+1 day');
define('TIME_1_WEEK','+7 day');

define('TYPE_MAIL','0');
define('TYPE_NOTIFICATION','1');

//constante pour l'API des crypto monnaies
define ('API_CRYPTO_COIN', 'coin');
define ('API_CRYPTO_QUERY', 'query');
define ('API_CRYPTO_ADDRESS', 'address');

//constante pour l'API de change de devise
define('API_CHANGE_REQUEST', 'request');
define('API_CHANGE_SEPARATOR', '_');

//constante pour le tabeau pour l'affichage
define ('BALANCE', 'getBalance');
define ('VALUE', 'ticker.usd');

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

define ('REDIS_DB_HOST', 'redisDbHost');
define ('REDIS_DB_PORT', 'redisDbPort');

define ('MYSQL_DB_HOST', 'mySqlDbHost');
define ('MYSQL_DB_USER', 'mySqlDbUser');
define ('MYSQL_DB_PASSWORD', 'mySqlDbPassword');
define ('MYSQL_DB_NAME', 'mySqlDbName');
define ('MYSQL_DB_PORT', 'mySqlDbPort');

//constant pour les rechargement de page
define ('LOCATION', 'Location:');
define ('REFRESH', 'Refresh: 4;');

//constante pour la gestion du profil utilisateur
define ('LOGIN_NAME', "useLoginName");
define ('OLD_LOGIN_NAME', "old_useLoginName");
define ('OLD_MAIL', "oldMail");
define ('NAME', "useName");
define ('LAST_NAME', "useLastName");
define ('NICKNAME', "useNickName");
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
define ('NEW_ALERT', "new_wallet");
define ('MONEY_WALLET', "moneyWallet");
define ('VALID_PLUS', 'validePlus');
define ('VALID_NEW_USER', 'valideNew_user');
define ('USER_DELETE', 'user_delete');
define ('USER_RESET', 'user_reset');
define ('VALID_RESET', 'valide_user_reset');

//constante pour les requête ajax
define ('LOGIN_NAME_AJAX','login_name_ajax');
define ('MAIL_AJAX','mail_ajax');
define ('LOC_AJAX','loc_ajax');
define ('ORIGIN_AJAX','origin_ajax');
define ('A_EDIT_ACCOUNT','/view/a_userEdit.php');
define ('A_FLY_EDIT_ACCOUNT','/view/a_userLst.php');

//contant pour la modification des groupe
define ('GROUP_NAME', "group_name");
define ('NEW_GROUP', "new_group");
define ('NB_GROUP', 'nb_group');
define ('VALID_NEW_GROUP', 'valideNew_group');
define ('GROUP_DELETE', 'group_delete');
define ('GROUP_EDIT', 'group_edit');
define ('VALID_GROUP_EDIT', 'valid_group_edit');
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

define ('ALL_KEY', 0);
define ('MEMBER_KEY', 1);
define ('MODERATOR_KEY', 2);
define ('ADMIN_KEY', 3);

//contant de droits
define ('ALL', "all");
define ('MEMBER', "member");
define ('MODERATOR', "moderator");
define ('ADMIN', "admin");

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

//verification de la langue sélectionnée par l'utilisateur
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
$connectMsg = 0;
$access = 0;
$namePage = "";


//gestion des message d'erreur
$successMsg = "";
$errorMsg = "";
$error = 0;
$success = 0;

$operator = '';

//variable pour l'affichage du fils d'arian
//page du site
$accueil = "";
$creatAccount = "";
$resetPassword = "";
$wallet = "";
$viewDb = "";
$money = "";
$lstWallet = "";
$alert = "";
$majAlert = "";

//page de l'administration
$a = "";
$a_lstGroup = "";
$a_lstUser = "";
$a_settingsGeneral = "";
$a_settingsDb = "";
$a_settingsTemplate = "";
$a_statsAnalytics = "";
$a_statsGeneral = "";
$a_statsLog = "";

//pages des paramètre de compte
$accountMenu = "";
$accountSettings = "";
$accountProfil = "";
$accountAvatar = "";

//variable liée à la base de donnée
$connector = NULL;
$dbConnected = 0;

$successMsg = "";
$errorMsg = "";

///////////////////////////////////////////////////////////////////
//////////        instantiation  des class         ////////////////
///////////////////////////////////////////////////////////////////

//connection à la base de donnée
try
{
    $dbDatabaseType = param::searchParam(INI_PATH, 'MySqlDatabaseType');
    $connector = dbManager::getConnector($dbDatabaseType) ;
    $dbConnected = 1;
}
catch ( Exception $e )
{
    echo "errorMsg =".$e->getMessage() ;
}


$contact = new contact();
$permission = new permission();
$accessLevel = new accessLevel();

///////////////////////////////////////////////////////////////////
//////////        connection à l'application       ////////////////
///////////////////////////////////////////////////////////////////

//lors de la reception d'un formulaire de connection
if (isset($_POST[NAME]) and isset($_POST[CONNECT]))
{
    if($dbConnected != 0)
    {
        $useLoginName = security::html($_POST[NAME]);
        $usePassword = security::html($_POST[PASSWORD]);

        $contact = new contact();
        $contact->setLoginName($useLoginName);
        $contact->setPassword(security::hash($usePassword));
        $contact->connect($connector);

        $contact->getResult();

        //si le compte est désactivé
        if ($contact->getResult() == 2)
        {
            $loginErrorMsg = $lang_errorMsg_disabledAccount;
            $contact->setLoginName('');
            $contact->setConnect(0);
        }
        else
        {
            //si le mots de passe est faut
            if (!$contact->getResult())
            {
                $loginErrorMsg = $lang_errorMsg_connect;
                $contact->setLoginName('');
                $contact->setConnect(0);
            }
            else
            {
                if ($loginErrorMsg == "") {
                    $_SESSION[CONNECT] = 1;
                    $_SESSION[LOGIN_NAME] = $useLoginName;
                    $_SESSION[NICKNAME] = $contact->getNickName();
                }
            }
        }
    }
    else
    {
        $loginErrorMsg = "impossible de se connecter à la base de donnée";
    }
}
//lors de la reception d'un formulaire de déconnections
if (isset($_GET['d'])and NAME_PAGE != 'index.php') {
    session_destroy();
    header(LOCATION . ' ../index.php');
}

//lors de la reception d'un formulaire de changement de langue
if (isset($_POST[LANG])) {
    $_SESSION[LANG] = security::html($_POST[LANG]);
    header(LOCATION . NAME_PAGE);
}

/*//refus d'accès, si la page n'est pas public et que le compte n'a pas accès renvoie à la page d'accueil
if ($access == 0 && TYPE_PERM != 'all') {
    log::ConnectLog(5, 0, NAME_PAGE);
    header(LOCATION . ' ../index.php');
}*/
//lors de l'arrivée sur la page et  si l'utilisateur est connecté

if(isset($_SESSION[CONNECT]))
{
    if ($_SESSION[CONNECT])
    {
        $connectedLoginName = $_SESSION[LOGIN_NAME];

        $contact->setLoginName($connectedLoginName);
        $contact->setConnect($_SESSION[CONNECT]);
        $contact->loadOnceByName($connector);
        $tabUser = $contact->getResult();

        $idGroup = $tabUser[COLUMN_USER_IDX_GROUP];
        $avatar = $tabUser[COLUMN_USER_FILE_NAME].$tabUser[COLUMN_USER_AVATAR];

        //vérifie les accès de l'utilisateur connecté
        $accessLevel->setIdxGroup($idGroup);
        $accessLevel->getUserAccess($connector);

        //vérifie les permission de l'utilisateur connecté
        $permission->setIdxGroup($idGroup);
        $permission->getGroupPermission($connector);

        //si l'utilisateur est désactivé sa le déconnecte et retour page d'acceuil
        if( $tabUser[COLUMN_USER_STATUS] == 0 and NAME_PAGE != 'home.php')
        {
            session_destroy();
            header(LOCATION . ' ../index.php');
        }
        else
        {
            //vérifie si l'utilisateur à accès à la page courante
            if(!$accessLevel->checkPageAccess(TYPE_PERM))
            {
                header(LOCATION . ' ../index.php');
            }
        }
    }
}
if(isset($_COOKIE[MSG_ERROR]))
{
    $errorMsg = $_COOKIE[MSG_ERROR];
    setcookie (MSG_ERROR, "", time() - 60, "/");
    //header(REFRESH.NAME_PAGE);
}
if(isset($_COOKIE[MSG_SUCCESS]))
{
    $successMsg = $_COOKIE[MSG_SUCCESS];
    setcookie (MSG_SUCCESS, "", time() - 60, "/");
    //header(REFRESH.NAME_PAGE);
}
