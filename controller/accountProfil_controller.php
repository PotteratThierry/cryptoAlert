<?php
define ('NAME_PAGE', "accountProfil.php");
//page limitée au membres
define ('TYPE_PERM', 'member');

include_once "../controller/main_controller.php";
$accountMenu = "btn-Active";


if (isset($_POST[NAME]))
{
    $cContact = new contact();
    $cContact->setLoginName($_SESSION[LOGIN_NAME]);
    $cContact->loadOnceByName($connector);
    $tabUser = $cContact->getResult();

    $name = security::html($_POST[NAME]);
    $nickname = security::html($_POST[NICKNAME]);
    $lastName = security::html($_POST[LAST_NAME]);
    $birthDate = security::html($_POST[BIRTH_DATE]);

    if ($birthDate == "")
    {
        $errorMsg = $lang_errorMsg_date;
    }
    if (!generalFunction::checkDate($birthDate))
    {
        $errorMsg = $lang_errorMsg_date;
    }
    if ($errorMsg == "")
    {
        //mise à jour dans la DB
        $cContact->setIdUser($tabUser[COLUMN_USER_ID]);
        $cContact->setNickName($nickname);
        $cContact->setName($name);
        $cContact->setLastName($lastName);
        $cContact->setBirthDate($birthDate);
        $cContact->updateUserInfo($connector);

        //met le message de success dans un cookie
        $successMsg = $lang_successMsg_update;

        $_SESSION[NICKNAME] = $nickname;

    }
}
    $cContact = new contact();
    $cContact->setLoginName($_SESSION[LOGIN_NAME]);
    $cContact->loadOnceByName($connector);
    $tabUser = $cContact->getResult();

    $nickName = $tabUser[COLUMN_USER_NICK_NAME];
    $name = $tabUser[COLUMN_USER_NAME];
    $lastName = $tabUser[COLUMN_USER_LAST_NAME];
    $birthDate = $tabUser[COLUMN_USER_BIRTH_DATE];
