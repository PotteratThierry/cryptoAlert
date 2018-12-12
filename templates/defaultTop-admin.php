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
      <link href="../css/main.css" rel="stylesheet">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <link href="../module/tableSorter/dist/css/theme.default.min.css" rel="stylesheet">
      <link href="../module/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">


      <!-- Le jquery -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <!-- les scrips perso -->
      <script src="../js/main.js"></script>

      <!-- les script table sorter -->
      <script src="../js/initTableSorter.js"></script>
      <script src="../js/passwordComplexity.js"></script>

      <!-- Tablesorter: required -->
      <link rel="stylesheet" href="../module/tableSorter/css/theme.blue.css">
      <script src="../module/tableSorter/js/jquery.tablesorter.js"></script>
      <script src="../module/tableSorter/js/widgets/widget-storage.js"></script>
      <script src="../module/tableSorter/js/widgets/widget-filter.js"></script>

      <script src="../module/tableSorter/js/parsers/parser-input-select.js"></script>
      <script src="../module/tableSorter/js/parsers/parser-date-weekday.js"></script>
      <script src="../module/tableSorter/js/widgets/widget-grouping.js"></script>

  </head>
  <body>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" role="navigation">
      <div class="collapse navbar-collapse">
          <ul class="navbar-nav mr-auto">
                  <li class="<?php echo $admin;?> nav-item "><a class="nav-link" href="admin.php"><?php echo $lang_admin?></a></li>
                  <li class="<?php echo $AccountManagement;?> nav-item "><a class="nav-link" href="../view/adminAccount.php"><?php echo $lang_accountManagement ?></a></li>
                  <li class="<?php echo $AppSettings;?> nav-item "><a class="nav-link" href="../view/adminSettings.php"><?php echo $lang_adminSettings ?></a></li>
                  <li class="<?php echo $AppStats;?> nav-item "><a class="nav-link" href="../view/adminStats.php"><?php echo $lang_adminStats ?></a></li>
                  <?php if(!$loginErrorMsg == ""){?> <li><div class="alert alert-danger"><?php echo $loginErrorMsg;?></div></li><?php }?>
              </ul>
              <?php
              if($connect)
              {?>
                  <div class="btn-group">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <div class ="textlength <?php echo $accountMenu;?>"><?php echo $useNickname;?></div>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                          <form class="form" role="form" method="post" action="<?php echo NAME_PAGE;?>">
                              <a class="dropdown-item connectText" href="accountSettings.php"><?php echo $lang_accountSettings;?></a>
                              <a class="dropdown-item connectText" href="accountProfil.php"><?php echo $lang_accountProfil;?></a>
                              <a class="dropdown-item connectText" href="accountSignature.php"><?php echo $lang_accountSignature;?></a>
                              <div class="dropdown-divider"></div>
                              <?php if($adminAccess){?>
                                  <a class="dropdown-item connectText" href="../view/home.php"><?php echo $lang_return;?></a>
                                  <?php
                              }?>
                              <div class="dropdown-divider"></div>
                              <input class="connectText" id="disconnect" type="submit" value="<?php echo $lang_disconnect;?>">
                              <input type= "hidden" name= "<?php echo DISCONNECT;?>">
                              <input type= "hidden" name= "<?php echo PAGE;?>" value="<?php echo NAME_PAGE;?>">
                          </form>
                      </div>
                  </div>
              <?php
              }?>
      </div><!--/.nav-collapse -->
  </nav>
    <div class="container-fluid">
        <div class="contentFixedTop"></div>