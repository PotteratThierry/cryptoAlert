<?php
include_once "../controller/wallet_controller.php";

include_once "../templates/defaultTop.php";
?>
    <form class="form" role="form" method="post" action="<?php echo NAME_PAGE; ?>">
        <button type="submit" class="btn btn-primary"><?php echo 'ajouter le wallet à mon compte'; ?></button>
        <?php if ($errorMsg != "") { ?>
            <div class="alert alert-danger"><?php echo $errorMsg; ?></div><?php } ?>
        <?php if ($successMsg != "") { ?>
            <div class="alert alert-success"><?php echo $successMsg; ?></div><?php } ?>

        <div class="form-group">
            <label><?php echo 'nom du wallet'; ?></label>
            <input type="text" class="form-control" name="<?php echo WALL_NAME; ?>" value="" placeholder="nom du wallet"/>
            <label><?php echo 'chaine du wallet'; ?></label>
            <input type="text" class="form-control" name="<?php echo WALL_KEY; ?>" value="" placeholder="chain du wallet"/>
            <label><?php echo 'monnaies'; ?></label>
            <input type="text" class="form-control" name="<?php echo MONEY_WALLET; ?>" list="<?php echo MONEY_WALLET; ?>"/>
            <datalist id="<?php echo MONEY_WALLET; ?>">
                <label>
                    <select>
                        <option>#</option>
                        <?php foreach ($tabMoney as $key=>$value)
                        {
                            ?><option><?php echo $value[COLUMN_MONEY_NAME]." (".$value[COLUMN_MONEY_CODE].")" ;?></option><?php
                        }
                        ?>
                    </select>
                </label>
            </datalist>
        </div>
    </form>
<?php
include_once "../templates/defaultBottom.php";
?>