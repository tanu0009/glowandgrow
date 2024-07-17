<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
//if(!in_array(4,$_SESSION['adrole'])){header("location:404.php");}
require_once("db/conn.php");
$editq="SELECT * FROM lad_mst_news WHERE news_id=".$_GET['id'];
$editr=$connection->query($editq);
if($editr->num_rows!=1)header("location:404.php");
$editrow=$editr->fetch_assoc();
$editr->free();
$webpagetitle=$pagetitle="Edit News";
include("header.php");
?>
			<a href="news.php" class="btn btn-info pull-right"><i class="fa fa-angle-left mrm"></i>Go Back</a>
          <!--  <div class="clearfix"></div>
        </div>-->
        <!--BEGIN CONTENT-->
        <div class="page-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <form role="form" method="post" id="updateform">
                                <input type="hidden" name="uid" id="uid" value="<?php echo $_GET['id']?>" readonly>
                               <div class="row">
                               		<div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Title<span class="require">*</span></label>
                                            <input type="text" class="form-control" name="news_title" id="news_title" maxlength="50" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Title" value="<?php echo $editrow['news_title'];?>">
                                        </div>
                                    </div>
                               		</div>
                                    
                                    <div class="row">
                                	<div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                          <textarea class="form-control ckeditor" name="news_descript" id="news_descript"><?php echo  $editrow['news_descript'];?></textarea>
                                        </div>
                                    </div>
                                    </div>
                                  
                            	<div class="note note-danger displaynone"></div>
                                <button type="submit" class="btn btn-primary" data-loading-text="Submitting...">Save</button>
                                <button type="reset" class="btn btn-default" onClick="$('.note-danger').hide()">Reset</button>
                            </form>
                        </div>
                    </div>
            	</div>
            </div>
        </div>
        <!--END CONTENT-->
        
<script src="js/validate.js"></script>
<link href="css/jquery.fancybox.css" rel="stylesheet">
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/validate.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script>$('.fancybox').fancybox();</script>
<?php $connection->close();include("footer.php")?>