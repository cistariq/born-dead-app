@extends('layouts.main')
@section('title', 'حالات الوفاة الممسوحة ضوئيا لكل مستخدم')

@section('content')
    <style>
        td {
            font-family: "Times New Roman", Times, sans-serif;

            padding-top: 1px;
            padding-bottom: 1px;
            border: solid black;
            border-width: thin;
            text-align: center;
        }
    </style>


<div class="card  mb-7">
    <!--begin::Card body-->
    <div class="card-body">

        <table id="result_tb" class="table table-striped dt-responsive table-row-bordered gy-5 gs-7" style="width:472px">
            @if ($old_record['Death_date_frm'] != '' || $old_record['Death_date_frm'] != '')
                <tr>
                    <th width="50px" scope="col">من تاريخ:</th>
                    <th width="50px" scope="col">
                        {{ $old_record['Death_date_frm'] }}
                    </th>

                    <th width="50px" scope="col">إلى:</th>
                    <th width="50px" height="34" scope="col">
                        {{ $old_record['Death_date_to'] }}
                    </th>

                </tr>
            @endif

            @if ($old_record['Diag_From'] != '' || $old_record['Diag_To'] != '')
                <tr>
                    <th width="50px" scope="col"> من تشخيص:</th>
                    <th width="50px" scope="col">{{ $old_record['Diag_From'] }}</th>

                    <th width="50px" scope="col">إلى:</th>
                    <th width="50px" scope="col">{{ $old_record['Diag_To'] }}</th>

                </tr>
            @endif
            @if ($old_record['Age_From'] != '' || $old_record['Age_To'] != '')
                <tr>
                    <th scope="col">من عمر:</th>
                    <th scope="col">
                        {{ $old_record['Age_From'] }}
                    </th>

                    <th scope="col">إلى:</th>
                    <th scope="col">
                        {{ $old_record['Age_To'] }}
                    </th>

                </tr>
            @endif
            @if ($old_record['Year_From'] != '' || $old_record['Year_To'] != '')
                <tr>
                    <th scope="col">من السنة:</th>
                    <th scope="col">
                        {{ $old_record['Year_From'] }}
                    </th>

                    <th scope="col">إلى:</th>
                    <th scope="col">
                        {{ $old_record['Year_To'] }}
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
    </div>
</div>
    <form action="#" id="dead_form">
        <input type="hidden" id="d_from" name="d_from" value="{{ $old_record['Death_date_frm'] }}" />
        <input type="hidden" id="d_to" name="d_to" value=" {{ $old_record['Death_date_to'] }}" />

        <input type="hidden" id="dia_from" name="dia_from" value="{{ $old_record['Diag_From'] }}" />
        <input type="hidden" id="dia_to" name="dia_to" value="{{ $old_record['Diag_To'] }}" />

        <input type="hidden" id="age_From" name="age_From" value="{{ $old_record['Age_From'] }}" />
        <input type="hidden" id="age_To" name="age_To" value="{{ $old_record['Age_To'] }}" />

        <input type="hidden" id="y_from" name="y_from" value="{{ $old_record['Year_From'] }}" />
        <input type="hidden" id="y_to" name="y_to" value=" {{ $old_record['Year_To'] }}" />

        <input type="hidden" id="sex" name="sex" value="{{ $old_record['Sex'] }}" />
        <input type="hidden" id="id" name="id" value="{{ $old_record['Dead_ID'] }}" />
        <div class="card  mb-7">
            <!--begin::Card body-->
            <div class="card-body">

                <div class="d-flex align-items-center">
                    <!--begin::Input group-->
                    <label class="control-label col-md-1">نقطة الادخال</label>
                    <div class="position-relative w-md-400px me-md-1">

                        <div class="row mb-4">
                            <div class="col-lg-10">

                                <select class="form-select" data-control="select2" id="BORN_DETAILS_HEALTH_CENTER_CD2"
                                    data-placeholder="اختر نقطة الادخال">
                                    <option value="0">غير معروف</option>
                                    @foreach ($entry_reg_place as $entry_reg_places)
                                        <option value="{{ $entry_reg_places['dref_code'] }}">
                                            {{ $entry_reg_places['dref_name_ar'] }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <label class="control-label col-md-2">اسم المستخدم</label>
                    <div class="position-relative w-md-400px me-md-1">

                        <div class="row mb-4">
                            <div class="col-lg-10">

                                <select class="form-select" data-control="select2" id="USER_FULL_NAME"
                                    data-placeholder="اختر المستخدم">
                                    <option></option>
                                    @foreach ($list_user as $det_user)
                                        <option value="{{ $det_user['USER_CODE'] }}">
                                            {{ $det_user['USER_FULL_NAME'] }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                    </div>
                    <div class="float-end">
                        @if (IsPermissionBtn(21))
                            <button type="button" class="btn btn-primary me-5" onclick="get_scanned_file_rep();">استعلام</button>
                        @endif

                    </div>

                    <!--end::Input group-->
                </div>

            </div>
        </div>
    </form>
    <p></p>

    <div class="card mb-7">

        <!--begin::Card body-->
        <div class="card-body">


            <div class="table-responsive">
                <table id="result_tb3" class="table table-striped table-responsive" style="width:100%">
                    <thead>
                        <tr class="fw-semibold fs-6 text-muted">

                            <th scope="col" width="5" style="text-align: center">#</th>
                            <th scope="col" width="5" style="text-align: center">الهوية</th>
                            <th scope="col" width="20" style="text-align: center">تاريخ الميلاد</th>
                            <th scope="col" width="20" style="text-align: center">تاريخ الوفاة</th>
                            <th scope="col" width="5" style="text-align: center">الجنس</th>
                            <th scope="col" width="20" style="text-align: center">اسم المتوفى</th>
                            <th scope="col" width="20" style="text-align: center">المستشفى</th>
                            <th scope="col" width="10" style="text-align: center">منطقة السكن</th>
                        </tr>

                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>

        </div>
    </div>


@endsection



@push('scripts')
    <script>
        $('#kt_app_content_container').attr('class', 'app-container container-fluid');
        var block_search_dead = document.querySelector("#dead_form");
        var block_search_dead = new KTBlockUI(block_search_dead);

        function get_scanned_file_rep() {


            var url = "{{ route('Report.get_scanned_file_rep') }}";
            $('#result_tb3').DataTable().destroy();
            $.fn.dataTable.ext.errMode = 'none';
            $('#result_tb3').on('error.dt', function(e, settings, techNote, message) {
                console.log('An error has been reported by DataTables: ', message);
            });
            block_search_dead.block();
            $("#result_tb3").DataTable({
                dom: 'Bfrtip',
            buttons: [  {
                        extend: 'excelHtml5',
                        title: 'تقرير خاص بالوفيات حسب تاريخ الادخال',
                        text:'تحميل ملف اكسل'

                    }],
                serverSide: true,
                paging: true,
                ordering: false,
                ajax: {
                    url: url,
                    method: 'post',
                    data: {
                        Sex: $('#sex').val(),
                        Dead_ID: $('#id').val(),
                        Age_From: $('#age_From').val(),
                        Age_To: $('#age_To').val(),
                        Diag_From: $('#dia_from').val(),
                        Diag_To: $('#dia_to').val(),
                        Year_From: $('#y_from').val(),
                        Year_To: $('#y_to').val(),
                        Death_date_frm: $('#d_from').val(),
                        Death_date_to: $('#d_to').val(),
                        USER_FULL_NAME: $('#USER_FULL_NAME').val(),
                        BORN_DETAILS_HEALTH_CENTER_CD2: $('#BORN_DETAILS_HEALTH_CENTER_CD2').val(),
                    },
                },
                initComplete: function(data) {
                    block_search_dead.release();
                    // document.getElementById("excel_btn").style.display = 'block';
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
                    return "عرض _" + start + "_ الى  _" + end + "_ من _" + total + "_ سجلات";
                }


            });
        }
    </script>
@endpush
