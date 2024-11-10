<?php
   // session_start();
   	require '../../Common/functions.php';

	$USER_ID = $_SESSION["USER_ID"];
	$USER_PSW = $_SESSION["USER_PSW"];
	$USER_TYPE = $_SESSION["USER_TYPE"];

	if( empty($USER_ID) || empty($USER_PSW) || ($USER_TYPE != 1 && $USER_TYPE != 5))
	{
		header("Location: ../../index.php?msg=2");
		exit();
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="../../js/sortable.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1256" />
<title>تقارير يومية خاصة بالمواليد</title>
<meta name="description" content="Health care website">
<meta name="keywords" content="health, care, healthcare">
<link href="../../Style/Style.css" rel="stylesheet" type="text/css">


<style type="text/css">
<!--
.style13 {font-size: 14}
.style15 {
	font-family: "Arabic Transparent", Andalus;
	font-weight: bold;
	font-size: 16px;
}
.style17 {font-family: Andalus, "Arabic Transparent"; color: #FF0000; }
.style20 {
	font-family: "Arabic Transparent", Andalus;
	font-weight: bold;
	font-size: 14px;
}
.style27 {font-size: 12px; font-family: Tahoma, Helvetica, Tahoma; font-weight: bold; }
-->
</style>
</head>

<body onload="checkJavaScriptValidity()">
 <p>
   <?PHP


$c = Connect();
$curs = oci_new_cursor($c);
$stmt = oci_parse($c , "begin USER_PROFILE.GET_USER_PROFILE(:un,:up,:user_curs); end;");
oci_bind_by_name($stmt,":un",$USER_ID,32);
oci_bind_by_name($stmt,":up",$USER_PSW,32);
oci_bind_by_name($stmt,":user_curs",$curs,-1,OCI_B_CURSOR);

oci_execute($stmt);
oci_execute($curs);

$ROW=oci_fetch_assoc($curs);

$date_F=$_GET['from'];
$date_T= $_GET['to'];

$curs_borns = oci_new_cursor($c);
$stmt_borns = oci_parse($c , "begin Daily_Report.GET_PLACE_BORNS(:FROM,:TO,:DREFF,:BORN_INFO); end;");


oci_bind_by_name($stmt_borns,":FROM",$date_F,32);
oci_bind_by_name($stmt_borns,":TO",$date_T,32);
oci_bind_by_name($stmt_borns,":DREFF",$ROW{'USER_DREF_CD'},32);
oci_bind_by_name($stmt_borns,":BORN_INFO",$curs_borns,-1,OCI_B_CURSOR);



oci_execute($stmt_borns);
oci_execute($curs_borns);


            $list_born=array();

            $array="";
			while ($entry_borns = oci_fetch_array($curs_borns)) {
	        array_push($list_born,$entry_borns);

	        }


?>


</p>
 <table width="640" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <th width="95" scope="col"><div align="right"><?php echo $date_T;?></div></th>
     <th width="43" scope="col">:الى</th>
     <th width="95" scope="col"><div align="right"><?php echo $date_F;?></div>     </th>
     <th width="236" scope="col">:تقارير يومية خاصة بالمواليد حسب مكان الولادة من تاريخ</th>
   </tr>
 </table>
 <p></p>

 <table width="630" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <th width="433" scope="col"><table width="333" height="65" border="1" align="right" cellpadding="0" cellspacing="0" bordercolor="#666666"  class="sortable"  id="anyid">
       <tr>
         <th width="105" bgcolor="#91B641">عدد الاشعارات</th>
         <th width="222" height="37" bgcolor="#91B641"><span class="style13">مكان الميلاد</span></th>
        </tr>
       <?php $i=1;

	  foreach($list_born as $key=>$born){
	  ?>
       <tr>
         <td><div align="center" class="style27"><?php echo $born[0];?></div></td>
         <td height="20"><div align="right" class="style27" ><?php echo $born[1];?></div></td>
        </tr>
       <?php
          $i=$i+1;}
		  ?>
       <?PHP
		  OCIFreeStatement($stmt_borns);
		  OCIFreeCursor($curs_borns);

		  ?>
     </table>
       <div align="right"></div>
       <div align="right"></div>
     <div align="right"></div></th>
     <th width="197" scope="col"><table width="39" height="65" border="1" align="left" cellpadding="0" cellspacing="0">
       <tr>
         <th height="37" bgcolor="#91B641" scope="col"><div align="center" class="style20">.م</div></th>
       </tr>
       <?php $j=1;

	  foreach($list_born as $key=>$born){
	  ?>
       <tr>
         <td height="20">
          <div align="center"><?php echo '.'; echo $j ;?></div></td>
       </tr>
       <?php $j=$j+1; }?>
     </table></th>
   </tr>
 </table>
<p></p>
<p></p>
 <table width="539" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <th width="63" scope="col"><div align="right"><?php echo $i-1; ?></div>     </th>
     <th width="83" scope="col">:عدد السجلات</th>
     <th width="289" height="27" scope="col"><div align="right" class="style15"><?php echo  $ROW{'USER_FULL_NAME'}; ?></div>
     <div align="right" class="style15"></div></th>
     <th width="104" scope="col"><span class="style17">:منشئ التقرير</span></th>
   </tr>
 </table>
 <p></p>
 <table width="466" border="0" cellpadding="0" cellspacing="0">
   <tr>
     <th width="384" scope="col">&nbsp;</th>
     <th width="104" scope="col"><img src="../../images/logo.jpg" width="89" height="48" /></th>
   </tr>
 </table>
 <p></p>
</body>
</html>
