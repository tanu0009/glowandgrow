<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
//if(!in_array(3,$_SESSION['adrole'])){header("location:404.php");}
require_once("db/conn.php");
$pagename=substr(basename($_SERVER['PHP_SELF']),0,-4);
$webpagetitle=$pagetitle="Bank List";
include("header.php");
?>
<a href="<?php echo 'bankadd.php'?>" class="btn btn-primary pull-right">New Bank<i class="fa fa-plus mlm"></i></a>
      
    <!--<div class="clearfix"></div>
        </div>-->
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
                                            <th class="text-left">Name</th>
                                           <th class="text-left">Branch</th>
                                            <th class="text-left">AC number</th>
                                            <th class="text-left">IFSC</th>
                                            <th class="text-left">Account Name</th>
                                            <th class="text-left">AcType</th>
                                            <th class="text-center">Edit</th>
                                            <th class="text-center">Enable / Disable</th>
                                            <!--<th class="text-center">Delete</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $listq="SELECT * from lad_mst_bank";
                                        $listr=$connection->query($listq); 
										$i=1;
                                        while($listrow=$listr->fetch_assoc()){
										?>
                                        <tr>
                                         <td><?php echo $i; ?></td>
                                         <td><?php echo $listrow['bname']; ?></td>
                                         <td><?php echo $listrow['bbranch'];?></td>
                                         <td><?php echo $listrow['bankac'];?></td>
                                          <td><?php echo $listrow['bifsc'];?></td>
                                           <td><?php echo $listrow['bactype'];?></td>
                                           <td><?php echo $listrow['bmicr'];?></td>
                                         <td class="text-center">
                                            <form><button type="submit" name="id" value="<?php echo $listrow['bid']?>" formaction="<?php echo $pagename?>edit.php" class="btn btn-primary btn-sm" <?php if($trncnt>0){?> disabled="disabled"<?php }?>>Edit<i class="fa fa-pencil mlm"></i></button></form>
                                            </td>
                                        <td class="text-center">
                                            <button type="button" value="<?php echo $listrow['bid']?>" class="btn btn-sm btn-<?php if($listrow['active']!='n')echo "danger";else echo "success"?> delbtn" <?php if($trncnt>0){?> disabled="disabled"<?php }?>><?php if($listrow['active']=='n')echo 'Enable<i class="fa fa-check mlm"></i>';else echo 'Disable<i class="fa fa-close mlm"></i>'?></button>
                                        </td>
                                            <?php /*?><td class="text-center">
                                                <form>
                                                    <button type="submit" name="id" value="<?php echo $listrow['bid']?>" formaction="<?php echo $pagename?>delete.php" class="btn btn-danger btn-sm" onClick="return confDel()" <?php if($trncnt>0){?> disabled="disabled"<?php }?> <?php if($trncnt>0){?> disabled="disabled"<?php }?>>Delete<i class="fa fa-trash mlm"></i>
                                                    </button>
                                                </form>
                                            </td><?php */?>
                                
                                      
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
<script src="js/validate.js"></script>
<link type="text/css" rel="stylesheet" href="css/jquery.fancybox.css">
<script src="js/jquery.fancybox.pack.js"></script>
<script>$('#dataTables-listing').dataTable({order:[1,'asc']});
$('.fancybox').fancybox();
if($('#msg').html()!==''){
	setTimeout(function(){$('#msg').hide();},5000);
	if(location.search.substring(1).length){if(history!==undefined && history.replaceState!==undefined){history.replaceState({}, document.title, location.pathname+'<?php if(isset($_GET['id']))echo "?id=".$_GET['id']?>');}}
}
function confDel(){if(confirm(' Are you sure you want to delete this event ?'))return true;else return false;}
</script>
<?php $connection->close();include("footer.php")?>