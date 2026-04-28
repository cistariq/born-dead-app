    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

    @extends('layouts.main')
    @section('title', 'استعلام سجل النشاطات على النظام ')

    @section('content')
        <style>
            /* اجعل السطر العلوي flex وفرق بين العناصر */
            .dt-top-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            /* اجعل خانة البحث على أقصى اليمين */
            .dataTables_filter {
                margin: 0;
            }

            .dataTables_length {
                margin: 0;
            }
        </style>
        <div class="card mb-5 mb-xl-10">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="fw-bolder m-0">معايير البحث</h3>
                </div>
            </div>

            <div class="card-body">
                <form id="search_form" class="form" novalidate="novalidate">
                    @csrf
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-bold fs-6">رقم الهوية</label>
                        <div class="col-lg-2">
                            <input type="number" id="P_ID" class="form-control text-center form-control-lg"
                                placeholder="رقم الهوية">
                        </div>

                        <label class="col-lg-1 col-form-label fw-bold fs-6">المستخدم</label>
                        <div class="col-lg-3">
                            <select class="form-select" data-control="select2" id="P_USER_NO"
                                data-placeholder="اختر المستخدم" data-allow-clear="true">
                                <option></option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->user_full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-6 align-items-center">
                        <label class="col-lg-2 col-form-label fw-bold fs-6">ت.الحدث من</label>
                        <div class="col-lg-2">
                            <input type="text" class="form-control text-center" id="P_DATE_FROM" name="P_DATE_FROM">
                        </div>

                        <label class="col-lg-1 col-form-label fw-bold fs-6 text-center">إلى</label>
                        <div class="col-lg-2">
                            <input type="text" class="form-control text-center" id="P_DATE_TO" name="P_DATE_TO">
                        </div>

                        <div class="col-lg-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">بحث</button>
                            <button type="reset" class="btn btn-light">تفريغ</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div class="card mb-5">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="fw-bolder m-0">نتائج البحث</h3>
                </div>

                <div class="card-toolbar">
                    @if (IsPermissionBtn(22))
                        <button class="btn btn-success" type="button" onclick="exports_excel();" style="display: none"
                            id="exportExcelBtn">
                            <i class="fa fa-file"></i> تحميل اكسل
                        </button>
                    @endif
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="result_tb" class="table table-striped" style="width:100%">
                        <thead>
                            <tr class="fw-semibold fs-6 text-muted">
                                <th style="text-align: center">#</th>
                                <th style="text-align: center">هوية المستخدم</th>
                                <th style="text-align: center">اسم المستخدم</th>
                                <th style="text-align: center">تاريخ الحدث</th>
                                <th style="text-align: center">نوع الإجراء</th>
                                <th style="text-align: center">جدول الحدث</th>
                                <th style="text-align: center">الحقل</th>
                                <th style="text-align: center">القيمة السابقة</th>
                                <th style="text-align: center">القيمة الجديدة</th>
                                <th style="text-align: center">سبب التعديل</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
    @push('scripts')
        <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/xlsx.full.min.js') }}"></script>
        <script>
            $("#P_DATE_FROM").flatpickr({
                dateFormat: "d/m/Y",
                maxDate: new Date(),
            });

            $("#P_DATE_TO").flatpickr({
                dateFormat: "d/m/Y",
                maxDate: new Date(),
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let tableInstance; // حفظ DataTable instance

            $('#search_form').on('submit', function(e) {
                e.preventDefault();

                let formData = {
                    P_ID: $('#P_ID').val(),
                    P_USER_NO: $('#P_USER_NO').val(),
                    P_DATE_FROM: $('#P_DATE_FROM').val(),
                    P_DATE_TO: $('#P_DATE_TO').val()
                };

                $.ajax({
                    url: "{{ route('logs.search') }}",
                    type: "POST",
                    dataType: "json",
                    data: formData,
                    beforeSend: function() {
                        $('#result_tb tbody').html(`
                <tr><td colspan="10" class="text-center">جاري التحميل...</td></tr>
            `);
                    },
                    success: function(res) {

                        let html = '';
                        $('#exportExcelBtn').hide();

                        let data = res.data || [];

                        if (data.length > 0) {
                            $('#exportExcelBtn').show();

                            data.forEach((row, index) => {
                                html += `
                        <tr>
                            <td class="text-center">${index + 1}</td>
                            <td class="text-center">${row.USER_ID ?? ''}</td>
                            <td class="text-center">${row.USER_FULL_NAME ?? ''}</td>
                            <td class="text-center">${row.CREATED_AT ?? ''}</td>
                            <td class="text-center">${row.TYPE_ACTION ?? ''}</td>
                            <td class="text-center">${row.TABLE_NAME ?? ''}</td>
                            <td class="text-center">${row.COLUMN_NAME ?? ''}</td>
                            <td class="text-center">${formatJson(row.OLD_VALUE)}</td>
                            <td class="text-center">${formatJson(row.NEW_VALUE)}</td>
                            <td class="text-center">${row.UPDATE_REASON ?? ''}</td>
                        </tr>
                    `;
                            });
                        } else {
                            html = `<tr><td colspan="10" class="text-center">لا توجد بيانات</td></tr>`;
                        }

                        $('#result_tb tbody').html(html);

                        // 🔥 إعادة تهيئة DataTable
                        if ($.fn.DataTable.isDataTable('#result_tb')) {
                            tableInstance.destroy();
                        }
                        tableInstance = $('#result_tb').DataTable({
                            pageLength: 10,
                            ordering: true,
                            searching: true,
                            lengthChange: true,
                            dom: "<'row mb-3'<'col-sm-6'l><'col-sm-6 text-end'f>>" +
                                // السطر الأول: العدد على اليسار والبحث على أقصى اليمين
                                "t" + // الجدول
                                "<'row'<'col-sm-12'i><'col-sm-12'p>>", // info + pagination
                            language: {
                                search: "بحث:",
                                lengthMenu: "عرض _MENU_ سجل",
                                info: "عرض _START_ إلى _END_ من _TOTAL_",
                                paginate: {
                                    first: "الأول",
                                    last: "الأخير",
                                    next: "التالي",
                                    previous: "السابق"
                                },
                                emptyTable: "لا توجد بيانات"
                            }
                        });

                    },
                    error: function() {
                        $('#result_tb tbody').html(`
                <tr><td colspan="10" class="text-center text-danger">حدث خطأ</td></tr>
            `);
                    }
                });
            });



            // ================= تحميل Excel =================
            $('#exportExcelBtn').on('click', function(e) {
                e.preventDefault();

                let table = $('#result_tb').DataTable(); // تحويل الجدول إلى DataTable instance

                let allRows = table.rows({
                    search: 'applied'
                }).nodes(); // جميع الصفوف المفلترة

                if (!allRows.length) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'تنبيه',
                        text: 'لا توجد بيانات للتصدير'
                    });
                    return;
                }

                // إنشاء جدول مؤقت
                let tempTable = document.createElement('table');
                tempTable.innerHTML = $('#result_tb thead').prop('outerHTML'); // رأس الجدول

                $(allRows).each(function() {
                    tempTable.appendChild(this.cloneNode(true));
                });

                // تحويل الجدول إلى Excel
                let wb = XLSX.utils.table_to_book(tempTable, {
                    sheet: "Logs"
                });
                let wbout = XLSX.write(wb, {
                    bookType: 'xlsx',
                    type: 'array'
                });
                let blob = new Blob([wbout], {
                    type: "application/octet-stream"
                });

                // تنزيل الملف
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'logs.xlsx';
                document.body.appendChild(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);

                Swal.fire({
                    icon: 'success',
                    title: 'تم التصدير',
                    text: 'تم تحميل الملف بنجاح'
                });
            });

            function formatJson(data) {
                if (!data) return '';

                // إذا كانت string (أحياناً ترجع string)
                if (typeof data === 'string') {
                    try {
                        data = JSON.parse(data);
                    } catch (e) {
                        return data;
                    }
                }

                // إذا object → نحوله لعرض مرتب
                let html = '<div style="text-align:right">';
                for (let key in data) {
                    html += `<div><b>${key}</b>: ${data[key] ?? ''}</div>`;
                }
                html += '</div>';

                return html;
            }
        </script>
    @endpush
