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
<html
	xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<script type="text/javascript" src="../js/ajax.js"></script>
		<script type="text/javascript" src="../js/sortable.js"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1256" />
		<title>������ ����� ���� �������� </title>
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
						<!-- .style7 {
                font-size: 14;
                color: #000000;
            }

            .style11 {
                font-size: 14px
            }

            .style13 {
                font-size: 14
            }

            .style14 {
                font-size: 12px
            }

            .style15 {
                font-family: "Arabic Transparent", Andalus;
                font-weight: bold;
                font-size: 16px;
            }

            .style17 {
                font-family: Andalus, "Arabic Transparent";
                color: #FF0000;
            }

            -->
					</style>
				</head>
				<body onload="checkJavaScriptValidity()">
					<p>
						<?PHP

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

$page_name="All_Death_Hos.php"; //  If you use this code with a different page ( or file ) name then change this

$start=$_GET['start'];								// To take care global variable if OFF

if(!($start > 0)) {                         // This variable is set to zero for the first page

$start = 0;

}

$eu = ($start -0);

$limit =42;

$K=1;                       // No of records to be shown per page.

$this1 = $eu + $limit;

$back = $eu - $limit;

$next = $eu + $limit;

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

$loc_master_dept_cd = $_GET['loc_master_dept_cd'];
$dead_location_cd = $_GET['dead_location_cd'];

////////////////////////////

$curs_F = oci_new_cursor($c);

$stmt_F = oci_parse($c , "begin Daily_Report.GET_DEATHS_FOR_HOS(:ID_NUMBER,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:POINT_CD,:DEADS,:V_LOC_MASTER_DEPT_CD,:V_DEAD_LOCATION_CD); end;");

//var_dump($_GET);

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

oci_bind_by_name($stmt_F,":POINT_CD",$ROW{'USER_DREF_CD'},32);

oci_bind_by_name($stmt_F,":DEADS",$curs_F,-1,OCI_B_CURSOR);

oci_bind_by_name($stmt_F,":V_LOC_MASTER_DEPT_CD",$loc_master_dept_cd,32);
oci_bind_by_name($stmt_F,":V_DEAD_LOCATION_CD",$dead_location_cd,32);

oci_execute($stmt_F);

oci_execute($curs_F);

///=------------------------

$curs_F1 = oci_new_cursor($c);

$stmt_F1 = oci_parse($c , "begin Daily_Report.GET_DEATHS_FOR_HOS_LIMIT(:ID_NUMBER,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:POINT_CD,:DEADS,:S,:E,:V_LOC_MASTER_DEPT_CD,:V_DEAD_LOCATION_CD); end;");

oci_bind_by_name($stmt_F1,":V_LOC_MASTER_DEPT_CD",$loc_master_dept_cd,32);
oci_bind_by_name($stmt_F1,":V_DEAD_LOCATION_CD",$dead_location_cd,32);
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

oci_bind_by_name($stmt_F1,":POINT_CD",$ROW{'USER_DREF_CD'},32);

oci_bind_by_name($stmt_F1,":S",$eu,32);

oci_bind_by_name($stmt_F1,":E",$limit,32);

oci_bind_by_name($stmt_F1,":DEADS",$curs_F1,-1,OCI_B_CURSOR);

oci_execute($stmt_F1);

oci_execute($curs_F1);

///-------------------------------------

$curs_epoint = oci_new_cursor($c);

$stmt_epoint = oci_parse($c , "begin STATICS.GET_ALL_POINT(:e_point_curs); end;");

oci_bind_by_name($stmt_epoint,":e_point_curs",$curs_epoint,-1,OCI_B_CURSOR);

oci_execute($stmt_epoint);

oci_execute($curs_epoint);

?>
					</p>
					<table width="200" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
							<th scope="col">
								<a href="Distribution_form_HOSD.php?from=
									<?php echo $d_from;?>&to=
									<?php echo $d_to; ?>&ag_f=
									<?php echo $age_From; ?>&ag_t=
									<?php echo $age_To;?>&di_f=
									<?php echo $dia_from;?>&di_t=
									<?php echo $dia_to;?>&ye_f=
									<?php echo $y_from;?>&ye_t=
									<?php echo $y_to;?>&sext=
									<?php echo $sex;?>&id_d=
									<?php echo $id;?>">......����
								</a>
							</th>
						</tr>
					</table>
					<p></p>
					<table width="534" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
							<th height="60" colspan="4" scope="col">
								<div style="font-weight:bold; font-size:22px;">����� ���� ������� ��� ���� �������</div>
							</th>
						</tr>
						<?php if ($d_to!='' || $d_from!=''){?>
						<tr>
							<th width="214" height="34" scope="col">
								<div align="right">
									<?php echo $d_to;?>
								</div>
							</th>
							<th width="37" scope="col">:���</th>
							<th width="109" scope="col">
								<div align="right">
									<?php echo $d_from;?>
								</div>
							</th>
							<th width="174" scope="col">: �� ����� ������</th>
						</tr>
						<?php }?>
						<?php if ($dia_to!='' || $dia_from!=''){?>
						<tr>
							<th scope="col">
								<div align="right">
									<?php echo $dia_to;?>
								</div>
							</th>
							<th scope="col">:���</th>
							<th scope="col">
								<div align="right">
									<?php echo $dia_from;?>
								</div>
							</th>
							<th scope="col">
								<div align="center">: �� �����</div>
							</th>
						</tr>
						<?php }?>
						<?php if ($age_To!='' || $age_From!=''){?>
						<tr>
							<th scope="col">
								<div align="right">
									<?php echo $age_To;?>
								</div>
							</th>
							<th scope="col">:���</th>
							<th scope="col">
								<div align="right">
									<?php echo $age_From;?>
								</div>
							</th>
							<th scope="col"> :�� ��� </th>
						</tr>
						<?php }?>
						<?php if ($y_from!='' || $y_to!=''){?>
						<tr>
							<th scope="col">
								<div align="right">
									<?php echo $y_to;?>
								</div>
							</th>
							<th scope="col">:���</th>
							<th scope="col">
								<div align="right">
									<?php echo $y_from;?>
								</div>
							</th>
							<th scope="col">:�� ���</th>
						</tr>
						<?php }?>
						<?php if ($sex!=''){?>
						<tr>
							<th colspan="3" scope="col">
								<div align="right">
									<?php if ($sex==1) echo '���'; elseif ($sex==2) echo '����'; elseif ($sex=='') echo ''; elseif ($sex==0) echo '��� �����';?>
								</div>
							</th>
							<th scope="col">: �����</th>
						</tr>
						<?php }?>
					</table>
					<p></p>
					<table width="985" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
							<th width="971" scope="col">
								<table width="1211" height="93" border="1" align="right" cellpadding="0" cellspacing="0" bordercolor="#666666" class="sortable" id="anyid">
									<tr>
										<th width="85" bgcolor="#91B641">���� ������ ���� ��������</th>
										<th width="85" bgcolor="#91B641">��� ���� ������</th>
										<th width="72" bgcolor="#91B641">��� �������</th>
										<th width="98" bgcolor="#91B641">��� ���� �������</th>
										<th width="147" height="37" bgcolor="#91B641">
											<span class="style13">�������</span>
											<div align="center" class="style7"></div>
										</th>
										<th width="151" bgcolor="#91B641">��� ������</th>
										<th width="106" bgcolor="#91B641">�������</th>
										<th width="179" bgcolor="#91B641">
											<div align="center" class="style7">��� ������� �����</div>
										</th>
										<th width="58" height="37" align="center" bgcolor="#91B641">�����</th>
										<th width="85" height="37" bgcolor="#91B641">
											<div align="center" class="style7">����� ������</div>
										</th>
										<th width="75" height="37" bgcolor="#91B641">
											<div align="center" class="style7  style11">����� �������</div>
										</th>
										<th width="87" bgcolor="#91B641">���� �������</th>
										<th width="42" height="37" bgcolor="#91B641">������</th>
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
										<td align="center">
											<div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
												<?php echo $entry_F{'DEAD_LOCATION_NAME'}; ?>
											</div>
										</td>
										<td align="center">
											<div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
												<?php echo $entry_F{'DEAD_REPORT_SUBMITTED_ID'}; ?>
											</div>
										</td>
										<td align="center">
											<div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
												<?php echo $entry_F{'DEAD_D_RELATIONSHIP'}; ?>
											</div>
										</td>
										<td align="center">
											<div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
												<?php echo $entry_F{'DEAD_REPORT_SUBMITTED_BY'}; ?>
											</div>
											<div align="right" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px"></div>
										</td>
										<td height="54">
											<div align="left" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
												<?php echo $entry_F{'DIAG'}; ?>
											</div>
											<div align="right" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px"></div>
										</td>
										<td width="151" align="center">
											<div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
												<?php echo $entry_F{'DEAD_REPORT_DOC_BY'}; ?>
											</div>
										</td>
										<td width="106" align="center">
											<div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
												<?php echo $entry_F{'DEAD_REG'}; ?>
											</div>
										</td>
										<td width="179">
											<div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
												<?php echo $entry_F{'DEAD_NAME'}; ?>
											</div>
										</td>
										<td width="58" height="54" align="center">
											<div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
												<?php echo $entry_F{'DEAD_SEX'}; ?>
											</div>
										</td>
										<td height="54">
											<div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
												<?php echo $entry_F{'DEAD_DOD'}; ?>
											</div>
										</td>
										<td height="54">
											<div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
												<?php echo $entry_F{'DEAD_DOB'}; ?>
											</div>
										</td>
										<td>
											<div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
												<?php echo $entry_F{'DEAD_ID'}; ?>
											</div>
										</td>
										<td height="54">
											<div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
												<?php echo  $cc;?>
											</div>
										</td>
									</tr>
									<?php

$number=$number+1;}

?>
								</table>
								<div align="right"></div>
							</th>
							<th width="185" scope="col">
								<table width="30" style="display:none;" height="93" border="1" align="left" cellpadding="0" cellspacing="0">
									<tr>
										<th height="37" bgcolor="#91B641" scope="col">.�</th>
									</tr>
									<?php $j=1;

	  foreach($list_born as $key=>$born){

	  ?>
									<tr>
										<td height="54">
											<div align="center" style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
												<?php echo '.'.$j; echo $born[0];?>
											</div>
										</td>
									</tr>
									<?php $j=$j+1; }?>
								</table>
							</th>
						</tr>
					</table>
					<p>
						<?PHP

	 $p_limit=168; // This should be more than $limit and set to a value for whick links to be breaked

$p_f=$_GET['p_f'];								// To take care global variable if OFF

if(!($p_f > 0)) {                         // This variable is set to zero for the first page

$p_f = 0;

}

$p_fwd=$p_f+$p_limit;

$p_back=$p_f-$p_limit;

//////////// End of variables for advance paging ///////////////

/////////////// Start the buttom links with Prev and next link with page numbers /////////////////

echo "
						<table align = 'center' width='50%'>
							<tr>
								<td  align='left' width='20%'>";

if($p_f<>0){print "
									<a href='$page_name?start=$p_back&p_f=$p_back&d_from=$d_from&d_to=$d_to&id=$id&sex=$sex&y_from=$y_from&y_to=$y_to&dia_from=$dia_from&dia_to=$dia_to&age_From=$age_From&age_To=$age_To'>
										<font face='Verdana' size='2'><<<<<
										</font>
									</a>"; }

echo "
								</td>
								<td  align='left' width='10%'>";

//// if our variable $back is equal to 0 or more then only we will display the link to move back ////////

if($back >=0 and ($back >=$p_f)) {

print "
									<a href='$page_name?start=$back&p_f=$p_f&d_from=$d_from&d_to=$d_to&id=$id&sex=$sex&y_from=$y_from&y_to=$y_to&dia_from=$dia_from&dia_to=$dia_to&age_From=$age_From&age_To=$age_To'>
										<font face='Verdana' size='2'>������</font>
									</a>";

}

//////////////// Let us display the page links at  center. We will not display the current page as a link ///////////

echo "
								</td>
								<td align=center width='30%'>";

for($i=$p_f;$i < $ROW1{'COUNTER'} and $i<($p_f+$p_limit);$i=$i+$limit){

if($i <> $eu){

$i2=$i+$p_f;

echo "
									<a href='$page_name?start=$i&p_f=$p_f&d_from=$d_from&d_to=$d_to&id=$id&sex=$sex&y_from=$y_from&y_to=$y_to&dia_from=$dia_from&dia_to=$dia_to&age_From=$age_From&age_To=$age_To'>
										<font face='Verdana' size='2'>$K</font>
									</a> ";

}

else { echo "
									<font face='Verdana' size='4' color=red>$K</font>";}        /// Current page is not displayed as link and given font color red

$K=$K+1;

}

echo "
								</td>
								<td  align='right' width='10%'>";

///////////// If we are not in the last page then Next link will be displayed. Here we check that /////

if($this1 < $ROW1{'COUNTER'} and $this1 <($p_f+$p_limit)){

print "
									<a href='$page_name?start=$next&p_f=$p_f&d_from=$d_from&d_to=$d_to&id=$id&sex=$sex&y_from=$y_from&y_to=$y_to&dia_from=$dia_from&dia_to=$dia_to&age_From=$age_From&age_To=$age_To'>
										<font face='Verdana' size='2'>������</font>
									</a>";}

echo "
								</td>
								<td  align='right' width='20%'>";

if($p_fwd < $ROW1{'COUNTER'}){

print "
									<a href='$page_name?start=$p_fwd&p_f=$p_fwd&d_from=$d_from&d_to=$d_to&id=$id&sex=$sex&y_from=$y_from&y_to=$y_to&dia_from=$dia_from&dia_to=$dia_to&age_From=$age_From&age_To=$age_To'>
										<font face='Verdana' size='2'>>>>>></font>
									</a>";

}

echo "
								</td>
							</tr>
						</table>";

?>
					</p>
					<p></p>
					<table width="895" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
							<th scope="col">&nbsp;</th>
							<th width="68" scope="col">
								<div align="right">
									<?php echo $ROW1{'COUNTER'}; ?>
								</div>
							</th>
							<th width="76" scope="col">:��� �������</th>
							<th width="297" height="27" scope="col">
								<div align="right" class="style15">
									<?php echo  $ROW{'USER_FULL_NAME'}; ?>
								</div>
								<div align="right" class="style15"></div>
							</th>
							<th width="93" scope="col">
								<span class="style17">:���� �������</span>
							</th>
							<th width="189" class="style15" scope="col">
								<?PHP echo date('d/m/Y H:i',time());?>
							</th>
							<th width="103" class="style17" scope="col">:������� ������</th>
						</tr>
					</table>
					<p></p>
					<table width="311" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<th width="209" scope="col">&nbsp;</th>
							<th width="257" scope="col">
								<img src="../images/logo.jpg" width="89" height="48" />
							</th>
						</tr>
					</table>
					<p></p>
				</body>
			</html>
