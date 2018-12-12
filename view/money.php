<?php
include_once "../controller/money_controller.php";

include_once "../templates/defaultTop.php";
?>
    <form class="form" role="form" method="post" action="<?php echo NAME_PAGE; ?>">
        <button type="submit" class="btn btn-primary"><?php echo 'mise à jours des monnaies disponibles'; ?></button>
        <?php if ($errorMsg != "") { ?>
            <div class="alert alert-danger"><?php echo $errorMsg; ?></div><?php } ?>
        <?php if ($successMsg != "") { ?>
            <div class="alert alert-success"><?php echo $successMsg; ?></div><?php } ?>
        <input type="hidden" class="form-control" name="<?php echo MONEY_WALLET; ?>" value="" placeholder="chaine du wallet"/>
        <table id="money" class="table ">
            <thead>
            <tr>
                <th>
                    <?php echo 'id monnaies';?>
                </th>
                <th>
                    <?php echo 'logo';?>
                </th>
                <th>
                    <?php echo 'Nom';?>
                </th>
                <th>
                    <?php echo 'Code';?>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php
            if($tabMoney != array())
            {
                foreach ($tabMoney as $key=>$value)
                {
                    ?>
                    <tr>
                        <td><?php echo $key;?></td>
                        <td>
                            <?php ?><img class="logo16x16" onerror="this.src='../img/moneyDefault.png'" src="<?php echo 'https://raw.githubusercontent.com/dziungles/cryptocurrency-logos/master/coins/16x16/'.strtolower($value[COLUMN_MONEY_NAME]).'.png';?>">
                        </td>
                        <td><?php echo $value[COLUMN_MONEY_NAME];?></td>
                        <td><?php echo $value[COLUMN_MONEY_CODE];?></td>
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