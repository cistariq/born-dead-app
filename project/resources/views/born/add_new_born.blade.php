@extends('layouts.main')
@section('title', 'إضافة مولود جديد')

@section('content')

    <form action="#" id="born_form">
        <!--begin::Card-->
        <div class="card mb-7">
            <!--begin::Card body-->
            <div class="card-body">

                <!--begin::Compact form-->
                <div class="d-flex align-items-center">
                    <!--begin::Input group-->
                    <div class="position-relative w-md-400px me-md-2">
                        <i class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle ms-6"><span
                                class="path1"></span><span class="path2"></span></i>
                        <input type="text" class="form-control form-control-solid ps-10" name="search" id="F_ID"
                            value="" placeholder="رقم هوية الأب">

                    </div>
                    <div class="position-relative w-md-400px me-md-2">
                        <i
                            class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle ms-6"><span
                                class="path1"></span><span class="path2"></span></i>
                        <input type="text" class="form-control form-control-solid ps-10" name="search" id="M_ID"
                            value="" placeholder="رقم هوية الأم">

                    </div>
                    <!--end::Input group-->

                    <!--begin:Action-->
                    <div class="d-flex align-items-center">
                        @if (IsPermissionBtn(32))
                            <button type="button" class="btn btn-primary me-5" onclick="get_result_data();">بحث</button>
                        @endif

                        <button type="button" class="btn btn-outline-dark me-5" onclick="clear_form();">جديد</button>

                        {{-- <button type="button" class="btn btn-outline-dark me-5" onclick="more_search();">بحث متقدم</button> --}}

                    </div>
                    <!--end:Action-->
                </div>
                <!--end::Compact form-->

            </div>
            <!--end::Col-->

        </div>
        <!--end::Row-->
        <div class="card mb-7">
            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::datatable-->
                <div class="table-responsive">
                    <table id="result_tb" class="table table-striped dt-responsive table-row-bordered gy-5 gs-7"
                        style="width:100%">
                        <thead>
                            <tr class="fw-semibold fs-6 text-muted">
                                <th>#</th>
                                <th>هوية الأب</th>
                                <th>اسم الأب</th>
                                <th>هوية الأم</th>
                                <th>اسم الأم</th>
                                <th>تاريخ الولادة</th>
                                <th style="text-align: center">إضافة مولود</th>
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

        <!--end::Card-->
    </form>
    <div class="modal fade" tabindex="-1" id="BornModal">
        <input type="hidden" value="" name="BI_PARTOGRAM_CD" id="BI_PARTOGRAM_CD" />
        <input type="hidden" value="" name="BI_PRESENTATION_CD" id="BI_PRESENTATION_CD" />
        <input type="hidden" name="BI_OUT_COME_CD" id="BI_OUT_COME_CD" />
        <input name="BI_APAGAR_5" style="background-color:#FFFFFF;border-top-width:thin; border-style:groove" type="hidden"
            id="BI_APAGAR_5" tabindex="15" value="" dir="rtl" onblur="check_digits(1,this.value,this.id)" />
        <input name="BI_APAGAR_1" style="background-color:#FFFFFF;border-top-width:thin; border-style:groove" type="hidden"
            id="BI_APAGAR_1" tabindex="14" dir="rtl" value="" onblur="check_digits(1,this.value,this.id)" />
        <input type="hidden" value="" name="BI_CONGENITAL_ANOMALIES_CD" id="BI_CONGENITAL_ANOMALIES_CD" />
        <input type="hidden" value="" name="BI_EXAM_OUT_COME_CD" id="BI_EXAM_OUT_COME_CD" />
        <input type="hidden" value="" name="BI_EXAM_BEFORE_CD" id="BI_EXAM_BEFORE_CD" />
        <input type="hidden" value="" name="BI_ADMITTED_NICU_CD" id="BI_ADMITTED_NICU_CD" />
        <input type="hidden" value="" name="BI_ADMISSION_CD" id="BI_ADMISSION_CD" />

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">إضافة مولود</h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <label class="col-form-label fw-bold col-lg-4">هوية رقم</label>
                        <div class="col-lg-8">
                            <input id="P_BI_ID" type="text" value=""
                                class="form-control form-control-solid ps-10" onchange="check_born_id();">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-form-label fw-bold col-lg-4">ترتيب المولود</label>
                        <div class="col-lg-8">
                            <input id="BI_ORDER" type="text" value=""
                                class="form-control form-control-solid ps-10" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-form-label fw-bold col-lg-4">وزن المولود بالجرام</label>
                        <div class="col-lg-8">
                            <input id="BI_WEIGHT_GM" type="text" value=""
                                class="form-control form-control-solid ps-10" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-form-label fw-bold col-lg-4">اسم المولود الاول</label>
                        <div class="col-lg-8">
                            <input id="BI_FIRST_NAME" type="text" value=""
                                class="form-control form-control-solid ps-10" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-form-label fw-bold col-lg-4">جنس المولود</label>
                        <div class="col-lg-8">
                            <select id="BI_SEX_CD" data-control="select2" data-placeholder="اختر ..."
                                class="form-select form-select-lg fw-bold">
                                <option value="">اختر...</option>
                                <option value="1">ذكر</option>
                                <option value="2">أنثى</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-form-label fw-bold col-lg-4">ديانة المولود</label>
                        <div class="col-lg-8">
                            <select id="BI_RELEGION_CD" data-control="select2" data-placeholder="اختر ..."
                                class="form-select form-select-lg fw-bold">
                                <option value="">اختر...</option>
                                @foreach ($religion as $item)
                                    <option value="{{ $item->re_code }}">{{ $item->re_name_ar }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">إغلاق</button>
                    @if (IsPermissionBtn(34))
                        <button type="button" class="btn btn-primary" onclick="check_born_count();">حفظ التعديل</button>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Example End-->
    <!-- Modal Upload File Begin-->


@endsection
@push('scripts')
    <script>
        function get_result_data() {

            if (($('#F_ID').val() == null || $('#F_ID').val() == undefined || $('#F_ID').val() == '') || ($(
                    '#M_ID').val() == null || $('#M_ID').val() == undefined || $('#M_ID').val() == '')) {

                Swal.fire({

                    icon: 'info',
                    title: 'تنبيه',
                    text: 'يجب إدخال هوية الأب وهوية الأم ',

                });
            } else {
                var F_ID = $('#F_ID').val();
                var M_ID = $('#M_ID').val();


                var url = "{{ route('born.GET_BORNS_DATE') }}";
                $("#result_tb").DataTable({
                    destroy: true,

                    ajax: {
                        url: url,
                        method: 'get',
                        data: {
                            F_ID: F_ID,
                            M_ID: M_ID,



                        },
                    },
                    initComplete: function() {

                        //console.log('true');
                    }
                });
            }
        }

        function Upborn_data(BORN_CODE) {

                    $('#BI_ADMISSION_CD').val(BORN_CODE);

                        var url = "{{ route('born.is_born_found') }}";
                        $.ajax({
                            url: url,
                            type: 'json',
                            method: 'post',
                            data: {
                                'P_BI_ADMISSION_CD': BORN_CODE
                            },
                        }).done(function(response) {
                            console.log(response);
                            if (response.success) {
                                if (response.success == 1) {

                                    if (response.results.FLAG == 1) {

                                        var url = "{{ route('born.getBornInfoByNo') }}";
                                        $.ajax({
                                            url: url,
                                            type: 'json',
                                            method: 'post',
                                            data: {
                                                'P_BI_ADMISSION_CD': BORN_CODE
                                            },
                                        }).done(function(response) {
                                            console.log(response);
                                            if (response.success) {
                                                if (response.success == 1) {

                                                    $('#P_BI_ID').val(response.results.BI_ID);
                                                    $('#BI_ORDER').val(response.results.BI_ORDER);
                                                    $('#BI_WEIGHT_GM').val(response.results
                                                        .BI_WEIGHT_GM);
                                                    $('#BI_FIRST_NAME').val(response.results
                                                        .BI_FIRST_NAME);
                                                    $('#BI_SEX_CD').val(response.results.BI_SEX_CD)
                                                        .change();
                                                    $('#BI_RELEGION_CD').val(response.results
                                                        .BI_RELEGION_CD).change();
                                                    $('#BI_PARTOGRAM_CD').val(response.results
                                                        .BI_PARTOGRAM_CD);
                                                    $('#BI_PRESENTATION_CD').val(response.results
                                                        .BI_PRESENTATION_CD);
                                                    $('#BI_OUT_COME_CD').val(response.results
                                                        .BI_OUT_COME_CD);
                                                    $('#BI_APAGAR_5').val(response.results
                                                        .BI_APAGAR_5);
                                                    $('#BI_APAGAR_1').val(response.results
                                                        .BI_APAGAR_1);
                                                    $('#BI_CONGENITAL_ANOMALIES_CD').val(response
                                                        .results.BI_CONGENITAL_ANOMALIES_CD);
                                                    $('#BI_EXAM_OUT_COME_CD').val(response.results
                                                        .BI_EXAM_OUT_COME_CD);
                                                    $('#BI_EXAM_BEFORE_CD').val(response.results
                                                        .BI_EXAM_BEFORE_CD);
                                                    $('#BI_ADMITTED_NICU_CD').val(response.results
                                                        .BI_ADMITTED_NICU_CD);

                                                }
                                            } else {
                                                console.log(response);
                                                $message = "";
                                                $.each(response.errors, function(key, value) {
                                                    console.log(value);
                                                    console.log(key);
                                                    $message += value.join('-') + "\r\n";
                                                });
                                                Swal.fire({
                                                    title: 'خطأ !',
                                                    text: $message,
                                                    icon: 'error',
                                                    confirmButtonText: 'Ok'
                                                });
                                            }
                                        });
                                    }


                                }
                            } else {
                                console.log(response);
                                $message = "";
                                $.each(response.errors, function(key, value) {
                                    console.log(value);
                                    console.log(key);
                                    $message += value.join('-') + "\r\n";
                                });
                                Swal.fire({
                                    title: 'خطأ !',
                                    text: $message,
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                });
                            }
                        });


                    $('#BornModal').modal('show');


        }

        function edit_born_data() {
            //dead data
            if (($('#P_BI_ID').val() == null || $('#P_BI_ID').val() == undefined || $('#P_BI_ID').val() == '') || ($(
                    '#BI_ORDER').val() == null || $('#BI_ORDER').val() == undefined || $('#BI_ORDER').val() == '') || ($(
                        '#BI_WEIGHT_GM').val() == null || $('#BI_WEIGHT_GM').val() == undefined || $('#BI_WEIGHT_GM')
                .val() == '') || ($(
                        '#BI_FIRST_NAME').val() == null || $('#BI_FIRST_NAME').val() == undefined || $('#BI_FIRST_NAME')
                    .val() == '') || ($(
                    '#BI_SEX_CD').val() == null || $('#BI_SEX_CD').val() == undefined || $('#BI_SEX_CD').val() == '') || ($(
                        '#BI_RELEGION_CD').val() == null || $('#BI_RELEGION_CD').val() == undefined || $('#BI_RELEGION_CD')
                    .val() == '')) {
                Swal.fire({

                    icon: 'info',
                    title: 'تنبيه',
                    text: 'يجب إدخال جميع البيانات الخاصة بالمولود! ',

                });
            } else {
                var P_BI_ADMISSION_CD = $('#BI_ADMISSION_CD').val();
                var P_BI_ID = $('#P_BI_ID').val();
                var P_BI_ORDER = $('#BI_ORDER').val();
                var P_BI_WEIGHT_GM = $('#BI_WEIGHT_GM').val();
                var P_BI_FIRST_NAME = $('#BI_FIRST_NAME').val();
                var P_BI_SEX_CD = $('#BI_SEX_CD').val();
                var P_BI_RELEGION_CD = $('#BI_RELEGION_CD').val();
                var P_BI_PARTOGRAM_CD = $('#BI_PARTOGRAM_CD').val();
                var P_BI_PRESENTATION_CD = $('#BI_PRESENTATION_CD').val();
                var P_BI_OUT_COME_CD = $('#BI_OUT_COME_CD').val();
                var P_BI_APAGAR_5 = $('#BI_APAGAR_5').val();
                var P_BI_APAGAR_1 = $('#BI_APAGAR_1').val();
                var P_BI_CONGENITAL_ANOMALIES_CD = $('#BI_CONGENITAL_ANOMALIES_CD').val();
                var P_BI_EXAM_OUT_COME_CD = $('#BI_EXAM_OUT_COME_CD').val();
                var P_BI_EXAM_BEFORE_CD = $('#BI_EXAM_BEFORE_CD').val();
                var P_BI_ADMITTED_NICU_CD = $('#BI_ADMITTED_NICU_CD').val();

                var url = "{{ route('born.save_born_info') }}";
                $.ajax({
                    url: url,
                    type: 'json',
                    method: 'post',
                    data: {
                        'P_BI_ID': P_BI_ID,
                        'P_BI_ADMISSION_CD': P_BI_ADMISSION_CD,
                        'P_BI_ORDER': P_BI_ORDER,
                        'P_BI_WEIGHT_GM': P_BI_WEIGHT_GM,
                        'P_BI_FIRST_NAME': P_BI_FIRST_NAME,
                        'P_BI_SEX_CD': P_BI_SEX_CD,
                        'P_BI_RELEGION_CD': P_BI_RELEGION_CD,
                        'P_BI_PARTOGRAM_CD': P_BI_PARTOGRAM_CD,
                        'P_BI_PRESENTATION_CD': P_BI_PRESENTATION_CD,
                        'P_BI_OUT_COME_CD': P_BI_OUT_COME_CD,
                        'P_BI_APAGAR_5': P_BI_APAGAR_5,
                        'P_BI_APAGAR_1': P_BI_APAGAR_1,
                        'P_BI_CONGENITAL_ANOMALIES_CD': P_BI_CONGENITAL_ANOMALIES_CD,
                        'P_BI_EXAM_OUT_COME_CD': P_BI_EXAM_OUT_COME_CD,
                        'P_BI_EXAM_BEFORE_CD': P_BI_EXAM_BEFORE_CD,
                        'P_BI_ADMITTED_NICU_CD': P_BI_ADMITTED_NICU_CD,

                    },
                }).done(function(response) {
                    console.log(response);
                    if (response.success) {
                        if (response.success == 1) {
                            Swal.fire({
                                title: 'تمت عملية تعديل بيانات المولود  بنجاح !',
                                text: response.results.message,
                                icon: "success",
                                confirmButtonText: 'موافق'
                            }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                             //   clear_form();
                             $('#P_BI_ID').val('');
                            $('#BI_ORDER').val('');
                            $('#BI_WEIGHT_GM').val('');
                            $('#BI_FIRST_NAME').val('');
                           $('#BI_SEX_CD').val('').change();
                           $('#BI_RELEGION_CD').val('').change();
                             //   $('#BornModal').modal('hide');


                            }
                        });

                          //  $('#BornModal').modal('hide');

                        } else {

                            toastr["error"](response.results.message);
                        }
                    } else {
                        console.log(response);
                        $message = "";
                        $.each(response.errors, function(key, value) {
                            console.log(value);
                            console.log(key);
                            $message += value.join('-') + "\r\n";
                        });
                        Swal.fire({
                            title: 'يوجد خطأ في عملية الإدخال !',
                            text: 'تأكد من البيانات المولود المدخلة!',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                });
            }
        }

        /**************************************************************************************************************************************************************************************************/
        function clear_form() {
            $('#born_form')[0].reset();

            $('#result_tb').DataTable().destroy();
            $('#result_tb tbody').empty();
            $('#born_form .form-select').val(' ').trigger('change');
        }

        function check_born_id(){
            var P_BI_ID = $('#P_BI_ID').val();
            var url = "{{ route('born.check_born_id') }}";
                $.ajax({
                    url: url,
                    type: 'json',
                    method: 'post',
                    data: {
                        'P_BI_ID': P_BI_ID,
                    },
                }).done(function(response) {
                    console.log(response);
                    if (response.success) {

                    }
                    else {
                        console.log(response);
                        $message = "";
                        $.each(response.errors, function(key, value) {
                            console.log(value);
                            console.log(key);
                            $message += value.join('-') + "\r\n";
                        });
                        Swal.fire({
                            title: 'يوجد خطأ في عملية الإدخال !',
                            text: 'رقم الهوية مدخل مسبقاً يرجى اختيار رقم آخر!',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $('#P_BI_ID').val('');
                        document.getElementById("P_BI_ID").focus();

                    }
                });

                    }
                });
        }

        function check_born_count(){
            var P_BI_ADMISSION_CD = $('#BI_ADMISSION_CD').val();
            var url = "{{ route('born.check_born_count') }}";
                $.ajax({
                    url: url,
                    type: 'json',
                    method: 'post',
                    data: {
                        'P_BI_ADMISSION_CD': P_BI_ADMISSION_CD,
                    },
                }).done(function(response) {
                    console.log(response);
                    if (response.success) {
                        edit_born_data();
                    }
                    else {
                        console.log(response);
                        $message = "";
                        $.each(response.errors, function(key, value) {
                            console.log(value);
                            console.log(key);
                            $message += value.join('-') + "\r\n";
                        });
                        Swal.fire({
                            title: 'يوجد خطأ في عملية الإدخال !',
                            text: 'تم إدخال جميع المواليد لهذه الولادة!',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $('#BornModal').modal('hide');
                        get_result_data();
                    }
                });

                    }
                });

        }
    </script>
@endpush
