@extends('layouts.main')
@section('title', 'تقرير يومي خاص بالوفيات حسب تاريخ الوفاة')

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

    <form action="#" id="dead_form">
        <!--begin::Card-->
        <input type="hidden" id="d_from" name="d_from" value="{{$old_record['Death_date_frm']}}" />
        <input type="hidden" id="d_to" name="d_to" value=" {{ $old_record['Death_date_to'] }}" />

        <input type="hidden" id="dia_from" name="dia_from" value="{{ $old_record['Diag_From'] }}" />
        <input type="hidden" id="dia_to" name="dia_to" value="{{ $old_record['Diag_To'] }}" />

        <input type="hidden" id="age_From" name="age_From" value="{{ $old_record['Age_From'] }}" />
        <input type="hidden" id="age_To" name="age_To" value="{{ $old_record['Age_To'] }}" />

        <input type="hidden" id="y_from" name="y_from" value="{{ $old_record['Year_From'] }}" />
        <input type="hidden" id="y_to" name="y_to" value=" {{ $old_record['Year_To'] }}" />

        <input type="hidden" id="sex" name="sex" value="{{$old_record['Sex']}}" />
        <input type="hidden" id="id" name="id" value="{{$old_record['Dead_ID']}}" />

        <div class="card  mb-7">
            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Compact form-->
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
                    <label class="control-label col-md-1">مستشفى الوفاة</label>
                    <div class="position-relative w-md-400px me-md-1">

                        <div class="row mb-4">
                            <div class="col-lg-10">

                                <select class="form-select" data-control="select2" id="DEAD_HOS_NAME_CD"
                                    data-placeholder="اختر مستشفى الوفاة ">
                                    <option value="0">غير معروف</option>
                                    @foreach ($hospitals as $hospital)
                                        <option value="{{ $hospital['DREF_CODE'] }}">
                                            {{ $hospital['DREF_NAME_AR'] }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="d-flex align-items-center">


                    <label class="control-label col-md-1">مكان الوفاة</label>
                    <div class="position-relative w-md-400px me-md-1">

                        <div class="row mb-4">
                            <div class="col-lg-10">

                                <select class="form-select" data-control="select2" id="DEAD_DEATH_PLACE_CD"
                                    data-placeholder="اختر مكان الوفاة ">
                                    <option value="0">غير معروف</option>
                                    <option value="1">غزة</option>
                                    <option value="5">شمال غزة</option>
                                    <option value="6">المنطقة الوسطى</option>
                                    <option value="7">خانيونس</option>
                                    <option value="8">رفح</option>
                                    <option value="2">الضفة الغربية</option>
                                    <option value="3">داخل الخط الأخضرو القدس</option>
                                    <option value="4">خارج البلاد</option>
                                </select>

                            </div>
                        </div>

                    </div>
                    <!--begin::Input group-->
                    <label class="control-label col-md-1">اسم المستخدم</label>
                    <div class="position-relative w-md-400px me-md-1">

                        <div class="row mb-4">
                            <div class="col-lg-10">

                                <select class="form-select" data-control="select2" id="USER_FULL_NAME"
                                    data-placeholder="اختر المستخدم">
                                    <option></option>
                                    @foreach ($list_user as $det_user)
                                        <option value="{{ $det_user['USER_CODE'] }}">{{ $det_user['USER_FULL_NAME'] }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                    </div>

                    <!--end::Input group-->
                </div>

                <!--end::Compact form-->

                <!--begin::Compact form-->


                <!--end::Compact form-->
                <!--begin:Action-->

                <!--begin::Input group-->

                <div class="float-end">
                    @if (IsPermissionBtn(21))
                        <button type="button" class="btn btn-primary me-5" onclick="Get_Daily_Dead_Rep_D();">استعلام</button>
                    @endif

                </div>
            </div>

        </div>
    </form>
    <!--end::Col-->
    <div class="card mb-7">

        <!--begin::Card body-->
        <div class="card-body">

            <!--begin::datatable-->
            <div class="table-responsive">
                <table id="result_tb" class="table table-striped table-responsive" style="width:100%">
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
                            <th scope="col" width="20" style="text-align: center">التشخيص</th>
                            <th width="5" style="text-align: center">كود ICD</th>
                            <th scope="col" width="20" style="text-align: center">المسح الضوئي</th>
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


    <!--end::Row-->
    <!--end::Card-->



@endsection


@push('scripts')
    <script>
        $('#kt_app_content_container').attr('class', 'app-container container-fluid');
        var block_search_dead = document.querySelector("#dead_form");
        var block_search_dead = new KTBlockUI(block_search_dead);

        function Get_Daily_Dead_Rep_D() {


            var url = "{{ route('Report.Get_Daily_Dead_Rep_D') }}";
            $('#result_tb').DataTable().destroy();
            $.fn.dataTable.ext.errMode = 'none';
            $('#result_tb').on('error.dt', function(e, settings, techNote, message) {
                console.log('An error has been reported by DataTables: ', message);
            });
            block_search_dead.block();
            $("#result_tb").DataTable({
                dom: 'Bfrtip',
            buttons: [  {
                        extend: 'excelHtml5',
                        title: 'تقرير يومي خاص بالوفيات حسب تاريخ الوفاة',
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
                        DEAD_DEATH_PLACE_CD: $('#DEAD_DEATH_PLACE_CD').val(),
                        DEAD_HOS_NAME_CD: $('#DEAD_HOS_NAME_CD').val(),
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
