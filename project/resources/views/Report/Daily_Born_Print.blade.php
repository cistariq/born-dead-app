<div dir="ltr">

    <body>

        <table width="508" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <th width="95" scope="col">
                    <div align="right"> {{ $old_record['date_T'] }} </div>
                </th>
                <th width="43" scope="col">:الى</th>
                <th width="95" scope="col">
                    <div align="right">{{ $old_record['date_F'] }}</div>
                </th>
                <th width="236" scope="col">:تقارير يومية خاصة بالمواليد من تاريخ الادخال</th>
            </tr>
        </table>
        <p></p>
        <p></p>
        <table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <th width="950" scope="col">
                    <div align="right">
                        <table width="1000" height="79" border="1" align="right" cellpadding="0"
                            cellspacing="0" bordercolor="#666666" class="sortable" id="anyid2">
                            <tr>
                                <th width="144" height="37" bgcolor="#91B641"><span class="style13">مكان
                                        الميلاد</span></th>
                                <th width="216" height="37" bgcolor="#91B641">
                                    <div align="center" class="style7">اسم الأم رباعي</div>
                                </th>
                                <th width="112" bgcolor="#91B641">
                                    <div align="center">رقم هوية الأم</div>
                                </th>
                                <th width="218" height="37" bgcolor="#91B641">
                                    <div align="center" class="style7">اسم الأب رباعي</div>
                                </th>
                                <th width="93" bgcolor="#91B641">رقم هوية الأب</th>
                                <th width="111" height="37" bgcolor="#91B641">
                                    <div align="center" class="style7">اسم المولود</div>
                                </th>
                                <th width="94" height="37" bgcolor="#91B641">
                                    <div align="center" class="style7  style11">تاريخ الميلاد</div>
                                </th>
                                <th width="98" height="37" bgcolor="#91B641">
                                    <div align="center"><span class="style13">رقم هوية المولود</span></div>
                                </th>
                                <th height="37" bgcolor="#91B641" scope="col">
                                    <div align="center" class="style20">.م</div>
                                </th>

                            </tr>
                            @php
                                $number = 1;

                            @endphp
                            @foreach ($entry_borns as $key => $value)
                                <tr>
                                    <td height="30">
                                        <div align="right"
                                            style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
                                            {{ $value['DREF_NAME_AR'] }}</div>
                                    </td>
                                    <td height="30">
                                        <div align="right"
                                            style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
                                            {{ $value['MOTHER_FULL_NAME'] }}</div>
                                    </td>
                                    <td width="112">
                                        <div align="center"
                                            style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
                                            {{ $value['MOTHER_ID'] }}</div>
                                    </td>
                                    <td width="218" height="30">
                                        <div align="right"
                                            style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
                                            {{ $value['FATHER_FULL_NAME'] }}</div>
                                    </td>
                                    <td>
                                        <div align="center"
                                            style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
                                            {{ $value['FATHER_ID'] }}</div>
                                    </td>
                                    <td height="30">
                                        <div align="center"
                                            style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
                                            {{ $value['BI_FIRST_NAME'] }}</div>
                                    </td>
                                    <td height="30">
                                        <div align="center"
                                            style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
                                            {{ $value['DELIVERY_DATE'] }}</div>
                                    </td>
                                    <td height="30">
                                        <div align="center"
                                            style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
                                            {{ $value['BI_ID'] }}</div>
                                    </td>
                                    <td height="30">
                                        <div align="center"
                                            style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
                                            {{ $key + 1 }}</div>
                                    </td>

                                </tr>


                                @php
                                    $number = $number + 1;
                                @endphp
                            @endforeach

                        </table>
                    </div>


            </tr>
        </table>

        <table width="602" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <th width="63" class="style28" scope="col">
                    <div align="right"></div> {{ $list_born[0]['C'] }}
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
