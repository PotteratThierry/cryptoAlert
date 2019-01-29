<?php

include_once "../controller/home_controller.php";

$accueil = "active";
unset($_SESSION[ADMIN]);
include_once "../templates/defaultTop.php";

?>


<?php
include_once "../templates/defaultBottom.php";
?>