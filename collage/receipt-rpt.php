<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
//if(!in_array(3,$_SESSION['adrole'])){header("location:404.php");}
require_once("db/conn.php");
$pagename=substr(basename($_SERVER['PHP_SELF']),0,-4);
$webpagetitle=$pagetitle="Receipt";
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

	if (fdate1!='' && tdate1!='' && reto!='')

	{   

		if(reto=='HT'){
			form.action = "receipt-pdf.php?fdate="+fdate1+"&tdate="+tdate1;
		}else if(reto=='EX'){
			form.action = "receipt-excel.php?fdate="+fdate1+"&tdate="+tdate1;
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