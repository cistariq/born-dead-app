@extends('layouts.main')
@section('title', 'استعلام بيانات السكان')

@section('content')
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">استعلام جديد</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div id="kt_account_settings_profile_details">
            <!--begin::Form-->
            <form id="search_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                <!--begin::Card body-->
                <div class="card-body border-top">
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-2 col-form-label required fw-bold fs-6">رقم الهوية</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-2">
                            <!--begin::Col-->
                            <input type="number" name="id_no" id="P_ID" maxLength="9"
                                oninput="this.value=this.value.slice(0,this.maxLength)"
                                class="form-control text-center form-control-lg mb-3 mb-lg-0" placeholder="رقم الهوية">
                            <!--end::Col-->
                        </div>
                    </div>
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label  fw-bold fs-6">الاسم رباعي للمواطن/ة</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-3">
                                    <input type="text" id="IN_FIRST_NAME" name="fname"
                                        class="form-control text-center form-control-lg mb-3" placeholder="الاسم الأول">
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" id="IN_SECOND_NAME" name="sname"
                                        class="form-control text-center form-control-lg mb-3" placeholder="اسم الأب">
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" id="IN_THIRD_NAME" name="tname"
                                        class="form-control text-center form-control-lg mb-3" placeholder="اسم الجد">
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" id="IN_LAST_NAME" name="lname"
                                        class="form-control text-center form-control-lg mb-3" placeholder="العائلة">
                                </div>
                            </div>
                        </div>
                        <!--end::Col-->
                        <div class="col-lg-4">
                            <!--begin::Col-->
                            <button type="submit" class="btn btn-primary me-2" >بحث</button>
                            <button type="reset" class="btn btn-light btn-active-light-primary me-2"
                                onclick="clear_form()">تفريغ الحقول</button>
                            <!--end::Col-->
                        </div>
                    </div>
                </div>
                <!--end::Input group-->
            </form>
            <!--end::Row-->
            <div class="card" id="result_search">
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_profile_details" aria-expanded="true"
                    aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">نتائج البحث</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <div class="card-body">
                    <!--begin::datatable-->
                    <div class="table-responsive">
                        <table id="result_tb" class="table table-striped dt-responsive table-row-bordered gy-5 gs-7"
                            style="width:100%;cursor: pointer;">
                            <thead>
                                <tr class="fw-semibold fs-6 text-muted">
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">الهوية</th>
                                    <th style="text-align: center">الاسم رباعي</th>
                                    <th style="text-align: center">تاريخ الميلاد</th>
                                    <th style="text-align: center">الجنس</th>
                                    <th style="text-align: center">الحالة الاجتماعية</th>
                                    <th style="text-align: center">المحافظة</th>
                                    <th style="text-align: center">المدينة</th>
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
            <!--begin::Card body-->
            <div class="card-body border-top p-9" id="display_data">
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-2 col-form-label required fw-bold fs-6">رقم هوية المواطن/ة</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-2">
                        <!--begin::Col-->
                        <input type="number" name="P_ID_NO" id="P_ID_NO" maxLength="9"
                            oninput="this.value=this.value.slice(0,this.maxLength)"
                            class="form-control text-center form-control-lg mb-3 mb-lg-0" disabled>
                        <!--end::Col-->
                    </div>
                    <!--end::Col-->
                    <label class="col-lg-2 col-form-label required fw-bold fs-6">الاسم رباعي للمواطن/ة</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-3">
                                <input type="text" id="P_FIRST_NAME"
                                    class="form-control text-center form-control-lg mb-3" placeholder="الاسم الأول"
                                    disabled>
                            </div>
                            <div class="col-lg-3">
                                <input type="text" id="P_FASTHER_NAME"
                                    class="form-control text-center form-control-lg mb-3" placeholder="اسم الأب"
                                    disabled>
                            </div>
                            <div class="col-lg-3">
                                <input type="text" id="P_GRAND_FATHER_NAME"
                                    class="form-control text-center form-control-lg mb-3" placeholder="اسم الجد"
                                    disabled>
                            </div>
                            <div class="col-lg-3">
                                <input type="text" id="P_FAMILY_NAME"
                                    class="form-control text-center form-control-lg mb-3" placeholder="العائلة"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-2 col-form-label  fw-bold fs-6">تاريخ الميلاد</label>
                    <div class="col-lg-2 fv-row">
                        <input class="form-control text-center" id="P_BIRTH_DATE" disabled>
                    </div>

                    <label class="col-lg-2 col-form-label  fw-bold fs-6">الجنس</label>
                    <div class="col-lg-2 fv-row">
                        <input class="form-control text-center" id="P_gender" disabled>
                    </div>
                    <label class="col-lg-2 col-form-label fw-bold fs-6">الحالة الاجتماعية</label>
                    <div class="col-lg-2 fv-row">
                        <input class="form-control text-center" id="P_social_status_id" disabled>
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label required fw-bold fs-6">الجنسية</label>
                    <div class="col-lg-2 fv-row">
                        <input class="form-control text-center" id="P_nationality_id" disabled>
                    </div>
                    <label class="col-lg-2 col-form-label required fw-bold fs-6">الديانة</label>
                    <div class="col-lg-2 fv-row">
                        <input class="form-control text-center" id="P_religion_id" disabled>
                    </div>
                    <label class="col-lg-2 col-form-label required fw-bold fs-6">مكان الميلاد</label>
                    <div class="col-lg-2">
                        <!--begin::Col-->
                        <input type="text" name="P_birth_state" id="P_birth_state"
                            class="form-control text-center form-control-lg mb-3 mb-lg-0" disabled>
                        <!--end::Col-->
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label required fw-bold fs-6">المحافظة</label>
                    <div class="col-lg-2 fv-row">
                        <input class="form-control text-center" id="P_region_code" disabled>
                    </div>
                    <label class="col-lg-2 col-form-label required fw-bold fs-6">المدينة</label>
                    <div class="col-lg-2 fv-row">
                        <input class="form-control text-center" id="P_city_code" disabled>
                    </div>
                    <label class="col-lg-2 col-form-label required fw-bold fs-6">الحي </label>
                    <div class="col-lg-2 fv-row">
                        <input class="form-control text-center" id="P_street" disabled>
                    </div>
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Card body-->
            <!--end::Form-->
        </div>
        <!--end::Content-->
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#search_form').submit(function(e){
                e.preventDefault();
                getPersonalInfoBy();
            });
            var table = $('#users').DataTable();
            $('#result_tb tbody').on('click', 'tr', function () {
                console.log($(this).find("td")[1].innerHTML);
            });
        });

        function clear_form() {
            $('#search_form')[0].reset();
            $('#P_gender').val('').change();
            $('#P_social_status_id').change();
            $('#P_nationality_id').change();
            $('#P_religion_id').change();
            $('#P_region_code').change();
            $('#P_city_code').change();
            $('#result_tb').DataTable().destroy();
            $('#result_tb tbody').empty();
        }

        function getPersonalInfoBy() {
            var form_date = new FormData($('#search_form')[0]);
            var url = "{{ route('getPersonalInfo') }}";
            $.ajax({
                url: url,
                type: 'json',
                method: 'post',
                cache: false,
                processData: false,
                contentType: false,
                data: form_date,
            }).done(function(response) {
                console.log(response);
                if (response.success) {
                    if(response.type == 'id_no'){
                        $('#P_ID_NO').val(response.results.id);
                        $('#P_FIRST_NAME').val(response.results.fname);
                        $('#P_FASTHER_NAME').val(response.results.sname);
                        $('#P_GRAND_FATHER_NAME').val(response.results.tname);
                        $('#P_FAMILY_NAME').val(response.results.lname);
                        $('#P_BIRTH_DATE').val(response.results.birth_date.replace("00:00:00", ""));
                        $('#P_gender').val(response.results.sex);
                        $('#P_social_status_id').val(response.results.status);
                        //   $('#P_nationality_id').val(response.results.personal_info[0].marital_status);
                        $('#P_religion_id').val(response.results.religion);
                        $('#P_birth_state').val(response.results.birth_city);
                        $('#P_region_code').val(response.results.region);
                        $('#P_city_code').val(response.results.city);
                        $('#P_street').val(response.results.street);
                        $('#result_search').hide();
                        $('#display_data').show();
                    }else{
                        let data = [];
                            for (let i = 0,y=1; i <  response.results.length; i++) {
                                data.push([y++,response.results[i].id, response.results[i].fname+' '+response.results[i].sname+
                                    ' '+response.results[i].tname+' '+response.results[i].lname, response.results[i].birth_date.replace("00:00:00", "")
                                    , response.results[i].sex, response.results[i].status, response.results[i].region, response.results[i].city]);
                            }
                        $('#result_search').show();
                        $('#display_data').hide();
                        $('#result_tb').DataTable({
                            data: data,
                            destroy:true,
                        });

                    }

                } else {
                    Swal.fire({
                        title: 'خطأ !',
                        text: response.errors,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            });
        }


    </script>
@endpush
