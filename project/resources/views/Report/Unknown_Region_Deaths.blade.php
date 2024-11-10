<style>
    h3,th {
        text-align: center;
    }
</style>
<div class="card mb-7" dir="ltr">
    <!--begin::Card body-->
    <div class="card-body">
        <div class="table-responsive">
            <h3>تقرير بأسماء الوفيات بمكان سكن غير معروف</h3>


            <table id="result_tb" class="table table-striped dt-responsive table-row-bordered gy-5 gs-7"
                style="width:472px">
                @if ($old_record['Death_date_frm'] != '' || $old_record['Death_date_frm'] != '')
                    <tr>
                        <th width="50px" scope="col">إلى:</th>
                        <th width="50px" height="34" scope="col">
                            {{ $old_record['Death_date_to'] }}
                        </th>
                        <th width="50px" scope="col">من تاريخ:</th>
                        <th width="50px" scope="col">
                            {{ $old_record['Death_date_frm'] }}
                        </th>

                    </tr>
                @endif

                @if ($old_record['Diag_From'] != '' || $old_record['Diag_To'] != '')
                    <tr>
                        <th width="50px" scope="col">إلى:</th>
                        <th width="50px" scope="col">{{ $old_record['Diag_To'] }}</th>
                        <th width="50px" scope="col"> من تشخيص:</th>
                        <th width="50px" scope="col">{{ $old_record['Diag_From'] }}</th>

                    </tr>
                @endif
                @if ($old_record['Age_From'] != '' || $old_record['Age_To'] != '')
                    <tr>
                        <th scope="col">إلى:</th>
                        <th scope="col">
                            {{ $old_record['Age_To'] }}
                        </th>
                        <th scope="col">من عمر:</th>
                        <th scope="col">
                            {{ $old_record['Age_From'] }}
                        </th>

                    </tr>
                @endif
                @if ($old_record['Year_From'] != '' || $old_record['Year_To'] != '')
                    <tr>
                        <th scope="col">إلى:</th>
                        <th scope="col">
                            {{ $old_record['Year_To'] }}
                        </th>
                        <th scope="col">من السنة:</th>
                        <th scope="col">
                            {{ $old_record['Year_From'] }}
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

                        <th width="144" height="37" bgcolor="#91B641"><div align="center" class="style7">العملية</div></th>
                        <th width="250" height="37" bgcolor="#91B641"><div align="center" class="style7">اسم المتوفى رباعي</div></th>
                        <th width="112" bgcolor="#91B641"><div align="center">تاريخ الوفاة</div></th>
                        <th width="218" height="37" bgcolor="#91B641"><div align="center" class="style7">تاريخ الميلاد</div></th>
                        <th width="93" bgcolor="#91B641">هوية المتوفى</th>
                        <th height="37" bgcolor="#91B641">
                            <div align="center" class="style7">.م</div>
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

<script>
    GET_Unknown_Region_Deaths();

    function GET_Unknown_Region_Deaths() {

        var url = "{{ route('Report.GET_Unknown_Region_Deaths_ALL') }}";
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
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),


                },
            },
            initComplete: function(data) {
                console.log(data);
            },
            columnDefs: [
            { targets: '_all', className: 'dt-center' }
            ],

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


    function update_crt_dead(P_DEAD_ID) {
    var url = "{{ route('dead.getDeadInfoById') }}";

    $.ajax({
        url: url,
        method: 'post',
        data: {
            P_DEAD_ID: P_DEAD_ID
        },
    }).done(function(response) {
        console.log(response);
        if (response.success != true) {
            Swal.fire({
                title: 'يوجد خطأ في عملية الإدخال !',
                text: $message,
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        } else {

            Swal.fire({
                title: "هل تريد بالفعل تعديل إشعار الوفاة",
                showDenyButton: true,
                confirmButtonText: "موافق",
                denyButtonText: `إلغاء`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var red_url = '{{ route('dead.update_dead', ':P_DEAD_NUMBER') }}';
                    red_url = red_url.replace(':P_DEAD_NUMBER', response.results[0]['DEAD_CODE']);
                    window.open(red_url, true);
                }
            });
        }
    });

}
</script>
