<?php
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
<script type="text/javascript" src="../js/ajax_auto.js"></script>
<script type="text/javascript" src="../js/ajax-dynamic-list.js"></script>
<script type="text/javascript" src="../dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<script src="../js/prototype.js" type="text/javascript"></script>
<script type="text/javascript">
function dtval(d,e) {
var pK = e ? e.which : window.event.keyCode;
if (pK == 8) {d.value = substr(0,d.value.length-1); return;}
var dt = d.value;
var da = dt.split('/');
for (var a = 0; a < da.length; a++) {if (da[a] != +da[a]) da[a] = da[a].substr(0,da[a].length-1);}
if (da[0] > 31) {da[1] = da[0].substr(da[0].length-1,1);da[0] = '0'+da[0].substr(0,da[0].length-1);}
if (da[1] > 12) {da[2] = da[1].substr(da[1].length-1,1);da[1] = '0'+da[1].substr(0,da[1].length-1);}
if (da[2] > 9999) da[1] = da[2].substr(0,da[2].length-1);
dt = da.join('/');
if (dt.length == 2 || dt.length == 5) dt += '/';
d.value = dt;
}
</script>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1256" />
<title>«” ⁄·«„«  Ê ﬁ«—Ì—</title>
<meta name="description" content="Health care website">
<meta name="keywords" content="health, care, healthcare">
<link type="text/css" rel="stylesheet" href="../dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<style type="text/css">
<!--
.style7 {font-family: "Arabic Transparent", Andalus}
.style8 {font-size: 16px; font-weight: bold; }
.style17 {
	font-size: 16px;
	font-weight: bold;
	font-family: "Times New Roman", Times, serif;
}
.style19 {font-family: "Arabic Transparent", Andalus; font-weight: bold; }
-->
</style>
</head>
<body>
<?php 
 $df=$_GET['from'];
 $dt=$_GET['to'];
 $af=$_GET['ag_f'];
 $at=$_GET['ag_t'];
 $dif=$_GET['di_f'];
 $dit=$_GET['di_t'];
 $yf=$_GET['ye_f'];
 $yt=$_GET['ye_t'];

 if ($_GET['sext']!='')
 $sexf=$_GET['sext'];
 else
 $sexf=4;
 
 $idt=$_GET['id_d'];
 
 ?>
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
<td width="5" valign="top">&nbsp;</td>
<td width="716" height="100%" valign="top"><table width="100%" height="10%" border="0" cellpadding="0" cellspacing="0">
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
<td class="c_name">Ê“«—… «·’Õ… «·›·”ÿÌ‰Ì…</td>
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
<td width="979" class="welcome"><a href="../logout.php"> ”ÃÌ· «·Œ—ÊÃ</a></td>
<td width="151" class="welcome"><div align="right"><strong>«·Ê›Ì‹‹‹‹« </strong></div></td>
</tr>
</table></td>
</tr>
<tr>
<td class="body_txt">
<p align="center"><a href="" onclick="this.href='../Data_Entry/main_D.php';" ><strong>«·—ÃÊ⁄ ··’›Õ… «·—∆Ì”Ì…</strong></a></p>
<form id="Query_birth" name="Query_birth" method="post" action="">
        <p>&nbsp;</p>
        <table width="550" height="242" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#999999">
          <tr>
            <td height="29" bgcolor="#A7C566">&nbsp;</td>
          </tr>
          <tr>
            <td height="137" bgcolor="#FFFFFF"><table width="587" height="135" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="27" bgcolor="#FFFFFF"><div align="right">
                    <select name="Sex" id="Sex" style="background-color:#FFFFFF;border-top-width:thin; border-style:groove;width:146px" dir="rtl" tabindex="2">
                      <option value="1" <?PHP print $sexf== 1 ? "selected='selected'" : ""; ?>>–ﬂ—</option>
                      <option value="2" <?PHP print $sexf == 2 ? "selected='selected'" : ""; ?>>√‰ÀÏ</option>
                      <option value="0" <?PHP print $sexf == 0 ? "selected='selected'" : ""; ?>>€Ì— „⁄—Ê›</option>
                      <option value="4" <?PHP print $sexf == 4 ? "selected='selected'" : ""; ?>></option>
                    </select>
                </div></td>
                <td bgcolor="#FFFFFF"><div align="right"><strong> </strong><strong>«·Ã‰”</strong></div></td>
                <td bgcolor="#FFFFFF"><div align="right">
                 <input type="text" name="Dead_ID" id="Dead_ID" tabindex="1" value="<?php echo $idt; ?>"/>
                </div></td>
                <td bgcolor="#FFFFFF"><div align="right"><strong>—ﬁ„ «·ÂÊÌ…</strong></div></td>
              </tr>
              <tr>
                <td height="27" bgcolor="#FFFFFF"><div align="right">
                  <input type="text" name="Age_To" id="Age_To" tabindex="4" value="<?php echo $at;?>" />
                </div></td>
                <td bgcolor="#FFFFFF"><div align="right"><strong>«·⁄„— »«·√Ì«„ «·Ï</strong></div></td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input type="text" name="Age_From" id="Age_From" tabindex="3" value="<?php echo $af;?>" />
                </div></td>
                <td bgcolor="#FFFFFF"><div align="center"><strong>«·⁄„— »«·√Ì«„ „‰</strong></div></td>
              </tr>
              <tr>
                <td width="209" height="27" bgcolor="#FFFFFF"><div align="right">
                    <input type="text" name="Diag_To" id="Diag_To" tabindex="6" value="<?php echo $dit;?>" />
                </div></td>
                <td width="92" bgcolor="#FFFFFF"><div align="right"><strong><strong>«· ‘ŒÌ’ «·Ï</strong></strong></div></td>
                <td width="199" bgcolor="#FFFFFF"><div align="right">
                    <input type="text" name="Diag_From" id="Diag_From" tabindex="5" value="<?php echo $dif;?>"/>
                </div></td>
                <td width="87" bgcolor="#FFFFFF"><div align="right"><strong>«· ‘ŒÌ’ „‰ </strong></div></td>
              </tr>
              <tr>
                <td bgcolor="#FFFFFF"><div align="right">
                    <input type="text" name="Year_To" id="Year_To" tabindex="8"  value="<?php echo $yt;?>"/>
                </div></td>
                <td bgcolor="#FFFFFF"><div align="right"><strong>«·”‰… «·Ï</strong></div></td>
                <td bgcolor="#FFFFFF"><div align="right">
                    <input type="text" name="Year_From" id="Year_From" tabindex="7" value="<?php echo $yf;?>"/>

                </div></td>
                <td bgcolor="#FFFFFF"><div align="right"><strong>«·”‰… „‰</strong></div></td>
              </tr>

              <tr>
                <td bgcolor="#FFFFFF"><div align="right"><strong>
                    <input type="button" value="..." onclick="displayCalendar(document.forms[0].Death_date_to,'dd/mm/yyyy',this,true)" />
                    <input type="text" onkeyup="dtval(this,event)" name="Death_date_to" id="Death_date_to" tabindex="10" value="<?php echo $dt;?>"  />
                </strong></div></td>
                <td bgcolor="#FFFFFF"><div align="right"><strong>«· «—ÌŒ «·Ï</strong></div></td>
                <td bgcolor="#FFFFFF"><div align="right"><strong>
                    <input type="button" value="..." onclick="displayCalendar(document.forms[0].Death_date_frm,'dd/mm/yyyy',this,true)" />
                    <input type="text" onkeyup="dtval(this,event)" name="Death_date_frm" id="Death_date_frm" tabindex="9" value="<?php  echo $df;?>" />
                </strong></div></td>
                <td bgcolor="#FFFFFF"><div align="right"><strong>«· «—ÌŒ „‰</strong></div></td>
              </tr>				<tr>																								<td>						<div align="center">							<select tabindex="22" name="DEAD_LOCATION_CD" id="death-location" style="background-color:#FFFFFF;border-top-width:thin; border-style:groove;width:140px" dir="rtl">							</select>						</div>					</td>					<td>						<div align="right">„ﬂ«‰ «·Ê›«… «·›—⁄Ì</div>					</td>					<td>						<div align="center">							<select tabindex="22" name="LOC_MASTER_DEPT_CD" id="LOC_MASTER_DEPT_CD" style="background-color:#FFFFFF;border-top-width:thin; border-style:groove;width:140px" onchange="get_locations(this.value);" dir="rtl">								<option value=""></option>								<option value="2">«·ÿÊ«—∆</option>								<option value="3">«·«ﬁ”«„ «·œ«Œ·Ì…</option>							</select>						</div>					</td>					<td>						<div align="right">„ﬂ«‰ «·Ê›«… œ«Œ· «·„” ‘›Ï</div>					</td>				</tr>			  
            </table></td>
            </tr>
          <tr>
            <td height="33" bgcolor="#FFFFFF"><table width="592" height="4" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
              <tr>
                <td width="258" ><p align="right" class="style8">&nbsp;</p></td>
                <td width="34" scope="col"><p align="center">&nbsp;</p></td>
                <td width="260" height="4" scope="col"><p align="right" class="style8"><a href="" class="style7" onclick="this.href= 'All_Death_Hos.php?d_from='+document.getElementById('Death_date_frm').value+'&amp;  d_to='+document.getElementById('Death_date_to').value+'&amp;  id='+document.getElementById('Dead_ID').value+'&amp;  sex='+document.getElementById('Sex').value+'&amp;  y_from='+document.getElementById('Year_From').value+'&amp;  y_to='+document.getElementById('Year_To').value+'&amp;  dia_from='+document.getElementById('Diag_From').value+'&amp;  dia_to='+document.getElementById('Diag_To').value+'&amp;  loc_master_dept_cd='+document.getElementById('LOC_MASTER_DEPT_CD').value+'&amp;  dead_location_cd='+document.getElementById('death-location').value; this.alert(href); "> ﬁ—Ì— ‘«„· ··Ê›Ì«  Œ«’ »‰ﬁÿ… «·«œŒ«·</a></p></td>
                <td width="34" ><p align="center"><strong>.1</strong></p></td>
              </tr>

            </table></td>
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
<td width="10" height="100%" valign="top">&nbsp;</td>
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