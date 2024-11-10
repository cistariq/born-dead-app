<?php
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
<script type="text/javascript" src="../dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1256" />
<title>استعلامات وتقارير</title>
<meta name="description" content="Health care website">
<meta name="keywords" content="health, care, healthcare">
<link type="text/css" rel="stylesheet" href="../dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<style type="text/css">
<!--
.style7 {font-family: "Arabic Transparent", Andalus}
.style8 {font-size: 16px; font-weight: bold; }
.style11 {
	font-family: "Arabic Transparent", Andalus;
	font-size: 16px;
	font-weight: bold;
}
.style12 {
	font-size: 16;
	font-weight: bold;
}
.style13 {
	font-family: "Arabic Transparent", Andalus;
	font-size: 16;
	font-weight: bold;
}
.style14 {font-size: 16px}
.style15 {font-family: "Arabic Transparent", Andalus; font-size: 16px; }
-->
</style>
</head>
<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td height="1" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="1">&nbsp;</td>
<td width="100%" align="center" background="../images/menu-bg.gif">&nbsp;</td>
</tr>
</table></td>
</tr>
<tr>
<td height="100%" valign="top">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="1" valign="top">&nbsp;</td>
<td height="100%" valign="top"><table width="100%" height="10%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td bgcolor="#ddd1b6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="1"><img src="../images/logo.gif" width="83" height="79"></td>
<td width="1" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><img src="../images/spacer.gif" alt="" width="1" height="9"></td>
</tr>
<tr>
<td background="../images/cname-bg.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="1"><img src="../images/spacer.gif" width="10" height="41"></td>
<td class="c_name">وزارة الصحة الفلسطينية</td>
</tr>
</table></td>
</tr>
<tr>
<td><img src="../images/spacer.gif" width="249" height="1"></td>
</tr>
<tr>
<td background="../images/cname-bg.gif" class="bgy"><img src="../images/spacer.gif" width="1" height="19"></td>
</tr>
<tr>
<td><img src="../images/spacer.gif" width="1" height="9"></td>
</tr>
</table></td>
<td background="../images/logo_rbg.gif" class="bgx">&nbsp;</td>
</tr>
</table></td>
</tr>
<tr>
<td background="../images/welcome-bg.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="1"><img src="../images/welcome-bg.gif" width="1" height="31"></td>
<td width="979" class="welcome"><a href="../logout.php">تسجيل الخروج</a></td>
<td width="151" class="welcome"><div align="right">مرحبا بك في نظام الولادة</div></td>
</tr>
</table></td>
</tr>
<tr>
<td class="body_txt">
<p align="center"><a href="" onclick="if ('<?php echo $USER_TYPE?>'==3) this.href='../Checker/main.php'; else this.href='../Admin/main.php';" ><strong>الرجوع للصفحة الرئيسية</strong></a></p>
<form id="Query_birth" name="Query_birth" method="post" action="">
        <p>&nbsp;</p>
        <table width="550" height="315" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#999999">
          <tr>
            <td height="29" bgcolor="#A7C566">&nbsp;</td>
          </tr>
          <tr>
            <td height="184" bgcolor="#FFFFFF"><p></p><p align="center"><strong>
            <input type="button" value="..." onclick="displayCalendar(document.forms[0].Birth_date_to,'dd/mm/yyyy',this,true)" />
            <input type="text" value="<?php echo date('d/m/Y',time()); ?>" readonly="readonly"  name="Birth_date_to" id="Birth_date_to" />
التاريخ من
<input type="text" value="<?php echo date('d/m/Y',time());?>" readonly="readonly"  name="Birth_date_frm" id="Birth_date_frm" />
<input type="button" value="..." onclick="displayCalendar(document.forms[0].Birth_date_frm,'dd/mm/yyyy',this,true)" />
            </strong><strong>التاريخ الى</strong></p>
              <div align="right">
                <label></label>
                <table width="592" height="81" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#999999">
                  <tr>
                    <td width="258" scope="col"><div align="right" class="style7"><a href="" onclick="this.href= 'Daily_Report.php?from='+document.getElementById('Birth_date_frm').value+'&amp;  to='+document.getElementById('Birth_date_to').value; this.alert(href); " class="style8"> تقرير يومي للمواليد حسب تاريخ الادخال</a></div></td>
                    <td width="40" scope="col"><div align="center"><strong>.7</strong></div></td>
                    <td width="260" height="27" scope="col"><p align="right" class="style8"><a href="" class="style7" onclick="this.href= 'Distribution_Births.php?from='+document.getElementById('Birth_date_frm').value+'&amp;  to='+document.getElementById('Birth_date_to').value; this.alert(href); ">توزيع المواليد حسب مكان الولادة </a></p>                      </td>
                    <td width="34" >                                      <p align="center"><strong>.1</strong></p></td>
                  </tr>
                  <tr>
                    <td width="258" scope="col"><div align="right" class="style7"><a href="" onclick="this.href= 'Daily_Report_Delivery.php?from='+document.getElementById('Birth_date_frm').value+'&amp;  to='+document.getElementById('Birth_date_to').value; this.alert(href); " class="style8">تقرير يومي للمواليد حسب تاريخ الولادة</a></div></td>
                    <td width="40" scope="col"><div align="center"><strong>.8</strong></div></td>
                    <td height="27" ><p align="right" class="style8"><a href="" class="style7" onclick="this.href= 'Distribution_Ages.php?from='+document.getElementById('Birth_date_frm').value+'&amp;  to='+document.getElementById('Birth_date_to').value; this.alert(href); ">توزيع المواليد حسب الفئات العمرية</a></p></td>
                    <td width="34" >                                      <p align="center"><strong>.2</strong></p></td>
                  </tr>
                  <tr>
                    <td width="258" scope="col"><div align="right">
                      <p><a href="" class="style11" onclick="this.href= 'Distribution_Weight.php?from='+document.getElementById('Birth_date_frm').value+'&amp;  to='+document.getElementById('Birth_date_to').value; this.alert(href); ">توزيع المواليد حسب الوزن</a></p>
                    </div></td>
                    <td width="34" scope="col"><p align="center"><strong>.9</strong></p></td>
                    <td ><p align="right" class="style8"><a href="" class="style7" onclick="this.href= 'Distribution_sex.php?from='+document.getElementById('Birth_date_frm').value+'&amp;  to='+document.getElementById('Birth_date_to').value; this.alert(href); ">توزيع المواليد حسب المحافظات</a></p></td>
                    <td width="34" scope="col">                                      <p align="center"><strong>.3</strong></p></td>
                  </tr>
                  <tr>
                    <td scope="col"><div align="right">
                      <p align="right" class="style8"><a href="" class="style13" onclick="this.href= 'Distribution_Twins.php?from='+document.getElementById('Birth_date_frm').value+'&amp;  to='+document.getElementById('Birth_date_to').value; this.alert(href); "><span class="style14">توزيع المواليد حسب التوائ</span>م</a></p>
                    </div></td>
                    <td width="34" ><p align="center"><strong>.10</strong></p></td>
                    <td ><div align="right" class="style8">
                      <p align="right" class="style8"><a href="" class="style7" onclick="this.href= 'Distribution_Clinics.php?from='+document.getElementById('Birth_date_frm').value+'&amp;  to='+document.getElementById('Birth_date_to').value; this.alert(href); ">توزيع المواليد حسب المركز الصحي</a></p>
                    </div></td>
                    <td width="34" ><p align="center"><strong>.4</strong></p></td>
                  </tr>
                  <tr>
                    <td scope="col"><div align="right" class="style12">
                      <p align="right" class="style8"><a href="" class="style15" onclick="this.href= 'Distribution_Years.php?from='+document.getElementById('Birth_date_frm').value+'&amp;  to='+document.getElementById('Birth_date_to').value; this.alert(href); ">توزيع المواليد حسب المستوى التعليمي</a></p>
                    </div></td>
                    <td width="34" ><p align="center"><strong>.11</strong></p></td>
                    <td ><div align="right"><a href="" class="style11" onclick="this.href= 'Distribution_Region.php?from='+document.getElementById('Birth_date_frm').value+'&amp;  to='+document.getElementById('Birth_date_to').value; this.alert(href); ">توزيع تفصيلي للمواليد حسب المحافظات</a></div></td>
                    <td width="34" ><p align="center"><strong>.5</strong></p></td>
                  </tr>
                  <tr>
                    <td scope="col"><div align="right">
                      <p align="right" class="style8"><a href="" class="style11" onclick="this.href= 'Distribution_Job.php?from='+document.getElementById('Birth_date_frm').value+'&amp;  to='+document.getElementById('Birth_date_to').value; this.alert(href); ">توزيع المواليد حسب المهنة</a></p>
                    </div></td>
                    <td width="34" scope="col"><p align="center"><strong>.12</strong></p></td>
                    <td ><div align="right" class="style12">
                      <p align="right" class="style8"><a href="" class="style7 style14" onclick="this.href= 'Distribution_SexOnly.php?from='+document.getElementById('Birth_date_frm').value+'&amp;  to='+document.getElementById('Birth_date_to').value; this.alert(href); ">توزيع المواليد حسب الجنس</a></p>
                    </div></td>
                    <td width="34" scope="col"><p align="center"><strong>.6</strong></p></td>
                  </tr>
                </table>
              </div>              
                 
                  
                  </td>
          </tr>
          
          
          
          <tr>
            <td height="27" bgcolor="#A7C566">&nbsp;</td>
          </tr>
        </table>
        <p>&nbsp;</p>
        <label></label>
      </form></p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
</tr>

</table></td>
<td height="100%" valign="top">&nbsp;</td>
</tr>
</table></td>
</tr>
<tr>
<td height="1" valign="top" background="../images/bot-bg.gif" class="bgx"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="1"><img src="../images/bot-bg.gif" width="7" height="57"></td>
<td class="address">&nbsp;</td>
</tr>
</table></td>
</tr>
</table>
<div style="position:absolute;left:-30000px;top:-30000px"><a href="http://anvisionwebtemplates.com">Website templates</a><a href="http://cityants.co.uk">Business directory UK</a><a href="http://cityants.net">Yellow pages US</a><a href="http://anvisionwebdesign.com">Website design company</a><a href="http://webdesignfinders.net">Web design directory</a><a href="http://australia.webdesignfinders.net">Web design directory Australia</a><a href="http://canada.webdesignfinders.net">Web design directory Canada</a><a href="http://anvisionwebtemplates.com/free-health-care-fitness-web-templates-layouts.html">Free health care / fitness web templates</a></div>
</body>
</html>