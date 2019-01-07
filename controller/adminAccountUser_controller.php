<?php
define ('NAME_PAGE', "adminAccountUser.php");
//page pour les admin
define ('TYPE_PERM', 'admin');

include_once "../controller/main_controller.php";

$AccountManagement = "active";
$plusErrorMsg = "";
$add = 0;
$plus = 0;
$disabled = "";

$idUser = 0;
$idGroup =0;
$status =0;
//à changer lors de la mise en place des fichier de paramètres
$defaultPassWord = param::searchParam(INI_PATH, 'defaultPassword');
$defaultGroup = param::searchParam(INI_PATH, P_DEFAULT_GROUP);
$userFile = param::searchParam(INI_PATH, 'userPath');

$connected = $contact->getConnect();
$loginName = $contact->getLoginName();

$mail = $contact->getMail();
$deleteUser = $permission->getDeleteUser();
$editUser = $permission->getEditUser();
$addUser = $permission->getAddUser();

//desactive les champs du formulaire
if ($editUser) {
    $disabled = "disabled";
}
//pour l'ajout d'un utilisateur
if (isset($_POST[NEW_USER]) && $addUser) {
    $add = 1;
    $nickname = "";
    $name = "";
    $lastName = "";
    $mail = "";
}
//pour la validation de l'ajout d'un utilisateur
if (isset($_POST[VALID_NEW_USER]) && $addUser)
{
    $nickname = security::html($_POST[LOGIN_NAME]);
    $name = security::html($_POST[NAME]);
    $lastName = security::html($_POST[LAST_NAME]);
    $mail = security::html($_POST[MAIL]);

    //verification du mail
    if (generalFunction::checkMail($mail))
    {
        $cContact = new contact();
        $cContact->setMail($mail);
        $cContact->mailExist($connector);
        //vérifie si l'Email existe
        if ($cContact->getResult() != array()) {
            $error = 1;
            $errorMsg .= $lang_errorMsg_existMail . "<br>";
        }
        $cContact->setLoginName($loginName);
        $cContact->loginNameExist($connector);
        //vérifie si le loginName existe
        if ($cContact->getResult() != array()) {
            $error = 1;
            $errorMsg .= $lang_errorMsg_existUser . "<br>";
        }
        if (!$error) {
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
            $tabUser = $dbUser->getResult();

            //crée les nouveau fichier de l'utilisateur
            handleFiles::crateNewUserFiles($tabUser[0]->getIdUser());
            $successMsg = $lang_successMsg_update;
        }
    }
}
//pour l'affichage des detail
if (isset($_POST[PLUS]) && $editUser)
{
    $plus = 1;
    $cContact = new contact();
    $cContact->setIdUser($_POST[PLUS]);
    $cContact->loadOnceById($connector);
    $tabUser = $cContact->getResult();
    $idGroup =  $tabUser[COLUMN_USER_IDX_GROUP];

    $group = new group();
    $group->setIdGroup($idGroup);
    $group->loadOnceById($connector);
    $tabGroup =  $group->getResult();

    $loginName = $tabUser[COLUMN_USER_LOGIN_NAME];
    $mail = $tabUser[COLUMN_USER_MAIL];
    $idUser = $tabUser[COLUMN_USER_ID];
    $status = $tabUser[COLUMN_USER_STATUS];
}
//pour la validation des modification dans les details
if (isset($_POST[VALID_PLUS]) && $editUser)
{
    $idUser = security::html($_POST[VALID_PLUS]);
    $cContact = new contact();
    $cContact->setIdUser($idUser);
    $cContact->loadOnceById($connector);
    $tabUser = $cContact->getResult();

    $loginName = security::html($_POST[LOGIN_NAME]);
    $mail = security::html($_POST[MAIL]);
    $idUser = security::html($_POST[VALID_PLUS]);
    $status = security::html($_POST[STATUS]);
    $idGroup = security::html($_POST[ID_GROUP]);

    //vérifie que le mail  est valide
    if (!generalFunction::checkMail($mail))
    {
        $plus = 2;
        $plusErrorMsg = $errorMsg . $lang_errorMsg_mail;
    }
    else
    {
        //verifie si le pseudo est différant de celui de la db
        if ($loginName != $tabUser[COLUMN_USER_LOGIN_NAME])
        {
            //vérifie que le pusdo  n'est pas déjà utilisé
            $cContact->setLoginName($loginName);
            $cContact->loginNameExist($connector);
            //vérifie si le loginName existe
            if ($cContact->getResult() != array()) {
                $error = 1;
                $errorMsg .= $lang_errorMsg_existUser . "<br>";
            }
        }

    }

    if ($plusErrorMsg == "")
    {
        //effectue l'update
        $cContact->setMail($mail);
        $cContact->update($connector);
        //crée les nouveau dossier pour l'utilisateur
        handleFiles::crateNewUserFiles($idUser);
        //met le message de success dans un cookie
        $successMsg =   $lang_successMsg_update;
    }
}
//pour la suppression d'un utilisateur
if (isset($_POST[USER_DELETE]) && $deleteUser)
{
    $idUser = security::html($_POST[USER_DELETE]);
    $dbUser->setIdUser($idUser);
    $dbUser->getOnce();
    $tabUser = $dbUser->getResult();
    //verification des resultats
    if (isset($tabUser[0]))
    {
        if ($contact->getContact() != $tabUser[0]->getUseMail()) {
            //defini le chemin du dossier de l'utilisateur
            $userFile = $userFile . security::hashPath($tabUser[0]->getIdUser());
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
if (isset($_POST[VALID]) && $editUser) {

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

$cContact = new contact();
$cContact->load($connector);
$tabUser = $cContact->getResult();
$nbUser = count($tabUser);

$cGroup = new group();
$cGroup->load($connector);
$tabGroup = $cGroup->getResult();
?>