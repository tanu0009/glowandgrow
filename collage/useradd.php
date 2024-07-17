<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
require_once("db/conn.php");
$webpagetitle=$pagetitle="New User";
include("header.php");
?>
			<a href="user.php" class="btn btn-info pull-right"><i class="fa fa-angle-left mrm"></i>Go Back</a>
           <div class="clearfix"></div>
       
        <!--BEGIN CONTENT-->
        <div class="page-content">
            <div class="row">
                <div class="col-lg-12">
                 <form role="form" id="addform">
                    <div class="panel">
                    	<div class="panel-body">
                           
                                 <div class="row">
                                 	<div class="col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label>Photo<!-- <span class="require">*</span> --><small class="text-muted">(500 X 500)</small></label>
                                            <input type="file" class="form-control" name="imgname" id="imgname" data-validation="required mime size" data-validation-optional="true" data-validation-allowing="jpg, png, gif" data-validation-max-size="1M" data-validation-error-msg="Invalid Student Photo">
                                        </div>
                                	</div>
                                    
                                    <div class="col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select class="form-control" name="cust_type" id="cust_type" data-validation="required" data-validation-optional="true" data-validation-error-msg="Invalid cust_type">
                                            	<option value="Admin">Admin</option>
                                                <option value="User">User</option>
                                                
                                                
                                            </select>
                                                                                       
                                        </div>
                                    </div>
                                    
                                    
                                 	<div class="col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label>First Name<span class="require">*</span></label>
                                            <input type="text" class="form-control" name="usr_fname" id="usr_fname" maxlength="100" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Name">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label>Middle Name</label>
                                            <input type="text" class="form-control" name="usr_mname" id="usr_mname" maxlength="100" data-validation-optional="true"  data-validation-error-msg="Invalid Name">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label>Last Name<span class="require">*</span></label>
                                            <input type="text" class="form-control" name="usr_lname" id="usr_lname" maxlength="100" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Name">
                                        </div>
                                    </div>
                                  
                                    </div>
                                    
                                    
                                    
                                    
                        </div>
                    </div>
                    <div class="panel">
                    	<div class="panel-body">
                           
                                 	<div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Address<span class="require">*</span></label>
                                            <input type="text" class="form-control" name="address" id="address"  maxlength="255" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Address">
                                        </div>
                                    </div>
                                    
                                    </div>
                                    
                                    <div class="row"> 
                                    <div class="col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label>State<span class="require">*</span></label>
                                            <select class="form-control" name="state_id" id="state_id" data-validation="required" data-validation-optional="false" data-validation-error-msg="Invalid State" onchange="getdistrict();">
                                            	<option value="">Select</option>
                                                <?php
												$stater=$connection->query("SELECT * FROM `lad_mst_state` WHERE active='y'");
												while($staterow=$stater->fetch_assoc()){
												?>
                                                <option value="<?php echo $staterow['state_id']?>" ><?php echo $staterow['state_name'];?></option>
                                                <?php }$stater->free()?>
                                            </select>
                                           <?php /*?> <input type="hidden" id="state_id" name="state_id" value="21"/>
                                            <input type="hidden" id="dist_id" name="dist_id" value="369"/><?php */?>
                                            
                                            <?php /*?><?php if($staterow['state_id']==21){echo "Selected";} ?><?php */?>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label>District<span class="require">*</span></label>
                                            <select class="form-control" name="dist_id" id="dist_id" data-validation="required" data-validation-optional="false" data-validation-error-msg="Invalid city" disabled="disabled">
                                            	<option value="">Select</option>
                                                <?php
												$distr1=$connection->query("SELECT * FROM `lad_mst_district` WHERE state_id=21 AND active='y'");
												while($distrow1=$distr1->fetch_assoc()){
												?>
                                                <option value="<?php echo $distrow1['dist_id']?>"><?php echo $distrow1['dist_name'];?></option>
                                                <?php }$distr1->free()?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <?php /*?><div class="col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label>Area<span class="require">*</span></label>
                                            <input type="text" class="form-control" name="area_id" id="area_id"  maxlength="50" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Address">
                                        </div>
                                    </div><?php */?>
                                    
                                    <div class="col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label>Pin Code<span class="require">*</span></label>
                                            <input type="number" class="form-control" name="pin_code1" id="pin_code1"  maxlength="6" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Pin Code">
                                        </div>
                                    </div>
                                    </div>
                                    
                         </div>
                    </div>
                    
                    <div class="panel">
                    	<div class="panel-body">
                           
                                 	<div class="row">
                                    
                                    	<div class="col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label>Mobile Number<span class="require">*</span></label>
                                            <input type="text" class="form-control" name="p_mobile" id="p_mobile"  maxlength="13" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Mobile">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label>Email<!--<span class="require">*</span>--></label>
                                            <input type="email" class="email form-control" name="p_email" id="p_email"  maxlength="100" data-validation-optional="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" data-validation="required" data-validation-error-msg="Invalid Email">
                                        </div>
                                    </div>
                                    
                                   <div class="col-sm-12 col-md-3" >
                                        <div class="form-group">
                                            <label>Gender<!--<span class="require">*</span>--></label>
                                            <select class="form-control" name="gender" id="gender" data-validation="required" data-validation-optional="true" data-validation-error-msg="Invalid Gender">
                                            	<option value="">Select</option>
                                            	<option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>   
                                	</div>
                                    
                                    <div class="col-sm-12 col-md-3" >
                                        <div class="form-group">
                                            <label>Date of Birth<!-- <span class="require">*</span>--></label>
                                            <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"  maxlength="15" data-validation-optional="true" data-validation="required" data-validation-error-msg="Invalid Date Of Birthdate">
                                        </div>
                                    </div>
                                   
                                    
                                    </div>
                                      
                                <div class="note note-danger displaynone"></div>
                               <button type="submit" class="btn btn-primary addbtn" data-loading-text="Submitting...">Add</button>
                                <button type="reset" class="btn btn-default" onClick="$('.note-danger').hide()">Reset</button>
                            
                        </div>
                    </div>
                     </form>
                </div>
            </div>
        </div>
        <!--END CONTENT-->
<script src="ckeditor/ckeditor.js"></script>
<script>$('#addform button[type=submit]').click(function(){for(instance in CKEDITOR.instances)CKEDITOR.instances[instance].updateElement();});</script>   
<script src="js/validate.js"></script>
<script>
		function getdistrict() {
    
    if($('#state_id').val() != ''){
        $('#dist_id').load('addressdiff.php', {
                state_id: $('#state_id').val()
            },
            function(){}
        ).removeAttr('disabled');
    }
    else $('#dist_id').val('').attr('disabled','disabled');
}

function getSch1() {
    if($('#state_id1').val() != ''){
		$('#dist_id1').load('citylistr.php', {
				state_id: $('#state_id1').val()
			},
			function(){}
		).removeAttr('disabled');
	}
	
}

function getareas1() {
    if($('#dist_id1').val() != ''){
		$('#area_id1').load('arealistr.php', {
				dist_id: $('#dist_id1').val()
			},
			function(){}
		).removeAttr('disabled');
	}
	
}



$(".answer").hide();
$(".coupon_question").click(function() {
    if($(this).is(":checked")) {
        $(".answer").show();
    } else {
        $(".answer").hide();
    }
});



</script>

<?php $connection->close();include("footer.php")?>