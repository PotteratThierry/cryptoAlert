<?php
define ('NAME_PAGE', "accountSignature.php");
//page limitée au membres
define ('TYPE_PERM', 'member');
include_once "../controller/main_controller.php";
$accountMenu = "btn-Active";

//on vas chercher les infos de l'utilisateur avant modification
$cContact = new contact();
$cContact->setLoginName($_SESSION[LOGIN_NAME]);
$cContact->loadOnceByName($connector);
$tabUser = $cContact->getResult();
$cContact->setIdUser($tabUser[COLUMN_USER_ID]);

//constant pour le redimentionement et le déplacement des signatures et des avatars
define('RESIZE_HEIGHT_SIGNATURE', param::searchParam(INI_PATH, 'maxHeight_signature'));
define('RESIZE_WIDTH_SIGNATURE', param::searchParam(INI_PATH, 'maxWidth_signature'));
define('RESIZE_HEIGHT_AVATAR', param::searchParam(INI_PATH, 'maxHeight_avatar'));
define('RESIZE_WIDTH_AVATAR', param::searchParam(INI_PATH, 'maxWidth_avatar'));
define('WEIGHT', param::searchParam(INI_PATH, 'maxWeight'));
define('SIGNATURE_PATH', param::searchParam(INI_PATH, 'signature_path'));
define('AVATAR_PATH', param::searchParam(INI_PATH, 'avatar_path'));
define('PATH', param::searchParam(INI_PATH, 'userPath'));

$defaultAvatar = param::searchParam(INI_PATH, 'defaultAvatar');
$defaultSignature = param::searchParam(INI_PATH, 'defaultSignature');

$avatarErrorMsg = "";
$avatarSuccessMsg = "";
$signatureErrorMsg = "";
$signatureSuccessMsg = "";
$msgFormatError = "";
$success = 0;

$userPath = $tabUser[COLUMN_USER_FILE_NAME];

//si l'image de l'avatage à été renseigné
if (isset($_FILES[AVATAR][IMG_NAME]) AND $_FILES[AVATAR][IMG_NAME] != "")
{
    if ($_FILES[AVATAR][ERROR] > 0)
    {
        $avatarErrorMsg = $avatarErrorMsg . $lang_errorMsg_update;
    }
    if ($_FILES[AVATAR][SIZE] > WEIGHT)
    {
        $avatarErrorMsg = $avatarErrorMsg . $lang_errorMsg_size;
    }
    if($avatarErrorMsg == "")
    {
        $avatar = $_FILES[AVATAR][IMG_NAME];
        $avatarTmp = $_FILES[AVATAR][IMG_TMP_NAME];

        $imgNewPath = AVATAR_PATH.security::imgNameHash($avatar);

        //redimentionne l'image
        $uploadAvatarFile = handleImg::imgResize($avatarTmp ,$userPath, $imgNewPath, RESIZE_WIDTH_AVATAR, RESIZE_HEIGHT_AVATAR);

        if ($uploadAvatarFile != "")
        {
            //supprime l'ancienne signature
            handleFiles::dellFile($userPath.$tabUser[COLUMN_USER_AVATAR]);

            $cContact->setAvatar($uploadAvatarFile);

            //prepare les valeurs pour le modify
            $cContact->uploadAvatar($connector);
            $avatarSuccessMsg = $lang_successMsg_img;
        }
    }

}

//si la signature à été renseignée
if (isset($_FILES[SIGNATURE][IMG_NAME]) AND $_FILES[SIGNATURE][IMG_NAME] != "")
{
    if ($_FILES[SIGNATURE][ERROR] > 0)
    {
        $signatureErrorMsg = $signatureErrorMsg . $lang_errorMsg_update;
    }
        if ($_FILES[SIGNATURE][SIZE] > WEIGHT)
        {
            $signatureErrorMsg = $signatureErrorMsg . $lang_errorMsg_size;
        }
        if($signatureErrorMsg == "")
        {
            $signature = $_FILES[SIGNATURE][IMG_NAME];
            $signatureTmp = $_FILES[SIGNATURE][IMG_TMP_NAME];

            $imgNewPath = SIGNATURE_PATH.security::imgNameHash($signature);

            //redimentionne l'image
            $uploadSignatureFile = handleImg::imgResize($signatureTmp, $userPath, $imgNewPath, RESIZE_WIDTH_SIGNATURE, RESIZE_HEIGHT_SIGNATURE);
            if ($uploadSignatureFile != "")
            {

                //supprime l'ancienne signature
                handleFiles::dellFile($userPath.$tabUser[COLUMN_USER_SIGNATURE]);

                $cContact->setSignature($uploadSignatureFile);

                //prepare les valeurs pour le modify
                $cContact->uploadSignature($connector);
                $signatureSuccessMsg = $lang_successMsg_img;
            }
        }
}
if (isset($_POST[DELETE_AVATAR]))
{
    $cContact->setAvatar('');
    //prepare les valeurs pour le modify
    $cContact->uploadAvatar($connector);
    handleFiles::dellFile($userPath.$tabUser[COLUMN_USER_AVATAR]);
}
if (isset($_POST[DELETE_SIGNATURE]))
{
    $cContact->setSignature('');
    //prepare les valeurs pour le modify
    $cContact->uploadSignature($connector);
    handleFiles::dellFile($userPath.$tabUser[COLUMN_USER_SIGNATURE]);
}

//on vas chercher les infos de l'utilisateur avant modification
$cContact = new contact();
$cContact->setLoginName($_SESSION[LOGIN_NAME]);
$cContact->loadOnceByName($connector);
$tabUser = $cContact->getResult();

$signature = $tabUser[COLUMN_USER_SIGNATURE];
$avatar = $tabUser[COLUMN_USER_AVATAR];
if ($signature == NULL) {
    $signature = $defaultSignature;
}
else
{
    $signature = $tabUser[COLUMN_USER_FILE_NAME].$signature;
}
if ($avatar == NULL) {
    $avatar = $defaultAvatar;

}
else
{
    $avatar = $tabUser[COLUMN_USER_FILE_NAME].$avatar;
}

?>