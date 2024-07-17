<?php session_start();

if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}

//if(!in_array(4,$_SESSION['adrole'])){header("location:404.php");}

require_once("db/conn.php");

$editq="SELECT * FROM lad_mst_bank WHERE bid=".$_GET['id'];

$editr=$connection->query($editq);

if($editr->num_rows!=1)header("location:404.php");

$editrow=$editr->fetch_assoc();

$editr->free();


$webpagetitle=$pagetitle="Update Bank";

include("header.php");

?>

	<a href="javascript:void(0)" class="btn btn-info pull-right" onClick="history.back()"><i class="fa fa-angle-left mrm"></i>Go Back</a>

           

        <!--BEGIN CONTENT-->

        <div class="page-content">

            <div class="row">

                <div class="col-md-12">

                    <div class="panel">

                        <div class="panel-body">

                            <form role="form" id="updateform">
                                  
                                <input type="hidden" name="uid" id="uid" value="<?php echo $_GET['id']?>" readonly>

                                
                                
                                 <div class="row">
                               
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                                <label>Name<span class="require">*</span></label>

                                                <input type="text" class="form-control" name="bname" id="bname" maxlength="50" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid name" value="<?php echo $editrow['bname'];?>">

                                        </div>

                                    </div>
                                    
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                                <label>Branch<span class="require">*</span></label>

                                                <input type="text" class="form-control" name="bbranch" id="bbranch" maxlength="50" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid branch" value="<?php echo $editrow['bbranch'];?>">

                                        </div>

                                    </div>
                                    
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                                <label>Account No.<span class="require">*</span></label>

                                                <input type="text" class="form-control" name="bankac" id="bankac" maxlength="30" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid number" value="<?php echo $editrow['bankac'];?>">

                                        </div>

                                    </div>

                                    
                                    
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                                <label>IFSC No.<span class="require">*</span></label>

                                                <input type="text" class="form-control" name="bifsc" id="bifsc" maxlength="30" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid number" value="<?php echo $editrow['bifsc'];?>">

                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                	<div class="col-sm-3">

                                        <div class="form-group">

                                                <label>Account name.<span class="require">*</span></label>

                                                <input type="text" class="form-control" name="bmicr" id="bmicr" maxlength="100" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid name" value="<?php echo $editrow['bmicr'];?>">

                                        </div>

                                    </div>
                                    
                                    <div class="col-sm-3">

                                        <label>Account Type<span class="require">*</span></label>
                                        
                                        <select class="form-control" name="bactype" id="bactype" data-validation="required" data-validation-optional="false" data-validation-error-msg="Invalid type">
                                                <option value="">Select</option>
                                                 <option value="Saving" <?php if($editrow['bactype']=='Saving'){?> selected="selected"<?php }?>>Saving</option>
                                                  <option value="Current" <?php if($editrow['bactype']=='Current'){?> selected="selected"<?php }?>>Current</option>
                                               
                                        
                                        </select>


                                    </div>
                                </div>
                               
                                

                                 <div class="note note-danger displaynone"></div> 

                                <button type="submit" class="btn btn-primary" data-loading-text="Submitting...">update</button>

                                <button type="reset" class="btn btn-default" onClick="$('.note-danger').hide()">Reset</button>
                               
                            </form>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!--END CONTENT-->

<script src="js/validate.js"></script>

<script src="ckeditor/ckeditor.js"></script>



<?php $connection->close();include("footer.php")?>