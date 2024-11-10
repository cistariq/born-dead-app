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

            <h3>توزيع الوفيات حسب الفئات العمرية والمرض</h3>

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

            <table width="492" height="97" cellpadding="0" cellspacing="0">
                @foreach ($data as $key => $value)
                @php
                $ICD_CODE=$value['ICD_CODE'];
                @endphp
                    <tr>
                        <th height="31" scope="col"><span class="style24">
                                <div>{{ $value['ICD_CD'] . ' - ' . $value['ICD_NAME_EN'] }}</div>
                            </span></th>
                    </tr>
                    <tr>
                        <th height="46" scope="col">
                            <table class="sortable" height="87" id="anyid1" width="492" cellpadding="0"
                                cellspacing="0" bordercolor="#666666">
                                <tr>
                                    <th width="60" height="30">
                                        <div>المجموع</div>
                                    </th>
                                    <th width="82">
                                        <div>غير معروف</div>
                                    </th>
                                    <th width="62">
                                        <div>أنثى</div>
                                    </th>
                                    <th width="78">
                                        <div>ذكر</div>
                                    </th>
                                    <th width="198">
                                        <div><strong>الفئات العمرية</strong></div>
                                    </th>
                                </tr>
                                <@php
                                ini_set('max_execution_time', -1);
                                ini_set('memory_limit',-1);
                                    $old_record['V_ICD_CODE'] = $ICD_CODE;
                                    $result['data1'] = \App\Models\DEADS_TB::GET_DEADS_ICD($old_record);

                                @endphp @foreach ($result['data1'] as $key => $value1)
                                    <tr>
                                        <td>
                                            <div>{{ $value1['TOTAL'] }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $value1['UNKNOWN'] }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $value1['FEMALE'] }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $value1['MALE'] }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $value1['AB'] }}</div>
                                        </td>

                                    </tr>
                                @endforeach

            </table>
            </th>
            </tr>

            <tr>
                <th height="20" scope="col">
                    <table width="492" cellpadding="0" cellspacing="0" bordercolor="#666666">
                        <@php
                        ini_set('max_execution_time', -1);
                        ini_set('memory_limit',-1);
                            $old_record['V_ICD_CODE'] = $ICD_CODE;
                            $result['data2'] = \App\Models\DEADS_TB::GET_DEADS_REGION_TOTAL2($old_record);
                           // dd($result['data2']);
                        @endphp @foreach ($result['data2'] as $key => $value2)
                            <tr>
                                <td width="60">
                                    <div>{{ $value2['TOTAL'] }}</div>
                                </td>
                                <td width="82">
                                    <div>{{ $value2['UNKNOWN'] }}</div>
                                </td>
                                <td width="62">
                                    <div>{{ $value2['FEMALE'] }}</div>
                                </td>
                                <td width="78">
                                    <div>{{ $value2['MALE'] }}</div>
                                </td>
                                <td width="198">
                                    <div><strong>المجموع</strong></div>
                                </td>
                            </tr>
                            @endforeach

                    </table>
                </th>
            </tr>
            @endforeach
            </table>

            <p>&nbsp;</p>
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
