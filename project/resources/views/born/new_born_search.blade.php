@extends('layouts.main')
@section('title', 'استعلام المواليد الجدد')

@section('content')

    <form action="#" id="born_form">
        <!--begin::Card-->
        <div class="card mb-7">
            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Compact form-->
                <div class="d-flex align-items-center">
                    <!--begin::Input group-->
                    <label class="control-label col-md-1">رقم هوية الأب</label>
                    <div class="position-relative w-md-200px me-md-1">

                        <div class="row mb-4">
                            <div class="col-lg-10">
                                <i
                                    class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle ms-6"><span
                                        class="path1"></span><span class="path2"></span></i>
                                <input type="text" class="form-control form-control ps-10" name="search"
                                    id="P_father_ID" value="" placeholder="رقم هوية الأب">

                            </div>
                        </div>
                    </div>
                    <label class="control-label col-md-1">رقم هوية الأم</label>
                    <div class="position-relative w-md-200px me-md-1">

                        <div class="row mb-4">
                            <div class="col-lg-10">
                                <i
                                    class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle ms-6"><span
                                        class="path1"></span><span class="path2"></span></i>
                                <input type="text" class="form-control form-control ps-10" name="search"
                                    id="P_mother_ID" value="" placeholder="رقم هوية الأم">

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
                    <label class="control-label col-md-1">إسم الأب</label>
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
                                    data-placeholder="اختر الجنس">
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
                                    data-placeholder=" المحافظة">
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
                                    data-placeholder="اختر المدينة">
                                    <option></option>
                                    @foreach ($city as $item)
                                        <option value="{{ $item->c_code }}">{{ $item->c_name_ar }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="d-flex align-items-center">

                    <label class="control-label col-md-1">المستشفى</label>

                    <div class="position-relative w-md-400px me-md-1">
                        <div class="row mb-4">
                            <div class="col-lg-10">
                                <select class="form-select" data-control="select2" id="P_HOS_NO"
                                    data-placeholder="المستشفى">
                                    <option></option>
                                    @foreach ($hospitals as $hospital)
                                        <option value="{{ $hospital->dref_code }}">{{ $hospital->dref_name_ar }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="row mb-6">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <label class="col-lg-2 col-form-label  ">ت.الولادة من</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control text-center form-control-lg mb-3"
                                    id="P_DATE_FROM" name="P_DATE_FROM" value="" />
                            </div>
                            <div class="input-group-prepend">

                                <span class="input-group-text">إلى</span>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control text-center form-control-lg mb-3"
                                    id="P_DATE_TO" name="P_DATE_TO" value="" />
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Compact form-->
                <!--begin:Action-->
                <div class="float-end">
                    <button type="button" class="btn btn-primary me-5" onclick="get_born_data();">بحث</button>
                    <button type="button" class="btn btn-outline-dark me-5" onclick="">جديد</button>

                </div>
                <!--end:Action-->
            </div>
        </div>
    </form>
    <!--end::Col-->
    <div class="card mb-7">
        <!--begin::Card body-->
        <div class="card-body">
            <div class="table-responsive">
                <div class="float-right">

                    <button class="btn btn-success" type="button" onclick="exports_excel();" id="excel_btn"
                        style="display: none"><i class="fa fa-file"></i>تحميل
                        ملف اكسل</button>
                </div>
                <!--begin::datatable-->
                <table id="result_tb" class="table table-striped dt-responsive table-row-bordered gy-5 gs-7"
                    style="width:100%">
                    <thead>
                        <tr class="fw-semibold fs-6 text-muted">
                            <th>#</th>
                            <th>رقم السجل</th>
                            <th>هوية الأب</th>
                            <th>هوية الأم</th>
                            <th>اسم المولود</th>
                            <th>تاريخ الميلاد</th>
                            <th>المركز الصحي</th>
                            <th style="text-align: center">الإجراءات</th>
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
        var block_search_born = document.querySelector("#born_form");
        var block_search_born = new KTBlockUI(block_search_born);
        $("#P_DATE_FROM").flatpickr({
            dateFormat: "d/m/Y",
        });

        $("#P_DATE_TO").flatpickr({
            dateFormat: "d/m/Y",
        });


        function get_born_data() {

            if (($('#P_reg_no').val() == null || $('#P_reg_no').val() == undefined || $('#P_reg_no').val() == '') && ($(
                        '#P_father_ID').val() == null || $('#P_father_ID').val() == undefined || $('#P_father_ID').val() ==
                    '') && ($(
                        '#P_mother_ID').val() == null || $('#P_mother_ID').val() == undefined || $('#P_mother_ID').val() ==
                    '') &&
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
                    '#P_HOS_NO').val() == null || $('#P_HOS_NO').val() == undefined || $('#P_HOS_NO').val() == '')) {

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
                        '#P_HOS_NO').val() == null || $('#P_HOS_NO').val() == undefined || $('#P_HOS_NO').val() == ''))

            )

            {

                Swal.fire({

                    icon: 'info',
                    title: 'تنبيه',
                    text: 'يجب إدخال  الاسم الأول والأخير',

                });


            } else {

                var P_BORN_CODE = $('#P_reg_no').val();
                var P_FATHER_ID = $('#P_father_ID').val();
                var P_MOTHER_ID = $('#P_mother_ID').val();
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

                var url = "{{ route('born.getBornResult') }}";
                $('#result_tb').DataTable().destroy();
                $.fn.dataTable.ext.errMode = 'none';
                $('#result_tb').on('error.dt', function(e, settings, techNote, message) {
                    console.log('An error has been reported by DataTables: ', message);
                });
                block_search_born.block();
                $("#result_tb").DataTable({

                    serverSide: true,
                    paging: true,
                    ordering: false,
                    ajax: {
                        url: url,
                        method: 'post',
                        data: {
                            P_BORN_CODE: P_BORN_CODE,
                            P_FATHER_ID: P_FATHER_ID,
                            P_MOTHER_ID: P_MOTHER_ID,
                            P_FIRST_NAME: P_FIRST_NAME,
                            P_SECOND_NAME: P_SECOND_NAME,
                            P_THIRD_NAME: P_THIRD_NAME,
                            P_LAST_NAME: P_LAST_NAME,
                            P_DATE_FROM: P_DATE_FROM,
                            P_DATE_TO: P_DATE_TO,
                            P_SEX_NO: P_SEX_NO,
                            P_REGION_NO: P_REGION_NO,
                            P_CITY_NO: P_CITY_NO,
                            P_HOS_NO: P_HOS_NO,


                        },
                    },
                    initComplete: function() {
                        block_search_born.release();
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

        }

        function exports_excel() {
            var query = {
                P_BORN_CODE: $('#P_reg_no').val(),
                P_FATHER_ID: $('#P_father_ID').val(),
                P_MOTHER_ID: $('#P_mother_ID').val(),
                P_FIRST_NAME: $('#P_FIRST_NAME').val(),
                P_SECOND_NAME: $('#P_SECOND_NAME').val(),
                P_THIRD_NAME: $('#P_THIRD_NAME').val(),
                P_LAST_NAME: $('#P_LAST_NAME').val(),
                P_DATE_FROM: $('#P_DATE_FROM').val(),
                P_DATE_TO: $('#P_DATE_TO').val(),
                P_SEX_NO: $('#P_SEX_NO').val(),
                P_REGION_NO: $('#P_Region_NO').val(),
                P_CITY_NO: $('#P_CITY_NO').val(),
                P_HOS_NO: $('#P_HOS_NO').val()

            }
            var base_url = "{{ URL::to('born/export_excel') }}?" + $.param(query)

            window.location = base_url;
        }
    </script>
@endpush
