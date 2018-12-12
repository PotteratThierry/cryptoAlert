<?php
define ('NAME_PAGE', "resetPassword.php");
//page public
define ('TYPE_PERM', 'all');

include_once "../controller/main_controller.php";



$resetPassword = "active";

//paramètre de session pour afficher les bon menu lors de la navigation sur les paramètre de compte
$_SESSION[ADMIN] = 0;

$successMsg = "";
$errorMsg = "";
$error = 0;
$success = 0;
$tabUser = array();
$resetPage = 0;

$useId = NULL;

//si on arrive à ce connecter à la base de donnée
if($dbConnected)
{
    if(isset($_POST[USER_RESET]))
    {

        $loginName =  security::html($_POST[USER_RESET]);

        $contact = new contact();
        $contact->setLoginName($loginName);
        $contact->loginNameExist($connector);

        //vérifie si le loginName existe
        if($contact->getResult() != array())
        {
            $mail =  $contact->getResult()[COLUMN_USE_MAIL];

            $date = new datetime();
            $date = $date->format('Y-m-d H:i:s');

            $resetKey = security::hashPath($mail.$loginName.$date);

            //met la clef d'activation dans la base de donnée
            $contact->setResetKey($resetKey);
            $contact->setResetDate($date);
            $contact->updateResetKey( $connector);

            $mailer = new mailer;
            $mailer->setRecipient($mail);
            $mailer->setRecipientName($loginName);
            $mailer->setSubject('Reinitialisation du mot de passe');

            $mailParser = new mailParser();
            $mailParser->setParam('$loginName',$loginName);
            $mailParser->setParam('$paramName',GET_RESET);
            $mailParser->setParam('$paramValue',$resetKey);
            $mailParser->setTemplate('../view/mails/resetPassword_html.php');
            $contentHtml = $mailParser->insertValue();

            $mailParser = new mailParser();
            $mailParser->setParam('$loginName',$loginName);
            $mailParser->setParam('$paramName',GET_RESET);
            $mailParser->setParam('$paramValue',$resetKey);
            $mailParser->setTemplate('../view/mails/resetPassword_noHtml.php');
            $contentNoHtml = $mailParser->insertValue();

            $mailer->setHtmlMsg(utf8_decode($contentHtml));
            $mailer->setNoHtmlMsg(utf8_decode($contentNoHtml));
            $mailer->mail();

            $success = 1;
            $successMsg .= $lang_successMsg_resetMailSend;
        }
        else
        {
            $error = 1;
            $errorMsg .= $lang_errorMsg_existUser."<br>";
        }

    }
    if($_GET) {

        if (isset($_GET[GET_RESET]))
        {
            $resetKey = security::html($_GET[GET_RESET]);
            $contact = new contact();
            $contact->setResetKey($resetKey);
            $contact->loadOnceByResetKey( $connector);

            if($contact->getResult() != array())
            {
                //crée la date d'expiration
                $date = new DateTime();
                $creatDate = new DateTime($contact->getResult()[COLUMN_USE_CREAT_DATE]);
                $creatDate = $creatDate->modify('+'.param::searchParam(INI_PATH, P_RESET_MAIL_EXPIRATION));

                if($creatDate > $date)
                {
                    $resetPage = 1;
                    $useId = $contact->getResult()[COLUMN_ID];
                }

            }
        }
    }
    if(isset($_POST[VALID_RESET]))
    {
        $password1 = security::html($_POST[PASSWORD_1]);
        $password2 = security::html($_POST[PASSWORD_2]);
        $useId = security::html($_POST[VALID_RESET]);

        //récupère les infos de l'utilisateur
        $contact = new contact();
        $contact->setIdUser($useId);
        $contact->loadOnceById($connector);

        $tabUser = $contact->getResult();
        $mail = $tabUser[COLUMN_USE_MAIL];
        $loginName = $tabUser[COLUMN_USE_LOGIN_NAME];
        $resetDate = $tabUser[COLUMN_USE_RESET_DATE];

        $resetDate = new DateTime($resetDate);
        $resetDate = $resetDate->format('d-m-Y à H:i:s');

        //vérifie si l'adresse mail est correct
        if(!generalFunction::checkMail($mail))
        {
            $error = 1;
            $errorMsg .= $lang_errorMsg_mail."<br>";
        }

        //vérifie si les 2 mots de passe son identique
        if($password1 === $password2)
        {
            //vérifie la complexité du mots de passe
            if(!security::passwordComplexity($_POST[PASSWORD_1]))
            {
                $error = 1;
                $errorMsg .= $lang_errorMsg_passwordComplexity."<br>";
            }
        }
        else
        {
            $error = 1;
            $errorMsg .= $lang_errorMsg_password."<br>";
        }
        $contact = new contact();
        $contact->setMail($mail);
        $contact->mailExist($connector);
        //vérifie si l'Email existe
        if($contact->getResult() == array())
        {
            $error = 1;
            $errorMsg .= $lang_errorMsg_mail."<br>";
        }
        //si il n'y a pas d'erreur
        if(!$error)
        {
            $contact->setPassword(security::hash($password1));
            $contact->updatePassword($connector);

            $mailer = new mailer;
            $mailer->setRecipient($mail);
            $mailer->setRecipientName($loginName);
            $mailer->setSubject('Confirmation de reinitialisation de mots de passe');

            $mailParser = new mailParser();
            $mailParser->setParam('$loginName',$loginName);
            $mailParser->setParam('$resetDate',$resetDate);
            $mailParser->setTemplate('../view/mails/resetPasswordConfirmation_html.php');
            $contentHtml = $mailParser->insertValue();

            $mailParser = new mailParser();
            $mailParser->setParam('$loginName',$loginName);
            $mailParser->setParam('$resetDate',$resetDate);
            $mailParser->setTemplate('../view/mails/resetPasswordConfirmation_noHtml.php');
            $contentNoHtml = $mailParser->insertValue();

            $mailer->setHtmlMsg(utf8_decode($contentHtml));
            $mailer->setNoHtmlMsg(utf8_decode($contentNoHtml));
            $mailer->mail();

            $success = 1;
            $successMsg .= $lang_successMsg_resetPassword;
        }
    }

}