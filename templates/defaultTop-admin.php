
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
    <link rel="stylesheet" href="../css/template.css" >
    <link  rel="stylesheet" href="../css/main.css">

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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>



    <!-- Table sorter -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.1/js/jquery.tablesorter.js"></script>
    <script src="../module/tableSorter/js/jquery.tablesorter.widgets.js"></script>
    <script src="../js/initTableSorter.js"></script



</head>
<body>
<div class=" fixed-top ">
    <div class="container-fluid container-sm">
        <nav class="navbar navbar-default navbar-expand-lg navbar-light MenuNav admin">
            <div class="navbar-header">
                <a class="navbar-brand col-sm-3 col-md-2 mr-0"" href="../view/a.php" >Crypto<b>Alert</b></a>
                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle navbar-toggler ml-auto">
                    <span class="navbar-toggler-icon"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Collection of nav links, forms, and other content for toggling -->
            <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start admin mobilMargin">
                <ul class="nav navbar-nav">
                </ul>
                <form class="navbar-form form-inline">
                    <div class="input-group search-box">
                        <input type="text" id="search" class="form-control form-control-dark w-100" placeholder="Search here...">
                        <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
                    </div>
                </form>
                <ul class="nav navbar-nav navbar-right ml-auto">
                    <li class="nav-item"><a href="#" class="nav-link notifications"><i class="fa fa-bell-o"></i><span class="badge">1</span></a></li>
                    <li class="nav-item"><a href="#" class="nav-link messages"><i class="fa fa-envelope-o"></i><span class="badge">10</span></a></li>
                    <?php
                    if($contact->getConnect())
                    { ?>
                        <li class="nav-item dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action">
                                <img src="<?php echo $avatar;?>" class="avatar" alt="Avatar">
                                <?php if($_SESSION[NICKNAME] != ""){echo $_SESSION[NICKNAME];}else{echo $_SESSION[LOGIN_NAME];} ;?>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu loginFrame admin">
                                <li><a href="../view/accountProfil.php" class="dropdown-item"><i class="fa fa-user-o"></i> <?php echo $lang_accountProfil;?></a></li>
                                <li><a href="../view/accountSettings.php" class="dropdown-item"><i class="fa fa-sliders"></i> <?php echo $lang_accountSettings;?></a></li>
                                <li><a href="../view/accountSignature.php" class="dropdown-item"><i class="fa fa-camera"></i> <?php echo $lang_accountSignature;?></a></li>
                                <li><a href="../view/accountData.php" class="dropdown-item"><i class="fa fa-file"></i> <?php echo $lang_accountData;?></a></li>
                                <?php if($accessLevel->getAdmin())
                                {?>
                                    <div class="dropdown-divider"></div>
                                    <li><a href="../view/home.php" class="dropdown-item"><i class="fa fa-cog"></i> <?php echo $lang_return;?></a></li>

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
    </div>
</div>
<div class="container-fluid">
    <div class="container">
        <ul class="nav navbar-nav navbar-right ml-auto">
            <li class="nav-item">
                <?php if($errorMsg != ""){?><div class="alert alert-danger"><?php echo $errorMsg;?></div><?php }?>
            </li>
            <li class="nav-item">
                <?php if($successMsg != ""){?><div class="alert alert-success"><?php echo $successMsg;?></div><?php }?>
            </li>
        </ul>
    </div>
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $a; ?>" href="../view/a.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            administration <span class="sr-only">(current)</span>
                        </a>
                    </li>
                </ul>
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Gestion des comptes</span>
                    <a class="d-flex align-items-center text-muted" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"></svg>
                    </a>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $a_lstUser; ?>" href="../view/a_userLst.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            gestion des utilisateurs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $a_lstGroup; ?>" href="../view/a_groupLst.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            gestion des groupes
                        </a>
                    </li>
                </ul>
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Statistiques</span>
                    <a class="d-flex align-items-center text-muted" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"></svg>
                    </a>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $a_statsAnalytics; ?>" href="../view/a_statsAnalytics.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            Google analytics
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $a_statsGeneral; ?>" href="../view/a_statsGeneral.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            stats généraux
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $a_statsLog; ?>" href="../view/a_statsLog.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            logs
                        </a>
                    </li>
                </ul>
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>paramètres</span>
                    <a class="d-flex align-items-center text-muted" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"</svg>
                    </a>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $a_settingsGeneral; ?>" href="../view/a_settingsGeneral.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            généraux
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $a_settingsDb; ?>" href="../view/a_settingsDb.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            base de données
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $a_settingsTemplate; ?>" href="../view/a_settingsTemplate.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            apparences
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2"><?php echo $namePage;?></h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        This week
                    </button>
                </div>
            </div>

