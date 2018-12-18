<?php
define ('NAME_PAGE', "adminAccountGroup.php");
//page pour les admin
define ('TYPE_PERM', 'admin');

include_once "../controller/main_controller.php";



$AccountManagement = "active";
$disabled = "";
$selectedOui = "";
$selectedNon = "";
$permission = 0x00;
$addNewGroup = 0;
$allDisable = 0;
$groupDel = 0;

$add = 0;
$edit = 0;
$delete = 0;

$addGroup = 0;
$editGroup = 0;
$deleteGroup = 0;

$addUser = 0;
$editUser = 0;
$deleteUser = 0;

$dbGroup->getAll();
$tabGroup = $dbGroup->getResult();
$lang_permission = array();
$tabPermission = array();

//vérifie si le compte peut ajouter des groupes
$account->setTypePerm(ADD_GROUP);
$account->permission();
$new_group = $account->getAccess();

//vérifie si le compte peut modifier des groupe
$account->setTypePerm(EDIT_GROUP);
$account->permission();
$edit_group = $account->getAccess();

//vérifie si le compte peut supprimer des groupe
$account->setTypePerm(DELETE_GROUP);
$account->permission();
$delete_group = $account->getAccess();

//vérifie le groupe de l'utilisateur connécté et son id
$dbUser->setUseMail($_SESSION[MAIL]);
$dbUser->getGroup();
$result = $dbUser->getResult();

$groName = $result[0]->getGroName();
$idGroup = $result[0]->getIdGroup();
if (!$edit_group) {
    $disabled = "disabled";
}
if (isset($_POST[NEW_GROUP])) {
    $addNewGroup = 1;
}

if (isset($_POST[VALID_NEW_GROUP]))
{
    $name = security::html($_POST[GROUP_NAME]);
    $access = security::html($_POST[ACCESS]);

    $add = security::html($_POST[ADD]);
    $edit = security::html($_POST[EDIT]);
    $delete = security::html($_POST[DELETE]);

    $addGroup = security::html($_POST[ADD_GROUP]);
    $editGroup = security::html($_POST[EDIT_GROUP]);
    $deleteGroup = security::html($_POST[DELETE_GROUP]);

    $addUser = security::html($_POST[ADD_USER]);
    $editUser = security::html($_POST[EDIT_USER]);
    $deleteUser = security::html($_POST[DELETE_USER]);

    if ($name != "") {
        $dbGroup->setGroName($name);
        $dbGroup->getName();
        $exist = $dbGroup->getResult();
        //verifie que le groupe n'existe pas
        if (!isset($exist[0])) {
            //verifie le type d'accés
            switch ($access)
            {
                //verrifie quel type de permission il faut verifier
                case $lang_AccessRight_all: {
                    $account->setNewPermission(ALL);
                    $account->setPermission($permission);
                    $account->modifyPermission();
                    $permission = $account->getPermission();
                    break;
                }
                //verrifie quel type de permission il faut verifier
                case $lang_AccessRight_member: {
                    $account->setNewPermission(ALL);
                    $account->setPermission($permission);
                    $account->modifyPermission();
                    $permission = $account->getPermission();

                    $account->setNewPermission(MEMBER);
                    $account->setPermission($permission);
                    $account->modifyPermission();
                    $permission = $account->getPermission();
                    break;
                }
                //verrifie quel type de permission il faut verifier
                case $lang_AccessRight_moderator: {
                    $account->setNewPermission(ALL);
                    $account->setPermission($permission);
                    $account->modifyPermission();
                    $permission = $account->getPermission();

                    $account->setNewPermission(MEMBER);
                    $account->setPermission($permission);
                    $account->modifyPermission();
                    $permission = $account->getPermission();

                    $account->setNewPermission(MODERATOR);
                    $account->setPermission($permission);
                    $account->modifyPermission();
                    $permission = $account->getPermission();
                    break;
                }
                //verrifie quel type de permission il faut verifier
                case $lang_AccessRight_admin: {
                    $account->setNewPermission(ALL);
                    $account->setPermission($permission);
                    $account->modifyPermission();
                    $permission = $account->getPermission();

                    $account->setNewPermission(MEMBER);
                    $account->setPermission($permission);
                    $account->modifyPermission();
                    $permission = $account->getPermission();

                    $account->setNewPermission(MODERATOR);
                    $account->setPermission($permission);
                    $account->modifyPermission();
                    $permission = $account->getPermission();

                    $account->setNewPermission(ADMIN);
                    $account->setPermission($permission);
                    $account->modifyPermission();
                    $permission = $account->getPermission();
                    break;
                }
                default: {
                    break;
                }
            }
            //modifie les permissions
            if ($add == 1) {
                $account->setNewPermission(ADD);
                $account->setPermission($permission);
                $account->modifyPermission();
                $permission = $account->getPermission();
            }
            if ($edit == 1) {
                $account->setNewPermission(EDIT);
                $account->setPermission($permission);
                $account->modifyPermission();
                $permission = $account->getPermission();
            }
            if ($delete == 1) {
                $account->setNewPermission(DELETE);
                $account->setPermission($permission);
                $account->modifyPermission();
                $permission = $account->getPermission();
            }
            if ($addGroup == 1) {
                $account->setNewPermission(ADD_GROUP);
                $account->setPermission($permission);
                $account->modifyPermission();
                $permission = $account->getPermission();
            }
            if ($editGroup == 1) {
                $account->setNewPermission(EDIT_GROUP);
                $account->setPermission($permission);
                $account->modifyPermission();
                $permission = $account->getPermission();
            }
            if ($deleteGroup == 1) {
                $account->setNewPermission(DELETE_GROUP);
                $account->setPermission($permission);
                $account->modifyPermission();
                $permission = $account->getPermission();
            }
            if ($addUser == 1) {
                $account->setNewPermission(ADD_USER);
                $account->setPermission($permission);
                $account->modifyPermission();
                $permission = $account->getPermission();
            }
            if ($editUser == 1) {
                $account->setNewPermission(EDIT_USER);
                $account->setPermission($permission);
                $account->modifyPermission();
                $permission = $account->getPermission();
            }
            if ($deleteUser == 1) {
                $account->setNewPermission(DELETE_USER);
                $account->setPermission($permission);
                $account->modifyPermission();
                $permission = $account->getPermission();
            }
            $dbGroup->setGroName($name);
            $dbGroup->setGroPermission($permission);
            $dbGroup->create();
            //met le message de success dans un cookie
            $successMsg = $lang_successMsg_update;
        } else {
            $contentErrorMsg = $contentErrorMsg . $fr_existingGroup;
            $addNewGroup = 1;
        }
    } else {

        $contentErrorMsg = $contentErrorMsg . $fr_voidName;
        $addNewGroup = 1;
    }
}
//pour la validation des modification dans la liste des groupes
if (isset($_POST[VALID]) && $edit_group)
{
    $nbGroup = security::html($_POST[NB_GROUP]);
    $i = 0;
    //récupère tout les group
    $dbGroup->getAll();
    $lstGroup = $dbGroup->getResult();
    while ($i < $nbGroup)
    {

        $name = security::html($_POST[GROUP_NAME . $i]);

        $id = security::html($_POST[ID_GROUP . $i]);
        $dbGroup->setIdGroup($id);
        $dbGroup->getOnce();
        $OldPermission = $dbGroup->getResult()[0]->getGroPermission();
        $permission = 0x00;

        //exclue les changement de permission du group de l'utilisateur connecté
        if ($name != $groName)
        {

            $access = security::html($_POST[ACCESS.$i]);

            $add = security::html($_POST[ADD . $i]);
            $edit = security::html($_POST[EDIT . $i]);
            $delete = security::html($_POST[DELETE . $i]);

            $addGroup = security::html($_POST[ADD_GROUP . $i]);
            $editGroup = security::html($_POST[EDIT_GROUP . $i]);
            $deleteGroup = security::html($_POST[DELETE_GROUP . $i]);

            $addUser = security::html($_POST[ADD_USER . $i]);
            $editUser = security::html($_POST[EDIT_USER . $i]);
            $deleteUser = security::html($_POST[DELETE_USER . $i]);


            //verifie le type d'accés
            switch ($access) {
                //verrifie quel type de permission il faut verifier
                case ALL_KEY: {
                    $account->setNewPermission(ALL);
                    $account->setPermission($permission);
                    $account->modifyPermission();
                    $permission = $account->getPermission();
                    break;
                }
                //verrifie quel type de permission il faut verifier
                case MEMBER_KEY: {
                    $account->setNewPermission(ALL);
                    $account->setPermission($permission);
                    $account->modifyPermission();
                    $permission = $account->getPermission();

                    $account->setNewPermission(MEMBER);
                    $account->setPermission($permission);
                    $account->modifyPermission();
                    $permission = $account->getPermission();
                    break;
                }
                //verrifie quel type de permission il faut verifier
                case MODERATOR_KEY: {
                    $account->setNewPermission(ALL);
                    $account->setPermission($permission);
                    $account->modifyPermission();
                    $permission = $account->getPermission();

                    $account->setNewPermission(MEMBER);
                    $account->setPermission($permission);
                    $account->modifyPermission();
                    $permission = $account->getPermission();

                    $account->setNewPermission(MODERATOR);
                    $account->setPermission($permission);
                    $account->modifyPermission();
                    $permission = $account->getPermission();
                    break;
                }
                //verrifie quel type de permission il faut verifier
                case ADMIN_KEY: {
                    $account->setNewPermission(ALL);
                    $account->setPermission($permission);
                    $account->modifyPermission();
                    $permission = $account->getPermission();

                    $account->setNewPermission(MEMBER);
                    $account->setPermission($permission);
                    $account->modifyPermission();
                    $permission = $account->getPermission();

                    $account->setNewPermission(MODERATOR);
                    $account->setPermission($permission);
                    $account->modifyPermission();
                    $permission = $account->getPermission();

                    $account->setNewPermission(ADMIN);
                    $account->setPermission($permission);
                    $account->modifyPermission();
                    $permission = $account->getPermission();
                    break;
                }
                default: {
                    break;
                }
            }
            //modifie les permissions
            if ($add == 1)
            {
                $account->setNewPermission(ADD);
                $account->setPermission($permission);
                $account->modifyPermission();
                $permission = $account->getPermission();
            }
            if ($edit == 1) {
                $account->setNewPermission(EDIT);
                $account->setPermission($permission);
                $account->modifyPermission();
                $permission = $account->getPermission();
            }
            if ($delete == 1) {
                $account->setNewPermission(DELETE);
                $account->setPermission($permission);
                $account->modifyPermission();
                $permission = $account->getPermission();
            }
            if ($addGroup == 1) {
                $account->setNewPermission(ADD_GROUP);
                $account->setPermission($permission);
                $account->modifyPermission();
                $permission = $account->getPermission();
            }
            if ($editGroup == 1) {
                $account->setNewPermission(EDIT_GROUP);
                $account->setPermission($permission);
                $account->modifyPermission();
                $permission = $account->getPermission();
            }
            if ($deleteGroup == 1) {
                $account->setNewPermission(DELETE_GROUP);
                $account->setPermission($permission);
                $account->modifyPermission();
                $permission = $account->getPermission();
            }
            if ($addUser == 1) {
                $account->setNewPermission(ADD_USER);
                $account->setPermission($permission);
                $account->modifyPermission();
                $permission = $account->getPermission();
            }
            if ($editUser == 1) {
                $account->setNewPermission(EDIT_USER);
                $account->setPermission($permission);
                $account->modifyPermission();
                $permission = $account->getPermission();
            }
            if ($deleteUser == 1) {
                $account->setNewPermission(DELETE_USER);
                $account->setPermission($permission);
                $account->modifyPermission();
                $permission = $account->getPermission();
            }

        } else
        {
            $dbGroup->setIdGroup($id);
            $dbGroup->getOnce();
            $dbGroup->getResult();
            $permission = $dbGroup->getResult()[0]->getGroPermission();
        }
        if ($permission != $OldPermission)
        {
            $dbGroup->setGroPermission($permission);
            $dbGroup->setGroName($name);
            $dbGroup->setIdGroup($id);
            $dbGroup->modify();
        }
        $i++;
    }
    //met le message de success dans un cookie
    $successMsg = $lang_successMsg_update;
}
//pour la suppression d'un groupe
if (isset($_POST[GROUP_DELETE]) && $delete_group) {
    $id = security::html($_POST[GROUP_DELETE]);
    //verifier que sa soie pas le groupe de l'utilisateur actif
    if ($id != $idGroup) {
        //verification de l'existante du groupe
        $dbGroup->setIdGroup($id);
        $dbGroup->getOnce();
        $groupInfo = $dbGroup->getResult();


        if (isset($groupInfo[0]) && $groupInfo[0] != "")
        {
            //verifier si y a des personnes dans le groupe
            $idDelGroup = $groupInfo[0]->getIdGroup();
            $dbUser->setIdxGroup($idDelGroup);
            $dbUser->getAllGroup();
            $lstUser = $dbUser->getResult();
            if (isset($lstUser[0])) {
                $userOfGroup = $lstUser;
                $groupDel = 1;
                //met le message de success dans un cookie
                //met le message de success dans un cookie
                $successMsg = $lang_infoMsg_deleteGroup;
                setcookie(ID_GROUP, $idDelGroup);;
            }
            else
            {
                $dbGroup->delete();
            }
        }
        else
        {

        }
    }
    //met le message de success dans un cookie
    $successMsg = $lang_successMsg_deleteGroup;
}
if (isset($_POST[GROUP_CHANGE]) && $delete_group) {
    $idNewGroup = security::html($_POST[ID_NEW_GROUP]);
    $idOldGroup = security::html($_POST[ID_GROUP]);

    $dbUser->setIdxGroup($idNewGroup);
    $dbUser->setOldIdxGroup($idOldGroup);
    $dbUser->modifyALLGroup();

    $dbGroup->setIdGroup($idOldGroup);
    $dbGroup->delete();

    //met le message de success dans un cookie
    $successMsg = $lang_successMsg_deleteGroup;
}
$nbGroup = count($tabGroup);
//verifie les permissions
//recharge les données pour prendre en compte les données modifiée
$dbGroup->getAll();
$tabGroup = $dbGroup->getResult();
foreach ($tabGroup as $key => $value)
{
    //cherche dans les permission celle qui correspondent aux permission d'accès
    $account->setPermission($value->getGroPermission());
    //vérifie tout les droit d'accès du plus au moins restrictif
    $account->setTypePerm(ALL);
    $account->Permission();
    if ($account->getAccess())
    {
        //verification du droits d'accé membre
        $account->setTypePerm(MEMBER);
        $account->Permission();
        if ($account->getAccess())
        {
            //verification du droits d'accé moderateur
            $account->setTypePerm(MODERATOR);
            $account->Permission();
            if ($account->getAccess())
            {
                //verification du droits d'accé admin
                $account->setTypePerm(ADMIN);
                $account->Permission();
                $tabPermission[$key][ACCESS] = $account->getAccess();
                if ($account->getAccess()) {
                    $tabPermission[$key][ACCESS] = ADMIN_KEY;
                } else {
                    $tabPermission[$key][ACCESS] = MODERATOR_KEY;
                }
            }
            else
            {
                $tabPermission[$key][ACCESS] = MEMBER_KEY;
            }
        }
        else
        {
            $tabPermission[$key][ACCESS] = ALL_KEY;
        }
    }
    else {
        $tabPermission[$key][ACCESS] = "";
    }
    //verification du droits de d'ajout d'elements
    $account->setTypePerm(ADD);
    $account->Permission();
    $tabPermission[$key][ADD] = $account->getAccess();
    //verification du droits de suppression d'elements
    $account->setTypePerm(DELETE);
    $account->Permission();
    $tabPermission[$key][DELETE] = $account->getAccess();
    //verification du droits edition d'element
    $account->setTypePerm(EDIT);
    $account->Permission();
    $tabPermission[$key][EDIT] = $account->getAccess();
    ///verification du droits d'ajout d'utilisateur à un groupe
    $account->setTypePerm(ADD_GROUP);
    $account->Permission();
    $tabPermission[$key][ADD_GROUP] = $account->getAccess();
    //verification du droits d'ajout de permission de groupe
    $account->setTypePerm(EDIT_GROUP);
    $account->Permission();
    $tabPermission[$key][EDIT_GROUP] = $account->getAccess();
    //verification du droits de supportions des groupe
    $account->setTypePerm(DELETE_GROUP);
    $account->Permission();
    $tabPermission[$key][DELETE_GROUP] = $account->getAccess();
    ///verification du droits d'ajout d'un utilisateur
    $account->setTypePerm(ADD_USER);
    $account->Permission();
    $tabPermission[$key][ADD_USER] = $account->getAccess();
    //verification du droits d'ajout modification d'un utilisateur
    $account->setTypePerm(EDIT_USER);
    $account->Permission();
    $tabPermission[$key][EDIT_USER] = $account->getAccess();
    //verification du droits suppretion d'un utilisateur
    $account->setTypePerm(DELETE_USER);
    $account->Permission();
    $tabPermission[$key][DELETE_USER] = $account->getAccess();
}

//prepart les affichage pour les liste déroulante d'accès
$lang_permission[0] = $lang_AccessRight_all;
$lang_permission[1] = $lang_AccessRight_member;
$lang_permission[2] = $lang_AccessRight_moderator;
$lang_permission[3] = $lang_AccessRight_admin;

if (isset($_COOKIE[MSG_ERROR])) {
    $idGroup = $_COOKIE[ID_GROUP];
    $dbUser->setIdxGroup($idGroup);
    $dbUser->getAllGroup();
    $lstUser = $dbUser->getResult();
    $errorMsg = $_COOKIE[MSG_ERROR];
    setcookie(MSG_ERROR, "", time() - 3600);
}

?>