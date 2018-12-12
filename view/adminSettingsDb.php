<?php
include_once "../controller/adminSettingsDb_controller.php";
include_once "../templates/defaultTop-admin.php";
?>
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                    <li><a href="adminSettings.php"><?php echo $lang_adminSettings; ?></a></li>
                    <li><a href="adminSettingsGeneral.php"><?php echo $lang_adminSettingsGeneral; ?></a></li>
                    <li class="active"><a href="<?php echo NAME_PAGE;?>"><?php echo $lang_adminSettingsDB; ?></a><span class="sr-only">(current)</span></li>
                    <li><a href="adminSettingsTemplate.php"><?php echo $lang_adminSettingsTemplate; ?></a></li>
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <legend><?php echo $lang_adminSettingsDB;?></legend>
            <form class="form" role="form" method="post" action="<?php echo NAME_PAGE;?>">
                <button name="<?php echo VALID;?>"  type="submit" class="btn btn-default"><?php echo $lang_send;?></button>
                <table class="table">
                <thead>
                <tr>
                    <th><?php echo $lang_dbConnect; ?></th>
                </tr>
                </thead>
                <tbody>
                    <tr>

                    </tr>
                    <tr>
                        <td>
                            <label for="exampleInputEmail1"><?php echo $lang_dbHost; ?></label>
                            <input class="form-control"  type="text"  name="<?php echo DB_HOST;?>" value="<?php echo $p_dbHost;?>" placeholder=>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="exampleInputEmail1"><?php echo $lang_dbPort; ?></label>
                            <input class="form-control"  type="text"  name="<?php echo DB_PORT;?>" value="<?php echo $p_dbPort;?>" placeholder=>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="exampleInputEmail1"><?php echo $lang_dbUser; ?></label>
                            <input class="form-control"  type="text"  name="<?php echo DB_USER;?>" value="<?php echo $p_dbUser;?>" placeholder=>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="exampleInputEmail1"><?php echo $lang_dbPassword; ?></label>
                            <input class="form-control"  type="text"  name="<?php echo DB_PASSWORD;?>" value="<?php echo $p_dbPassword;?>" placeholder=>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="exampleInputEmail1"><?php echo $lang_dbName; ?></label>
                            <input class="form-control"  type="text"  name="<?php echo DB_NAME;?>" value="<?php echo $p_dbName;?>" placeholder=>
                        </td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
include_once "../templates/defaultBottom-admin.php";
?>