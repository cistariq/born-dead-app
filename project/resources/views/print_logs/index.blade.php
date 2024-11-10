@extends('layouts.main')
@section('title', 'سجل طباعة إشعارات الوفاة')

@section('content')
<style>
    td,
    th {
        text-align: center;
        vertical-align: bottom;

    }
</style>

<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
        data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">سجل طباعة إشعار الوفاة </h3>
        </div>
        <!--end::Card title-->
    </div>

    <!--begin::Content-->
    <div id="kt_account_settings_profile_details">
        <!--begin::Form-->
        <form id="print_log_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate"
            method="POST" enctype="multipart/form-data">
            <!--begin::Card-->
            <div class="card  mb-10">
                <div class="card-body py-4">
                    <div class="row mb-6">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <label class="col-lg-3 col-form-label fw-bold fs-6">تاريخ الطباعة من</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control text-center form-control-lg mb-3 mb-lg-0"
                                        id="P_PRINT_FDATE" name="P_PRINT_FDATE" />
                                </div>
                                <span class="input-group-text">إلى</span>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control text-center form-control-lg mb-3 mb-lg-0"
                                        id="P_PRINT_TDATE" name="P_PRINT_TDATE" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!--begin::Col-->
                            <button type="button" class="btn btn-primary me-2" onclick="get_print_data()">بحث</button>
                            <button type="reset" class="btn btn-light btn-active-light-primary me-2"
                                onclick="clear_form()">تفريغ الحقول</button>
                            <!--end::Col-->
                        </div>
                    </div>

                </div>

            </div>
            <div class="card  mb-7">
                <!--begin::Card body-->
                <div class="card-body py-4">

                    <!--begin::datatable-->
                    <div class="table-responsive">
                        <table id="result_tb" class="table table-striped dt-responsive table-row-bordered gy-5 gs-7"
                            style="width:100%">
                            <thead>
                                <tr class="fw-semibold fs-6 text-muted">
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">الهوية</th>
                                    <th style="text-align: center">اسم الشهيد</th>
                                    <th style="text-align: center">الطباعة بواسطة</th>
                                    <th style="text-align: center">عنوان الجهاز</th>
                                    <th style="text-align: center">تاريخ الطباعة</th>
                                    <th style="text-align: center">هوية المستلم</th>
                                    <th style="text-align: center">مستلم الاشعار</th>
                                    <th style="text-align: center">تاريخ الاستلام </th>
                                    <th style="text-align: center">مدخل البيانات</th>

                                </tr>
                            </thead>
                            <tbody>
                            </tbody>

                        </table>
                    </div>
                    <!--end::datatable-->
                </div>
                <!--end::Card body-->
            </div>
        </form>
    </div>
</div>


@endsection
@push('scripts')
<script>
    $("#P_PRINT_FDATE").flatpickr({
            dateFormat: "Y-m-d",
        });
        $("#P_PRINT_TDATE").flatpickr({
            dateFormat: "Y-m-d",
        });


        //get result on data table
        function get_print_data() {
            var P_FROM_DATE = $('#P_PRINT_FDATE').val();
            var P_TO_DATE = $('#P_PRINT_TDATE').val();


            if (($('#P_PRINT_FDATE').val() == null || $('#P_PRINT_FDATE').val() == undefined || $('#P_PRINT_FDATE').val() ==
                    '') &&
                ($('#P_PRINT_TDATE').val() == null || $('#P_PRINT_TDATE').val() == undefined || $('#P_PRINT_TDATE').val() ==
                    '')
            ) {


                toastr.error("الرجاء إدخال البيانات  بشكل صحيح");

            } else {
                var url = "{{ route('print_logs.getprintResult') }}";
                $("#result_tb").DataTable({
                    destroy: true,

                    ajax: {
                        url: url,
                        method: 'post',
                        data: {
                            P_FROM_DATE: P_FROM_DATE,
                            P_TO_DATE: P_TO_DATE

                        },
                    },
                    initComplete: function() {
                        //console.log('true');
                    },
                    columnDefs: [{
                            bSortable: false,
                            targets: ["_all"]
                        },

                    ],
                });
            }

        }

        function clear_form() {
            $('#print_log_form')[0].reset();

        }
</script>
@endpush
