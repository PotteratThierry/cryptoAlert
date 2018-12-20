<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Lab4tech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Le styles -->
    <link href="../css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="../module/tableSorter/dist/css/theme.default.min.css" rel="stylesheet">
    <link href="../module/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">

    <!-- Le jquery -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <!-- les scrips personnel -->
    <script src="../js/main.js"></script>
    <script src="../js/ajax.js"></script>
    <script src="../js/passwordComplexity.js"></script>
    <script src="../js/loginNameFormat.js"></script>
    <script src="../js/mailFormat.js"></script>


    <!-- Tablesorter: required -->
    <link rel="stylesheet" href="../module/tableSorter/css/theme.bootstrap_4.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.1/js/jquery.tablesorter.js"></script>
    <script src="../module/tableSorter/js/jquery.tablesorter.widgets.js"></script>
    <!-- pager plugin -->
    <style>
        .tablesorter-pager .btn-group-sm .btn {
            font-size: 1.2em; /* make pager arrows more visible */
        }
    </style>

    <!-- les script table sorter -->
    <script src="../js/initTableSorter.js"></script

</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" role="navigation">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php echo $accueil;?>"><a class="nav-link" href="../index.php"><?php echo $lang_home;?></a></li>
                <li class="nav-item <?php echo $viewDb;?>"><a class="nav-link" href="../view/viewDb.php"><?php echo 'visualiser les utilisateurs';?></a></li>
                <?php if($userConnect->getConnect()){?><li class="nav-item <?php echo $lstWallet;?>"><a class="nav-link" href="../view/lstWallet.php"><?php echo 'gestion de mes wallets';?></a></li><?php }?>
                <?php if($userConnect->getConnect()){?><li class="nav-item <?php echo $alert;?>"><a class="nav-link" href="../view/lstAlert.php"><?php echo 'gestion de mes alertes';?></a></li><?php }?>
                <?php if($userConnect->getConnect()){?><li class="nav-item <?php echo $money;?>"><a class="nav-link" href="../view/lstMoney.php"><?php echo 'gestion des monnaies';?></a></li><?php }?>
                <?php if($userConnect->getConnect()){?><li class="nav-item <?php echo $majAlert;?>"><a class="nav-link" href="../view/majAlert.php"><?php echo 'maj des alertes';?></a></li><?php }?>
                <?php if($loginErrorMsg != ""){?><li><div class="alert alert-danger loginErrorMsg"><?php echo $loginErrorMsg;?></div></li><?php }?>
            </ul>
            <?php
            if(!$userConnect->getConnect())
            {
                ?>
                <div class="btn-group">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        connection
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <form class="form" role="form" method="post" action="<?php echo NAME_PAGE;?>">
                            <input type= "hidden" name= "<?php echo CONNECT;?>">
                            <input type= "hidden" name= "<?php echo PAGE;?>" value="<?php echo NAME_PAGE;?>">
                            <div class="form-group">
                                <input type="text" class="form-control loginMail" name="<?php echo NAME;?>" placeholder="<?php echo $lang_loginName;?>" />
                            </div>
                            <div class="form-group loginWindows">
                                <input type="password" class="form-control" name="<?php echo PASSWORD;?>" placeholder="<?php echo $lang_dbPassword ;?>" />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default btnLogin">Connection</button>
                            </div>
                            <div class="form-group">
                                <a class= "DisconnectText" href="../view/createAccount.php">Crée une compte</a>
                            </div>
                                <a class= "DisconnectText" href="../view/resetPassword.php">Mots de passe oublié</a>
                            </div>
                        </form>
                    </div>
                </div>
            <?php
            }
            else
            {?>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php if($userConnect->getLoginName() != ""){echo $userConnect->getLoginName();}else{echo 'connection';} ;?>
                    </button>
                    <form class="form" role="form" method="post" action="<?php echo NAME_PAGE;?>">
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item connectText" href="accountSettings.php"><?php echo $lang_accountSettings;?></a>
                            <a class="dropdown-item connectText" href="accountProfil.php"><?php echo $lang_accountProfil;?></a>
                            <a class="dropdown-item connectText" href="accountSignature.php"><?php echo $lang_accountSignature;?></a>
                            <a class="dropdown-item connectText" href="accountData.php"><?php echo $lang_accountData;?></a>
                            <?php if($adminAccess){?>
                                <div class="dropdown-divider"></div>
                                <a class="connectText" href="../view/admin.php"><?php echo $lang_admin;?></a>
                                <?php
                            }?>
                            <div class="dropdown-divider"></div>
                            <input id="disconnect" type="submit" value="<?php echo $lang_disconnect;?>">
                            <input type= "hidden" name= "<?php echo DISCONNECT;?>">
                            <input type= "hidden" name= "<?php echo PAGE;?>" value="<?php echo NAME_PAGE;?>">
                        </div>
                    </form>
                </div>
            <?php
            }?>
        </div><!--/.nav-collapse -->
</nav>

<div class="container-fluid customContainer">
    <div class="contentFixedTop"></div>