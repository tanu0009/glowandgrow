<?php session_start();

if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}

//if(!in_array(4,$_SESSION['adrole'])){header("location:404.php");}

require_once("db/conn.php");

$editq="SELECT * FROM lad_mst_tapshil WHERE tapshil_id=".$_GET['id'];

$editr=$connection->query($editq);

if($editr->num_rows!=1)header("location:404.php");

$editrow=$editr->fetch_assoc();

$editr->free();


$webpagetitle=$pagetitle="Update transaction";

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

                                    <div class="col-sm-4">

                                         <div class="form-group">

                                            <label>Name<span class="require">*</span></label>

                                            <input type="text" class="form-control" name="tapshil_name" id="tapshil_name" maxlength="50" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid Name" value="<?php echo $editrow['tapshil_name'];?>">

                                        </div>
                                    </div>

                                    <div class="col-sm-4">

                                       <div class="form-group">

                                            <label>Type</label>

                                           <select class="form-control" name="home_flag" id="home_flag" 
                                            data-validation="required" data-validation-optional="false" data-validation-error-msg="Invalid type">
                                            <option value="">Select</option>
                                               

                                            <option value="<?php echo 'r';?>" <?php if($editrow['home_flag'] == 'r'){?>selected="selected" <?php } ?>><?php echo 'Receipt';?></option>
                                             <option value="<?php echo 'p';?>"  <?php if($editrow['home_flag'] == 'p'){?>selected="selected" <?php } ?>><?php echo 'Payment';?></option>
                                            
                                               
											</select>
                                        </div>

                                    </div>


                                </div>

                              
                            	<div class="note note-danger displaynone"></div>

                                <button type="submit" class="btn btn-primary" data-loading-text="Submitting...">Update</button>

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