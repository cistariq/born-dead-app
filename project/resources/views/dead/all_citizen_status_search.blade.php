@extends('layouts.main')
@section('title', 'فحص شامل لحالة المواطنين من ملف Excel')

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
    <form action="#" id="excel_upload_form" enctype="multipart/form-data">
        @csrf
        <div class="card mb-7">
            <div class="card-body">

                <div class="d-flex align-items-center">
                    <label class="col-lg-2 col-form-label required fw-bold fs-4">رفع ملف Excel</label>

                    <div class="col-lg-4">
                        <input type="file" name="excel_file" id="excel_file" accept=".xlsx,.xls"
                            class="form-control form-control-lg form-control-solid border border-1 border-dark">
                    </div>

                    <div class="d-flex ms-5">
                        <button type="button" class="btn btn-primary me-5" onclick="check_excel_file()">فحص الملف</button>
                        <button type="button" class="btn btn-outline-danger me-5"
                            onclick="clear_excel_form()">جديد</button>
                    </div>
                </div>

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
        </div>
    </form>

    <form action="#" id="excel_result_data" style="display: none;">
        <div class="card mb-7">
            <div class="card-body">
                <div class="table-responsive">
                    <button id="exportExcelBtn" class="btn btn-success" style="display:none">
                        استخراج النتائج إلى Excel
                    </button>
                    <table id="excel_result_tb" class="table table-striped table-responsive" style="width:100%">
                        <thead>
                            <tr class="fw-semibold fs-6 text-muted">
                                <th style="text-align:center">رقم الهوية</th>
                                <th style="text-align:center">الاسم</th>
                                <th style="text-align:center">الجنس</th>
                                <th style="text-align:center">تاريخ الميلاد</th>
                                <th style="text-align:center">الحالة الاجتماعية</th>
                                <th style="text-align:center">حالة المواطن</th>
                                <th style="text-align:center">المحافظة</th>
                                <th style="text-align:center">ملاحظات</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>

@endsection


@push('scripts')

    <script src="{{ asset('assets/js/xlsx.full.min.js') }}"></script>

    <script>
        var block_insert_dead = document.querySelector("#excel_upload_form");
        var block_insert_dead_ui = new KTBlockUI(block_insert_dead);

        function check_excel_file() {
            block_insert_dead_ui.block();

            let fileInput = document.getElementById('excel_file');

            if (!fileInput.files.length) {
                Swal.fire({
                    icon: 'warning',
                    title: 'تنبيه',
                    text: 'الرجاء اختيار ملف Excel أولاً',
                    confirmButtonText: 'موافق'
                });
                block_insert_dead_ui.release();
                return;
            }

            let formData = new FormData();
            formData.append('excel_file', fileInput.files[0]);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

            $('#loading-spinner').show();
            $('#excel_result_tb tbody').html('');
            $('#excel_result_data').hide();

            $.ajax({
                url: "{{ route('dead.check_excel_file') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
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
                        block_insert_dead_ui.release();
                        return;
                    }

                    let rows = '';
                    response.data.forEach(item => {

                        let GENDER = '';
                        if (item.DEAD_SEX_CD === 1 || item.DEAD_SEX_CD === '1') GENDER = 'ذكر';
                        else if (item.DEAD_SEX_CD === 2 || item.DEAD_SEX_CD === '2') GENDER = 'أنثى';

                        rows += `
                    <tr>
                        <td>${item.CITIZEN_ID ?? ''}</td>
                        <td>${item.FULL_NAME ?? ''}</td>
                        <td>${GENDER}</td>
                        <td>${item.DOB ?? ''}</td>
                        <td>${item.MARITAL_STATUS ?? ''}</td>
                        <td><strong>${item.STATUS_TEXT ?? ''}</strong></td>
                        <td>${item.BIRTH_PLACE ?? ''}</td>
                        <td>${item.NOTE ?? ''}</td>
                    </tr>
                `;
                    });

                    $('#excel_result_tb tbody').html(rows);
                    $('#excel_result_data').show();
                    $('#exportExcelBtn').show();
                    block_insert_dead_ui.release();
                },
                error: function(xhr) {
                    $('#loading-spinner').hide();
                    let message = 'حدث خطأ غير متوقع أثناء الاتصال بالخادم.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ في النظام',
                        text: message,
                        confirmButtonText: 'موافق'
                    });
                    block_insert_dead_ui.release();
                }
            });
        }


        function clear_excel_form() {
            $('#excel_file').val('');
            $('#excel_result_tb tbody').html('');
            $('#excel_result_data').hide();
            $('#exportExcelBtn').hide();
        }
        document.getElementById('exportExcelBtn').addEventListener('click', function() {

            let table = document.getElementById('excel_result_tb');

            if (!table || table.rows.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'تنبيه',
                    text: 'لا توجد بيانات لتصديرها.',
                    confirmButtonText: 'موافق'
                });
                return;
            }

            // إنشاء ورقة Excel من الجدول
            let workbook = XLSX.utils.book_new();
            let worksheet = XLSX.utils.table_to_sheet(table);

            // اسم الورقة والملف
            XLSX.utils.book_append_sheet(workbook, worksheet, "نتائج_التحقق");
            XLSX.writeFile(workbook, "نتائج_ملف_الوفيات.xlsx");
        });
    </script>
@endpush
