<?php
include_once "../controller/accountProfil_controller.php";
if(isset($_SESSION[ADMIN]))
{
include_once "../templates/defaultTop-admin.php";
    }
    else
    {
        include_once "../templates/defaultTop.php";
    }
?>
       <form class="form" role="form" method="post" action="<?php echo NAME_PAGE;?>">
                   <?php if($errorMsg != ""){?><div class="alert alert-danger"><?php echo $errorMsg;?></div><?php }?>
                   <?php if($successMsg != ""){?><div class="alert alert-success"><?php echo $successMsg;?></div><?php }?>
                   <div class="form-group">
                       <label for="exampleInputEmail1"><?php echo $lang_nickName ;?></label>
                       <input type="text" class="form-control" name="<?php echo NICKNAME;?>" value="<?php echo $nickName;?>" placeholder="<?php echo $lang_nickName;?>" />
                   </div>
                   <div class="form-group">
                       <label for="exampleInputEmail1"><?php echo $lang_name ;?></label>
                       <input type="text" class="form-control" name="<?php echo NAME;?>" value="<?php echo $name;?>" placeholder="<?php echo $lang_name;?>" />
                   </div>
                   <div class="form-group">
                       <label for="exampleInputEmail1"><?php echo $lang_lastName ;?></label>
                       <input type="text" class="form-control" name="<?php echo LAST_NAME;?>" value="<?php echo $lastName;?>" placeholder="<?php echo $lang_lastName;?>" />
                   </div>
                   <div class="form-group">
                       <label for="exampleInputEmail1"><?php echo $lang_birthDate ;?></label>
                       <input type="date" class="form-control" name="<?php echo BIRTH_DATE;?>" value="<?php echo $birthDate;?>" placeholder="<?php echo $lang_birthDate;?>" />
                   </div>
                    <button type="submit" class="btn btn-primary"><?php echo $lang_send ;?></button>
        </form>


<?php
if(isset($_SESSION[ADMIN]))
{
    include_once "../templates/defaultBottom-admin.php";
}
else
{
    include_once "../templates/defaultTop.php";
}

?>
