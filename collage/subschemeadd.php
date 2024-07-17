    <?php session_start();

    if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}

    //if(!in_array(4,$_SESSION['adrole'])){header("location:404.php");}

    require_once("db/conn.php");

    $webpagetitle=$pagetitle="New Equipment";

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
                               
                                    <div class="col-sm-3" style="display:none">

                                        <label>Scheme Name<span class="require">*</span></label>
                                        
                                        <select class="form-control" name="schem_id" id="schem_id" data-validation="required" data-validation-optional="false" data-validation-error-msg="Invalid scheme">
                                                <option value="">Select</option>
                                                <?php
                                                $lists="SELECT * FROM lad_scheme"; 
                                                $listq=$connection->query($lists);
												$i=1;
                                                while($listrow=$listq->fetch_assoc()){ ?>

                                                <option value="<?php echo $listrow['schem_id'];?>" selected="selected"><?php echo $listrow['scheme_name']; ?></option>
                                            
                                                <?php $i++; } $listq->free(); ?>
                                        
                                        </select>


                                    </div>

                                    <div class="col-sm-6">

                                        <div class="form-group">

                                                <label>Name<span class="require">*</span></label>

                                                <input type="text" class="form-control" name="sub_scheme_name" id="sub_scheme_name" maxlength="100" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid name">

                                        </div>

                                    </div>

                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <label>Amount<span class="require">*</span></label>

                                            <input type="number" class="form-control" name="sub_scheme_amnt" id="sub_scheme_amnt" maxlength="15" data-validation-optional="false" data-validation="required" data-validation-error-msg="Invalid amount">

                                        </div>

                                    </div>
                                    
                                    <div class="col-sm-3">

                                        <label>Refund<span class="require">*</span></label>
                                        
                                        <select class="form-control" name="refund_flag" id="refund_flag" data-validation="required" data-validation-optional="false" data-validation-error-msg="Invalid refund" flag>
                                                <option value="">Select</option>
                                                <option value="y">Yes</option>
                                                <option value="n">No</option>
                                               
                                        
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