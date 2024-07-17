    <?php session_start();
	if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
	//if(!in_array(4,$_SESSION['adrole'])){header("location:404.php");}
	require_once("db/conn.php");
	$webpagetitle=$pagetitle="New Scholarship";
	include("header.php");
	?>
	<a href="scholarship" class="btn btn-info pull-right" onClick="history.back()"><i class="fa fa-angle-left mrm"></i>Go Back</a>
	 <!--<div class="clearfix"></div>
	  

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

                                            <label>Student Name<span class="require">*</span></label>

                                            <input type="text" class="form-control" name="stud_name" id="stud_name" value=""data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Name">
												
                                        </div>

                                    </div>
                                    
                                     <div class="col-sm-6">

                                        <div class="form-group">

                                            <label>Parent Name<span class="require">*</span></label>

                                            <input type="text" class="form-control" name="par_name" id="par_name" maxlength="50"  data-validation-error-msg="Invalid Name">

                                        </div>

                                    </div>
                                    
                                	
                                </div>
                                
                                                               
                                
                                
                                <div class="row">

                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <label>Student Mobile No.<span class="require">*</span></label>

                                            <input type="text" class="form-control" name="stud_mob" id="stud_mob" maxlength="10" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Name">

                                        </div>

                                    </div>
                                     <div class="col-sm-3">

                                        <div class="form-group">

                                            <label>Student Image<span class="require">*</span></label>

                                            <input type="file" class="form-control" name="stu_img" id="stu_img" maxlength="10" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Name">

                                        </div>

                                    </div>
                                    <div class="col-sm-2">

                                        <div class="form-group">

                                            <label>10th Mark<span class="require">*</span></label>

                                            <input type="text" class="form-control" name="10th_mark" id="10th_mark" maxlength="5" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Name">

                                        </div>

                                    </div>
                                     <div class="col-sm-2">

                                        <div class="form-group">

                                            <label>12th Mark<span class="require">*</span></label>

                                            <input type="text" class="form-control" name="12th_mark" id="12th_mark"  maxlength="5"  data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Name">

                                        </div>

                                    </div>
                                     <div class="col-sm-2">

                                        <div class="form-group">

                                            <label>Education field<span class="require">*</span></label>

                                            <input type="text" class="form-control" name="edu_field" id="edu_field"  data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Name">

                                        </div>

                                    </div>
                                	
                                </div>
                                <div class="row">

                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <label>Collage Name<span class="require">*</span></label>

                                            <input type="text" class="form-control" name="colla_name" id="colla_name"  data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Name">

                                        </div>

                                    </div>
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <label>Collage Year<span class="require">*</span></label>
                                            <select class="form-control" name="colla_year" id="colla_year"  data-validation-optional="false"
                                             data-validation="required" data-validation-error-msg="Invalid Name">
                                            <option value="">Select</option>
                                             <option value="fy">First Year</option>
                                              <option value="sy">Second Year</option>
                                               <option value="ty">Third Year</option>
                                                <option value="forthy">Fourth Year</option>
                                                 <option value="fifthy">Fifth Year</option>
                                            </select>


                                        </div>

                                    </div>
                                     <div class="col-sm-3">

                                        <div class="form-group">

                                            <label>Collage Year Fee<span class="require">*</span></label>

                                            <input type="text" class="form-control" name="colla_year_fee" id="colla_year_fee" maxlength="50" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Name">

                                        </div>

                                    </div>
                                     <div class="col-sm-3">

                                        <div class="form-group">

                                            <label>PG Cource</label>

                                            <input type="text" class="form-control" name="pg_cource" id="pg_cource"  data-validation-optional="true"  data-validation-error-msg="Invalid Name" onchange="pgreslt()">

                                        </div>

                                    </div>
                                	
                                </div>
                                <div class="row">

                                   
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <label>PG result</label>

                                            <input type="file" class="form-control" name="pg_result" id="pg_result" data-validation-optional="true"  data-validation-error-msg="Invalid Name" disabled>

                                        </div>

                                    </div>
                                     <div class="col-sm-3">

                                        <div class="form-group">

                                            <label>Scholarship Amount<span class="require">*</span></label>

                                            <input type="text" class="form-control" name="sch_amt" id="sch_amt"  data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Name">

                                        </div>

                                    </div>
                                	<div class="col-sm-3">

                                        <div class="form-group">

                                            <label>Scholarship Date<span class="require">*</span></label>

                                            <input type="date" class="form-control" name="sch_date" id="sch_date"  data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Name">

                                        </div>

                                    </div>
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <label>Scholarship Return Date<span class="require">*</span></label>

                                            <input type="date" class="form-control" name="sch_rtn_date" id="sch_rtn_date"  data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Name">

                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-sm-2">

                                        <div class="form-group">

                                            <label>Parent Annual Income<span class="require">*</span></label>

                                            <input type="text" class="form-control" name="pal_income" id="pal_income"  data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Name">

                                        </div>

                                    </div>
                                    <div class="col-sm-2">

                                        <div class="form-group">

                                            <label>First Responsible Person Member No<span class="require">*</span></label>

                                            <input type="text" class="form-control" name="resp_person_1" id="resp_person_1"  maxlength="50" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Name" onblur="parentinfo1()" >
											<input type="hidden" name="resp_person1" id="resp_person1" value="0" >
                                        </div>

                                    </div>
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <label>First Responsible Person 
                                            <br/>Name<span class="require">*</span></label>

                                            <input type="text" class="form-control" name="resp_per1" id="resp_per1"  data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Name" disabled>

                                        </div>

                                    </div>
                                    <div class="col-sm-2">

                                        <div class="form-group">

                                            <label>Second Responsible Person Member No<span class="require">*</span></label>

                                           <input type="text" class="form-control" name="resp_person_2" id="resp_person_2"  maxlength="50" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Name" onblur="parentinfo2()" >
											<input type="hidden" name="resp_person2" id="resp_person2" value="0" >
                                        </div>

                                    </div>
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <label>Second Responsible Person Name<span class="require">*</span></label>

                                            <input type="text" class="form-control" name="resp_per2" id="resp_per2"  data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Name" disabled>

                                        </div>

                                    </div>
                                </div>
                                
                                <div class="row">
                                <div class="col-sm-3">

                                        <div class="form-group">

                                            <label>Laabharthi</label>
										<select class="form-control" name="laabharthi" id="laabharthi"  data-validation-optional="true"
                                              data-validation-error-msg="Invalid Name" >
                                            <option value="">Select</option>
                                             <option value="y">Yes</option>
                                              <option value="n">No</option>
                                              </select>
                                         
                                        </div>

                                    </div>
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <label>Laabharthi Year</label>

                                           <select class="form-control" name="laabh_year" id="laabh_year"  
                                           data-validation-optional="true" Laabharthidata-validation-error-msg="Invalid Name" disabled>
                                            <option value="">Select</option>
                                             <option value="fy">First Year</option>
                                              <option value="sy">Second Year</option>
                                              <option value="th">Third Year</option>
                                              <option value="forthy">Fourth Year</option>
                                              
                                              </select>
                                              
                                        </div>

                                    </div>
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <label>Laabharthi amount</label>

                                            <input type="text" class="form-control" name="laabh_amt" id="laabh_amt"  data-validation-optional="true"  data-validation-error-msg="Invalid Name" disabled>

                                        </div>

                                    </div>
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <label>Sanchalak<span class="require">*</span></label>

                                           <input type="text" class="form-control" name="sanchalak_id" id="sanchalak_id" 
                                            maxlength="50" data-validation-optional="true"  
                                            data-validation-error-msg="Invalid Name"  >
											<input type="hidden" name="sanchalak" id="sanchalak" value="0">
                                        </div>

                                    </div>
                                   
                                </div>

                            	 <div class="note note-danger displaynone"></div> 

                                <button type="submit" class="btn btn-primary" data-loading-text="Submitting...">Add</button>

                                <button type="reset" class="btn btn-default" onClick="$('.note-danger').hide()">Reset</button>
                               
                            </form>
                        </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!--END CONTENT-->
<link href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
<script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
<script>
$("#sch_rtn_date").change(function () {
    var startDate = document.getElementById("sch_date").value;
    var endDate = document.getElementById("sch_rtn_date").value;
	if ((Date.parse(startDate) > Date.parse(endDate))) {
        alert("End date should be date after Start date");
        document.getElementById("sch_rtn_date").value = "";
    }
});

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

function parentinfo()
{
	//alert(pal_id);
	var id =$('#proposer').val();
	//var mob_no=$('#par_mobile').val();
	//var addr=$('#par_address').val();
	 $.ajax({
    
         type: "POST",
         url: 'ajaxscholar.php',
         data:{"mem_no": id},
        success: function(data) {
             var res = data.split("~");
            $('#par_name').val(res[0]);
			$('#par_mobile').val(res[1]);
			$('#par_address').val(res[2]);
         }
    
       });

}
</script>

<script>
$(function(){
	$('#resp_person_1').autocomplete({
		source: 'contact_recby_data.php',
		minLength: 1,
		select: function(event,ui){
			$('#resp_person1').val(ui.item.id);
		}
	})
	
});

function parentinfo1()
{
	//alert(pal_id);
	var id =$('#resp_person1').val();
	
	 $.ajax({
    
         type: "POST",
         url: 'ajaxscholar.php',
         data:{"mem_no": id},
        success: function(data) {
             var res = data.split("~");
            $('#resp_per1').val(res[0]);
			
         }
    
       });
	
}
</script>
<script>
$(function(){
	$('#resp_person_2').autocomplete({
		source: 'contact_recby_data.php',
		minLength: 1,
		select: function(event,ui){
			$('#resp_person2').val(ui.item.id);
		}
	})
	
});

function parentinfo2()
{
	//alert(pal_id);
	var id =$('#resp_person2').val();
	
	 $.ajax({
    
         type: "POST",
         url: 'ajaxscholar.php',
         data:{"gal_id": id},
        success: function(data) {
             var res = data.split("~");
            $('#resp_per2').val(res[0]);
			
         }
    
       });

}
</script>
<script>
$(function(){
	$('#sanchalak_id').autocomplete({
		source: 'sanchalak_data.php',
		minLength: 1,
		select: function(event,ui){
			$('#sanchalak').val(ui.item.id);
		}
	})
	
});

function pgreslt(){
	if($('#pg_cource').val()!=''){
		$('#pg_result').removeAttr('disabled');
		}
	}
</script>
<script src="js/validate.js"></script>

<script src="ckeditor/ckeditor.js"></script>

<?php $connection->close();include("footer.php")?>