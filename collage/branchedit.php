<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
//if(!in_array(4,$_SESSION['adrole'])){header("location:404.php");}
require_once("db/conn.php");

$editq="SELECT * FROM lad_mst_branch WHERE cat_id=".$_GET['id'];
$editr=$connection->query($editq);
if($editr->num_rows!=1)header("location:404.php");
$editrow=$editr->fetch_assoc();
$editr->free();

$webpagetitle=$pagetitle="Edit Branch";
include("header.php");
?>
			<a href="branch.php" class="btn btn-info pull-right"><i class="fa fa-angle-left mrm"></i>Go Back</a>
          <!--  <div class="clearfix"></div>
        </div>-->
        <!--BEGIN CONTENT-->
        <div class="page-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <form role="form" id="updateform">
                                <input type="hidden" name="uid" id="uid" value="<?php echo $_GET['id']?>" readonly>
                               <div class="row">
                               		
                               		<div class="col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <label>Branch Name<span class="require">*</span></label>
                                            <input type="text" class="form-control" name="gal_caption" id="gal_caption" maxlength="20" value="<?php echo $editrow['cat_name']?>" data-validation="required" data-validation-optional="false"  data-validation-error-msg="Invalid Caption">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Address Sequence<span class="require">*</span></label>
                                            <select class="form-control" name="sortby" id="sortby" data-validation="required" data-validation-optional="false" data-validation-error-msg="Invalid Sequence">
                                            	<option value="">Select</option>
                                                <?php
												for($i=1;$i<50;$i++)
												{?>
                                                <option value="<?php echo $i; ?>" <?php if ($editrow['sortby'] == $i ){ ?> selected="selected"<?php } ?>><?php echo $i; ?></option>
												<?php }
												?>
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                                    
                                    
                                    <div class="row">
                                	<div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                          <textarea class="form-control ckeditor" name="address" id="address" maxlength="500" rows="3"><?php echo  $editrow['address'];?></textarea>
                                        </div>
                                    </div>
                                    </div>
                                    
                                    <div class="row">
                                	<div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Google Location</label>
                                          <textarea class="form-control ckeditor" name="goaddress" id="goaddress" maxlength="500" rows="3"><?php echo  $editrow['goaddress'];?></textarea>
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
<script src="ckeditor/ckeditor.js"></script>
<script>$('.fancybox').fancybox();</script>
<?php $connection->close();include("footer.php")?>