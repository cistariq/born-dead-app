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
<script type="text/javascript" src="../js/ajax.js"></script>  
<script type="text/javascript" src="../js/sortable.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=windows-1256" />
<title>تقارير يومية خاصة بالمواليد للطباعة فقط</title>
<meta name="description" content="Health care website">
<meta name="keywords" content="health, care, healthcare">
<link href="../Style/Style.css" rel="stylesheet" type="text/css"> 


<style type="text/css">
<!--
.style7 {
	font-size: 14;
	color: #000000;
}
.style11 {font-size: 14px}
.style13 {font-size: 14}
.style14 {font-size: 12px}
.style15 {
	font-family: "Arabic Transparent", Andalus;
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

$df=$_GET['Date_From'];
$dt=$_GET['Date_To'];
$Date_From=$df;
$Date_To=$dt;

$USER_FULL_NAME=$_GET['USER_FULL_NAME'];
$BORN_DETAILS_BIRTH_PLACE_CD=$_GET['BORN_DETAILS_BIRTH_PLACE_CD'];
$BORN_DETAILS_HEALTH_CENTER_CD=$_GET['BORN_DETAILS_HEALTH_CENTER_CD'];
$BORN_DETAILS_HEALTH_CENTER_CD2=$_GET['BORN_DETAILS_HEALTH_CENTER_CD2'];

$CONDITON='';
$curs_borns = oci_new_cursor($c);
$stmt_borns = oci_parse($c , "begin Daily_Report.GET_SPEC_BORNS(:FROM,:TO,:DREFF,:PLACE,:CENTER,:EPOINT,:BORN_INFO_C); end;");


oci_bind_by_name($stmt_borns,":FROM",$df,32);
oci_bind_by_name($stmt_borns,":TO",$dt,32);
oci_bind_by_name($stmt_borns,":DREFF",$USER_FULL_NAME,32);
oci_bind_by_name($stmt_borns,":PLACE",$BORN_DETAILS_BIRTH_PLACE_CD,32);
oci_bind_by_name($stmt_borns,":CENTER",$BORN_DETAILS_HEALTH_CENTER_CD,32);
oci_bind_by_name($stmt_borns,":EPOINT",$BORN_DETAILS_HEALTH_CENTER_CD2,32);
oci_bind_by_name($stmt_borns,":BORN_INFO_C",$curs_borns,-1,OCI_B_CURSOR);

oci_execute($stmt_borns);
oci_execute($curs_borns);


$curs_borns1 = oci_new_cursor($c);
$stmt_borns1 = oci_parse($c , "begin Daily_Report.GET_SPEC_BORNS_ALL(:FROM1,:TO1,:DREFF1,:PLACE1,:CENTER1,:EPOINT1,:BORN_INFO); end;");
oci_bind_by_name($stmt_borns1,":FROM1",$df,32);
oci_bind_by_name($stmt_borns1,":TO1",$dt,32);
oci_bind_by_name($stmt_borns1,":DREFF1",$USER_FULL_NAME,32);
oci_bind_by_name($stmt_borns1,":PLACE1",$BORN_DETAILS_BIRTH_PLACE_CD,32);
oci_bind_by_name($stmt_borns1,":CENTER1",$BORN_DETAILS_HEALTH_CENTER_CD,32);
oci_bind_by_name($stmt_borns1,":EPOINT1",$BORN_DETAILS_HEALTH_CENTER_CD2,32);
oci_bind_by_name($stmt_borns1,":BORN_INFO",$curs_borns1,-1,OCI_B_CURSOR);


oci_execute($stmt_borns1);
oci_execute($curs_borns1);

?>

      
</p>
<table width="200" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col"><a href="Daily_Report.php?USER_FULL_NAME=<?php echo $USER_FULL_NAME;?>&BORN_DETAILS_BIRTH_PLACE_CD=<?php echo $BORN_DETAILS_BIRTH_PLACE_CD; ?>&BORN_DETAILS_HEALTH_CENTER_CD=<?php echo $BORN_DETAILS_HEALTH_CENTER_CD; ?>&BORN_DETAILS_HEALTH_CENTER_CD2=<?php echo $BORN_DETAILS_HEALTH_CENTER_CD2;?>&Date_From=<?php echo $df;?>&Date_To=<?php echo $dt;?>">عودة للتقرير الأصلي</a></th>
  </tr>
</table>
<p></p>
<?php 

            $curs_birth = oci_new_cursor($c);
			$stmt_birth = oci_parse($c , "begin STATICS.GET_ALL_HEALTH_CENTERS(:BIRTH); end;");
			oci_bind_by_name($stmt_birth,":BIRTH",$curs_birth,-1,OCI_B_CURSOR);
			oci_execute($stmt_birth);
            oci_execute($curs_birth);
			
			$curs_center_user = oci_new_cursor($c);
			$stmt_center_user = oci_parse($c , "begin USER_PROFILE.GET_SPEC_USER(:EPOINT,:USER); end;");
			oci_bind_by_name($stmt_center_user,":USER",$curs_center_user,-1,OCI_B_CURSOR);
			oci_bind_by_name($stmt_center_user,":EPOINT",$BORN_DETAILS_HEALTH_CENTER_CD2,32);
			oci_execute($stmt_center_user);
            oci_execute($curs_center_user);
			
			$list=array();
            $array="";
			while ($BIRTH_ROW = oci_fetch_array($curs_birth)) {
	        array_push($list,$BIRTH_ROW);
	        }  
				
			 $list_born=array();
			$list_user=array();
          	while ($user_row1 = oci_fetch_array($curs_center_user)) {
	        array_push($list_user,$user_row1);
	        }  
			

?>

 <table width="598" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <th width="107" scope="col"><div align="right"><?php echo $dt; echo $date_T;?></div></th>
     <th width="48" scope="col">:الى</th>
     <th width="107" scope="col"><div align="right"><?php echo $df; echo $date_F;?></div>     </th>
     <th width="336" scope="col">:تقارير يومية خاصة بالمواليد من تاريخ الادخال </th>
   </tr>
 </table>
<p></p>
<form id="form1" name="form1" method="GET" action="">

<table width="1019" border="0" align="center" cellpadding="0" cellspacing="0">
     <tr>
       
       <th width="160" scope="col"> <div align="right" id="user1">
      <?PHP
	   echo "<select name='USER_FULL_NAME'  dir='rtl' id='USER_FULL_NAME' style='background-color:#FFFFFF;border-top-width:thin; border-style:groove;width:160px'>";
 echo "<option value=\"0\">اختر مستخدم</option>";
	  if ($BORN_DETAILS_HEALTH_CENTER_CD2!=0){
          foreach($list_user as $key=>$det_user){
		  if ($USER_FULL_NAME==$det_user[0]) 
				   $selected1= 'selected="selected"';
		  ?>
			  <option value="<?php echo $det_user[0]; ?>" <?php echo $selected1; ?>><?php echo $det_user[1]; ?></option>
			  <?php $selected1='';  }
		   }
	
		 echo "</select>";	 
			  ?>
    </div></th>
       <th width="91" scope="col">:اسم المستخدم</th>
       <th width="150" scope="col"><select name="BORN_DETAILS_HEALTH_CENTER_CD2" id="BORN_DETAILS_HEALTH_CENTER_CD2" dir="rtl" style="background-color:#FFFFFF;border-top-width:thin; border-style:groove;width:150px" onchange="show_data_user(this.value);">
         <option value="0" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 0 ? "selected='selected'" : ""; ?> >غير معروف</option>
            <option value="123" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 123 ? "selected='selected'" : ""; ?> >ادارة الرعاية الأولية</option>
         <option value="1" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 1 ? "selected='selected'" : ""; ?>>مستشفى الشفاء</option>
         <option value="3" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 3 ? "selected='selected'" : ""; ?>>مستشفى ناصر</option>
         <option value="6" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 6 ? "selected='selected'" : ""; ?>>مستشفى شهداء الأقصى</option>
         <option value="9" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 9? "selected='selected'" : ""; ?>>مستشفى تل السلطان</option>
         <option value="11" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 11 ? "selected='selected'" : ""; ?>>شهداء الرمال</option>
         <option value="27" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 27 ? "selected='selected'" : ""; ?>>معسكر جباليا</option>
         <option value="36" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 36 ? "selected='selected'" : ""; ?>>دير البلح</option>
         <option value="51" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 51 ? "selected='selected'" : ""; ?>>شهداء خانيونس</option>
         <option value="65" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 65 ? "selected='selected'" : ""; ?>>مركز شهداء رفح</option>
          <option value="66" <?PHP  print $BORN_DETAILS_HEALTH_CENTER_CD2 == 66 ? "selected='selected'" : ""; ?>>رعاية تل السلطان</option>
       </select></th>
       <th width="91" scope="col">:نقطة الادخال</th>
       <th width="150" scope="col"><div align="right">
         
           <select name="BORN_DETAILS_BIRTH_PLACE_CD" id="BORN_DETAILS_BIRTH_PLACE_CD" dir="rtl" style="background-color:#FFFFFF;border-top-width:thin; border-style:groove;width:150px">
                  <option value="0" <?PHP   print $BORN_DETAILS_BIRTH_PLACE_CD == 0 ? "selected='selected'" : ""; ?>>غير معرف</option>

                  <option value="9" <?PHP   print $BORN_DETAILS_BIRTH_PLACE_CD == 9 ? "selected='selected'" : ""; ?>>مستشفى الهلال الإماراتي</option>

                  <option value="3" <?PHP   print $BORN_DETAILS_BIRTH_PLACE_CD == 3 ? "selected='selected'" : ""; ?>>مستشفى ناصر الطبي</option>

                  <option value="6" <?PHP   print $BORN_DETAILS_BIRTH_PLACE_CD == 6 ? "selected='selected'" : ""; ?>>مستشفى شهداء الأقصى</option>

                  <option value="1" <?PHP   print $BORN_DETAILS_BIRTH_PLACE_CD == 1 ? "selected='selected'" : ""; ?>>مستشفى الشفاء بغزة</option>

                   <option value="2" <?PHP   print $BORN_DETAILS_BIRTH_PLACE_CD == 2 ? "selected='selected'" : ""; ?>>مستشفى العودة-الشمال</option>
			    
			      <option value="147" <?PHP   print $BORN_DETAILS_BIRTH_PLACE_CD == 147 ? "selected='selected'" : ""; ?>>مستشفى العودة-الوسطى</option>

                  <option value="90" <?PHP  print $BORN_DETAILS_BIRTH_PLACE_CD == 90 ? "selected='selected'" : ""; ?>>مستشفى الكرامة التخصصي</option>

                  <option value="77" <?PHP  print $BORN_DETAILS_BIRTH_PLACE_CD == 77 ? "selected='selected'" : ""; ?>>مستشفى القدس</option>

                  <option value="87" <?PHP  print $BORN_DETAILS_BIRTH_PLACE_CD == 87 ? "selected='selected'" : ""; ?>>مستشفى أصدقاء المريض</option>

                  <option value="99" <?PHP  print $BORN_DETAILS_BIRTH_PLACE_CD == 99 ? "selected='selected'" : ""; ?>>مستشفى مجمع الصحابة الطبي</option>

                  <option value="78" <?PHP  print $BORN_DETAILS_BIRTH_PLACE_CD == 78 ? "selected='selected'" : ""; ?>>مستشفى بلسم العسكري</option>

                  <option value="105" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD == 105 ? "selected='selected'" : ""; ?>>عبسان الكبيرة العسكري</option>

                  <option value="106" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD == 106 ? "selected='selected'" : ""; ?>>مهدي</option>                  

                  <option value="96" <?PHP  print $BORN_DETAILS_BIRTH_PLACE_CD == 96 ? "selected='selected'" : ""; ?>>مستشفى الخدمة العامة</option>

                  <option value="101" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD == 101 ? "selected='selected'" : ""; ?>>مستشفى دار السلآم</option>

                  <option value="102" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD == 102 ? "selected='selected'" : ""; ?>>مستشفى الامل</option>

                  <option value="103" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD == 103 ? "selected='selected'" : ""; ?>>مستشفى الكويت التخصصي</option>

                  <option value="100" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD == 100 ? "selected='selected'" : ""; ?>>مستشفى يافا</option>

                  <option value="88" <?PHP  print $BORN_DETAILS_BIRTH_PLACE_CD == 88 ? "selected='selected'" : ""; ?>>طبيب خاص</option>

                   <option value="107" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD ==107 ? "selected='selected'" : ""; ?>>مستشفى الأهلي العربي</option>

                  <option value="136" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD ==136 ? "selected='selected'" : ""; ?>>داخل الخط الأخضر</option>

                  <option value="135" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD ==135 ? "selected='selected'" : ""; ?>>الضفة الغربية</option>

                  <option value="110" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD ==110 ? "selected='selected'" : ""; ?>>مركز الشوا</option>

                   <option value="129" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD ==129 ? "selected='selected'" : ""; ?>>مستشفى الحرازين</option>

                    <option value="130" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD ==130 ? "selected='selected'" : ""; ?>>مركز بيت المقدس</option>
 	      <option value="139" <?PHP print print $BORN_DETAILS_BIRTH_PLACE_CD ==139 ? "selected='selected'" : ""; ?>>مركز الحلو الدولي</option>
			    <option value="140" <?PHP print print $BORN_DETAILS_BIRTH_PLACE_CD ==140 ? "selected='selected'" : ""; ?>>مستشفى الخير</option>
			   <option value="141" <?PHP print print $BORN_DETAILS_BIRTH_PLACE_CD ==141 ? "selected='selected'" : ""; ?>>مستشفى الحياة التخصصي</option>
          </select>
       </div></th>
       <th width="78" scope="col">:مكان الولادة</th>
<th width="150" scope="col"><div align="right">
           <select name="BORN_DETAILS_HEALTH_CENTER_CD" id="BORN_DETAILS_HEALTH_CENTER_CD" dir="rtl" style="background-color:#FFFFFF;border-top-width:thin; border-style:groove;width:150px">
             <option value="0" selected="selected">غير معروف</option>
             <?php 
				  
				   foreach($list as $key=>$det){
				    if ($BORN_DETAILS_HEALTH_CENTER_CD==$det{0}) 
				   $selected= 'selected="selected"';
				   
				   ?>
             <option value="<?php echo $det{0}; ?>" <?php echo $selected; ?>><?php echo $det{1}; ?></option>
             <?php $selected='';  } ?>
           </select>
       </div></th>
       <th width="95" scope="col">:المركز الصحي</th>
       <input type="hidden" id="Date_From" name="Date_From"  value="<?php if ($date_F=='') echo $df; else echo $date_F;?>"/>
       <input type="hidden" id="Date_To" name="Date_To" value="<?php if ($date_T=='') echo $dt; else echo $date_T;?>" />
     </tr>
  </table>
</form>
<p></p>
 <table width="1034" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <th width="956" height="85" scope="col"><table width="957" height="80" border="1" align="left" cellpadding="0" cellspacing="0" bordercolor="#666666"  class="sortable"  id="anyid">
       <tr>
         <th width="173" height="37" bgcolor="#91B641" ><span class="style13">مكان الميلاد</span></th>
         <th width="225" height="37" bgcolor="#91B641"><div align="center" class="style7">اسم الأم رباعي</div></th>
         <th width="232" height="37" bgcolor="#91B641"><div align="center" class="style7">اسم الأب رباعي</div></th>
         <th width="96" height="37" bgcolor="#91B641"><div align="center" class="style7">اسم المولود</div></th>
         <th width="103" height="37" bgcolor="#91B641"><div align="center" class="style7  style11">تاريخ الميلاد</div></th>
         <th width="101" height="37" bgcolor="#91B641"><span class="style13"> هوية المولود</span></th>
        </tr>
       <?php  $ROW1=oci_fetch_assoc($curs_borns);
		 $number=1; 
		 while ($entry_borns = oci_fetch_assoc($curs_borns1)) {
	        array_push($list_born,$entry_borns);
	  ?>
        <tr>
         <td height="41" ><div align="right" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px" ><?php echo $entry_borns{'DREF_NAME_AR'}; ?></div></td>
         <td height="41"><div align="right" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px"><?php echo $entry_borns{'MOTHER_FULL_NAME'}; ?></div></td>
         <td width="232" height="41" ><div align="right" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px" ><?php echo $entry_borns{'FATHER_FULL_NAME'}; ?></div></td>
         <td height="41" ><div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px" ><?php echo $entry_borns{'BI_FIRST_NAME'}; ?></div></td>
         <td height="41" ><div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px" ><?php echo $entry_borns{'DELIVERY_DATE'}; ?></div></td>
         <td height="41"><div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px"><?php echo $entry_borns{'BI_ID'}; ?></div></td>
        </tr>
        
       <?php
          $number=$number+1;}
		  ?>
      
     </table>
     <div align="right"></div></th>
     <th width="78" scope="col"><table width="30" height="70" border="1" align="left" cellpadding="0" cellspacing="0">
       <tr>
         <th height="37" bgcolor="#91B641" scope="col">.م</th>
       </tr>
       <?php $j=1;  
	  
	  foreach($list_born as $key=>$born){ 
	  ?>
       <tr>
         <td height="41"><div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px"><?php echo '.'; echo $j ;?></div></td>
       </tr>
       <?php $j=$j+1; }?>
     </table></th>
   </tr>
 </table>
<p></p>
<table width="895" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     
     <th width="68" scope="col"><div align="right"><?php echo $ROW1{'C'}; ?></div>     </th>
     <th width="76" scope="col">:عدد السجلات</th>
     <th width="297" height="27" scope="col"><div align="right" class="style15"><?php echo  $ROW{'USER_FULL_NAME'}; ?></div>
     <div align="right" class="style15"></div></th>
     <th width="93" scope="col"><span class="style17">:منشئ التقرير</span></th>
     <th width="189" class="style15" scope="col"><?PHP echo date('d/m/Y H:i',time());?></th>
     <th width="103" class="style17" scope="col">:التاريخ والوقت</th>
   </tr>
</table>
<p></p>
 <table width="311" border="0" cellpadding="0" cellspacing="0">
   <tr>
     <th width="209" scope="col">&nbsp;</th>
     <th width="257" scope="col"><img src="../images/logo.jpg" width="89" height="48" /></th>
   </tr>
 </table>
<p></p>
</body>
</html>
