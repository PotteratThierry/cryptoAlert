<?php
define ('NAME_PAGE', "adminAccountUser.php");
//page pour les admin
define ('TYPE_PERM', 'admin');

include_once "../controller/main_controller.php";

$AccountManagement = "active";

$add = 0;
$plus = 0;
$disabled = "";
//à changer lors de la mise en place des fichier de paramètres
$defaultPassWord = param::searchParam(INI_PATH, 'defaultPassword');
$defaultGroup = param::searchParam(INI_PATH, P_DEFAULT_GROUP);
$userFile = param::searchParam(INI_PATH, 'userPath');

//vérifie si le compte peut ajouter des utilisateur
$account->setTypePerm(ADD_USER);
$account->permission();
$new_user = $account->getAccess();

//vérifie si le compte peut modifier des utilisateurs
$account->setTypePerm(EDIT_USER);
$account->permission();
$edit_user = $account->getAccess();

//vérifie si le compte peut supprimer des utilisateurs
$account->setTypePerm(DELETE_USER);
$account->permission();
$delete_user = $account->getAccess();
$userConnected = $_SESSION[MAIL];
//desactive les champs du formulaire
if (!$edit_user) {
    $disabled = "disabled";
}
//pour l'ajout d'un utilisateur
if (isset($_POST[NEW_USER]) && $new_user) {
    $add = 1;
    $nickname = "";
    $name = "";
    $lastName = "";
    $mail = "";
}
//pour la validation de l'ajout d'un utilisateur
if (isset($_POST[VALID_NEW_USER]) && $new_user)
{
    $nickname = security::html($_POST[NICKNAME]);
    $name = security::html($_POST[NAME]);
    $lastName = security::html($_POST[LAST_NAME]);
    $mail = security::html($_POST[MAIL]);

    //verification du mail
    if (generalFunction::checkMail($mail)) {
        //vérifie que le pusdo  n'est pas déjà utilisé
        $dbUser->setUseNickname($nickname);
        $dbUser->getNickname();
        $tmp_nickname = $dbUser->getResult();
        if (!isset($tmp_nickname[0])) {
            //vérifie que le mail n'est pas deja utilisé
            $dbUser->setUseMail($mail);
            $dbUser->getMail();
            $tmp_mail = $dbUser->getResult();
            if (!isset($tmp_mail[0])) {
                //recherche du groupe par default
                $dbGroup->setGroName($defaultGroup);
                $dbGroup->getName();
                $defaultGroup = $dbGroup->getResult();

                //prepare les valeurs pour le creat
                $dbUser->setUseNickname($nickname);
                $dbUser->setUseName($name);
                $dbUser->setUseLastName($lastName);
                $dbUser->setUseMail($mail);
                $dbUser->setUsePassword(security::hash($defaultPassWord));
                $dbUser->setIdxGroup($defaultGroup[0]->getIdGroup());
                $dbUser->create();
                //crée le dossier utilisateur
                $dbUser->setUseMail($mail);
                $dbUser->getMail();
                $userInfo = $dbUser->getResult();

                //crée les nouveau fichier de l'utilisateur
                handleFiles::crateNewUserFiles($userInfo[0]->getIdUser());
                $successMsg =   $lang_successMsg_update;
            } else {
                $add = 1;
                $errorMsg = $errorMsg . $lang_errorMsg_existMail;
            }
        } else {
            $add = 1;
            $errorMsg = $errorMsg . $lang_errorMsg_existUser;
        }
    } else {
        $add = 1;
        $errorMsg = $errorMsg . $lang_errorMsg_mail;
    }
}
//pour l'affichage des detail
if (isset($_POST[PLUS]) && $edit_user) {
    $plus = 1;
    $idUser = $_POST[PLUS];
    $dbUser->setIdUser($idUser);
    $dbUser->getOnce();
    $tabUser = $dbUser->getResult();

    $dbGroup->setIdGroup($tabUser[0]->getIdxGroup());
    $dbGroup->getOnce();
    $tabGroup = $dbGroup->getResult();

    $nickname = $tabUser[0]->getUseNickname();
    $name = $tabUser[0]->getUseName();
    $lastName = $tabUser[0]->getUseLastName();
    $birthDate = $tabUser[0]->getUseBirthDate();
    $mail = $tabUser[0]->getUseMail();
    $idUser = $tabUser[0]->getIdUser();
    $status = $tabUser[0]->getIdxGroup();
    $idGroup = $tabUser[0]->getUseStatus();
}
//pour la validation des modification dans les details
if (isset($_POST[VALID_PLUS]) && $edit_user) {
    $idUser = security::html($_POST[VALID_PLUS]);
    $dbUser->setIdUser($idUser);
    $dbUser->getOnce();
    $userInfo = $dbUser->getResult();

    $nickname = security::html($_POST[NICKNAME]);
    $name = security::html($_POST[NAME]);
    $lastName = security::html($_POST[LAST_NAME]);
    $birthDate = security::html($_POST[BIRTH_DATE]);
    $mail = security::html($_POST[MAIL]);
    $idUser = security::html($_POST[VALID_PLUS]);
    $status = security::html($_POST[STATUS]);
    $idGroup = security::html($_POST[ID_GROUP]);

    //vérifie que le mail  est valide
    if (!generalFunction::checkMail($mail)) {
        $plus = 2;
        $plusErrorMsg = $errorMsg . $lang_errorMsg_mail;
    } else {
        //verifie si le pseudo est différant de celui de la db
        if ($nickname != $userInfo[0]->getUseNickname()) {
            //vérifie que le pusdo  n'est pas déjà utilisé
            $dbUser->setUseNickname($nickname);
            $dbUser->getNickname();
            $tmp_nickname = $dbUser->getResult();
            if (!isset($tmp_nickname[0])) {
                $plus = 2;
                $plusErrorMsg = $errorMsg . $lang_errorMsg_existUser;
            } else {
                //verifier la date de naissance
                if (generalFunction::checkDate($birthDate)) {

                } else {
                    $errorMsg = $lang_errorMsg_date;
                }

            }

        }

    }

    if ($plusErrorMsg == "") {
        //prepare les valeurs pour le modify
        $dbUser->setIdUser($idUser);
        $dbUser->setUseNickname($nickname);
        $dbUser->setUseStatus($status);
        $dbUser->setUseName($name);
        $dbUser->setUseLastName($lastName);
        $dbUser->setUseBirthDate($birthDate);
        $dbUser->setUseMail($mail);
        $dbUser->setIdxGroup($idGroup);
        $dbUser->modify();

        //crée les nouveau dossier pour l'utilisateur
        handleFiles::crateNewUserFiles($idUser);
        //met le message de success dans un cookie
        $successMsg =   $lang_successMsg_update;
    } else {
        $errorMsg = $plusErrorMsg;
        $dbUser->setIdUser($idUser);
        $dbUser->getOnce();
        $tabUser = $dbUser->getResult();

        $dbGroup->setIdGroup($tabUser[0]->getIdxGroup());
        $dbGroup->getOnce();
        $tabGroup = $dbGroup->getResult();

    }
}
//pour la suppression d'un utilisateur
if (isset($_POST[USER_DELETE]) && $delete_user)
{
    $idUser = security::html($_POST[USER_DELETE]);
    $dbUser->setIdUser($idUser);
    $dbUser->getOnce();
    $userInfo = $dbUser->getResult();
    //verification des resultats
    if (isset($userInfo[0]))
    {
        if ($userConnected != $userInfo[0]->getUseMail()) {
            //defini le chemin du dossier de l'utilisateur
            $userFile = $userFile . security::hashPath($userInfo[0]->getIdUser());
            //verifie si il existe si oui le supprime
            if (is_dir($userFile)) {
                handleFiles::dellDirectory($userFile);
            }
            $dbUser->delete();
            //met le message de success dans un cookie
            $successMsg =  $lang_successMsg_deleteUser;
        }

    }
    //faits une redirection automatique afin d'eviter la conservation des information du formulaire après validation
    header(LOCATION . NAME_PAGE);
}
//pour la validation des modification dans la liste des utilisateurs
if (isset($_POST[VALID]) && $edit_user) {

    $nbUser = security::html($_POST[NB_USER]);
    $i = 0;
    //récupère tout les utilisateur
    $dbUser->getAllUserPermission();
    $lstUser = $dbUser->getResult();
    //parcours tout les utilisateurs

    while ($i < $nbUser) {
        //verifie si le status exist
        if (isset($_POST[STATUS . $i])) {

            $nickname = security::html($_POST[NICKNAME . $i]);
            $name = security::html($_POST[NAME . $i]);
            $lastName = security::html($_POST[LAST_NAME . $i]);
            $mail = security::html($_POST[MAIL . $i]);
            $status = security::html($_POST[STATUS . $i]);
            $idGroup = security::html($_POST[ID_GROUP . $i]);


            $idUser = $lstUser[$i]->getIdUser();
            $tmp_nickname = $lstUser[$i]->getUseNickname();
            $tmp_name = $lstUser[$i]->getUseName();
            $tmp_lastName = $lstUser[$i]->getUseLastName();
            $tmp_mail = $lstUser[$i]->getUseMail();
            $tmp_status = $lstUser[$i]->getUseStatus();
            $tmp_idGroup = $lstUser[$i]->getIdxGroup();

            //vérifie que l'utilisateur à modifier n'est pas l'utilisateur connecté
            if ($mail != $_SESSION[MAIL]) {

                //vérifie qu'il y a eu des modifications dans le infor utilisateur
                if ($nickname != $tmp_nickname || $name != $tmp_name || $lastName != $tmp_lastName || $mail != $tmp_mail) {

                    //vérifie si le mail à été changé
                    if ($mail != $tmp_mail) {
                        //vérifie si le mail est just
                        if (generalFunction::checkMail($mail)) {
                            //vérifie que le mail n'est pas deja utilisé
                            $dbUser->setUseMail($mail);
                            $dbUser->setIdUser($idUser);
                            $dbUser->verifyMail();
                            $tmp_mail = $dbUser->getResult();
                            if (isset($tmp_mail[0])) {
                                $errorMsg = $errorMsg . $lang_errorMsg_existMail;
                            }
                        } else {
                            $errorMsg = $lang_errorMsg_mail;
                        }
                    }
                    if ($errorMsg == "") {
                        //prepare les valeurs pour le modify
                        $dbUser->setIdUser($idUser);
                        $dbUser->setUseNickname($nickname);
                        $dbUser->setUseName($name);
                        $dbUser->setUseLastName($lastName);
                        $dbUser->setUseMail($mail);
                        $dbUser->modify();

                    }
                }
                //verifie si il y a eu des mofification dans le status de l'utilisateur'
                if ($status != $tmp_status) {
                    $dbUser->setIdUser($idUser);
                    $dbUser->setUseStatus($status);
                    $dbUser->modifyStatus();
                }
                //verifie si il y a eu des mofification dans le groupe de l'utilisateur
                if ($idGroup != $tmp_idGroup) {
                    $dbUser->setIdUser($idUser);
                    $dbUser->setIdxGroup($idGroup);
                    $dbUser->modifyGroup();
                }
            }
        }
        $i++;
    }
    echo "errorMsg" . $errorMsg, "<br>";
    if ($errorMsg == "") {
        //met le message de success dans un cookie
        $successMsg =   $lang_successMsg_update;
    }

}

$dbUser->getAllUserPermission();
$tabUserDefault = $dbUser->getResult();
$nbUser = count($tabUserDefault);
$dbGroup->getAll();
$tabGroupDefault = $dbGroup->getResult();
?>