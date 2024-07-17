<?php session_start();

if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}

//if(!in_array(4,$_SESSION['adrole'])){header("location:404.php");}

require_once("db/conn.php");

$editq="SELECT * FROM lad_sub_scheme WHERE sub_scheme_id=".$_GET['id'];

$editr=$connection->query($editq);

if($editr->num_rows!=1)header("location:404.php");

$editrow=$editr->fetch_assoc();

$editr->free();


$webpagetitle=$pagetitle="Update Equipment";

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
                               
                                    <div class="col-sm-3" style="display:none">

                                        <label>Scheme Name<span class="require">*</span></label>
                                        
                                        <select class="form-control" name="schem_id" id="schem_id" data-validation="required" data-validation-optional="false" data-validation-error-msg="Invalid scheme">
                                                <option value="">Select</option>
                                                <?php
                                                $lists="SELECT * FROM lad_scheme"; 
                                                $listq=$connection->query($lists);

                                                while($listrow=$listq->fetch_assoc()){ ?>

                                                <option value="<?php echo $listrow['schem_id'];?>" <?php if($listrow['schem_id'] == $editrow['schem_id'] ){ ?> selected="selected"<?php } ?>><?php echo $listrow['scheme_name'];?></option>
                                            
                                                <?php } $listq->free()?>
                                        
                                        </select>


                                    </div>

                                    <div class="col-sm-6">

                                        <div class="form-group">

                                                <label>Name<span class="require">*</span></label>

                                                <input type="text" class="form-control" name="sub_scheme_name" id="sub_scheme_name" maxlength="100" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid name" value="<?php echo $editrow['sub_scheme_name'];?>">

                                        </div>

                                    </div>

                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <label>Amount<span class="require">*</span></label>

                                            <input type="number" class="form-control" name="sub_scheme_amnt" id="sub_scheme_amnt" maxlength="15" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid amount" value="<?php echo $editrow['sub_scheme_amnt'];?>">

                                        </div>

                                    </div>
                                    
                                    <div class="col-sm-3">

                                        <label>Refund<span class="require">*</span></label>
                                        
                                        <select class="form-control" name="refund_flag" id="refund_flag" data-validation="required" data-validation-optional="false" data-validation-error-msg="Invalid refund" flag>
                                                <option value="">Select</option>
                                                <option value="y" <?php if($editrow['refund_flag']=='y'){?> selected="selected"<?php }?>>Yes</option>
                                                <option value="n" <?php if($editrow['refund_flag']=='n'){?> selected="selected"<?php }?>>No</option>
                                               
                                        
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