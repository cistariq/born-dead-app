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
                <th width="275">:توزيع المواليد حسب الجنس من تاريخ</th>
            </tr>
        </table>

        <br>

    <table class="sortable" width="456" border="1" align="center">
        <tr>
            <th bgcolor="#91B641">النسبة المئوية</th>
            <th bgcolor="#91B641">العدد</th>
            <th bgcolor="#91B641">الجنس</th>
        </tr>
        <tr>
            <td align="center">{{ number_format(($born_sex_only[0]['MALE'] / $born_sex_only[0]['TOTAL']) * 100, 2) }}%</td>
            <td align="center">{{ $born_sex_only[0]['MALE'] }}</td>
            <td align="center" class="style21">الذكور</td>
        </tr>
        <tr>
            <td align="center">{{ number_format(($born_sex_only[0]['FEMALE'] / $born_sex_only[0]['TOTAL']) * 100, 2) }}%</td>
            <td align="center">{{ $born_sex_only[0]['FEMALE'] }}</td>
            <td align="center" class="style21">الاناث</td>
        </tr>
        <tr class="sortbottom">
            <td align="center">100%</td>
            <td align="center">{{ $born_sex_only[0]['TOTAL'] }}</td>
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
