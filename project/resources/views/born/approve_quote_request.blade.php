@extends('layouts.main')
@section('title', 'اعتماد الطلبات')

@section('content')
    <form action="#" id="approve_form">
        <!-- بطاقة البحث -->
        <div class="card mb-7">
            <div class="card-body">
                <div class="row align-items-center g-3">

                    <!-- المستشفى -->
                    <div class="col-md-4">
                        <label for="P_HOS_NO" class="form-label fw-bold">المستشفى</label>
                        <select class="form-select" data-control="select2" id="P_HOS_NO" data-placeholder="المستشفى"
                            data-allow-clear="true">
                            <option></option>
                            @foreach ($hospitals as $hospital)
                                <option value="{{ $hospital['dref_code'] }}"
                                    {{ $hospital['dref_code'] == $defaultHospital ? 'selected' : '' }}>
                                    {{ $hospital['dref_name_ar'] }}</option>
                            @endforeach
                        </select>

                    </div>

                    <!-- تاريخ من -->
                    <div class="col-md-4">
                        <label for="P_DATE_FROM" class="form-label fw-bold">تاريخ الطلب من</label>
                        <input type="text" class="form-control text-center" id="P_DATE_FROM" name="P_DATE_FROM" />
                    </div>

                    <!-- تاريخ إلى -->
                    <div class="col-md-4">
                        <label for="P_DATE_TO" class="form-label fw-bold">تاريخ الطلب إلى</label>
                        <input type="text" class="form-control text-center" id="P_DATE_TO" name="P_DATE_TO" />
                    </div>

                </div>

                <!-- الأزرار -->
                <div class="mt-4 text-end">
                    <button type="button" class="btn btn-primary me-2" onclick="search_request()">بحث</button>
                    <button type="button" class="btn btn-outline-dark" onclick="clear_form();">جديد</button>
                </div>
            </div>
        </div>
    </form>

    <!-- جدول النتائج -->
    <div class="card mb-7">
        <div class="card-body">
            <div class="table-responsive">
                <table id="result_tb" class="table table-striped table-bordered text-center align-middle"
                    style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>المستشفى</th>
                            <th>الرقم الحالي</th>
                            <th>آخر رقم في الكوتة الحالية</th>
                            <th>عدد الأرقام المتبقية</th>
                            <th>حالة الطلب</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- البيانات تُملأ ديناميكياً -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>

        $("#P_DATE_FROM").flatpickr({
            dateFormat: "d/m/Y",
            maxDate: new Date(),
        });

        $("#P_DATE_TO").flatpickr({
            dateFormat: "d/m/Y",
            maxDate: new Date(),
        });
        $(document).ready(function() {
            $('#P_HOS_NO').select2({
                placeholder: "المستشفى",
                allowClear: true
            });

            // تعيين القيمة الافتراضية عبر Select2 API
            $('#P_HOS_NO').val("{{ $defaultHospital }}").trigger('change');
         search_request();

        });

        function statusText(status) {
            status = parseInt(status);
            switch (status) {
                case 0:
                    return 'قيد الاعتماد';
                case 1:
                    return 'منتظر الصرف';
                case 2:
                    return 'تم الصرف';
                case 3:
                    return 'ملغى';
                default:
                    return '';
            }
        }

        function search_request() {
            $.ajax({
                url: "{{ route('born.search') }}",
                method: 'GET',
                data: {
                    P_HOS_NO: $('#P_HOS_NO').val(),
                    P_DATE_FROM: $('#P_DATE_FROM').val(),
                    P_DATE_TO: $('#P_DATE_TO').val(),
                },
                success: function(data) {
                    let tbody = $('#result_tb tbody');
                    tbody.empty();

                    if (data.length === 0) {
                        tbody.append('<tr><td colspan="7">لا توجد نتائج</td></tr>');
                        return;
                    }

                    data.forEach(function(row, index) {
                        let buttonsHtml = '';
                        if (parseInt(row.order_status) === 0) {
                            buttonsHtml = `
                        <button class="btn btn-success btn-sm" onclick="approveRequest(${row.id})">اعتماد</button>
                        <button class="btn btn-danger btn-sm" onclick="cancelRequest(${row.id})">إلغاء</button>
                    `;
                        }

                        tbody.append(`
                    <tr id="row-${row.id}">
                        <td>${index + 1}</td>
                        <td>${row.hos_name}</td>
                        <td>${row.current_number}</td>
                        <td>${row.last_number}</td>
                        <td>${row.remaining_digit}</td>
                        <td>${statusText(row.order_status)}</td>
                        <td>${buttonsHtml}</td>
                    </tr>
                `);
                    });
                },
                error: function() {
                    alert('حدث خطأ أثناء البحث');
                }
            });
        }



        function approveRequest(id) {
            $.ajax({
                url: "{{ route('born.approve') }}",
                method: 'POST',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
            }).done(function(response) {
                if (response.success == true) {
                    Swal.fire({
                        title: 'تم اعتماد الطلب بنجاح!',
                        text: response.message,
                        icon: "success",
                        confirmButtonText: 'موافق'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // إخفاء أزرار الاعتماد والإلغاء في الصف
                            $(`#row-${id} .btn-success, #row-${id} .btn-danger`).hide();

                            $('.btn-primary').click(); // إعادة البحث لتحديث الجدول إذا تريد
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'يوجد خطأ في عملية الإدخال!',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            });
        }

        function cancelRequest(id) {
            $.ajax({
                url: "{{ route('born.cancel') }}",
                method: 'POST',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
            }).done(function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        title: 'تم إلغاء الطلب بنجاح!',
                        text: response.message,
                        icon: "success",
                        confirmButtonText: 'موافق'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // إخفاء أزرار الاعتماد والإلغاء في الصف
                            $(`#row-${id} .btn-success, #row-${id} .btn-danger`).hide();

                            $('.btn-primary').click(); // إعادة البحث لتحديث الجدول إذا تريد
                        }
                    });
                } else {
                    toastr["error"](response.message || 'حدث خطأ غير متوقع');
                }
            }).fail(function(xhr, status, error) {
                Swal.fire({
                    title: 'حدث خطأ أثناء العملية!',
                    text: error,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            });
        }
    </script>
@endpush
