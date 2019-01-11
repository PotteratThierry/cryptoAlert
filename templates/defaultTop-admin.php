<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title><?php echo $lang_title;?>h</title>
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
    <script src="../js/creatAccount_ajax.js"></script>
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
                  <li class="<?php echo $admin;?> nav-item "><a class="nav-link" href="admin.php"><?php echo $lang_admin?></a></li>
                  <li class="<?php echo $AccountManagement;?> nav-item "><a class="nav-link" href="../view/adminAccount.php"><?php echo $lang_accountManagement ?></a></li>
                  <li class="<?php echo $AppSettings;?> nav-item "><a class="nav-link" href="../view/adminSettings.php"><?php echo $lang_adminSettings ?></a></li>
                  <li class="<?php echo $AppStats;?> nav-item "><a class="nav-link" href="../view/adminStats.php"><?php echo $lang_adminStats ?></a></li>
                  <?php if(!$loginErrorMsg == ""){?> <li><div class="alert alert-danger"><?php echo $loginErrorMsg;?></div></li><?php }?>
              </ul>
              <?php
              if($contact->getConnect())
              {?>
                  <div class="btn-group">
                      <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <?php if($contact->getLoginName() != ""){echo $contact->getLoginName();}else{echo 'connection';} ;?>
                      </button>
                      <form class="form" role="form" method="post" action="<?php echo NAME_PAGE;?>">
                          <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item connectText" href="../view/accountSettings.php"><?php echo $lang_accountSettings;?></a>
                              <a class="dropdown-item connectText" href="../view/accountProfil.php"><?php echo $lang_accountProfil;?></a>
                              <a class="dropdown-item connectText" href="../view/accountSignature.php"><?php echo $lang_accountSignature;?></a>
                              <a class="dropdown-item connectText" href="../view/accountData.php"><?php echo $lang_accountData;?></a>
                              <?php if($accessLevel->getAdmin()){?>
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
    <div class="container-fluid">
        <div class="contentFixedTop"></div>