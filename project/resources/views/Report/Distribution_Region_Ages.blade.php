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

    <body calss="st_body">
        <div style="width:1000px; margin:0 auto;" class="text-center">

            <h3>توزيع الوفيات حسب الفئة العمرية والمحافظة</h3>

        </div>
        <div style="width:1000px; margin: auto;" class="text-center">

            <table id="result_tb" class="table table-striped dt-responsive table-row-bordered gy-5 gs-7"
                style="width:472px">
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
                        <th scope="col">
                            {{ $sex1 }}
                        </th>
                        <th scope="col">الجنس:</th>


                    </tr>
                @endif
                @if ($old_record['Year_From'] != '' || $old_record['Year_To'] != '')
                    <tr>
                        <th scope="col">
                            {{ $old_record['Year_To'] }}
                        </th>
                        <th scope="col">إلى:</th>

                        <th scope="col">
                            {{ $old_record['Year_From'] }}
                        </th>
                        <th scope="col">من السنة:</th>


                    </tr>
                @endif
                @if ($old_record['Age_From'] != '' || $old_record['Age_To'] != '')
                    <tr>
                        <th scope="col">
                            {{ $old_record['Age_To'] }}
                        </th>
                        <th scope="col">إلى:</th>
                        <th scope="col">
                            {{ $old_record['Age_From'] }}
                        </th>
                        <th scope="col">من عمر:</th>



                    </tr>
                @endif

                @if ($old_record['Diag_From'] != '' || $old_record['Diag_To'] != '')
                    <tr>
                        <th width="50px" scope="col">{{ $old_record['Diag_To'] }}</th>

                        <th width="50px" scope="col">إلى:</th>
                        <th width="50px" scope="col">{{ $old_record['Diag_From'] }}</th>

                        <th width="50px" scope="col"> من تشخيص:</th>

                    </tr>
                @endif

                @if ($old_record['Death_date_frm'] != '' || $old_record['Death_date_to'] != '')
                    <tr>
                        <th width="50px" height="34" scope="col">
                            {{ $old_record['Death_date_to'] }}
                        </th>
                        <th width="50px" scope="col">إلى:</th>

                        <th width="50px" scope="col">
                            {{ $old_record['Death_date_frm'] }}
                        </th>
                        <th width="50px" scope="col">من تاريخ:</th>


                    </tr>
                @endif




            </table>
            <P></P>

            <table width="928px" height="97" cellpadding="0" cellspacing="0">
                <tr>
                    <th height="31" scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;"><span
                            class="style24">14-10</span></th>
                    <th scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;"><span
                            class="style24">9-5</span></th>
                    <th scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;"><span
                            class="style24">4-1</span></th>
                    <th width="141px" scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;"><span
                            class="style24">&lt;1</span></th>
                    <th width="205px" scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;">
                        &nbsp;</th>
                </tr>
                <tr>
                    <th height="46" scope="col">
                        <table class="sortable" id="anyid4" width="220" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="205px" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>

                                <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>

                            </tr>
                            @php$age_F = 10;
                                                                                                $age_T = 15;
                                                                                    @endphp
                            @foreach ($data1 as $key => $value)
                                <tr>
                                    <td width="78px" class="text-center st_td">{{ $value['TOTAL'] }}</td>
                                    <td width="80px" class="text-center st_td">{{ $value['UNKNOWN'] }}</td>
                                    <td width="80px" class="text-center st_td">{{ $value['FEMALE'] }}</td>
                                    <td width="78px" class="text-center st_td">{{ $value['MALE'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                    <th scope="col">
                        <table class="sortable" id="anyid3" width="220" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="205px" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>

                                <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>

                            </tr>
                            <?php $age_F = 5;
                            $age_T = 10;
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
                                <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="205px" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>

                                <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>

                            </tr>
                            <?php $age_F = 1;
                            $age_T = 5;
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
                    <th colspan="2" scope="col">
                        <table class="sortable" id="anyid1" width="340" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>
                                <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>
                                <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div><strong>المحافظة</strong></div>
                                </th>

                            </tr>
                            <?php
                            $age_F = 0;
                            $age_T = 1; ?>
                            @foreach ($data as $key => $value)
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
                    <th width="220" height="20" scope="col">
                        <table width="220" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <?php
                            $age_F = 10;
                            $age_T = 15;
                            ?>
                            @foreach ($data45 as $key => $value)
                                <tr>
                                    <td width="78" class="text-center st_td">{{ $value['TOTAL'] }}</td>
                                    <td width="80" class="text-center st_td">{{ $value['UNKNOWN'] }}</td>
                                    <td width="80" class="text-center st_td">{{ $value['FEMALE'] }}</td>
                                    <td width="78" class="text-center st_td">{{ $value['MALE'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                    <th width="220" scope="col">
                        <table width="220" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <?php
                            $age_F = 5;
                            $age_T = 10;
                            ?>

                            @foreach ($data44 as $key => $value)
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
                            <?php $age_F = 1;
                            $age_T = 5;

                            ?>
                            @foreach ($data43 as $key => $value)
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
                        <table width="340" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <?php $age_F = 0;
                            $age_T = 1;

                            ?>
                            @foreach ($data4 as $key => $value)
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
            <table width="928" height="97" cellpadding="0" cellspacing="0">
                <tr>
                    <th height="31" scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;">
                        <span class="style24">34-30</span>
                    </th>
                    <th scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;"><span
                            class="style24">29-25</span></th>
                    <th scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;"><span
                            class="style24">24-20</span></th>
                    <th width="141" scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;">
                        <span class="style24">19-15</span>
                    </th>
                    <th width="205" scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;">
                        &nbsp;</th>
                </tr>
                <tr>
                    <th height="46" scope="col">
                        <table class="sortable" id="anyid5" width="220" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th width="58" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="200" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th width="37" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>

                                <th width="38" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>

                            </tr>
                            <?php $age_F = 30;
                            $age_T = 35;
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
                    <th scope="col">
                        <table class="sortable" id="anyid6" width="220" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th width="55" class="p-3 mb-2 bg-success text-white">
                                    <div>المجموع</div>
                                </th>
                                <th width="200" class="p-3 mb-2 bg-success text-white">
                                    <div>غير ذلك</div>
                                </th>
                                <th width="37" class="p-3 mb-2 bg-success text-white">
                                    <div>اناث</div>
                                </th>

                                <th width="38" class="p-3 mb-2 bg-success text-white">
                                    <div>ذكور</div>
                                </th>

                            </tr>
                            <?php $age_F = 25;
                            $age_T = 30;
                            ?>
                            @foreach ($data6 as $key => $value)
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
                        <table class="sortable" id="anyid7" width="220" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th width="58" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="200" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th width="37" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>

                                <th width="38" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>

                            </tr>
                            <?php $age_F = 20;
                            $age_T = 25;
                            ?>
                            @foreach ($data7 as $key => $value)
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
                        <table class="sortable" id="anyid8" width="340" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th width="58" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="200" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>
                                <th width="41" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>
                                <th width="146" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div><strong>المحافظة</strong></div>
                                </th>

                            </tr>
                            <?php $age_F = 15;
                            $age_T = 20;
                            ?>
                            @foreach ($data8 as $key => $value)
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
                            $age_F = 30;
                            $age_T = 35;
                            ?>
                            @foreach ($data42 as $key => $value)
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
                            $age_F = 25;
                            $age_T = 30;
                            ?>
                            @foreach ($data41 as $key => $value)
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
                            $age_F = 20;
                            $age_T = 25;
                            ?>
                            @foreach ($data40 as $key => $value)
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
                        <table width="340" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <?php
                            $age_F = 15;
                            $age_T = 20;
                            ?>
                            @foreach ($data9 as $key => $value)
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
            <table width="928" height="97" cellpadding="0" cellspacing="0">
                <tr>
                    <th height="31" scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;">
                        <span class="style24">54-50</span>
                    </th>
                    <th scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;"><span
                            class="style24">49-45</span></th>
                    <th scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;"><span
                            class="style24">44-40</span></th>
                    <th width="141" scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;">
                        <span class="style24">39-35</span>
                    </th>
                    <th width="205" scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;">
                        &nbsp;</th>
                </tr>
                <tr>
                    <th height="46" scope="col">
                        <table class="sortable" id="anyid9" width="220" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th width="58" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="220" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th width="37" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>

                                <th width="38" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>

                            </tr>
                            <?php $age_F = 50;
                            $age_T = 55;
                            ?>
                            @foreach ($data10 as $key => $value)
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
                        <table class="sortable" id="anyid10" width="220" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th width="58" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="220" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th width="37" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>

                                <th width="38" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>

                            </tr>
                            <?php $age_F = 45;
                            $age_T = 50;
                            ?>
                            @foreach ($data11 as $key => $value)
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
                        <table class="sortable" id="anyid11" width="220" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th width="58" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="220" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th width="37" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>

                                <th width="38" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>

                            </tr>
                            <?php $age_F = 40;
                            $age_T = 45;
                            ?>
                            @foreach ($data12 as $key => $value)
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
                        <table class="sortable" id="anyid12" width="340" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th width="58" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="52" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th width="35" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>
                                <th width="41" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>
                                <th width="146" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div><strong>المحافظة</strong></div>
                                </th>

                            </tr>
                            <?php $age_F = 35;
                            $age_T = 40;
                            ?>
                            @foreach ($data13 as $key => $value)
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
                            $age_F = 50;
                            $age_T = 55;
                            ?>
                            @foreach ($data39 as $key => $value)
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
                            $age_F = 45;
                            $age_T = 50;
                            ?>
                            @foreach ($data38 as $key => $value)
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
                            $age_F = 40;
                            $age_T = 45;
                            ?>
                            @foreach ($data37 as $key => $value)
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
                        <table width="340" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <?php
                            $age_F = 35;
                            $age_T = 40;
                            ?>
                            @foreach ($data14 as $key => $value)
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
            <table width="928" height="97" cellpadding="0" cellspacing="0">
                <tr>
                    <th height="31" scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;">
                        <span class="style24">74-70</span>
                    </th>
                    <th scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;"><span
                            class="style24">69-65</span></th>
                    <th scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;"><span
                            class="style24">64-60</span></th>
                    <th width="141" scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;">
                        <span class="style24">59-55</span>
                    </th>
                    <th width="205" scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;">
                        &nbsp;</th>
                </tr>
                <tr>
                    <th height="46" scope="col">
                        <table class="sortable" id="anyid13" width="220" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th width="58" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="220" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th width="37" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>

                                <th width="38" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>

                            </tr>
                            <?php $age_F = 70;
                            $age_T = 75;
                            ?>
                            @foreach ($data15 as $key => $value)
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
                        <table class="sortable" id="anyid14" width="220" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th width="58" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="220" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th width="37" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>

                                <th width="38" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>

                            </tr>
                            <?php $age_F = 65;
                            $age_T = 70; ?>
                            @foreach ($data16 as $key => $value)
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
                        <table class="sortable" id="anyid15" width="220" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th width="58" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="220" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th width="37" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>

                                <th width="38" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>

                            </tr>
                            <?php $age_F = 60;
                            $age_T = 65;
                            ?>
                            @foreach ($data17 as $key => $value)
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
                        <table class="sortable" id="anyid16" width="340" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th width="58" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="52" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th width="35" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>
                                <th width="41" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>
                                <th width="146" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div><strong>المحافظة</strong></div>
                                </th>

                            </tr>
                            <?php $age_F = 55;
                            $age_T = 60;
                            ?>
                            @foreach ($data18 as $key => $value)
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
                            $age_F = 70;
                            $age_T = 75;
                            ?>
                            @foreach ($data36 as $key => $value)
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
                    <th width="194" scope="col">
                        <table width="220" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <?php
                            $age_F = 65;
                            $age_T = 70;
                            ?>
                            @foreach ($data35 as $key => $value)
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
                            $age_F = 60;
                            $age_T = 65;
                            ?>
                            @foreach ($data34 as $key => $value)
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
                        <table width="340" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <?php
                            $age_F = 55;
                            $age_T = 60;
                            ?>
                            @foreach ($data19 as $key => $value)
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
            <table width="928" height="97" cellpadding="0" cellspacing="0">
                <tr>
                    <th height="31" scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;">
                        <span class="style24">94-90</span>
                    </th>
                    <th scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;"><span
                            class="style24">89-85</span></th>
                    <th scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;"><span
                            class="style24">84-80</span></th>
                    <th width="141" scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;">
                        <span class="style24">79-75</span>
                    </th>
                    <th width="205" scope="col" class="p-3 mb-2 bg-success text-white" style="border: none;">
                        &nbsp;</th>
                </tr>
                <tr>
                    <th height="46" scope="col">
                        <table class="sortable" id="anyid17" width="220" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th width="58" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="220" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th width="37" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>

                                <th width="38" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>

                            </tr>
                            <?php $age_F = 90;
                            $age_T = 95;
                            ?>
                            @foreach ($data20 as $key => $value)
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
                        <table class="sortable" id="anyid18" width="220" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th width="58" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="220" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th width="37" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>

                                <th width="38" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>

                            </tr>
                            <?php $age_F = 85;
                            $age_T = 90;
                            ?>
                            @foreach ($data21 as $key => $value)
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
                        <table class="sortable" id="anyid19" width="220" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th width="58" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="220" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th width="37" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>

                                <th width="38" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>

                            </tr>
                            <?php $age_F = 80;
                            $age_T = 85;
                            ?>
                            @foreach ($data22 as $key => $value)
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
                        <table class="sortable" id="anyid20" width="340" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <tr>
                                <th width="58" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="52" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th width="35" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>
                                <th width="41" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>
                                <th width="146" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div><strong>المحافظة</strong></div>
                                </th>

                            </tr>
                            <?php $age_F = 75;
                            $age_T = 80;
                            ?>
                            @foreach ($data23 as $key => $value)
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
                            $age_F = 90;
                            $age_T = 95;
                            ?>
                            @foreach ($data33 as $key => $value)
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
                            $age_F = 85;
                            $age_T = 90;
                            ?>
                            @foreach ($data32 as $key => $value)
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
                            $age_F = 80;
                            $age_T = 85;
                            ?>
                            @foreach ($data31 as $key => $value)
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
                        <table width="340" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <?php
                            $age_F = 75;
                            $age_T = 80;
                            ?>
                            @foreach ($data24 as $key => $value)
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
            <table width="540px" height="97" cellpadding="0" cellspacing="0" class="text-center st_td">
                <tr>
                    <th height="31" scope="col" style="border: none;"
                        class="p-3 mb-2 bg-success text-white">المجموع</th>
                    <th width="141" scope="col" style="border: none;"
                        class="p-3 mb-2 bg-success text-white"><span class="style24">&gt;95</span></th>
                    <th width="205" scope="col" style="border: none;"
                        class="p-3 mb-2 bg-success text-white">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" scope="col">
                        <table class="text-center st_td" id="anyid23" width="220px" cellpadding="0"
                            cellspacing="0" bordercolor="#666666">
                            <tr>
                                <th width="58" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th width="220" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th width="37" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>

                                <th width="38" class="p-3 mb-2 bg-success text-white"
                                    style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>

                            </tr>
                            <?php $age_F = 0;
                            $age_T = 1500;
                            ?>
                            @foreach ($data25 as $key => $value)
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
                        <table class="text-center st_td" id="anyid24" width="340px" cellpadding="0"
                            cellspacing="0" bordercolor="#666666">
                            <tr>
                                <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>المجموع</div>
                                </th>
                                <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>غير ذلك</div>
                                </th>
                                <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>اناث</div>
                                </th>
                                <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div>ذكور</div>
                                </th>
                                <th class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                                    <div><strong>المحافظة</strong></div>
                                </th>

                            </tr>
                            <?php $age_F = 95;
                            $age_T = 1500;
                            ?>
                            @foreach ($data26 as $key => $value)
                                <tr>
                                    <td class="text-center st_td">{{ $value['TOTAL'] }}</td>
                                    <td class="text-center st_td">{{ $value['UNKNOWN'] }}</td>
                                    <td class="text-center st_td">{{ $value['FEMALE'] }}</td>
                                    <td class="text-center st_td">{{ $value['MALE'] }}</td>
                                    <td class="text-center st_td">{{ $value['R_NAME_AR'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
                <tr>
                    <th height="20" scope="col">
                        <table width="220px" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <?php
                            $age_F = 0;
                            $age_T = 1500;
                            ?>
                            @foreach ($data30 as $key => $value)
                                <tr>
                                    <td class="text-center st_td">{{ $value['TOTAL'] }}</td>
                                    <td class="text-center st_td">{{ $value['UNKNOWN'] }}</td>
                                    <td class="text-center st_td">{{ $value['FEMALE'] }}</td>
                                    <td class="text-center st_td">{{ $value['MALE'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                    <th colspan="2" scope="col">
                        <table width="340px" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <?php
                            $age_F = 95;
                            $age_T = 300;
                            ?>
                            @foreach ($data29 as $key => $value)
                                <tr>
                                    <td class="text-center st_td">{{ $value['TOTAL'] }}</td>
                                    <td class="text-center st_td">{{ $value['UNKNOWN'] }}</td>
                                    <td class="text-center st_td">{{ $value['FEMALE'] }}</td>
                                    <td class="text-center st_td">{{ $value['MALE'] }}</td>
                                    <td>
                                        <div><strong>المجموع</strong></div>
                                    </td>

                                </tr>
                            @endforeach


                        </table>
                    </th>
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
