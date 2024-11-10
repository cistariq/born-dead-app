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
<div dir="ltr">

    <body class="st_body">
        <div style="width:750px; margin:0 auto;" class="text-center">

            <h3>تقارير المجلة</h3>

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

                    <th width="116" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;"><strong>العدد</strong></th>
                    <th width="104" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                        <div><strong >التشخيص الأول</strong></div>
                    </th>

                    <th width="117" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">
                        <div>التشخيص الثاني</div>
                    </th>

                    <th width="115" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;">التشخيص الثالث</th>
                    <th width="115" class="p-3 mb-2 bg-success text-white" style="border: 1px solid black;"><strong>التشخيص الرابع</strong></th>

                </tr>

                @foreach ($data as $key => $value)
                    <tr>

                        @if ($value['F'] != 'المجموع')


                            <td style= "border: 1px solid black;background:#E3FDEF" class="text-center st_td"><strong>

                                    <div>{{$value['C']}}</div>

                                </strong></td>
                            <td width="104" style= "border: 1px solid black;background:#E3FDEF" class="text-center st_td"><strong>

                                    <div>{{$value['F']}}</div>

                                </strong></td>

                            <td style= "border: 1px solid black;background:#E3FDEF" class="text-center st_td"><strong>

                                    <div>{{ $value['S'] }}</div>

                                </strong></td>

                            <td style= "border: 1px solid black;background:#E3FDEF" class="text-center st_td">
                                <div><strong>{{ $value['T'] }}</strong></div>
                            </td>
                            <td style= "border: 1px solid black;background:#E3FDEF" class="text-center st_td"><strong>
                                    <div>{{ $value['FO'] }}</div>
                                </strong></td>
                        @else
                            <td style= "border: 1px solid black;background:#E3FDEF" class="text-center st_td"><strong>

                                    <div class="summations" style="font-size:12px;">{{ $value['C'] }}
                                    </div>

                                </strong></td>

                            <td width="104" height="25"  style= "border: 1px solid black;background:#E3FDEF" class="text-center st_td"><strong>

                                    <div style="font-size:17px; font-family: 'Arabic Transparent', Andalus">
                                        {{ $value['F'] }}</div>

                                </strong></td>

                            <td  style= "border: 1px solid black;background:#E3FDEF" class="text-center st_td"><strong>

                                    <div>{{ $value['T'] }}</div>

                                </strong></td>

                            <td  style= "border: 1px solid black;background:#E3FDEF" class="text-center st_td"><strong>

                                    <div>{{ $value['S'] }}</div>

                                </strong></td>


                        @endif

                    </tr>
                @endforeach



            </table>

            <p></p>

            <p>&nbsp; </p>

            <p></p>
            <table id="result_tb" class="table table-striped dt-responsive table-row-bordered gy-5 gs-7"
                style="width:686px">

                <tr>
                    <th height="27" scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col" >
                        <div id="total_c"></div>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                var sum = 0;

                                $('.summations').each(function() {
                                      sum += Number($(this).text());

                                });
                                $('#total_c').text(sum);
                             });
                      </script>
                      </th>
                    </th>
                    <th scope="col">المجموع الكلي</th>
                </tr>
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
