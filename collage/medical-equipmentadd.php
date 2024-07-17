    <?php session_start();
$pagename='medeq';
    if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}

    //if(!in_array(4,$_SESSION['adrole'])){header("location:404.php");}

    require_once("db/conn.php");

    $webpagetitle=$pagetitle="New Registration";

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
                                
                                
                                <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Title of Project<span class="require">*</span></label>
                                            <input type="text" class="form-control" name="project_name" id="project_name" value="" data-validation="required"  data-validation-optional="false"  data-validation-error-msg="Invalid title" >
                                           
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <label>Type<span class="require">*</span></label>
                                             
                                            <select class="form-control" name="mtype" id="mtype" data-validation="required" data-validation-optional="false" data-validation-error-msg="Invalid type" onchange="getvalue();" >
                                           <option value="">Select</option>
                                            <option value="Project">Project</option>
                                            <option value="Research">Research</option>
                                            <option value="Competition">Competition</option>
                                            <option value="PBL">PBL</option>
                                                                                                                                        							</select>

                                          	
                                        </div>

                                  </div>
                                  
                                  <div class="col-sm-3">

                                        <div class="form-group">

                                            <label>Faculty<span class="require">*</span></label>
                                             
                                            <select class="form-control" name="tid" id="tid" data-validation="required" data-validation-optional="false" data-validation-error-msg="Invalid Faculty" >
                                           
                                            <option value="">Select</option>
                                            <?php
 
                                            $bankq="SELECT * FROM wr_mst_teacher where active='y'";
                                            $bankr=$connection->query($bankq);
                                            $i=1;
                                            while ($bankrow=$bankr->fetch_assoc()){ 
                                                ?>
                                            <option value="<?php echo $bankrow['tid']; ?>"><?php echo $bankrow['tname']."(".$bankrow['branch'].")"; ?></option>
                                               
                                                <?php $i++; } 
												$bankr->free();?>
                                                                                             
                                                
                                            </select>

                                          	
                                        </div>

                                  </div>
                                                                     
                                    
                                
                                </div>
                                
                                <div class="row">
                                <div class="col-sm-3">

                                        <div class="form-group">

                                            <label>Support Type<span class="require">*</span></label>
                                             
                                            <select class="form-control" name="support_type" id="support_type" data-validation="required" data-validation-optional="false" data-validation-error-msg="Invalid Faculty" >
                                           
                                            <option value="">Select</option>
                                             <option value="Material">Material</option>
                                              <option value="Machine">Machine</option>
                                                                  
                                                
                                            </select>

                                          	
                                        </div>

                                  </div>
                                  	<div class="col-sm-3">

                                        <div class="form-group">

                                            <label>Duration Of Project <span class="require">*</span></label>
                                             
                                            <select class="form-control" name="duration" id="duration" data-validation="required" data-validation-optional="false" data-validation-error-msg="Invalid Faculty" >
                                           
                                            <option value="">Select</option>
                                            <option value="Semister">Semister</option>
                                            <option value="Full-Year">Full-Year</option>
                                            
                                            
                                                                                             
                                                
                                            </select>

                                          	
                                        </div>

                                  </div>
                                  </div>
                                
                                                                 
                                   <div id="productbox">
                                	<div class="row">
                                    	<div class="col-lg-12">
                                        	<h2>Students</h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                    
                                    	
                                    	 
                                    	 <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Name<span class="require">*</span></label>
                                                <select class="form-control" name="tapshil_id1" id="tapshil_id1" data-validation="required" data-validation-error-msg="Invalid Product" onChange="calcPrice('1'),getamount('1');">
                                                    <option value="">Select</option>
                                                     <?php
 
                                            $listta="SELECT * FROM wr_mst_student where active='y'";
                                            $lists=$connection->query($listta);
                                            $i=1;
                                            while ($listtsrow=$lists->fetch_assoc()){ 
                                                ?>
                                            <option value="<?php echo $listtsrow['sid']; ?>"><?php echo $listtsrow['sname']." - ".$listtsrow['branch']." - ".$listtsrow['class']; ?></option>
                                               
                                                <?php $i++; } ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-sm-6">
                                <button style="float:right" type="button" class="btn btn-info btn-sm addbtn" onclick="calcPrice();"><i class="fa fa-plus"></i></button>
                                <input type="hidden" name="prodcount" id="prodcount" value="1" readonly>
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

function calcPrice(val){
	if($('#tapshil_amount'+val).val()!=''){
		totalamt=0;
				for(x=1;x<=$('#prodcount').val();x++){
					if($('#tapshil_amount'+x).length>0)
						totalamt+=parseFloat($('#tapshil_amount'+x).val());
				}
				$('#total_amount').val(totalamt.toFixed(2));
	}
//	else $('#tapshil_amount'+val).val('0');
	
}


</script>

<link href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
<script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>

<script>
$('.addbtn').click(function(){
	i=parseInt($('#prodcount').val())+1;
	$('#productbox').append('<div class="row"><div class="col-sm-5"><div class="form-group"><label>Receipt Type</label><select class="form-control" id="tapshil_id'+i+'" name="tapshil_id'+i+'"  data-validation-error-msg="Invalid type" onChange="calcPrice(\''+i+'\'),getamount(\''+i+'\');"><option value="">Select</option></select></div></div><div class="col-sm-1"><div class="form-group"><label>&nbsp;</label><div><button type="button" class="btn btn-danger btn-sm" onClick="$(this).parents(\':eq(3)\').remove();calcPrice()"><i class="fa fa-close"></i></button></div></div></div></div>');
	$('#tapshil_id'+i).html($('#tapshil_id1').html());
	$('#prodcount').val(i);
});

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

$(function(){
	$('#proposerlabel').autocomplete({
		source: 'contact_recby_data.php',
		minLength: 1,
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

function getamount(id){
	//alert(2222);
 	var xyz=$('#tapshil_id'+id).val();
	    $.ajax({
    
         type: "POST",
         url: 'getmeamount.php',
         data: {
                "eqid": xyz
              },
        success: function(data) {
			 var res = data.split("~");
           
            $('#tapshil_amount'+id).val(res[0].trim());
			
         }
    
       });

               
        }







/*
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
}*/

</script>

<script src="js/validate.js"></script>

<script src="ckeditor/ckeditor.js"></script>



<?php $connection->close();include("footer.php")?>