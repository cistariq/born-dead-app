@extends('layouts.main')
@section('title', 'صرف الطلبات')

@section('content')
    <form action="#" id="release_form">
        <!-- بطاقة البحث -->
        <div class="card mb-7">
            <div class="card-body">
                <div class="row align-items-center g-3">

                    <!-- المستشفى -->
                    <div class="col-md-4">
                        <label for="P_HOS_NO" class="form-label fw-bold">المستشفى</label>
                        <select class="form-select" data-control="select2" id="P_HOS_NO" name="P_HOS_NO"
                            data-placeholder="اختر المستشفى">
                            <option value=""></option>
                            @foreach ($hospitals as $hospital)
                                <option value="{{ $hospital->dref_code }}">{{ $hospital->dref_name_ar }}</option>
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
                    <button type="button" class="btn btn-primary me-2" onclick="searchRequests()">بحث</button>
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
                    <thead class="table-light text-center align-middle">
                        <tr>
                            <th rowspan="2">#</th>
                            <th rowspan="2">المستشفى</th>
                            <th rowspan="2">الرقم الحالي</th>
                            <th rowspan="2">آخر رقم في الكوتة الحالية</th>
                            <th rowspan="2">عدد الأرقام المتبقية</th>
                            <th colspan="2">الرقم المصروف</th>
                            <th rowspan="2">الإجراءات</th>
                        </tr>
                        <tr>
                            <th>من</th>
                            <th>إلى</th>
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


            // حدث زر البحث
            $('.btn-primary').on('click', function() {
                searchRequests();
            });

            // حدث زر جديد لمسح الحقول والنتائج
            $('.btn-outline-dark').on('click', function() {
                clear_form();
            });
            searchRequests();
        });

        // دالة البحث واستدعاء السيرفر لجلب البيانات
        function searchRequests() {
            const hosNo = $('#P_HOS_NO').val();
            const dateFrom = $('#P_DATE_FROM').val();
            const dateTo = $('#P_DATE_TO').val();

            $.ajax({
                url: "{{ route('born.search_release') }}",
                method: 'GET',
                data: {
                    P_HOS_NO: hosNo,
                    P_DATE_FROM: dateFrom,
                    P_DATE_TO: dateTo
                },
                success: function(data) {
                    let tbody = $('#result_tb tbody');
                    tbody.empty();

                    if (!data.length) {
                        tbody.append('<tr><td colspan="8">لا توجد نتائج</td></tr>');
                        return;
                    }

                    data.forEach(function(row, index) {
                        tbody.append(`
                        <tr id="row-${row.id}">
                            <td>${index + 1}</td>
                            <td>${row.hos_name}</td>
                            <td>${row.current_number}</td>
                            <td>${row.last_number}</td>
                            <td>${row.remaining_digit}</td>
                            <td>${row.release_from ?? ''}</td>
                            <td>${row.release_to ?? ''}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick="releaseRequest(${row.id})">صرف</button>
                            </td>
                        </tr>
                    `);
                    });
                },
                error: function() {
                    Swal.fire({
                        title: 'فشل العملية',
                        text: 'حدث خطأ أثناء البحث',
                        icon: 'error',
                        confirmButtonText: 'موافق'
                    });
                }
            });
        }

        // دالة لمسح الحقول والنتائج
        function clear_form() {
            $('#P_HOS_NO').val(null).trigger('change');
            $('#P_DATE_FROM').val('');
            $('#P_DATE_TO').val('');
            $('#result_tb tbody').empty();
        }

        // دالة صرف الطلب (تحتاج تضيفها حسب منطقك)
        function releaseRequest(id) {
            Swal.fire({
                title: 'تأكيد العملية',
                text: 'هل أنت متأكد من صرف هذا الطلب؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'نعم، صرف الطلب',
                cancelButtonText: 'إلغاء',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('born.release') }}",
                        method: 'POST',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success == true) {
                                Swal.fire({
                                    title: 'تم بنجاح',
                                    text: 'تم صرف الطلب بنجاح',
                                    icon: 'success',
                                    confirmButtonText: 'حسناً'
                                }).then(() => {
                                    searchRequests(); // إعادة تحميل الجدول
                                });
                            } else {
                                Swal.fire({
                                    title: 'فشل العملية',
                                    text: response.message || 'حدث خطأ أثناء صرف الطلب',
                                    icon: 'error',
                                    confirmButtonText: 'موافق'
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                title: 'خطأ',
                                text: 'حدث خطأ أثناء الاتصال بالخادم',
                                icon: 'error',
                                confirmButtonText: 'موافق'
                            });
                        }
                    });
                }
            });
        }
    </script>
@endpush
