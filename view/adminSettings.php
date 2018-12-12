<?php
include_once "../controller/adminSettings_controller.php";
include_once "../templates/defaultTop-admin.php";
?>
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active"><a href="<?php echo NAME_PAGE;?>"><?php echo $lang_adminSettings; ?></a><span class="sr-only">(current)</span></li>
                <li><a href="adminSettingsGeneral.php"><?php echo $lang_adminSettingsGeneral; ?></a></li>
                <li><a href="adminSettingsDb.php"><?php echo $lang_adminSettingsDB; ?></a></li>
                <li><a href="adminSettingsTemplate.php"><?php echo $lang_adminSettingsTemplate; ?></a></li>
            </ul>
        </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    </div>
<?php
include_once "../templates/defaultBottom-admin.php";
?>