<?php 
session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
//if(!in_array(1,$_SESSION['adrole'])){header("location:404.php");}
require_once("db/conn.php");
$pagename=substr(basename($_SERVER['PHP_SELF']),0,-4);

$webpagetitle=$pagetitle="User";
include("header.php");
?>
<?php 

//if($_SESSION['loggedin_user'] == 'admin'){?>
<a href="useradd.php" class="btn btn-primary pull-right">New User<i class="fa fa-plus mlm"></i></a>

<?php //}?>
<div class="clearfix"></div>

<!--BEGIN CONTENT-->

 <div class="page-content">
<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-body">
				<?php if(!empty($_GET['msg']) && strpos($_GET['msg'],'success')!=FALSE){?>
				<div class="note note-success note-dismissable" id="msg">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?php if($_GET['msg']=='add_success'){?>Record added Successfully<?php }?>
					<?php if($_GET['msg']=='update_success'){?>Record updated Successfully<?php }?>
					<?php if($_GET['msg']=='delete_success'){?>Record deleted Successfully<?php }?>
					<?php if($_GET['msg']=='default_success'){?>Record set as cover picture Successfully<?php }?>
				</div>
				<?php }?>
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="dataTables-listing">
						<thead>
							<tr>
								<th width="5%">Sr. No. </th>
                                <th width="15%">Name </th>
                                <th width="15%">Type </th>
                               	<th width="10%">Mobile </th>
                                <th width="15%">Email </th>
                           <?php /*?>     <th class="text-center">View</th><?php */?>
                                <?php //if($_SESSION['loggedin_user'] == 'admin'){?>
                                <th width="10%" class="text-center">Edit</th>
								 <th width="10%" class="text-center">Status</th>
								<!--<th width="10%" class="text-center">Delete</th>-->
								<?php //}?>
							</tr>
						</thead>
						<tbody>
						 <?php
                         $i=1;
							 $listq="SELECT a.*,b.user_password,b.u_id,b.active FROM  lad_mst_teacher a,lad_mst_users b WHERE  a.staff_id=b.comman_id AND b.comman_role='USER'";
                            $listr=$connection->query($listq);
							while($listrow=$listr->fetch_assoc()){
								/*$usrq="SELECT u_id FROM mo_trn_sales_followup  WHERE  u_id='".$listrow['u_id']."'";
                            $usrr=$connection->query($usrq);
							$usrcnt=$usrr->num_rows;
							$usrr->free();*/
							?>
							<tr>
								<td><?php echo $i;?></td>
                                <td><?php echo $listrow['fname'];?></td>
                                 <td><?php echo $listrow['desig_name'];?></td>
                                <td><?php echo $listrow['mobile_no'];?></td>
                                <td><?php echo $listrow['email_address'];?></td>
 								<td class="text-center"><form>
                               
                                <button type="submit" name="id" value="<?php echo $listrow['staff_id'];?>" formaction="<?php echo $pagename?>edit.php" class="btn btn-primary btn-sm">Edit<i class="fa fa-pencil mlm"></i></button></form></td>
                                  <td class="text-center"><button type="button" value="<?php echo $listrow['u_id']?>" class="btn btn-sm btn-<?php if($listrow['active']!='n')echo "danger";else echo "success"?> delbtn" ><?php if($listrow['active']=='n')echo 'Enable<i class="fa fa-check mlm"></i>';else echo 'Disable<i class="fa fa-close mlm"></i>'?></button></td>
                                            
								
                              <!--  <td class="text-center"><form>
                                <button type="submit" name="id" value="<?php echo $listrow['staff_id']?>" formaction="<?php echo $pagename?>delete.php" class="btn btn-danger btn-sm" onClick="return confDel()" <?php if($usrcnt!=0){?> disabled="disabled"<?php }?>>Delete<i class="fa fa-trash mlm"></i></button></form></td>-->
                                
							</tr>
							<?php $i++;}$listr->free()?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
        <!--END CONTENT-->
<link type="text/css" rel="stylesheet" href="css/dataTables/dataTables.bootstrap.min.css">
<script src="js/dataTables/jquery.dataTables.min.js"></script>
<script src="js/dataTables/dataTables.bootstrap.min.js"></script>

<link type="text/css" rel="stylesheet" href="css/jquery.fancybox.css">
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/validate.js"></script>
<script>
$('.fancybox').fancybox();
$('#dataTables-listing').dataTable();
if($('#msg').html()!==''){
	setTimeout(function(){$('#msg').hide();},5000);
	if(location.search.substring(1).length){if(history!==undefined && history.replaceState!==undefined){history.replaceState({}, document.title, location.pathname+'<?php if(isset($_GET['id']))echo "?id=".$_GET['id']?>');}}
}
function confDel(){if(confirm('Are you sure you wnat to delete this User ?'))return true;else return false;}
</script>
<?php $connection->close();include("footer.php")?>