<?php
include_once "../controller/adminAccountUser_controller.php";
include_once "../templates/defaultTop-admin.php";
?>
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li><a href="adminAccount.php"><?php echo $lang_accountManagement; ?></a></li>
                <li class="active"><a href="<?php echo NAME_PAGE;?>"><?php echo $lang_adminAccountUser; ?></a><span class="sr-only">(current)</span></li>
                <li><a href="adminAccountGroup.php"><?php echo $lang_adminAccountGroup; ?></a></li>
                <li><a href="#"></a></li>
            </ul>
         </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

            <?php if($add)
            {
                ?>

                <form class="form" role="form" method="post" action="<?php echo NAME_PAGE;?>">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8">
                            <div class="alert alert-warning"><?php echo $lang_infoMsg_defaultPassword;?></div>
                            <div class="alert alert-warning"><?php echo $lang_infoMsg_defaultGroup;?></div>
                            <?php if($errorMsg != ""){?>
                                <div class="alert alert-danger"><?php echo $errorMsg;?></div><?php }?>
                            <div class="form-group">
                                <label><?php echo $lang_loginName;?></label>
                                <input type="text" class="form-control" name="<?php echo NICKNAME;?>" value="<?php echo $nickname;?>" placeholder="<?php echo $lang_loginName;?>" />
                            </div>
                            <div class="form-group">
                                <label><?php echo $lang_name?></label>
                                <input type="text" class="form-control" name="<?php echo NAME;?>" value="<?php echo $name;?>" placeholder="<?php echo $lang_name?>" />
                            </div>
                            <div class="form-group">
                                <label><?php echo $lang_lastName?></label>
                                <input type="text" class="form-control" name="<?php echo LAST_NAME;?>" value="<?php echo $lastName;?>" placeholder="<?php echo $lang_lastName?>" />
                            </div>
                            <div class="form-group">
                                <label><?php echo $lang_mail?></label>
                                <input type="email" class="form-control" name="<?php echo MAIL;?>" value="<?php echo $mail;?>" placeholder="<?php echo $lang_mail?>" />
                            </div>
                            <button name="<?php echo VALID_NEW_USER;?>" type="submit" class="btn btn-default"><?php echo $lang_send?></button>
                        </div>
                        <div class="col-md-2">
                        </div>
                    </div>
                </form>
            <?php
            }
            if($plus)
            {
                ?>
                <form class="form" role="form" method="post" action="<?php echo NAME_PAGE;?>">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8">
                            <?php if($errorMsg != ""){?>
                                <div class="alert alert-danger"><?php echo $errorMsg;?></div><?php }?>
                            <div class="form-group">
                                <label><?php echo $lang_nickname;?></label>
                                <input type="text" class="form-control" name="<?php echo NICKNAME;?>" value="<?php echo $nickname;?>" placeholder="<?php echo $lang_nickname;?>" />
                            </div>
                            <div class="form-group">
                                <label><?php echo $lang_name;?></label>
                                <input type="text" class="form-control" name="<?php echo NAME;?>" value="<?php echo $name;?>" placeholder="<?php echo $lang_name;?>" />
                            </div>
                            <div class="form-group">
                                <label><?php echo $lang_lastName;?></label>
                                <input type="text" class="form-control" name="<?php echo LAST_NAME;?>" value="<?php echo $lastName;?>" placeholder="<?php echo $lang_lastName;?>" />
                            </div>
                            <div class="form-group">
                                <label><?php echo $lang_birthDate;?></label>
                                <input type="date" max="2004-12-31" min="1920-01-01"class="form-control" name="<?php echo BIRTH_DATE;?>" value="<?php echo $birthDate;?>" placeholder="<?php echo $lang_birthDate;?>" />
                            </div>
                            <div class="form-group">
                                <label><?php echo $lang_mail;?></label>
                                <input type="email" class="form-control" name="<?php echo MAIL;?>" value="<?php echo $mail;?>" placeholder="<?php echo $lang_mail;?>" />
                            </div>
                            <input type= "hidden" name= "<?php echo ID_GROUP;?>" value ="<?php echo $status;?>">
                            <input type= "hidden" name= "<?php echo STATUS;?>" value ="<?php echo $idGroup;?>">
                            <button name="<?php echo VALID_PLUS;?>" value ="<?php echo $idUser;?>" type="submit" class="btn btn-default">Valider les modifications</button>
                        </div>
                        <div class="col-md-2">
                        </div>
                    </div>
                </form>
                <?php
            }
            if($plus == 0 && $add == 0)
            {?>
            <legend><?php echo $lang_lstUser;?></legend>
                <?php if($errorMsg != ""){?>
                <div class="alert alert-danger"><?php echo $errorMsg;?></div><?php }?>
                <?php if($successMsg != ""){?>
                <div class="alert alert-success"><?php echo $successMsg;?></div><?php }?>
                <table class="table ">
                    <thead>
                    <tr>
                        <th><?php echo $lang_nickname;?></th>
                        <th><?php echo $lang_name;?></th>
                        <th><?php echo $lang_lastName;?></th>
                        <th><?php echo $lang_mail;?></th>
                        <th><?php echo $lang_group;?></th>
                        <th><?php echo $lang_status;?></th>
                        <?php if($edit_user){?><th></th><?php }?>
                        <?php if($delete_user){?><th></th><?php }?>
                    </tr>
                    </thead>
                    <tbody>
                    <form class="form" role="form" method="post" action="<?php echo NAME_PAGE;?>">
                        <?php if($edit_user){?><button name="<?php echo VALID;?>" type="submit" class="btn btn btn-primary"><?php echo $lang_send;?></button><?php }?>
                        <?php if($new_user){?><button name="<?php echo NEW_USER;?>"  type="submit" class="btn btn btn-primary"><?php echo $lang_addUser;?></button><?php }?>
                        <?php foreach($tabUserDefault as $userKey=>$userValue)
                        {
                            ?>
                            <tr>
                                <td><input <?php echo $disabled;?> class="form-control gestionUserName"  type="text"  name="<?php echo NICKNAME.$userKey;?>" value="<?php echo $userValue->getUseNickname();?>"placeholder="<?php echo $lang_nickname;?>"></td>
                                <td><input <?php echo $disabled;?> class="form-control gestionUserName"  type="text" name="<?php echo NAME.$userKey;?>" value="<?php echo $userValue->getUseName();?>" placeholder="<?php echo $lang_name;?>"></td>
                                <td><input <?php echo $disabled;?> class="form-control gestionUserName"  type="text" name="<?php echo LAST_NAME.$userKey;?>" value="<?php echo $userValue->getUseLastName();?>" placeholder="<?php echo $lang_lastName;?>"></td>
                                <td><input <?php echo $disabled;?> class="form-control gestionUserMail"  type="text" name="<?php echo MAIL.$userKey;?>" value="<?php echo $userValue->getUseMail();?>" placeholder="<?php echo $lang_mail;?>"></td>
                                <td>
                                    <select <?php if($userConnected == $userValue->getUseMail()){ echo "disabled";}else{echo $disabled;}?> class="form-control" name="<?php echo ID_GROUP.$userKey;?>">
                                        <?php foreach($tabGroupDefault as $groKey=>$groValue)
                                        {
                                        ?>
                                            <option
                                                <?php if($userValue->getIdxGroup() == $groValue->getIdGroup())
                                                {
                                                    echo "selected";
                                                }?>
                                                value="<?php echo $groValue->getIdGroup();?>"><?php echo $groValue->getGroName();?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select <?php if($userConnected == $userValue->getUseMail()){ echo "disabled";}else{echo $disabled;}?> class="form-control droit droitUtilisateur" name="<?php echo STATUS.$userKey;?>">
                                        <option
                                            <?php if($userValue->getUseStatus())
                                            {
                                                $selectedOui = "selected";
                                                $selectedNon = "";
                                            }
                                            else
                                            {
                                                $selectedNon = "selected";
                                                $selectedOui = "";
                                            }
                                            echo '<option '.$selectedOui.' value="1" class="oui">'.$lang_activate.'</option>';
                                            echo '<option '.$selectedNon.' value="0" class="non">'.$lang_deactivate.'</option>';
                                            ?>
                                            </option>
                                    </select>
                                </td>
                                <?php if($edit_user){?><td><button name="<?php echo PLUS;?>" value="<?php echo $userValue->getIdUser(); ?>" type="submit"><span class="oi oi-pencil"></span></button></td><?php }?>
                                <?php if($delete_user){?><td><button name="<?php echo USER_DELETE;?>" value="<?php echo $userValue->getIdUser(); ?>"  <?php if($userConnected == $userValue->getUseMail()){ echo "disabled";}else{echo $disabled;}?> type="submit" onclick="return confirm('<?php echo $lang_confirmMsg_deleteUser;?>')"><span class="oi oi-trash"></span></button></td><?php }?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        <input type= "hidden" name= "<?php echo NB_USER;?>" value ="<?php echo $nbUser;?>">

                    </form>

                    </tbody>
                </table>
                <?php } ?>
        </div>
    </div>
<?php
include_once "../templates/defaultBottom.php";
?>