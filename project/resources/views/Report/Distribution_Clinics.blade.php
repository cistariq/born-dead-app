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
                <th width="275">:توزيع المواليد حسب المركز الصحي من تاريخ</th>
            </tr>
        </table>
        <P></P>

    <table width="574" border="1" align="center" bordercolor="#999999">
        <tr>
            <td bgcolor="#91B641"><div align="center"><strong>المواليد الأحياء</strong></div></td>
        </tr>
    </table>

    <table width="574" border="1" align="center" bordercolor="#666666">
        <tr>
            <th width="116" bgcolor="#91B641">المجموع</th>
            <th width="129" bgcolor="#91B641">اناث</th>
            <th width="124" bgcolor="#91B641">ذكور</th>
            <th width="195" bgcolor="#91B641"><div align="center"><strong>المحافظة</strong></div></th>
        </tr>
    </table>

    @php
        $TTOTAL = $TMALE = $TFEMALE = 0;
    @endphp

    @foreach($borns as $entry)
        @php
            $TTOTAL += $entry['TOTAL'];
            $TMALE += $entry['MALE'];
            $TFEMALE += $entry['FEMALE'];
        @endphp

        <table class="sortable" id="anyid2" width="574" border="1" align="center" bordercolor="#666666">
            <tr>
                <td width="116" bgcolor="#91B641" align="center">{{ $entry['TOTAL'] }}</td>
                <td width="129" bgcolor="#91B641" align="center">{{ $entry['FEMALE'] }}</td>
                <td width="124" bgcolor="#91B641" align="center">{{ $entry['MALE'] }}</td>
                <td width="195" bgcolor="#91B641" align="center">{{ $entry['C_NAME'] }}</td>
            </tr>
                @php
                    $curs_D = GET_BORNS_CLINIC_D($entry['CODE'], $old_record['date_F'], $old_record['date_T']);

                @endphp
                @foreach ($curs_D as $entry_D)
                <tr>
                    <td align="center">{{ $entry_D['TOTAL'] }}</td>
                    <td align="center">{{ $entry_D['FEMALE'] }}</td>
                    <td align="center">{{ $entry_D['MALE'] }}</td>
                    <td align="center">{{ $entry_D['C_NAME'] }}</td>
                </tr>
            @endforeach
                @php
                    $stmt_without_D = GET_BORNS_CLINIC_WITHOUT_D($entry_D['CODE'], $old_record['date_F'], $old_record['date_T']);

                @endphp
                @foreach ($stmt_without_D as $without_details)
                <tr>
                    <td align="center">{{ $without_details['TOTAL'] }}</td>
                    <td align="center">{{ $without_details['FEMALE'] }}</td>
                    <td align="center">{{ $without_details['MALE'] }}</td>
                    <td align="center">{{ $without_details['C_NAME'] }}</td>
                </tr>
            @endforeach
        </table>
    @endforeach

    <table width="574" border="1" align="center" bordercolor="#666666">
        <tr>
            <td width="116" align="center">{{ $TTOTAL }}</td>
            <td width="129" align="center">{{ $TFEMALE }}</td>
            <td width="124" align="center">{{ $TMALE }}</td>
            <td width="195" align="center"><strong>المجموع</strong></td>
        </tr>
    </table>

    <br>


        <table width="602" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <th width="120">{{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</th>
                <th width="120">:تاريخ ووقت الطباعة</th>
                <th width="289">{{ $user_name }}</th>
                <th width="104">:منشئ التقرير</th>
            </tr>
        </table>



</body>
</html>
