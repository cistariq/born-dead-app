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
<title>توزيع المواليد حسب المحافظات  في قطاع غزة</title>
<meta name="description" content="Health care website">
<meta name="keywords" content="health, care, healthcare">
<link href="../Style/Style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style15 {font-family: "Arabic Transparent", Andalus;
	font-weight: bold;
	font-size: 16px;
}
.style18 {color: #FF0000}
.style21 {color: #000000;
	font-size: 16px;
}
.style22 {
	font-size: 16px;
	font-weight: bold;
	font-family: "Times New Roman", Times, serif;
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
$stmt_F = oci_parse($c , "begin DISTRIBUTION_SEX.GET_BORNS_CLINIC_M(:F_DATE_FROM,:F_DATE_TO,:SEX); end;");

oci_bind_by_name($stmt_F,":F_DATE_FROM",$date_F,32);
oci_bind_by_name($stmt_F,":F_DATE_TO",$date_T,32);
oci_bind_by_name($stmt_F,":SEX",$curs_F,-1,OCI_B_CURSOR);


oci_execute($stmt_F);
oci_execute($curs_F);

$curs = oci_new_cursor($c);
$stmt = oci_parse($c , "begin USER_PROFILE.GET_USER_PROFILE(:un,:up,:user_curs); end;");
oci_bind_by_name($stmt,":un",$USER_ID,32);
oci_bind_by_name($stmt,":up",$USER_PSW,32);
oci_bind_by_name($stmt,":user_curs",$curs,-1,OCI_B_CURSOR);

oci_execute($stmt);
oci_execute($curs);

$ROW1=oci_fetch_assoc($curs); 



            $list_user=array();
          	while ( $entry_F = oci_fetch_assoc($curs_F)) {
	        array_push($list_user,$entry_F);
	        }  


?>
</p>
<table width="200" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col"><a href="Distribution_form.php">......عودة</a></th>
  </tr>
</table>
<p></p>
<table width="542" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th width="95" scope="col"><div align="right"><?php echo $date_T;?></div></th>
    <th width="43" scope="col">:الى</th>
    <th width="95" scope="col"><div align="right"><?php echo $date_F;?></div></th>
    <th width="236" scope="col">:توزيع المواليد حسب الوزن من تاريخ</th>
  </tr>
</table>
<P></P>

<table  width="443" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">
 
   <tr>
     <th width="116" bgcolor="#91B641">النسبة المئوية</th>
     
     <th width="124" bgcolor="#91B641">العدد</th>
     <th width="195"  bgcolor="#91B641"><div align="center"><strong>أوزان المواليد</strong></div></th>
 </table>

   <p>
     <?php  
   foreach($list_user as $key=>$det_F1){
    
   ?>
   </p>
   <p></p>
   <table class="sortable"  id="anyid2" width="443" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">

   <tr>
     <th colspan="3" bgcolor="#91B641" class="unsortable">
     <div align="right"><?PHP echo $det_F1{'C_NAME'};?></div></th>
     </tr>
   <?php 
     $R_CODE=$det_F1{'CODE'};
     $curs_D = oci_new_cursor($c);
     $stmt_D = oci_parse($c , "begin DISTRIBUTION_SEX.GET_BORNS_WEIGHT(:CODE,:F_DATE_FROM1,:F_DATE_TO1,:SEX1); end;");

     oci_bind_by_name($stmt_D,":F_DATE_FROM1",$date_F,32);
     oci_bind_by_name($stmt_D,":F_DATE_TO1",$date_T,32);
	 oci_bind_by_name($stmt_D,":CODE",$R_CODE,32);
     oci_bind_by_name($stmt_D,":SEX1",$curs_D,-1,OCI_B_CURSOR);


     oci_execute($stmt_D);
     oci_execute($curs_D);

     while ( $entry_D = oci_fetch_assoc($curs_D)) {
   
   
   ?>
   <tr>
     <td width="116"><div align="center"><?PHP echo number_format(($entry_D{'FIRSTC'}/$entry_D{'TOTAL'})*100,2,'.',''); echo "%"; ?></div></td>
    <td width="124"><div align="center"><?PHP echo $entry_D{'FIRSTC'}; ?></div></td>
     <td width="195"><div align="center"><strong>&lt;1500</strong></div></td>
   </tr>
   <tr>
     <td><div align="center"><?PHP echo number_format(($entry_D{'SECONDC'}/$entry_D{'TOTAL'})*100,2,'.',''); echo "%"; ?></div></td>
     <td><div align="center"><?PHP echo $entry_D{'SECONDC'}; ?></div></td>
     <td><div align="center"><strong>1500-2000</strong></div></td>
   </tr>
   <tr>
     <td><div align="center"><?PHP echo number_format(($entry_D{'THIRDC'}/$entry_D{'TOTAL'})*100,2,'.',''); echo "%"; ?></div></td>
     <td><div align="center"><?PHP echo $entry_D{'THIRDC'}; ?></div></td>
     <td><div align="center"><strong>2001-2500</strong></div></td>
   </tr>
   <tr>
     <td><div align="center"><?PHP echo number_format(($entry_D{'FOURTHC'}/$entry_D{'TOTAL'})*100,2,'.',''); echo "%"; ?></div></td>
     <td><div align="center"><?PHP echo $entry_D{'FOURTHC'}; ?></div></td>
     <td><div align="center"><strong>&gt;2500</strong></div></td>
   </tr>
   <tr>
     <td><div align="center"></div></td>
     <td><div align="center"><?PHP echo $entry_D{'TOTAL'}; ?></div></td>
     <td><div align="center" class="style22">المجموع</div></td>
   </tr>
   <?php
          }
		  ?>
</table>
 <?php
          }
		   
		  ?>
<table width="624" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th width="231" height="27" scope="col"><div align="right" class="style15"><?php echo  $ROW1{'USER_FULL_NAME'}; ?></div>
        <div align="right" class="style15"></div></th>
    <th width="82" class="style21" scope="col"><span class="style18">:منشئ التقرير</span></th>
    <th width="189" scope="col"><span class="style15"><?PHP echo date('d/m/Y H:i',time());?></span></th>
    <th width="122" scope="col"><span class="style18">:تاريخ ووقت الطباعة</span></th>
  </tr>
</table>
<p></p>
 <p></p>
 <table width="466" border="0" cellpadding="0" cellspacing="0">
   <tr>
     <th width="384" scope="col">&nbsp;</th>
     <th width="104" scope="col"><img src="../images/logo.jpg" width="89" height="48" /></th>
   </tr>
 </table>
 <p></p>
 <p>&nbsp; </p>
<p></p>
<p></p>
</body>
</html>
