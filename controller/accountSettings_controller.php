<?php
define ('NAME_PAGE', "accountSettings.php");
define ('TYPE_PERM', 'member');


include_once "../controller/main_controller.php";
$accountMenu = "btn-Active";

$errorMsg = "";
$successMsg = "";

if (isset($_POST[MAIL])) {
    //récupération des valeurs du formulaire
    $password = security::html($_POST[PASSWORD]);
    $mail = security::html($_POST[MAIL]);
    $oldMail = security::html($_POST[OLD_MAIL]);
    $NewPassword1 = security::html($_POST[NEW_PASSWORD_1]);
    $NewPassword2 = security::html($_POST[NEW_PASSWORD_2]);

    //on vas chercher les infos de l'utilisateur avant modification
    $dbUser->setUseMail($_SESSION[MAIL]);
    $dbUser->getMail();
    $UserInfo = $dbUser->getResult();

    //verification de l'adresse mail'
    if (!generalFunction::checkMail($mail)) {
        $errorMsg = $lang_errorMsg_mail;
    } else {
        //remet par defaut l'ancien mots de passe
        $dbUser->setUsePassword($UserInfo[0]->getUsePassword());
        //verifie que le vieux mot de passe soie juste
        if (security::hash($password) == $UserInfo[0]->getUsePassword()) {
            //verifie que les deux nouveaux mot de passe ne soie pas vide
            if ($NewPassword1 != "" && $NewPassword2 != "") {
                //verifie que les deux nouveaux mort de passe corresponent
                if ($NewPassword1 == $NewPassword2) {
                    //verifie que le nouveaux mot de passe soie pas identique à l'ancien
                    if ($NewPassword1 != $password) {
                        //verifie la complexité du mot de passe);
                        if (security::passwordComplexity($NewPassword1))
                        {
                            $dbUser->setUsePassword(security::hash($NewPassword1));
                        }
                        else
                        {
                            $errorMsg = $lang_errorMsg_passwordComplexity;
                        }
                    } else {
                        $errorMsg = $lang_errorMsg_curentPassword;
                    }
                } else {
                    $errorMsg = $lang_errorMsg_newPassword;
                }
            } else {
                //en cas d'absence de nouveau mot de passe on remet l'ancien
                $dbUser->setUsePassword(security::hash($password));
            }
        } else {
            $errorMsg = $lang_errorMsg_password;
        }
    }

    if ($errorMsg == "") {
        //mise à jours de la session
        $_SESSION[MAIL] = $mail;

        //prepare les valeurs pour le modify
        $dbUser->setIdUser($UserInfo[0]->getIdUser());
        $dbUser->setUseMail($mail);
        $dbUser->modifySettings();
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
    $mail = security::html($_SESSION[MAIL]);
}

?>