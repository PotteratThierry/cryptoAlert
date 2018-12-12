<?php
include_once "../controller/adminSettingsGeneral_controller.php";
include_once "../templates/defaultTop-admin.php";
?>
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                    <li><a href="adminSettings.php"><?php echo $lang_adminSettings; ?></a></li>
                    <li class="active"><a href="<?php echo NAME_PAGE;?>"><?php echo $lang_adminSettingsGeneral; ?></a><span class="sr-only">(current)</span></li>
                    <li><a href="adminSettingsDb.php"><?php echo $lang_adminSettingsDB; ?></a></li>
                    <li><a href="adminSettingsTemplate.php"><?php echo $lang_adminSettingsTemplate; ?></a></li>
            </ul>
        </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <legend><?php echo $lang_adminSettingsGeneral;?></legend>
            <form class="form" role="form" method="post" action="<?php echo NAME_PAGE;?>">
                <button name="<?php echo VALID;?>"  type="submit" class="btn btn-default"><?php echo $lang_send;?></button>
                <table class="table">
                <thead>
                <tr>
                    <th><?php echo $lang_defaultLang;?></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input class="form-control"  type="text"  name="<?php echo P_DEFAULT_LANG;?>" value="<?php echo $defaultLangage;?>" placeholder="<?php echo $lang_codeLang;?>"></td>
                    </tr>
                </tbody>
                </table>
                <table class="table">
                    <thead>
                    <tr>
                        <th><?php echo $lang_newAccount;?></th>
                    </tr>
                    </thead>
                </table>
                <table class="table">
                    <thead>
                    <tr>
                        <th class = "subMeta"><?php echo $lang_defaultPassWord;?></th>
                        <th class = "subMeta"><?php echo $lang_defaultGroup;?></th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td><input class="form-control"  type="text"  name="<?php echo P_DEFAULT_PASSWORD;?>" value="<?php echo $defaultPassWord;?>" placeholder="<?php echo $lang_defaultPassWord;?>"></td>

                        <td>
                            <select class="form-control" name="<?php echo P_DEFAULT_GROUP;?>">
                                <?php foreach($tabGroup as $groKey=>$groValue)
                                {
                                    ?>
                                    <option
                                        <?php if($defaultGroup == $groValue->getGroName())
                                        {
                                            echo "selected";
                                        }?>
                                        value="<?php echo $groValue->getGroName();?>"><?php echo $groValue->getGroName();?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    </tbody>
                    </table>
                <table class="table">
                    <thead>
                    <tr>
                        <th><?php echo $lang_imagesParam;?></th>
                    </tr>
                    </thead>
                </table>
                <table class="table">
                    <thead>
                    <tr>
                        <th class = "subMeta"><?php echo $lang_maxImageWeight;?></th>
                        <th class = "subMeta"><?php echo $lang_extName;?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <input type= "hidden" name= "<?php echo NB_EXT;?>" value ="<?php echo $nbExt;?>">
                    <?php foreach($tab_lstExt as $key=>$value)
                    {
                    ?>
                        <tr>
                            <?php
                            if($key == 0)
                            {
                                ?>

                                    <td><input class="form-control"  type="text"  name="<?php echo P_MAX_WEIGHT;?>" value="<?php echo $imageMaxWeight." ko";?>" placeholder="<?php echo $lang_maxImageWeight;?>"></td>
                                <?php
                            }
                            else
                            {
                                ?>
                                    <td></td>
                                <?php
                            }
                            ?>
                                    <td><input class="form-control"  type="text"  name="<?php echo P_LST_EXT.$key;?>" value="<?php echo $tab_lstExt[$key];?>" placeholder="<?php echo $lang_extMIME;?>"></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
                <table class="table">
                    <thead>
                    <tr>
                        <th><?php echo $lang_signatureParam;?></th>
                    </tr>
                    </thead>
                </table>
                <table class="table">
                    <thead>
                    <tr>
                        <th class = "subMeta"><?php echo $lang_imageHeight;?></th>
                        <th class = "subMeta"><?php echo $lang_imageWidth;?></th>
                        <th class = "subMeta"><?php echo $lang_imagePath;?></th>
                        <th class = "subMeta"><?php echo $lang_noImage;?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input class="form-control"  type="text"  name="<?php echo P_SIGNATURE_MAX_HEIGHT;?>" value="<?php echo $signatureMaxHeight;?>" placeholder="<?php echo $lang_imageHeight;?>"></td>
                        <td><input class="form-control"  type="text"  name="<?php echo P_SIGNATURE_MAX_WIDTH;?>" value="<?php echo $signatureMaxWidth;?>" placeholder="<?php echo $lang_imageWidth;?>"></td>
                        <td><input class="form-control"  type="text"  name="<?php echo P_SIGNATURE_PATH;?>" value="<?php echo $signaturePath;?>" placeholder="<?php echo $lang_imagePath;?>"></td>
                        <td><input class="form-control"  type="text"  name="<?php echo P_SIGNATURE_NO_IMAGE;?>" value="<?php echo $signatureNoImage;?>" placeholder="<?php echo $lang_noImage;?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><img src="<?php echo $signatureNoImagePrint;?>" class="account-img"</img></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><?php echo $lang_changeDefaultImage; ?></td>
                        <td><input type="file" id="idImage0" class="form-control image_file" name="<?php echo P_SIGNATURE_NEW_NO_IMAGE;?>" value="<?php echo $signatureNoImage;?>" ></td>
                    </tr>
                    </tbody>
                </table>
                <table class="table">
                    <thead>
                    <tr>
                        <th><?php echo $lang_avatarParam;?></th>
                    </tr>
                    </thead>
                </table>
                <table class="table">
                    <thead>
                    <tr>
                        <th class = "subMeta"><?php echo $lang_imageHeight;?></th>
                        <th class = "subMeta"><?php echo $lang_imageWidth;?></th>
                        <th class = "subMeta"><?php echo $lang_imagePath;?></th>
                        <th class = "subMeta"><?php echo $lang_noImage;?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input class="form-control"  type="text"  name="<?php echo P_AVATAR_MAX_HEIGHT;?>" value="<?php echo $avatarMaxHeight;?>" placeholder="<?php echo $lang_imageHeight;?>"></td>
                        <td><input class="form-control"  type="text"  name="<?php echo P_AVATAR_MAX_WIDTH;?>" value="<?php echo $avatarMaxWidth;?>" placeholder="<?php echo $lang_imageWidth;?>"></td>
                        <td><input class="form-control"  type="text"  name="<?php echo P_AVATAR_PATH;?>" value="<?php echo $avatarPath;?>" placeholder="<?php echo $lang_imagePath;?>"></td>
                        <td><input class="form-control"  type="text"  name="<?php echo P_AVATAR_NO_IMAGE;?>" value="<?php echo $avatarNoImage;?>" placeholder="<?php echo $lang_noImage;?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><img src="<?php echo $avatarNoImagePrint;?>" class="account-img"</img></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><?php echo $lang_changeDefaultImage; ?></td>
                        <td><input type="file" id="idImage0" class="form-control image_file" name="<?php echo P_AVATAR_NEW_NO_IMAGE;?>" value="<?php echo $signatureNoImage;?>" ></td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
<?php
include_once "../templates/defaultBottom-admin.php";
?>