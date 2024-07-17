<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
//if(!in_array(3,$_SESSION['adrole'])){header("location:404.php");}
require_once("db/conn.php");
$pagename=substr(basename($_SERVER['PHP_SELF']),0,-4);
$webpagetitle=$pagetitle="Project List";
include("header.php");

?>
<a href="<?php echo 'projectadd.php'?>" class="btn btn-primary pull-right">New project<i class="fa fa-plus mlm"></i></a>
      
    <!-- <div class="clearfix"></div>
        </div> -->
        <!--BEGIN CONTENT-->
        <div class="page-content">
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
                                            <th>#</th>
                                            <!--<th class="text-left">Type</th>-->
                                            <th class="text-left">Name</th>
                                             <th class="text-left">Type</th>
                                             <th class="text-left">Facality</th>
                                            <th class="text-left">Duration</th>
                                            <th class="text-left">Student</th>
                                          
                                           	<!--<th class="text-center">Edit</th>-->
                                            <th class="text-center">Print</th>
                                            <th class="text-center">Delete</th>
                                         </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $listq="SELECT * FROM wr_mst_project order by project_name asc";
                                        $listr=$connection->query($listq); 
										$i=1;
                                        while($listrow=$listr->fetch_assoc()){
											$listm="SELECT * FROM wr_mst_teacher where tid =".$listrow['tid'];
											$listmr=$connection->query($listm); 
											$listmrow=$listmr->fetch_assoc();
											$listmr->free();
											$studq="SELECT sname FROM wr_mst_student where isadmin='y' AND sid in (select tapshil_id from wr_mst_project_sub where rec_id='".$listrow['pid']."') limit 1";
											$studr=$connection->query($studq); 
											$studrow=$studr->fetch_assoc();
											$studr->free();
																					
                                        ?>
                                        
                                        <tr>
                                        
                                        <td><?php echo $i; ?></td>
                                       <?php /*?> <td><?php echo "Medical Equipment"; ?></td><?php */?>
                                      	<td><?php echo $listrow['project_name']; ?></td>
                                        <td><?php echo $listrow['mtype']; ?></td>
                                         <td><?php echo $listmrow['tname']; ?></td>	
                                         <td><?php echo $listrow['duration']; ?></td>
                                          <td><?php echo $studrow['sname']; ?></td>
                                                                               
                                         <td><a href="report.php?id=<?php echo base64_encode($listrow['pid']);?>" target="_blank" ><i class="btn btn-primary btn-sm fa fa-print mlm" aria-hidden="true"></i></a></td>
                                          <td class="text-center">
                                                <form>
                                                    <button type="submit" name="id" value="<?php echo $listrow['pid'];?>" formaction="<?php echo $pagename?>delete.php" class="btn btn-danger btn-sm" onClick="return confDel()" <?php if($bdtcnt==1){?> disabled="disabled"<?php }?>>Delete<i class="fa fa-trash mlm"></i>
                                                    </button>
                                                </form>
                                            </td>
										
                                       </tr>
                                        <?php $i++; }
										$listr->free(); ?>
                                        
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
<?php $connection->close();include("footer.php")?>