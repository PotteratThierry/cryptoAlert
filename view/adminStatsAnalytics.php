<?php
include_once "../controller/adminStatsAnalytics_controller.php";
include_once "../templates/defaultTop-admin.php";
?>
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                    <li><a href="adminStats.php"><?php echo $lang_adminStats; ?></a></li>
                    <li class="active"><a href="<?php echo NAME_PAGE;?>"><?php echo $lang_adminStatsAnalytics; ?></a><span class="sr-only">(current)</span></li>
                    <li><a href="adminStatsLog.php"><?php echo $lang_adminLog; ?></a></li>
                    <li><a href="adminStatsGeneral.php"><?php echo $lang_adminStatsGeneral; ?></a></li>
            </ul>
        </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

            </div>
        </div>
    </div>
<?php
include_once "../templates/defaultBottom-admin.php";
?>