<?php
define ('NAME_PAGE', "createAccount.php");
//page public
define ('TYPE_PERM', 'all');

include_once "../controller/main_controller.php";

define('PATH', param::searchParam(INI_PATH, 'userPath'));


$creatAccount = "active";

$tabUser = array();

//si on arrive à ce connecter à la base de donnée
if($dbConnected)
{
    if(isset($_POST[NEW_USER]) and !isset($_POST[DELETE]))
    {
        //échappement de caractères
        $password1 = security::html($_POST[PASSWORD_1]);
        $password2 = security::html($_POST[PASSWORD_2]);
        $loginName = security::html($_POST[NEW_USER]);
        $mail = security::html($_POST[MAIL]);

        //vérifie si le nom de compte est correct
        if(!generalFunction::checkLoginName($loginName))
        {
            $error = 1;
            $errorMsg .= $lang_errorMsg_loginName."<br>";
        }

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

        $cContact = new contact();
        $cContact->setMail($mail);
        $cContact->loadOnceByMail($connector);
        //vérifie si l'Email existe
        if($cContact->getResult() != array())
        {
            $error = 1;
            $errorMsg .= $lang_errorMsg_existMail."<br>";
        }
        $cContact->setLoginName($loginName);
        $cContact->loadOnceByName($connector);
        //vérifie si le loginName existe
        if($cContact->getResult() != array())
        {
            $error = 1;
            $errorMsg .= $lang_errorMsg_existUser."<br>";
        }
        //si il n'y a pas d'erreur
        if(!$error)
        {
            $date = new DateTime();
            $date = $date->format('Y-m-d H:i:s');
            $activationKey = security::hashPath($mail.$loginName);
            $cContact->setLoginName($loginName);
            $cContact->setMail($mail);
            $cContact->setPassword(security::hash($password1));
            $cContact->setActivationKey($activationKey);
            $cContact->setCreatDate($date);
            $cContact->setKeyWallet($wallet);
            $cContact->save( $connector);

            //crée le dossier utilisateur
            $cContact->loadOnceByName($connector);
            $idUser = $cContact->getResult()[COLUMN_USER_ID];

            $dirName = security::hashPath($idUser);

            //crée les nouveau fichier de l'utilisateur
            handleFiles::createUserDir($dirName);

            //met a jour dans la db
            $cContact->setIdUser($idUser);
            $cContact->setFileName(PATH.$dirName);
            $cContact->uploadFileName($connector);

            //si il n'y a pas d'erreur
            if(!$cContact->getResult())
            {
                $error = 1;
                $errorMsg .= "impossible d'ajouter à la db";

            }
            else
            {
                $mailer = new mailer;
                $mailer->setRecipient($mail);
                $mailer->setRecipientName($loginName);
                $mailer->setSubject('inscription sur le site de crypto alert');

                $mailParser = new mailParser();
                $mailParser->setParam('$loginName',$loginName);
                $mailParser->setParam('$paramName',GET_ACTIVATE);
                $mailParser->setParam('$paramValue',$activationKey);
                $mailParser->setTemplate('../view/mails/createAccount_html.php');
                $contentHtml = $mailParser->insertValue();

                $mailParser = new mailParser();
                $mailParser->setParam('$loginName',$loginName);
                $mailParser->setParam('$paramName',GET_ACTIVATE);
                $mailParser->setParam('$paramValue',$activationKey);
                $mailParser->setTemplate('../view/mails/createAccount_noHtml.php');
                $contentNoHtml = $mailParser->insertValue();


                $mailer->setHtmlMsg(utf8_decode($contentHtml));
                $mailer->setNoHtmlMsg(utf8_decode($contentNoHtml));
                $mailer->mail();

                if($mailer->getResult() == 1)
                {
                    $success = 1;
                    $successMsg .= 'mail envoyé<br>';
                }
                else
                {
                    $error = 1;
                    $errorMsg .= "erreur d'envoie du mail: ".$mailer->getResult()." <br>";
                }

            }
        }
        if (!$error)
        {
            //met le message de success dans un cookie
            $successMsg = $lang_successMsg_update;
            setcookie(MSG_SUCCESS, $successMsg, time()+60, '/');
            header(LOCATION . '../view/'.security::html($_POST[PAGE]));
        }
        if ($error) {
            //met le message d'erreur dans un cookie
            setcookie(MSG_ERROR, $errorMsg, time()+60, '/');
            header(LOCATION . '../view/'.security::html($_POST[PAGE]));
        }
    }
    //si on envoie une donnée get(via mail de confirmation)
    if($_GET)
    {

        if(isset($_GET[GET_ACTIVATE]))
        {

            $activationKey = security::html($_GET[GET_ACTIVATE]);
            $cContact = new contact();
            $cContact->setActivationKey($activationKey);
            $cContact->loadOnceByActivationKey( $connector);

            if($cContact->getResult() != array())
            {

                //crée la date d'expiration
                $date = new DateTime();
                $creatDate = new DateTime($cContact->getResult()[COLUMN_USER_CREAT_DATE]);
                $creatDate = $creatDate->modify('+'.param::searchParam(INI_PATH, P_ACTIVATION_MAIL_EXPIRATION));

                if($creatDate > $date)
                {
                    $cContact->setIdUser($cContact->getResult()[COLUMN_USER_ID]);
                    $cContact->setStatus(1);
                    $cContact->updateStatus( $connector);
                    if($cContact->getResult())
                    {
                        $success = 1;
                        $successMsg .= 'le compte à bien été activé<br>';
                    }
                    else
                    {
                        $error = 1;
                        $errorMsg .= "une erreur est survenue veuillez contacté un administrateur<br>";
                    }
                }

            }
        }
    }
}