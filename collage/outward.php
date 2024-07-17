<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
//if(!in_array($_SESSION['role'],array('su','op'))){header("location:404.php");exit;}
require_once("db/conn.php");
$pagename=substr(basename($_SERVER['PHP_SELF']),0,-4);
$webpagetitle=$pagetitle="Outward";
include("header.php");
?>
    <a href="outwardadd.php" class="btn btn-primary pull-right">New<i class="fa fa-plus mlm"></i></a>
	
    <div id="page-content">
       
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
             <div class="panel">
				  <div class="panel-body">
                <?php if(!empty($_GET['msg']) && strpos($_GET['msg'],'success')!=FALSE){?>
                <div class="alert alert-success alert-dismissable">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            		<?php if($_GET['msg']=='add_success'){?>Added Successfully!!!<?php }?>
            		<?php if($_GET['msg']=='update_success'){?>Updated Successfully!!!<?php }?>
            		<?php if($_GET['msg']=='delete_success'){?>Deleted Successfully!!!<?php }?>
                </div>
            	<?php }elseif(!empty($_GET['msg']) && $_GET['msg']=='delete_failed'){?>
                <div class="alert alert-danger">Delete Failed. Please try again.</div>
                <?php }?>
                <div class="table-responsive">
                	<table class="table table-striped table-hover" id="dataTables-listing">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Outward No.</th>
                                <th>Outward Doc Name</th>
                                <th>INV/RefNo</th>
                                <th>Staff</th> 
								<!--<th>View</th>--> <?php //if($_SESSION['role']=='su'){?>
                                <th class="text-center">Edit</th>
                                <!--<th class="text-center">Lock / Unlock</th>-->
                                <th class="text-center">Delete</th>
                                <?php //}?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
						 	$listq="SELECT a.*,b.fname,b.lname,b.mname FROM lad_trn_outward a,lad_mst_teacher b WHERE a.staffsrno=b.staff_id  and a.active='y' ";
							//echo $listq;
							//if($_SESSION['role']=='op')$listq.=" AND b.staffsrno=".$_SESSION['staffsrno'];
							$listr=$connection->query($listq);
                            $i=1;
                            while($listrow=$listr->fetch_assoc()){
								//subquery
								if(!empty($listrow['inwardsrno']))
								{
								$listq1="SELECT inwardsrno,docname FROM lad_trn_inward WHERE inwardsrno=".$listrow['inwardsrno']."";
								$listr1=$connection->query($listq1);
								$listrow1=$listr1->fetch_assoc(); 
								$listr1->free();
								$sa=$listrow1['inwardsrno']." ".$listrow1['docname'];
									}else
									{$sa='NA';
									}
								?>
                            <tr>
                                <td><?php echo date('d-M-Y',strtotime($listrow['outdate']))?></td>
                                <td><?php echo $listrow['outwardsrno']?></td>
                                <td><?php echo $listrow['docname']?></td>
                                <td><?php echo $sa;?></td>
                                <td><?php echo $listrow['fname'].' '.$listrow['mname'].' '.$listrow['lname']?></td>
                             <?php /*?> <td><a href="odetails.php?id=<?php echo $listrow['outwardsrno']?>" class="btn btn-info btn-sm fancyboxajax"><i class="fa fa-eye"></i></a></td><?php */?>
						 <?php //if($_SESSION['role']=='su'){?>
							<td class="text-center"><form><button type="submit" name="id" value="<?php echo $listrow['outwardsrno']?>" formaction="outwardedit.php" class="btn btn-primary btn-sm"><i class="fa fa-pencil">Edit</i></button></form></td>
                           
							  <?php /*?><!--   <td class="text-center"><button type="button" class="btn btn-sm btn-<?php if($listrow['active']!='n')echo "danger";else echo "success"?>" id="blockbtn<?php echo $i?>" onClick="blockUnblock('<?php echo $listrow['outwardsrno']?>','<?php echo $i?>');"><?php if($listrow['active']=='n')echo "Unlock";else echo "Lock"?></button></td>--><?php */?>
                                <td class="text-center"><form><button type="submit" class="btn btn-danger btn-sm" name="id" value="<?php echo $listrow['outwardsrno']?>" formaction="outwarddelete.php" onClick="return confirmDelete('<?php echo $listrow['docname']?>')"><i class="fa fa-trash-o">Delete</i></button></form></td>
                                <?php //}?>
                            </tr>
                            <?php
                                $i++;
                            }$listr->free();
                            ?>
                        </tbody>
                    </table>
            	</div>
                </div>
                </div>
            </div>
        </div>
    </div>
<!-- DataTables JavaScript -->
<!--<link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
<link href="css/jquery.fancybox.css" rel="stylesheet">
<script src="js/jquery.fancybox.pack.js"></script>
<script type="text/javascript">
$('#dataTables-listing').dataTable({order:[0,'desc']});
function blockUnblock(id,btnid) {
	if(confirm("Confirm?")){
		if($('#blockbtn'+btnid).html()=='Lock')btnvalue='n';
		else btnvalue='y';
		$.ajax({
			type   : 'POST',
			url    : 'outwardlock.php',
			data   : 'action='+btnvalue+'&id='+id,
			success: function(data){
				if(data=='Lock')$("#blockbtn"+btnid).html(data).removeClass('btn-success').addClass('btn-danger');else if(data=='Unlock')$("#blockbtn"+btnid).html(data).removeClass('btn-danger').addClass('btn-success');else if(data.substr((data.length)-4,4)=='.php')location=data;else alert(data);
			}
		});
	}else return false;
}
function confirmDelete(val){if(confirm('Really Delete '+val+'?'))return true;else return false;}
$('.fancyboxajax').fancybox({type:'ajax'});
</script>-->
<script src="js/validate.js"></script>
<?php $connection->close();include("footer.php")?>