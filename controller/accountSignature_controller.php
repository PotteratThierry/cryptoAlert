<?php
define ('NAME_PAGE', "accountSignature.php");
//page limitée au membres
define ('TYPE_PERM', 'member');
include_once "../controller/main_controller.php";
$accountMenu = "btn-Active";

//recherche de l'id de l'utilisateur
$dbUser->setUseMail($_SESSION[MAIL]);
$dbUser->getMail();
$userName = $dbUser->getResult();
$userName = $userName[0]->getUseName();


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

//on vas chercher les infos de l'utilisateur avant modification
$dbUser->setUseMail($_SESSION[MAIL]);
$dbUser->getMail();
$userInfo = $dbUser->getResult();


//si l'image de l'avatage à été renseigné
if (isset($_FILES[AVATAR][IMG_NAME]) && $_FILES[AVATAR][IMG_NAME] != "") {
    if ($_FILES[AVATAR][ERROR] <= 0) {
        if ($_FILES[AVATAR][SIZE] <= WEIGHT) {
            $avatar = $_FILES[AVATAR][IMG_NAME];
            $avatarTmp = $_FILES[AVATAR][IMG_TMP_NAME];
            //verifies si l'extention est valide
            $ext = handleImg::checkImg($avatarTmp);
            if ($ext != '0' && $ext != '1') {

                $imgNewName = security::imgPathHash(PATH, $userInfo[0]->getIdUser() ,AVATAR_PATH);

                //redimentionne l'image
                $uploadAvatarFile = handleImg::imgResize($avatarTmp, $imgNewName, RESIZE_WIDTH_AVATAR, RESIZE_HEIGHT_AVATAR);

                //si l'image à bien été redimentionnée
                if ($uploadAvatarFile != "") {

                    //supprime l'ancienne signature
                    handleFiles::dellFile($userInfo[0]->getUseAvatar());

                    $dbUser->setUseAvatar($uploadAvatarFile);

                    //prepare les valeurs pour le modify
                    $dbUser->setIdUser($userInfo[0]->getIdUser());
                    $dbUser->modifyAvatar();
                    $avatarSuccessMsg = $lang_successMsg_img;
                }
            }
        } else {
            $avatarErrorMsg = $avatarErrorMsg . $lang_errorMsg_size;
        }
    } else {
        $avatarErrorMsg = $avatarErrorMsg . $lang_errorMsg_update;
    }
}

//si la signature à été renseignée
if (isset($_FILES[SIGNATURE][IMG_NAME]) && $_FILES[SIGNATURE][IMG_NAME] != "") {
    if ($_FILES[SIGNATURE][ERROR] <= 0) {
        if ($_FILES[SIGNATURE][SIZE] <= WEIGHT) {
            $signature = $_FILES[SIGNATURE][IMG_NAME];
            $signatureTmp = $_FILES[SIGNATURE][IMG_TMP_NAME];

            //verifie si l'extention est valide
            $result = handleImg::checkImg($signatureTmp);
            if ($result != '0' && $result != '1') {

                $userInfoHash = $userInfo[0]->getUseName();
                $pathHash = SIGNATURE_PATH;
                $imgNewName = $pathHash.$userInfoHash.".".$ext;

                //redimentionne l'image
                $uploadSignatureFile = handleImg::imgResize($signatureTmp, $imgNewName, RESIZE_WIDTH_SIGNATURE, RESIZE_HEIGHT_SIGNATURE);

                //si l'image à bien été redimentionnée
                if ($uploadSignatureFile != "") {
                    //supprime l'ancienne signature
                    handleFiles::dellFile($userInfo[0]->getUseSignature());

                    $dbUser->setUseSignature($uploadSignatureFile);

                    //prepare les valeurs pour le modify
                    $dbUser->setIdUser($userInfo[0]->getIdUser());
                    $dbUser->modifySignature();
                    $signatureSuccessMsg = $lang_successMsg_img;
                }
            }
        } else {
            $signatureErrorMsg = $signatureErrorMsg . $lang_errorMsg_size;
        }
    } else {
        $signatureErrorMsg = $signatureErrorMsg . $lang_errorMsg_update;
    }
}
if (isset($_POST[DELETE_SIGNATURE])) {
    $dbUser->setUseSignature(NULL);
    //prepare les valeurs pour le modify
    $dbUser->setIdUser($userInfo[0]->getIdUser());
    $dbUser->modifySignature();
}
if (isset($_POST[DELETE_AVATAR])) {
    $dbUser->setUseAvatar(NULL);
    //prepare les valeurs pour le modify
    $dbUser->setIdUser($userInfo[0]->getIdUser());
    $dbUser->modifyAvatar();
}
//assigne le message dans la langue affichée à la variable du message d'erreur



// vas chercher les infos de l'utilisateur avant modification
$dbUser->setUseMail($_SESSION[MAIL]);
$dbUser->getMail();

$userInfo = $dbUser->getResult();
$signature = $userInfo[0]->getUseSignature();
$avatar = $userInfo[0]->getUseAvatar();
if ($signature == NULL) {
    $signature = $defaultSignature;
}
if ($avatar == NULL) {
    $avatar = $defaultAvatar;

}

?>