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
<div class="container-fluid well" style="width:1000px;margin:0">
<h3 style="text-align:center"><b>Inward Details</b></h3>
<hr/>
<br/>
	<div class="row">
    	<div class="col-md-12">
          <div class="panel">
		 	 <div class="panel-body">
        	<form id="updateform" role="form">
            	<input type="hidden" name="uid" id="uid" value="<?php echo $_GET['id']?>" readonly>
				<div class="col-md-4">
                <div class="form-group">
                  <p class="form-control-static"><label>Inward No</label> :<?php echo $editrow['inwardsrno']?></p>
                </div>
				<div class="col-md-4">
                </div>
                <div class="form-group">
                  <?php
					 if(!empty($editrow['con_sr_no'])) 
					{	
					$listr=$connection->query("SELECT mem_no,first_name,last_name,middle_name FROM lad_member WHERE mem_id=".$editrow['con_sr_no']." AND active='y' ORDER BY first_name");
					 $listrow=$listr->fetch_assoc(); 
					 ?>
					<p class="form-control-static"> 
					 <label>Inward Form</label> :<?php echo $listrow['first_name']." ".$listrow['last_name'];?>
					 </p>
                   <?php
				   }
				   else
				   {
				   ?>
                   <p class="form-control-static"> 
				    <label>Inward Form</label> :<span class="form-control-static"><?php echo $editrow['inwfrom'] ?></span>
                    </p>
               
				   <?php 
				   }
				   ?>
                </div>
                </div>
				<div class="col-md-4">
                <div class="form-group">
                  
                  <p class="form-control-static"><label>Handed By </label>: <?php if(empty($editrow['personname'])){ echo "Self"; } else { echo $editrow['personname'];}?></p>
                    
               
                </div>
				 </div>
				<div class="col-md-4">
                <div class="form-group">
           
                	 <?php
                     	$listr=$connection->query("SELECT staff_id,fname,mname,lname FROM lad_mst_teacher WHERE staff_id='".$editrow['staffsrno']."'");
					 	$listrow=$listr->fetch_assoc();
						?>   
					<p class="form-control-static">
					    <label>Staff Name </label> :<?php echo $listrow['fname'].' '.$listrow['mname'].' '.$listrow['lname'];?>
					</p>
                </div>
				 </div>
				<div class="col-md-4">
                <div class="form-group">
                 
                   <p class="form-control-static">
				      <label>Returnable</label> :
					   <?php if($editrow['returnable']=='y')
                             {
                               echo "Yes";	 
                             }
                             else
                             {
                                echo "No";	 
                             
                             }
                             ?>
				   </p>
                    
                    
                </div> </div>
				<div class="col-md-4">
                <div class="form-group">
                  
                    <p class="form-control-static">  <label>Doc Name</label>: <?php echo $editrow['docname']?></p>
                </div>
				 </div>
				<div class="col-md-4">
				<div class="form-group">
                   
                    <p class="form-control-static">
					 <label>Doc Type</label> :
					<?php if($editrow['doctype']=='h')
				         {
						   echo "Hard Copy";	 
						 }
						 else
						 {
							echo "Soft Copy";	 
						 
						 } ?>
					</p>
                </div>
				 </div>
				<div class="col-md-4">
              <div class="form-group">
                              
                                <p>  <label>Date</label>: <?php echo date('d-m-Y',strtotime($editrow['inwdate']))?></p>
                                
                            </div>
							 </div>
				<div class="col-md-4">
				<label>Doc File  </label>
				<a href="../uploads/inward/<?php echo $_GET['id'].".".$editrow['docfile']?>" download> Download Here</a></span>
				</div>
               
            </form>
            <div class="alert alert-success" style="display:none">Updated Successfully!!!</div>
            </div>
            </div>
            
        </div>
    </div>
</div>
</div>
<script>
</script>
<script src="js/validate.js"></script>

<script src="ckeditor/ckeditor.js"></script>
<?php $connection->close();include("footer.php")?>
