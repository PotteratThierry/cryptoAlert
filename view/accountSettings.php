<?php
include_once "../controller/accountSettings_controller.php";
if(isset($_SESSION[ADMIN]))
{
    include_once "../templates/defaultTop-admin.php";
}
else
{
    include_once "../templates/defaultTop.php";
}
?>
             <form class="form" role="form" method="post" action="../view/createAccount.php">
                 <input type= "hidden" name="<?php echo PAGE; ?>" value ="<?php echo NAME_PAGE;?>">
                 <div class="form-group">
                     <label><?php echo $lang_loginName;?></label>
                     <input id="loginName" type="text" class="form-control" name="<?php echo NEW_USER;?>" value="" placeholder="<?php echo $lang_loginName ;?>" />
                 </div>
                 <div id="login_format">
                     <ul>
                         <ol class="invalid"><?php echo $lang_errorMsg_loginName ;?></ol>
                     </ul>
                 </div>
                 <div id="login_info">
                     <ul>
                         <ol class="invalid"><?php echo $lang_errorMsg_existUser ;?></ol>
                     </ul>
                 </div>
                 <div class="form-group">
                     <label><?php echo $lang_mail ;?></label>
                     <input id="mail" type="email" class="form-control" name="<?php echo MAIL;?>" placeholder="<?php echo $lang_mail ;?>">
                 </div>
                 <div id="mail_format">
                     <ul>
                         <ol class="invalid"><?php echo $lang_errorMsg_mail ;?></ol>
                     </ul>
                 </div>
                 <div id="mail_info">
                     <ul>
                         <ol class="invalid"><?php echo $lang_errorMsg_existMail ;?></ol>
                     </ul>
                 </div>
                 <div class="form-group">
                     <label><?php echo $lang_dbPassword ;?></label>
                     <input type="password" class="form-control pswd" id="pswd" name="<?php echo PASSWORD_1;?>"  placeholder="<?php echo $lang_dbPassword ;?>">
                 </div>

                 <div class="form-group">
                     <label><?php echo $lang_confirm ;?></label>
                     <input type="password" class="form-control pswd" id="pswdRepeat" name="<?php echo PASSWORD_2;?>" placeholder="<?php echo $lang_confirm ;?>">
                 </div>
                 <div id="pswd_info">
                     <div id="pswd_info_title"><?php echo $lang_infoPassword ;?></div>
                     <ul>
                         <li id="letter" class="invalid"><?php echo $lang_infoPasswordLetter ;?></li>
                         <li id="capital" class="invalid"><?php echo $lang_infoPasswordUppercase ;?></li>
                         <li id="number" class="invalid"><?php echo $lang_infoPasswordNumber ;?></li>
                         <li id="length" class="invalid"><?php echo $lang_infoPasswordNumberChar ;?></li>
                         <li id="repeat" class="invalid"><?php echo $lang_infoPasswordSame ;?></li>
                     </ul>
                 </div>
                 <div class="form-group">
                     <label><?php echo $lang_oldPassword ;?></label>
                     <input type="password" class="form-control"  name="<?php echo PASSWORD;?>" placeholder="<?php echo $lang_oldPassword ;?>">
                 </div>
                 <input type= "hidden" name= "<?php echo OLD_LOGIN_NAME;?>" value ="<?php echo $oldLoginName;?>">
                 <button type="submit" class="btn btn-primary"><?php echo $lang_send ;?></button>
             </form>


            </form>

<?php
if(isset($_SESSION[ADMIN]))
{
    include_once "../templates/defaultBottom-admin.php";
}
else
{
    include_once "../templates/defaultBottom.php";
}