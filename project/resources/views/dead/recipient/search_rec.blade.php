@extends('layouts.main')
@section('title', 'استعلام تسليم الاشعارات ')

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
                <h3 class="fw-bolder m-0">استعلام جديد</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div id="kt_account_settings_profile_details">
            <!--begin::Form-->
            <form id="search_rec_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-2 col-form-label fw-bold fs-6">المنطقة</label>
                        <div class="col-lg-2 fv-row">
                            <select id="P_city_id" name="P_city_id" data-control="select2" data-placeholder="اختر ..."
                                class="form-select form-select-lg fw-bold">
                                <option></option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-6">

                        <!--begin::Label-->
                        <label class="col-lg-2 col-form-label fw-bold fs-6">رقم هوية الشهيد</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-2">
                            <!--begin::Col-->
                            <input type="number" name="P_MartyrID" id="P_MartyrID" maxLength="9"
                                oninput="this.value=this.value.slice(0,this.maxLength)"
                                class="form-control text-center form-control-lg mb-3 mb-lg-0" placeholder="هوية الشهيد">
                            <!--end::Col-->
                        </div>
                        <label class="col-lg-2 col-form-label fw-bold fs-6">رقم هوية المستلم</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-2">
                            <!--begin::Col-->
                            <input type="number" name="P_RecipientID" id="P_RecipientID" maxLength="9"
                                oninput="this.value=this.value.slice(0,this.maxLength)"
                                class="form-control text-center form-control-lg mb-3 mb-lg-0" placeholder="هوية المستلم">
                            <!--end::Col-->
                        </div>
                        <!--end::Col-->
                        <div class="col-lg-4">
                            <!--begin::Col-->
                            <button type="button" class="btn btn-primary me-2" onclick="getRecipientInfoBy()">بحث</button>
                            <button type="reset" class="btn btn-light btn-active-light-primary me-2"
                                onclick="clear_form()">تفريغ الحقول</button>
                            <!--end::Col-->
                        </div>
                    </div>
                </div>
                <!--end::Input group-->
                <div class="card mb-10">

                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_profile_details" aria-expanded="true"
                        aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">نتائج البحث</h3>
                        </div>
                        <div class="col-lg-2" style="left: -100px">
                            <a class="btn btn-warning me-2" href="{{ route('dead.recipient.export_excel') }}"> استخراج ملف
                                اكسل
                            </a>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <div class="card-body">
                        <!--begin::datatable-->

                        <div class="table-responsive">
                            <table id="result_tb" class="table table-striped dt-responsive table-row-bordered gy-5 gs-7"
                                style="width:100%">
                                <thead>
                                    <tr class="fw-semibold fs-6 text-muted">
                                        <th style="text-align: center">#</th>
                                        <th style="text-align: center">هوية الشهيد</th>
                                        <th style="text-align: center">اسم الشهيد </th>
                                        <th style="text-align: center">المنطقة</th>
                                        <th style="text-align: center">هوية المستلم</th>
                                        <th style="text-align: center">اسم المستلم </th>
                                        <th style="text-align: center">جوال المستلم </th>
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
            </form>
            <!--end::Form-->
        </div>
        <!--end::Content-->
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

        });

        function clear_form() {
            $('#search_rec_form')[0].reset();
            $('#P_city_id').val('').change();
            $('#result_tb').DataTable().destroy();
            $('#result_tb tbody').empty();

        }

        function getRecipientInfoBy() {

            if (($('#P_city_id').val() == null || $('#P_city_id').val() == undefined || $('#P_city_id').val() == '') &&
                ($('#P_MartyrID').val() == null || $('#P_MartyrID').val() == undefined || $('#P_MartyrID').val() == '') &&
                ($('#P_RecipientID').val() == null || $('#P_RecipientID').val() == undefined || $('#P_RecipientID').val() ==
                    '')
            ) {
                toastr.error("يجب إدخال أحد معايير البحث");
            } else {
                var IN_CITY_NO = $('#P_city_id').val();
                var IN_MARTYR_ID = $('#P_MartyrID').val();
                var IN_RECIPIENT_ID = $('#P_RecipientID').val();
                var url = "{{ route('dead.recipient.getRecipient_Info') }}";
                $("#result_tb").DataTable({
                    destroy: true,

                    ajax: {
                        url: url,
                        method: 'post',
                        data: {
                            'city_no': IN_CITY_NO,
                            'martyr_id': IN_MARTYR_ID,
                            'recipient_id': IN_RECIPIENT_ID
                        },
                    },
                    initComplete: function() {
                        //console.log('true');
                    },
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, 'All']
                    ],
                    columnDefs: [{
                        bSortable: false,
                        targets: ["_all"]
                    }, ],
                });
            }
        }



        function exports_excel() {
            var IN_CITY_NO = $('#P_city_id').val();
            var IN_MARTYR_ID = $('#P_MartyrID').val();
            var IN_RECIPIENT_ID = $('#P_RecipientID').val();
            var url = "{{ route('dead.recipient.export_excel') }}";
            $.ajax({
                type: 'get',
                url: url,
                data: {
                    'city_no': IN_CITY_NO,
                    'martyr_id': IN_MARTYR_ID,
                    'recipient_id': IN_RECIPIENT_ID
                },
                success: function(data) {
                    console.log(data);
                    // alert('success excel downloaded');
                }
            });
        }
    </script>
@endpush
