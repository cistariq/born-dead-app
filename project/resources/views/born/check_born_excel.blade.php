<meta name="csrf-token" content="{{ csrf_token() }}">
@extends('layouts.main')
@section('title', 'فحص حالات الولادة من ملف Excel')

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

        input[type=text],
        input[type=number],
        select {
            color: black;
            font-weight: bold;
        }
    </style>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- ================= رفع الملف ================= -->
    <form id="excel_upload_form" enctype="multipart/form-data">
        @csrf

        <div class="card mb-7">
            <div class="card-body">

                <div class="d-flex align-items-center">

                    <label class="col-lg-2 col-form-label required fw-bold fs-4">
                        رفع ملف Excel
                    </label>

                    <div class="col-lg-4">
                        <input type="file" name="excel_file" id="excel_file" accept=".xlsx,.xls"
                            class="form-control form-control-lg form-control-solid border border-1 border-dark">
                    </div>

                    <div class="d-flex ms-5">
                        <button type="button" class="btn btn-primary me-5" onclick="check_excel_file()">
                            فحص الملف
                        </button>

                        <button type="button" class="btn btn-outline-danger me-5" onclick="clear_excel_form()">
                            جديد
                        </button>
                    </div>

                </div>

                <!-- Spinner -->
                <div id="loading-spinner" style="display:none; text-align:center; margin:20px;">
                    <div
                        style="
                    border:10px solid #f3f3f3;
                    border-top:10px solid #3498db;
                    border-radius:50%;
                    width:70px;
                    height:70px;
                    animation:spin 1s linear infinite;
                    margin:auto;">
                    </div>
                    <div style="margin-top:10px; font-size:18px;">الرجاء الانتظار...</div>
                </div>

            </div>
        </div>
    </form>

    <!-- ================= النتائج ================= -->
    <form id="excel_result_data" style="display:none;">
        <div class="card mb-7">
            <div class="card-body">

                <div class="table-responsive">

                    <button id="exportExcelBtn" class="btn btn-success mb-3" style="display:none">
                        استخراج النتائج إلى Excel
                    </button>

                    <table id="excel_result_tb" class="table table-striped" style="width:100%">
                        <thead>
                            <tr class="fw-semibold fs-6 text-muted">
                                <th>رقم الهوية</th>
                                <th>اسم المولود</th>
                                <th>حالة الولادة</th>
                                <th>مستشفى الولادة</th>
                                <th>تاريخ الولادة</th>
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
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function check_excel_file() {

            let file = $('#excel_file')[0].files[0];

            if (!file) {
                alert('الرجاء اختيار ملف');
                return;
            }

            let formData = new FormData();
            formData.append('file', file);

            $('#loading-spinner').show();

            $.ajax({
                url: "{{ route('born.checkExcel') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,

                success: function(res) {

                    $('#loading-spinner').hide();
                    $('#excel_result_data').show();
                    $('#exportExcelBtn').show();

                    let tableBody = $('#excel_result_tb tbody');
                    tableBody.empty();

                    res.data.forEach(function(row) {

                        let color = (row.status === 'متوفر له إشعار ولادة') ? 'red' : 'green';

                        tableBody.append(`
                    <tr>
                        <td>${row.id}</td>
                        <td>${row.name}</td>
                        <td style="color:${color}; font-weight:bold">${row.type}</td>
                        <td>${row.hospital ?? '-'}</td>
                        <td>${row.date ?? '-'}</td>
                    </tr>
                `);
                    });

                    // 🔥 مهم جداً: إعادة تهيئة DataTable
                    if ($.fn.DataTable.isDataTable('#excel_result_tb')) {
                        $('#excel_result_tb').DataTable().destroy();
                    }

                    $('#excel_result_tb').DataTable({
                        pageLength: 10,
                        ordering: true,
                        searching: true,
                        lengthChange: true,
                        language: {
                            search: "بحث:",
                            lengthMenu: "عرض _MENU_ سجل",
                            info: "عرض _START_ إلى _END_ من _TOTAL_",
                            paginate: {
                                first: "الأول",
                                last: "الأخير",
                                next: "التالي",
                                previous: "السابق"
                            }
                        }
                    });
                },

                error: function() {
                    $('#loading-spinner').hide();
                    alert('حدث خطأ أثناء المعالجة');
                }
            });
        }


        // ================= تحميل Excel =================
        $('#exportExcelBtn').on('click', function(e) {

            e.preventDefault(); // 🔴 يمنع إعادة تحميل الصفحة

            let file = $('#excel_file')[0].files[0];

            if (!file) {
                Swal.fire({
                    icon: 'warning',
                    title: 'تنبيه',
                    text: 'الرجاء اختيار ملف'
                });
                return;
            }

            let formData = new FormData();
            formData.append('file', file);

            fetch("{{ route('born.exportExcel') }}", {
                    method: "POST",
                    credentials: 'same-origin',
                    body: formData
                })
                .then(async (response) => {

                    // إذا في خطأ Laravel (422 / 500)
                    if (!response.ok) {

                        const error = await response.json().catch(() => null);

                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ',
                            text: error?.message || 'حدث خطأ أثناء التصدير'
                        });

                        throw new Error('Request failed');
                    }

                    return response.blob();
                })
                .then(blob => {

                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');

                    a.href = url;
                    a.download = 'birth_results.xlsx';

                    document.body.appendChild(a);
                    a.click();
                    a.remove();

                    window.URL.revokeObjectURL(url);

                    Swal.fire({
                        icon: 'success',
                        title: 'تم التصدير',
                        text: 'تم تحميل الملف بنجاح'
                    });

                })
                .catch(error => {
                    console.error(error);
                });

        });

        // ================= تفريغ الشاشة =================
        function clear_excel_form() {

            $('#excel_file').val('');
            $('#excel_result_tb tbody').empty();
            $('#excel_result_data').hide();
            $('#exportExcelBtn').hide();
        }
    </script>

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
@endpush
