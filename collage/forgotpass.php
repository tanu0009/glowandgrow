<?php session_start();
if(isset($_SESSION['XUID']) && isset($_SESSION['XUSRNM'])){header("location:index.php");}

require_once("db/conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Forgot Password? - Ladshakhiya vani samaj sanmitra mandal</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,800italic,400,700,800">
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:400,700,300">
<link type="text/css" rel="stylesheet" href="css/font-awesome.min.css">
<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
<link type="text/css" rel="stylesheet" href="css/animate.css">
<link type="text/css" rel="stylesheet" href="css/main.css">
<link type="text/css" rel="stylesheet" href="css/style-responsive.css">
<link rel="shortcut icon" href="img/favicon.png">
<script src="js/jquery-1.11.3.min.js"></script>
</head>
<body class="loginpage">
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel">
                <div class="panel-body">
                    <img src="../images/logo.png" width="100%" alt="Ladshakhiya vani samaj sanmitra mandal">
                </div>
            </div>
        </div>
    </div>
    <?php if(!empty($_GET['msg'])){?>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <?php if($_GET['msg']=='invalid_email'){?><div class="note note-danger animated shake">Invalid Email</div><?php }?>
            <?php if($_GET['msg']=='user_account_disabled'){?><div class="note note-danger animated shake">User Account Disabled. Contact <strong>Admin</strong>.</div><?php }?>
            <?php if($_GET['msg']=='reset_failed'){?><div class="note note-danger animated shake">An unknown error occured. Please try again.</div><?php }?>
        </div>
    </div>
	<?php
	}
	?>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Forgot Password?</h3>
                </div>
                <div class="panel-body">
                    <form action="forgotpass_save.php" method="post" role="form">
                        <fieldset>
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" placeholder="Enter your Email" required autofocus>
                            </div>
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>