<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $lang_title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Le styles -->
    <link href="../module/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../module/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="../module/tableSorter/jquery.tablesorter.min.js"></script>
    <script type="text/javascript" src="../js/initTableSorrter.js"></script>
    <link href="../css/main.css" rel="stylesheet">
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
          <li class="<?php echo $accueil;?>"><a href="../index.php"><?php echo $lang_home;?></a></li>
          <li class="<?php echo $movie;?>"><a href="../view/customer.php"><?php echo $lang_movie;?></a></li>
          <li class="<?php echo $series;?>"><a href="../view/series.php"><?php echo $lang_series;?></a></li>
          <li class="<?php echo $music;?>"><a href="../view/music.php"><?php echo $lang_music;?></a></li>
          <li class="<?php echo $video;?>"><a href="../view/video.php"><?php echo $lang_video;?></a></li>
          <li class="<?php echo $forum;?>"><a href="../view/forum.php"><?php echo $lang_forum;?></a></li>
          <?php if($memberAccess){?>
              <li class="<?php echo $member;?>"><a href="../view/testMEMBRE.php">test page Membre</a></li>
          <?php
          }?>
          <?php if($moderatorAccess){?>
            <li class="<?php echo $moderator;?>"><a href="../view/testMODERATOR.php">test page modérateur</a></li>
          <?php
          }?>
           <?php if($loginErrorMsg != ""){?>
               <li><div class="alert alert-danger"><?php echo $loginErrorMsg;?></div></li><?php }?>
          </ul>
          <?php
          if(!$connect)
          {?>
          <div class="dropdown btn">
              <a data-toggle="dropdown" class= "btn-NoConnect glyphicon glyphicon-user btn btn-default " href="#"></a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
              <form class="form" role="form" method="post" action="<?php echo NAME_PAGE;?>">
                <div class="form-group">
                  <input type="text" class="form-control loginMail" name="<?php echo MAIL;?>" placeholder="<?php echo $lang_mail;?>" />
                </div>
                <div class="form-group">
                  <input type= "hidden" name= "<?php echo CONNECT;?>">
                 <input type= "hidden" name= "<?php echo PAGE;?>" value="<?php echo NAME_PAGE;?>">
                 <input type="password" class="form-control" name="<?php echo PASSWORD;?>" placeholder="mots de passe" />
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-default">Connection</button>
                </div>
                <div class="form-group">
                  <a href="registration.php">Crée une compte</a>
                </div>
                <div class="form-group">
                  <a href="LoosePassword.php.php">Mots de passe oublié</a>
                </div>
              </form>
             </ul>
           </div>

          <?php
          }
          else
          {?>
            <div class="dropdown menuConnect <?php echo $accountMenu;?>">
                <a data-toggle="dropdown" class= "btn-Connect glyphicon glyphicon-user  " href="#"><div class ="textlength <?php echo $accountMenu;?>"><?php echo $useNickname;?></div></a>
                <ul class="dorpDownCustom dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <form class="form-inline" role="form" method="post" action="<?php echo NAME_PAGE;?>">
                        <li class="divider"></li>
                        <li><a class="dropdownLink" href="accountSettings.php"><?php echo $lang_accountSettings;?></a></li>
                        <li><a class="dropdownLink" href="accountProfil.php"><?php echo $lang_accountProfil;?></a></li>
                        <li><a class="dropdownLink" href="accountSignature.php"><?php echo $lang_accountSignature;?></a></li>
                        <li class="divider"></li>
                        <?php if($adminAccess){?>
                          <li><a class="dropdownLink" href="../view/admin.php"><?php echo $lang_admin;?></a></li>
                          <li class="divider"></li>
                        <?php
                        }?>
                        <li><input class="dropdownLink" id="disconnect" type="submit" value="<?php echo $lang_disconnect;?>"></li>

                        <input type= "hidden" name= "<?php echo DISCONNECT;?>">
                        <input type= "hidden" name= "<?php echo PAGE;?>" value="<?php echo NAME_PAGE;?>">
                    </form>
                </ul>
            </div>
          <?php
          }?>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <div class="container main">