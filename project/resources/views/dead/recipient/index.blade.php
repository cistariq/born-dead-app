@extends('layouts.main')
@section('title', 'تسجيل مستلم')

@section('content')

    <form action="#" id="dead_form">
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
                        <input type="text" class="form-control form-control-solid ps-10" name="search" id="P_ID"
                            value="" placeholder="رقم الهوية">

                    </div>
                    <!--end::Input group-->
                    <!--begin:Action-->
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-primary me-5" onclick="get_result_data();">بحث</button>
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
                                <th>الهوية</th>
                                <th>اسم الشهيد</th>
                                <th>تاريخ الاستشهاد</th>
                                <th>هوية المستلم</th>
                                <th>اسم المستلم</th>
                                <th>تاريخ الطباعة</th>
                                <th>تسليم</th>
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
        <div class="modal fade" tabindex="-1" id="InsertRecipientModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">تسجيل مستلم </h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">

                            <span class="svg-icon svg-icon-2x"></span>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="P_REQ_SEQ" readonly/>
                        <div class="row mb-4">
                            <label class="col-form-label fw-bold col-lg-4">رقم هوية المستلم</label>
                            <div class="col-lg-8">
                                <input type="number" class="form-control" id="recipient_id_no" maxLength="9"
                                oninput="this.value=this.value.slice(0,this.maxLength)"
                                onchange="getPersonalInfoBy(this,$('#recipient_name'))" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-form-label fw-bold col-lg-4">اسم المستلم</label>
                            <div class="col-lg-8">
                                <input class="form-control" type="text"
                                    id="recipient_name" />
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">إغلاق</button>
                        <button type="button" class="btn btn-primary" onclick="InsertRecipient();">حفظ التعديل</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Example End-->
    </form>

@endsection
@push('scripts')
    <script>
       //  var target = document.querySelector("#modal-body");
      //  var blockUI = new KTBlockUI(target);
        //datepicker
        //get result on data table
        function get_result_data() {
            var P_ID = $('#P_ID').val();

            if (($('#P_ID').val() == null || $('#P_ID').val() == undefined || $('#P_ID').val() == '')) {
              toastr.error("أدخل رقم الهوية بشكل صحيح");
            } else {
                var url = "{{ route('dead.recipient.getDataResult') }}";
                $("#result_tb").DataTable({
                    destroy: true,
                    ajax: {
                        url: url,
                        method: 'post',
                        data: {
                            P_ID: P_ID,
                        },
                    },
                    initComplete: function() {
                        //console.log('true');
                    }
                });
            }

        }

        function insertRecipient(req_seq) {
            $('#P_REQ_SEQ').val(req_seq);
            $('#InsertRecipientModal').modal('show');
        }

        function InsertRecipient() {
            var P_REQ_SEQ = $('#P_REQ_SEQ').val();
            var recipient_id_no = $('#recipient_id_no').val();
            var recipient_name = $('#recipient_name').val();
            var url = "{{ route('dead.recipient.update') }}";

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    rec_seq: P_REQ_SEQ,
                    recipient_id_no: recipient_id_no,
                    recipient_name: recipient_name,
                },
            }).done(function(response) {
                console.log(response);
                if (response.success == true) {
                    $('#InsertRecipientModal').modal('hide');
                    get_result_data();
                    toastr.success(response.results.message);
                    $('#recipient_id_no').val('');
                    $('#recipient_name').val('');
                } else {
                    toastr.error(response.results.message);
                }
            });
        }

        function print_dead(id_no) {
            var url = "{{ route('dead.print_dead') }}";
            $.ajax({
                url: url,
                method: 'post',
                data: {
                    P_ID: id_no
                },
            }).done(function(response) {
                if (response.success != true) {
                    Swal.fire({
                        title: 'خطأ!',
                        text: response.results.message,
                        icon: "{{ session('m-class', 'error') }}",
                    })
                } else {
                    var red_url = '{{ route('dead.print_dead_notic', ':id_no') }}';
                    red_url = red_url.replace(':id_no', id_no);
                    window.open(red_url, true);
                }
            });
        }

        // function more_search() {
        //     const x = document.getElementById('more_search');
        //     if (x.style.display === "none") {
        //         x.style.display = "block";
        //     } else {
        //         x.style.display = "none";
        //     }

        // }

        function getPersonalInfoBy(e,id){
        var P_ID_NO = e.value;
        if(P_ID_NO){
           // blockUI.block();
            var url = "{{route('constant.getPersonalInfoByIdNo')}}";
            $.ajax({
                url: url,
                type:'json',
                method: 'post',
                data: {'id_no' : P_ID_NO },
            }).done(function (response) {
                console.log(response);
                if(response.success){
                    if(response.success == 1){
                        id.val(response.results.fname+' '+response.results.sname+' '+
                            response.results.tname+' '+response.results.lname
                        );
                    }
                }else{
                    console.log(response);
                    $message = "";
                    $.each(response.errors, function (key, value) {
                        console.log(value);
                        console.log(key);
                        $message += value.join('-') + "\r\n";
                    });
                    Swal.fire({
                        title:  'خطأ !',
                        text: $message,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
               // blockUI.release();
            });
        }
    }
        function clear_form() {
            $('#dead_form')[0].reset();

            $('.form-select').val(' ').trigger('change');
            App.unblockUI('#dead_form');
            $('.form-select').closest('.form-group').removeClass('has-error').removeClass('has-success');

        }

    </script>
@endpush
