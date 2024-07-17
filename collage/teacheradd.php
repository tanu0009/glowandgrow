    <?php session_start();

    if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}

    //if(!in_array(4,$_SESSION['adrole'])){header("location:404.php");}

    require_once("db/conn.php");

    $webpagetitle=$pagetitle="New Teacher";

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
                               
                                    <div class="col-sm-6">

                                        <div class="form-group">

                                                <label>Name<span class="require">*</span></label>

                                                <input type="text" class="form-control" name="tname" id="tname" maxlength="50" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid name">

                                        </div>

                                    </div>
                                    
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                                <label>Branch<span class="require">*</span></label>

                                                <input type="text" class="form-control" name="branch" id="branch" maxlength="50" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid branch">

                                        </div>

                                    </div>
                                    
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                                <label>Mobile<span class="require">*</span></label>

                                                <input type="text" class="form-control float" name="mobile" id="mobile" maxlength="13" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid mobile">

                                        </div>

                                    </div>

                                    
                                    
                                    
                                </div>
                                <div class="row">
                                	<div class="col-sm-6">

                                        <div class="form-group">

                                                <label>Email<span class="require">*</span></label>

                                                <input type="email" class="form-control" name="email" id="email" maxlength="50" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid email">

                                        </div>

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