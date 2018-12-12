<?php
define ('NAME_PAGE', "createAccount.php");
//page public
define ('TYPE_PERM', 'all');

include_once "../controller/main_controller.php";



$creatAccount = "active";

//paramètre de session pour afficher les bon menu lors de la navigation sur les paramètre de compte
$_SESSION[ADMIN] = 0;

$successMsg = "";
$errorMsg = "";
$error = 0;
$success = 0;
$tabUser = array();

//si on arrive à ce connecter à la base de donnée
if($dbConnected)
{
    if(isset($_POST[LOGIN_NAME_AJAX]))
    {
        $loginName = security::html($_POST[LOGIN_NAME_AJAX]);
        if($loginName != "")
        {
            $contact = new contact();
            $contact->setLoginName($loginName);
            $contact->loginNameExist($connector);
            //vérifie si le loginName existe
            if($contact->getResult() != array())
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }
    }
    if(isset($_POST[MAIL_AJAX]))
    {
        $mail = security::html($_POST[MAIL_AJAX]);
        if($mail != "")
        {
            //vérifie si le mail a le bon format
            if(generalFunction::checkMail($mail))
            {
                $contact = new contact();
                $contact->setMail($mail);
                $contact->mailExist($connector);
                //vérifie si le mail existe
                if($contact->getResult() != array())
                {
                    echo "1";
                }
                else
                {
                    echo "0";
                }
            }
        }
    }
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

        $contact = new contact();
        $contact->setMail($mail);
        $contact->mailExist($connector);
        //vérifie si l'Email existe
        if($contact->getResult() != array())
        {
            $error = 1;
            $errorMsg .= $lang_errorMsg_existMail."<br>";
        }
        $contact->setLoginName($loginName);
        $contact->loginNameExist($connector);
        //vérifie si le loginName existe
        if($contact->getResult() != array())
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
            $contact->setLoginName($loginName);
            $contact->setMail($mail);
            $contact->setPassword(security::hash($password1));
            $contact->setActivationKey($activationKey);
            $contact->setCreatDate($date);
            $contact->setWallet($wallet);
            $contact->save( $connector);
            //si il n'y a pas d'erreur
            if($contact->getResult())
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


                echo $mailer->getResult();
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
    }
//si on envoie une donnée get(via mail de confirmation)
    if($_GET)
    {

        if(isset($_GET[GET_ACTIVATE]))
        {

            $activationKey = security::html($_GET[GET_ACTIVATE]);
            $contact = new contact();
            $contact->setActivationKey($activationKey);
            $contact->loadOnceByActivationKey( $connector);

            if($contact->getResult() != array())
            {

                //crée la date d'expiration
                $date = new DateTime();
                $creatDate = new DateTime($contact->getResult()[COLUMN_USE_CREAT_DATE]);
                $creatDate = $creatDate->modify('+'.param::searchParam(INI_PATH, P_ACTIVATION_MAIL_EXPIRATION));

                if($creatDate > $date)
                {
                    $contact->setIdUser($contact->getResult()[COLUMN_ID]);
                    $contact->setStatus(1);
                    $contact->updateStatus( $connector);
                    if($contact->getResult())
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