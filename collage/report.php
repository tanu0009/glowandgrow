<?php require_once("db/conn.php");

$listm="SELECT * FROM wr_mst_project where pid =".base64_decode($_GET['id']);
$listmr=$connection->query($listm); 
$listmrow=$listmr->fetch_assoc();
$listmr->free();

$loginq="SELECT 	*
			  FROM		wr_mst_teacher
			  WHERE 	tid=".$listmrow['tid']."";
			 
			 $teacherr=$connection->query($loginq); 
$teamrow=$teacherr->fetch_assoc();
$teacherr->free();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Project report</title>
</head>

<body>
<table width="100%">
<tr>
	<td colspan="2"><h3>K.K.Wagh Institute Of Engineering Education And Research</h3>
    <h4>Amrutdham, panchavati, Nashik-422003<br/>K.K.WIEER WORKSHOP</h4></td>
   
</tr>
<tr>
	<td>TO<br/>
    Principal<br/>
KKWIEER,Nashik </td>
    <td> Date : <?php echo date('Y-m-d');?> </td>
</tr>
<tr>
	<td colspan="2"><br/>Subject: Permission to carry out the project under a workshop <br/><br/>
Respected sir,<br/><br/>
concerning the above subject, we would like to carry out the project under the workshop lab of the KkWagh Institute of Engineering and Research. the details are as follows,<br/><br/></td>
   
</tr>

<tr>
	<td><table border="1" width="100%"><tr><td>Title of Project:</td>
    										<td> <?php echo $listmrow['project_name'];?></td>
                                        </tr>
                                        <tr><td>Type of Project:</td>
    										<td> <?php echo $listmrow['mtype'];?></td>
                                        </tr>
                                        <tr><td>Details of Students working on a project:</td>
    										<td><table border="1" width="100%"><tr><th>Sr.</th><th>Name</th> <th>Class</th> <th>Branch</th></tr>
                                            <?php
                                        $sqq="SELECT * FROM wr_mst_project_sub where rec_id=".base64_decode($_GET['id'])."";
                                        $sqrr=$connection->query($sqq); 
										$i=1;
                                        while($srow=$sqrr->fetch_assoc()){
											$aaq="SELECT 	*
											  FROM		wr_mst_student
											  WHERE 	sid=".$srow['tapshil_id']."";
											 
											 $aar=$connection->query($aaq); 
								$aarow=$aar->fetch_assoc();
								$aar->free();
											?>
                                            <tr><td><?php echo $i;?></td><td><?php echo $aarow['sname'];?></td> <td><?php echo $aarow['class'];?></td> <td><?php echo $aarow['branch'];?></td></tr>
                                            <?php $i++;}?></table>
                                            </td>
                                        </tr>
                                        <tr><td>Teacher Details of Faculty mentors:</td>
    										<td> Name : <?php echo $teamrow['tname'].",<br/> Branch : ".$teamrow['branch'].",<br/> Mobile : ".$teamrow['mobile'].",<br/> Email : ".$teamrow['email']?></td>
                                        </tr>
                                        
                                        <tr><td>Type of support required:</td>
    										<td> <?php echo $listmrow['support_type'];?></td>
                                        </tr>
                                        
                                        
                                        <tr><td>Duration of the project:</td>
    										<td><?php echo $listmrow['duration'];?></td>
                                        </tr>
                                        
                                        <tr><td>Outcomes of the project:</td>
    										<td> <?php echo $listmrow['otherdata'];?></td>
                                        </tr>
                                        <tr><td>Duration of the project:</td>
    										<td> --</td>
                                        </tr>
</table>
</tr>
<tr>
	<td ><br/><br/><br/><br/>Project Guide/Mentor:</td>
    <td ><br/><br/><br/><br/>Workshop Superintendent:</td>
   
</tr>
</table>
</body>
</html>