<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
//if(!in_array($_SESSION['role'],array('su','op'))){header("location:404.php");exit;}
require_once("db/conn.php");

$editq="SELECT * FROM lad_trn_inward WHERE inwardsrno=".$_GET['id'];
$editr=$connection->query($editq);
if($editr->num_rows!=1)header("location:404.php");
$editrow=$editr->fetch_assoc();
$webpagetitle="Update Inward";
include("header.php");
?>
<a href="inward.php" class="btn btn-info pull-right"><i class="fa fa-angle-left mrm"></i>Go Back</a>

    <div id="page-content">
 
 	 <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
             <div class="panel">
				 <div class="panel-body">
				
                <form role="form" id="updateformNew">
                    <input type="hidden" name="uid" id="uid" value="<?php echo $_GET['id']?>" readonly>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Inward No.</label>
                                <input type="text" class="form-control" value="<?php echo "IN/".$editrow['inwardsrno']?>" disabled>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Date <span class="red">*</span></label>
                                <div class="input-group">
                                	<input type="date" class="form-control" name="inwdate" id="inwdate" value="<?php echo date('Y-m-d',strtotime($editrow['inwdate']))?>" maxlength="10"   max=<?php echo date('Y-m-d');?> data-validation-error-msg="Invalid Date" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Inward From <span class="red">*</span></label>
                                <select class="form-control" name="inwtype" id="inwtype" data-validation="required" data-validation-error-msg="Invalid Inward From" onChange="setType()">
                                    <option value="">Select</option>
                                    <option value="c" <?php if(!is_null($editrow['con_sr_no']))echo " selected"?>>Member</option>
                                    <option value="o"<?php if(!is_null($editrow['inwfrom']))echo " selected"?>>Other</option>
                                </select>
                            </div>
                        </div>
                    	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Name <span class="red">*</span></label>
                                 <?php $listn="SELECT * FROM lad_member WHERE active='y' AND mem_id = '".$editrow['con_sr_no']."'";
							   //echo $listn;
							   		 $listnq=$connection->query($listn);
									 $listnqrow=$listnq->fetch_assoc();
									  ?>
                                 <input type="text" class="form-control" name="consrno" id="consrno" value="<?php echo $listnqrow['first_name']." ".$listnqrow['last_name']." ".$listnqrow['mem_no']." " ?>"   data-validation-optional="true"  data-validation-error-msg="Invalid member" >
                            	<input type="hidden" name="consrnol" id="consrno1" value="<?php echo $editrow['con_sr_no']?>" readonly >
                                <input type="text" class="form-control" name="inwfrom" id="inwfrom" value="<?php echo $editrow['inwfrom']?>" maxlength="100" data-validation="required"  data-validation-error-msg="Invalid Inward From" style="display:none" disabled>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Place<span class="red">*</span></label>
                                <input type="text" class="form-control" name="place_txt" id="place_txt" value="<?php echo $editrow['place_txt'];?>"  maxlength="100" data-validation="required"  data-validation-error-msg="Invalid Person Name" value="<?php echo $editrow['place_txt']?>">
                            </div>
                        </div>
                    	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Handed By <span class="red">*</span></label>
                                <select class="form-control" name="handedby" id="handedby" data-validation="required" data-validation-error-msg="Invalid Handed By" onChange="setCustType()">
                                    <option value="s">Self</option>
                                    <option value="o"<?php if(!is_null($editrow['personname']))echo " selected"?>>Other</option>
                                </select>
                            </div>
                        </div>
                    	
                    </div>
                    <div class="row">
                    	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Person Name</label>
                                <input type="text" class="form-control" name="personname" id="personname" value="<?php echo $editrow['personname']?>" maxlength="100"   data-validation-error-msg="Invalid Person Name" disabled>
                            </div>
                        </div>
                    	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Staff Name <span class="red">*</span></label>
                                <select class="form-control" name="staffsrno" id="staffsrno" data-validation="required"  data-validation-error-msg="Invalid Staff Name" >
                                	<option value="">Select</option>
                                    <?php
									$listr=$connection->query("SELECT staff_id,fname,mname,lname FROM lad_mst_teacher WHERE active='y' ORDER BY fname");
									while($listrow=$listr->fetch_assoc()){
									?>
                                    <option value="<?php echo $listrow['staff_id']?>"<?php if($listrow['staff_id']==$editrow['staffsrno'])echo " selected"?>><?php echo $listrow['fname'].' '.$listrow['mname'].' '.$listrow['lname'];?></option>
                                    <?php }$listr->free()?>
                                </select>
                            </div>
                        </div>
                    	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Returnable   <span class="red">*</span></label>
                                <select class="form-control" name="returnable" id="returnable" data-validation="required"  data-validation-error-msg="Invalid value">
                                    <option value="y" <?php if($editrow['returnable']=='y') echo "Selected";?>>Yes</option>
                                    <option value="n" <?php if($editrow['returnable']=='n') echo "Selected";?>> No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-3">
                            <div class="form-group">
                                <label>Doc Type </label>
                                <select class="form-control" name="doctype" id="doctype"  data-validation-error-msg="Invalid Doc Type" >
                                	<option value="">Select</option>
                                     <option value="p" <?php if($editrow['doctype']=='p')echo " selected"?>>PARCEL</option>
                                    <option value="d" <?php if($editrow['doctype']=='d')echo " selected"?>>ORIGNAL DOCUMENT</option>
                                	<option value="o" <?php if($editrow['doctype']=='o')echo " selected"?>>OTHER</option>
                                	<option value="c" <?php if($editrow['doctype']=='c')echo " selected"?>>CHQ/DD</option>
                                    <option value="b" <?php if($editrow['doctype']=='b')echo " selected"?>>BOOKLETS</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-sm-3" id="lmn" <?php if($editrow['doctype']!='c'){?>style="display:none;"<?php }?>>
                            <div class="form-group">
                                <label>CHQ/DD Details</label>
                                <input type="text" class="form-control" name="chk_dt" id="chk_dt" maxlength="100"  data-validation-optional="true"  data-validation-error-msg="Invalid CHQ/DD Details" value="<?php echo $editrow['chk_dt']?>">
                            </div>
                        </div>
                    	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Doc Name <span class="red">*</span></label>
                                <input type="text" class="form-control" name="docname" id="docname" value="<?php echo $editrow['docname']?>" maxlength="100"   data-validation-error-msg="Invalid Doc Name">
                            </div>
                        </div>
                        
                        
                       	<div class="col-sm-3">
                            <div class="form-group">
                                <label>File <small class="text-muted">(max 2 MB)</small></label>
                                <div class="input-group">
                                	<input type="file" class="form-control" name="docfile" id="docfile" data-validation="size" data-validation-max-size="2M" data-validation-error-msg="Invalid File">
                                    <?php if(!is_null($editrow['docfile'])){?><span class="input-group-btn"><a class="btn btn-info fancybox" href="../uploads/inward/<?php echo $_GET['id'].".".$editrow['docfile']?>"><i class="fa fa-eye"></i></a></span><?php }?>
                                </div>
                                <input type="hidden" name="olddocfile" id="olddocfile" value="<?php echo $editrow['docfile']?>" readonly>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-default" onClick="$('.alert-danger').hide()">Reset</button>
                </form>
                </div>
                </div>
            </div>
        </div>
    </div>
<link href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
<script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
<script>
$(function(){
	$('#consrno').autocomplete({
		source: 'contact_recby_data.php',
		minLength: 1,
		select: function(event,ui){
			$('#consrno1').val(ui.item.id);
		}
	})
	.focus(function(){
		$(this).val('');
		$('#consrno1').val('');
	})
	.blur(function(){
		if($('#consrno1').val()==''){
			$('#consrno').val('');
		}
	});
	$('#signatorlabel').autocomplete({
		source: 'contact_recby_data.php',
		minLength: 1,
		select: function(event,ui){
			$('#signator').val(ui.item.id);
		}
	})
	.focus(function(){
		$(this).val('');
		$('#signator').val('');
	})
	.blur(function(){
		if($('#signator').val()==''){
			$('#signatorlabel').val('');
		}
	});
});

function setType(){
	if($('#inwtype').val()=='c'){
		$('#consrno').removeAttr('disabled').show();
		$('#inwfrom').val('').attr('disabled','disabled').hide();
	}
	else{
		$('#inwfrom').removeAttr('disabled').show();
		$('#consrno').val('').attr('disabled','disabled').hide();
	}
}
function setCustType(){
	if($('#handedby').val()=='o'){
		$('#personname').removeAttr('disabled');
	}
	else{
		$('#personname').val('').attr('disabled','disabled');
	}
}

</script>
<script src="js/validate.js"></script>


<?php $connection->close();include("footer.php")?>