<?php
include_once "../controller/lstWallet_controller.php";

include_once "../templates/defaultTop.php";
?>
<form class="form" role="form" method="post" action="<?php echo NAME_PAGE; ?>">
    <button type="submit" class="btn btn-primary"><?php echo 'mise à jours des wallets sélectionné'; ?></button>
    <button type="submit" formaction="wallet.php" name="<?php echo NEW_WALLET; ?>"class="btn btn-warning"><?php echo 'ajouter un wallet'; ?></button>
    <button type="submit" name="<?php echo DELETE; ?>"class="btn btn-danger"><?php echo 'supprimer tout les wallets'; ?></button>
        <?php if ($errorMsg != "") { ?>
            <div class="alert alert-danger"><?php echo $errorMsg; ?></div><?php } ?>
        <?php if ($successMsg != "") { ?>
            <div class="alert alert-success"><?php echo $successMsg; ?></div><?php } ?>
        <input type="hidden" class="form-control" name="<?php echo MONEY_WALLET; ?>" value="" placeholder="chaine du wallet"/>
        <table id="wallets" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>
                    <?php echo 'nom du wallet';?>
                </th>
                <th>
                    <?php echo 'monnaie';?>
                </th>
                <th>
                    <?php echo 'clef';?>
                </th>
                <th>
                    <?php echo 'sold';?>
                </th>
                <th>
                    <?php echo 'valeur en '.$defaultCurrency;?>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php
            if($NewTabWallet != array())
            {
                foreach ($NewTabWallet as $key=>$value)
                {
                    ?>
                    <tr>
                        <td><?php echo $value[WALL_NAME];?></td>
                        <td>
                            <img class="logo16x16" onerror="this.src='../img/moneyDefault.png'" src="<?php echo 'https://raw.githubusercontent.com/dziungles/cryptocurrency-logos/master/coins/16x16/'.$value[WALL_LOGO].'.png';?>">
                            <?php echo ' '.$value[WALL_MONEY];?>
                        </td>
                        <td><?php echo $value[WALL_KEY];?></td>
                        <td><?php echo $value[WALL_BALANCE].' <b>'.$value[WALL_CODE].'</b>';?></td>
                        <td><?php echo $value[WALL_VALUE].' <b>'.$defaultCurrency;?></b></td>
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
