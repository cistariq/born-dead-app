<meta name="csrf-token" content="{{ csrf_token() }}">

@extends('layouts.main')
@section('title', 'تعديل طبيعة الوفاة')

@section('content')
    <style>
        #result_tb th,
        #result_tb td {
            text-align: center;
            vertical-align: middle;
            /* إذا أردت ضبط عمودي */
        }

        /* خلي الـ popup مرن */
        .swal2-popup {
            display: flex !important;
            flex-direction: column !important;
            max-height: 90vh !important;
        }

        /* المحتوى يتمدد */
        .swal2-html-container {
            flex: 1 !important;
            overflow: visible !important;
        }

        /* الفورم */
        .swal-form-container {
            text-align: right;
        }

        .swal-label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
        }

        /* textarea ما تكبر زيادة */
        #swal_reason {
            height: 100px !important;
        }

        /* ⭐ تثبيت الأزرار بالأسفل */
        .swal2-actions {
            margin-top: 35px !important;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
    </style>

    <div class="card mb-5">
        <div class="card-body d-flex align-items-center">

            <label class="me-3">رقم الهوية</label>

            <input type="text" id="P_ID" class="form-control w-250px me-3" maxlength="9">

            <button class="btn btn-primary" onclick="search_data()">بحث</button>

        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <table id="result_tb" class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>السجل</th>
                        <th>الهوية</th>
                        <th>الاسم</th>
                        <th>نوع الوفاة</th>
                        <th>تاريخ الوفاة</th>
                        <th>كود الوفاة</th>
                        <th>سبب الوفاة</th>
                        <th>الإجراء</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

        </div>
    </div>

@endsection
@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#result_tb').on('xhr.dt', function(e, settings, json, xhr) {
            $('meta[name="csrf-token"]').attr('content', json.csrfToken);
        });

        function search_data() {
            let P_ID = $('#P_ID').val();

            if (!P_ID) {
                Swal.fire('تنبيه', 'ادخل رقم الهوية', 'info');
                return;
            }

            // إذا كانت هناك DataTable موجودة، دمّرها قبل إعادة الإنشاء
            $('#result_tb').DataTable().destroy();
            $.fn.dataTable.ext.errMode = 'none';
            $('#result_tb').on('error.dt', function(e, settings, techNote, message) {
                console.log('An error has been reported by DataTables: ', message);
            });

            $('#result_tb').DataTable({
                processing: true, // علامة التحميل
                serverSide: false, // ← هنا false
                paging: true,
                pageLength: 10, // عدد الصفوف في كل صفحة
                lengthMenu: [5, 10, 20, 50],

                ajax: {
                    url: "{{ route('dead.searchById') }}",
                    type: "POST",
                    data: function(d) {
                        d.P_ID = P_ID;
                        d._token = $('meta[name="csrf-token"]').attr('content'); // تمرير CSRF token
                    }
                },

                columns: [{
                        data: 'dead_code',
                        name: 'dead_code'
                    },
                    {
                        data: 'dead_id',
                        name: 'dead_id'
                    },
                    {
                        data: 'full_name',
                        name: 'full_name'
                    },
                    {
                        data: 'source_name',
                        name: 'source_name',
                        render: function(data) {
                            return `<span class="badge bg-info">${data}</span>`;
                        }
                    },
                    {
                        data: 'dead_dod',
                        name: 'dead_dod'
                    },
                    {
                        data: 'cause_code',
                        name: 'cause_code'
                    },
                    {
                        data: 'dead_cause',
                        name: 'dead_cause'
                    },

                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            if (data.allow_edit == 1) {
                                return `<button class="btn btn-warning btn-sm"
                                    onclick="update_source(${data.dead_id}, ${data.source})">
                                    تعديل
                                </button>`;
                            } else {
                                return `<span class="text-danger">غير مسموح</span>`;
                            }
                        }
                    },
                ],

                order: [
                    [4, 'desc']
                ], // ترتيب حسب DEAD_DOD تنازلي
                responsive: true
            });
        }

        function update_source(DEAD_ID, currentSource) {

            Swal.fire({
                title: 'تعديل نوع الوفاة',
                width: 650,
                heightAuto: false,

                html: `
            <div style="text-align:right; width:100%;">

                <label style="font-weight:bold; display:block; margin-bottom:6px;">
                    نوع الوفاة
                </label>

                <select id="swal_source"
                        class="swal2-input"
                        style="width:100%; margin-bottom:15px;">
                    <option value="0">وفاة طبيعية</option>
                    <option value="1">شهيد</option>
                    <option value="2">وفاة طبيعية - لجنة</option>
                    <option value="3">شهيد غير مباشر</option>
                </select>

                <label style="font-weight:bold; display:block; margin-bottom:6px;">
                    سبب التعديل
                </label>

                <textarea id="swal_reason"
                          class="swal2-textarea"
                          placeholder="اكتب سبب التعديل هنا..."
                          style="width:100%; height:120px; resize:none;"></textarea>

            </div>
        `,

                showCancelButton: true,
                confirmButtonText: 'حفظ',
                cancelButtonText: 'إلغاء',

                didOpen: () => {
                    $('#swal_source').val(currentSource);
                },

                preConfirm: () => {

                    let source = $('#swal_source').val();
                    let reason = $('#swal_reason').val();

                    if (!reason) {
                        Swal.showValidationMessage('يجب إدخال سبب التعديل');
                        return false;
                    }

                    return {
                        source: source,
                        reason: reason
                    };
                }

            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ route('dead.updateSource') }}",
                        method: "POST",
                        data: {
                            DEAD_ID: DEAD_ID,
                            SOURCE: result.value.source,
                            REASON: result.value.reason,
                        },

                        success: function(res) {

                            if (res.success) {

                                Swal.fire({
                                    icon: 'success',
                                    title: 'تم',
                                    text: 'تم التعديل بنجاح'
                                });

                                $('#result_tb').DataTable().ajax.reload(null, false);

                            } else {

                                Swal.fire({
                                    icon: 'error',
                                    title: 'خطأ',
                                    text: res.message
                                });

                            }
                        }
                    });

                }
            });
        }
    </script>
@endpush
