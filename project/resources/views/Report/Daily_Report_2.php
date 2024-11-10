<?php

// session_start();

require '../Common/functions.php';

$USER_ID = $_SESSION["USER_ID"];

$USER_PSW = $_SESSION["USER_PSW"];

$USER_TYPE = $_SESSION["USER_TYPE"];

if (empty($USER_ID) || empty($USER_PSW) || ($USER_TYPE != 2 && $USER_TYPE != 3 && $USER_TYPE != 5)) {

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

<title>������ ����� ���� ���������</title>

<meta name="description" content="Health care website">

<meta name="keywords" content="health, care, healthcare">

<link href="../Style/Style.css" rel="stylesheet" type="text/css"> 



<script type="text/javascript">
	/*function open_win()

	 {

	 var url = 'Daily_Report_pdf.php?df='+document.getElementById('df1').value+'&dt='+document.getElementById('dt1').value+'&USER_FULL_NAME='+document.getElementById('USER_FULL_NAME1').value+'&BORN_DETAILS_BIRTH_PLACE_CD='+document.getElementById('BORN_DETAILS_BIRTH_PLACE_CD1').value+'&BORN_DETAILS_HEALTH_CENTER_CD='+document.getElementById('BORN_DETAILS_HEALTH_CENTER_CD1').value+'&BORN_DETAILS_HEALTH_CENTER_CD2='+document.getElementById('BORN_DETAILS_HEALTH_CENTER_CD22').value;

	 window.open(url);

	 //alert (document.getElementById('BORN_DETAILS_BIRTH_PLACE_CD1').value);

	 }*/

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

	$c = Connect();

	$page_name = "Daily_Report.php";
	//  If you use this code with a different page ( or file ) name then change this

	$start = $_GET['start'];
	// To take care global variable if OFF

	if (!($start > 0)) {// This variable is set to zero for the first page

		$start = 0;

	}

	$eu = ($start - 0);

	$limit = 42;

	$K = 1;
	// No of records to be shown per page.

	$this1 = $eu + $limit;

	$back = $eu - $limit;

	$next = $eu + $limit;

	$curs = oci_new_cursor($c);

	$stmt = oci_parse($c, "begin USER_PROFILE.GET_USER_PROFILE(:un,:up,:user_curs); end;");

	oci_bind_by_name($stmt, ":un", $USER_ID, 32);

	oci_bind_by_name($stmt, ":up", $USER_PSW, 32);

	oci_bind_by_name($stmt, ":user_curs", $curs, -1, OCI_B_CURSOR);

	oci_execute($stmt);

	oci_execute($curs);

	$ROW = oci_fetch_assoc($curs);

	$date_F = $_GET['from'];

	$date_T = $_GET['to'];

	$df = $_GET['Date_From'];

	$dt = $_GET['Date_To'];

	$Date_From = $df;

	$Date_To = $dt;

	//$USER_CODE     = $ROW['USER_CODE'];
	$USER_FULL_NAME = $_GET['USER_FULL_NAME'];

	$BORN_DETAILS_BIRTH_PLACE_CD = $_GET['BORN_DETAILS_BIRTH_PLACE_CD'];

	$BORN_DETAILS_HEALTH_CENTER_CD = $_GET['BORN_DETAILS_HEALTH_CENTER_CD'];

	$BORN_DETAILS_HEALTH_CENTER_CD2 = $_GET['BORN_DETAILS_HEALTH_CENTER_CD2'];

	$CONDITON = '';

	$curs_borns = oci_new_cursor($c);

	$stmt_borns = oci_parse($c, "begin Daily_Report.GET_SPEC_BORNS(:FROM,:TO,:DREFF,:PLACE,:CENTER,:EPOINT,:BORN_INFO_C); end;");

	oci_bind_by_name($stmt_borns, ":FROM", $df, 32);

	oci_bind_by_name($stmt_borns, ":TO", $dt, 32);

	oci_bind_by_name($stmt_borns, ":DREFF", $USER_FULL_NAME, 32);

	oci_bind_by_name($stmt_borns, ":PLACE", $BORN_DETAILS_BIRTH_PLACE_CD, 32);

	oci_bind_by_name($stmt_borns, ":CENTER", $BORN_DETAILS_HEALTH_CENTER_CD, 32);

	oci_bind_by_name($stmt_borns, ":EPOINT", $BORN_DETAILS_HEALTH_CENTER_CD2, 32);

	oci_bind_by_name($stmt_borns, ":BORN_INFO_C", $curs_borns, -1, OCI_B_CURSOR);

	oci_execute($stmt_borns);

	oci_execute($curs_borns);

	$curs_borns1 = oci_new_cursor($c);

	$stmt_borns1 = oci_parse($c, "begin Daily_Report.GET_SPEC_BORNS_LIMIT(:FROM1,:TO1,:DREFF1,:PLACE1,:CENTER1,:EPOINT1,:BORN_INFO,:S,:E); end;");

	oci_bind_by_name($stmt_borns1, ":FROM1", $df, 32);

	oci_bind_by_name($stmt_borns1, ":TO1", $dt, 32);

	oci_bind_by_name($stmt_borns1, ":DREFF1", $USER_FULL_NAME, 32);

	oci_bind_by_name($stmt_borns1, ":PLACE1", $BORN_DETAILS_BIRTH_PLACE_CD, 32);

	oci_bind_by_name($stmt_borns1, ":CENTER1", $BORN_DETAILS_HEALTH_CENTER_CD, 32);

	oci_bind_by_name($stmt_borns1, ":EPOINT1", $BORN_DETAILS_HEALTH_CENTER_CD2, 32);

	oci_bind_by_name($stmt_borns1, ":S", $eu, 32);

	oci_bind_by_name($stmt_borns1, ":E", $limit, 32);

	oci_bind_by_name($stmt_borns1, ":BORN_INFO", $curs_borns1, -1, OCI_B_CURSOR);

	oci_execute($stmt_borns1);

	oci_execute($curs_borns1);
?>



      

</p>

<table width="200" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <th scope="col"><a href="Distribution_form.php">......����</a></th>

  </tr>

</table>

<p></p>

<?php

	$curs_birth = oci_new_cursor($c);

	$stmt_birth = oci_parse($c, "begin STATICS.GET_ALL_HEALTH_CENTERS(:BIRTH); end;");

	oci_bind_by_name($stmt_birth, ":BIRTH", $curs_birth, -1, OCI_B_CURSOR);

	oci_execute($stmt_birth);

	oci_execute($curs_birth);

	$curs_center_user = oci_new_cursor($c);

	$stmt_center_user = oci_parse($c, "begin USER_PROFILE.GET_SPEC_USER(:EPOINT,:USER); end;");

	oci_bind_by_name($stmt_center_user, ":USER", $curs_center_user, -1, OCI_B_CURSOR);

	oci_bind_by_name($stmt_center_user, ":EPOINT", $BORN_DETAILS_HEALTH_CENTER_CD2, 32);

	oci_execute($stmt_center_user);

	oci_execute($curs_center_user);

	$list = array();

	$array = "";

	while ($BIRTH_ROW = oci_fetch_array($curs_birth)) {

		array_push($list, $BIRTH_ROW);

	}

	$list_born = array();

	$list_user = array();

	while ($user_row1 = oci_fetch_array($curs_center_user)) {

		array_push($list_user, $user_row1);

	}
?>



 <table width="586" border="0" align="center" cellpadding="0" cellspacing="0">

   <tr>

     <th width="118" scope="col"><div align="right"><?php echo $dt;
	echo $date_T;
?></div></th>

     <th width="40" scope="col">:���</th>

     <th width="98" scope="col"><div align="right"><?php echo $df;
	echo $date_F;
?></div>     </th>

     <th width="330" scope="col">:������ ����� ���� ��������� �� ����� �������    </th>
   </tr>


 </table>

<p></p>

<form id="form1" name="form1" method="GET" action="Daily_Report.php?USER_FULL_NAME=document.getElementById('USER_FULL_NAME').value; &BORN_DETAILS_BIRTH_PLACE_CD=document.getElementById('BORN_DETAILS_BIRTH_PLACE_CD').value; &BORN_DETAILS_HEALTH_CENTER_CD=document.getElementById('BORN_DETAILS_HEALTH_CENTER_CD').value; 

&BORN_DETAILS_HEALTH_CENTER_CD2=document.getElementById('BORN_DETAILS_HEALTH_CENTER_CD2').value;&from=document.getElementById('Date_From').value; &to=document.getElementById('Date_To').value;">



<table width="1019" border="0" align="center" cellpadding="0" cellspacing="0">

     <tr>

       <th width="64" scope="col"><input name="query" type="submit" id="query" tabindex="59" value="�������" /></th>

    <th width="160" scope="col"> <div align="right" id="user1">

      <?PHP

	   echo "<select name='USER_FULL_NAME'  dir='rtl' id='USER_FULL_NAME' style='background-color:#FFFFFF;border-top-width:thin; border-style:groove;width:160px'>";

 echo "<option value=\"0\">���� ������</option>";

	  if ($BORN_DETAILS_HEALTH_CENTER_CD2!=0){

          foreach($list_user as $key=>$det_user){

		 if ($USER_FULL_NAME==$det_user[0]) 

				   $selected1= 'selected="selected"';

		  ?>

			  <option value="<?php echo $det_user[0];
	//$USER_CODE;
 ?>" <?php echo $selected1; ?>><?php echo $det_user[1];
	//$USER_FULL_NAME;
 ?></option>

			  <?php $selected1 = '';
	}

	}

	echo "</select>";
			  ?>

    </div></th>

       <th width="91" scope="col">:��� ��������</th>

       <th width="150" scope="col"><select name="BORN_DETAILS_HEALTH_CENTER_CD2" id="BORN_DETAILS_HEALTH_CENTER_CD2" dir="rtl" style="background-color:#FFFFFF;border-top-width:thin; border-style:groove;width:150px" onchange="show_data_user(this.value);">

         <option value="0" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 0 ? "selected='selected'" : ""; ?> >��� �����</option>

         <option value="123" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 123 ? "selected='selected'" : ""; ?> >����� ������� �������</option>

         <option value="1" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 1 ? "selected='selected'" : ""; ?>>������ ������</option>

         <option value="3" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 3 ? "selected='selected'" : ""; ?>>������ ����</option>

         <option value="6" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 6 ? "selected='selected'" : ""; ?>>������ ����� ������</option>

         <option value="9" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 9 ? "selected='selected'" : ""; ?>>������ �� �������</option>

         <option value="129" <?PHP  print $BORN_DETAILS_HEALTH_CENTER_CD2 == 129 ? "selected='selected'" : ""; ?>>������ ��������</option>

         <option value="11" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 11 ? "selected='selected'" : ""; ?>>����� ������</option>

         <option value="27" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 27 ? "selected='selected'" : ""; ?>>����� ������</option>

         <option value="36" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 36 ? "selected='selected'" : ""; ?>>��� �����</option>

         <option value="51" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 51 ? "selected='selected'" : ""; ?>>����� �������</option>

         <option value="65" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 65 ? "selected='selected'" : ""; ?>>���� ����� ���</option>

         <option value="66" <?PHP   print $BORN_DETAILS_HEALTH_CENTER_CD2 == 66 ? "selected='selected'" : ""; ?>>����� �� �������</option>

          <option value="131" <?PHP print $BORN_DETAILS_HEALTH_CENTER_CD2 == 131 ? "selected='selected'" : ""; ?>>���� ��� �����</option>

       </select></th>

       <th width="91" scope="col">:���� �������</th>

       <th width="150" scope="col"><div align="right">

         

           <select name="BORN_DETAILS_BIRTH_PLACE_CD" id="BORN_DETAILS_BIRTH_PLACE_CD" dir="rtl" style="background-color:#FFFFFF;border-top-width:thin; border-style:groove;width:150px">

                  <option value="0" <?PHP   print $BORN_DETAILS_BIRTH_PLACE_CD == 0 ? "selected='selected'" : ""; ?>>��� ����</option>

                  <option value="9" <?PHP   print $BORN_DETAILS_BIRTH_PLACE_CD == 9 ? "selected='selected'" : ""; ?>>������ ������ ���������</option>

                  <option value="3" <?PHP   print $BORN_DETAILS_BIRTH_PLACE_CD == 3 ? "selected='selected'" : ""; ?>>������ ���� �����</option>

                  <option value="6" <?PHP   print $BORN_DETAILS_BIRTH_PLACE_CD == 6 ? "selected='selected'" : ""; ?>>������ ����� ������</option>

                  <option value="1" <?PHP   print $BORN_DETAILS_BIRTH_PLACE_CD == 1 ? "selected='selected'" : ""; ?>>������ ������ ����</option>

                  <option value="2" <?PHP   print $BORN_DETAILS_BIRTH_PLACE_CD == 2 ? "selected='selected'" : ""; ?>>������ ������</option>

                  <option value="90" <?PHP  print $BORN_DETAILS_BIRTH_PLACE_CD == 90 ? "selected='selected'" : ""; ?>>������ ������� �������</option>

                  <option value="77" <?PHP  print $BORN_DETAILS_BIRTH_PLACE_CD == 77 ? "selected='selected'" : ""; ?>>������ �����</option>

                  <option value="87" <?PHP  print $BORN_DETAILS_BIRTH_PLACE_CD == 87 ? "selected='selected'" : ""; ?>>������ ������ ������</option>

                  <option value="99" <?PHP  print $BORN_DETAILS_BIRTH_PLACE_CD == 99 ? "selected='selected'" : ""; ?>>������ ���� ������� �����</option>

                  <option value="78" <?PHP  print $BORN_DETAILS_BIRTH_PLACE_CD == 78 ? "selected='selected'" : ""; ?>>������ ���� �������</option>

                  <option value="105" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD == 105 ? "selected='selected'" : ""; ?>>����� ������� �������</option>

                  <option value="106" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD == 106 ? "selected='selected'" : ""; ?>>����</option>                  

                  <option value="96" <?PHP  print $BORN_DETAILS_BIRTH_PLACE_CD == 96 ? "selected='selected'" : ""; ?>>������ ������ ������</option>

                  <option value="101" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD == 101 ? "selected='selected'" : ""; ?>>������ ��� ������</option>

                  <option value="102" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD == 102 ? "selected='selected'" : ""; ?>>������ �����</option>

                  <option value="103" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD == 103 ? "selected='selected'" : ""; ?>>������ ������ �������</option>

                  <option value="100" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD == 100 ? "selected='selected'" : ""; ?>>������ ����</option>

                  <option value="88" <?PHP  print $BORN_DETAILS_BIRTH_PLACE_CD == 88 ? "selected='selected'" : ""; ?>>���� ���</option>

                   <option value="107" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD == 107 ? "selected='selected'" : ""; ?>>������ ������ ������</option>

                  <option value="108" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD == 108 ? "selected='selected'" : ""; ?>>���� ���� ������</option>

                  <option value="109" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD == 109 ? "selected='selected'" : ""; ?>>����� �������</option>

                  <option value="110" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD == 110 ? "selected='selected'" : ""; ?>>���� �����</option>

                   <option value="129" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD == 129 ? "selected='selected'" : ""; ?>>������ ��������</option>

                    <option value="130" <?PHP print $BORN_DETAILS_BIRTH_PLACE_CD == 130 ? "selected='selected'" : ""; ?>>���� ��� ������</option>
 	      

                </select>

       </div></th>

       <th width="78" scope="col">:���� �������</th>

<th width="150" scope="col"><div align="right">

           <select name="BORN_DETAILS_HEALTH_CENTER_CD" id="BORN_DETAILS_HEALTH_CENTER_CD" dir="rtl" style="background-color:#FFFFFF;border-top-width:thin; border-style:groove;width:150px">

             <option value="0" selected="selected">��� �����</option>

             <?php 

				  

				   foreach($list as $key=>$det){

				    if ($BORN_DETAILS_HEALTH_CENTER_CD==$det{0}) 

				   $selected= 'selected="selected"';
 				   ?>

             <option value="<?php echo $det{0}; ?>" <?php echo $selected; ?>><?php echo $det{1}; ?></option>

             <?php $selected = '';
	}
 ?>

           </select>

       </div></th>

       <th width="95" scope="col">:������ �����</th>

       <input type="hidden" id="Date_From" name="Date_From"  value="<?php
	if ($date_F == '')
		echo $df;
	else
		echo $date_F;
?>"/>

       <input type="hidden" id="Date_To" name="Date_To" value="<?php
	if ($date_T == '')
		echo $dt;
	else
		echo $date_T;
?>" />

     </tr>

   </table>

</form>

<p></p>

 <table width="972" border="0" align="center" cellpadding="0" cellspacing="0">

   <tr>

     <th width="962" scope="col"><table width="948" height="69" border="1" align="left" cellpadding="0" cellspacing="0" bordercolor="#666666"  class="sortable"  id="anyid">

       <tr>

         <th width="164" height="37" bgcolor="#91B641" ><span class="style13">���� �������</span></th>

         <th width="213" height="37" bgcolor="#91B641"><div align="center" class="style7">��� ���� �����</div></th>

         <th width="219" height="37" bgcolor="#91B641"><div align="center" class="style7">��� ���� �����</div></th>

         <th width="92" height="37" bgcolor="#91B641"><div align="center" class="style7">��� �������</div></th>

         <th width="98" height="37" bgcolor="#91B641"><div align="center" class="style7  style11">����� �������</div></th>

         <th width="162" height="37" bgcolor="#91B641"><span class="style13"> ���� �������</span></th>

        </tr>

       <?php  
	   $ROW1=oci_fetch_assoc($curs_borns);

		 $number=1; 

		 while ($entry_borns = oci_fetch_assoc($curs_borns1)) {

	        array_push($list_born,$entry_borns1);

	  ?>

       <tr>

         <td height="30" ><div align="right" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px" ><?php echo $entry_borns{'DREF_NAME_AR'}; ?></div></td>

         <td height="30"><div align="right" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px"><?php echo $entry_borns{'MOTHER_FULL_NAME'}; ?></div></td>

         <td width="219" height="30" ><div align="right" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px" ><?php echo $entry_borns{'FATHER_FULL_NAME'}; ?></div></td>

         <td height="30" ><div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px" ><?php echo $entry_borns{'BI_FIRST_NAME'}; ?></div></td>

         <td height="30" ><div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px" ><?php echo $entry_borns{'DELIVERY_DATE'}; ?></div></td>

         <td height="30"><div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px"><?php echo $entry_borns{'BI_ID'}; ?></div></td>

        </tr>

       <?php

	$number = $number + 1;
	}
		  ?>

      

     </table>

     <div align="right"></div></th>

     <th width="57" scope="col"><table width="30" height="70" border="1" align="left" cellpadding="0" cellspacing="0">

       <tr>

         <th height="37" bgcolor="#91B641" scope="col">.�</th>

       </tr>

       <?php $j=1;  

	  

	  foreach($list_born as $key=>$born){ 

	  ?>

       <tr>

         <td height="30"><div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px"><?php echo '.' . $j; ?></div></td>

       </tr>

       <?php $j = $j + 1;
	}
?>

     </table></th>

   </tr>

 </table>

<p> <?PHP

	$p_limit = 168;
	// This should be more than $limit and set to a value for whick links to be breaked

	$p_f = $_GET['p_f'];
	// To take care global variable if OFF

	if (!($p_f > 0)) {// This variable is set to zero for the first page

		$p_f = 0;

	}

	$p_fwd = $p_f + $p_limit;

	$p_back = $p_f - $p_limit;

	//////////// End of variables for advance paging ///////////////

	/////////////// Start the buttom links with Prev and next link with page numbers /////////////////

	echo "<table align = 'center' width='50%'><tr><td  align='left' width='20%'>";

	if ($p_f <> 0) {print "<a href='$page_name?start=$p_back&p_f=$p_back&USER_FULL_NAME=$USER_FULL_NAME &BORN_DETAILS_BIRTH_PLACE_CD=$BORN_DETAILS_BIRTH_PLACE_CD &BORN_DETAILS_HEALTH_CENTER_CD=$BORN_DETAILS_HEALTH_CENTER_CD&BORN_DETAILS_HEALTH_CENTER_CD2=$BORN_DETAILS_HEALTH_CENTER_CD2&Date_From=$Date_From&Date_To=$Date_To'><font face='Verdana' size='2'><<<<<</font></a>";
	}

	echo "</td><td  align='left' width='10%'>";

	//// if our variable $back is equal to 0 or more then only we will display the link to move back ////////

	if ($back >= 0 and ($back >= $p_f)) {

		print "<a href='$page_name?start=$back&p_f=$p_f&USER_FULL_NAME=$USER_FULL_NAME &BORN_DETAILS_BIRTH_PLACE_CD=$BORN_DETAILS_BIRTH_PLACE_CD &BORN_DETAILS_HEALTH_CENTER_CD=$BORN_DETAILS_HEALTH_CENTER_CD&BORN_DETAILS_HEALTH_CENTER_CD2=$BORN_DETAILS_HEALTH_CENTER_CD2 &Date_From=$Date_From&Date_To=$Date_To'><font face='Verdana' size='2'>������</font></a>";

	}

	//////////////// Let us display the page links at  center. We will not display the current page as a link ///////////

	echo "</td><td align=center width='30%'>";

	for ($i = $p_f; $i < $ROW1{'C'} and $i < ($p_f + $p_limit); $i = $i + $limit) {

		if ($i <> $eu) {

			$i2 = $i + $p_f;

			echo " <a href='$page_name?start=$i&p_f=$p_f&USER_FULL_NAME=$USER_FULL_NAME &BORN_DETAILS_BIRTH_PLACE_CD=$BORN_DETAILS_BIRTH_PLACE_CD &BORN_DETAILS_HEALTH_CENTER_CD=$BORN_DETAILS_HEALTH_CENTER_CD&BORN_DETAILS_HEALTH_CENTER_CD2=$BORN_DETAILS_HEALTH_CENTER_CD2 &Date_From=$Date_From&Date_To=$Date_To'><font face='Verdana' size='2'>$K</font></a> ";

		} else { echo "<font face='Verdana' size='4' color=red>$K</font>";
		}/// Current page is not displayed as link and given font color red

		$K = $K + 1;

	}

	echo "</td><td  align='right' width='10%'>";

	///////////// If we are not in the last page then Next link will be displayed. Here we check that /////

	if ($this1 < $ROW1{'C'} and $this1 < ($p_f + $p_limit)) {

		print "<a href='$page_name?start=$next&p_f=$p_f&USER_FULL_NAME=$USER_FULL_NAME &BORN_DETAILS_BIRTH_PLACE_CD=$BORN_DETAILS_BIRTH_PLACE_CD &BORN_DETAILS_HEALTH_CENTER_CD=$BORN_DETAILS_HEALTH_CENTER_CD&BORN_DETAILS_HEALTH_CENTER_CD2=$BORN_DETAILS_HEALTH_CENTER_CD2 &Date_From=$Date_From&Date_To=$Date_To'><font face='Verdana' size='2'>������</font></a>";
	}

	echo "</td><td  align='right' width='20%'>";

	if ($p_fwd < $ROW1{'C'}) {

		print "<a href='$page_name?start=$p_fwd&p_f=$p_fwd&USER_FULL_NAME=$USER_FULL_NAME &BORN_DETAILS_BIRTH_PLACE_CD=$BORN_DETAILS_BIRTH_PLACE_CD &BORN_DETAILS_HEALTH_CENTER_CD=$BORN_DETAILS_HEALTH_CENTER_CD&BORN_DETAILS_HEALTH_CENTER_CD2=$BORN_DETAILS_HEALTH_CENTER_CD2 &Date_From=$Date_From&Date_To=$Date_To'><font face='Verdana' size='2'>>>>>></font></a>";

	}

	echo "</td></tr></table>";
?></p>

<p></p>

 <table width="895" border="0" align="center" cellpadding="0" cellspacing="0">

   <tr>

     <th width="69" scope="col"><a href="Daily_Report_Print.php?USER_FULL_NAME=<?php echo $USER_FULL_NAME; ?>&BORN_DETAILS_BIRTH_PLACE_CD=<?php echo $BORN_DETAILS_BIRTH_PLACE_CD; ?>&BORN_DETAILS_HEALTH_CENTER_CD=<?php echo $BORN_DETAILS_HEALTH_CENTER_CD; ?>&BORN_DETAILS_HEALTH_CENTER_CD2=<?php echo $BORN_DETAILS_HEALTH_CENTER_CD2; ?>&Date_From=<?php echo $df; ?>&Date_To=<?php echo $dt; ?>" >��� ����</a></th>

     <th width="68" scope="col"><div align="right"><?php echo $ROW1{'C'}; ?></div>     </th>

     <th width="76" scope="col">:��� �������</th>

     <th width="297" height="27" scope="col"><div align="right" class="style15"><?php echo $ROW{'USER_FULL_NAME'}; ?></div>

     <div align="right" class="style15"></div></th>

     <th width="93" scope="col"><span class="style17">:���� �������</span></th>

     <th width="189" class="style15" scope="col"><?PHP echo date('d/m/Y H:i', time()); ?></th>

     <th width="103" class="style17" scope="col">:������� ������</th>

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

