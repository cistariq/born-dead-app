@extends('layouts.main')
@section('title', 'استعلام اشعارات الوفاة')

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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <form action="#" id="dead_form">
        <!--begin::Card-->
        <div class="card mb-7">
            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Compact form-->
                <div class="d-flex align-items-center">
                    <!--begin::Input group-->
                    <label class="control-label col-md-1">رقم الهوية</label>
                    <div class="position-relative w-md-200px me-md-1">

                        <div class="row mb-4">
                            <div class="col-lg-10">
                                <i
                                    class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle ms-6"><span
                                        class="path1"></span><span class="path2"></span></i>
                                <input type="text" class="form-control form-control ps-10" name="search" id="P_ID"
                                    value="" placeholder="رقم الهوية">

                            </div>
                        </div>
                    </div>

                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <label class="control-label col-md-1">رقم السجل</label>
                    <div class="position-relative w-md-200px me-md-1">

                        <div class="row mb-4">
                            <div class="col-lg-10">

                                <input type="text" class="form-control form-control ps-10" name="P_reg_no" id="P_reg_no"
                                    value="" placeholder="رقم السجل">


                            </div>
                        </div>

                    </div>
                    <!--end::Input group-->
                </div>

                <!--end::Compact form-->
                <!--begin::Compact form-->
                <div class="d-flex align-items-center">
                    <label class="control-label col-md-1">الاسم الأول</label>

                    <div class="position-relative w-md-300px me-md-1">
                        <div class="row mb-4">

                            <div class="col-lg-10">
                                <input type="text" class="form-control text-center" id="P_FIRST_NAME" value=""
                                    placeholder="الاسم الأول" style="padding-right: 40px">
                            </div>
                        </div>
                    </div>
                    <label class="control-label col-md-1">إسم الأب </label>
                    <div class="position-relative w-md-300px me-md-1">
                        <div class="row mb-4">
                            <div class="col-lg-10">
                                <input type="text" class="form-control text-center" id="P_SECOND_NAME" value=""
                                    placeholder="إسم الأب" style="padding-right: 40px">
                            </div>
                        </div>
                    </div>
                    <label class="control-label col-md-1">إسم الجد</label>
                    <div class="position-relative w-md-300px me-md-1">
                        <div class="row mb-4">
                            <div class="col-lg-10">
                                <input type="text" class="form-control text-center" id="P_THIRD_NAME" value=""
                                    placeholder="إسم الجد" style="padding-right: 40px">
                            </div>
                        </div>
                    </div>
                    <label class="control-label col-md-1">إسم العائلة</label>
                    <div class="position-relative w-md-300px me-md-1">
                        <div class="row mb-4">
                            <div class="col-lg-10">
                                <input type="text" class="form-control text-center" id="P_LAST_NAME" value=""
                                    placeholder="إسم العائلة" style="padding-right: 40px">
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Compact form-->

                <!--begin::Compact form-->
                <div class="d-flex align-items-center">
                    <!--begin::Input group-->
                    <label class="control-label col-md-1">الجنس</label>

                    <div class="position-relative w-md-400px me-md-1">
                        <div class="row mb-4">
                            <div class="col-lg-10">
                                <select class="form-select" data-control="select2" id="P_SEX_NO"
                                    data-placeholder="اختر الجنس" data-allow-clear="true">
                                    <option></option>
                                    <option value="1">ذكر</option>
                                    <option value="2">انثى</option>
                                </select>
                            </div>
                        </div>

                    </div>



                    <label class="control-label col-md-1">المحافظة</label>

                    <div class="position-relative w-md-400px me-md-1">
                        <div class="row mb-4">
                            <div class="col-lg-10">
                                <select class="form-select" data-control="select2" id="P_Region_NO"
                                    data-placeholder=" المحافظة" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($region as $item)
                                        <option value="{{ $item->r_code }}">{{ $item->r_name_ar }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <!--end::Input group-->

                    <label class="control-label col-md-1">المدينة</label>
                    <div class="position-relative w-md-400px me-md-1">
                        <div class="row mb-4">
                            <div class="col-lg-10">
                                <select class="form-select" data-control="select2" id="P_CITY_NO"
                                    data-placeholder="اختر المدينة" data-allow-clear="true">
                                    <option></option>
                                    {{-- @foreach ($city as $item)
                                        <option value="{{ $item->c_code }}">{{ $item->c_name_ar }}
                                        </option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="d-flex align-items-center">

                    <label class="control-label col-md-1">المرض الأصلي</label>

                    <div class="position-relative w-md-450px me-md-18">
                        <div class="row mb-">
                            <div class="col-lg-12">
                                <select id="DIAG4_NAME" data-control="select2" data-placeholder="اختر ..."
                                    class="form-select form-select-lg fw-bold" data-allow-clear="true">
                                    <option></option>

                                </select>
                            </div>
                        </div>

                    </div>

                    <label class="control-label col-md-1">سبب الوفاة</label>

                    <div class="position-relative w-md-450px me-md-2">
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <select id="DIAG1_NAME" data-control="select2" data-placeholder="اختر ..."
                                    class="form-select form-select-lg fw-bold" data-allow-clear="true">
                                    <option></option>

                                </select>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="row mb-6">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <label class="control-label col-md-2" style="margin-top: 20px;">ت.الوفاة من</label>
                            <div class="col-lg-4">

                                <input type="text" class="form-control text-center form-control-lg mb-3"
                                    id="P_DATE_FROM" name="P_DATE_FROM">
                            </div>
                            <div class="input-group-prepend">

                                <span class="input-group-text">إلى</span>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control text-center form-control-lg mb-3"
                                    id="P_DATE_TO" name="P_DATE_TO">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <label class="control-label col-md-2" style="margin-top: 20px;">ت.الادخال من</label>
                            <div class="col-lg-4">

                                <input type="text" class="form-control text-center form-control-lg mb-3"
                                    id="P_ENTER_FROM" name="P_DATE_FROM">
                            </div>
                            <div class="input-group-prepend">

                                <span class="input-group-text">إلى</span>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control text-center form-control-lg mb-3"
                                    id="P_ENTER_TO" name="P_DATE_TO">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <label class="control-label col-md-1">مكان الوفاة</label>

                    <div class="position-relative w-md-400px me-md-1">
                        <div class="row mb-4">
                            <div class="col-lg-10">
                                <select class="form-select" data-control="select2" id="P_Death_Place"
                                    data-placeholder="مكان الوفاة" data-allow-clear="true">
                                    <option></option>
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

                    <label class="control-label col-md-1">المستشفى</label>

                    <div class="position-relative w-md-400px me-md-1">
                        <div class="row mb-4">
                            <div class="col-lg-10">
                                <select class="form-select" data-control="select2" id="P_HOS_NO"
                                    data-placeholder="المستشفى" data-allow-clear="true">
                                    <option></option>
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
                    <label class="control-label col-md-1">موظف الإدخال</label>

                    <div class="position-relative w-md-400px me-md-1">
                        <div class="row mb-4">
                            <div class="col-lg-10">
                                <select class="form-select" data-control="select2" id="P_Entry_employee"
                                    data-placeholder="موظف الإدخال"  data-allow-clear="true">
                                    <option></option>
                                    @foreach ($entry_employee as $entry_employees)
                                        <option value="{{ $entry_employees['id'] }}">
                                            {{ $entry_employees['user_full_name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <label class="control-label col-md-1">نقطة الإدخال</label>

                    <div class="position-relative w-md-400px me-md-1">
                        <div class="row mb-4">
                            <div class="col-lg-10">
                                <select class="form-select" data-control="select2" id="P_Entry_point"
                                    data-placeholder="نقطة الإدخال" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($entry_reg_place as $entry_reg_places)
                                        <option value="{{ $entry_reg_places['dref_code'] }}">
                                            {{ $entry_reg_places['dref_name_ar'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>


                <!--end::Compact form-->
                <!--begin:Action-->

                <!--begin::Input group-->

                <div class="float-end">
                    @if (IsPermissionBtn(21))
                        <button type="button" class="btn btn-primary me-5" onclick="get_dead_data();">بحث</button>
                    @endif

                    <button type="button" class="btn btn-outline-dark me-5" onclick="clear_form();">جديد</button>

                </div>
                <!--end::Input group-->
                <!--begin::Input group-->

                {{-- <label class="control-label col-md-3">عدد الوفيات</label>

                    <div class="col-lg-10">
                        <input type="text" id="out_records_num" class="form-control text-center"
                            name="out_records_num" value="0" readonly />

                        <span class="help-block"> </span>
                    </div> --}}

                <!--end::Input group-->

            </div>
        </div>
    </form>
    <!--end::Col-->
    <div class="card mb-7">

        <!--begin::Card body-->
        <div class="card-body">

            <!--begin::datatable-->
            <div class="table-responsive">
                {{-- <form action="{{ route('dead.export_excel') }}" method="get">
                    @csrf --}}

                <div class="float-right">
                    @if (IsPermissionBtn(22))
                        <button class="btn btn-success" type="button" onclick="exports_excel();" style="display: none"
                            id="excel_btn"><i class="fa fa-file"></i>تحميل
                            ملف اكسل</button>
                    @endif

                </div>
                {{-- </form> --}}
                <table id="result_tb" class="table table-striped table-responsive" style="width:100%">
                    <thead>
                        <tr class="fw-semibold fs-6 text-muted">

                            {{-- <th scope="col" width="5" style="text-align: center">#</th> --}}
                            <th scope="col" width="5" style="text-align: center">السجل</th>
                            <th scope="col" width="5" style="text-align: center">الهوية</th>
                            {{-- <th  scope="col" width="20" style="text-align: center">نوع الوفاة</th> --}}
                            <th scope="col" width="20" style="text-align: center">تاريخ الميلاد</th>
                            <th scope="col" width="20" style="text-align: center">تاريخ الوفاة</th>
                            <th scope="col" width="5" style="text-align: center">الجنس</th>
                            <th scope="col" width="20" style="text-align: center">اسم المتوفى</th>
                            <th scope="col" width="20" style="text-align: center">المستشفى</th>
                            {{-- <th  scope="col" width="10" style="text-align: center">منطقة السكن</th> --}}
                            <th scope="col" width="20" style="text-align: center">سبب الوفاة</th>
                            {{-- <th width="5" style="text-align: center">كود سبب الوفاة</th> --}}
                            <th scope="col" width="20" style="text-align: center">المرض الاصلي</th>
                            {{-- <th width="5" style="text-align: center">كود ICD</th> --}}
                            <th scope="col" width="30" style="text-align: center">الإجراءات</th>
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

    {{-- <div class="modal fade modal-xl" id="MyModal" aria-hidden="true" tabindex="-1" style="width: 100%;height:100%">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
                <!--end::Close-->
                <div class="modal-body" id="printThis">
                    <embed id="frame" src="" type="application/pdf" width="100%" height="800px">


                </div>
                <div class="modal-footer">
                    <button id="btnPrint" type="button" class="btn btn-outline-primary">Print</button>
                </div>
            </div>
        </div>
    </div> --}}
    <!--end::Row-->
    <!--end::Card-->


@endsection


@push('scripts')
    <script>
        var block_search_dead = document.querySelector("#dead_form");
        var block_search_dead = new KTBlockUI(block_search_dead);

        $("#P_DATE_FROM").flatpickr({
            dateFormat: "d/m/Y",
            maxDate: new Date(),
        });

        $("#P_DATE_TO").flatpickr({
            dateFormat: "d/m/Y",
            maxDate: new Date(),
        });

        $("#P_ENTER_FROM").flatpickr({
            dateFormat: "d/m/Y",
            maxDate: new Date(),
        });

        $("#P_ENTER_TO").flatpickr({
            dateFormat: "d/m/Y",
            maxDate: new Date(),
        });

        $(document).ready(function() {

            getDeadIcdToSelect_Byname($("#DIAG1_NAME"));
            getDeadIcdToSelect_Byname($("#DIAG4_NAME"));

        });


        function getDeadIcdToSelect_Byname(select_id) {
            select_id.select2({
                ajax: {
                    url: "{{ route('dead.getDeadIcd_name') }}",
                    method: 'post',
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term
                        }

                        // Query parameters will be ?search=[term]&type=user_search
                        return query;
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    }
                },
                cache: true,
                placeholder: 'ابحث عن أسباب الوفاة',
                minimumInputLength: 1
            });
        }

        function get_dead_data() {

            if (($('#P_reg_no').val() == null || $('#P_reg_no').val() == undefined || $('#P_reg_no').val() == '') && ($(
                    '#P_ID').val() == null || $('#P_ID').val() == undefined || $('#P_ID').val() == '') &&
                ($('#P_FIRST_NAME').val() == null || $('#P_FIRST_NAME').val() == undefined || $(
                    '#P_FIRST_NAME').val() == '') &&
                ($('#P_SECOND_NAME').val() == null || $('#P_SECOND_NAME').val() == undefined || $(
                    '#P_SECOND_NAME').val() == '') && ($('#P_THIRD_NAME').val() == null || $('#P_THIRD_NAME').val() ==
                    undefined || $('#P_THIRD_NAME').val() == '') &&
                ($('#P_LAST_NAME').val() == null || $('#P_LAST_NAME').val() == undefined || $(
                    '#P_LAST_NAME').val() == '') &&
                ($('#P_DATE_FROM').val() == null || $('#P_DATE_FROM').val() == undefined || $('#P_DATE_FROM').val() ==
                    '') && ($('#P_DATE_TO').val() == null || $('#P_DATE_TO').val() == undefined || $('#P_DATE_TO').val() ==
                    '') &&
                ($('#P_SEX_NO').val() == null || $('#P_SEX_NO').val() == undefined || $('#P_SEX_NO').val() == '') && ($(
                        '#P_Region_NO').val() == null || $('#P_Region_NO').val() == undefined || $('#P_Region_NO').val() ==
                    '') &&
                ($('#P_CITY_NO').val() == null || $('#P_CITY_NO').val() == undefined || $('#P_CITY_NO').val() == '') && ($(
                    '#P_HOS_NO').val() == null || $('#P_HOS_NO').val() == undefined || $('#P_HOS_NO').val() == '') &&
                ($('#DIAG1_NAME').val() == null || $('#DIAG1_NAME').val() == undefined || $('#DIAG1_NAME').val() == '') && (
                    $(
                        '#DIAG4_NAME').val() == null || $('#DIAG4_NAME').val() == undefined || $('#DIAG4_NAME').val() == ''
                ) && ($(
                        '#P_Death_Place').val() == null || $('#P_Death_Place').val() == undefined || $('#P_Death_Place')
                    .val() ==
                    '') && ($(
                        '#P_Entry_point').val() == null || $('#P_Entry_point').val() == undefined || $('#P_Entry_point')
                    .val() ==
                    '') && ($(
                        '#P_ENTER_FROM').val() == null || $('#P_ENTER_FROM').val() == undefined || $('#P_ENTER_FROM')
                    .val() ==
                    '') && ($(
                        '#P_ENTER_TO').val() == null || $('#P_ENTER_TO').val() == undefined || $('#P_ENTER_TO')
                    .val() ==
                    '')
                    && ($(
                        '#P_Entry_employee').val() == null || $('#P_Entry_employee').val() == undefined || $('#P_Entry_employee')
                    .val() ==
                    '')

            ) {

                Swal.fire({

                    icon: 'info',
                    title: 'تنبيه',
                    text: 'يجب إدخال أحد الحقول',

                });
            } else if (
                (($('#P_FIRST_NAME').val() == null || $('#P_FIRST_NAME').val() == undefined || $(
                    '#P_FIRST_NAME').val() == '') || ($('#P_LAST_NAME').val() == null || $('#P_LAST_NAME').val() ==
                    undefined || $(
                        '#P_LAST_NAME').val() == '')) && (($('#P_reg_no').val() == null || $('#P_reg_no').val() ==
                        undefined || $('#P_reg_no').val() == '') && ($(
                        '#P_ID').val() == null || $('#P_ID').val() == undefined || $('#P_ID').val() == '') &&
                    ($('#P_DATE_FROM').val() == null || $('#P_DATE_FROM').val() == undefined || $('#P_DATE_FROM').val() ==
                        '') && ($('#P_DATE_TO').val() == null || $('#P_DATE_TO').val() == undefined || $('#P_DATE_TO')
                        .val() ==
                        '') &&
                    ($('#P_SEX_NO').val() == null || $('#P_SEX_NO').val() == undefined || $('#P_SEX_NO').val() == '') && ($(
                            '#P_Region_NO').val() == null || $('#P_Region_NO').val() == undefined || $('#P_Region_NO')
                        .val() ==
                        '') &&
                    ($('#P_CITY_NO').val() == null || $('#P_CITY_NO').val() == undefined || $('#P_CITY_NO').val() == '') &&
                    ($(
                        '#P_HOS_NO').val() == null || $('#P_HOS_NO').val() == undefined || $('#P_HOS_NO').val() == '') &&
                    ($('#DIAG1_NAME').val() == null || $('#DIAG1_NAME').val() == undefined || $('#DIAG1_NAME').val() ==
                        '') && ($(
                            '#DIAG4_NAME').val() == null || $('#DIAG4_NAME').val() == undefined || $('#DIAG4_NAME').val() ==
                        '') && ($(
                            '#P_Death_Place').val() == null || $('#P_Death_Place').val() == undefined || $('#P_Death_Place')
                        .val() ==
                        '') && ($(
                            '#P_Entry_point').val() == null || $('#P_Entry_point').val() == undefined || $('#P_Entry_point')
                        .val() ==
                        '') && ($(
                        '#P_ENTER_FROM').val() == null || $('#P_ENTER_FROM').val() == undefined || $('#P_ENTER_FROM')
                    .val() ==
                    '') && ($(
                        '#P_ENTER_TO').val() == null || $('#P_ENTER_TO').val() == undefined || $('#P_ENTER_TO')
                    .val() ==
                    '')
                    && ($(
                        '#P_Entry_employee').val() == null || $('#P_Entry_employee').val() == undefined || $('#P_Entry_employee')
                    .val() ==
                    '')
                )

            )

            {

                Swal.fire({

                    icon: 'info',
                    title: 'تنبيه',
                    text: 'يجب إدخال  الاسم الأول والأخير',

                });


            } else {
                var P_DEAD_CODE = $('#P_reg_no').val();
                var P_ID = $('#P_ID').val();
                var P_FIRST_NAME = $('#P_FIRST_NAME').val();
                var P_SECOND_NAME = $('#P_SECOND_NAME').val();
                var P_THIRD_NAME = $('#P_THIRD_NAME').val();
                var P_LAST_NAME = $('#P_LAST_NAME').val();
                var P_DATE_FROM = $('#P_DATE_FROM').val();
                var P_DATE_TO = $('#P_DATE_TO').val();
                var P_SEX_NO = $('#P_SEX_NO').val();
                var P_REGION_NO = $('#P_Region_NO').val();
                var P_CITY_NO = $('#P_CITY_NO').val();
                var P_HOS_NO = $('#P_HOS_NO').val();

                var DIAG1_NAME = $('#DIAG1_NAME').val();
                var DIAG4_NAME = $('#DIAG4_NAME').val();
                var P_DEATH_PLACE = $('#P_Death_Place').val();
                var P_ENTRY_POINT = $('#P_Entry_point').val();
                var P_ENTER_FROM = $('#P_ENTER_FROM').val();
                var P_ENTER_TO = $('#P_ENTER_TO').val();
                var P_ENTRY_EMPLOYEE = $('#P_Entry_employee').val();




                var url = "{{ route('dead.getDeadResult') }}";
                $('#result_tb').DataTable().destroy();
                $.fn.dataTable.ext.errMode = 'none';
                $('#result_tb').on('error.dt', function(e, settings, techNote, message) {
                    console.log('An error has been reported by DataTables: ', message);
                });
                block_search_dead.block();
                $("#result_tb").DataTable({

                    serverSide: false,
                    paging: true,
                    ordering: false,
                    ajax: {
                        url: url,
                        method: 'post',
                        data: {
                            P_DEAD_CODE: P_DEAD_CODE,
                            P_ID: P_ID,
                            P_FIRST_NAME: P_FIRST_NAME,
                            P_SECOND_NAME: P_SECOND_NAME,
                            P_THIRD_NAME: P_THIRD_NAME,
                            P_LAST_NAME: P_LAST_NAME,
                            P_DATE_FROM: P_DATE_FROM,
                            P_DATE_TO: P_DATE_TO,
                            P_ENTER_FROM:P_ENTER_FROM,
                            P_ENTER_TO:P_ENTER_TO,
                            P_SEX_NO: P_SEX_NO,
                            P_REGION_NO: P_REGION_NO,
                            P_CITY_NO: P_CITY_NO,
                            P_HOS_NO: P_HOS_NO,
                            DIAG1_NAME: DIAG1_NAME,
                            DIAG4_NAME: DIAG4_NAME,
                            P_DEATH_PLACE: P_DEATH_PLACE,
                            P_ENTRY_POINT: P_ENTRY_POINT,
                            P_ENTRY_EMPLOYEE:P_ENTRY_EMPLOYEE,

                        },
                    },
                    initComplete: function(data) {
                        block_search_dead.release();
                        document.getElementById("excel_btn").style.display = 'block';
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
                    'pageLength': 10,

                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, 'all']
                    ],

                    "searching": true,
                    'paging': true,

                    "infoCallback": function(settings, start, end, max, total, pre) {
                        return "عرض _" + start + "_ الى  _" + end + "_ من _" + total + "_ سجلات";
                    }


                });

            }

        }

        function exports_excel() {
            var query = {
                P_DEAD_CODE: $('#P_reg_no').val(),
                P_ID: $('#P_ID').val(),
                P_FIRST_NAME: $('#P_FIRST_NAME').val(),
                P_SECOND_NAME: $('#P_SECOND_NAME').val(),
                P_THIRD_NAME: $('#P_THIRD_NAME').val(),
                P_LAST_NAME: $('#P_LAST_NAME').val(),
                P_DATE_FROM: $('#P_DATE_FROM').val(),
                P_DATE_TO: $('#P_DATE_TO').val(),
                P_SEX_NO: $('#P_SEX_NO').val(),
                P_REGION_NO: $('#P_Region_NO').val(),
                P_CITY_NO: $('#P_CITY_NO').val(),
                P_HOS_NO: $('#P_HOS_NO').val(),
                DIAG1_NAME: $('#DIAG1_NAME').val(),
                DIAG4_NAME: $('#DIAG4_NAME').val(),
                P_DEATH_PLACE: $('#P_Death_Place').val(),
                P_ENTRY_POINT: $('#P_Entry_point').val(),

            }
            var base_url = "{{ URL::to('dead/export_excel') }}?" + $.param(query)

            window.location = base_url;
        }

        function print_crt_dead(P_DEAD_NUMBER) {


            var url = "{{ route('dead.print_crt_dead') }}";

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    P_DEAD_NUMBER: P_DEAD_NUMBER
                },
            }).done(function(response) {
                console.log(response);
                if (response.success != true) {
                    Swal.fire({
                        title: 'خطأ!',
                        text: response.results.message,
                        icon: "{{ session('m-class', 'error') }}",
                    })
                } else {
                    if (response.results.count == 0) {
                        var red_url = '{{ route('dead.print_dead_book', ':P_DEAD_NUMBER') }}';
                        red_url = red_url.replace(':P_DEAD_NUMBER', P_DEAD_NUMBER);
                        window.open(red_url, true);
                    } else {
                        Swal.fire({
                            title: "تمت عملية طباعة الشهادة مسبقاً هل تريد الاستمرار بعملية الطباعة؟",
                            showDenyButton: true,
                            confirmButtonText: "تأكيد الطباعة",
                            denyButtonText: `إلغاء`
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                var red_url = '{{ route('dead.print_dead_book', ':P_DEAD_NUMBER') }}';
                                red_url = red_url.replace(':P_DEAD_NUMBER', P_DEAD_NUMBER);
                                window.open(red_url, true);
                            }
                        });
                    }
                }
            });
        }

        function update_crt_dead(P_DEAD_NUMBER) {

            var url = "{{ route('dead.getDeadInfoByIdNo') }}";

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    P_DEAD_NUMBER: P_DEAD_NUMBER
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
                            red_url = red_url.replace(':P_DEAD_NUMBER', P_DEAD_NUMBER);
                            window.open(red_url, true);
                        }
                    });
                }
            });

        }

        /**************************************************************************************************************************************************************************************************/
        function clear_form() {
            $('#dead_form')[0].reset();
            document.getElementById("excel_btn").style.display = 'none';

            $('#result_tb').DataTable().destroy();
            $('#result_tb tbody').empty();
            //$('#out_records_num').empty();
            $('#dead_form .form-select').val(' ').trigger('change');
            block_search_dead.release();
        }
        /**************************************************************************************************************************************************************************************************/

        $('#P_Region_NO').change(function() {
            var region_cd = $(this).val();
            var url = "{{ route('dead.get_city') }}";
            $.ajax({
                url: url,
                type: 'json',
                method: 'post',
                data: {
                    region_cd: region_cd
                },
                success: function(data) {
                    console.log(data);
                    $('#P_CITY_NO').empty();

                    $('#P_CITY_NO').append('<option >  </option>');
                    $.each(data, function(key, value) {
                        // console.log(value.C_NAME_AR);

                        $('#P_CITY_NO').append('<option value="' + value.C_CODE +
                            '" >' + value.C_NAME_AR + '</option>');
                    });

                }
            });
        });


        function open_files(P_DEAD_ID) {


            var url = "{{ route('dead.open_crt_dead') }}";

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    P_DEAD_ID: P_DEAD_ID
                },
            }).done(function(response) {

                Swal.fire({
                    title: "هل تريد بالفعل فتح إشعار الوفاة؟",
                    showDenyButton: true,
                    confirmButtonText: "موافق",
                    denyButtonText: `إلغاء`
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        console.log(response);
                        var query = {
                            //path: response.results,
                            Dead_ID: P_DEAD_ID,

                        }
                        var base_url = "{{ URL::to('dead/file_pdf') }}?" + $.param(query);
                        console.log(base_url);
                     //   window.title=P_DEAD_ID;
                       window.open(base_url, true, "width=900,height=700 ,left=450,top=200");

                    }
                });

            });
        }
    </script>
@endpush
