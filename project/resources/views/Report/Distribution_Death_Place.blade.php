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

    h3 {
        text-align: center;
    }
</style>
<div dir="rtl">

    <body class="st_body">
        <div style="width:750px; margin:0 auto;" class="text-center">

            <h3>توزيع الوفيات حسب مكان الوفاة</h3>

        </div>
        <div style="width:750px; margin:0 auto;" class="text-center">

            <table id="result_tb" class="table table-striped dt-responsive table-row-bordered gy-5 gs-7"
                style="width:472px">
                @if ($old_record['Death_date_frm'] != '' || $old_record['Death_date_frm'] != '')
                    <tr>
                        <th width="50px" scope="col">من تاريخ:</th>
                        <th width="50px" scope="col">
                            {{ $old_record['Death_date_frm'] }}
                        </th>
                        <th width="50px" scope="col">إلى:</th>
                        <th width="50px" height="34" scope="col">
                            {{ $old_record['Death_date_to'] }}
                        </th>
                    </tr>
                @endif

                @if ($old_record['Diag_From'] != '' || $old_record['Diag_To'] != '')
                    <tr>
                        <th width="50px" scope="col"> من تشخيص:</th>
                        <th width="50px" scope="col">{{ $old_record['Diag_From'] }}</th>
                        <th width="50px" scope="col">إلى:</th>
                        <th width="50px" scope="col">{{ $old_record['Diag_To'] }}</th>
                    </tr>
                @endif
                @if ($old_record['Age_From'] != '' || $old_record['Age_To'] != '')
                    <tr>
                        <th scope="col">من عمر:</th>
                        <th scope="col">
                            {{ $old_record['Age_From'] }}
                        </th>
                        <th scope="col">إلى:</th>
                        <th scope="col">
                            {{ $old_record['Age_To'] }}
                        </th>
                    </tr>
                @endif
                @if ($old_record['Year_From'] != '' || $old_record['Year_To'] != '')
                    <tr>
                        <th scope="col">من السنة:</th>
                        <th scope="col">
                            {{ $old_record['Year_From'] }}
                        </th>
                        <th scope="col">إلى:</th>
                        <th scope="col">
                            {{ $old_record['Year_To'] }}
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



            <table id="result_tb" class="table table-striped dt-responsive table-row-bordered gy-5 gs-7"
                style="width:686px;" class="center">


                <tr>
                    <th width="152" style= "background:#91B641;" class="text-center st_td">مكان الوفاة</th>
                    <th style= "background:#91B641;" class="text-center st_td">ذكور</th>
                    <th style= "background:#91B641;" class="text-center st_td">اناث</th>
                    <th style= "background:#91B641;" class="text-center st_td">غير معروف</th>
                    <th style= "background:#91B641;" class="text-center st_td">المجموع</th>
                </tr>
                @php
                    $SUM_MALE = 0;
                    $SUM_FEMALE = 0;
                    $SUM_UNKNOWN = 0;
                    $SUM_TOTAL = 0;
                @endphp
                @foreach ($data as $key => $value)
                    <tr>

                        <td width="152" class="text-center st_td">{{ $value['PLACE_NAME_AR'] }}</td>

                        <td width="78" class="text-center st_td">{{ $value['MALE'] }}</td>

                        <td width="80" class="text-center st_td">{{ $value['FEMALE'] }}</td>

                        <td width="80" class="text-center st_td">{{ $value['UNKNOWN'] }}</td>

                        <td width="78" class="text-center st_td">{{ $value['TOTAL'] }}</td>

                    </tr>
                    @php

                        $SUM_MALE = $SUM_MALE + $value['MALE'];
                        $SUM_FEMALE = $SUM_FEMALE + $value['FEMALE'];
                        $SUM_UNKNOWN = $SUM_UNKNOWN + $value['UNKNOWN'];
                        $SUM_TOTAL = $SUM_TOTAL + $value['TOTAL'];
                    @endphp
                @endforeach
                <tr class="sortbottom">
                    <td style= "background:#E3FDEF" class="text-center st_td">المجموع</td>
                    <td style= "background:#E3FDEF" class="text-center st_td">{{ $SUM_MALE }}</td>
                    <td style= "background:#E3FDEF" class="text-center st_td">{{ $SUM_FEMALE }}</td>
                    <td style= "background:#E3FDEF" class="text-center st_td">{{ $SUM_UNKNOWN }}</td>
                    <td style= "background:#E3FDEF" class="text-center st_td">{{ $SUM_TOTAL }}</td>
                </tr>

            </table>
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
