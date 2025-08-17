<style>
    .sortable th {
        border: solid 1px #777;
        padding: 5px;
    }
</style>
<div dir="ltr">

    <body>

        <table width="508" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <th width="95">
                    <div align="right">{{ $old_record['date_T'] }}</div>
                </th>
                <th width="43">:إلى</th>
                <th width="95">
                    <div align="right">{{ $old_record['date_F'] }}</div>
                </th>
                <th width="275">:توزيع المواليد حسب الوزن من تاريخ</th>
            </tr>
        </table>
        <P></P>

        <table width="443" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">

            <tr>
                <th width="116" bgcolor="#91B641">النسبة المئوية</th>

                <th width="124" bgcolor="#91B641">العدد</th>
                <th width="195" bgcolor="#91B641">
                    <div align="center"><strong>أوزان المواليد</strong></div>
                </th>
        </table>
        <P></P>

        @foreach ($clinic_m as $clinic)
           <p></p>

            <table class="sortable" id="anyid2" width="443" border="1" align="center" cellpadding="0"
                cellspacing="0" bordercolor="#666666">

                <tr>
                    <th colspan="3" bgcolor="#91B641" class="unsortable">
                        <div align="right">{{ $clinic['C_NAME'] }}</div>
                    </th>
                </tr>
                @php
                    $curs_D = GET_BORNS_WEIGHT($clinic['CODE'], $old_record['date_F'], $old_record['date_T']);

                @endphp
                @foreach ($curs_D as $entry_D)
                    @php $total = $entry_D['TOTAL'] ?? 0; @endphp
                    <tr>
                        <td align="center">{{ number_format(($entry_D['FIRSTC'] / $total) * 100, 2) }}%</td>
                        <td align="center">{{ $entry_D['FIRSTC'] }}</td>
                        <td align="center">
                            < 1500</td>
                    </tr>
                    <tr>
                        <td align="center">{{ number_format(($entry_D['SECONDC'] / $total) * 100, 2) }}%</td>
                        <td align="center">{{ $entry_D['SECONDC'] }}</td>
                        <td align="center">1500 - 2000</td>
                    </tr>
                    <tr>
                        <td align="center">{{ number_format(($entry_D['THIRDC'] / $total) * 100, 2) }}%</td>
                        <td align="center">{{ $entry_D['THIRDC'] }}</td>
                        <td align="center">2001 - 2500</td>
                    </tr>
                    <tr>
                        <td align="center">{{ number_format(($entry_D['FOURTHC'] / $total) * 100, 2) }}%</td>
                        <td align="center">{{ $entry_D['FOURTHC'] }}</td>
                        <td align="center">> 2500</td>
                    </tr>
                    <tr>
                        <td align="center"></td>
                        <td align="center">{{ $total }}</td>
                        <td align="center"><strong>المجموع</strong></td>
                    </tr>
                @endforeach

            </table>
        @endforeach

        <table width="602" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <th width="120">{{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</th>
                <th width="120">:تاريخ ووقت الطباعة</th>
                <th width="289">{{ $user_name }}</th>
                <th width="104">:منشئ التقرير</th>
            </tr>
        </table>
    </body>
</div>
