<?php session_start();
if(!isset($_SESSION['XUID']) || !isset($_SESSION['XUSRNM'])){session_destroy();header("location:login.php");}
require_once("db/conn.php");
$webpagetitle="Change Password";
include("header.php");
?>	 <!-- <div class="clearfix"></div>
        </div>-->
      <!--  BEGIN CONTENT
       <div class="page-content">-->
            <div class="row">
                <div class="col-md-5">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="note note-danger displaynone"></div>
                            <div class="note note-success note-dismissable displaynone"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password changed Successfully !!!</div>
            
                            <form id="passform" role="form">
                                <div class="form-group">
                                    <label>Current Password</label>
                                    <input type="password" class="form-control" name="cur_pass" id="cur_pass" maxlength="30" data-validation="length" data-validation-length="6-30" data-validation-error-msg="6-30 characters required">
                                </div>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <div class="input-icon right">
                                        <i class="fa fa-eye displaynone" onClick="if($('#password_confirmation').attr('type')=='password')$('#password_confirmation').attr('type','text');else $('#password_confirmation').attr('type','password')" style="cursor:pointer;display:none"></i>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" maxlength="30" data-validation="length" data-validation-length="6-30" data-validation-error-msg="6-30 characters required" onKeyUp="if(this.value!='')$(this).siblings().show();else $(this).siblings().hide();">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Re-type Password</label>
                                    <input type="password" class="form-control" name="password" id="password" maxlength="30" data-validation="confirmation" data-validation-error-msg="Passwords DO NOT match">
                                </div>
                                <button type="submit" class="btn btn-primary" data-loading-text="Submitting...">Save</button>
                                <button type="reset" class="btn btn-default" onClick="$('.note-danger,.note-success').hide()">Reset</button>
                            </form>
                        </div>
                    </div>
            	</div>
            </div>
        </div>
        <!--END CONTENT-->
<script>$.validate({modules:'security',form:'#passform',onSuccess:function(){$('#passform button[type=submit]').button('loading');$('#addform button[type=reset]').attr('disabled','disabled');$('.note-danger,.note-success').hide();$.ajax({type:'POST',url:'changepass_save.php',data:new FormData($('#passform')[0]),contentType:false,processData:false,success:function(data){if(data=='success'){$('#passform')[0].reset();$('.note-success').show();}else if(data.substr((data.length)-4,4)=='.php')location=data;else{$('.note-danger').html(data).show();}$('#passform button[type=submit]').button('reset');$('#addform button[type=reset]').removeAttr('disabled');}});return false;}});</script>
<?php $connection->close();include("footer.php")?>