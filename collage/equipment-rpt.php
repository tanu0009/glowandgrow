<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
//if(!in_array(3,$_SESSION['adrole'])){header("location:404.php");}
require_once("db/conn.php");
$pagename=substr(basename($_SERVER['PHP_SELF']),0,-4);
$webpagetitle=$pagetitle="Equipment";
include("header.php");

//$preyear=date("Y");

//$fdate=$tdate=date('d-m-Y');

//if logged in to previous financial year, setting dates accordingly



?>

<style>

#hide

{

 width: 380px !important;

}

</style>



           <!-- <div class="clearfix"></div>

        </div>
-->
        <!--BEGIN CONTENT-->

        <div class="page-content">

            <div class="row">

                <div class="col-lg-5">

                    <div class="panel">

                        <div class="panel-body">
                         <form role="form" id="addform1"   method="POST" target="_blank">
                        <div class="form-group">

									<label>Report Type </label>

									<select class="form-control" name="report_type" id="report_type" onchange="desable_all_user('all_1')">

										 <option value="SU">Summary</option>

										 <option value="DT">Details</option>

									</select>

								</div>
                                
                                <div class="form-group">

									<label>Equipment </label>

									<select class="form-control" name="user_id" id="user_id" >
										<option value="">Select</option>
										 <option value="ALL" id="all_1">All equipment</option>
											<?php $listta="SELECT a.sub_scheme_id as mem_id,a.sub_scheme_name as name, 'Active' as mem_status,CONCAT_WS(' ', c.first_name, c.middle_name, c.last_name, c.mem_no) AS `namex` FROM lad_sub_scheme a,lad_trn_member b, lad_member c WHERE a.active='y' AND a.sub_scheme_id=b.sub_scheme_id AND b.schem_id='1' AND b.mem_id=c.mem_id AND (c.first_name like '".$_GET['term']."%' OR c.last_name like '".$_GET['term']."%' OR c.mem_no like '".$_GET['term']."%' OR a.sub_scheme_name like '".$_GET['term']."%') ";
                                            $lists=$connection->query($listta);
                                            while ($listtsrow=$lists->fetch_assoc()){?>
                                            <option value="<?php echo $listtsrow['mem_id']; ?>"><?php echo $listtsrow['name']; ?></option>
                                             <?php } $lists->free(); ?>

									</select>

								</div>

                           
								<div class="form-group">

                                    <label>From Date <span class="require">*</span></label>

                                    <div class="input-icon">

                                    	<i class="fa fa-calendar"></i>

                                    	<input type="text" class="form-control" name="fdate" id="fdate1" readonly data-validation="date required" data-validation-format="dd-mm-yyyy" data-validation-error-msg="Invalid From Date" value="<?php echo $fdate;?>">

                                    </div>

                                </div>



                                <div class="form-group">

                                    <label>To Date <span class="require">*</span></label>

                                    <div class="input-icon">

                                    	<i class="fa fa-calendar"></i>

                                    	<input type="text" class="form-control" name="tdate" id="tdate1" readonly data-validation="date" data-validation-format="dd-mm-yyyy" data-validation-error-msg="Invalid To Date" value="<?php echo $tdate;?>">

                                    </div>

                                </div>

								<div class="form-group">

									<label> REPORT TO </label>

									<select class="form-control" name="reto" id="reto" >

										 <option value="HT">HTML REPORT</option>

										 <option value="EX">EXCEL DOWNLOAD</option>

									</select>

								</div>

								

                                <button type="button" class="btn btn-success" onclick="askForbill()">View Report</button>

                                <button type="reset" class="btn btn-default" onClick="$('.note-danger').hide()">Reset</button>

                            

							</form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!--END CONTENT-->

<script src="js/auto/autojquery-ui.min.js"></script>

<link href="js/auto/autojquery-ui.min.css" rel="stylesheet">

<link href="css/jquery-ui.min.css" rel="stylesheet">

<script src="js/jquery-ui.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">

<script src="js/bootstrap-multiselect.js"></script>

<link rel="stylesheet" href="css/bootstrap-multiselect.css" /> 

<script>

$.validate({form:'#addform1',scrollToTopOnError:false,onSuccess:function(){}});

$('#fdate1').datepicker({

	showAnim	: 'slideDown',

	dateFormat	: 'dd-mm-yy',

	changeMonth	: true,

	changeYear	: true,

	mindate    : 0,

	maxDate	: "+1Y",



	onClose		: function(selectedDate){$('#tdate').datepicker('option','minDate',selectedDate);}

});

$('#tdate1').datepicker({

	showAnim	: 'slideDown',

	dateFormat	: 'dd-mm-yy',

	changeMonth	: true,

	changeYear	: true,

	mindate    : 0,

	maxDate	: "+1Y",



	onClose		: function(selectedDate){$('#fdate').datepicker('option','maxDate',selectedDate);}

});

form=document.getElementById("addform1");



function askForbill() {

	
	var fdate1 = document.getElementById('fdate1').value;

	var tdate1 = document.getElementById('tdate1').value;

	var reto = document.getElementById('reto').value;

	var report_type = document.getElementById('report_type').value;
	
	var user_id = document.getElementById('user_id').value;
	


	if (fdate1!='' && tdate1!='' && reto!='' && report_type!='' && user_id!='')

	{   

		if(reto=='HT'){
			form.action = "equipment-pdf.php?report_type="+report_type+"&user_id="+user_id+"&fdate="+fdate1+"&tdate="+tdate1;
		}else if(reto=='EX'){
			form.action = "equipment-excel.php?report_type="+report_type+"&user_id="+user_id+"&fdate="+fdate1+"&tdate="+tdate1;
		}
		form.submit();

		

		

	}else

	{

		alert('Empty not alloud. Please check all mandatory fields!');

	}

}
	function desable_all_user(all_1)
	{
		//alert(1111);
		dtvalue = document.getElementById("report_type").value;

			if(dtvalue=='DT')
			{
				document.getElementById(all_1).style.display = 'none';
			}else
			{
				document.getElementById(all_1).style.display = 'block';
				
			}
	}
						

</script>

<?php $connection->close();include("footer.php")?>