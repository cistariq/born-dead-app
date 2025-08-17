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
                <th width="275">:توزيع المواليد حسب المهنة من تاريخ</th>
            </tr>
        </table>

        <br>

    <table class="sortable" width="434" border="1" align="center">
        <tr>
            <th bgcolor="#91B641">النسبة المئوية</th>
            <th bgcolor="#91B641">الآباء</th>
            <th bgcolor="#91B641">المهنة</th>
        </tr>
        @php $tPercentF = 0; @endphp
        @foreach($fathers as $entry)
            @php
                $percent = $father_count[0]['C_F'] > 0 ? ($entry['COUNTER'] / $father_count[0]['C_F']) * 100 : 0;
                $tPercentF += $percent;
            @endphp
            <tr>
                <td align="center">{{ number_format($percent,2) }}%</td>
                <td align="center">{{ $entry['COUNTER'] }}</td>
                <td align="center">{{ $entry['JOB_NAME_AR'] }}</td>
            </tr>
        @endforeach
        <tr class="sortbottom">
            <td align="center">{{ number_format($tPercentF,2) }}%</td>
            <td align="center">{{ $father_count[0]['C_F'] }}</td>
            <td align="center"><strong>المجموع</strong></td>
        </tr>
    </table>

    <br>

    <table class="sortable" width="434" border="1" align="center">
        <tr>
            <th bgcolor="#91B641">النسبة المئوية</th>
            <th bgcolor="#91B641">الأمهات</th>
            <th bgcolor="#91B641">المهنة</th>
        </tr>
        @php $tPercentM = 0; @endphp
        @foreach($mothers as $entry)
            @php
                $percent = $mother_count[0]['C_M'] > 0 ? ($entry['COUNTER'] / $mother_count[0]['C_M']) * 100 : 0;
                $tPercentM += $percent;
            @endphp
            <tr>
                <td align="center">{{ number_format($percent,2) }}%</td>
                <td align="center">{{ $entry['COUNTER'] }}</td>
                <td align="center">{{ $entry['JOB_NAME_AR'] }}</td>
            </tr>
        @endforeach
        <tr class="sortbottom">
            <td align="center">{{ number_format($tPercentM,2) }}%</td>
            <td align="center">{{ $mother_count[0]['C_M'] }}</td>
            <td align="center"><strong>المجموع</strong></td>
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
</div>
