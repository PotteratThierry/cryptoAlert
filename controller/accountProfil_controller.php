<?php
define ('NAME_PAGE', "accountProfil.php");
//page limitée au membres
define ('TYPE_PERM', 'member');

include_once "../controller/main_controller.php";
$accountMenu = "btn-Active";

if (isset($_POST[NAME])) {
    //on vas chercher les infos de l'utilisateur avant modification
    $dbUser->setUseMail($_SESSION[MAIL]);
    $dbUser->getMail();
    $UserInfo = $dbUser->getResult();

    $name = security::html($_POST[NAME]);
    $nickname = security::html($_POST[NICKNAME]);
    $lastName = security::html($_POST[LAST_NAME]);
    $birthDate = security::html($_POST[BIRTH_DATE]);

    if ($birthDate != "") {
        if (generalFunction::checkDate($birthDate)) {
            $dbUser->setIdUser($UserInfo[0]->getIdUser());
            $dbUser->setUseNickname($nickname);
            $dbUser->setUseName($name);
            $dbUser->setUseLastName($lastName);
            $dbUser->setUseBirthDate($birthDate);
            //mise à jour dans la DB
            $dbUser->modifyProfil();

            //mise à jour dans la session
            $_SESSION[NICKNAME] = $nickname;
        } else {
            $errorMsg = $lang_errorMsg_date;
        }
    } else {
        $errorMsg = $lang_errorMsg_date;
    }
    if ($errorMsg == "") {
        //met le message de success dans un cookie
        setcookie(MSG_SUCCESS, $lang_successMsg_update);
        //faits une redirection automatique afin d'eviter la conservation des information du formulaire après validation
        header(LOCATION . NAME_PAGE);
    }
} else {
    //vérifie si un message doit être affichée et ensuite détruit le cookie
    if (isset($_COOKIE[MSG_SUCCESS])) {
        $successMsg = $_COOKIE[MSG_SUCCESS];
        setcookie(MSG_SUCCESS, NULL, -1);
    }
    //configuration des champs rempli automatiquement dans le formulaire
    $dbUser->setUseMail($_SESSION[MAIL]);
    $dbUser->getMail();
    $UserInfo = $dbUser->getResult();
    $name = security::html($UserInfo[0]->getUseName());
    $nickname = security::html($UserInfo[0]->getUseNickname());
    $lastName = security::html($UserInfo[0]->getUseLastName());
    $birthDate = security::html($UserInfo[0]->getUseBirthDate());
}

?>