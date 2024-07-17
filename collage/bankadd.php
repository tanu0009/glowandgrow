    <?php session_start();

    if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}

    //if(!in_array(4,$_SESSION['adrole'])){header("location:404.php");}

    require_once("db/conn.php");

    $webpagetitle=$pagetitle="New Bank";

    include("header.php");

    ?>
	<a href="javascript:void(0)" class="btn btn-info pull-right" onClick="history.back()"><i class="fa fa-angle-left mrm"></i>Go Back</a>

            <!--<div class="clearfix"></div>

        </div>-->

        <!--BEGIN CONTENT-->

        <div class="page-content">

            <div class="row">

                <div class="col-md-12">

                    <div class="panel">

                          <div class="panel-body">

                            <form role="form" id="addform">
                                <div class="row">
                               
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                                <label>Name<span class="require">*</span></label>

                                                <input type="text" class="form-control" name="bname" id="bname" maxlength="50" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid name">

                                        </div>

                                    </div>
                                    
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                                <label>Branch<span class="require">*</span></label>

                                                <input type="text" class="form-control" name="bbranch" id="bbranch" maxlength="50" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid branch">

                                        </div>

                                    </div>
                                    
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                                <label>Account No.<span class="require">*</span></label>

                                                <input type="text" class="form-control" name="bankac" id="bankac" maxlength="30" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid number">

                                        </div>

                                    </div>

                                    
                                    
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                                <label>IFSC No.<span class="require">*</span></label>

                                                <input type="text" class="form-control" name="bifsc" id="bifsc" maxlength="30" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid number">

                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                	<div class="col-sm-3">

                                        <div class="form-group">

                                                <label>Account Name<span class="require">*</span></label>

                                                <input type="text" class="form-control" name="bmicr" id="bmicr" maxlength="100" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid name">

                                        </div>

                                    </div>
                                    
                                    <div class="col-sm-3">

                                        <label>Account Type<span class="require">*</span></label>
                                        
                                        <select class="form-control" name="bactype" id="bactype" data-validation="required" data-validation-optional="false" data-validation-error-msg="Invalid type">
                                                <option value="">Select</option>
                                                 <option value="Saving">Saving</option>
                                                  <option value="Current">Current</option>
                                               
                                        
                                        </select>


                                    </div>
                                </div>
                                	

                

                            	 <div class="note note-danger displaynone"></div> 

                                <button type="submit" class="btn btn-primary" data-loading-text="Submitting...">Add</button>

                                <button type="reset" class="btn btn-default" onClick="$('.note-danger').hide()">Reset</button>
                               
                            </form>
                        </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!--END CONTENT-->

<script src="js/validate.js"></script>

<script src="ckeditor/ckeditor.js"></script>



<?php $connection->close();include("footer.php")?>