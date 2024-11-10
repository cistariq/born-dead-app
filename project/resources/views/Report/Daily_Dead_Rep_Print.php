<?php

   // session_start();

   	require '../Common/functions.php';

	

	$USER_ID = $_SESSION["USER_ID"];

	$USER_PSW = $_SESSION["USER_PSW"];

	$USER_TYPE = $_SESSION["USER_TYPE"];

	

	if( empty($USER_ID) || empty($USER_PSW) || ($USER_TYPE != 4 && $USER_TYPE != 5))

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

<title>تقارير يومية خاصة بالوفيات </title>

<meta name="description" content="Health care website">

<meta name="keywords" content="health, care, healthcare">

<link href="../Style/Style.css" rel="stylesheet" type="text/css"> 



<script type="text/javascript">





</script>



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

   
$USER_FULL_NAME=$_GET['USER_FULL_NAME'];
$BORN_DETAILS_HEALTH_CENTER_CD2=$_GET['BORN_DETAILS_HEALTH_CENTER_CD2'];
$DEAD_DEATH_PLACE_CD=$_GET['DEAD_DEATH_PLACE_CD']; 
$DEAD_HOS_NAME_CD=$_GET['DEAD_HOS_NAME_CD']; 

$c = Connect(); 

$hos=0;
			$curs_dref = oci_new_cursor($c);
			$stmt_dref = oci_parse($c , "begin STATICS.GET_GAZA_DREF(:HOS,:DREF); end;");
			oci_bind_by_name($stmt_dref,":DREF",$curs_dref,-1,OCI_B_CURSOR);
			oci_bind_by_name($stmt_dref,":HOS",$hos,32);
			oci_execute($stmt_dref);
            oci_execute($curs_dref);
			
$curs_center_user = oci_new_cursor($c);
			$stmt_center_user = oci_parse($c , "begin USER_PROFILE.GET_SPEC_USER(:EPOINT,:USER); end;");
			oci_bind_by_name($stmt_center_user,":USER",$curs_center_user,-1,OCI_B_CURSOR);
			oci_bind_by_name($stmt_center_user,":EPOINT",$BORN_DETAILS_HEALTH_CENTER_CD2,32);
			oci_execute($stmt_center_user);
            oci_execute($curs_center_user);			

$list_user=array();
          	while ($user_row1 = oci_fetch_array($curs_center_user)) {
	        array_push($list_user,$user_row1);
	        } 
			
$list_hos=array();
          	while ($hos_row1 = oci_fetch_array($curs_dref)) {
	        array_push($list_hos,$hos_row1);
	        }   


$curs = oci_new_cursor($c);

$stmt = oci_parse($c , "begin USER_PROFILE.GET_USER_PROFILE(:un,:up,:user_curs); end;");

oci_bind_by_name($stmt,":un",$USER_ID,32);

oci_bind_by_name($stmt,":up",$USER_PSW,32);

oci_bind_by_name($stmt,":user_curs",$curs,-1,OCI_B_CURSOR);



oci_execute($stmt);

oci_execute($curs);



$ROW=oci_fetch_assoc($curs); 



////////////////////////



$d_from=$_GET['d_from'];

$d_to= $_GET['d_to'];

$id=$_GET['id'];

$sex= $_GET['sex'];

if ($sex==4){

$sex='';

}

$y_from=$_GET['y_from'];

$y_to= $_GET['y_to'];

$dia_from=$_GET['dia_from'];

$dia_to= $_GET['dia_to'];

$age_From=$_GET['age_From'];

$age_To= $_GET['age_To'];




////////////////////////////



$CONDITON='';

$curs_F = oci_new_cursor($c);

$stmt_F = oci_parse($c , "begin Daily_Report.GET_DEATHS_POINT(:ID_NUMBER,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:PLACE_CD,:HOS_CD,:USER_CD,:POINT_CD,:DEADS); end;");

oci_bind_by_name($stmt_F,":ID_NUMBER",$id,32);

oci_bind_by_name($stmt_F,":SEX",$sex,32);

oci_bind_by_name($stmt_F,":DIAG_FROM",$dia_from,32);

oci_bind_by_name($stmt_F,":DIAG_TO",$dia_to,32);

oci_bind_by_name($stmt_F,":YEAR_FROM",$y_from,32);

oci_bind_by_name($stmt_F,":YEAR_TO",$y_to,32);


oci_bind_by_name($stmt_F,":DATE_FROM",$d_from,32);

oci_bind_by_name($stmt_F,":DATE_TO",$d_to,32);

oci_bind_by_name($stmt_F,":AGE_FROM",$age_From,32);

oci_bind_by_name($stmt_F,":AGE_TO",$age_To,32);
oci_bind_by_name($stmt_F,":PLACE_CD",$DEAD_DEATH_PLACE_CD,32);
oci_bind_by_name($stmt_F,":HOS_CD",$DEAD_HOS_NAME_CD,32);
oci_bind_by_name($stmt_F,":USER_CD",$USER_FULL_NAME,32);
oci_bind_by_name($stmt_F,":POINT_CD",$BORN_DETAILS_HEALTH_CENTER_CD2,32);

oci_bind_by_name($stmt_F,":DEADS",$curs_F,-1,OCI_B_CURSOR);


oci_execute($stmt_F);

oci_execute($curs_F);





$curs_F1 = oci_new_cursor($c);

$stmt_F1 = oci_parse($c , "begin Daily_Report.GET_ALL_DEATHS_POINT(:ID_NUMBER,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:PLACE_CD,:HOS_CD,:USER_CD,:POINT_CD,:DEADS); end;");

oci_bind_by_name($stmt_F1,":ID_NUMBER",$id,32);

oci_bind_by_name($stmt_F1,":SEX",$sex,32);

oci_bind_by_name($stmt_F1,":DIAG_FROM",$dia_from,32);

oci_bind_by_name($stmt_F1,":DIAG_TO",$dia_to,32);

oci_bind_by_name($stmt_F1,":YEAR_FROM",$y_from,32);

oci_bind_by_name($stmt_F1,":YEAR_TO",$y_to,32);

oci_bind_by_name($stmt_F1,":DATE_FROM",$d_from,32);

oci_bind_by_name($stmt_F1,":DATE_TO",$d_to,32);

oci_bind_by_name($stmt_F1,":AGE_FROM",$age_From,32);

oci_bind_by_name($stmt_F1,":AGE_TO",$age_To,32);
oci_bind_by_name($stmt_F1,":PLACE_CD",$DEAD_DEATH_PLACE_CD,32);
oci_bind_by_name($stmt_F1,":HOS_CD",$DEAD_HOS_NAME_CD,32);
oci_bind_by_name($stmt_F1,":USER_CD",$USER_FULL_NAME,32);
oci_bind_by_name($stmt_F1,":POINT_CD",$BORN_DETAILS_HEALTH_CENTER_CD2,32);
oci_bind_by_name($stmt_F1,":DEADS",$curs_F1,-1,OCI_B_CURSOR);

oci_execute($stmt_F1);

oci_execute($curs_F1);



?>



      

</p>

<table width="200" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <th scope="col"><a href="Distribution_form_D.php?from=<?php echo $d_from;?>&to=<?php echo $d_to; ?>&ag_f=<?php echo $age_From; ?>&ag_t=<?php echo $age_To;?>&di_f=<?php echo $dia_from;?>&di_t=<?php echo $dia_to;?>&ye_f=<?php echo $y_from;?>&ye_t=<?php echo $y_to;?>&sext=<?php echo $sex;?>&id_d=<?php echo $id;?>">......عودة</a></th>

  </tr>

</table>

<p></p>
<table width="534" border="0" align="center" cellpadding="0" cellspacing="0">

  

  <tr>

    <th height="60" colspan="4" scope="col"><div style="font-weight:bold; font-size:22px;">تقرير يومي خاص بالوفيات حسب تاريخ الادخال</div></th>

  </tr>

    <?php if ($d_to!='' || $d_from!=''){?>

  <tr>

    <th width="214" height="34" scope="col"><div align="right"><?php echo $d_to;?></div></th>

    <th width="37" scope="col">:الى</th>

    <th width="109" scope="col"><div align="right"><?php echo $d_from;?></div></th>

    <th width="174" scope="col">:  من تاريخ الوفاة</th>

  </tr>

  <?php }?>

  <?php if ($dia_to!='' || $dia_from!=''){?>

  <tr>

    <th scope="col"><div align="right"><?php echo $dia_to;?></div></th>

    <th scope="col">:الى</th>

    <th scope="col"><div align="right"><?php echo $dia_from;?></div></th>

    <th scope="col"> <div align="center">: من تشخيص</div></th>

  </tr>

  <?php }?>

  <?php if ($age_To!='' || $age_From!=''){?>

  <tr>

    <th scope="col"><div align="right"><?php echo $age_To;?></div></th>

    <th scope="col">:الى</th>

    <th scope="col"><div align="right"><?php echo $age_From;?></div></th>

    <th scope="col"> :من عمر </th>

  </tr>

  <?php }?>

  <?php if ($y_from!='' || $y_to!=''){?>

  <tr>

    <th scope="col"><div align="right"><?php echo $y_to;?></div></th>

    <th scope="col">:الى</th>

    <th scope="col"><div align="right"><?php echo $y_from;?></div></th>

    <th scope="col">:من سنة</th>

  </tr>

  <?php }?>

  <?php if ($sex!=''){?>

  <tr>

    <th colspan="3" scope="col"><div align="right">

      <?php if ($sex==1) echo 'ذكر'; elseif ($sex==2) echo 'أنثى'; elseif ($sex=='') echo ''; elseif ($sex==0) echo 'غير معروف';?>

    </div></th>

    <th scope="col">: الجنس</th>

  </tr>

  <?php }?>

</table>

<p></p>
<form id="form1" name="form1" method="get" action="">
  <table width="1012" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <th width="63" scope="col">&nbsp;</th>
      <th width="142" scope="col"> <div align="right" id="user1">
        <?PHP
	   echo "<select name='USER_FULL_NAME'  dir='rtl' id='USER_FULL_NAME' style='background-color:#FFFFFF;border-top-width:thin; border-style:groove;width:160px'>";
 echo "<option value=\"0\">اختر مستخدم</option>";
	  if ($BORN_DETAILS_HEALTH_CENTER_CD2!=0){
		  oci_bind_by_name($stmt_center_user,":USER",$curs_center_user,-1,OCI_B_CURSOR);
			oci_bind_by_name($stmt_center_user,":EPOINT",$BORN_DETAILS_HEALTH_CENTER_CD2,32);
			oci_execute($stmt_center_user);
            oci_execute($curs_center_user);			

$list_user=array();
          	while ($user_row1 = oci_fetch_array($curs_center_user)) {
	        array_push($list_user,$user_row1);
	        } 
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
      <th width="85" scope="col">:اسم المستخدم</th>
      <th width="150" scope="col"><select name="BORN_DETAILS_HEALTH_CENTER_CD2" id="BORN_DETAILS_HEALTH_CENTER_CD2" dir="rtl" style="background-color:#FFFFFF;border-top-width:thin; border-style:groove;width:150px" onchange="show_data_user(this.value);">
        <option value="0" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 0 ? "selected='selected'" : ""; ?> >غير معروف</option>
        <option value="123" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 123 ? "selected='selected'" : ""; ?> >ادارة الرعاية الأولية</option>
        <option value="1" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2== 1 ? "selected='selected'" : ""; ?>>مستشفى الشفاء</option>
        <option value="3" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2== 3 ? "selected='selected'" : ""; ?>>مستشفى ناصر</option>
        <option value="6" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2== 6 ? "selected='selected'" : ""; ?>>مستشفى شهداء الأقصى</option>
        <option value="9" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2== 9? "selected='selected'" : ""; ?>>مستشفى تل السلطان</option>
        <option value="129" <?PHP  print $BORN_DETAILS_HEALTH_CENTER_CD2== 129 ? "selected='selected'" : ""; ?>>مستشفى الحرازين</option>
        <option value="11" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2== 11 ? "selected='selected'" : ""; ?>>شهداء الرمال</option>
        <option value="27" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2== 27 ? "selected='selected'" : ""; ?>>معسكر جباليا</option>
        <option value="36" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2== 36 ? "selected='selected'" : ""; ?>>دير البلح</option>
        <option value="51" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2== 51 ? "selected='selected'" : ""; ?>>شهداء خانيونس</option>
        <option value="65" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2== 65 ? "selected='selected'" : ""; ?>>مركز شهداء رفح</option>
        <option value="66" <?PHP  print $BORN_DETAILS_HEALTH_CENTER_CD2== 66 ? "selected='selected'" : ""; ?>>رعاية تل السلطان</option>
      </select></th>
      <th width="84" scope="col">:نقطة الادخال</th>
      <th width="161" scope="col"><div align="right" id="cityD">
        <?php			  
			 		  
			  echo "<select tabindex='16' name='DEAD_HOS_NAME_CD' dir='rtl' id='DEAD_HOS_NAME_CD' style='background-color:#FFFFFF;border-top-width:thin; border-style:groove;width:146px'>";

             echo "<option value='0'>غير معروف</option>";
          if ($DEAD_DEATH_PLACE_CD!=0){
			  $hos=$DEAD_HOS_NAME_CD;
			   oci_bind_by_name($stmt_dref,":DREF",$curs_dref,-1,OCI_B_CURSOR);
			oci_bind_by_name($stmt_dref,":HOS",$hos,32);
			oci_execute($stmt_dref);
            oci_execute($curs_dref);
			
			$list_hos=array();
          	while ($hos_row1 = oci_fetch_array($curs_dref)) {
	        array_push($list_hos,$hos_row1);
	        } 
          foreach($list_hos as $key=>$det_hos){
			  
		  if ($DEAD_HOS_NAME_CD==$det_hos[0]) 
				   $selected2= 'selected="selected"';
?>
        <option value="<?php echo $det_hos[0]; ?>" <?php echo $selected2; ?>><?php echo $det_hos[1]; ?></option>
        <?php $selected2='';  }
		   }
	
		 echo "</select>";	 
			  ?>
      </div></th>
      <th width="105" scope="col">:مستشفى الوفاة</th>
      <th width="146" scope="col"><select tabindex="15" name="DEAD_DEATH_PLACE_CD" id="DEAD_DEATH_PLACE_CD" style="background-color:#FFFFFF;border-top-width:thin; border-style:groove;width:146px" dir="rtl"  onchange="show_dataD2(this.value);  ">
        <option value="0" <?PHP   print $DEAD_DEATH_PLACE_CD== 0 ? "selected='selected'" : ""; ?>>غير معروف</option>
        <option value="1" <?PHP   print $DEAD_DEATH_PLACE_CD== 1 ? "selected='selected'" : ""; ?>>غزة</option>
        <option value="5" <?PHP   print $DEAD_DEATH_PLACE_CD== 5 ? "selected='selected'" : ""; ?>>شمال غزة</option>
        <option value="6" <?PHP   print $DEAD_DEATH_PLACE_CD== 6 ? "selected='selected'" : ""; ?>>المنطقة الوسطى</option>
        <option value="7" <?PHP   print $DEAD_DEATH_PLACE_CD== 7 ? "selected='selected'" : ""; ?>>خانيونس</option>
        <option value="8" <?PHP   print $DEAD_DEATH_PLACE_CD== 8 ? "selected='selected'" : ""; ?>>رفح</option>
        <option value="2" <?PHP   print $DEAD_DEATH_PLACE_CD== 2 ? "selected='selected'" : ""; ?>>الضفة الغربية</option>
        <option value="3" <?PHP   print $DEAD_DEATH_PLACE_CD== 3 ? "selected='selected'" : ""; ?>>داخل الخط الأخضرو القدس</option>
        <option value="4" <?PHP   print $DEAD_DEATH_PLACE_CD== 4 ? "selected='selected'" : ""; ?>>خارج البلاد</option>
      </select></th>
      <th width="76" scope="col">:مكان الوفاة</th>
      <input type="hidden" id="d_from" name="d_from"  value="<?php if ($d_from=='') echo ''; else echo $d_from;?>"/>
      <input type="hidden" id="d_to" name="d_to" value="<?php if ($d_to=='') echo ''; else echo $d_to;?>" />
      <input type="hidden" id="dia_from" name="dia_from"  value="<?php if ($dia_from=='') echo ''; else echo $dia_from;?>"/>
      <input type="hidden" id="dia_to" name="dia_to" value="<?php if ($dia_to=='') echo ''; else echo $dia_to;?>" />
      <input type="hidden" id="age_From" name="age_From"  value="<?php if ($age_From=='') echo ''; else echo $age_From;?>"/>
      <input type="hidden" id="age_To" name="age_To" value="<?php if ($age_To=='') echo ''; else echo $age_To;?>" />
      <input type="hidden" id="y_from" name="y_from"  value="<?php if ($y_from=='') echo ''; else echo $y_from;?>"/>
      <input type="hidden" id="y_to" name="y_to" value="<?php if ($y_to=='') echo ''; else echo $y_to;?>" />
      <input type="hidden" id="sex" name="sex"  value="<?php if ($sex=='') echo ''; else echo $sex;?>"/>
      <input type="hidden" id="id" name="id" value="<?php if ($id=='') echo ''; else echo $id;?>" />
    </tr>
  </table>
</form>
<p></p>
<table width="985" border="0" align="center" cellpadding="0" cellspacing="0">

   <tr>

     <th width="971" scope="col"><table width="1198" height="93" border="1" align="right" cellpadding="0" cellspacing="0" bordercolor="#666666"  class="sortable"  id="anyid">
       <tr>
         <th width="50" bgcolor="#91B641" >كود ICD</th>
         <th width="114" bgcolor="#91B641" >المسح الضوئي</th>
         <th width="204" height="37" bgcolor="#91B641" ><span class="style13">التشخيص</span>
           <div align="center" class="style7"></div></th>
         <th width="115" bgcolor="#91B641">منطقة السكن</th>
         <th width="143" bgcolor="#91B641">المستشفى</th>
         <th width="165" bgcolor="#91B641"><div align="center" class="style7">اسم المتوفى رباعي</div></th>
         <th width="74" height="37" align="center" bgcolor="#91B641">الجنس</th>
         <th width="83" height="37" bgcolor="#91B641"><div align="center" class="style7">تاريخ الوفاة</div></th>
         <th width="76" height="37" bgcolor="#91B641"><div align="center" class="style7  style11">تاريخ الميلاد</div></th>
         <th width="97" bgcolor="#91B641">هوية المتوفى</th>
         <th width="53" height="37" bgcolor="#91B641">متسلسل</th>
       </tr>
       <?php  

	    $ROW1=oci_fetch_assoc($curs_F);

		 $number=1;

		  $list_born=array();

			
		$cc = 0 ;
		 while ($entry_F = oci_fetch_assoc($curs_F1)) {

	        array_push($list_born,$entry_F);
		$cc++;
	  ?>
       <tr>
         <td align="center" ><div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px" >
           <?php echo $entry_F{'ICD_CD'}; ?></div>
           <div align="right" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px"></div></td>
         <td ><div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px" > <?php echo $entry_F{'DEAD_IS_SCAN'}; ?></div></td>
         <td height="54" ><div align="left" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px" > <?php echo $entry_F{'DIAG'}; ?></div>
           <div align="right" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px"></div></td>
         <td width="115" align="center" ><div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px" ><?php echo $entry_F{'DEAD_REG'}; ?></div></td>
         <td width="143" align="center" ><div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px" ><?php echo $entry_F{'DEAD_HOS'}; ?></div></td>
         <td width="165" ><div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px" ><?php echo $entry_F{'DEAD_NAME'}; ?></div></td>
         <td width="74" height="54" align="center" ><div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px" > <?php echo $entry_F{'DEAD_SEX'}; ?></div></td>
         <td height="54" ><div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px" ><?php echo $entry_F{'DEAD_DOD'}; ?></div></td>
         <td height="54" ><div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px" ><?php echo $entry_F{'DEAD_DOB'}; ?></div></td>
         <td><div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px"><?php echo $entry_F{'DEAD_ID'}; ?></div></td>
         <td height="54"><div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px" ><?php echo  $cc;?></div></td>
       </tr>
       <?php

$number=$number+1;}

?>
     </table>       <div align="right"></div></th>

     <th width="185" scope="col"><table width="30" style="display:none;" height="93" border="1" align="left" cellpadding="0" cellspacing="0">

       <tr>

         <th height="37" bgcolor="#91B641" scope="col">.م</th>

       </tr>

       <?php $j=1;  

	  

	  foreach($list_born as $key=>$born){ 

	  ?>

       <tr>

         <td height="54"><div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px"><?php echo '.'.$j; echo $born[0];?></div></td>

       </tr>

       <?php $j=$j+1; }?>

     </table></th>

   </tr>

 </table>



<p></p>

 <table width="895" border="0" align="center" cellpadding="0" cellspacing="0">

   <tr>

     <th width="69" scope="col">&nbsp;</th>

     <th width="68" scope="col"><div align="right"><?php echo $ROW1{'COUNTER'}; ?></div>     </th>

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

