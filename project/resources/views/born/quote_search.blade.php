@extends('layouts.main')
@section('title', 'الاستعلام عن كوتة الطلبات')

@section('content')
    <form action="#" id="approve_form">
        <!-- بطاقة البحث -->
        <div class="card mb-7">
            <div class="card-body">
                <div class="row align-items-center g-3">

                    <!-- المستشفى -->
                    <div class="col-md-2">
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
                    <!-- حالة الطلب -->
                    <div class="col-md-2">
                        <label for="P_STATUS_NO" class="form-label fw-bold">حالة الطلب</label>
                        <select class="form-select" data-control="select2" id="P_STATUS_NO" data-placeholder="حالة الطلب"
                            data-allow-clear="true">
                            <option></option>
                            <option value="0"> قيد الاعتماد </option>
                            <option value="1"> تم الاعتماد </option>
                            <option value="2"> تم الصرف </option>
                            <option value="3"> ملغي </option>

                        </select>

                    </div>
                    <!--  الرقم -->
                    <div class="col-md-2">
                        <label for="searchNumber" class="form-label fw-bold">الرقم</label>
                        <input type="text" class="form-control text-center" id="searchNumber" name="searchNumber" />
                    </div>
                    <!-- تاريخ من -->
                    <div class="col-md-2">
                        <label for="P_DATE_FROM" class="form-label fw-bold">تاريخ الطلب من</label>
                        <input type="text" class="form-control text-center" id="P_DATE_FROM" name="P_DATE_FROM"
                            value="{{ date('d/m/Y') }}" />
                    </div>

                    <!-- تاريخ إلى -->
                    <div class="col-md-2">
                        <label for="P_DATE_TO" class="form-label fw-bold">تاريخ الطلب إلى</label>
                        <input type="text" class="form-control text-center" id="P_DATE_TO" name="P_DATE_TO"
                            value="{{ date('d/m/Y') }}" />
                    </div>

                </div>


                <!-- الأزرار -->
                <div class="mt-4 text-end">
                    <button type="button" class="btn btn-primary me-2" onclick="searchQuote()">بحث</button>
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
                            <th>#</th>
                            <th>المستشفى</th>
                            <th>الرقم الحالي</th>
                            <th>آخر رقم في الكوتة الحالية</th>
                            <th>عدد الأرقام المتبقية</th>
                            <th>حالة الطلب</th>
                            {{-- <th>الإجراءات</th> --}}
                            <th colspan="2">الرقم المصروف</th>

                        </tr>
                        <tr>
                            <th colspan="6"></th>

                            <th>من</th>
                            <th>إلى</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- البيانات تُملأ ديناميكياً -->
                    </tbody>
                </table>
                <!-- زر التصدير إلى Excel -->
                <div class="text-end mt-3">
                    <button id="btnExportExcel" class="btn btn-success" style="display:none" onclick="exportToExcel()">
                        <i class="fa fa-file-excel"></i> تصدير إلى Excel
                    </button>
                </div>
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
              //  searchQuote();
            });

            // حدث زر جديد لمسح الحقول والنتائج
            $('.btn-outline-dark').on('click', function() {
                clear_form();
            });
        });

        // دالة البحث واستدعاء السيرفر لجلب البيانات
        function searchQuote() {
            const hosNo = $('#P_HOS_NO').val();
            const dateFrom = $('#P_DATE_FROM').val();
            const dateTo = $('#P_DATE_TO').val();
            const status = $('#P_STATUS_NO').val();
            const searchNumber = $('#searchNumber').val();

            $.ajax({
                url: "{{ route('born.search_quote') }}",
                method: 'GET',
                data: {
                    P_HOS_NO: hosNo,
                    P_DATE_FROM: dateFrom,
                    P_DATE_TO: dateTo,
                    P_STATUS_NO: status,
                    searchNumber:searchNumber
                },
                success: function(data) {
                    let tbody = $('#result_tb tbody');
                    tbody.empty();

                    if (!data.length) {
                        tbody.append('<tr><td colspan="8">لا توجد نتائج</td></tr>');
                        $('#btnExportExcel').hide(); // 🔴 إخفاء الزر إذا لا توجد بيانات
                        return;
                    }

                    data.forEach(function(row, index) {
                        tbody.append(`
                    <tr id="row-${row.id}">
                        <td>${index + 1}</td>
                        <td>${row.hos_name ?? ''}</td>
                        <td>${row.current_number ?? ''}</td>
                        <td>${row.last_number ?? ''}</td>
                        <td>${row.remaining_digit ?? ''}</td>
                        <td>${statusText(row.order_status)}</td>
                        <td>${row.release_from ?? ''}</td>
                        <td>${row.release_to ?? ''}</td>
                    </tr>
                `);
                    });
                    $('#btnExportExcel').show();
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
        // دالة لمسح الحقول والنتائج
        function clear_form() {
            $('#P_HOS_NO').val(null).trigger('change');
            $('#P_DATE_FROM').val('');
            $('#P_DATE_TO').val('');
            $('#result_tb tbody').empty();
        }
        function exportToExcel() {
            var query = {
                P_HOS_NO : $('#P_HOS_NO').val(),
                P_DATE_FROM : $('#P_DATE_FROM').val(),
                P_DATE_TO : $('#P_DATE_TO').val(),
                P_STATUS_NO : $('#P_STATUS_NO').val(),
                searchNumber : $('#searchNumber').val()


            }
            var base_url = "{{ URL::to('born/quota_export_excel') }}?" + $.param(query)


            window.location = base_url;
        }
    </script>
@endpush
