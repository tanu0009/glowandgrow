    <?php session_start();

    if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}

    //if(!in_array(4,$_SESSION['adrole'])){header("location:404.php");}

    require_once("db/conn.php");

    $webpagetitle=$pagetitle="New Receipt";

    include("header.php");

    ?>
	<a href="javascript:void(0)" class="btn btn-info pull-right" onClick="history.back()"><i class="fa fa-angle-left mrm"></i>Go Back</a>

            <!--<div class="clearfix"></div>

        </div>-->

        <!--BEGIN CONTENT-->

        <div class="page-content">

            <div class="row">

                <div class="col-md-12">

                    <div class="panel">

                        <div class="panel-body">

                            <form role="form" id="addform">

                               
                                <div class="row">
                                
                                <div class="col-sm-3">

                                        <div class="form-group">

                                            <label>Receipt Type<span class="require">*</span></label>
                                             
                                            <select class="form-control" name="tapshil_id" id="tapshil_id" data-validation="required" data-validation-optional="false" data-validation-error-msg="Invalid type" onchange="getsubschemetrn();">
                                           
                                            <option value="">Select</option>
                                            <?php
 
                                            /*$listta="SELECT * FROM lad_mst_tapshil where home_flag='r' AND active='y'";
                                            $lists=$connection->query($listta);
                                            $i=1;
                                            while ($listtsrow=$lists->fetch_assoc()){ 
                                                ?>
                                            <option value="<?php echo $listtsrow['tapshil_id']; ?>"><?php echo $listtsrow['tapshil_name']; ?></option>
                                               
                                                <?php $i++; }*/ ?>
                                                <option value="mex">Medical Equipment</option>
                                                <option value="me">Medical Emergency</option>
                                                <option value="sch">Scholarship</option>
                                                <option value="bf">Beneficiary Dead</option>
                                                
                                                
                                            </select>

                                          	
                                        </div>

                                  </div>
                                    
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <label>Member Name<span class="require">*</span></label>
                                            <input type="text" class="form-control" name="proposerlabel" id="proposerlabel" value="" data-validation="required"  data-validation-optional="false"  data-validation-error-msg="Invalid member" onkeyup="changem();" onchange="changem();">
                                            <input type="hidden" name="proposer" id="proposer" value="0" readonly>
                                        </div>
                                    </div>
                                
                                 </div>
                                 <div class="row">
                                 	<div id="abcd" style="display:none">
                                    	<?php /*?><div class="col-sm-3">

                                        <label>Scheme Name<span class="require">*</span></label>
                                        
                                        <select class="form-control" name="schem_id" id="schem_id" data-validation="required" data-validation-optional="false" data-validation-error-msg="Invalid Scheme" disabled="disabled" onChange="getsubscheme()">
                                                <option value="">Select</option>
                                                <?php
                                                $lists="SELECT * FROM lad_scheme where active='y'"; 
                                                $listq=$connection->query($lists);
												 while($listrow=$listq->fetch_assoc()){ ?>

                                                <option value="<?php echo $listrow['schem_id'];?>"><?php echo $listrow['scheme_name']; ?></option>
                                            
                                                <?php } $listq->free(); ?>
                                        
                                        </select>


                                    </div><?php */?>
                                    
                                    <div class="col-sm-3">

                                        <label>Sub Scheme</label>
                                        
                                        <select class="form-control" name="subschem_id" id="subschem_id" data-validation-optional="true" data-validation-error-msg="Invalid sub scheme" disabled="disabled" onchange="gettrnAmt();">
                                                <option value="">Select</option>
                                        </select>


                                    </div>
                                    
                                    
                                    </div>
                                 
                                 	 <div class="col-sm-3">
                                        <div class="form-group">

                                                <label>Amount<span class="require">*</span></label>

                                                
                                                <input type="text" class="form-control float" name="tapshil_amount" id="tapshil_amount" maxlength="10" data-validation-optional="false" data-validation="required"  data-validation-error-msg="Invalid Amount">
                                              

                                              
                                            </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">

                                                <label>Receipt Date<span class="require">*</span></label>

                                                <div id="rec_date"><input type="date" class="form-control" name="rec_date" id="tapshil_amount"maxlength="15" data-validation-optional="false" data-validation="required"  data-validation-error-msg="Invalid date" ></div>
                                                </div>
                                    </div>
                                    
                                    <div class="col-sm-4">

                                        <div class="form-group">

                                            <label>Bank(Account Name)<span class="require">*</span></label>
                                             
                                            <select class="form-control" name="bid" id="bid" data-validation="required" data-validation-optional="false" data-validation-error-msg="Invalid bank" >
                                           
                                            <option value="">Select</option>
                                            <?php
 
                                            $bankq="SELECT bid,bmicr,bname FROM lad_mst_bank where active='y'";
                                            $bankr=$connection->query($bankq);
                                            $i=1;
                                            while ($bankrow=$bankr->fetch_assoc()){ 
                                                ?>
                                            <option value="<?php echo $bankrow['bid']; ?>"><?php echo $bankrow['bname']."(".$bankrow['bmicr'].")"; ?></option>
                                               
                                                <?php $i++; } 
												$bankr->free();?>
                                                                                             
                                                
                                            </select>

                                          	
                                        </div>

                                  </div>
                                 </div>

                                <div class="row">
                                        
                                        <div class="col-sm-12 col-md-3">
                                                <div class="form-group">
                                                    <label>Payment Mode<span class="require">*</span></label>
                                                    <select class="form-control" name="paymode" id="paymode" data-validation="number" data-validation-error-msg="Please select mode" onChange="cashOrBank()">
                    
                                                        <option value="">Select</option>
                                                        <option value="1">Cash</option>
                                                        <option value="2">Cheque</option>
                                                        <option value="3">Online</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                             
                    
                                            <div class="col-sm-12 col-md-3">
                                                <div class="form-group">
                                                    <label>Cheque/Reference No.<span class="require">*</span></label>
                                                    <input type="text" class="form-control" name="chqno" id="chqno" maxlength="15"  data-validation-error-msg="Invalid cheque no." disabled>
                                                </div>
                                            </div>
                    
                                            <div class="col-sm-12 col-md-3">
                                                <div class="form-group">
                                                    <label>Bank Name</label>
                                                    <input type="text" class="form-control" name="bankname" id="bankname" maxlength="50"  data-validation-error-msg="Invalid bank name" disabled>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3">
                                                <div class="form-group">
                                                    <label>Cheque Date</label>
                                                        <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input type="date" class="form-control" name="chqdate" id="chqdate" maxlength="15"  data-validation-error-msg="Invalid cheque date" disabled>
                                                        </div>
                                                </div>
                                            </div>
                    
                                        </div>
                                        
                                 

                            	<div class="note note-danger displaynone"></div>
								<input type="hidden" id="mem_trn_id" name="mem_trn_id" value="" />
                                <button type="submit" class="btn btn-primary" data-loading-text="Submitting...">Add</button>

                                <button type="reset" class="btn btn-default" onClick="$('.note-danger').hide()">Reset</button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!--END CONTENT-->

<script>
function cashOrBank(){if($('#paymode').val()==2){$('#chqno,#bankname,#chqdate').removeAttr('disabled');}else if($('#paymode').val()==3){$('#chqno').removeAttr('disabled'); $('#bankname').val('').attr('disabled','disabled');}else $('#chqno,#bankname').val('').attr('disabled','disabled');}

/*function showhide_ss()
{
	mtest = $('#tapshil_id').val();
	if(mtest=='mb'){
		$('#abcd').show();
		$('#schem_id').val('').removeAttr('disabled');
		}else {
			$('#abcd').hide();
			$('#schem_id').val('').attr('disabled','disabled');
			$('#subschem_id').val('').attr('disabled','disabled');
			}
}*/


</script>

<link href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
<script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>

<script>


function getsubschem() {
	
	//alert(111);
	
	$('#proposerlabel').val();
	$('#proposer').val();
	// var sche = $('#schem_id').val();
	
	/*if(sche!='sch' || sche!='me'){
		//alert(222);
		 $("#proposerlabel").attr("readonly", false); 
	 }*/
    
    if($('#schem_id').val() != ''){
        $('#sub_scheme_id').load('subschemelist.php', {
                schem_id: $('#schem_id').val()
            },
            function(){}
        ).removeAttr('disabled');
    }
    else $('#sub_scheme_id').val('').attr('disabled','disabled');
}



function getsubscheme() {
    
    if($('#schem_id').val() != ''){
        $('#subschem_id').load('sub-scheme.php', {
                schem_id: $('#schem_id').val()
            },
            function(){}
        ).removeAttr('disabled');
    }
    else $('#subschem_id').val('').attr('disabled','disabled');
}


function getsubschemetrn() {
	//alert($('#proposer').val());
    
    if($('#proposer').val() != ''){
        $('#subschem_id').load('sub-schemetrn.php', {
                proposer: $('#proposer').val()
            },
            function(){}
        ).removeAttr('disabled');
    }
    else $('#subschem_id').val('').attr('disabled','disabled');
}

//$(function(){
	function changem()
	{
	var mtest = $('#tapshil_id').val();
	//alert(mtest);
	$('#proposerlabel').autocomplete({
		source: 'get_receipt_members.php?type='+mtest,
		minLength: 2,
		select: function(event,ui){
			$('#proposer').val(ui.item.id);
		}
	})
	.focus(function(){
		$(this).val('');
		$('#proposer').val('');
	})
	.blur(function(){
		if($('#proposer').val()==''){
			$('#proposerlabel').val('');
		}
	});
	$('#signatorlabel').autocomplete({
		source: 'get_receipt_members.php?type='+mtest,
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
	}
//});





function gettrnAmt()
{
	//alert($('#proposer').val());
	var memid=$('#proposer').val();
	
	//alert(memid);
	var subscid=$('#subschem_id').val();
	//alert(subscid);
   if(memid!='' && subscid!=''){
    $.ajax({
        type: "POST",
        url: "get_transactiondata.php",
		data: "memid=" + memid+"&subscid="+subscid,
      success : function(text){
		//	alert(text);
			var res = text.split("~");
						
				//	alert(res[1]);			
				$("#tapshil_amount").val(res[1]);
				$("#mem_trn_id").val(res[0]);
		}
    });
   }
}

</script>

<script src="js/validate.js"></script>

<script src="ckeditor/ckeditor.js"></script>



<?php $connection->close();include("footer.php")?>