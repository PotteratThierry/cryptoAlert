<?php
define ('NAME_PAGE', "accountSettings.php");
define ('TYPE_PERM', 'member');


include_once "../controller/main_controller.php";
$accountMenu = "btn-Active";

$oldLoginName = "";

//on vas chercher les infos de l'utilisateur avant modification
$cContact = new contact();
$cContact->setLoginName($_SESSION[LOGIN_NAME]);
$cContact->loadOnceByName($connector);
$tabUser = $cContact->getResult();

$loginName = $tabUser[COLUMN_USER_LOGIN_NAME];
$mail = $tabUser[COLUMN_USER_MAIL];

if (isset($_POST[LOGIN_NAME]))
{
    //récupération des valeurs du formulaire

    $loginName = security::html($_POST[LOGIN_NAME]);
    $oldLoginName = security::html($_POST[OLD_LOGIN_NAME]);
    $mail = security::html($_POST[MAIL]);
    $password = security::html($_POST[PASSWORD]);
    $NewPassword1 = security::html($_POST[NEW_PASSWORD_1]);
    $NewPassword2 = security::html($_POST[NEW_PASSWORD_2]);

    if(!generalFunction::checkMail($mail))
    {
        $errorMsg = $lang_errorMsg_mail;
    }
    //vérifie si le nom de login est pas vide
    if ($loginName == "")
    {
        $errorMsg = $lang_errorMsg_loginName;
    }
    //remet par default l'ancien mots de passe
    $cContact->setPassword($tabUser[COLUMN_USER_PASSWORD]);
    //vérifie que le vieux mot de passe soie juste
    if (security::hash($password) != $tabUser[COLUMN_USER_PASSWORD])
    {
        $errorMsg = $lang_errorMsg_password;
    }
    //vérifie que les deux nouveaux mot de passe ne soie pas vide
    if ($NewPassword1 != "" AND $NewPassword2 != "")
    {
        //vérifie que les deux nouveaux mort de passe correspondent
        if ($NewPassword1 != $NewPassword2)
        {
            $errorMsg = $lang_errorMsg_newPassword;
        }
        //vérifie que le nouveaux mot de passe soie pas identique à l'ancien
        if ($NewPassword1 == $password)
        {
            $errorMsg = $lang_errorMsg_curentPassword;
        }
        //vérifie la complexité du mot de passe);
        if (security::passwordComplexity($NewPassword1))
        {
            $cContact->setPassword($NewPassword1);
        }
        else
        {
            $errorMsg = $lang_errorMsg_passwordComplexity;
        }
    }

    if ($errorMsg == "")
    {

        //prepare les valeurs pour le modify
        $cContact->setIdUser($tabUser[COLUMN_USER_ID]);
        $cContact->setLoginName($loginName);
        $cContact->setMail($mail);
        $cContact->update($connector);

        $cContact->setPassword(security::hash($NewPassword1));
        $cContact->updatePassword($connector);

        $_SESSION[LOGIN_NAME] = $loginName;

        //met le message de success dans un cookie
        $successMsg = $lang_successMsg_update;
    }
    $cContact = new contact();
    $cContact->setLoginName($_SESSION[LOGIN_NAME]);
    $cContact->loadOnceByName($connector);
    $tabUser = $cContact->getResult();

    $loginName = $tabUser[COLUMN_USER_LOGIN_NAME];
    $mail = $tabUser[COLUMN_USER_MAIL];
}

?>