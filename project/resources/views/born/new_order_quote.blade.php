@extends('layouts.main')
@section('title', 'طلب رقم طبي للتبليغ عن المواليد')

@section('content')

    <form action="#" id="quote_form">
        <div class="card mb-7">
            <div class="card-body">
                <!-- عنوان القسم -->
                <div class="mb-4">
                    <label class="d-block fw-bold fs-6 p-3 bg-success text-white rounded">بيانات الطلب</label>
                </div>

                <!-- صف المستشفى -->
                <div class="row mb-3 align-items-center">
                    <div class="col-lg-2 col-md-3">
                        <label class="form-label fw-bold required">المستشفى</label>
                    </div>
                    <div class="col-lg-3 col-md-9">
                        <select id="hos_no" name="hos_no" data-control="select2" data-placeholder="اختر ..."
                            class="form-select form-select-lg fw-bold form-select-solid border border-1 border-dark"
                            disabled>
                            <option value="">اختر...</option>
                            @foreach ($hospitals as $hospital)
                                <option value="{{ $hospital['dref_code'] }}">
                                    {{ $hospital['dref_name_ar'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- صف الرقم الحالي و آخر رقم -->
                <div class="row mb-3 align-items-center">
                    <div class="col-lg-2 col-md-3">
                        <label class="form-label fw-bold required">الرقم الحالي</label>
                    </div>
                    <div class="col-lg-3 col-md-9">
                        <input id="current_number" type="text"
                            class="form-control form-control-solid border border-1 border-dark" />
                    </div>

                    <div class="col-lg-2 col-md-3">
                        <label class="form-label fw-bold required">آخر رقم في الكوتة الحالية</label>
                    </div>
                    <div class="col-lg-3 col-md-9">
                        <input id="last_number" type="text"
                            class="form-control form-control-solid border border-1 border-dark" />
                    </div>
                </div>

                <!-- صف عدد الأرقام المتبقية -->
                <div class="row mb-3 align-items-center">
                    <div class="col-lg-2 col-md-3">
                        <label class="form-label fw-bold required">عدد الأرقام المتبقية</label>
                    </div>
                    <div class="col-lg-3 col-md-5">
                        <input id="remaining_numbers" type="text"
                            class="form-control form-control-solid border border-1 border-dark" />
                    </div>
                </div>
                <!-- أزرار التحكم -->
                <div class="row mb-3">
                    <div class="col-lg-12 text-center">
                        <!-- زر طلب الرقم -->
                        <button type="button" class="btn btn-primary btn-lg fw-bold px-5" onclick="save_request()">
                            <i class="fas fa-check-circle"></i> طلب الرقم
                        </button>

                        <!-- زر الإلغاء -->
                        <button type="button" class="btn btn-danger btn-lg fw-bold px-5 ms-3">
                            <i class="fas fa-times-circle"></i> إلغاء
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#hos_no').select2({
                placeholder: "المستشفى",
                allowClear: true
            });

            // تعيين القيمة الافتراضية عبر Select2 API
            //$('#hos_no').val("{{ $defaultHospital }}").trigger('change');
            $('#hos_no').val(1).trigger('change');
            check_record_quata();
        });

        function save_request() {

            $.ajax({
                url: "{{ route('born.store') }}",
                method: 'POST',
                data: {
                    hos_no: $('#hos_no').val(),
                    current_number: $('#current_number').val(),
                    last_number: $('#last_number').val(),
                    remaining_numbers: $('#remaining_numbers').val(),
                    _token: '{{ csrf_token() }}'
                },
            }).done(function(response) {
                console.log(response);
                if (response.status == 'success') {
                    Swal.fire({
                        title: 'تمت عملية حفظ الطلب بنجاح !',
                        text: response.message,
                        icon: "success",
                        confirmButtonText: 'موافق'
                    });

                } else {
                    console.log(response);

                    Swal.fire({
                        title: 'يوجد خطأ في عملية الإدخال !',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            });

        }

        function check_record_quata() {
            $('#hos_no').prop('disabled', false);
            var form_data = new FormData($('#quote_form')[0]);
            $('#hos_no').prop('disabled', true);

            var url = "{{ route('check_record_quata') }}";

            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                data: form_data,
                success: function(response) {
                    console.log(response.data);
                    if (response.status == 200 && response.data && response.data.BNQ_IS_ACTIVE == 1) {
                        $('#current_number').val(response.data.BNQ_CURRENT_NUMBER ?? 0);
                        $('#last_number').val(response.data.BNQ_END_NUMBER ?? 0);
                        $('#remaining_numbers').val(
                            (response.data.BNQ_CURRENT_NUMBER ?? 0) - (response.data.BNQ_END_NUMBER ?? 0)
                        );
                    } else {
                        Swal.fire({
                            title: 'خطأ !',
                            text: response.message || 'حدث خطأ أثناء جلب البيانات',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    Swal.fire({
                        title: 'خطأ !',
                        text: 'فشل الاتصال بالخادم',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            });
        }
    </script>
@endpush
