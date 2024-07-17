<?php 
require_once("db/conn.php");

$addq="INSERT INTO wr_mst_student(sname,class,branch,username,userpassword,isadmin,created_by,created_on) VALUES('".$_POST['sname']."','".$_POST['class']."','".$_POST['branch']."','".$_POST['username']."','".$_POST['userpassword']."','y','1','".date('Y-m-d H:i')."')";

//echo $addq;
		
$addr=$connection->query($addq);
if($addr){
	echo "Dear ".$_POST['sname'].",<br/>Your User name is :".$_POST['username']."<br/>Your User Password is :".$_POST['userpassword']."<br/>Please login your application and fill project infomation.<br/>Thank you for your registration. ";
		?>
        
         <script>
                                            var timer = setTimeout(function() {
                                                window.location='index.html'
                                            }, 10000);
                                        </script>
        <?php 
	}
	else echo "An unknown error occured. Please try again.";

$connection->close();