<style>
   .sortable th { border: solid 1px #777; padding: 5px; }
</style>
<div dir="ltr">

<body>

    <table width="508" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <th width="95"><div align="right">{{ $old_record['date_T'] }}</div></th>
            <th width="43">:إلى</th>
            <th width="95"><div align="right">{{ $old_record['date_F'] }}</div></th>
            <th width="275">:توزيع المواليد حسب الفئات العمرية من تاريخ</th>
        </tr>
    </table>

    <br>

 <table class="sortable"  id="anyid" width="574" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">
        <tr>
            <th bgcolor="#91B641">النسبة المئوية</th>
            <th bgcolor="#91B641">الآباء</th>
            <th bgcolor="#91B641">الفئة العمرية</th>
        </tr>
        @php $TPERCENT = 0; @endphp
        @foreach($fathers as $entry)
            @php
                $percent = ($entry['COUNTER'] / $father_count[0]['C_F']) * 100;
                $TPERCENT += $percent;
            @endphp
            <tr>
                <td align="center">{{ number_format($percent, 2) }}%</td>
                <td align="center">{{ $entry['COUNTER'] }}</td>
                <td align="center">{{ $entry['PERIOD'] }}</td>
            </tr>
        @endforeach
        <tr>
            <td align="center">{{ number_format($TPERCENT, 2) }}%</td>
            <td align="center">{{ $father_count[0]['C_F'] }}</td>
            <td align="center"><strong>المجموع</strong></td>
        </tr>
    </table>

    <br>

 <table class="sortable"  id="anyid" width="574" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">
        <tr>
            <th bgcolor="#91B641">النسبة المئوية</th>
            <th bgcolor="#91B641">الأمهات</th>
            <th bgcolor="#91B641">الفئة العمرية</th>
        </tr>
        @php $TPERCENT1 = 0; @endphp
        @foreach($mothers as $entry)
            @php
                $percent = ($entry['COUNTER'] / $mother_count[0]['C_M']) * 100;
                $TPERCENT1 += $percent;
            @endphp
            <tr>
                <td align="center">{{ number_format($percent, 2) }}%</td>
                <td align="center">{{ $entry['COUNTER'] }}</td>
                <td align="center">{{ $entry['PERIOD'] }}</td>
            </tr>
        @endforeach
        <tr>
            <td align="center">{{ number_format($TPERCENT1, 2) }}%</td>
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

