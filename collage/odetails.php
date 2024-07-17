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
<div class="container-fluid well" style="width:1000px;margin:0">
<h3 style="text-align:center"><b>OutWard Details</b></h3>
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
                     
                        <p class="form-control-static"><label>OutWard No</label> :<?php echo $editrow['outwardsrno']?></p>
                    </div>
                 </div>
				<div class="col-md-4">
                
                    <div class="form-group">
						   <?php 
                                if($editrow['con_sr_no']!='NULL')
                                {	
                                     $listr=$connection->query("SELECT mem_no,first_name,last_name,middle_name FROM lad_member WHERE mem_id=".$editrow['con_sr_no']." AND active='y' ORDER BY first_name");
                                     $listrow=$listr->fetch_assoc(); 
                                 ?>
                                <p class="form-control-static"> 
                                    <label>OutWard To</label> : <?php echo $listrow['first_name']." ".$listrow['last_name'];?>
                                </p>
                           <?php
                           }
                           else if($editrow['mem_trn_id']!='NULL')
                                {	
                                     $listr=$connection->query("SELECT a.mem_id,a.mem_no,a.first_name,a.last_name,a.middle_name,b.mem_id FROM lad_member a, lad_trn_member b WHERE a.mem_id=b.mem_id AND b.mem_trn_id=".$editrow['mem_trn_id']." AND a.active='y' ORDER BY a.first_name");
                                     $listrow=$listr->fetch_assoc(); 
                                 ?>
                                <p class="form-control-static"> 
                                    <label>OutWard To</label> : <?php echo $listrow['first_name']." ".$listrow['last_name'];?>
                                </p>
                           <?php
                           }
                           else if($editrow['mem_trn_id']=$editrow['con_sr_no']='NULL')
                           {
                           ?>
                            
                            <label>OutWard To</label> :	<p class="form-control-static"><?php echo $editrow['inwfrom'] ?></p>
                       
                           <?php 
                           }
                           ?>
                    </div>
                    
                </div>
                
				<div class="col-md-4">
                	<div class="form-group">
                  		<p class="form-control-static"><label>Handed Over To</label>:<?php if(empty($editrow['personname'])){ echo "Self"; } else { echo $editrow['personname'];}?></p>
                  	</div>
				 </div>
                 
				<div class="col-md-4">
                    <div class="form-group">
              
                         <?php
                                $listr=$connection->query("SELECT staff_id,fname,mname,lname FROM lad_mst_teacher WHERE staff_id='".$editrow['staffsrno']."'");
                                $listrow=$listr->fetch_assoc();
                                        
                              ?>   
                        <p class="form-control-static">
                                <label>Staff Name </label> :<?php echo $listrow['fname'].' '.$listrow['mname'].' '.$listrow['lname']; ?>
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
                      
                        <p class="form-control-static"><label>Doc Name</label>: <?php echo $editrow['docname']?></p>
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
                              
                                <p><label>Date</label>:<?php echo date('d-m-Y',strtotime($editrow['outdate']))?></p>
                                
                   		</div>
                  </div>
				<div class="col-md-4">
				<label>Doc File:  </label>
                <?php if(!empty($editrow['docfile'])){ ?><span>
				<a href="../uploads/outward/<?php echo $editrow['docfile']?>" download>Download Here</a>
               
                </span> <?php }else{ ?>
					<span>Not Available<span> <?php }?>
				</div>
               
            </form>
            
            <div class="alert alert-success" style="display:none">Updated Successfully!!!</div>
            </div>
            </div>
        </div>
    </div>
</div>
<script src="js/validate.js"></script>

<script src="ckeditor/ckeditor.js"></script>
<?php $connection->close();include("footer.php")?>

