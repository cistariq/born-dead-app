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
                <th width="275">توزيع تفصيلي للمواليد حسب المحافظات من تاريخ</th>
            </tr>
        </table>
        <P></P>

        <table width="692" height="29" border="1" align="center" cellpadding="0" cellspacing="0"
            bordercolor="#999999">
            <tr>
                <td width="574" bgcolor="#91B641">
                    <div align="center"><strong>المواليد الأحياء </strong></div>
                </td>
            </tr>
        </table>
        <p></p>

        <table class="sortable" width="692" border="1" align="center" cellpadding="0" cellspacing="0"
            bordercolor="#666666">
            <tr>
                <th width="116" bgcolor="#91B641">المجموع %</th>
                <th width="116" bgcolor="#91B641">المجموع</th>
                <th width="129" bgcolor="#91B641">اناث</th>
                <th width="124" bgcolor="#91B641">ذكور</th>
                <th width="195" bgcolor="#91B641">
                    <div align="center"><strong>المحافظة</strong></div>
                </th>
            </tr>
        </table>
        <p></p>
        @php
            $totalAll = 0;
            $totalMale = 0;
            $totalFemale = 0;
        @endphp

        @foreach ($borns as $item)
            @php
                $totalAll += $item['TOTAL'];

                $totalMale += $item['MALE'];
                $totalFemale += $item['FEMALE'];
            @endphp
        @endforeach

        @foreach ($borns as $item)
            @php

                $percentage = ($item['TOTAL'] / $totalAll) * 100;
            @endphp

            <table class="sortable" id="anyid2" width="692" border="1" align="center" cellpadding="0"
                cellspacing="0" bordercolor="#666666">
                <tr>

                    <th width="116" bgcolor="#91B641" class="unsortable">
                        <div align="center">{{ number_format($percentage, 2) }}%</div>
                    </th>
                    <th width="116" bgcolor="#91B641" class="unsortable">
                        <div align="center">{{ $item['TOTAL'] }}</div>
                    </th>
                    <th width="129" bgcolor="#91B641" class="unsortable">
                        <div align="center">{{ $item['FEMALE'] }}</div>
                    </th>
                    <th width="124" bgcolor="#91B641" class="unsortable">
                        <div align="center">{{ $item['MALE'] }}</div>
                    </th>
                    <th width="195" bgcolor="#91B641">
                        <div align="center">{{ $item['C_NAME'] }}</div>
                    </th>

                </tr>
                @php
                    $curs_D = GET_BORNS_CLINIC_CD($item['CODE'], $old_record['date_F'], $old_record['date_T']);

                @endphp
                @foreach ($curs_D as $entry_D)
                    <tr>
                        <td width="116">
                            <div align="center">
                                {{ number_format(($entry_D['TOTAL'] / $item['TOTAL']) * 100, 2, '.', '') }}%
                            </div>
                        </td>
                        <td width="116">
                            <div align="center">{{ $entry_D['TOTAL'] }}</div>
                        </td>
                        <td width="129">
                            <div align="center">{{ $entry_D['FEMALE'] }}</div>
                        </td>
                        <td width="124">
                            <div align="center">{{ $entry_D['MALE'] }}</div>
                        </td>
                        <td width="195">
                            <div align="center">{{ $entry_D['C_NAME'] }}</div>
                        </td>

                    </tr>
                @endforeach

                {{-- هنا تكرار لكل عيادة داخل المحافظة إن لزم --}}
        @endforeach
        </table>


        <table width="692" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">

            <tr>
                <td width="116">&nbsp;</td>
                <td width="116">
                    <div align="center"><strong>{{ $totalAll }}</strong></div>
                </td>
                <td width="129">
                    <div align="center"><strong>{{ $totalFemale }}</strong></div>
                </td>
                <td width="124">
                    <div align="center"><strong>{{ $totalMale }}</strong></div>
                </td>
                <td width="195">
                    <div align="center"><strong>المجموع</strong></div>
                </td>

            </tr>
        </table>

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
