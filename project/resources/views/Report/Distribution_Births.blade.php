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
<title>توزيع المواليد حسب مكان الولادة في قطاع غزة</title>
<meta name="description" content="Health care website">
<meta name="keywords" content="health, care, healthcare">
<link href="../Style/Style.css" rel="stylesheet" type="text/css"> 


<style type="text/css">
<!--
.style3 {
	color: #000000;
	font-weight: bold;
}
.style15 {	font-family: "Arabic Transparent", Andalus;
	font-weight: bold;
	font-size: 16px;
}
.style18 {color: #FF0000}
.style21 {
	color: #000000;
	font-size: 16px;
}
.style23 {
	font-size: 16px;
	font-weight: bold;
	font-family: "Times New Roman", Times, serif;
	color: #003300;
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
$curs1 = oci_new_cursor($c);
$curs_private = oci_new_cursor($c);
$curs_public = oci_new_cursor($c);
$curs_ALL = oci_new_cursor($c);


$stmt_private = oci_parse($c , "begin Distribution_Births.GET_PRIVATE_ROWS_BORNS(:PRIVATE_FROM,:PRIVATE_TO,:BORN_INFO_PRIVATE); end;");
$stmt_public = oci_parse($c , "begin Distribution_Births.GET_PUBLIC_ROWS_BORNS(:PUBLIC_FROM,:PUBLIC_TO,:BORN_INFO_PUBLIC); end;");
$stmt_ALL = oci_parse($c , "begin Distribution_Births.GET_ALL_ROWS_BORNS(:PRIMARY_FROM,:PRIMARY_TO,:BORN_INFO_PRIMARY); end;");
$stmt1 = oci_parse($c , "begin Distribution_Births.GET_MALE_FEMALE_NUMBER(:from,:to,:COUNTER); end;");

oci_bind_by_name($stmt_public,":PUBLIC_FROM",$date_F,32);
oci_bind_by_name($stmt_public,":PUBLIC_TO",$date_T,32);
oci_bind_by_name($stmt_public,":BORN_INFO_PUBLIC",$curs_public,-1,OCI_B_CURSOR);
oci_bind_by_name($stmt_private,":PRIVATE_FROM",$date_F,32);
oci_bind_by_name($stmt_private,":PRIVATE_TO",$date_T,32);
oci_bind_by_name($stmt_private,":BORN_INFO_PRIVATE",$curs_private,-1,OCI_B_CURSOR);
oci_bind_by_name($stmt_ALL,":PRIMARY_FROM",$date_F,32);
oci_bind_by_name($stmt_ALL,":PRIMARY_TO",$date_T,32);
oci_bind_by_name($stmt_ALL,":BORN_INFO_PRIMARY",$curs_ALL,-1,OCI_B_CURSOR);


oci_bind_by_name($stmt1,":COUNTER",$curs1,-1,OCI_B_CURSOR);
oci_bind_by_name($stmt1,":from",$date_F,32);
oci_bind_by_name($stmt1,":to",$date_T,32);

oci_execute($stmt_private);
oci_execute($curs_private);
oci_execute($stmt_public);
oci_execute($curs_public);
oci_execute($stmt_ALL);
oci_execute($curs_ALL);
oci_execute($stmt1);
oci_execute($curs1);
$ROW=oci_fetch_assoc($curs1); 

$list=array();
while ( $entry_public = oci_fetch_assoc($curs_public)) {
	        array_push($list,$entry_public);
}  
$list_p=array();
while ( $entry = oci_fetch_assoc($curs_private)) {
	        array_push($list_p,$entry);
}  

$entry_all=oci_fetch_assoc($curs_ALL); 

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
 <p>&nbsp;</p>
<table width="469" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <th width="95" scope="col"><div align="right"><?php echo $date_T;?></div></th>
     <th width="43" scope="col">:الى</th>
     <th width="95" scope="col"><div align="right"><?php echo $date_F;?></div></th>
     <th width="236" scope="col">:توزيع المواليد حسب مكان الولادة من تاريخ</th>
   </tr>
 </table>
<P></P>
<table width="776" height="35" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">
   <tr>
     <th bgcolor="#E7EFD3" scope="col"><div align="right">مستشفى حكومي</div></th>
   </tr>
 </table>
<table  class="sortable"  id="anyid" width="776" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">
<?php $MALE=0;
$FEMALE=0;
$UNKNOWN=0;
$TOTAL=0;
$MPERCENT=0;
$FPERCENT=0;
$TPERCENT=0; ?>
<tr>
    <th twidth="57" bgcolor="#91B641"><div align="center" class="style3"> %</div></th>
    <th width="80" bgcolor="#91B641"><div align="center" class="style3">المجموع</div></th>
    <th width="108" bgcolor="#91B641"><div align="center" class="style3">غير معروف</div></th>
    <th width="72" bgcolor="#91B641"><div align="center" class="style3"> %</div></th>
    <th width="87" bgcolor="#91B641"><div align="center" class="style3">أنثى</div></th>
    <th width="76" bgcolor="#91B641"><div align="center" class="style3"> %</div></th>
    <th width="79" bgcolor="#91B641"><div align="center" class="style3">ذكر</div></th>
    <th width="199" bgcolor="#91B641"><div align="center" class="style3">مكان الولادة</div></th>
  </tr>
  <?php 
  foreach($list as $key=>$det1) {  
      $MALE=$MALE+$det1{'MALE'};
	  $FEMALE=$FEMALE+$det1{'FEMALE'};
	  $UNKNOWN=$UNKNOWN+$det1{'UNKNOWN'};
	  $TOTAL=$TOTAL+$det1{'TOTAL'};
	   }
	    
	   ?>
       <?php 
$MALE_p=0;
$FEMALE_p=0;
$UNKNOWN_p=0;
$TOTAL_p=0;
$MPERCENT_p=0;
$FPERCENT_p=0;
$TPERCENT_p=0;
 
foreach($list_p as $key=>$det_p1) {
      $MALE_p=$MALE_p+$det_p1{'MALE'};
	  $FEMALE_p=$FEMALE_p+$det_p1{'FEMALE'};
	  $UNKNOWN_p=$UNKNOWN_p+$det_p1{'UNKNOWN'};
	  $TOTAL_p=$TOTAL_p+$det_p1{'TOTAL'};
	  
	  }
	  
	  
	    $MPERCENT=$MPERCENT+number_format(($MALE / ($entry_all{'TOTAL'}) *100),2,'.','');
		$FPERCENT=$FPERCENT+number_format(($FEMALE / ($entry_all{'TOTAL'}) *100),2,'.','');
		$TPERCENT=$TPERCENT+number_format(($TOTAL / ($entry_all{'TOTAL'}) *100),2,'.','');
		
		
		$MPERCENT_p=$MPERCENT_p+number_format(($MALE_p / ($entry_all{'TOTAL'}) *100),2,'.','');
	    $FPERCENT_p=$FPERCENT_p+number_format(($FEMALE_p / ($entry_all{'TOTAL'}) *100),2,'.','');
	    $TPERCENT_p=$TPERCENT_p+number_format(($TOTAL_p / ($entry_all{'TOTAL'}) *100),2,'.','');
?>

     <?php foreach($list as $key=>$det) { 
	  
	  ?>
          <tr>
          <td><div align="center">
            <?php  echo number_format(($det{'TOTAL'} / ($entry_all{'TOTAL'}) *100),2,'.',''); echo "%"?>
          </div></td>
            <td><div align="center"><?php echo $det{'TOTAL'}; ?></div></td>
            <td><div align="center"><?php echo $det{'UNKNOWN'}; ?></div></td>
            <td><div align="center"><?php echo number_format(($det{'FEMALE'} / ($entry_all{'TOTAL'}) *100),2,'.',''); echo "%"?></div></td>
            <td><div align="center"><?php echo $det{'FEMALE'}; ?></div></td>
            <td><div align="center"><?php echo number_format(($det{'MALE'} / ($entry_all{'TOTAL'}) *100),2,'.',''); echo "%"?></div></td>
            <td><div align="center"><?php echo $det{'MALE'}; ?></div></td>
            <td width="199"><div align="center"><?php echo $det{'DREF_NAME_AR'}; ?>
              
            </div></td>
  </tr>
  
  
          <?php
          }
		  ?> 
		  <tr class="sortbottom">
            <td width="57"><strong>
            <div align="center"><strong><strong>
              <?php  echo $TPERCENT; echo "%"?>
            </strong></strong></div>
            </strong></td>
            <td width="80"><strong>
            <div align="center"><?php echo $TOTAL; ?></div></td>
            <td width="108"><strong>
            <div align="center"><?php echo $UNKNOWN; ?></div></td>
            <td width="72"><strong>
            <div align="center"><strong><?php echo $FPERCENT; echo "%"?></strong></div></strong></td>
            <td width="87"><strong>
            <div align="center"><?php echo $FEMALE; ?></div></td>
            <td width="76"><strong>
            <div align="center"><?php echo $MPERCENT; echo "%"?></div></strong></td>
            <td width="79"><strong>
            <div align="center"><strong><?php echo $MALE; ?></strong></div>
            </strong></td>
            <td width="199"><strong>
            <div align="center">المجموع</div></strong></td>
  </tr>
  <?PHP 
		  OCIFreeStatement($stmt_public); 
		  OCIFreeCursor($curs_public); 

		  ?>
</table>
<p></p>
 <table width="776" height="36" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">
   <tr>
     <th bgcolor="#E7EFD3" scope="col"><div align="right">مستشفى غير حكومي</div></th>
   </tr>
</table>
<table  class="sortable"  id="anyid" width="775" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">

<tr>
    <th width="57" bgcolor="#91B641"><div align="center"><strong> %</strong></div></th>
    <th width="79" bgcolor="#91B641"><div align="center"><strong>المجموع</strong></div></th>
    <th width="106" bgcolor="#91B641"><div align="center"><strong>غير معروف</strong></div></th>
    <th width="73" bgcolor="#91B641"><div align="center"><strong> %</strong></div></th>
    <th width="90" bgcolor="#91B641"><div align="center"><strong>أنثى</strong></div></th>
    <th width="74" bgcolor="#91B641"><div align="center"><strong> %</strong></div></th>
    <th width="79" bgcolor="#91B641"><div align="center"><strong>ذكر</strong></div></th>
    <th width="199" bgcolor="#91B641"><div align="center"><strong>مكان الولادة</strong></div></th>
  </tr>
<?php foreach($list_p as $key=>$det_p) {  
	  
	  ?>
          <tr>
            <td><div align="center"><?php  echo number_format(($det_p{'TOTAL'} / ($entry_all{'TOTAL'}) *100),2,'.',''); echo "%"?></div></td>
            <td><div align="center"><?php echo $det_p{'TOTAL'}; ?></div></td>
            <td><div align="center"><?php echo $det_p{'UNKNOWN'}; ?></div></td>
            <td><div align="center"><?php echo number_format(($det_p{'FEMALE'} / ($entry_all{'TOTAL'}) *100),2,'.',''); echo "%"?></div></td>
            <td><div align="center"><?php echo $det_p{'FEMALE'}; ?></div></td>
            <td><div align="center"><?php echo number_format(($det_p{'MALE'} / ($entry_all{'TOTAL'}) *100),2,'.',''); echo "%"?></div></td>
            <td><div align="center"><?php echo $det_p{'MALE'}; ?></div></td>
            <td width="199"><div align="center"><?php echo $det_p{'DREF_NAME_AR'}; ?>
              
            </div></td>
  </tr>
  
  
          <?php
          }
		  ?> 
		  <tr class="sortbottom">
            <td width="57"><strong>
            <div align="center"><?php  echo $TPERCENT_p; echo "%"?></div></strong></td>
            <td width="79"><strong>
            <div align="center"><?php echo $TOTAL_p; ?></div></td>
            <td width="106"><strong>
            <div align="center"><?php echo $UNKNOWN_p; ?></div></td>
            <td width="73"><strong>
            <div align="center"><?php echo $FPERCENT_p; echo "%"?></div></strong></td>
            <td width="90"><strong>
            <div align="center"><?php echo $FEMALE_p; ?></div></td>
            <td width="74"><strong>
            <div align="center"><?php echo $MPERCENT_p; echo "%"?></div></strong></td>
            <td width="79"><strong>
            <div align="center"><?php echo $MALE_p; ?></div></strong></td>
            <td width="199"><strong>
            <div align="center">المجموع</div></strong></td>
  </tr>
  <?PHP 
		   OCIFreeStatement($stmt_private); 
		   OCIFreeCursor($curs_private); 

		  ?>
</table>
<table  width="775" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">
  <?php foreach($list_p as $key=>$det_p) {  
	  
	  ?>
  <?php
          }
		  ?>
  <tr class="sortbottom">
    <td width="57"><div align="center"></div></td>
    <td width="79"><strong>
        <div align="center"><?php echo $entry_all{'TOTAL'}; ?></div></td>
    <td width="106"><strong>
        <div align="center"><?php echo $entry_all{'UNKNOWN'}; ?></div></td>
    <td width="73"><div align="center"><strong><?php echo number_format(($entry_all{'FEMALE'} / ($entry_all{'TOTAL'}) *100),2,'.',''); echo "%"?></strong></div></td>
    <td width="90"><strong>
        <div align="center"><?php echo $entry_all{'FEMALE'}; ?></div></td>
    <td width="74"><div align="center"><strong><?php echo number_format(($entry_all{'MALE'} / ($entry_all{'TOTAL'}) *100),2,'.',''); echo "%"?></strong></div></td>
    <td width="79"><div align="center"><strong><?php echo $entry_all{'MALE'}; ?></strong></div></td>
    <td width="199"><div align="center" class="style23"> المجموع الكلي</div></td>
  </tr>
  <?PHP 
		   OCIFreeStatement($stmt_ALL); 
		   OCIFreeCursor($curs_ALL); 

		  ?>
</table>
<P></P>
 <table width="624" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <th width="231" height="27" scope="col"><div align="right" class="style15"><?php echo  $ROW1{'USER_FULL_NAME'}; ?></div>
         <div align="right" class="style15"></div></th>
     <th width="82" class="style21" scope="col"><span class="style18">:منشئ التقرير</span></th>
     <th width="189" scope="col"><span class="style15"><?PHP echo date('d/m/Y H:i',time());?></span></th>
     <th width="122" scope="col"><span class="style18">:تاريخ ووقت الطباعة</span></th>
   </tr>
   <?PHP 
		   OCIFreeStatement($stmt); 
		   OCIFreeCursor($curs); 

		  ?>
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
