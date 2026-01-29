@extends('layouts.main')
@section('title', 'استعلام عن حالة المواطن ')

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

        .dataTables_empty {
            color: red !important;
            font-weight: bold;
        }

        .alert-signal {
            font-weight: bold;
            font-size: 16px;
            text-align: center;
            border-radius: 8px;
            padding: 10px;
            background-color: #dc3545;
            /* أحمر */
            color: white;
            animation: flash 1s infinite;
            /* تضوي وتطفي */
        }

        @keyframes flash {

            0%,
            50%,
            100% {
                opacity: 1;
            }

            /* مضوي */
            25%,
            75% {
                opacity: 0;
            }

            /* مطفي */
        }

        input[type=text] {
            color: black;
            font-weight: bold;
        }

        input[type=number] {
            color: black;
            font-weight: bold;
        }

        select {
            color: black;
            font-weight: bold;
        }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <form action="#" id="new_citizen_form">
        <!--begin::Card-->
        <div class="card mb-7">
            <!--begin::Card body-->
            <div class="card-body">

                <!--begin::Compact form-->
                <div class="d-flex align-items-center">
                    <!--begin::Input group-->
                    <label class="col-lg-2 col-form-label required fw-bold fs-4">رقم هوية المواطن
                    </label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-3">
                        <!--begin::Col-->
                        <input type="number" name="P_CITIZEN_ID" id="P_CITIZEN_ID" maxLength="9"
                            oninput="this.value=this.value.slice(0,this.maxLength)"
                            class="form-control form-control-lg mb-3 mb-lg-0 form-control-solid border border-1 border border-dark"
                            onchange="">
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                    <!--begin:Action-->
                    <div class="d-flex">
                        {{-- @if (IsPermissionBtn(42)) --}}
                        <button type="button" class="btn btn-primary me-5" onclick="check_citizen_id()">استعلام</button>
                        {{-- @endif --}}

                        <button type="button" class="btn btn-outline-danger me-5" onclick="clear_form()">جديد</button>


                    </div>
                    <!--end:Action-->
                </div>
                <!--end::Compact form-->
                <div id="loading-spinner" style="display: none; text-align: center; margin: 10px;">
                    <div class="spinner"
                        style="
        border: 10px solid #f3f3f3;
        border-top: 10px solid #3498db;
        border-radius: 50%;
        width: 70px;
        height: 70px;
        animation: spin 1s linear infinite;
        margin: auto;
    ">
                    </div>
                    <div style="margin-top: 10px; font-size: 18px;">الرجاء الانتظار...</div>
                </div>

                <style>
                    @keyframes spin {
                        0% {
                            transform: rotate(0deg);
                        }

                        100% {
                            transform: rotate(360deg);
                        }
                    }
                </style>

            </div>
            <!--end::Col-->

        </div>

    </form>
    <form action="#" id="new_citizen_data" style="display: none;">

        <div class="card mb-7">

            <!--begin::Card body-->
            <div class="card-body">

                <!--begin::datatable-->
                <div class="table-responsive">

                    <table id="result_tb" class="table table-striped table-responsive" style="width:100%">
                        <thead>
                            <tr class="fw-semibold fs-6 text-muted">
                                <th scope="col" width="5" style="text-align: center">الهوية</th>
                                <th scope="col" width="20" style="text-align: center">اسم المواطن</th>
                                <th scope="col" width="5" style="text-align: center">الجنس</th>
                                <th scope="col" width="20" style="text-align: center">تاريخ الميلاد</th>
                                <th scope="col" width="20" style="text-align: center">الحالة الإجتماعية</th>
                                <th scope="col" width="20" style="text-align: center">حالة المواطن</th>
                                <th scope="col" width="20" style="text-align: center">المحافظة</th>
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

    @endsection


    @push('scripts')
        <script>
            var block_search_dead = document.querySelector("#new_citizen_form");
            var block_search_dead = new KTBlockUI(block_search_dead);

            function check_citizen_id() {

                let citizenId = $('#P_CITIZEN_ID').val();

                if (!citizenId || citizenId.length !== 9) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'تنبيه',
                        text: 'الرجاء إدخال رقم هوية مكون من 9 أرقام',
                        confirmButtonText: 'موافق'
                    });
                    return;
                }
                var formData = {
                    P_CITIZEN_ID: citizenId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                };
                $('#loading-spinner').show();
                $('#result_tb tbody').html('');
                $('#new_citizen_data').hide();

                $.ajax({
                    url: "{{ route('dead.check_citizen_id') }}",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function(response) {

                        $('#loading-spinner').hide();

                        if (!response.success) {
                            Swal.fire({
                                icon: 'error',
                                title: 'تنبيه',
                                text: response.message,
                                confirmButtonText: 'موافق'
                            });
                            return;
                        }

                        // تحديد مصدر البيانات
                        let data = (response.status === 'dead') ? response.data[0] : response.data;

                        let statusText = response.message ?? '';

                        let GENDER = '';
                        if (data.DEAD_SEX_CD === 1 || data.DEAD_SEX_CD === '1') {
                            GENDER = 'ذكر';
                        } else if (data.DEAD_SEX_CD === 2 || data.DEAD_SEX_CD === '2') {
                            GENDER = 'أنثى';
                        }

                        let row = `
                <tr>
                    <td>${data.CITIZEN_ID ?? citizenId}</td>
                    <td>${(data.DEAD_FIRST_NAME_AR ?? data.FIRST_NAME_AR ?? '') + ' ' +
                          (data.DEAD_FATHER_NAME_AR ?? data.FATHER_NAME_AR ?? '') + ' ' +
                          (data.DEAD_GRANDFATHER_NAME_AR ?? data.GRANDFATHER_NAME_AR ?? '') + ' ' +
                          (data.DEAD_LAST_NAME_AR ?? data.LAST_NAME_AR ?? '')}</td>
                    <td>${GENDER}</td>
                    <td>${data.DEAD_DOB ?? data.BIRTH_DATE ?? ''}</td>
                    <td>${data.DEAD_MARTIAL_STATUS ?? data.MARITAL_STATUS ?? ''}</td>
                    <td><strong>${statusText}</strong></td>
                    <td>${data.DEAD_BIRTH_PLACE ?? data.BIRTH_PLACE ?? ''}</td>
                </tr>
            `;

                        $('#result_tb tbody').html(row);
                        $('#new_citizen_data').show();
                    },
                    error: function(xhr) {

                        $('#loading-spinner').hide();

                        let message = 'حدث خطأ غير متوقع أثناء الاتصال بالخادم. الرجاء المحاولة مرة أخرى.';

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ في النظام',
                            text: message,
                            confirmButtonText: 'موافق'
                        });
                    }
                });
            }

            /**************************************************************************************************************************************************************************************************/
            function clear_form() {
                $('#new_citizen_form')[0].reset();

                $('#new_citizen_form')
                    .find('input, textarea, select')
                    .val('')
                    .prop('checked', false)
                    .prop('selected', false);
                $('#new_citizen_data')[0].reset();

                $('#new_citizen_data').hide();

            }
        </script>
    @endpush
