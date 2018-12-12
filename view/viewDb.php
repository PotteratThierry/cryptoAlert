<?php
include_once "../controller/viewDb_controller.php";

include_once "../templates/defaultTop.php";
?>
<form class="form" role="form" method="post" action="<?php echo NAME_PAGE;?>">
    <legend>Utilisateurs</legend>
    <?php if($tabUser != array()){?><button type="submit" class="btn btn-danger" name="<?php echo DELETE ;?>">supprimer la base de donnée</button><?php } ?>
    <table class="table ">
        <thead>
        <tr>
            <th>
                id user
            </th>
            <th>
                <?php echo $lang_loginName;?>
            </th>
            <th>
                <?php echo $lang_mail;?>
            </th>
            <th>
                <?php echo $lang_dbPassword;?>
            </th>
            <th>
                <?php echo "utilisateur activé ?";?>
            </th>
            <th>
                <?php echo "clef d'activation";?>
            </th>
            <th>
                <?php echo "heure de création";?>
            </th>
            <th>
                <?php echo "clef de reset de mots de passe";?>
            </th>
            <th>
                <?php echo "heure de reinitialisation";?>
            </th>
            <th>
                <?php echo "wallet";?>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php
        if($tabUser != array())
        {
            foreach ($tabUser as $key=>$value)
            {
                ?>
                <tr>
                    <td><?php echo $value[COLUMN_ID];?></td>
                    <td><?php echo $value[COLUMN_USE_LOGIN_NAME];?></td>
                    <td><?php echo $value[COLUMN_USE_MAIL];?></td>
                    <td><?php echo $value[COLUMN_USE_PASSWORD];?></td>
                    <td><?php echo $value[COLUMN_USE_STATUS];?></td>
                    <td><?php echo $value[COLUMN_USE_ACTIVATION_KEY];?></td>
                    <td><?php echo $value[COLUMN_USE_CREAT_DATE];?></td>
                    <td><?php echo $value[COLUMN_USE_RESET_KEY];?></td>
                    <td><?php echo $value[COLUMN_USE_RESET_DATE];?></td>
                    <td><?php echo $value[COLUMN_USE_WALLET];?></td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>
</form>
<?php
include_once "../templates/defaultBottom.php";
?>