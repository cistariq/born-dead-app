<?php

    require 'Common/functions.php';	
	$USER_ID = $_SESSION["USER_ID"];
	$USER_PSW = $_SESSION["USER_PSW"];
	$USER_TYPE = $_SESSION["USER_TYPE"];
	
	if( empty($USER_ID) || empty($USER_PSW) || ($USER_TYPE!=4 && $USER_TYPE != 5))
	{
		header("Location: index.php?msg=2");
		exit();
	}

 
	   $c = Connect(); 
 			   $job_cd= $_GET["id"];
			 
			  
			   $curs_job = oci_new_cursor($c);
			
            $stmt_job = oci_parse($c , "begin STATICS.GET_ALL_JOBS(:INPUT,:JOB); end;");
			oci_bind_by_name($stmt_job,":INPUT",$job_cd,32);
			oci_bind_by_name($stmt_job,":JOB",$curs_job,-1,OCI_B_CURSOR);
			oci_execute($stmt_job);
            oci_execute($curs_job);
			  
  $entry = oci_fetch_assoc($curs_job) ;		  
	
  echo "<input type='hidden' name='DEAD_D_JOB_CD' id='DEAD_D_JOB_CD' value=".$entry{'JOB_CODE'}." />"; 	

	        		 



//echo $ICD_CD;		  
oci_close($c);


?>