<html>

<div dir="ltr">

    <body>
        <div style="width:1000px; margin:0 auto;" class="text-center">

            <h3>تقارير يومية خاصة بالمواليد حسب مكان الولادة من تاريخ {{$old_record['date_F']}} حتى تاريخ {{$old_record['date_T']}} </h3>

        </div>
        <div style="width:1000px; margin: auto;" class="text-center">


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
      <td><div align="center" class="style27"><?php echo $born['COUNTER'];?></div></td>
      <td height="20"><div align="right" class="style27" ><?php echo $born['DREF_NAME_AR'];?></div></td>
     </tr>
    <?php
       $i=$i+1;}
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
<table width="602" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <th width="63" class="style28" scope="col">
            <div align="right"></div>{{$j-1}}
        </th>
        <th width="83" class="style28" scope="col">:عدد السجلات</th>
        <th width="289" height="27" class="style28" scope="col">
            <div align="right" class="style29"> {{ $user_name }}</div>
            <div align="right" class="style29"></div>
        </th>
        <th width="104" class="style28" scope="col"><span class="style17">:منشئ التقرير</span></th>
    </tr>
</table>
<p></p>
</body>
</div>
