<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
//if(!in_array($_SESSION['role'],array('su','op'))){header("location:404.php");exit;}
require_once("db/conn.php");
$editq="SELECT * FROM lad_trn_outward WHERE outwardsrno=".$_GET['id'];
$editr=$connection->query($editq);
if($editr->num_rows!=1)header("location:404.php");
$editrow=$editr->fetch_assoc();
$webpagetitle="Update Outward";
include("header.php");
?>
<a href="outward.php" class="btn btn-info pull-right"><i class="fa fa-angle-left mrm"></i>Go Back</a>
<div class="page-content">
       
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
                                <label>Outward No.</label>
                                <input type="text" class="form-control" value="<?php echo $editrow['outwardsrno']?>" disabled>
                            </div>
                        </div>
                    	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Inward Reference</label>
                                <select class="form-control"  id="inwardsrno" name="inwardsrno"  data-validation-error-msg="Invalid Inward Reference" data-validation-optional="true" onChange="inwInfo()">
                                	<option value="">Select</option>
                                    <?php
									$listq="SELECT inwardsrno,docname FROM lad_trn_inward WHERE active='y' AND returnable='y' AND ";
									if(!is_null($editrow['inwardsrno']))$listq.="(inwardsrno NOT IN (SELECT inwardsrno FROM lad_trn_outward WHERE inwardsrno IS NOT NULL) OR inwardsrno=".$editrow['inwardsrno'].")";
									else $listq.="inwardsrno NOT IN (SELECT inwardsrno FROM lad_trn_outward WHERE inwardsrno IS NOT NULL)";
									$listq.=" ORDER BY docname";
									echo $listq;
									$listr=$connection->query($listq);
									while($listrow=$listr->fetch_assoc()){
									?>
                                    <option value="<?php echo $listrow['inwardsrno']?>"<?php if($editrow['inwardsrno']==$listrow['inwardsrno']){echo "selected"; } ?>><?php echo "IN/".$listrow['inwardsrno']." ".$listrow['docname']?></option>
                                    <?php }$listr->free()?>
                                </select>
                                <input type="hidden" name="inwardsrno1" id="inwardsrno1" value="<?php echo $editrow['inwardsrno']?>" readonly disabled>
                            </div>
                        </div>
                    	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Staff Name <span class="red">*</span></label>
                                <select class="form-control" name="staffsrno" id="staffsrno" data-validation="required"  data-validation-error-msg="Invalid Staff Name">
                                	<option value="">Select</option>
                                    <?php
									$listr=$connection->query("SELECT staff_id,fname,mname,lname FROM lad_mst_teacher WHERE active='y' ORDER BY fname");
									while($listrow=$listr->fetch_assoc()){
									?>
                                    <option value="<?php echo $listrow['staff_id']?>"<?php if($listrow['staff_id']==$editrow['staffsrno'])echo " selected"?>><?php echo $listrow['fname'].' '.$listrow['mname'].' '.$listrow['lname']; ?></option>
                                    <?php }$listr->free()?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Outward To <span class="red">*</span></label>
                                <select class="form-control" name="outtype" id="outtype"  data-validation-error-msg="Invalid Outward To" onChange="setType()">
                                    <option value="">Select</option>
                                    <option value="c" <?php if(!is_null($editrow['con_sr_no']))echo " selected"?>>Member</option>
                                    <option value="o"<?php if(!is_null($editrow['outto']))echo " selected"?>>Other</option>
                                    <option value="t" <?php if(!is_null($editrow['mem_trn_id']))echo " selected"?>>Transaction</option>
                                </select>
                                <input type="hidden" name="outtype" id="outtype1" value="<?php if(!is_null($editrow['outto']))echo "o";else echo "c";?>" readonly disabled>
                            </div>
                        </div>
                       
                    	<div class="col-sm-3" >
                         
                            <div class="form-group">
                                <label>Outward To </label>
                               <?php $listn="SELECT * FROM lad_member WHERE active='y' AND mem_id = '".$editrow['con_sr_no']."'";
							   //echo $listn;
							   		 $listnq=$connection->query($listn);
									 $listnqrow=$listnq->fetch_assoc();
									  ?>
                               <input type="text" class="form-control" name="consrno" id="consrno" value="<?php echo $listnqrow['first_name']." ".$listnqrow['last_name']." ".$listnqrow['mem_no']." " ?>" 
							   <?php if(!is_null($editrow['con_sr_no']))echo " selected"; ?>   data-validation-optional="true"  data-validation-error-msg="Invalid member" >
                               <input type="text" class="form-control" name="outto" id="outto" value="<?php echo $editrow['outto']?>" maxlength="100"  data-validation-error-msg="Invalid Inward From" style="display:none" disabled>
                               <input type="hidden" name="consrnol" id="consrnol" value="<?php echo $editrow['con_sr_no']?>" readonly >
                               <input type="hidden" name="outto" id="outto1" value="<?php echo $editrow['outto']?>" readonly disabled>
                               <?php $listnq->free(); ?>
                            </div>
                        </div>
                       
                       
                        <?php 
						//if($editrow['mem_trn_id'] != Null){ ?>
                         <div class="col-sm-3" >
                            <div class="form-group">
                                <label>Member Transaction</label>
                                <select class="form-control" name="mem_trn_id" id="mem_trn_id" data-validation-error-msg="Invalid Scheme Name" >
                                <option value="">Select</option>
                                 <?php
                                                $lists="SELECT a.*,b.first_name,b.mem_id,c.sub_scheme_name,c.sub_scheme_id FROM lad_trn_member a,lad_member b,lad_sub_scheme c where a.mem_trn_id NOT IN(SELECT mem_trn_id FROM lad_trn_outward WHERE  mem_trn_id !='".$editrow['mem_trn_id']."') AND a.mem_id = b.mem_id AND a.sub_scheme_id = c.sub_scheme_id AND a.active = 'y' "; 
                                                $listq=$connection->query($lists);
												$i=1;
                                                while($listrow=$listq->fetch_assoc()){ ?>

                                                <option value="<?php echo $listrow['mem_trn_id'];?>" <?php if($listrow['mem_trn_id']=$editrow['mem_trn_id'])echo "selected" ?>><?php echo $listrow['mem_trn_id'].'/'.$listrow['first_name'].'/'.$listrow['sub_scheme_name']; ?></option>
                                            
                                                <?php $i++; } $listq->free(); ?>
                                </select>
                               
                            </div>
                        </div>
                        <?php //} ?>
                    	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Handed Over To <span class="red">*</span></label>
                                <select class="form-control" name="handedby" id="handedby" data-validation="required" data-validation-error-msg="Invalid Handed Over To" onChange="setCustType()">
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
                                <label>Doc Name </label>
                                <input type="text" class="form-control" name="docname" id="docname" value="<?php echo $editrow['docname']?>" maxlength="100" data-validation-error-msg="Invalid Doc Name">
                                <input type="hidden" name="docname" id="docname1" value="<?php echo $editrow['docname']?>" readonly disabled>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Doc Type</label>
                                <select class="form-control" name="doctype" id="doctype"  data-validation-error-msg="Invalid Doc Type">
                                	<option value="">Select</option>
                                	<option value="h"<?php if($editrow['doctype']=='h')echo " selected"?>>Parcel</option>
                                	<option value="s"<?php if($editrow['doctype']=='s')echo " selected"?>>Original Document</option>
                                    <option value="p"<?php if($editrow['doctype']=='p')echo " selected"?>>Photo Copies</option>
                                    <option value="c"<?php if($editrow['doctype']=='c')echo " selected"?>>Cheque/DD</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Date <span class="red">*</span></label>
                                <div class="input-group">
                                	<!--<span class="input-group-addon"><i class="fa fa-calendar"></i></span>-->
                                	<input type="date" class="form-control" name="outdate" id="outdate" value="<?php echo date('Y-m-d',strtotime($editrow['outdate']))?>" maxlength="10"  max=<?php echo date('Y-m-d');?> data-validation-error-msg="Invalid Date" >
                                </div>
                            </div>
                        </div>
                       	
                    </div>
                    <div class="row">
                    <div class="col-sm-3">
                            <div class="form-group">
                                <label>File <small class="text-muted">(max 2 MB)</small></label>
                                <div class="input-group">
                                	<input type="file" class="form-control" name="docfile" id="docfile" data-validation="size" data-validation-max-size="2M" data-validation-error-msg="Invalid File">
                                    <?php if(!is_null($editrow['docfile'])){?><span class="input-group-btn"><a class="btn btn-info fancybox" href="../uploads/outward/<?php echo $editrow['docfile']?>"><i class="fa fa-eye"></i></a></span><?php }?>
                                </div>
                                <input type="hidden" name="olddocfile" id="olddocfile" value="<?php echo $editrow['docfile']?>" readonly>
                            </div>
                        </div>
                    <div class="col-sm-3">
                            <div class="form-group">
                                <label>Returnable <span class="red">*</span></label>
                                <select class="form-control" name="returnable" id="returnable" data-validation="required"  data-validation-error-msg="Invalid value">
                                    <option value="y"<?php if($editrow['returnable']=='y')echo " selected"?>>Yes</option>
                                    <option value="n"<?php if($editrow['returnable']=='n')echo " selected"?>>No</option>
                                </select>
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
			$('#consrnol').val(ui.item.id);
		}
	})
});

function inwInfo(){
	if($('#inwardsrno').val()!=''){
		$.post('outwardgetinwinfo.php',{inwardsrno:$('#inwardsrno').val()},
			function(data){
				data=data.split('{#}');
				$('#inwardsrno1').val($('#inwardsrno').val());
				$('#inwardsrno').attr('disabled','disabled');
				$('#outtype,#outtype1').val(data[0]).removeAttr('disabled');
				$('#outtype').attr('disabled','disabled');
				if((parseFloat(data[1])==parseInt(data[1])) && !isNaN(data[1])){
					$('#consrno,#consrno1').val(data[1]).removeAttr('disabled');
					$('#consrno').attr('disabled','disabled');
				}
				else{
					$('#outto,#outto1').val(data[1]).removeAttr('disabled');
					$('#outto').attr('disabled','disabled');
				}
				setType();
				$('#consrno,#outto').attr('disabled','disabled');
				$('#handedby').val(data[2]);
				$('#personname').val(data[3]);
				setCustType();
				$('#docname,#docname1').val(data[4]).removeAttr('disabled');
				$('#docname').attr('disabled','disabled');
				$('#doctype').val(data[5]);
				$('#outdate').datepicker('option',{minDate:new Date(data[6])});
			}
		);
	}
}
function setType(){
	if($('#outtype').val()=='c'){
		$('#memnm').show();
		$('#memtrn').hide();
		$('#consrno').removeAttr('disabled').show();
		$('#mem_trn_id').val('').attr('disabled','disabled').hide();
		$('#outto').val('').attr('disabled','disabled').hide();
	}
	else if($('#outtype').val()=='t'){
		$('#memtrn').show();
		$('#memnm').hide();
		$('#mem_trn_id').removeAttr('disabled').show();
		$('#consrno').val('').attr('disabled','disabled').hide();
		$('#outto').val('').attr('disabled','disabled').hide();
	}else {
		$('#memnm').show();
		$('#memtrn').hide();
		$('#outto').removeAttr('disabled').show();
		$('#consrno').val('').attr('disabled','disabled').hide();
		$('#mem_trn_id').val('').attr('disabled','disabled').hide();
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
<!--window.onload=function(){setType();setCustType();}-->

</script>
<script src="js/validate.js"></script>

<script src="ckeditor/ckeditor.js"></script>

<?php $connection->close();include("footer.php")?>