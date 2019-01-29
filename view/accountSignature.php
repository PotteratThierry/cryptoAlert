<?php
include_once "../controller/accountSignature_controller.php";
if(isset($_SESSION[ADMIN]))
{
    include_once "../templates/defaultTop-admin.php";
}
else
{
    include_once "../templates/defaultTop.php";
}
?>
        <?php
        if($msgFormatError != "")
        {
            ?><div class="alert alert-danger hidden" id="msgFormatError1"><?php echo $msgFormatError;?></div><?php
        }
        if($avatarErrorMsg != "")
        {
            ?><div class="alert alert-danger"><?php echo $avatarErrorMsg;?></div><?php
        }?>
        <?php
        if($avatarSuccessMsg != "")
        {
            ?><div class="alert alert-success"><?php echo $avatarSuccessMsg;?></div><?php
        }?>
    </div>
    <form class="form" role="form" method="post" enctype="multipart/form-data" action="<?php echo NAME_PAGE;?>">
        <button type="submit" class="btn btn-primary"><?php echo $lang_send ;?></button>
        <legend><?php echo $lang_avatar; ?></legend>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $lang_currentAvatar; ?></label>
                </div>
                <div class="form-group">
                    <div class = "account-avatar">
                        <img src="<?php echo $avatar;?>" class="account-img"</img>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $lang_overviewAvatar; ?>:</label>
                </div>
                <div class="form-group">
                    <div class="account-avatar">
                        <img id="preveiw0" class= "imgUpload account-img">
                    </div>

                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-10">
                <div class="form-group">
                    <input type="checkbox" name="<?php echo DELETE_AVATAR;?>"><label><?php echo $lang_deleteImg?></label>
                </div>
                <div class="form-group">
                    <input type="file" id="idImage0" class="form-control image_file" name="<?php echo AVATAR;?>" value="<?php echo $avatar;?>"  />
                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-11">
                <legend><?php echo $lang_signature; ?></legend>
                <?php
                if($msgFormatError != "")
                {
                    ?><div class="alert alert-danger hidden" id="msgFormatError1"><?php echo $msgFormatError;?></div><?php
                }
                if($signatureErrorMsg != "")
                {
                    ?><div class="alert alert-danger"><?php echo $signatureErrorMsg;?></div><?php
                }?>
                <?php
                if($signatureSuccessMsg != "")
                {
                    ?><div class="alert alert-success"><?php echo $signatureSuccessMsg;?></div><?php
                }?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $lang_currentSignature; ?></label>
                </div>
                <div class="form-group">
                    <div class="account-signature">
                        <img src="<?php echo $signature;?>" class="account-img"</img>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $lang_overviewSignature; ?></label>
                </div>
                <div class="form-group">
                    <div class="account-signature">
                        <img id="preveiw1" class="imgUpload account-img">
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-10">
                <div class="form-group">
                    <input type="checkbox" name="<?php echo DELETE_SIGNATURE;?>"><label><?php echo $lang_deleteImg?></label>
                </div>
                <div class="form-group">
                    <input type="file" id="idImage1" class="form-control image_file" name="<?php echo SIGNATURE;?>" value="<?php echo $signature;?>"  />
                </div>
                <div class="form-group">
                </div>

            </div>
        </div>
    </form>
    <script src="../js/preveiw.js"></script>
<?php
if(isset($_SESSION[ADMIN]))
{
    include_once "../templates/defaultBottom-admin.php";
}
else
{
    include_once "../templates/defaultBottom.php";
}
?>