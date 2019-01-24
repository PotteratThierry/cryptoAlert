<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $lang_title;?>h</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <!--table sorter -->
    <link rel="stylesheet" href="../module/tableSorter/dist/css/theme.default.min.css" >
    <link rel="stylesheet" href="../module/tableSorter/css/theme.bootstrap_4.css">

    <!--Icons -->
    <link rel="stylesheet" href="../module/open-iconic/font/css/open-iconic-bootstrap.css">

    <!-- style personnel -->
    <link  rel="stylesheet" href="../css/main.css">
    <link href="../css/template.css" rel="stylesheet">

    <!-- Le jquery -->
    <script src="https://code.jquery.com/jquery.min.js"></script>

    <!-- les scrips personnel -->
    <script src="../js/main.js"></script>
    <script src="../js/creatAccount_ajax.js"></script>
    <script src="../js/passwordComplexity.js"></script>
    <script src="../js/loginNameFormat.js"></script>
    <script src="../js/mailFormat.js"></script>

    <!-- bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Table sorter -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.1/js/jquery.tablesorter.js"></script>
    <script src="../module/tableSorter/js/jquery.tablesorter.widgets.js"></script>
    <script src="../js/initTableSorter.js"></script



</head>
<body>
<nav class="navbar navbar-default navbar-expand-lg navbar-light MenuNav">
    <div class="navbar-header">
        <a class="navbar-brand" href="../index.php" >Crypto<b>Alert</b></a>
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle navbar-toggler ml-auto">
            <span class="navbar-toggler-icon"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
        <ul class="nav navbar-nav">
            <li class="nav-item"><a href="../view/home.php" class="nav-link <?php echo $accueil;?>"><?php echo $lang_home;?></a></li>
            <li class="nav-item dropdown">
                <a data-toggle="dropdown" class="nav-link dropdown-toggle <?php echo $lstWallet.$money.$alert.$majAlert;?>" href="#">Services <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <?php if($contact->getConnect()){?><li class="nav-item <?php echo $lstWallet;?>"><a class="nav-link" href="../view/lstWallet.php"><?php echo 'wallets';?></a></li><?php }?>
                    <?php if($contact->getConnect()){?><li class="nav-item <?php echo $money;?>"><a class="nav-link" href="../view/lstMoney.php"><?php echo 'monnaies';?></a></li><?php }?>
                    <?php if($contact->getConnect()){?><li class="nav-item <?php echo $alert;?>"><a class="nav-link" href="../view/lstAlert.php"><?php echo 'alertes';?></a></li><?php }?>
                    <?php if($contact->getConnect()){?><li class="nav-item <?php echo $majAlert;?>"><a class="nav-link" href="../view/majAlert.php"><?php echo 'maj alertes';?></a></li><?php }?>
                </ul>
            </li>
            <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
        </ul>
        <form class="navbar-form form-inline">
            <div class="input-group search-box">
                <input type="text" id="search" class="form-control" placeholder="Search here...">
                <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
            </div>
        </form>
        <ul class="nav navbar-nav navbar-right ml-auto">
            <li class="nav-item"><a href="#" class="nav-link notifications"><i class="fa fa-bell-o"></i><span class="badge">1</span></a></li>
            <li class="nav-item"><a href="#" class="nav-link messages"><i class="fa fa-envelope-o"></i><span class="badge">10</span></a></li>
            <?php
            if(!$contact->getConnect())
            {
                ?>
                <li class="nav-item">
                    <a data-toggle="dropdown" class="nav-link dropdown-toggle menuConnect" href="#">Connection</a>
                    <ul class="dropdown-menu form-wrapper loginFrame">
                        <li>
                            <form class="form" role="form" method="post" action="<?php echo NAME_PAGE;?>">
                                <input type= "hidden" name= "<?php echo CONNECT;?>">
                                <input type= "hidden" name= "<?php echo PAGE;?>" value="<?php echo NAME_PAGE;?>">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="<?php echo NAME;?>" placeholder="<?php echo $lang_loginName;?>" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="<?php echo PASSWORD;?>" placeholder="<?php echo $lang_dbPassword ;?>" required="required">
                                </div>
                                <input type="submit" class="btn btn-primary btn-block" value="connection">
                                <div class="form-footer">
                                    <a href="#">Mots de passe oublié ?</a>
                                </div>
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle get-started-btn mt-1 mb-1">crée un compte</a>
                    <ul class="dropdown-menu form-wrapper loginFrame">
                        <li>
                            <form class="form" role="form" method="post" action="../view/createAccount.php">
                                <button type="submit" class="btn btn-primary"><?php echo $lang_send ;?></button>
                                <input type= "hidden" name="<?php echo PAGE; ?>" value ="<?php echo NAME_PAGE;?>">
                                <div class="form-group">
                                    <label><?php echo $lang_loginName;?></label>
                                    <input id="loginName" type="text" class="form-control" name="<?php echo NEW_USER;?>" value="" placeholder="Nom de compte" />
                                </div>
                                <div id="login_format">
                                    <ul>
                                        <ol class="invalid"><?php echo $lang_errorMsg_loginName ;?></ol>
                                    </ul>
                                </div>
                                <div id="login_info">
                                    <ul>
                                        <ol class="invalid"><?php echo $lang_errorMsg_existUser ;?></ol>
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <label><?php echo $lang_mail ;?></label>
                                    <input id="mail" type="email" class="form-control" name="<?php echo MAIL;?>" placeholder="adresse mail">
                                </div>
                                <div id="mail_format">
                                    <ul>
                                        <ol class="invalid"><?php echo $lang_errorMsg_mail ;?></ol>
                                    </ul>
                                </div>
                                <div id="mail_info">
                                    <ul>
                                        <ol class="invalid"><?php echo $lang_errorMsg_existMail ;?></ol>
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <label><?php echo $lang_dbPassword ;?></label>
                                    <input type="password" class="form-control pswd" id="pswd" name="<?php echo PASSWORD_1;?>"  placeholder="Mots de passe">
                                </div>

                                <div class="form-group">
                                    <label><?php echo $lang_confirm ;?></label>
                                    <input type="password" class="form-control pswd" id="pswdRepeat" name="<?php echo PASSWORD_2;?>" placeholder="confirmation">
                                </div>
                                <div id="pswd_info">
                                    <div id="pswd_info_title"><?php echo $lang_infoPassword ;?></div>
                                    <ul>
                                        <li id="letter" class="invalid"><?php echo $lang_infoPasswordLetter ;?></li>
                                        <li id="capital" class="invalid"><?php echo $lang_infoPasswordUppercase ;?></li>
                                        <li id="number" class="invalid"><?php echo $lang_infoPasswordNumber ;?></li>
                                        <li id="length" class="invalid"><?php echo $lang_infoPasswordNumberChar ;?></li>
                                        <li id="repeat" class="invalid"><?php echo $lang_infoPasswordSame ;?></li>
                                    </ul>
                                </div>
                            </form>

                        </li>
                    </ul>
                </li>
                <?php
            }
            else
            {?>
                <li class="nav-item dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action">
                        <img src="<?php echo $avatar;?>" class="avatar" alt="Avatar">
                        <?php if($_SESSION[NICKNAME] != ""){echo $_SESSION[NICKNAME];}else{echo $_SESSION[LOGIN_NAME];} ;?>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu loginFrame">
                        <li><a href="../view/accountProfil.php" class="dropdown-item"><i class="fa fa-user-o"></i> <?php echo $lang_accountProfil;?></a></li>
                        <li><a href="../view/accountSettings.php" class="dropdown-item"><i class="fa fa-sliders"></i> <?php echo $lang_accountSettings;?></a></li>
                        <li><a href="../view/accountSignature.php" class="dropdown-item"><i class="fa fa-camera"></i> <?php echo $lang_accountSignature;?></a></li>
                        <li><a href="../view/accountData.php" class="dropdown-item"><i class="fa fa-file"></i> <?php echo $lang_accountData;?></a></li>
                        <?php if($accessLevel->getAdmin()){?>
                            <li class="divider dropdown-divider"></li>
                            <li><a href="../view/admin.php" class="dropdown-item"><i class="fa fa-cog"></i> <?php echo $lang_admin;?></a></li>
                            <?php
                        }?>
                        <li class="divider dropdown-divider"></li>
                        <li><a href="<?php echo NAME_PAGE ?>.?d" class="dropdown-item"><i class="material-icons">&#xE8AC;</i> <?php echo $lang_disconnect;?></a></li>
                    </ul>
                </li>
                <?php
            } ?>
        </ul>
    </div>
</nav>
<ul class="nav navbar-nav navbar-right ml-auto">
    <li class="nav-item">
        <?php if($errorMsg != ""){?><div class="alert alert-danger"><?php echo $errorMsg;?></div><?php }?>
    </li>
    <li class="nav-item">
        <?php if($successMsg != ""){?><div class="alert alert-success"><?php echo $successMsg;?></div><?php }?>
    </li>
</ul>
<div class="container-fluid">