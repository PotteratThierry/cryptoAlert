<?php
include_once "../controller/adminAccountGroup_controller.php";
include_once "../templates/defaultTop-admin.php";
?>
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                    <li><a href="adminAccount.php"><?php echo $lang_accountManagement; ?></a></li>
                    <li><a href="adminAccountUser.php"><?php echo $lang_adminAccountUser; ?></a></li>
                    <li class="active"><a href="<?php echo NAME_PAGE;?>"><?php echo $lang_adminAccountGroup; ?></a><span class="sr-only">(current)</span></li>
                    <li><a href="#"></a></li>
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <?php
            if($errorMsg != "")
            {?>
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <div class="alert alert-danger"><?php echo $lang_infoMsg_deleteGroup;?></label></div>
                    <form class="form" role="form" method="post" action="<?php echo NAME_PAGE;?>">
                        <input type= "hidden" name= "<?php echo ID_GROUP;?>" value ="<?php echo $idGroup;?>">
                        <label><?php echo "ajouter au groupe" ?></label>
                        <select class="form-control access" name="<?php echo ID_NEW_GROUP;?>">
                            <?php foreach($tabGroup as $key=>$value)
                            {
                                if($value->getIdGroup() != $_COOKIE[ID_GROUP])
                                {
                                    ?>
                                    <option value="<?php echo $value->getIdGroup();?>"><?php echo security::html($value->getGroName())?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <label><?php echo $lang_userConcerned ?></label>
                        <table class="table ">
                            <thead>
                            <tr>
                                <th><?php echo $lang_loginName; ?></th>
                                <th><?php echo $lang_name; ?></th>
                                <th><?php echo $lang_lastName; ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($lstUser as $key=>$value)
                            {
                            ?>
                                <tr>
                                    <td><label class="form-control"><?php echo $value->getUseNickname();?></td>
                                    <td><label class="form-control"><?php echo $value->getUseName();?></td>
                                    <td><label class="form-control"><?php echo $value->getUseLastName();?></td>
                                    <?php
                            }
                            ?>
                            </tbody>
                        </table>
                        <button name="<?php echo GROUP_CHANGE;?>" type="submit" class="btn btn btn-primary"><?php echo $lang_send; ?></button>
                        <button type="submit" class="btn btn btn-primary"><?php echo $lang_cancel; ?></button>
                    </form>
                </div>
                <div class="col-md-2">
                </div>
            </div>
            <?php
            }
            else
            {?>
                
                <?php if($addNewGroup)
            {
                ?>

                <form class="form" role="form" method="post" action="<?php echo NAME_PAGE;?>">
                <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                <?php if($errorMsg != ""){?>
                    <div class="alert alert-danger"><?php echo $errorMsg;?></div><?php }?>
                <table>
                <thead>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <label><?php echo $lang_groupName; ?></label>
                        <input type="text" class="form-control newGroup" name="<?php echo GROUP_NAME;?>" placeholder="Nom du groupe" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label><?php echo $lang_access; ?></label>
                        <select class="form-control access" name="<?php echo ACCESS;?>">
                            <?php foreach($lang_permission as $aKey=>$aValue)
                            {
                                ?>
                                <option
                                    <?php if($aValue == $access)
                                    {
                                        echo "selected";
                                    }?>
                                    value="<?php echo $aValue;?>"><?php echo security::html($aValue)?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="groupeMenu"><?php echo $lang_content;?></th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <span class="oi oi-plus"></span>
                            <select class="form-control droit droitGroupe" name="<?php echo ADD;?>">
                                <?php if($add)
                                {
                                    echo '<option selected value="1" class="oui">oui</option>';
                                    echo '<option  value="0" class="non">non</option>';
                                }
                                else
                                {
                                    echo '<option  value="1" class="oui">oui</option>';
                                    echo '<option selected value="0" class="non">non</option>';
                                }?>
                            </select>
                        </td>
                        <td>
                            <span class="oi oi-pencil"></span>
                            <select class="form-control droit droitGroupe" name="<?php echo EDIT;?>">
                                <?php if($edit)
                                {
                                    echo '<option selected value="1" class="oui">oui</option>';
                                    echo '<option  value="0" class="non">non</option>';
                                }
                                else
                                {
                                    echo '<option  value="1" class="oui">oui</option>';
                                    echo '<option selected value="0" class="non">non</option>';
                                }?>
                            </select>
                        </td>
                        <td>
                            <span class="oi oi-trash"></span>
                            <select class="form-control droit droitGroupe" name="<?php echo DELETE;?>">
                                <?php if($delete)
                                {
                                    echo '<option selected value="1" class="oui">oui</option>';
                                    echo '<option  value="0" class="non">non</option>';
                                }
                                else
                                {
                                    echo '<option  value="1" class="oui">oui</option>';
                                    echo '<option selected value="0" class="non">non</option>';
                                }?>
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="groupeMenu"><?php echo $lang_group;?></th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <span class="oi oi-plus"></span>
                            <select class="form-control droit droitGroupe" name="<?php echo ADD_GROUP;?>">
                                <?php if($addGroup)
                                {
                                    echo '<option selected value="1" class="oui">oui</option>';
                                    echo '<option  value="0" class="non">non</option>';
                                }
                                else
                                {
                                    echo '<option  value="1" class="oui">oui</option>';
                                    echo '<option selected value="0" class="non">non</option>';
                                }?>
                            </select>
                        </td>
                        <td>
                            <span class="oi oi-pencil"></span>
                            <select class="form-control droit droitGroupe" name="<?php echo EDIT_GROUP;?>">
                                <?php if($editGroup)
                                {
                                    echo '<option selected value="1" class="oui">oui</option>';
                                    echo '<option  value="0" class="non">non</option>';
                                }
                                else
                                {
                                    echo '<option  value="1" class="oui">oui</option>';
                                    echo '<option selected value="0" class="non">non</option>';
                                }?>
                            </select>
                        </td>
                        <td>
                            <span class="oi oi-trash"></span>
                            <select class="form-control droit droitGroupe" name="<?php echo DELETE_GROUP;?>">
                                <?php if($deleteGroup)
                                {
                                    echo '<option selected value="1" class="oui">oui</option>';
                                    echo '<option  value="0" class="non">non</option>';
                                }
                                else
                                {
                                    echo '<option  value="1" class="oui">oui</option>';
                                    echo '<option selected value="0" class="non">non</option>';
                                }?>
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="groupeMenu"><?php echo $lang_user;?></th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <span class="oi oi-plus"></span>
                            <select class="form-control droit droitGroupe" name="<?php echo ADD_USER;?>">
                                <?php if($addUser)
                                {
                                    echo '<option selected value="1" class="oui">oui</option>';
                                    echo '<option  value="0" class="non">non</option>';
                                }
                                else
                                {
                                    echo '<option  value="1" class="oui">oui</option>';
                                    echo '<option selected value="0" class="non">non</option>';
                                }?>
                            </select>
                        </td>
                        <td>
                            <span class="oi oi-pencil"></span>
                            <select class="form-control droit droitGroupe" name="<?php echo EDIT_USER;?>">
                                <?php if($editUser)
                                {
                                    echo '<option selected value="1" class="oui">oui</option>';
                                    echo '<option  value="0" class="non">non</option>';
                                }
                                else
                                {
                                    echo '<option  value="1" class="oui">oui</option>';
                                    echo '<option selected value="0" class="non">non</option>';
                                }?>
                            </select>
                        </td>
                        <td>
                            <span class="oi oi-trash"></span>
                            <select class="form-control droit droitGroupe" name="<?php echo DELETE_USER;?>">
                                <?php if($deleteUser)
                                {
                                    echo '<option selected value="1" class="oui">oui</option>';
                                    echo '<option  value="0" class="non">non</option>';
                                }
                                else
                                {
                                    echo '<option  value="1" class="oui">oui</option>';
                                    echo '<option selected value="0" class="non">non</option>';
                                }?>
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </table>
                <div class="col-md-2">
                    <button name="<?php echo VALID_NEW_GROUP;?>" type="submit" class="btn btn btn-primary"><?php echo $lang_send;?></button>
                </div>
                </div>
                </form>
            <?php
            }
            else
            {
                ?>
                <legend><?php echo $lang_lstGroup;?></legend>
                <?php if($successMsg != ""){?>
                    <div class="alert alert-success"><?php echo $lang_successMsg_update;?></div><?php }?>
                <form class="form" role="form" method="post" action="<?php echo NAME_PAGE;?>">
                <?php if($edit_group){?><button name="<?php echo VALID;?>" type="submit" class="btn btn btn-primary"><?php echo $lang_send;?></button><?php }?>
                <?php if($new_group){?><button name="<?php echo NEW_GROUP;?>" type="submit" class="btn btn btn-primary"><?php echo $lang_addGroup;?></button><?php }?>
                <input type= "hidden" name= "<?php echo NB_GROUP;?>" value ="<?php echo $nbGroup;?>">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="groupeMenuFirstChild"></th>
                        <th class="groupeMenu"><?php echo $lang_content;?></th>
                        <th class="groupeMenu"><?php echo $lang_group;?></th>
                        <th class="groupeMenu"><?php echo $lang_user;?></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <table class="table">
                <thead>
                <tr>
                    <th><?php echo $lang_name;?></th>
                    <th><?php echo $lang_access;?></th>
                    <th><span class="oi oi-plus"></span></th>
                    <th><span class="oi oi-pencil"></span></th>
                    <th><span class="oi oi-trash"></span></th>

                    <th><span class="oi oi-plus"></span></th>
                    <th><span class="oi oi-pencil"></span></th>
                    <th><span class="oi oi-trash"></span></th>

                    <th><span class="oi oi-plus"></span></th>
                    <th><span class="oi oi-pencil"></span></th>
                    <th><span class="oi oi-trash"></span></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if($disabled != "")
                {
                    $allDisable = 1;
                }
                foreach($tabGroup as $groKey=>$groValue)
                {
                    ?><input type= "hidden" name= "<?php echo ID_GROUP.$groKey;?>" value ="<?php echo $groValue->getIdGroup();?>"><?php
                    //bloque le groupe de l'utilisateur connecté afin d'éviter les erreur: comme je suis co à l'admin et je me retire le droit d'y être"
                    if(!$allDisable)
                    {
                        if($groValue->getGroName() == $groName)
                        {
                            $disabled = "disabled";
                        }
                        else
                        {
                            $disabled = "";
                        }
                    }

                    ?>
                    <tr>
                        <td><input <?php if($allDisable){ echo $disabled;}?> type="text" class="form-control groupe" name="<?php echo GROUP_NAME.$groKey;?>" value="<?php echo $groValue->getGroName();?>" placeholder="<?php echo $lang_groupName; ?>" /></td>
                        <td>
                            <select <?php echo $disabled;?> class="form-control access" name="<?php echo ACCESS.$groKey;?>">
                                <?php foreach($lang_permission as $aKey=>$aValue)
                                {
                                    ?>
                                    <option
                                        <?php if($tabPermission[$groKey][ACCESS] == $aKey)
                                        {
                                            echo "selected";
                                        }?>
                                        value="<?php echo $aKey;?>"><?php echo $aValue?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>

                        <td>
                            <select <?php echo $disabled;?> class="form-control droit droitGroupe" name="<?php echo ADD.$groKey;?>">
                                <?php if($tabPermission[$groKey][ADD])
                                {
                                    $selectedOui = "selected";
                                    $selectedNon = "";

                                }
                                else
                                {
                                    $selectedNon = "selected";
                                    $selectedOui = "";
                                }
                                echo '<option '.$selectedOui.' value="1" class="oui">'.$lang_yes.'</option>';
                                echo '<option '.$selectedNon.' value="0" class="non">'.$lang_no.'</option>';
                                ?>
                            </select>
                        </td>
                        <td>
                            <select <?php echo $disabled;?> class="form-control droit droitGroupe" name="<?php echo EDIT.$groKey;?>">
                                <?php if($tabPermission[$groKey][EDIT])
                                {
                                    $selectedOui = "selected";
                                    $selectedNon = "";

                                }
                                else
                                {
                                    $selectedNon = "selected";
                                    $selectedOui = "";
                                }
                                echo '<option '.$selectedOui.' value="1" class="oui">'.$lang_yes.'</option>';
                                echo '<option '.$selectedNon.' value="0" class="non">'.$lang_no.'</option>';
                                ?>
                            </select>
                        </td>
                        <td>
                            <select <?php echo $disabled;?> class="form-control droit droitGroupe" name="<?php echo DELETE.$groKey;?>">
                                <option
                                <?php if($tabPermission[$groKey][DELETE])
                                {
                                    $selectedOui = "selected";
                                    $selectedNon = "";

                                }
                                else
                                {
                                    $selectedNon = "selected";
                                    $selectedOui = "";
                                }
                                echo '<option '.$selectedOui.' value="1" class="oui">'.$lang_yes.'</option>';
                                echo '<option '.$selectedNon.' value="0" class="non">'.$lang_no.'</option>';
                                ?>
                            </select>
                        </td>

                        <td>
                            <select <?php echo $disabled;?> class="form-control droit droitGroupe" name="<?php echo ADD_GROUP.$groKey;?>">
                                <option
                                <?php if($tabPermission[$groKey][ADD_GROUP])
                                {
                                    $selectedOui = "selected";
                                    $selectedNon = "";

                                }
                                else
                                {
                                    $selectedNon = "selected";
                                    $selectedOui = "";
                                }
                                echo '<option '.$selectedOui.' value="1" class="oui">'.$lang_yes.'</option>';
                                echo '<option '.$selectedNon.' value="0" class="non">'.$lang_no.'</option>';
                                ?>
                            </select>
                        </td>
                        <td>
                            <select <?php echo $disabled;?> class="form-control droit droitGroupe" name="<?php echo EDIT_GROUP.$groKey;?>">
                                <option
                                <?php if($tabPermission[$groKey][EDIT_GROUP])
                                {
                                    $selectedOui = "selected";
                                    $selectedNon = "";

                                }
                                else
                                {
                                    $selectedNon = "selected";
                                    $selectedOui = "";
                                }
                                echo '<option '.$selectedOui.' value="1" class="oui">'.$lang_yes.'</option>';
                                echo '<option '.$selectedNon.' value="0" class="non">'.$lang_no.'</option>';
                                ?>
                            </select>
                        </td>
                        <td>
                            <select <?php echo $disabled;?> class="form-control droit droitGroupe" name="<?php echo DELETE_GROUP.$groKey;?>">
                                <option
                                <?php if($tabPermission[$groKey][DELETE_GROUP])
                                {
                                    $selectedOui = "selected";
                                    $selectedNon = "";

                                }
                                else
                                {
                                    $selectedNon = "selected";
                                    $selectedOui = "";
                                }
                                echo '<option '.$selectedOui.' value="1" class="oui">'.$lang_yes.'</option>';
                                echo '<option '.$selectedNon.' value="0" class="non">'.$lang_no.'</option>';
                                ?>
                            </select>
                        </td>

                        <td>
                            <select <?php echo $disabled;?> class="form-control droit droitGroupe" name="<?php echo ADD_USER.$groKey;?>">
                                <option
                                <?php if($tabPermission[$groKey][ADD_USER])
                                {
                                    $selectedOui = "selected";
                                    $selectedNon = "";

                                }
                                else
                                {
                                    $selectedNon = "selected";
                                    $selectedOui = "";
                                }
                                echo '<option '.$selectedOui.' value="1" class="oui">'.$lang_yes.'</option>';
                                echo '<option '.$selectedNon.' value="0" class="non">'.$lang_no.'</option>';
                                ?>
                            </select>
                        </td>
                        <td>
                            <select <?php echo $disabled;?> class="form-control droit droitGroupe" name="<?php echo EDIT_USER.$groKey;?>">
                                <option
                                <?php if($tabPermission[$groKey][EDIT_USER])
                                {
                                    $selectedOui = "selected";
                                    $selectedNon = "";

                                }
                                else
                                {
                                    $selectedNon = "selected";
                                    $selectedOui = "";
                                }
                                echo '<option '.$selectedOui.' value="1" class="oui">'.$lang_yes.'</option>';
                                echo '<option '.$selectedNon.' value="0" class="non">'.$lang_no.'</option>';
                                ?>
                            </select>
                        </td>

                        <td>
                            <select <?php echo $disabled;?> class="form-control droit droitGroupe" name="<?php echo DELETE_USER.$groKey;?>">
                                <option
                                <?php if($tabPermission[$groKey][DELETE_USER])
                                {
                                    $selectedOui = "selected";
                                    $selectedNon = "";

                                }
                                else
                                {
                                    $selectedNon = "selected";
                                    $selectedOui = "";
                                }
                                echo '<option '.$selectedOui.' value="1" class="oui">'.$lang_yes.'</option>';
                                echo '<option '.$selectedNon.' value="0" class="non">'.$lang_no.'</option>';
                                ?>
                            </select>
                        </td>
                        <?php if($delete_group){?><td><button name="<?php echo GROUP_DELETE;?>" value="<?php echo $groValue->getIdGroup(); ?>"  <?php if($groName == $groValue->getGroName()){ echo "disabled";}else{echo $disabled;}?> type="submit" onclick="return confirm('<?php echo $lang_confirmMsg_deleteGroup;?>')"><span class="oi oi-trash"></span></span></button></td><?php }?>
                    </tr>
                <?php
                }
                ?>

                </tbody>
                </table>
                </form>
                </div>
            <?php
            }
        }?>
        </div>
    </div>

<?php
include_once "../templates/defaultBottom-admin.php";
?>