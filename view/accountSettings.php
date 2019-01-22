<?php
include_once "../controller/accountSettings_controller.php";
if($accessLevel->getAdmin())
{
    include_once "../templates/defaultTop-admin.php";
    ?><div class="container"><?php
}
else
{
    include_once "../templates/defaultTop.php";
}
?>

     <div class="row">
         <div class="col-sm-3 col-md-2 sidebar">

         </div>
         <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-1 main">
             <form class="form" role="form" method="post" action="<?php echo NAME_PAGE;?>">
                 <?php if($errorMsg != ""){?>
                     <div class="alert alert-danger"><?php echo $errorMsg;?></div><?php }?>
                 <?php if($successMsg != ""){?>
                     <div class="alert alert-success"><?php echo $successMsg;?></div><?php }?>
                 <div class="form-group">
                     <label><?php echo $lang_loginName ;?></label>
                     <input type="text" class="form-control" name="<?php echo LOGIN_NAME;?>" value="<?php echo $loginName?>" placeholder="Nom de login" />
                 </div>
                 <div class="form-group">
                     <label><?php echo $lang_mail ;?></label>
                     <input type="text" class="form-control" name="<?php echo MAIL;?>" value="<?php echo $mail?>" placeholder="Nom de login" />
                 </div>
                 <div class="form-group">
                     <label><?php echo $lang_newPassword ;?></label>
                     <input type="password" class="form-control pswd" id="pswd" name="<?php echo NEW_PASSWORD_1;?>"  placeholder="nouveau mots de passe">
                 </div>
                 <div class="form-group">
                     <label><?php echo $lang_confirm ;?></label>
                     <input type="password" class="form-control pswd" id="pswdRepeat" name="<?php echo NEW_PASSWORD_2;?>" placeholder="confirmation">
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
                 <button type="submit" class="btn btn-default"><?php echo $lang_send ;?></button>
            </form>
        </div>
    </div>


<?php
include_once "../templates/defaultBottom.php";
?>