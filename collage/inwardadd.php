<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
//if(!in_array($_SESSION['role'],array('su','op'))){header("location:404.php");exit;}

require_once("db/conn.php");

$pagename=substr(basename($_SERVER['PHP_SELF']),0,-4);
$webpagetitle=$pagetitle="New Inward";

include("header.php");
?>
<link href="../../../sanmitra/css/colors/cyan.css" rel="stylesheet" type="text/css" />


<a href="javascript:void(0)" class="btn btn-info pull-right" onClick="history.back()"><i class="fa fa-angle-left mrm"></i>Go Back</a>

    <div id="page-content">
        
        <div class="row">
            <div class="col-lg-12">
            	<div class="panel">
					 <div class="panel-body">
				 <form role="form" id="addform">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                            	<?php $air=$connection->query("SHOW TABLE STATUS LIKE 'lad_trn_inward'");$airow=$air->fetch_assoc();$air->free();?>
                                <label>Inward No.</label>
                                <input type="text" class="form-control" value="<?php echo $airow['Auto_increment']?>" disabled>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Outward Reference</label>
                                <select class="form-control" name="outwardsrno" id="outwardsrno" data-validation="required"  data-validation-error-msg="Invalid Outward Reference" data-validation-optional="true" onChange="outinfo();">
                                	<option value="">Select</option>
                                    <?php
									$listr1=$connection->query("SELECT outwardsrno,docname FROM lad_trn_outward WHERE active='y' AND returnable='y'");
									while($listrow1=$listr1->fetch_assoc()){
									?>
                                    <option value="<?php echo $listrow1['outwardsrno']?>"><?php echo "OUT/".$listrow1['outwardsrno']." ".$listrow1['docname'];?></option>
                                    <?php }$listr1->free()?>
                                </select>
                                <input type="hidden" name="outwardsrno" id="outwardsrno1" value="<?php echo $listrow1['outwardsrno'];?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Inward From <span class="require">*</span></label>
                                <select class="form-control" name="inwtype" id="inwtype" data-validation="required" data-validation-error-msg="Invalid Inward From" onChange="setType()">
                                    <option value="">Select</option>
                                    <option value="c">Member</option>
                                    <option value="o">Other</option>
                                </select>
                            </div>
                        </div>
                    	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Inward From</label>
                                <?php /*?><select class="form-control" name="consrno" id="consrno" data-validation="required"  data-validation-error-msg="Invalid Inward From">
                                	<option value="">Select</option>
                                    <?php
									$listme=$connection->query("SELECT mem_id,last_name,first_name FROM lad_member where active='y' ORDER BY last_name,first_name");
							while($listmerow=$listme->fetch_assoc()){
									?>
                                    <option value="<?php echo $listmerow['mem_id']; ?>" ><?php echo $listmerow['last_name'];?></option>
                                    <?php }$listme->free();?>
                                </select><?php */?>
                                <input type="text" class="form-control" name="consrno" id="consrno"  value=""  data-validation-optional="true"  data-validation-error-msg="Invalid member" >
                                 <input type="hidden" name="consrno1" id="consrno1"  value="0" readonly >
                                <input type="text" class="form-control" name="inwfrom" id="inwfrom" maxlength="100" data-validation="required"  data-validation-error-msg="Invalid Inward From" style="display:none" disabled>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Place<span class="require">*</span></label>
                                <input type="text" class="form-control" name="place_txt" id="place_txt"   maxlength="100" data-validation="required"  data-validation-error-msg="Invalid place" value="<?php echo $editrow['place_txt']?>">
                            </div>
                        </div>
                    	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Handed By <span class="require">*</span></label>
                                <select class="form-control" name="handedby" id="handedby" data-validation="required" data-validation-error-msg="Invalid Handed By" onChange="setCustType()">
                                    <option value="s">Self</option>
                                    <option value="o">Other</option>
                                </select>
                            </div>
                        </div>
                    	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Person Name</label>
                                <input type="text" class="form-control" name="personname" id="personname" maxlength="100" data-validation="required"  data-validation-error-msg="Invalid Person Name" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Staff Name <span class="require">*</span></label>
                                <select class="form-control" name="staffsrno" id="staffsrno" data-validation="required"  data-validation-error-msg="Invalid Staff Name">
                                	<option value="">Select</option>
                                    <?php
									$listu=$connection->query("SELECT a.*,b.user_name FROM lad_mst_teacher a,lad_mst_users b WHERE a.staff_id=b.comman_id AND a.active='y' ORDER BY fname");
									while($listurow=$listu->fetch_assoc()){
										//if($_SESSION['role']=='su' || $_SESSION['usrrole']=='re'){
									?>
                                    <option value="<?php echo $listurow['staff_id']?>"><?php echo $listurow['fname'].' '.$listurow['mname'].' '.$listurow['lname'];?></option>
                                    <?php //}
									}$listu->free()?>
                                </select>
                            </div>
                        </div>
                    	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Returnable <span class="require">*</span></label>
                                <select class="form-control" name="returnable" id="returnable" data-validation="required"  data-validation-error-msg="Invalid value">
                                    <option value="y">Yes</option>
                                    <option value="n" selected>No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Doc Name <span class="require">*</span></label>
                                <input type="text" class="form-control" name="docname" id="docname" maxlength="100" data-validation="required"  data-validation-error-msg="Invalid Doc Name">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Doc Type <span class="require">*</span></label>
                                <select class="form-control" name="doctype" id="doctype" data-validation="required" data-validation-error-msg="Invalid Doc Type">
                                	<option value="">Select</option>
                                	<option value="h">Parcel</option>
                                	<option value="s">Original Document</option>
                                    <option value="p">Photo Copies</option>
                                    <option value="c">Cheque/DD</option>
                                    <option value="o">OTHER</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Date <span class="require">*</span></label>
                                <div class="input-group">
                                	
                                	<input type="date" class="form-control" name="inwdate" id="inwdate" maxlength="10" max="<?php echo date('Y-m-d');?>" data-validation="required" data-validation-error-msg="Invalid Date">
                                </div>
                            </div>
                        </div>
                       	<div class="col-sm-3">
                            <div class="form-group">
                                <label>File <small class="text-muted">(max 2 MB)</small></label>
                                <input type="file" class="form-control" name="docfile" id="docfile" data-validation="size" data-validation-max-size="2M" data-validation-error-msg="Invalid File">
                            </div>
                        </div>
                    </div>
				  <div class="note note-danger displaynone"></div>
							    <button type="submit" class="btn btn-primary" data-loading-text="Submitting...">Add</button>

                                <button type="reset" class="btn btn-default" onClick="$('.note-danger').hide()">Reset</button>

                </form>
                <div class="space30"></div>
                </div>
                </div>
            </div>
        </div>
    </div>

<link href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
<script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
<script>
$(function(){
			//alert('hiii')
	$('#consrno').autocomplete({

		source: 'contact_recby_data.php',
		minLength: 1,
		select: function(event,ui){
			//alert('hiiiii');
			$('#consrno1').val(ui.item.id);
		}
	})
	
	
});


function outinfo(){
	//alert('hi');
	if($('#outwardsrno').val()!=''){
		$.post('inwardgetinwinfo.php',{outwardsrno:$('#outwardsrno').val()},
			function(data){
				
				data=data.split('{#}');
				//alert(data[0]);
				
				
				$('#outwardsrno1').val($('#outwardsrno').val());
				$('#outwardsrno').attr('disabled','disabled');
				setType();
				$('#personname').val(data[0]);
				setCustType();
				$('#docname,#docname1').val(data[1]).removeAttr('disabled');
				$('#docname').attr('disabled','disabled');
				$('#doctype').val(data[2]);
				$('#inwdate').val(data[3]);
			}
		);
	}
}

</script>
<script>

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

<script src="ckeditor/ckeditor.js"></script>


<?php $connection->close();include("footer.php")?>