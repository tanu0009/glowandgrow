<?php session_start();

if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}

//if(!in_array(4,$_SESSION['adrole'])){header("location:404.php");}

require_once("db/conn.php");

$editq="SELECT * FROM wr_mst_student WHERE sid=".$_GET['id'];

$editr=$connection->query($editq);

if($editr->num_rows!=1)header("location:404.php");

$editrow=$editr->fetch_assoc();

$editr->free();


$webpagetitle=$pagetitle="Update Student";

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
                               
                                    <div class="col-sm-6">

                                        <div class="form-group">

                                                <label>Name<span class="require">*</span></label>

                                                <input type="text" class="form-control" name="sname" id="sname" maxlength="50" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid name" value="<?php echo $editrow['sname'];?>">

                                        </div>

                                    </div>
                                    
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                                <label>Branch<span class="require">*</span></label>

                                                <input type="text" class="form-control" name="branch" id="branch" maxlength="50" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid branch" value="<?php echo $editrow['branch'];?>">

                                        </div>

                                    </div>
                                    
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                                <label>Class<span class="require">*</span></label>

                                                <input type="text" class="form-control" name="class" id="class" maxlength="30" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid class" value="<?php echo $editrow['class'];?>">

                                        </div>

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