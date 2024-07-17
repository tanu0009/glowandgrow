<?php session_start();

if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
require_once("db/conn.php");
$webpagetitle="Dashboard";
include("header.php");
print_r($_SESSION);
?>

            <!--<div class="clearfix"></div>

        </div>-->

        <!--BEGIN CONTENT-->

        <div class="page-content">

            

        </div>

        <!--END CONTENT-->

<?php include("footer.php")?>