<div class="modal fade" tabindex="-1" id="newApplicationModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تقديم طلب جديد</h5>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
                <!--end::Close-->
            </div>
            <div class="modal-body" id="modal-body">
                <div class="row mb-8">
                    <label class="col-form-label fw-bold col-lg-2">الإبلاغ عن</label>
                    <div class="col-lg-8 fv-row mt-n1">

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="weekRadioOptions" id="weekRadio1"
                                checked>
                            <label class="form-check-label" for="inlineRadio1">شهيد</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="weekRadioOptions" id="weekRadio2">
                            <label class="form-check-label" for="inlineRadio2">متوفي</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="weekRadioOptions" id="weekRadio3">
                            <label class="form-check-label" for="inlineRadio3">مفقود</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-8">
                    <label class="d-block fw-bold fs-6 mb-5 p-3 bg-success text-white">بيانات (الشهيد - المتوفي -
                        المفقود) :</label>

                </div>
                <div class="row mb-8">
                    <label class="col-form-label fw-bold col-lg-2">رقم هوية </label>
                    <div class="col-lg-2">
                        <input type="number" name="P_ID_NO" id="P_ID_NO" maxLength="9"
                            oninput="this.value=this.value.slice(0,this.maxLength)"
                            class="form-control form-control-lg mb-3 mb-lg-0"
                            onchange="getPersonalNameByIdNo(this,$('#P_NAME'))">
                    </div>
                    <label class="col-form-label fw-bold col-lg-2">الإسم رباعي</label>
                    <div class="col-lg-5">
                        <input class="form-control" id="P_NAME" />

                    </div>
                </div>
                <div class="row mb-8">
                    <label class="col-form-label fw-bold col-lg-2">الجنس</label>
                    <div class="col-lg-2 fv-row">
                        <select id="P_gender" data-control="select2" data-placeholder="اختر ..."
                            class="form-select form-select-lg fw-bold">
                            <option value="">اختر...</option>
                            <option value="1">ذكر</option>
                            <option value="2">أنثى</option>
                        </select>
                    </div>
                    <label class="col-form-label fw-bold col-lg-2">الحالة
                        الاجتماعية</label>
                    <div class="col-lg-2 fv-row">
                        <select id="P_social_status_id" data-control="select2" data-placeholder="اختر ..."
                            class="form-select form-select-lg fw-bold">
                            <option></option>
                            @foreach ($marital_status as $marital)
                                <option value="{{ $marital->id }}">{{ $marital->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <label class="col-form-label fw-bold col-lg-1">تاريخ الميلاد</label>
                    <div class="col-lg-2 fv-row">
                        <input type="text" name="P_BIRTH_DATE" id="P_BIRTH_DATE"
                            class="form-control form-control-lg mb-3 mb-lg-0">
                    </div>
                </div>
                <div class="row mb-8">
                    <label class="col-form-label fw-bold col-lg-2">اسم الأم</label>
                    <div class="col-lg-2 fv-row">
                        <input type="text" name="P_mother_name" id="P_mother_name"
                            class="form-control form-control-lg mb-3 mb-lg-0">
                    </div>
                    <label class="col-form-label fw-bold col-lg-2">العنوان مفصلاً</label>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-4 fv-row">
                                <select id="P_region_id" data-control="select2" data-placeholder="المحافظة"
                                    class="form-select form-select-lg fw-bold">
                                    <option></option>
                                    @foreach ($region as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 fv-row">
                                <input type="text" name="P_city" id="P_city" placeholder="الحي"
                                    class="form-control form-control-lg mb-3 mb-lg-0">
                            </div>
                            <div class="col-lg-3 fv-row">
                                <input type="text" name="P_street" id="P_street" placeholder="الشارع"
                                    class="form-control form-control-lg mb-3 mb-lg-0">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row mb-8">
                    <label class="col-form-label fw-bold col-lg-2">أقرب معلم</label>
                    <div class="col-lg-4 fv-row">
                        <input type="text" name="P_street" id="P_street" placeholder="أقرب معلم"
                            class="form-control form-control-lg mb-3 mb-lg-0">
                    </div>
                </div>
                <div class="row mb-8">
                    <label class="d-block fw-bold fs-6 mb-5 p-3 bg-success text-white">تاريخ ومكان ( الاستشهاد - الوفاة
                        - الفقدان):</label>


                    <label class="col-form-label fw-bold col-lg-2">التاريخ</label>
                    <div class="col-lg-2 fv-row">
                        <input type="text" name="P_DEAD_DATE" id="P_DEAD_DATE"
                            class="form-control form-control-lg mb-3 mb-lg-0">
                    </div>
                    <label class="col-form-label fw-bold col-lg-1">المحافظة</label>
                    <div class="col-lg-2 fv-row">
                        <select id="P_dead_region_id" data-control="select2" data-placeholder="المحافظة"
                            class="form-select form-select-lg fw-bold">
                            <option></option>
                            @foreach ($region as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <label class="col-form-label fw-bold col-lg-1">حالة الدفن</label>
                    <div class="col-lg-2 fv-row">

                        <select id="P_dead_status_id" data-control="select2" data-placeholder="حالة الدفن"
                            class="form-select form-select-lg fw-bold">
                            <option></option>
                            <option value="1">تم الدفن</option>
                            <option value="2">تحت الأنقاض</option>
                            <option value="3">أخرى</option>

                        </select>
                    </div>
                </div>
                <div class="row mb-8">
                    <label class="col-form-label fw-bold col-lg-2">مكان الدفن</label>
                    <div class="col-lg-4 fv-row">
                        <input type="text" name="P_DEAD_PLACE" id="P_DEAD_PLACE"
                            class="form-control form-control-lg mb-3 mb-lg-0">
                    </div>
                    <label class="col-form-label fw-bold col-lg-2">تم تبليغ المستشفى سابقاً</label>
                    <div class="col-lg-2 fv-row mt-n1">

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="weekRadioOptions1" id="weekRadio11"
                                checked>
                            <label class="form-check-label" for="inlineRadio11">نعم</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="weekRadioOptions1"
                                id="weekRadio12">
                            <label class="form-check-label" for="inlineRadio12">لا</label>
                        </div>

                    </div>
                </div>
                <div class="row mb-8">

                    <label class="d-block fw-bold fs-6 mb-5 p-3 bg-success text-white">بيانات مقدم الطلب:</label>

                    <label class="col-form-label fw-bold col-lg-2"> هوية مقدم الطلب</label>
                    <div class="col-lg-2 fv-row">
                        <input class="form-control" id="P_ID_NO_APPLICATION"
                            onchange="getPersonalInfoBy(this,$('#P_NAME_APPLICATION'))" />
                    </div>
                    <label class="col-form-label fw-bold col-lg-2">اسم مقدم الطلب </label>
                    <div class="col-lg-4 fv-row">
                        <input class="form-control" id="P_NAME_APPLICATION" />
                    </div>
                </div>
                <div class="row mb-8">

                    <label class="col-form-label fw-bold col-lg-2">رقم جوال مقدم الطلب</label>
                    <div class="col-lg-2 fv-row">
                        <input class="form-control" id="P_MOBILE" type="number" maxLength="10"
                            oninput="this.value=this.value.slice(0,this.maxLength)" />
                    </div>
                    <label class="col-form-label fw-bold col-lg-2">المحافظة</label>
                    <div class="col-lg-2 fv-row">
                        <select id="P_give_region_id" data-control="select2" data-placeholder="المحافظة"
                            class="form-select form-select-lg fw-bold">
                            <option></option>
                            @foreach ($region as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <label class="col-form-label fw-bold col-lg-2">صلة قرابة مقدم الطلب</label>
                    <div class="col-lg-2 fv-row">
                        <select id="P_give_region_id" data-control="select2" data-placeholder="صلة القرابة"
                            class="form-select form-select-lg fw-bold">
                            <option></option>
                            <option value="1">أب/أم</option>
                            <option value="2">ابن/ابنة</option>
                            <option value="3">زوج/زوجة</option>
                            <option value="4">أخ/أخت</option>
                            <option value="5">قرابة عائلية</option>
                            <option value="6">أخرى</option>

                        </select>
                    </div>
                </div>
                <div class="row mb-8">
                    <label class="col-form-label fw-bold col-lg-2">صلة قرابة أخرى </label>
                    <div class="col-lg-6 fv-row">
                        <input class="form-control" id="P_REL" />
                    </div>
                </div>
                <div class="row mb-8">
                    <label class="d-block fw-bold fs-6 mb-5 p-3 bg-success text-white">بيانات المعرف الأول:</label>
                    <label class="col-form-label fw-bold col-lg-2">رقم هوية </label>
                    <div class="col-lg-2">
                        <input type="number" name="P_ID1_NO" id="P_ID1_NO" maxLength="9"
                            oninput="this.value=this.value.slice(0,this.maxLength)"
                            class="form-control form-control-lg mb-3 mb-lg-0"
                            onchange="getPersonalNameByIdNo(this,$('#P_NAME1'))">
                    </div>
                    <label class="col-form-label fw-bold col-lg-2">اسم المعرف</label>
                    <div class="col-lg-5">
                        <input class="form-control" id="P_NAME1" />

                    </div>
                </div>
                <div class="row mb-8">

                    <label class="col-form-label fw-bold col-lg-2">رقم الجوال</label>
                    <div class="col-lg-2">
                        <input class="form-control" id="P_phone1" />

                    </div>
                    <label class="col-form-label fw-bold col-lg-2">المهنة</label>
                    <div class="col-lg-2">
                        <input class="form-control" id="P_job2" />

                    </div>
                </div>
                <div class="row mb-8">
                    <label class="d-block fw-bold fs-6 mb-5 p-3 bg-success text-white">بيانات المعرف الثاني:</label>
                    <label class="col-form-label fw-bold col-lg-2">رقم هوية </label>
                    <div class="col-lg-2">
                        <input type="number" name="P_ID2_NO" id="P_ID2_NO" maxLength="9"
                            oninput="this.value=this.value.slice(0,this.maxLength)"
                            class="form-control form-control-lg mb-3 mb-lg-0"
                            onchange="getPersonalNameByIdNo(this,$('#P_NAME2'))">
                    </div>
                    <label class="col-form-label fw-bold col-lg-2">اسم المعرف</label>
                    <div class="col-lg-5">
                        <input class="form-control" id="P_NAME2" />

                    </div>
                </div>
                <div class="row mb-8">

                    <label class="col-form-label fw-bold col-lg-2">رقم الجوال</label>
                    <div class="col-lg-2">
                        <input class="form-control" id="P_phone2" />

                    </div>
                    <label class="col-form-label fw-bold col-lg-2">المهنة</label>
                    <div class="col-lg-2">
                        <input class="form-control" id="P_job2" />

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">إغلاق</button>
                <button type="button" class="btn btn-primary" onclick="save_new_application();">حفظ </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Example End-->
@push('scripts')
    <script>
        var target = document.querySelector("#modal-body");
        var blockUI = new KTBlockUI(target);

        function clear_form_application() {
            $('#P_ID_NO').val('');
            $('#P_NAME').val('');
            $('#P_ID_NO_APPLICATION').val('');
            $('#P_NAME_APPLICATION').val('');
            $('#P_MOBILE').val('');
            $('#P_NOTES').val('');
            $('#ref_no').val('');
        }

        function getPersonalInfoBy(e, id) {
            var P_ID_NO = e.value;
            if (P_ID_NO) {
                blockUI.block();
                var url = "{{ route('constant.getPersonalInfoByIdNo') }}";
                $.ajax({
                    url: url,
                    type: 'json',
                    method: 'post',
                    data: {
                        'id_no': P_ID_NO
                    },
                }).done(function(response) {
                    console.log(response);
                    if (response.success) {
                        if (response.success == 1) {
                            id.val(response.results.fname + ' ' + response.results.sname + ' ' +
                                response.results.tname + ' ' + response.results.lname
                            );
                        }
                    } else {
                        console.log(response);
                        $message = "";
                        $.each(response.errors, function(key, value) {
                            console.log(value);
                            console.log(key);
                            $message += value.join('-') + "\r\n";
                        });
                        Swal.fire({
                            title: 'خطأ !',
                            text: $message,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                    blockUI.release();
                });
            }
        }

        function getPersonalNameByIdNo(e, id) {
            var P_ID_NO = e.value;
            if (P_ID_NO) {
                blockUI.block();
                var url = "{{ route('constant.getPersonalNameByIdNo') }}";
                $.ajax({
                    url: url,
                    type: 'json',
                    method: 'post',
                    data: {
                        'id_no': P_ID_NO
                    },
                }).done(function(response) {
                    console.log(response);
                    if (response.success) {
                        if (response.success == 1) {
                            id.val(response.results.fname + ' ' + response.results.sname + ' ' +
                                response.results.tname + ' ' + response.results.lname
                            );
                        }
                    } else {
                        console.log(response);
                        $message = "";
                        $.each(response.errors, function(key, value) {
                            console.log(value);
                            console.log(key);
                            $message += value.join('-') + "\r\n";
                        });
                        Swal.fire({
                            title: 'خطأ !',
                            text: $message,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                    blockUI.release();
                });
            }
        }

        function save_new_application() {

            var P_ID_NO = $('#P_ID_NO').val();
            var P_NAME = $('#P_NAME').val();
            var P_ID_NO_APPLICATION = $('#P_ID_NO_APPLICATION').val();
            var P_NAME_APPLICATION = $('#P_NAME_APPLICATION').val();
            var P_MOBILE = $('#P_MOBILE').val();
            var P_NOTES = $('#P_NOTES').val();
            var ref_no = $('#ref_no').val();
            var url = "{{ route('dead.applications.store') }}";

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    ID_NO: P_ID_NO,
                    NAME: P_NAME,
                    ID_NO_APPLICATION: P_ID_NO_APPLICATION,
                    NAME_APPLICATION: P_NAME_APPLICATION,
                    MOBILE: P_MOBILE,
                    ref_no: ref_no,
                    NOTES: P_NOTES
                },
            }).done(function(response) {
                if (response.success) {
                    $('#newApplicationModal').modal('hide');
                    clear_form_application();
                    toastr.success(response.results.message);
                    if ($('#type').val() == 1 && P_ID_NO == $('#P_ID').val()) {
                        print_dead(P_ID_NO);
                    }
                } else {
                    console.log(response);
                    $message = "";
                    $.each(response.errors, function(key, value) {
                        console.log(value);
                        console.log(key);
                        $message += value.join('-') + "\r\n";
                    });
                    Swal.fire({
                        title: 'خطأ !',
                        text: $message,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            });
        }
    </script>
@endpush
