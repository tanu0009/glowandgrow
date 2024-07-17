<?php session_start();
if(isset($_SESSION['XUID']) && isset($_SESSION['XUSRNM'])){header("location:index.php");}
?>

<!DOCTYPE html>

<html lang="en">

<head>

<title>Log In - Workshop</title>

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

<link rel="shortcut icon" href="img/flogo.png">

<script src="js/jquery-1.11.3.min.js"></script>

</head>

<body class="loginpage">

<div class="container">

    <div class="row">

        <div class="col-md-4 col-md-offset-4">

            <div class="login-panel panel">

                <div class="panel-body">

                    <img src="img/school.jpg" width="100%" alt="Workshop">

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-4 col-md-offset-4 text-center">

            <?php if(!empty($_GET['msg']) && $_GET['msg']=='user_logout_success'){?>

            <div class="note note-success loggedout">

            	You have successfully Logged out

            	<script>$(function(){$('.loggedout').delay(3000).fadeOut(function(){$(this).remove()})});</script>

            </div>

			<?php }elseif(!empty($_GET['msg']) && $_GET['msg']=='reset_pass'){?>

            <div class="note note-success resetpass">

            	Your password has been reset successfully and emailed to your email account.

            	<script>$(function(){$('.resetpass').delay(5000).fadeOut(function(){$(this).remove()})});</script>

            </div>

			<?php }?>

        	<div class="note note-danger displaynone"></div>

        	<div class="note note-success displaynone">Login Successful. Loading . . .</div>

        </div>

    </div>

    <div class="row" id="loginbox">

        <div class="col-md-4 col-md-offset-4">

            <div class="panel">

                <div class="panel-body">

                    <form id="loginform" role="form">

                        <fieldset>

                            <div class="form-group">

                            	<div class="input-icon">

                                	<i class="fa fa-user"></i>

                                	<input type="text" class="form-control" name="username" id="username" value="<?php if(!empty($_GET['user']))echo $_GET['user']?>" placeholder="Username" data-validation="required" data-validation-optional="false" data-validation-error-msg="Invalid username"  autofocus>

                                </div>

                            </div>

                            <div class="form-group">

                            	<div class="input-icon">

                                	<i class="fa fa-key"></i>

                                	<input type="password" class="form-control" name="password" id="password" placeholder="Password" data-validation="required" data-validation-optional="false" data-validation-error-msg="Invalid password" >

                                </div>

                            </div>
                            
                        

                                        <div class="form-group">

                                          <!--  <label>Type<span class="require">*</span></label>-->
                                             
                                             <div class="input-icon">

                                	<i class="fa fa-user"></i>
                                            <select class="form-control" name="ltype" id="ltype" data-validation="required" data-validation-optional="false" data-validation-error-msg="Invalid type" >
                                           <option value=""> &nbsp;&nbsp; Select</option>
                                            <option value="s"> &nbsp;&nbsp; Student</option>
                                            <option value="t"> &nbsp;&nbsp;  Teacher</option>
                                            
                                                                                                                                        							</select>
</div>
                                          	
                                    
                                  </div>

                            <button type="submit" class="btn btn-primary" data-loading-text="Submitting...">Log In<i class="fa fa-sign-in mlm"></i></button>

                            <a href="forgotpass.php" class="pull-right btn">Forgot Password?</a>

                        </fieldset>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="js/form-validator/jquery.form-validator.min.js"></script>

<script src="js/bootstrap.min.js"></script>

<script>$.validate({form:'#loginform',onSuccess:function(){$('#loginform button').button('loading');$('.note').hide();$.post('logincheck.php',$('#loginform').serialize(),function(data){$('#password').val('');

if(data=='success'){$('#loginbox').remove();$('.note-success').fadeIn();setTimeout(location.reload(),3000);}else if(data.substr((data.length)-4,4)=='.php')location=data;else{$('.note-danger').html(data).show().addClass('animated shake');$('#loginform button').button('reset');}});return false;}});</script>

</body>

</html>