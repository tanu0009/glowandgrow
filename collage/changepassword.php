<?php
session_start();
if(!isset($_SESSION['sec_mem_id'])){header("location:index.php");}
include 'db/conn.php';
$pagename='changepass';
$webpagename='USER CHANGE PASSWORD';
$webdesc="SANMITRA";
$webkeyword="SANMITRA MANDAL";
include("header.php");
if(isset($_SESSION['sec_mem_id']) ){
	$userq="SELECT * FROM lad_member WHERE mem_id=".$_SESSION['sec_mem_id']."";
	$userr=$connection->query($userq);
	$userrow=$userr->fetch_assoc();
	$userr->free();
}

?>
<body>
<div class="site_wrapper">
  <?php include("top_menu.php");?>
  <div class="clearfix"></div>
  
<div class="shifter-page is-moved-by-drawer" id="container">

<nav class="breadcrumb text-center"  aria-label="breadcrumbs">
  <div class="container"> 
    <a href="index.php" title="Back to the frontpage">Home</a>
    
    <span aria-hidden="true" class="breadcrumb__sep">/</span>
    
    <a href="dashboard.php" title="Dashboard"><span>Dashboard</span></a>

    <span aria-hidden="true" class="breadcrumb__sep">/</span>
    
    <span>Change Password</span>

      <style>
  .input-group{
  display: table;
  border-collapse: collapse;
  width:100%;
}
.input-group > div{
  display: table-cell;
  border: 1px solid #ddd;
  vertical-align: middle;  /* needed for Safari */
}
.input-group-icon{
  background:#93bd03;
  color:white;
  padding: 0 12px
}
.input-group-area{
  width:100%;
}
/*.input-group input{
  border: 0;
  display: block;
  width: 100%;
  padding: 8px;
}*/
                   </style>
    
    
  </div>  
</nav>

     
      <div class="clearfix"></div>
      <div class="shifter-page is-moved-by-drawer" id="container">
        <div class="container">
  <div class="user-login-account  row dt-sc-image-with-icons-section-type2 dt-sc-column two-column" style="padding: 25px 0 25px 0px !important">
  <?php if($asd==2){?>
  <div class="col-md-6">
  <img src="images/change-pass.jpg" width="100%" />
  </div>
  <?php }?>
  
  <div class="user-account col-md-6" style="max-width:100% !important; margin: inherit !important;">

    <div class="grid__item">

      
      

      <div id="CustomerLoginForm">
         <form name="myform" method="post" role="form" id="passwordchange" class="passwordchange" >
        <input type="hidden" id="id" name="id" value="<?php echo $userrow['mem_id'];?>" />
        
        
         <div class="row dt-sc-image-with-icons-section-type2 dt-sc-column one-column" style="margin-bottom: 0px !important; color:black">
          <div class="col-md-12">
        <input type="text" name="user_name" id="user_name" placeholder="User Name" maxlength="100"  value="<?php echo $userrow['mobile_no'];?>" readonly="readonly">
        </div>
        </div>
        
        
        
        <div class="row dt-sc-image-with-icons-section-type2 dt-sc-column one-column" style="margin-bottom: 0px !important; color:black">
          <div class="col-md-12">
        <div class="input-group">
                          <div class="input-group-area"><input type="password" name="password" id="password" placeholder="Old Password" ></div>
                          <div class="input-group-icon"><span onClick="myFunction()"><i class="fa fa-eye" ></i></span></div>
						   </div>
        </div>
        </div>
        
        
        
        <div class="row dt-sc-image-with-icons-section-type2 dt-sc-column one-column" style="margin-bottom: 0px !important; color:black">
          <div class="col-md-12">
          <span id="error_password"  style="color:red" class="text-danger"></span>
        </div>
        </div>
        
        <div class="row dt-sc-image-with-icons-section-type2 dt-sc-column one-column" style="margin-bottom: 0px !important">
          <div class="col-md-12">
        <div class="form-group1">
                           <!-- <label class="control-label" for="comment-author">  <span class="req">*</span></label>-->
                                <div class="input-group">
                          <div class="input-group-area"><input type="password" name="newpassword" id="newpassword" placeholder="New Password" minlength="6" ></div>
                          <div class="input-group-icon"><span onClick="myFunction1()"><i class="fa fa-eye" style="font-size:20px;"></i></span></div>
						
							</div>
                            </div>
        </div>
        </div>
        
        <p style="float:right !important">
        <input  type="submit" id="submit" class="btn" value="Update">
        </p>
        
        <div id="response"></div>
                
        </form>
      </div>
    

    </div>

  </div>
  
</div>
</div>
      </div>
      <div class="clearfix"></div>
    </div>
 <?php include("top_footer.php");?>
</div>
<?php include("footer.php");?>  
