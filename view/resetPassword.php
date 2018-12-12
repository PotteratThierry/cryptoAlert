<?php
include_once "../controller/resetPassword_controller.php";

include_once "../templates/defaultTop.php";

if($dbConnected and !$resetPage)
{

    ?>
    <form class="form" role="form" method="post" action="<?php echo NAME_PAGE; ?>">
        <button type="submit" class="btn btn-primary"><?php echo 'envoyer mail de reinitialization'; ?></button>
        <?php if ($errorMsg != "") { ?>
            <div class="alert alert-danger"><?php echo $errorMsg; ?></div><?php } ?>
        <?php if ($successMsg != "") { ?>
            <div class="alert alert-success"><?php echo $successMsg; ?></div><?php } ?>

        <div class="form-group">
            <label><?php echo $lang_loginName; ?></label>
            <input type="text" class="form-control" name="<?php echo USER_RESET; ?>" value="" placeholder="Nom de compte"/>
        </div>
    </form>
    <?php
}
if($resetPage)
{
    ?>
    <form class="form" role="form" method="post" action="<?php echo NAME_PAGE; ?>">
        <?php if ($errorMsg != "") { ?>
            <div class="alert alert-danger"><?php echo $errorMsg; ?></div><?php } ?>
        <?php if ($successMsg != "") { ?>
            <div class="alert alert-success"><?php echo $successMsg; ?></div><?php } ?>
        <button type="submit" class="btn btn-primary"><?php echo 'réinitialiser le mots de passe'; ?></button>
        <input type="hidden" class="form-control" value="<?php echo $useId; ?>" name="<?php echo VALID_RESET; ?>"/>
        <div class="form-group">
                <label><?php echo $lang_dbPassword ;?></label>
                <input type="password" class="form-control pswd" id="pswd" name="<?php echo PASSWORD_1;?>"  placeholder="Mots de passe">
            </div>

            <div class="form-group">
                <label><?php echo $lang_confirm ;?></label>
                <input type="password" class="form-control pswd" id="pswdRepeat" name="<?php echo PASSWORD_2;?>" placeholder="confirmation">
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
    </form>
    <?php
}
if(!$dbConnected)
{
    ?><div class="alert alert-danger">Impossible de se connecté à la base de donnée<div><?php
}
?>

<?php
include_once "../templates/defaultBottom.php";
?>