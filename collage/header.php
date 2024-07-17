<!DOCTYPE html>

<html lang="en">

<head>

<title><?php if(!empty($webpagetitle))echo $webpagetitle." - "?>Workshop :: Admin</title>

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="shortcut icon" href="../images/flogo.png">

<link rel="apple-touch-icon" href="../images/flogo.png">

<link rel="apple-touch-icon" sizes="72x72" href="images/flogo.png">

<link rel="apple-touch-icon" sizes="114x114" href="../images/flogo.png">

<!--Loading bootstrap css-->

<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">

<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:400,700,300">



<link type="text/css" rel="stylesheet" href="css/font-awesome.min.css">

<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">

<link type="text/css" rel="stylesheet" href="css/animate.css">

<link type="text/css" rel="stylesheet" href="css/main.css">

 <link rel="stylesheet" href="css/bootstrap-select.min.css">

<link type="text/css" rel="stylesheet" href="css/style-responsive.css">

<link type="text/css" rel="stylesheet" href="css/pace.css">

<link type="text/css" rel="stylesheet" href="css/jquery.news-ticker.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

<!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

<![endif]-->




<script src="js/jquery-1.11.3.min.js"></script>

<script src="js/jquery-migrate-1.2.1.min.js"></script>

<script src="js/form-validator/jquery.form-validator.min.js"></script>

</head>

<body <?php if($pagename=='member'){?>onLoad="changeAge();"<?php }?> <?php if($pagename=='medeq'){?>onLoad="getvalue();"<?php }?>>

<!--BEGIN BACK TO TOP-->

<a id="totop" href="#"><i class="fa fa-angle-up"></i></a>

<!--END BACK TO TOP-->

<!--BEGIN TOPBAR-->

<div id="header-topbar-option-demo" class="page-header-topbar">

    <nav id="topbar" role="navigation" style="margin-bottom: 0;" data-step="3" class="navbar navbar-default navbar-static-top">

        <div class="navbar-header">

            <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>

            <a id="logo" href="index.php" class="navbar-color"><img src="img/school.jpg" height="40" alt="Workshop"></a>

        </div>

        <div class="topbar-main">

        	<a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>

            <div class="news-update-box hidden-xs">

            	<span class="text-uppercase mrm pull-left text-white">News:</span>

                <ul id="news-update" class="ticker list-unstyled">

                    <li>Welcome to Workshop</li>

                </ul>

            </div>

            <ul class="nav navbar navbar-top-links navbar-right mbn">

                <li class="dropdown topbar-user">

                	<a data-hover="dropdown" href="#" onClick="return false" class="dropdown-toggle"><span><?php echo $_SESSION['XFULLNAME']?></span>&nbsp;<span class="caret"></span></a>

                    <ul class="dropdown-menu dropdown-user pull-right">

                        <li><a href="changepass.php"><i class="fa fa-wrench"></i>Change Password</a></li>

                        <li class="divider"></li>

                        <li><a href="logout.php?action=logout_user_session&user=<?php echo $_SESSION['XUSRNM']?>"><i class="fa fa-sign-out"></i>Logout</a></li>

                    </ul>

                </li>

            </ul>

        </div>

    </nav>

</div>

<!--END TOPBAR-->

<div id="wrapper">

    <!--BEGIN SIDEBAR MENU-->

    <?php include("sidebar.php")?>

    <!--END SIDEBAR MENU-->

    <!--BEGIN PAGE WRAPPER-->

    <div id="page-wrapper">

        <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">

            <div class="page-header pull-left">

                <div class="page-title"><?php if(!empty($pagetitle))echo $pagetitle?></div>

            </div></div><!--</div></div>-->