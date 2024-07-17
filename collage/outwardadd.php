<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
//if(!in_array(4,$_SESSION['adrole'])){header("location:404.php");}
require_once("db/conn.php");
$webpagetitle=$pagetitle="New Outword";
include("header.php");
?>
<link href="../../../sanmitra/css/colors/cyan.css" rel="stylesheet" type="text/css" />

<a href="javascript:void(0)" class="btn btn-info pull-right" onClick="history.back()"><i class="fa fa-angle-left mrm"></i>Go Back</a>

    <div id="page-content">
       
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
            <div class="panel">
				  <div class="panel-body">
				
                <form role="form" id="addformNew">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                            	<?php $air=$connection->query("SHOW TABLE STATUS LIKE 'lad_trn_outward'");$airow=$air->fetch_assoc();$air->free();?>
                                <label>Outward No.</label>
                                <input type="text" class="form-control" value="<?php echo "OUT/".$airow['Auto_increment']?>" disabled>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Date <span class="require">*</span></label>
                               <!-- <div class="input-group">
                                	<span class="input-group-addon"><i class="fa fa-calendar"></i></span>-->
                                	<input type="date" class="form-control" name="outdate" id="outdate" data-validation="required" maxlength="10" max="<?php echo date('Y-m-d');?>" data-validation-optional="false" data-validation-error-msg="Invalid Date">
                                <!--</div>-->
                            </div>
                        </div>
                    	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Inward Reference</label>
                                <select class="form-control" name="inwardsrno" id="inwardsrno" data-validation-optional="true" onChange="inwInfo()">
                                	<option value="">Select</option>
                                    <?php
									$listr=$connection->query("SELECT inwardsrno,docname FROM lad_trn_inward WHERE inwardsrno NOT IN (SELECT inwardsrno FROM lad_trn_outward WHERE inwardsrno IS NOT NULL) AND active='y' AND returnable='y' ORDER BY docname");
									while($listrow=$listr->fetch_assoc()){
									?>
                                    <option value="<?php echo $listrow['inwardsrno']?>"><?php echo "IN/".$listrow['inwardsrno']." ".$listrow['docname'];?></option>
                                    <?php }$listr->free()?>
                                </select>
                                <input type="hidden" name="inwardsrno" id="inwardsrno1" readonly>
                            </div>
                        </div>
                    	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Staff Name <span class="require">*</span></label>
                                <select class="form-control" name="staffsrno" id="staffsrno" data-validation="required"  data-validation-error-msg="Invalid Staff Name">
                                	<option value="">Select</option>
                                    <?php
									$listu=$connection->query("SELECT a.*,b.user_name FROM lad_mst_teacher a,lad_mst_users b WHERE a.staff_id=b.comman_id AND a.active='y' ORDER BY fname");
									while($listurow=$listu->fetch_assoc()){
										
									?>
                                    <option value="<?php echo $listurow['staff_id']?>"><?php echo $listurow['fname'].' '.$listurow['mname'].' '.$listurow['lname'];?></option>
                                    <?php } $listu->free()?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Outward To <span class="require">*</span></label>
                                <select class="form-control" name="outtype" id="outtype" data-validation="required" data-validation-error-msg="Invalid Outward To" onChange="setType()">
                                    <option value="">Select</option>
                                    <option value="c">Member</option>
                                    <option value="o">Other</option>
                                    <option value="t">Transaction</option>
                                </select>
                              <input type="hidden" name="outtype" id="outtype1" readonly disabled>
                            </div>
                        </div>
                   	  <div class="col-sm-3" id="memnm" style="display:none;">
                            <div class="form-group">
                                <label>Name <span class="require">*</span></label>
                                <input type="text" class="form-control" name="consrno" id="consrno"  value=""  data-validation-optional="true"  data-validation-error-msg="Invalid member" >
                                <input type="text" name="consrno1" id="consrno1"  value="0" readonly >
                               	<input type="text" class="form-control" name="outto" id="outto" maxlength="100"  data-validation-error-msg="Invalid Inward From" style="display:none" disabled>
                                <input type="hidden" name="outto" id="outto1" readonly disabled>
                            </div>
                        </div>
                       

                        <div class="col-sm-3" id="memtrn" style="display:none;">
                            <div class="form-group">
                                <label>Transaction</label>
                                <select class="form-control" name="mem_trn_id" id="mem_trn_id" data-validation-error-msg="Invalid Scheme Name"  style="display:none"  disabled>
                                <option value="">Select</option>
                                   
                                 <?php
                                                $lists="SELECT a.*,b.first_name,b.mem_id,c.sub_scheme_name,c.sub_scheme_id FROM lad_trn_member a,lad_member b,lad_sub_scheme c where a.mem_trn_id NOT IN(SELECT mem_trn_id FROM lad_trn_outward WHERE mem_trn_id IS NOT NULL) AND a.mem_id = b.mem_id AND a.sub_scheme_id = c.sub_scheme_id AND a.active = 'y' "; 
                                                $listq=$connection->query($lists);
												$i=1;
                                                while($listrow=$listq->fetch_assoc()){ ?>

                                                <option value="<?php echo $listrow['mem_trn_id'];?>"><?php echo $listrow['mem_trn_id'].'/'.$listrow['first_name'].'/'.$listrow['sub_scheme_name']; ?></option>
                                            
                                                <?php $i++; } $listq->free(); ?>
                                </select>
                               
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Place <span class="require">*</span></label>
                                <input type="text" class="form-control" name="place_txt" id="place_txt" maxlength="100" data-validation="required"  data-validation-error-msg="Invalid Place">
                            </div>
                        </div>
                    	
                    	
                    </div>
                    <div class="row">
                    	
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Handed Over To <span class="require">*</span></label>
                                <select class="form-control" name="handedby" id="handedby" data-validation="required" data-validation-error-msg="Invalid Handed Over To" onChange="setCustType()">
                                    <option value="s">Self</option>
                                    <option value="o">Other</option>
                                </select>
                            </div>
                        </div>
                    	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Person Name</label>
                                <input type="text" class="form-control" name="personname" id="personname" maxlength="100"   data-validation-error-msg="Invalid Person Name" disabled>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Doc Type </label>
                                <select class="form-control" name="doctype" id="doctype"  data-validation-error-msg="Invalid Doc Type" onchange="chk_dt_function();">
                                	<option value="">Select</option>
                                   
                                    <option value="d">ORIGNAL DOCUMENT</option>
                                	<option value="o">OTHER</option>
                                	<option value="c">CHQ/DD</option>
                                   
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3" id="lmn" style="display:none;">
                            <div class="form-group">
                                <label>CHQ/DD Details</label>
                                <input type="text" class="form-control" name="chk_dt" id="chk_dt" maxlength="100"  data-validation-optional="true"  data-validation-error-msg="Invalid CHQ/DD Details">
                            </div>
                        </div>
                    	
                  </div>
                     <div class="row">
                     
                     	<div class="col-sm-3">
                            <div class="form-group">
                                <label>Doc Name </label>
                                <input type="text" class="form-control" name="docname" id="docname" maxlength="100"   data-validation-error-msg="Invalid Doc Name">
                                <input type="hidden" name="docname" id="docname1" readonly disabled>
                            </div>
                        </div>
                         <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Returnable <span class="require">*</span></label>
                                    <select class="form-control" name="returnable" id="returnable" data-validation="required"  data-validation-error-msg="Invalid value">
                                        <option value="y" selected>Yes</option>
                                        <option value="n" >No</option>
                                    </select>
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

<!--<script src="js/validate.js"></script>-->
<!--<script src="js/jquery-ui.min.js"></script>
<script>$('#addform button[type=submit]').click(function(){for(instance in CKEDITOR.instances)CKEDITOR.instances[instance].updateElement();});</script>   
<script>
--><!--form validation-->
<!--$.validate({
	modules : 'file',
	form : '#addform',
	scrollToTopOnError : false,
	onSuccess : function() {
		$('button').attr('disabled','disabled');$('#loading').html('<i class="fa fa-refresh fa-spin"></i>');$('.alert-danger').hide();
		formdata=new FormData($('#addform')[0]);
		$.ajax({
			type		: 'POST',
			url			: 'outwardadd_save.php',
			data		: formdata,
			contentType	: false,
    		processData	: false,
			success		: function(data){if(data=='success'){$('#addform')[0].reset();location='outward.php?msg=add_success';}else if(data.substr(data.length-4)=='.php')location=data;else{$('.alert-danger').html(data).show();$('button').removeAttr('disabled');$('#loading').html('');}}
		});return false;
	}
});
$('#outdate').datepicker({
	showAnim	: "slideDown",
	dateFormat	: "dd-mm-yy",
	changeMonth	: true,
	changeYear	: true,
	minDate		: "-1y",
	maxDate		: "0",
});
-->
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
	/*.focus(function(){
		$(this).val('');
		$('#consrno1').val('');
	})
	.blur(function(){
		if($('#consrno1').val()==''){
			$('#consrno').val('');
		}
	});*/
	
});


function chk_dt_function()
{
	var chq_dd=$('#doctype').val()
	//c
	if(chq_dd=='c'){
	$('#lmn').show();
	}else
	{
		$('#lmn').hide();
	}
}



function inwInfo(){
	
	if($('#inwardsrno').val()!=''){
		$.post('outwardgetinwinfo.php',{inwardsrno:$('#inwardsrno').val()},
			function(data){
				//alert(data);
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
				$('#place_txt').val(data[7]);
				$('#chk_dt').val(data[8]);
				
				chk_dt_function();
			}
			
		);
	}
	
}
function setType(){
	if($('#outtype').val()=='c'){
		
		$('#memnm').show();
		$('#memtrn').hide();
		$('#returnable').val('y').removeAttr('disabled').show();
		$('#consrno').removeAttr('disabled').show();
		$('#mem_trn_id').val('').attr('disabled','disabled').hide();
		$('#outto').val('').attr('disabled','disabled').hide();
	}
	else if($('#outtype').val()=='t'){
		$('#memtrn').show();
		$('#memnm').hide();
		 $('#returnable').val('y').attr('disabled','disabled');
		$('#mem_trn_id').removeAttr('disabled').show();
		$('#consrno').val('').attr('disabled','disabled').hide();
		$('#outto').val('').attr('disabled','disabled').hide();
	}else {
		$('#memnm').show();
		$('#memtrn').hide();
		$('#returnable').val('y').removeAttr('disabled').show();
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


/*function subschemedata() {
    if($('#consrno1').val() != ''){
		//if($('#scheme').val() != ''){
			$('#mem_trn_id').load('addsubsajax.php', {
					 mem_id: $('#consrno').val(),
					//schem_id: $('#scheme').val()
				},
				function(){}
			).removeAttr('disabled');
		//}
	}
    else $('#mem_trn_id').val('').attr('disabled','disabled');
}*/
</script>

<script src="js/validate.js"></script>

<script src="ckeditor/ckeditor.js"></script>

<?php $connection->close();include("footer.php")?>
