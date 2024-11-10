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

    table {
        margin-left: auto;
        margin-right: auto;
    }
</style>
<div dir="ltr">

    <body class="st_body">
        <div style="width:1000px; margin:0 auto;" class="text-center">

            <h3>توزيع الوفيات تبعا لمستشفى الوفاة</h3>

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

            <table class="sortable" id="anyid" width="478" cellpadding="0" cellspacing="0" bordercolor="#666666">

                <tr>
                    <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">المجموع</th>
                    <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">غير معروف</th>

                    <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">اناث</th>
                    <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">ذكور</th>
                    <th width="152" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                        <div><span class="style23">مكان الوفاة</span></div>
                    </th>
                </tr>
                @php
                    $age_F = 0;
                    // if (isset($for_kids)) {
                    //     if ($for_kids === '0') {
                    //         // report for older death
                    //         $age_F = 1;
                    //     }
                    // }
                    $age_T = 1500;

                    $MTOTAL = 0;
                    $FTOTAL = 0;
                    $TUNKNOWN = 0;
                    $TTOTAL = 0;

                @endphp
                @foreach ($data as $key => $value)
                    <tr>
                        <td class="text-center st_td">{{ $value['TOTAL'] }}</td>
                        <td class="text-center st_td">{{ $value['UNKNOWN'] }}</td>
                        <td class="text-center st_td">{{ $value['FEMALE'] }}</td>
                        <td class="text-center st_td">{{ $value['MALE'] }}</td>
                        <td width="152">
                            <div class="style31">{{ $value['HOS_NAME_AR'] }}</div>
                        </td>
                    </tr>
                    @php
                        $MTOTAL = $MTOTAL + $value['MALE'];
                        $FTOTAL = $FTOTAL + $value['FEMALE'];
                        $TUNKNOWN = $TUNKNOWN + $value['UNKNOWN'];
                        $TTOTAL = $TTOTAL + $value['TOTAL'];

                    @endphp
                @endforeach
                <tr class="sortbottom">
                    <td>
                        <div class="style27">{{ $TTOTAL }}</div>
                    </td>
                    <td>
                        <div class="style27">{{ $TUNKNOWN }}</div>
                    </td>
                    <td>
                        <div class="style27">{{ $FTOTAL }}</div>
                    </td>
                    <td>
                        <div class="style27">{{ $MTOTAL }}</div>
                    </td>
                    <td>
                        <div class="style32"><strong>المجموع</strong></div>
                    </td>
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
