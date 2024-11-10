<html>
<style>
    .st_body {
        font-family: "Times New Roman", Times, sans-serif;

        padding-top: 1px;
        padding-bottom: 1px;

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

            <h3>توزيع الوفيات حسب العمر، الجنس والمحافظة</h3>

        </div>
        <div style="width:1000px; margin: auto;" class="text-center">
            <table width="614" cellpadding="0" cellspacing="0">
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

            <table width="928" height="97" cellpadding="0" cellspacing="0">
                <tr>
                    <th height="31" scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;">المجموع</th>
                    <th scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;"><span class="style24">364-28</span></th>
                    <th scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;"><span class="style24">27-7</span></th>
                    <th width="141" scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;"><span class="style24">6-0</span></th>
                    <th width="205" scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" scope="col">
                        <table class="sortable" id="anyid4" width="220" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th width="55" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="200" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th width="37" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>
                                <th width="38" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>
                            </tr>
                            <?php $age_F = 0;
                            $age_T = 365;
                            ?>
                            @foreach ($data as $key => $value)
                                <tr>
                                    <td width="78" class="text-center st_td">{{ $value['TOTAL'] }}</td>
                                    <td width="80" class="text-center st_td">{{ $value['UNKNOWN'] }}</td>
                                    <td width="80" class="text-center st_td">{{ $value['FEMALE'] }}</td>
                                    <td width="78" class="text-center st_td">{{ $value['MALE'] }}</td>
                                </tr>
                            @endforeach

                        </table>
                    </th>
                    <th scope="col">
                        <table class="sortable" id="anyid3" width="220" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th width="55" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="200" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th width="37" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>
                                <th width="38" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>
                            </tr>
                            <?php $age_F = 28;
                            $age_T = 365;
                            ?>
                            @foreach ($data2 as $key => $value)
                                <tr>
                                    <td width="78" class="text-center st_td">{{ $value['TOTAL'] }}</td>
                                    <td width="80" class="text-center st_td">{{ $value['UNKNOWN'] }}</td>
                                    <td width="80" class="text-center st_td">{{ $value['FEMALE'] }}</td>
                                    <td width="78" class="text-center st_td">{{ $value['MALE'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                    <th scope="col">
                        <table class="sortable" id="anyid2" width="220" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th width="55" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="200" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th width="37" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>
                                <th width="38" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>
                            </tr>
                            <?php $age_F = 7;
                            $age_T = 28;
                            ?>
                            @foreach ($data4 as $key => $value)
                                <tr>
                                    <td width="78" class="text-center st_td">{{ $value['TOTAL'] }}</td>
                                    <td width="80" class="text-center st_td">{{ $value['UNKNOWN'] }}</td>
                                    <td width="80" class="text-center st_td">{{ $value['FEMALE'] }}</td>
                                    <td width="78" class="text-center st_td">{{ $value['MALE'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                    <th colspan="2" scope="col">
                        <table class="sortable" id="anyid1" width="344" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th width="52" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="58" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th width="35" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>
                                <th width="41" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>
                                <th width="146" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div><strong>المحافظة</strong></div>
                                </th>
                            </tr>
                            <?php
                            $age_F = 0;
                            $age_T = 7;
                            ?>
                            @foreach ($data6 as $key => $value)
                                <tr>
                                    <td width="78" class="text-center st_td">{{ $value['TOTAL'] }}</td>
                                    <td width="80" class="text-center st_td">{{ $value['UNKNOWN'] }}</td>
                                    <td width="80" class="text-center st_td">{{ $value['FEMALE'] }}</td>
                                    <td width="78" class="text-center st_td">{{ $value['MALE'] }}</td>
                                    <td width="152" class="text-center st_td">{{ $value['R_NAME_AR'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>

                <tr>
                    <th width="194" height="20" scope="col">
                        <table width="220" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <?php
                            $age_F = 0;
                            $age_T = 365;
                            ?>
                            @foreach ($data1 as $key => $value)
                                <tr>
                                    <td width="78" class="text-center st_td">{{ $value['TOTAL'] }}</td>
                                    <td width="80" class="text-center st_td">{{ $value['UNKNOWN'] }}</td>
                                    <td width="80" class="text-center st_td">{{ $value['FEMALE'] }}</td>
                                    <td width="78" class="text-center st_td">{{ $value['MALE'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                    <th width="194" scope="col">
                        <table width="220" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <?php
                            $age_F = 28;
                            $age_T = 365;
                            ?>
                            @foreach ($data3 as $key => $value)
                                <tr>
                                    <td width="78" class="text-center st_td">{{ $value['TOTAL'] }}</td>
                                    <td width="80" class="text-center st_td">{{ $value['UNKNOWN'] }}</td>
                                    <td width="80" class="text-center st_td">{{ $value['FEMALE'] }}</td>
                                    <td width="78" class="text-center st_td">{{ $value['MALE'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                    <th width="194" scope="col">
                        <table width="220" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <?php $age_F = 7;
                            $age_T = 28;

                            ?>
                            @foreach ($data5 as $key => $value)
                                <tr>
                                    <td width="78" class="text-center st_td">{{ $value['TOTAL'] }}</td>
                                    <td width="80" class="text-center st_td">{{ $value['UNKNOWN'] }}</td>
                                    <td width="80" class="text-center st_td">{{ $value['FEMALE'] }}</td>
                                    <td width="78" class="text-center st_td">{{ $value['MALE'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                    <th colspan="2" scope="col">
                        <table width="344" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <?php $age_F = 0;
                            $age_T = 7;

                            ?>
                            @foreach ($data7 as $key => $value)
                                <tr>
                                    <td width="78" class="text-center st_td">{{ $value['TOTAL'] }}</td>
                                    <td width="80" class="text-center st_td">{{ $value['UNKNOWN'] }}</td>
                                    <td width="80" class="text-center st_td">{{ $value['FEMALE'] }}</td>
                                    <td width="78" class="text-center st_td">{{ $value['MALE'] }}</td>
                                    <td width="146">
                                        <div><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p></p>
            <p></p>
            <p></p>
            <table id="result_tb" class="table table-striped dt-responsive table-row-bordered gy-5 gs-7"
                style="width:686px">
                <tr>
                    <th width="280" scope="col">
                        <div><strong>
                                تاريخ ووقت الطباعة:
                            </strong>
                    </th>
                    <th width="280" scope="col">
                        <div><strong>
                                {{ date('d/m/Y H:i', time()) }}

                        </div></strong>
                    </th>
                    <th width="150" class="style22" scope="col">
                        <div><strong>
                                منشئ التقرير:
                            </strong>
                        </div>
                    </th>
                    <th width="177" height="27" scope="col">
                        <div><strong>
                                {{ $user_name }}
                        </div></strong>
                    </th>
                </tr>

            </table>
            <p></p>
            <p></p>
        </div>
    </body>
</div>

</html>
