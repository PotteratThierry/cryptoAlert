<?php
$lang_choiceLang                    = param::searchParam(LANG_PATH.$lang.LANG_EXT,"choiceLang");
$lang_codeLang                      = param::searchParam(LANG_PATH.$lang.LANG_EXT,"CodLang");

$lang_title                         = param::searchParam(LANG_PATH.$lang.LANG_EXT,"title");
$lang_description                   = param::searchParam(LANG_PATH.$lang.LANG_EXT,"description");

//menu
$lang_feature                       = param::searchParam(LANG_PATH.$lang.LANG_EXT,"feature");
$lang_search                        = param::searchParam(LANG_PATH.$lang.LANG_EXT,"search");
$lang_home                          = param::searchParam(LANG_PATH.$lang.LANG_EXT,"home");
$lang_contact                       = param::searchParam(LANG_PATH.$lang.LANG_EXT,"contact");
$lang_wallet                        = param::searchParam(LANG_PATH.$lang.LANG_EXT,"wallet");
$lang_money                         = param::searchParam(LANG_PATH.$lang.LANG_EXT,"money");
$lang_alert                         = param::searchParam(LANG_PATH.$lang.LANG_EXT,"alert");
$lang_maj_alert                     = param::searchParam(LANG_PATH.$lang.LANG_EXT,"maj_alert");

//constant des texte affiché pour les droit d'accés selon la langue
$lang_AccessRight_all               = param::searchParam(LANG_PATH.$lang.LANG_EXT,'noAccess');
$lang_AccessRight_member            = param::searchParam(LANG_PATH.$lang.LANG_EXT,'member');
$lang_AccessRight_moderator         = param::searchParam(LANG_PATH.$lang.LANG_EXT,'moderator');
$lang_AccessRight_admin             = param::searchParam(LANG_PATH.$lang.LANG_EXT,'administrator');

//menu administration
$lang_accountManagement             = param::searchParam(LANG_PATH.$lang.LANG_EXT,"accountManagement");
    $lang_a_accountUser             = param::searchParam(LANG_PATH.$lang.LANG_EXT,"a_accountUser");
    $lang_a_accountGroup            = param::searchParam(LANG_PATH.$lang.LANG_EXT,"a_accountGroup");
$lang_a_settings                    = param::searchParam(LANG_PATH.$lang.LANG_EXT,"a_settings");
    $lang_a_settingsGeneral         = param::searchParam(LANG_PATH.$lang.LANG_EXT,"a_settingsGeneral");
    $lang_a_settingsDb              = param::searchParam(LANG_PATH.$lang.LANG_EXT,"a_settingsDb");
    $lang_a_settingsTemplate        = param::searchParam(LANG_PATH.$lang.LANG_EXT,"a_settingsTemplate");
$lang_a_stats                       = param::searchParam(LANG_PATH.$lang.LANG_EXT,"a_stats");
    $lang_a_statsAnalytics          = param::searchParam(LANG_PATH.$lang.LANG_EXT,"a_statsAnalytics");
    $lang_a_log                     = param::searchParam(LANG_PATH.$lang.LANG_EXT,"a_log");
    $lang_a_statsGeneral            = param::searchParam(LANG_PATH.$lang.LANG_EXT,"a_statsGeneral");

//menu déroulant du compte
$lang_connect                       = param::searchParam(LANG_PATH.$lang.LANG_EXT,"connect");
$lang_creatAccount                  = param::searchParam(LANG_PATH.$lang.LANG_EXT,"creatAccount");
$lang_resetPassword                 = param::searchParam(LANG_PATH.$lang.LANG_EXT,"resetPassword");
$lang_accountSettings               = param::searchParam(LANG_PATH.$lang.LANG_EXT,"accountSettings");
$lang_accountSettings               = param::searchParam(LANG_PATH.$lang.LANG_EXT,"accountSettings");

$lang_a                             = param::searchParam(LANG_PATH.$lang.LANG_EXT,"a");
$lang_accountProfil                 = param::searchParam(LANG_PATH.$lang.LANG_EXT,"accountProfil");
$lang_accountSignature              = param::searchParam(LANG_PATH.$lang.LANG_EXT,"accountSignature");
$lang_accountData                   = param::searchParam(LANG_PATH.$lang.LANG_EXT,"accountData");
$lang_a                             = param::searchParam(LANG_PATH.$lang.LANG_EXT,"a");
$lang_return                        = param::searchParam(LANG_PATH.$lang.LANG_EXT,"return");
$lang_disconnect                    = param::searchParam(LANG_PATH.$lang.LANG_EXT,"disconnect");

//information de compte
$lang_loginName                     = param::searchParam(LANG_PATH.$lang.LANG_EXT,"loginName");
$lang_nickName                      = param::searchParam(LANG_PATH.$lang.LANG_EXT,"nickName");
$lang_mail                          = param::searchParam(LANG_PATH.$lang.LANG_EXT,"mail");
$lang_newPassword                   = param::searchParam(LANG_PATH.$lang.LANG_EXT,"newPassword");
$lang_confirm                       = param::searchParam(LANG_PATH.$lang.LANG_EXT,"confirm");
$lang_oldPassword                   = param::searchParam(LANG_PATH.$lang.LANG_EXT,"oldPassword");
$lang_name                          = param::searchParam(LANG_PATH.$lang.LANG_EXT,"name");
$lang_lastName                      = param::searchParam(LANG_PATH.$lang.LANG_EXT,"lastName");
$lang_birthDate                     = param::searchParam(LANG_PATH.$lang.LANG_EXT,"birthDate");
$lang_deleteImg                     = param::searchParam(LANG_PATH.$lang.LANG_EXT,"deleteImg");
$lang_signature                     = param::searchParam(LANG_PATH.$lang.LANG_EXT,"signature");
$lang_currentSignature              = param::searchParam(LANG_PATH.$lang.LANG_EXT,"currentSignature");
$lang_overviewSignature             = param::searchParam(LANG_PATH.$lang.LANG_EXT,"overviewSignature");
$lang_avatar                        = param::searchParam(LANG_PATH.$lang.LANG_EXT,"avatar");
$lang_currentAvatar                 = param::searchParam(LANG_PATH.$lang.LANG_EXT,"currentAvatar");
$lang_overviewAvatar                = param::searchParam(LANG_PATH.$lang.LANG_EXT,"overviewAvatar");
$lang_send                          = param::searchParam(LANG_PATH.$lang.LANG_EXT,"send");


//logs
$lang_addContent                     = param::searchParam(LANG_PATH.$lang.LANG_EXT,"addContent");
$lang_date                           = param::searchParam(LANG_PATH.$lang.LANG_EXT,"date");
$lang_action                         = param::searchParam(LANG_PATH.$lang.LANG_EXT,"action");
$lang_Ip                             = param::searchParam(LANG_PATH.$lang.LANG_EXT,"ip");

//paramètre généraux de l'application
$lang_newAccount                    = param::searchParam(LANG_PATH.$lang.LANG_EXT,"newAccount");
$lang_defaultPassWord               = param::searchParam(LANG_PATH.$lang.LANG_EXT,"defaultPassword");
$lang_defaultGroup                  = param::searchParam(LANG_PATH.$lang.LANG_EXT,"defaultGroup");
$lang_defaultLang                   = param::searchParam(LANG_PATH.$lang.LANG_EXT,"defaultLang");
$lang_permitExt                     = param::searchParam(LANG_PATH.$lang.LANG_EXT,"permitExt");
$lang_extMIME                       = param::searchParam(LANG_PATH.$lang.LANG_EXT,"extMIME");
$lang_extIe                         = param::searchParam(LANG_PATH.$lang.LANG_EXT,"extIe");
$lang_extName                       = param::searchParam(LANG_PATH.$lang.LANG_EXT,"extName");
$lang_imagesParam                   = param::searchParam(LANG_PATH.$lang.LANG_EXT,"imagesParam");
$lang_signatureParam                = param::searchParam(LANG_PATH.$lang.LANG_EXT,"signatureParam");
$lang_avatarParam                   = param::searchParam(LANG_PATH.$lang.LANG_EXT,"avatarParam");
$lang_imageHeight                   = param::searchParam(LANG_PATH.$lang.LANG_EXT,"imageHeight");
$lang_imageWidth                    = param::searchParam(LANG_PATH.$lang.LANG_EXT,"imageWidth");
$lang_imagePath                     = param::searchParam(LANG_PATH.$lang.LANG_EXT,"imagePath");
$lang_noImage                       = param::searchParam(LANG_PATH.$lang.LANG_EXT,"noImage");
$lang_maxImageWeight                = param::searchParam(LANG_PATH.$lang.LANG_EXT,"maxImageWeight");
$lang_changeDefaultImage            = param::searchParam(LANG_PATH.$lang.LANG_EXT,"changeDefaultImage");

//paramètres de la base de donnée
$lang_dbType                        = param::searchParam(LANG_PATH.$lang.LANG_EXT,"dbType");
$lang_dbConnect                     = param::searchParam(LANG_PATH.$lang.LANG_EXT,"dbConnect");
$lang_dbHost                        = param::searchParam(LANG_PATH.$lang.LANG_EXT,"dbHost");
$lang_dbPort                        = param::searchParam(LANG_PATH.$lang.LANG_EXT,"dbPort");
$lang_dbUser                        = param::searchParam(LANG_PATH.$lang.LANG_EXT,"dbUser");
$lang_dbPassword                    = param::searchParam(LANG_PATH.$lang.LANG_EXT,"dbPassword");
$lang_dbName                        = param::searchParam(LANG_PATH.$lang.LANG_EXT,"dbName");

//message de verification des mots de passe
$lang_infoPassword                  = param::searchParam(LANG_PATH.$lang.LANG_EXT,"infoPassword");
$lang_infoPasswordLetter            = param::searchParam(LANG_PATH.$lang.LANG_EXT,"infoPasswordLetter");
$lang_infoPasswordUppercase         = param::searchParam(LANG_PATH.$lang.LANG_EXT,"infoPasswordUppercase");
$lang_infoPasswordNumber            = param::searchParam(LANG_PATH.$lang.LANG_EXT,"infoPasswordNumber");
$lang_infoPasswordSpecialChar       = param::searchParam(LANG_PATH.$lang.LANG_EXT,"infoPasswordSpecialChar");
$lang_infoPasswordNumberChar        = param::searchParam(LANG_PATH.$lang.LANG_EXT,"infoPasswordNumberChar");
$lang_infoPasswordSame              = param::searchParam(LANG_PATH.$lang.LANG_EXT,"infoPasswordSame");

//metat gestion de d'utilisateur et groupe
$lang_lstGroup                      = param::searchParam(LANG_PATH.$lang.LANG_EXT,"lstGroup");
$lang_lstUser                       = param::searchParam(LANG_PATH.$lang.LANG_EXT,"lstUser");
$lang_group                         = param::searchParam(LANG_PATH.$lang.LANG_EXT,"group");
$lang_addGroup                      = param::searchParam(LANG_PATH.$lang.LANG_EXT,"addGroup");
$lang_editGroup                     = param::searchParam(LANG_PATH.$lang.LANG_EXT,"editGroup");
$lang_status                        = param::searchParam(LANG_PATH.$lang.LANG_EXT,"status");
$lang_delete                        = param::searchParam(LANG_PATH.$lang.LANG_EXT,"delete");
$lang_plus                          = param::searchParam(LANG_PATH.$lang.LANG_EXT,"plus");
$lang_activate                      = param::searchParam(LANG_PATH.$lang.LANG_EXT,"activate");
$lang_deactivate                    = param::searchParam(LANG_PATH.$lang.LANG_EXT,"deactivate");
$lang_addUser                       = param::searchParam(LANG_PATH.$lang.LANG_EXT,"addUser");
$lang_editUser                      = param::searchParam(LANG_PATH.$lang.LANG_EXT,"editUser");
$lang_userConcerned                 = param::searchParam(LANG_PATH.$lang.LANG_EXT,"userConcerned");
$lang_cancel                        = param::searchParam(LANG_PATH.$lang.LANG_EXT,"cancel");
$lang_groupName                     = param::searchParam(LANG_PATH.$lang.LANG_EXT,"groupName");
$lang_access                        = param::searchParam(LANG_PATH.$lang.LANG_EXT,"access");
$lang_permission                    = param::searchParam(LANG_PATH.$lang.LANG_EXT,"permission");
$lang_content                       = param::searchParam(LANG_PATH.$lang.LANG_EXT,"content");
$lang_user                          = param::searchParam(LANG_PATH.$lang.LANG_EXT,"user");
$lang_yes                           = param::searchParam(LANG_PATH.$lang.LANG_EXT,"y");
$lang_no                            = param::searchParam(LANG_PATH.$lang.LANG_EXT,"n");
$lang_PermissionTab                 = param::searchParam(LANG_PATH.$lang.LANG_EXT,"PermissionTab");

//message d'erreur
$lang_errorMsg_connect              = param::searchParam(LANG_PATH.$lang.LANG_EXT,"errorMsg_connect");
$lang_errorMsg_disabledAccount      = param::searchParam(LANG_PATH.$lang.LANG_EXT,"errorMsg_disabledAccount");
$lang_errorMsg_date                 = param::searchParam(LANG_PATH.$lang.LANG_EXT,"errorMsg_date");
$lang_errorMsg_password             = param::searchParam(LANG_PATH.$lang.LANG_EXT,"errorMsg_password");
$lang_errorMsg_newPassword          = param::searchParam(LANG_PATH.$lang.LANG_EXT,"errorMsg_newPassword");
$lang_errorMsg_curentPassword       = param::searchParam(LANG_PATH.$lang.LANG_EXT,"errorMsg_curentPassword");
$lang_errorMsg_passwordComplexity   = param::searchParam(LANG_PATH.$lang.LANG_EXT,"errorMsg_passwordComplexity");
$lang_errorMsg_mail                 = param::searchParam(LANG_PATH.$lang.LANG_EXT,"errorMsg_mail");
$lang_errorMsg_loginName            = param::searchParam(LANG_PATH.$lang.LANG_EXT,"errorMsg_loginName");
$lang_errorMsg_existMail            = param::searchParam(LANG_PATH.$lang.LANG_EXT,"errorMsg_existMail");
$lang_errorMsg_size                 = param::searchParam(LANG_PATH.$lang.LANG_EXT,"errorMsg_size");
$lang_errorMsg_format               = param::searchParam(LANG_PATH.$lang.LANG_EXT,"errorMsg_format");
$lang_errorMsg_update               = param::searchParam(LANG_PATH.$lang.LANG_EXT,"errorMsg_update");
$lang_errorMsg_existGroup           = param::searchParam(LANG_PATH.$lang.LANG_EXT,"errorMsg_existGroup");
$lang_errorMsg_existGroupModify     = param::searchParam(LANG_PATH.$lang.LANG_EXT,"errorMsg_existGroupModify");
$lang_errorMsg_groupName            = param::searchParam(LANG_PATH.$lang.LANG_EXT,"errorMsg_groupName");
$lang_errorMsg_existUser            = param::searchParam(LANG_PATH.$lang.LANG_EXT,"errorMsg_existUser");

//message de réussite
$lang_successMsg_update             = param::searchParam(LANG_PATH.$lang.LANG_EXT,"successMsg_update");
$lang_successMsg_addUser            = param::searchParam(LANG_PATH.$lang.LANG_EXT,"successMsg_addUser");
$lang_successMsg_addGroup           = param::searchParam(LANG_PATH.$lang.LANG_EXT,"successMsg_addGroup");
$lang_successMsg_deleteGroup        = param::searchParam(LANG_PATH.$lang.LANG_EXT,"successMsg_deleteGroup");
$lang_successMsg_deleteUser         = param::searchParam(LANG_PATH.$lang.LANG_EXT,"successMsg_deleteUser");
$lang_successMsg_img                = param::searchParam(LANG_PATH.$lang.LANG_EXT,"successMsg_img");
$lang_successMsg_resetMailSend      = param::searchParam(LANG_PATH.$lang.LANG_EXT,"successMsg_resetMailSend");
$lang_successMsg_resetPassword      = param::searchParam(LANG_PATH.$lang.LANG_EXT,"successMsg_resetPassword");

//message de confirmation
$lang_confirmMsg_deleteGroup        = param::searchParam(LANG_PATH.$lang.LANG_EXT,"confirmMsg_deleteGroup");
$lang_confirmMsg_deleteUser         = param::searchParam(LANG_PATH.$lang.LANG_EXT,"confirmMsg_deleteUser");

//message d'info
$lang_infoMsg_deleteGroup           = param::searchParam(LANG_PATH.$lang.LANG_EXT,"infoMsg_deleteGroup");
$lang_infoMsg_defaultPassword1      = param::searchParam(LANG_PATH.$lang.LANG_EXT,"infoMsg_defaultPassword1");
$lang_infoMsg_defaultPassword2      = param::searchParam(LANG_PATH.$lang.LANG_EXT,"infoMsg_defaultPassword2");
$lang_infoMsg_defaultGroup1         = param::searchParam(LANG_PATH.$lang.LANG_EXT,"infoMsg_defaultGroup1");
$lang_infoMsg_defaultGroup2         = param::searchParam(LANG_PATH.$lang.LANG_EXT,"infoMsg_defaultGroup2");


