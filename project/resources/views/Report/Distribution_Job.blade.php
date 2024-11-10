		<?php
   // session_start();
   	require '../Common/functions.php';
	
	$USER_ID = $_SESSION["USER_ID"];
	$USER_PSW = $_SESSION["USER_PSW"];
	$USER_TYPE = $_SESSION["USER_TYPE"];
	
	if( empty($USER_ID) || empty($USER_PSW) || ($USER_TYPE != 2 && $USER_TYPE != 3 && $USER_TYPE != 5))
	{
		header("Location: ../index.php?msg=2");
		exit();
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="js/ajax.js"></script>  
<script type="text/javascript" src="../js/sortable.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=windows-1256" />
<title>توزيع المواليد حسب المهنة</title>
<meta name="description" content="Health care website">
<meta name="keywords" content="health, care, healthcare">
<link href="../Style/Style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FF0000}
.style15 {	font-family: "Arabic Transparent", Andalus;
	font-weight: bold;
	font-size: 16px;
}
-->
</style>
</head>

<body onload="checkJavaScriptValidity()">
 <p>
   <?PHP
$date_F=$_GET['from'];
$date_T= $_GET['to'];
$c = Connect(); 
$curs_F = oci_new_cursor($c);
$stmt_F = oci_parse($c , "begin AGES_BIRTHS.GET_FATHERS_JOB(:F_DATE_FROM,:F_DATE_TO,:FATHER); end;");
$curs_F_C= oci_new_cursor($c);
$stmt_F_C = oci_parse($c , "begin AGES_BIRTHS.GET_FATHERS_COUNT(:F_DF,:F_DT,:FATHER_C); end;");

$curs_M = oci_new_cursor($c);
$stmt_M= oci_parse($c , "begin AGES_BIRTHS.GET_MOTHERS_JOB(:M_DATE_FROM,:M_DATE_TO,:MOTHER); end;");
$curs_M_C= oci_new_cursor($c);
$stmt_M_C = oci_parse($c , "begin AGES_BIRTHS.GET_MOTHERS_COUNT(:M_DF,:M_DT,:MOTHER_C); end;");


oci_bind_by_name($stmt_F,":F_DATE_FROM",$date_F,32);
oci_bind_by_name($stmt_F,":F_DATE_TO",$date_T,32);
oci_bind_by_name($stmt_F,":FATHER",$curs_F,-1,OCI_B_CURSOR);
oci_bind_by_name($stmt_M,":MOTHER",$curs_M,-1,OCI_B_CURSOR);

oci_bind_by_name($stmt_M,":M_DATE_FROM",$date_F,32);
oci_bind_by_name($stmt_M,":M_DATE_TO",$date_T,32);

oci_bind_by_name($stmt_F_C,":F_DF",$date_F,32);
oci_bind_by_name($stmt_F_C,":F_DT",$date_T,32);

oci_bind_by_name($stmt_M_C,":M_DF",$date_F,32);
oci_bind_by_name($stmt_M_C,":M_DT",$date_T,32);

oci_bind_by_name($stmt_F_C,":FATHER_C",$curs_F_C,-1,OCI_B_CURSOR);
oci_bind_by_name($stmt_M_C,":MOTHER_C",$curs_M_C,-1,OCI_B_CURSOR);
oci_execute($stmt_F);
oci_execute($curs_F);
oci_execute($stmt_M);
oci_execute($curs_M);

oci_execute($stmt_F_C);
oci_execute($curs_F_C);
oci_execute($stmt_M_C);
oci_execute($curs_M_C);

$FATHER_ROW=oci_fetch_assoc($curs_F_C);
$MOTHER_ROW=oci_fetch_assoc($curs_M_C);


$curs = oci_new_cursor($c);
$stmt = oci_parse($c , "begin USER_PROFILE.GET_USER_PROFILE(:un,:up,:user_curs); end;");
oci_bind_by_name($stmt,":un",$USER_ID,32);
oci_bind_by_name($stmt,":up",$USER_PSW,32);
oci_bind_by_name($stmt,":user_curs",$curs,-1,OCI_B_CURSOR);

oci_execute($stmt);
oci_execute($curs);

$ROW1=oci_fetch_assoc($curs); 


?>
</p>
 <table width="200" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <th scope="col"><a href="Distribution_form.php">......عودة</a></th>
   </tr>
 </table>
 <p></p>
<P>
</P>

 <table width="524" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <th width="95" scope="col"><div align="right"><?php echo $date_T;?></div></th>
     <th width="43" scope="col">:الى</th>
     <th width="95" scope="col"><div align="right"><?php echo $date_F;?></div></th>
     <th width="236" scope="col">:توزيع المواليد حسب المهنة من تاريخ</th>
   </tr>
 </table>
<P></P>
<table class="sortable"  id="anyid" width="434" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">
   <tr>
     <th width="138" bgcolor="#91B641">النسبة المئوية</th>
     <th width="93" bgcolor="#91B641"><div align="center"><strong>الآباء</strong></div></th>
     <th width="195" bgcolor="#91B641"><div align="center"><strong>المهنة</strong></div></th>
   </tr>
   <?php $TPERCENT=0;  while ( $entry_F = oci_fetch_assoc($curs_F)) {
   $TPERCENT=$TPERCENT+($entry_F{'COUNTER'}/$FATHER_ROW{'C_F'}*100);
   
   ?>
   <tr>
     <td><div align="center"><?PHP echo number_format(($entry_F{'COUNTER'}/$FATHER_ROW{'C_F'})*100,2,'.',''); echo '%'; ?></div></td>
     <td><div align="center"><?PHP echo $entry_F{'COUNTER'}; ?></div></td>
     <td width="195"><div align="center"><?PHP echo $entry_F{'JOB_NAME_AR'}; ?></div></td>
   </tr>
   
   <?php
          }
		  ?>
   <tr class="sortbottom">
     <td><div align="center"><?PHP echo number_format($TPERCENT,2,'.',''); echo '%'; ?></div></td>
     <td><div align="center"><?PHP echo $FATHER_ROW{'C_F'};?></div></td>
     <td><div align="center"><strong>المجموع</strong></div></td>
   </tr>
   <?PHP 
		   OCIFreeStatement($curs_F); 
		   OCIFreeCursor($stmt_F); 
           

		  ?>
</table>
 <p></p>
 <p>&nbsp; </p>
<table class="sortable"  id="anyid2" width="434" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">
   <tr>
     <th width="137" bgcolor="#91B641">النسبة المئوية</th>
     <th width="94" bgcolor="#91B641"><div align="center"><strong>الأمهات</strong></div></th>
     <th width="195" bgcolor="#91B641"><div align="center"><strong>المهنة</strong></div></th>
   </tr>
   <?php $TPERCENT1=0; while ( $entry_M = oci_fetch_assoc($curs_M)) { 
   $TPERCENT1=$TPERCENT1+($entry_M{'COUNTER'}/$MOTHER_ROW{'C_M'}*100);
   ?>
   <tr>
     <td><div align="center"><?PHP echo number_format(($entry_M{'COUNTER'}/$MOTHER_ROW{'C_M'})*100,2,'.',''); echo '%'; ?></div></td>
     <td><div align="center"><?PHP echo $entry_M{'COUNTER'}; ?></div></td>
     <td width="195"><div align="center"><?PHP echo $entry_M{'JOB_NAME_AR'}; ?></div></td>
   </tr>
   
   <?php
          }
		  ?>
  <tr class="sortbottom">
     <td><div align="center"><?PHP echo number_format($TPERCENT1,2,'.',''); echo '%'; ?></div></td>
     <td><div align="center"><?PHP echo $MOTHER_ROW{'C_M'};?></div></td>
     <td><div align="center"><strong>المجموع</strong></div></td>
  </tr>
   <?PHP 
		   OCIFreeStatement($curs_M); 
		   OCIFreeCursor($stmt_M); 
           OCILogoff($c); //Alias of oci_close()

		  ?>
</table>
<p></p>
 <table width="622" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <th width="227" height="27" scope="col"><div align="right" class="style15"><?php echo  $ROW1{'USER_FULL_NAME'}; ?></div>
          <div align="right" class="style15"></div></th>
      <th width="82" scope="col"><span class="style17 style1">:منشئ التقرير</span></th>
      <th width="188" scope="col"><span class="style15"><?PHP echo date('d/m/Y H:i',time());?></span></th>
      <th width="125" scope="col"><span class="style1">:تاريخ ووقت الطباعة</span></th>
    </tr>
</table>
<P></P>
 <table width="466" border="0" cellpadding="0" cellspacing="0">
   <tr>
     <th width="283" scope="col">&nbsp;</th>
     <th width="183" scope="col"><div align="left"><img src="../images/logo.jpg" width="89" height="48" /></div></th>
   </tr>
 </table>
<p></p>
</body>
</html>
