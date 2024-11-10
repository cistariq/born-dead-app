<html>
<style>
    .st_body {
        font-family: "Times New Roman", Times, sans-serif;

        padding-top: 1px;
        padding-bottom: 1px;
        border: solid blue;
        border-width: thin;
    }

    .st_td {
        font-family: "Times New Roman", Times, sans-serif;

        padding-top: 1px;
        padding-bottom: 1px;
        border: solid black;
        border-width: thin;
        text-align: center;
    }

    th {
        font-family: "Times New Roman", Times, sans-serif;

        padding-top: 1px;
        padding-bottom: 1px;
        text-align: center;

    }

    h3 {
        text-align: center;
    }
    table{
        margin-left: auto;
        margin-right: auto;
    }
</style>
<div dir="ltr">

    <body class="st_body">
        <div style="width:1000px; margin:0 auto;" class="text-center">

            <h3>توزيع الوفيات حسب الحالة الاجتماعية</h3>

        </div>
        <div style="width:1000px; margin: auto;" class="text-center">

            <table id="result_tb" class="table table-striped dt-responsive table-row-bordered gy-5 gs-7"
                style="width:472px">
                @if ($old_record['Death_date_frm'] != '' || $old_record['Death_date_frm'] != '')
                    <tr>
                        <th width="50px" scope="col">إلى:</th>
                        <th width="50px" height="34" scope="col">
                            {{ $old_record['Death_date_to'] }}
                        </th>
                        <th width="50px" scope="col">من تاريخ:</th>
                        <th width="50px" scope="col">
                            {{ $old_record['Death_date_frm'] }}
                        </th>

                    </tr>
                @endif

                @if ($old_record['Diag_From'] != '' || $old_record['Diag_To'] != '')
                    <tr>
                        <th width="50px" scope="col">إلى:</th>
                        <th width="50px" scope="col">{{ $old_record['Diag_To'] }}</th>
                        <th width="50px" scope="col"> من تشخيص:</th>
                        <th width="50px" scope="col">{{ $old_record['Diag_From'] }}</th>

                    </tr>
                @endif
                @if ($old_record['Age_From'] != '' || $old_record['Age_To'] != '')
                    <tr>
                        <th scope="col">إلى:</th>
                        <th scope="col">
                            {{ $old_record['Age_To'] }}
                        </th>
                        <th scope="col">من عمر:</th>
                        <th scope="col">
                            {{ $old_record['Age_From'] }}
                        </th>

                    </tr>
                @endif
                @if ($old_record['Year_From'] != '' || $old_record['Year_To'] != '')
                    <tr>
                        <th scope="col">إلى:</th>
                        <th scope="col">
                            {{ $old_record['Year_To'] }}
                        </th>
                        <th scope="col">من السنة:</th>
                        <th scope="col">
                            {{ $old_record['Year_From'] }}
                        </th>

                    </tr>
                @endif
                @php
                    if ($old_record['Sex'] == 0) {
                        $sex1 = 'غير معروف';
                    } elseif ($old_record['Sex'] == 1) {
                        $sex1 = 'ذكر';
                    } elseif ($old_record['Sex'] == 2) {
                        $sex1 = 'أنثى';
                    }
                @endphp
                @if ($old_record['Sex'] != '')
                    <tr>
                        <th scope="col">الجنس:</th>
                        <th scope="col">
                            {{ $sex1 }}
                        </th>

                    </tr>
                @endif

            </table>
            <P></P>

<table  width="400" height="29" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#999999">
<tr>
<td width="574" ><div  class="p-3 mb-2 bg-success text-white" style="border: none;"><strong>الوفيات</strong></div></td>
</tr>
</table>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
  <th width="288" scope="col"><table width="400" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
    <tr>
      <th width="96" scope="col" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">%</th>
      <th width="104" scope="col" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">العدد</th>
      <th width="163" scope="col" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">الحالة الاجتماعية</th>
     </tr>
    <?php
    $TOTAL_A=0;
    ?>
                            @foreach ($data as $key => $value)
                            <?php

$TOTAL_A=$TOTAL_A+$value['C'];
?>


    <tr>
      <td><div align="center">{{number_format(($value['C']/$TOTAL_A*100),2,'.','')}}</div></td>
      <td><div align="center">{{$value['C']}}</div></td>
      <td><div align="center">{{$value['MS_NAME_AR']}}</div></td>
     </tr>
     @endforeach


     @foreach ($data1 as $key => $value)
     <tr>
      <td><div align="center">{{ number_format(($value['ALL_DEATH']/($TOTAL_A)*100),2,'.','')}}</div></td>
      <td><div align="center">{{$value['ALL_DEATH'];}}</div></td>
      <td><div align="center">المجموع</div></td>
     </tr>
     @endforeach
  </table></th>
</tr>
</table>
<p></p>

<table id="result_tb" class="table table-striped dt-responsive table-row-bordered gy-5 gs-7"
            style="width:686px">
            <tr>
                <th width="177" height="27" scope="col">
                    <div><strong>
                            {{ $user_name }}
                    </div></strong>
                </th>
                <th width="150" class="style22" scope="col">
                    <div><strong>
                            منشئ التقرير:
                        </strong>
                    </div>
                </th>
                <th width="280" scope="col">
                    <div><strong>
                            {{ date('d/m/Y H:i', time()) }}

                    </div></strong>
                </th>
                <th width="280" scope="col">
                    <div><strong>
                            تاريخ ووقت الطباعة:
                        </strong>
                </th>


            </tr>

        </table>
        <p></p>
        <p></p>
    </div>
</body>
</div>

</html>
