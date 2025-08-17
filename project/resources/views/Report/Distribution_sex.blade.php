<style>
   .sortable th { border: solid 1px #777; padding: 5px; }
</style>
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
                <th width="236" scope="col">:توزيع المواليد حسب المحافظات من تاريخ</th>
            </tr>
        </table>
        <p></p>
        <p></p>
<table  width="574" height="29" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#999999">
<tr>
<td width="574"  bgcolor="#91B641"><div align="center"><strong>المواليد الأحياء </strong></div></td>
</tr>
</table>
 <table class="sortable"  id="anyid" width="574" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">

        <tr>
            <th width="216" height="37" bgcolor="#91B641" >المجموع</th>
            <th width="216" height="37" bgcolor="#91B641" border="1">اناث</th>
            <th width="216" height="37" bgcolor="#91B641" border="1">ذكور</th>
            <th width="216" height="37" bgcolor="#91B641" border="1">المحافظة</th>
        </tr>
        @php $MTOTAL = 0; $FTOTAL = 0; $TTOTAL = 0; @endphp
        @foreach ($birthData as $entry)
            @php
                $MTOTAL += $entry['MALE'];
                $FTOTAL += $entry['FEMALE'];
                $TTOTAL += $entry['TOTAL'];
            @endphp
            <tr>
                <td><div align="center">{{ $entry['TOTAL'] }}</div></td>
                <td><div align="center">{{ $entry['FEMALE'] }}</div></td>
                <td><div align="center">{{ $entry['MALE'] }}</div></td>
                <td><div align="center">{{ $entry['R_NAME_AR'] }}</div></td>
            </tr>
        @endforeach
        <tr>
            <td><div align="center">{{ $TTOTAL }}</div></td>
            <td><div align="center">{{ $FTOTAL }}</div></td>
            <td><div align="center">{{ $MTOTAL }}</div></td>
            <td><div align="center"><strong>المجموع</div></strong></td>
        </tr>
    </table>
        <table width="602" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <th width="120" class="style28" scope="col">
                    <div align="right"></div> {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
                </th>
                <th width="120" class="style28" scope="col">:تاريخ ووقت الطباعة</th>
                <th width="289" height="27" class="style28" scope="col">
                    <div align="right" class="style29"> {{ $user_name }}</div>
                </th>
                <th width="104" class="style28" scope="col"><span class="style17">:منشئ التقرير</span></th>
            </tr>
        </table>
        <p></p>

</body>
</div>
