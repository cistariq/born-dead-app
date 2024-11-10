		<?php
   // session_start();
   	require '../Common/functions.php';
	
	$USER_ID = $_SESSION["USER_ID"];
	$USER_PSW = $_SESSION["USER_PSW"];
	$USER_TYPE = $_SESSION["USER_TYPE"];
	
	if( empty($USER_ID) || empty($USER_PSW) || ($USER_TYPE != 2 && $USER_TYPE != 3))
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
<title>توزيع المواليد حسب مكان الولادة في قطاع غزة</title>
<meta name="description" content="Health care website">
<meta name="keywords" content="health, care, healthcare">
<link href="../Style/Style.css" rel="stylesheet" type="text/css"> 


<style type="text/css">
<!--
.style1 {
	font-size: 12px;
	color: #000000;
	font-weight: bold;
}
.style2 {
	font-size: 12px;
	font-weight: bold;
}
.style3 {
	color: #000000;
	font-weight: bold;
}
.style15 {	font-family: "Arabic Transparent", Andalus;
	font-weight: bold;
	font-size: 16px;
}
.style17 {font-family: Andalus, "Arabic Transparent"; color: #FF0000; }
-->
</style>
</head>

<body onload="checkJavaScriptValidity()">
 <p>
   <?PHP
$date_F=$_GET['from'];
$date_T= $_GET['to'];
$c = Connect(); 
$curs_n = oci_new_cursor($c);

$stmt_n = oci_parse($c , "begin STATICS.GET_ALL_NOTIFICATIONS(:DATE_FROM,:DATE_TO,:NOTI); end;");

oci_bind_by_name($stmt_n,":DATE_FROM",$date_F,32);
oci_bind_by_name($stmt_n,":DATE_TO",$date_T,32);
oci_bind_by_name($stmt_n,":NOTI",$curs_n,-1,OCI_B_CURSOR);



oci_execute($stmt_n);
oci_execute($curs_n);



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
 <table width="442" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <th width="103" scope="col"><div align="right"><?php echo $date_T;?></div></th>
     <th width="35" scope="col">:الى</th>
     <th width="103" scope="col"><div align="right"><?php echo $date_F;?></div></th>
     <th width="201" scope="col">:عدد الاشعارات المدخلة من تاريخ</th>
   </tr>
 </table>
<P></P>
<table  class="sortable"  id="anyid" width="284" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">

<tr>
    <th width="79" bgcolor="#91B641"><div align="center" class="style3">العدد</div></th>
    <th width="199" bgcolor="#91B641"><div align="center" class="style3">المركز الصحي</div></th>
  </tr>
     <?php while ( $entry_n = oci_fetch_assoc($curs_n)) { 
	   $TOTAL=$TOTAL+$entry_n{'N_COUNT'};
	  ?>
          <tr>
          <td><div align="center"><?php echo $entry_n{'N_COUNT'}; ?></div></td>
            <td width="199"><div align="center"><?php echo $entry_n{'DREF_NAME_AR'}; ?>
              
            </div></td>
  </tr>
  
  
          <?php
          }
		  ?> 
		  <tr class="sortbottom">
            <td width="79"><strong>
            <div align="center"><?php echo $TOTAL; ?></div></strong></td>
            <td width="199"><strong>
            <div align="center">المجموع</div></strong></td>
  </tr>
  <?PHP 
		  OCIFreeStatement($stmt_n); 
		  OCIFreeCursor($curs_n); 

		  ?>
</table>
<p></p>
 <P>
</P>
 <table width="334" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <th width="194" height="27" scope="col"><div align="right" class="style15"><?php echo  $ROW1{'USER_FULL_NAME'}; ?></div>
          <div align="right" class="style15"></div></th>
      <th width="103" scope="col"><span class="style17">:منشئ التقرير</span></th>
    </tr>
</table>
  <P></P>
  <P></P>
 <table width="466" border="0" cellpadding="0" cellspacing="0">
   <tr>
     <th width="384" scope="col">&nbsp;</th>
     <th width="104" scope="col"><img src="../images/logo.jpg" width="89" height="48" /></th>
   </tr>
 </table>
<p></p>
</body>
</html>
