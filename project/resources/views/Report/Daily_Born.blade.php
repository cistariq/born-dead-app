<style>
    h3 {
        text-align: center;
    }
</style>
<div class="card mb-7" dir="ltr">
    <!--begin::Card body-->
    <div class="card-body">
        <div class="table-responsive">
            <h3>تقارير يومية خاصة بالمواليد من تاريخ الادخال</h3>

            <div class="d-flex align-items-center">


                <label class="control-label col-md-1">عدد السجلات</label>
                <div class="position-relative w-md-300px me-md-1">

                    <div class="row mb-4">
                        <div class="col-lg-3">
                            <input type="text" id="out_records_num" class="form-control text-center"
                                name="out_records_num" readonly="readonly" />
                        </div>
                    </div>
                </div>

            </div>
            <!--begin::datatable-->
            <table id="result_tbs" class="table table-striped dt-responsive table-row-bordered gy-5 gs-7"
                style="width:100%">
                <thead>
                    <tr>
                        <th width="144" height="37" bgcolor="#91B641"><span class="style13">مكان
                                الميلاد</span></th>
                        <th width="216" height="37" bgcolor="#91B641">
                            <div align="center" class="style7">اسم الأم رباعي</div>
                        </th>
                        <th width="112" bgcolor="#91B641">
                            <div align="center">هوية الأم</div>
                        </th>
                        <th width="218" height="37" bgcolor="#91B641">
                            <div align="center" class="style7">اسم الأب رباعي</div>
                        </th>
                        <th width="93" bgcolor="#91B641">هوية الأب</th>
                        <th width="111" height="37" bgcolor="#91B641">
                            <div align="center" class="style7">اسم المولود</div>
                        </th>
                        <th width="94" height="37" bgcolor="#91B641">
                            <div align="center" class="style7  style11">تاريخ الميلاد</div>
                        </th>
                        <th width="98" height="37" bgcolor="#91B641">
                            <div align="center"><span class="style13">هوية المولود</span></div>
                        </th>
                        <th height="37" bgcolor="#91B641" scope="col">
                            <div align="center" class="style20">.م</div>
                        </th>

                    </tr>
                </thead>
                <tbody>
                </tbody>

            </table>
        </div>
        <!--end::datatable-->
    </div>
    <!--end::Compact form-->
</div>


{{-- <div dir="ltr">

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
        <p></p>

        <table width="602" border="0" align="center" cellpadding="0" cellspacing="0">

        <tr>
            <td width="260" height="7" scope="col">
                <a href="#" onclick="get_prev();"> <strong> السابق</strong></a>
            </td>
            <td width="260" height="7" scope="col">

            </td>
            <td width="260" height="7" scope="col">
                <a href="#" onclick="get_next();"> <strong> التالي</strong></a>
            </td>

        </tr>
    </table>
    <p></p>

        <table width="602" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <th width="63" class="style28" scope="col"><a href="#" onclick="Daily_Born_Print();">عرض الكل</a></th>
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
</div> --}}

<script>
    get_born_data();

    function get_born_data() {


        var date_F = $('#Birth_date_frm').val();
        var date_T = $('#Birth_date_to').val();

        var url = "{{ route('Report.get_Daily_Born') }}";
        console.log(11);
        $("#result_tbs").DataTable({
            dom: 'Bfrtip',
            buttons: [  {
                        extend: 'excelHtml5',
                        title: 'Excel',
                        text:'Excel'

                    },{
                        extend: 'pdfHtml5',
                        title: 'Daily_Born',
                        text: 'PDF',
                    } ],
            serverSide: true,
            paging: true,
            ordering: false,
            destroy: true,
            ajax: {
                url: url,
                method: 'POST',
                data: {
                    date_F: date_F,
                    date_T: date_T,


                },
            },
            initComplete: function(data) {
                console.log(data);
            },

            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "لايوجد بيانات في الجدول للعرض",
                "info": "عرض _START_ الى  _END_ من _TOTAL_ سجلات",
                "infoEmpty": "No records found",
                "infoFiltered": "(filtered1 from _MAX_ total records)",
                "lengthMenu": "عرض _MENU_",
                "search": "بحث:",
                "zeroRecords": "No matching records found",

            },
            lengthMenu: [
                [10, 25, 50, -1],
                ['10', '25', '50', 'All']
            ],

            "searching": true,
            'paging': true,

            "infoCallback": function(settings, start, end, max, total, pre) {
                $('#out_records_num').val(total);

                return "عرض _" + start + "_ الى  _" + end + "_ من _" + total + "_ سجلات";
            }


        });
    }
</script>
