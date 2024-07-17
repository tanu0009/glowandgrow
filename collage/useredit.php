<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
require_once("db/conn.php");

$editq="SELECT a.*,b.user_password  FROM lad_mst_teacher a,lad_mst_users b WHERE  a.staff_id='".$_GET['id']."' AND a.staff_id=b.comman_id AND b.comman_role='USER'";
$editr=$connection->query($editq);
$arrinfo=$editr->fetch_assoc();
$editr->free();


$webpagetitle=$pagetitle="Update User";
include("header.php")
?>
<script>
window.onload = function() {
  asdfg('<?php echo $arrinfo['sameas'];?>');
};
</script>
			<a href="user.php" class="btn btn-info pull-right"><i class="fa fa-angle-left mrm"></i>Go Back</a>
           <div class="clearfix"></div>
        <!--BEGIN CONTENT-->
        <div class="page-content">
            <div class="row">
                <div class="col-lg-12">
                 <form role="form" id="updateform">
                 <input type="hidden" name="staff_id" id="staff_id" value="<?php echo $arrinfo['staff_id'];?>" />
                    <div class="panel">
                    	<div class="panel-body">
                           
                                 <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Photo<small class="text-muted">(500 X 500)</small></label>
                                            <div class="input-group">
                                            	<input type="file" class="form-control" name="imgname" id="imgname" data-validation="mime size" data-validation-allowing="jpg, png, gif" data-validation-max-size="1M">
                                 <?php if(!empty($arrinfo['t_photo'])){?> <a href="../uploads/user/<?php echo $arrinfo['staff_id'].".".$arrinfo['t_photo']?>" class="fancybox input-group-addon" title="Existing Image"><i class="fa fa-eye"></i></a><?php }?>
                                            </div>
                                            <input type="hidden" name="oldprodimg" id="oldprodimg" value="<?php echo $arrinfo['t_photo']?>" readonly>
                                        </div>
                                	</div>
                                    
                                   <div class="col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label>Type<span class="require">*</span></label>
                                            <select class="form-control" name="cust_type" id="cust_type"  data-validation-optional="true" data-validation-error-msg="Invalid cust_type">
                                            	<option value="">Select</option>
                                                <option value="ADIM" <?php if($arrinfo['desig_name']=='ADIM'){ ?> selected="selected"<?php }?>>ADMIN</option>
                                                <option value="USER" <?php if($arrinfo['desig_name']=='USER'){ ?> selected="selected"<?php }?>>USER</option>
                                                
                                                
                                            </select>
                                                                                       
                                        </div>
                                    </div>
                                 
                                    
                                 
                                   <div class="col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label>First Name<span class="require">*</span></label>
                                            <input type="text" class="form-control" name="user_fname" id="user_fname" maxlength="100" data-validation-optional="false" data-validation="required" value="<?php echo $arrinfo['fname']?>" data-validation-error-msg="Invalid Name">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label>Middle Name</label>
                                            <input type="text" class="form-control" name="user_mname" id="user_mname" maxlength="100" data-validation-optional="true" value="<?php echo $arrinfo['mname']?>"  data-validation-error-msg="Invalid Name">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label>Last Name<span class="require">*</span></label>
                                            <input type="text" class="form-control" name="user_lname" id="user_lname" maxlength="100" data-validation-optional="false" value="<?php echo $arrinfo['lname']?>"  data-validation="required" data-validation-error-msg="Invalid Name">
                                        </div>
                                    </div>
                                  
                                    </div>
                        </div>
                    </div>

 
                    <div class="panel">
                    	<div class="panel-body">
                           
                                 	<div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Address<span class="require">*</span></label>
                                            <input type="text" class="form-control" name="address" id="address"  maxlength="255" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Address" value="<?php echo $arrinfo['address']?>">
                                        </div>
                                    </div>
                                    
                                    </div>
                                    
                                    <div class="row"> 
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>State <span class="require">*</span></label>
                                            <select class="form-control" name="state_id_" id="state_id_" data-validation="required" data-validation-optional="false" data-validation-error-msg="Invalid State" disabled="disabled">
                                            	<option value="">Select</option>
                                                <?php
												$stater=$connection->query("SELECT * FROM `lad_mst_state` WHERE active='y'");
												while($staterow=$stater->fetch_assoc()){
												?>
                                                
                                                 <option value="<?php echo $staterow['state_id']?>" <?php if($staterow['state_id']==$arrinfo['state_id']){echo "Selected";} ?>><?php echo $staterow['state_name'];?></option>
                                                <?php }$stater->free()?>
                                            </select>
                                            <input type="hidden" id="state_id" name="state_id" value="<?php echo $arrinfo['state_id'];?>" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>District <span class="require">*</span></label>
                                            <select class="form-control" name="dist_id" id="dist_id" data-validation="required" data-validation-optional="false" data-validation-error-msg="Invalid District">
                                            	<option value="">Select</option>
                                                 <?php
												$distrr=$connection->query("SELECT * FROM `lad_mst_district` WHERE state_id=".$arrinfo['state_id']."");
												while($distrow=$distrr->fetch_assoc()){
												?>
                                                <option value="<?php echo $distrow['dist_id']?>" <?php if($distrow['dist_id']==$arrinfo['dist_id']){echo "Selected";} ?>><?php echo $distrow['dist_name'];?></option>
                                                <?php }$distrr->free()?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <?php /*?><div class="col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label>Area<span class="require">*</span></label>
                                            <input type="text" class="form-control" name="area_id" id="area_id"  maxlength="255" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Area" value="<?php echo $arrinfo['area_id']?>">
                                        </div>
                                    </div><?php */?>
                                    
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Pin Code<span class="require">*</span></label>
                                            <input type="number" class="form-control" name="pin_code1" id="pin_code1"  maxlength="6" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Pin Code" value="<?php echo $arrinfo['pin_code']?>" >
                                        </div>
                                    </div>
                                    </div>
                                    
                        </div>
                    </div>
                    
                    <div class="panel">
                    	<div class="panel-body">
                           
                                 	<div class="row">
                                    
                                    
                                    	<div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Mobile Number<span class="require">*</span></label>
                                            <input type="number" class="form-control" name="p_mobile" id="p_mobile"  maxlength="10" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Mobile" value="<?php echo $arrinfo['mobile_no']?>">
                                        </div>
                                    </div>
                                    
                                   <?php /*?> <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="user_password" id="user_password"  maxlength="15" data-validation-optional="true" data-validation="required" data-validation-error-msg="Invalid password" value="">
                                        </div>
                                    </div><?php */?>
                                    
                                    
                                    
                                    <div class="col-sm-3" style="display:none">
                                        <div class="form-group">
                                            <label>Email Address<!--<span class="require">*</span>--></label>
                                            <input type="text" class="form-control" name="p_email" id="p_email"  maxlength="255" data-validation-optional="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" data-validation="required" data-validation-error-msg="Invalid Email" value="<?php echo $arrinfo['email_address']?>">
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Gender <!--<span class="require">*</span>--></label>
                                            <select class="form-control" name="gender" id="gender" data-validation="required" data-validation-optional="true" data-validation-error-msg="Invalid Gender">
                                            	<option value="">Select</option>
                                            	<option value="Male" <?php if($arrinfo['gender']=='Male')echo " selected"?>>Male</option>
                                                <option value="Female" <?php if($arrinfo['gender']=='Female')echo " selected"?>>Female</option>
                                            </select>
                                        </div>   
                                	</div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Date of Birh<!-- <span class="require">*</span>--></label>
                                            <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"  maxlength="15" data-validation-optional="true" data-validation="required" data-validation-error-msg="Invalid Date Of Birthdate" value="<?php echo $arrinfo['date_of_birth']?>">
                                        </div>
                                    </div>
                                    
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                <div class="note note-danger displaynone"></div>
                               <button type="submit" class="btn btn-primary savebtn" data-loading-text="Submitting...">Save</button>
                               <button type="reset" class="btn btn-default" onClick="$('.note-danger').hide()">Reset</button>
                            
                        </div>
                    </div>
                     </form>
                </div>
            </div>
        </div>
        <!--END CONTENT-->
<link type="text/css" rel="stylesheet" href="css/jquery.fancybox.css">
<script src="js/validate.js"></script>
 <script src="ckeditor/ckeditor.js"></script>
<script>$('#updateform button[type=submit]').click(function(){for(instance in CKEDITOR.instances)CKEDITOR.instances[instance].updateElement();});</script>   
<script src="js/jquery.fancybox.pack.js"></script>

<script src="js/validate.js"></script>
<script>$('.fancybox').fancybox();</script>
<script>
		
		function getSch() {
    if($('#state_id').val() != ''){
		$('#dist_id').load('citylistr.php', {
				state_id: $('#state_id').val()
			},
			function(){}
		).removeAttr('disabled');
	}
	else $('#dist_id').val('').attr('disabled','disabled');
}

function getareas() {
    if($('#dist_id').val() != ''){
		$('#area_id').load('arealistr.php', {
				dist_id: $('#dist_id').val()
			},
			function(){}
		).removeAttr('disabled');
	}
	else $('#area_id').val('').attr('disabled','disabled');
}

function getSch1() {
    if($('#state_id1').val() != ''){
		$('#dist_id1').load('citylistr.php', {
				state_id: $('#state_id1').val()
			},
			function(){}
		).removeAttr('disabled');
	}
	//else $('#dist_id1').val('').attr('disabled','');
}

function getareas1() {
    if($('#dist_id1').val() != ''){
		$('#area_id1').load('arealistr.php', {
				dist_id: $('#dist_id1').val()
			},
			function(){}
		).removeAttr('disabled');
	}
	//else $('#dist_id1').val('').attr('disabled','');
}


$(".answer").hide();
$(".coupon_question").click(function() {
    if($(this).is(":checked")) {
        $(".answer").show();
    } else {
        $(".answer").hide();
    }
});

function asdfg(val)
{
	//alert(val);
	if(val=='y'){
        $(".answer").show();
	}
   
}


</script>

<?php $connection->close();include("footer.php")?>