<?php
include_once "../controller/adminStatsLog_controller.php";
include_once "../templates/defaultTop-admin.php";
?>
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                    <li><a href="adminStats.php"><?php echo $lang_adminStats; ?></a></li>
                    <li><a href="adminStatsAnalytics.php"><?php echo $lang_adminStatsAnalytics; ?></a></li>
                    <li class="active"><a href="<?php echo NAME_PAGE;?>"><?php echo $lang_adminLog; ?></a><span class="sr-only">(current)</span></li>
                    <li><a href="adminStatsGeneral.php"><?php echo $lang_adminStatsGeneral; ?></a></li>
            </ul>
        </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <legende><?php echo $lang_adminLog;?></legende>
        <form class="form" role="form" method="post" action="<?php echo NAME_PAGE;?>">
            <button name="<?php echo LOG_DB;?>" value="<?php echo NAME;?>" type="submit"><span><?php echo "base de donnée";?></span></button>
            <button name="<?php echo LOG_CONNEXION;?>" value="<?php echo NAME;?>" type="submit"><span><?php echo "connexion";?></span></button>
            <button name="<?php echo LOG_CONTENT;?>" value="<?php echo NAME;?>" type="submit"><span><?php echo "d'ajout de contenu";?></span></button>
        </form>
        <?php if($db)
        {
            ?>
            <button class="group_reset">Reset Saved Collapsed Groups</button>
            <table class="table sorterTable">
                <thead>
                <tr>
                    <th class = "subMeta group-date-day"><?php echo 'date';?></th>
                    <th class = "subMeta"><?php echo $lang_dbName;?></th>
                    <th class = "subMeta"><?php echo $lang_user;?></th>
                    <th class = "subMeta"><?php echo 'action';?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($log_tab as $key=>$value)
                {
                    ?>
                    <tr>
                        <td> <?php echo $value[0];?></td>
                        <td> <?php echo $value[1];?></td>
                        <td> <?php echo $value[2];?></td>
                        <td> <?php echo $value[3];?></td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
            <?php
        }
        ?>
        <?php if($connexion)
        {
            ?>
            <button class="group_reset">Reset Saved Collapsed Groups</button>
            <table class="table sorterTable">
                <thead>
                <tr>
                    <th class = "subMeta group-date-day"><?php echo 'date';?></th>
                    <th class = "subMeta group-word"><?php echo 'adresse ip';?></th>
                    <th class = "subMeta group-word"><?php echo $lang_user;?></th>
                    <th class = "subMeta group-false"><?php echo 'action';?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($log_tab as $key=>$value)
                {
                    ?>
                    <tr>
                        <td> <?php echo $value[0];?></td>
                        <td> <?php echo $value[1];?></td>
                        <td> <?php echo $value[2];?></td>
                        <td> <?php echo $value[3];?></td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
            <?php
        }
        ?>
        <?php if($content)
        {
            ?>
            <?php
        }
        ?>

    </div>
<?php
include_once "../templates/defaultBottom-admin.php";
?>