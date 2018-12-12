<?php
include_once "../controller/accountData_controller.php";
if(isset($_SESSION[ADMIN]))
{
include_once "../templates/defaultTop-admin.php";
?><div class="container"><?php
    }
    else
    {
        include_once "../templates/defaultTop.php";
    }
    ?>
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">

        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-1 main">

        </div>

<?php
include_once "../templates/defaultBottom.php";

?>
