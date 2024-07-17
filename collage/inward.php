<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
//if(!in_array($_SESSION['role'],array('su','op'))){header("location:404.php");exit;}
require_once("db/conn.php");
$pagename=substr(basename($_SERVER['PHP_SELF']),0,-4);
$webpagetitle=$pagetitle="Inward";
include("header.php");
include('../Pagination.php');
$limit = 20;
?>

<a href="inwardadd.php" class="btn btn-primary pull-right">New Inword<i class="fa fa-plus mlm"></i></a>
    <div id="page-content" >
        
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
            <div class="panel">
            		<div class="panel-body">
              			<div id="msg">
								<?php if(!empty($_GET['msg']) && strpos($_GET['msg'],'success')!=FALSE){?>
                                <div class="note note-success note-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php if($_GET['msg']=='add_success'){?>Added Successfully!!!<?php }?>
                                    <?php if($_GET['msg']=='update_success'){?>Updated Successfully!!!<?php }?>
                                    <?php if($_GET['msg']=='delete_success'){?>Record deleted Successfully<?php }?>
                                </div>
                                <?php }?>
                            </div>
                <div class="table-responsive">
                	<table class="table table-striped table-hover" id="dataTables-listing">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Inward No.</th>
                                <th>Outward Ref.</th>
                                <th>Inward Doc Name</th>
                           `	<th>Staff</th>
								<th>View </th>    
                                <th class="text-center">Edit</th>
                                
                                <th class="text-center">Delete</th>
                                <?php //}?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$listq="SELECT a.*,b.fname,b.lname,b.mname FROM lad_trn_inward a,lad_mst_teacher b WHERE a.staffsrno=b.staff_id  and a.active='y' ";
							
							$listr=$connection->query($listq);
                            $i=1;
                            while($listrow=$listr->fetch_assoc()){
								//subquery
								if(!empty($listrow['outwardsrno']))
								{
								$listq1="SELECT outwardsrno,docname FROM lad_trn_outward WHERE outwardsrno=".$listrow['outwardsrno']."";
                            $listr1=$connection->query($listq1);
							$listrow1=$listr1->fetch_assoc(); 
							$listr1->free();
							$sa=$listrow1['outwardsrno']." ".$listrow1['docname'];
								}else
								{$sa='NA';
								}
                            ?>
                            <tr>
                                <td><?php echo date('d-M-Y',strtotime($listrow['inwdate']))?></td>
                                <td><?php echo $listrow['inwardsrno']?></td>
                                <td><?php echo $sa;?></td>
                                <td><?php echo $listrow['docname']?></td>
                             
                                <td><?php echo $listrow['fname'].' '.$listrow['mname'].' '.$listrow['lname']; ?></td>
								<td><a href="idetails.php?id=<?php echo $listrow['inwardsrno']?>" class="btn btn-info btn-sm fancyboxajax"><i class="fa fa-eye"></i></a>
								</td>  
                                <td class="text-center"><form><button type="submit" name="id" value="<?php echo $listrow['inwardsrno']?>" formaction="inwardedit.php" class="btn btn-primary btn-sm"><i class="fa fa-pencil">Edit</i></button></form></td>
                                <?php /*?><td class="text-center"><button type="button" class="btn btn-sm btn-<?php if($listrow['active']!='n')echo "danger";else echo "success"?>" id="blockbtn<?php echo $i?>" onClick="blockUnblock('<?php echo $listrow['inwardsrno']?>','<?php echo $i?>');"><?php if($listrow['active']=='n')echo "Unlock";else echo "Lock"?></button></td>--><?php */?>
                               
                               <?php 
									$sqldel="select * from lad_trn_outward where inwardsrno ='".$listrow['inwardsrno']."'";
									$sqlcon=$connection->query($sqldel);
									$countr=$sqlcon->num_rows;
        							if($countr > 0)
									{										
							    
							   ?>
							   <td class="text-center"><form><button type="submit" class="btn btn-danger btn-sm" name="id" value="<?php echo $listrow['inwardsrno']?>" formaction="inwarddelete.php" onClick="return confirmDelete('<?php echo $listrow['docname']?>')" ><i class="fa fa-trash-o">Delete</i></button></form></td>
                               <?php 
									}
							   else
							   { 
							   ?> 
							      <td class="text-center"><form><button type="submit" class="btn btn-danger btn-sm" name="id" value="<?php echo $listrow['inwardsrno']?>" formaction="inwarddelete.php" onClick="return confirmDelete('<?php echo $listrow['docname']?>')" <?php if($listrow['returnable']=='y'){?>Disabled<?php }?>><i class="fa fa-trash-o"></i></button></form></td>
                              <?php
							   }
							  ?>
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
<link type="text/css" rel="stylesheet" href="css/dataTables/dataTables.bootstrap.min.css">
<script src="js/dataTables/jquery.dataTables.min.js"></script>
<script src="js/dataTables/dataTables.bootstrap.min.js"></script>
<script src="js/validate.js"></script>
<link type="text/css" rel="stylesheet" href="css/jquery.fancybox.css">
<script src="js/jquery.fancybox.pack.js"></script>
<script>$('#dataTables-listing').dataTable({order:[1,'asc']});
$('.fancybox').fancybox();
if($('#msg').html()!==''){
	setTimeout(function(){$('#msg').hide();},5000);
	if(location.search.substring(1).length){if(history!==undefined && history.replaceState!==undefined){history.replaceState({}, document.title, location.pathname+'<?php if(isset($_GET['id']))echo "?id=".$_GET['id']?>');}}
}
function confDel(){if(confirm('Are you sure you want to delete this record?'))return true;else return false;}

</script>
<?php /*?><link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
<link href="css/jquery.fancybox.css" rel="stylesheet">
<script src="js/jquery.fancybox.pack.js"></script><?php */?>
<script type="text/javascript">
<?php /*?>$('#dataTables-listing').dataTable({order:[0,'desc']});
function blockUnblock(id,btnid) {
	if(confirm("Confirm?")){
		if($('#blockbtn'+btnid).html()=='Lock')btnvalue='n';
		else btnvalue='y';
		$.ajax({
			type   : 'POST',
			url    : 'inwardlock.php',
			data   : 'action='+btnvalue+'&id='+id,
			success: function(data){
				if(data=='Lock')$("#blockbtn"+btnid).html(data).removeClass('btn-success').addClass('btn-danger');else if(data=='Unlock')$("#blockbtn"+btnid).html(data).removeClass('btn-danger').addClass('btn-success');else if(data.substr((data.length)-4,4)=='.php')location=data;else alert(data);
			}
		});
	}else return false;
}
function confirmDelete(val){if(confirm('Really Delete '+val+'?'))return true;else return false;}
$('.fancyboxajax').fancybox({type:'ajax'});
$('.fancybox').fancybox();<?php */?>
</script>
<?php $connection->close();include("footer.php")?>
<script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
	//alert(page_num);
	var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
	var asd= $('#asd').val();
	 $.ajax({
        type: 'POST',
        url: 'member-ajax.php',
        data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&asd='+asd,
        beforeSend: function () {
            $('.loading-overlay').show();
        },
        success: function (html) {
			
            $('#posts_content').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
</script>