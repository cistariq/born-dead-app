@extends('layouts.main')
@section('title', 'تقديم طلب ')

@section('content')
<style>
    .mt-n1 {
        margin-top: 10px !important;
    }
</style>
<form action="#" id="appliction_form">
    <!--begin::Card-->
    <div class="card mb-7">
        <!--begin::Card body-->
        <div class="card-body">
            <form id="search_appliction_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                novalidate="novalidate">
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-2 col-form-label required fw-bold fs-6">رقم هوية المتوفي/ة</label>
                        <div class="col-lg-2">
                            <input type="text" name="P_ID" id="P_ID" class="form-control form-control-lg mb-3 mb-lg-0">
                        </div>
                        <!--end::Col-->
                        <label class="col-lg-2 col-form-label required fw-bold fs-6">تاريخ تقديم الطلب</label>
                        <div class="col-lg-2">
                            <input type="date" name="P_INSERT_DATE" id="P_INSERT_DATE" class="form-control form-control-lg mb-3 mb-lg-0">
                        </div>
                        <div class="col-lg-1">
                            <div class="form-check form-check-custom mt-2">
                                <input class="form-check-input" type="checkbox" value="" id="found_checkbox" />
                                <label class="form-check-label" for="found_checkbox">
                                    له سجل
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-2">
                        <div class="form-check form-check-custom mt-2">
                            <input class="form-check-input" type="checkbox" value="" id="not_print_checkbox" />
                            <label class="form-check-label" for="not_print_checkbox">
                                غير مطبوع
                            </label>
                        </div>
                        </div>
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card body-->
                <!--begin::Actions-->
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="button" class="btn btn-primary me-2" onclick="get_result_data()">بحث</button>
                    @if (IsPermissionBtn(5))
                    <button type="button" class="btn btn-primary me-2"
                            onclick="add_new_application()">إدخال</button>
                    @endif
                </div>
                <!--end::Actions-->
                <input type="hidden">
                <div></div>
            </form>
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
                            <th>الهوية</th>
                            <th>اسم الشهيد</th>
                            <th>هوية مقدم الطلب</th>
                            <th>اسم مقدم الطلب</th>
                            <th>رقم الجوال</th>
                            <th>ملاحظات</th>
                            <th>تاريخ تقديم الطلب</th>
                            <th>عدد مرات الطباعة</th>
                            <th>موجود</th>
                            <th>المرجع</th>
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
    </div>
    <!--end::Card body-->
    </div>
    <!--end::Card-->
    @include('dead.application.add_application_modal')
</form>

@endsection
@push('scripts')
<script>
    //get result on data table
    function get_result_data() {
        var P_ID = $('#P_ID').val();
        var P_INSERT_DATE = $('#P_INSERT_DATE').val();
        var found_checkbox = $('#found_checkbox').is(":checked");
        var not_print_checkbox = $('#not_print_checkbox').is(":checked");

        var url = "{{ route('dead.applications.getDataResult') }}";
            $("#result_tb").DataTable({
                destroy: true,
                ajax: {
                    url: url,
                    method: 'post',
                    data: {
                        P_ID: P_ID,
                        P_INSERT_DATE:P_INSERT_DATE,
                        found_checkbox:found_checkbox,
                        not_print_checkbox:not_print_checkbox
                    },
                },
                initComplete: function() {
                    //console.log('true');
                }
            });

    }

    function add_new_application()
    {
        clear_form_application();
        $('#newApplicationModal').modal('show');
    }

</script>
@endpush
