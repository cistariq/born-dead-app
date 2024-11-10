@extends('layouts.main')
@section('title', 'مسح ضوئي لإشعار الوفاة')

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
                <h3 class="fw-bolder m-0">إضافة مرفق جديد</h3>
            </div>
            <!--end::Card title-->
        </div>

        <!--begin::Content-->
        <div id="kt_account_settings_profile_details">
            <!--begin::Form-->
            <form id="scan_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate"
                method="POST" enctype="multipart/form-data">
                <!--begin::Card-->
                <div class="card  mb-7">
                    <div class="card-body py-4">

                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-2 col-form-label required fw-bold fs-6">رقم الهوية</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-2">
                                <!--begin::Col-->
                                <input type="number" name="ID_NO" id="ID_NO" maxLength="9"
                                    oninput="this.value=this.value.slice(0,this.maxLength)"
                                    class="form-control form-control-lg mb-3 mb-lg-0">
                                <!--end::Col-->
                            </div>
                            <div class="col-lg-4">
                                @if (IsPermissionBtn(6))
                                <!--begin::Col-->
                                <input type="file" name="image" id="image" accept="image/jpg,application/pdf"
                                    class="form-control form-control-lg mb-3 mb-lg-0">
                                <!--end::Col-->
                                @endif
                            </div>
                            <div class="col-lg-4">
                                <!--begin::Col-->
                                @if (IsPermissionBtn(6))
                                    <button type="button" class="btn btn-primary me-2" onclick="save_upload_file()">إضافة
                                        مرفق</button>
                                @endif
                                <button type="button" class="btn btn-dark me-2"
                                    onclick="get_attachment_data()">بحث</button>
                                <button type="reset" class="btn btn-light btn-active-light-primary me-2"
                                    onclick="clear_form()">تفريغ الحقول</button>
                                <!--end::Col-->
                            </div>
                        </div>

                    </div>
                    <div class="card-body py-2">

                        <!--begin::Input group-->
                        <div class="input-group col-lg-4">
                            <label class="col-lg-2 col-form-label fw-bold fs-6">تاريخ الاضافة من</label>
                            <div class="col-lg-2">

                                <input type="text" class="form-control text-center form-control-lg mb-3 mb-lg-0"
                                    id="P_PRINT_FDATE" name="P_PRINT_FDATE" />
                            </div>
                            <span class="input-group-text">إلى</span>
                            <div class="col-lg-2">
                                <input type="text" class="form-control text-center form-control-lg mb-3 mb-lg-0"
                                    id="P_PRINT_TDATE" name="P_PRINT_TDATE" />
                            </div>
                        </div>
                        <!--end::Input group-->

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
                                        <th style="text-align: center">تاريخ الاضافة</th>
                                        <th style="text-align: center">المرفقات</th>

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

        function save_upload_file() {
            let form_date = new FormData($('#scan_form')[0]);
            var url = "{{ route('scan_file.storefile') }}";
            console.log('true');
            $.ajax({
                url: url,
                method: 'post',
                cache: false,
                processData: false,
                contentType: false,
                data: form_date,
            }).done(function(response) {
                console.log(response);
                if (response.success) {
                    if (response.success == 1) {
                        Swal.fire({
                            title: 'تمت العملية بنجاح !',
                            text: response.results.message,
                            icon: "success",
                            confirmButtonText: 'موافق'
                        });
                        $('#scan_form')[0].reset();
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
                        title: 'خطأ !',
                        text: $message,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            });
        }

        //get result on data table
        function get_attachment_data() {
            var P_ID = $('#ID_NO').val();
            var P_FROM_DATE = $('#P_PRINT_FDATE').val();
            var P_TO_DATE = $('#P_PRINT_TDATE').val();


            if (($('#ID_NO').val() == null || $('#ID_NO').val() == undefined || $('#ID_NO').val() == '') &&
            ($('#P_PRINT_FDATE').val() == null || $('#P_PRINT_FDATE').val() == undefined || $('#P_PRINT_FDATE').val() == '') &&
            ($('#P_PRINT_TDATE').val() == null || $('#P_PRINT_TDATE').val() == undefined || $('#P_PRINT_TDATE').val() == '')
             ){


                toastr.error("الرجاء إدخال البيانات  بشكل صحيح");

            } else {
                var url = "{{ route('scan_file.getscanResult') }}";
                $("#result_tb").DataTable({
                    destroy: true,

                    ajax: {
                        url: url,
                        method: 'post',
                        data: {
                            P_ID: P_ID,
                            P_FROM_DATE:P_FROM_DATE,
                            P_TO_DATE:P_TO_DATE

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
        function delete_file(id_no){
            Swal.fire({
                title: "هل تريد بالتأكيد حذف المرفق لهوية رقم "+id_no,
                showDenyButton: true,
                confirmButtonText: "تأكيد الحذف",
                denyButtonText: `إلغاء`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var url = "{{ route('scan_file.deleteFile') }}";
                    $.ajax({
                        url: url,
                        method: 'post',
                        data: {
                            id_no: id_no
                        },
                    }).done(function(response) {
                        if (response.success) {
                            Swal.fire({
                            title: 'تمت العملية بنجاح !',
                            text: response.results,
                            icon: "success",
                            confirmButtonText: 'موافق'
                            });
                            get_attachment_data();
                        } else {
                            Swal.fire({
                                title: 'خطأ!',
                                text: response.errors,
                                icon: "{{ session('m-class', 'error') }}",
                            })
                        }
                    });
                }
            });


        }
    </script>
@endpush
