@extends('layouts.main')
@section('title', 'تسجيل اشعار وفاة')
@section('content')


    <style>
        .mt-n1 {
            margin-top: 10px !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <!--begin::Card title-->
            <!--begin::Stepper-->
            <div class="stepper stepper-pills" id="kt_stepper_example_basic">
                <!--begin::Nav-->
                <div class="stepper-nav flex-center flex-wrap mb-10">
                    <!--begin::Step 1-->
                    <div class="stepper-item mx-2 my-4 current" data-kt-stepper-element="nav">
                        <!--begin::Line-->
                        <div class="stepper-line w-40px"></div>
                        <!--end::Line-->

                        <!--begin::Icon-->
                        <div class="stepper-icon w-40px h-40px">
                            <i class="stepper-check fas fa-check"></i>
                            <span class="stepper-number">1</span>
                        </div>
                        <!--end::Icon-->

                        <!--begin::Label-->
                        <div class="stepper-label">
                            <h3 class="stepper-title">
                                بيانات المتوفي
                            </h3>
                        </div>
                        <!--end::Label-->
                    </div>
                    <!--end::Step 1-->

                    <!--begin::Step 2-->
                    <div class="stepper-item mx-2 my-4" data-kt-stepper-element="nav">
                        <!--begin::Line-->
                        <div class="stepper-line w-40px"></div>
                        <!--end::Line-->

                        <!--begin::Icon-->
                        <div class="stepper-icon w-40px h-40px">
                            <i class="stepper-check fas fa-check"></i>
                            <span class="stepper-number">2</span>
                        </div>
                        <!--begin::Icon-->

                        <!--begin::Label-->
                        <div class="stepper-label">
                            <h3 class="stepper-title">
                                بيانات الطبيب
                            </h3>
                        </div>
                        <!--end::Label-->
                    </div>
                    <!--end::Step 2-->

                    <!--begin::Step 3-->
                    <div class="stepper-item mx-2 my-4" data-kt-stepper-element="nav">
                        <!--begin::Line-->
                        <div class="stepper-line w-40px"></div>
                        <!--end::Line-->

                        <!--begin::Icon-->
                        <div class="stepper-icon w-40px h-40px">
                            <i class="stepper-check fas fa-check"></i>
                            <span class="stepper-number">3</span>
                        </div>
                        <!--begin::Icon-->

                        <!--begin::Label-->
                        <div class="stepper-label">
                            <h3 class="stepper-title">
                                بيانات المبلغ
                            </h3>
                        </div>
                        <!--end::Label-->
                    </div>
                    <!--end::Step 3-->
                    <div class="stepper-item mx-2 my-4" data-kt-stepper-element="nav">
                        <!--begin::Line-->
                        <div class="stepper-line w-40px"></div>
                        <!--end::Line-->

                        <!--begin::Icon-->
                        <div class="stepper-icon w-40px h-40px">
                            <i class="stepper-check fas fa-check"></i>
                            <span class="stepper-number">4</span>
                        </div>
                        <!--begin::Icon-->

                        <!--begin::Label-->
                        <div class="stepper-label">
                            <h3 class="stepper-title">
                                خاص باستخدام مديرية الداخلية
                            </h3>
                        </div>
                        <!--end::Label-->
                    </div>
                    <!--end::Step 3-->
                </div>
                <!--end::Nav-->

                <!--begin::Form-->
                <form class="form fv-plugins-bootstrap5 fv-plugins-framework mx-auto" novalidate="novalidate"
                    id="insert_dead_form">
                    <input type="hidden" value="{{ @$dead_number }}" id="P_DEAD_NUMBER" name="P_DEAD_NUMBER">
                    <!--begin::Group-->
                    <div class="mb-6">
                        <!--begin::Step 1-->
                        <div class="flex-column current" data-kt-stepper-element="content">
                            <div class="fv-row mb-7">
                                <label class="d-block fw-bold fs-6 mb-3 p-3 bg-success text-white">البيانات الرئيسية
                                    <input type="checkbox" id="source" name="source" value="">
                                    <label for="source"> متوفي لجنة</label>
                                </label>
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-2 col-form-label required fw-bold fs-6">نوع الوثيقة
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-2">
                                        <!--begin::Col-->
                                        <select id="P_ID_TYPE" data-control="select2" data-placeholder="اختر ..."
                                            class="form-select form-select-lg fw-bold" onchange="generate_number();">
                                            <option value="">اختر...</option>
                                            <option value="1" selected>هوية</option>
                                            <option value="2">بدون هوية</option>
                                        </select>
                                        <!--end::Col-->
                                    </div>
                                    <!--begin::Label-->
                                    <label class="col-lg-2 col-form-label required fw-bold fs-6">رقم هوية
                                        المتوفي/ة

                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-3">
                                        <!--begin::Col-->
                                        <input type="number" name="P_ID_NO" id="P_ID_NO" maxLength="9"
                                            oninput="this.value=this.value.slice(0,this.maxLength)"
                                            class="form-control form-control-lg mb-3 mb-lg-0"
                                            onchange="check_dead_is_found()">
                                        <!--end::Col-->
                                    </div>
                                    <div class="col-lg-3" style="display: none;   color: #ff0000;" id="div_input">
                                        <input class="form-control form-control-lg mb-3 mb-lg-0 text-center" id="P_FLAG"
                                            value="" disabled>
                                        <input class="form-control form-control-lg mb-3 mb-lg-0 text-center" id="P_SOURSE"
                                            value="" type="hidden">

                                    </div>
                                </div>
                                <div class="row mb-8">
                                    <!--end::Col-->
                                    <label class="col-lg-2 col-form-label required fw-bold fs-6">الاسم رباعي
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <input type="text" id="P_FIRST_NAME"
                                                    class="form-control form-control-lg mb-3" placeholder="الاسم الأول">
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="text" id="P_FATHER_NAME"
                                                    class="form-control form-control-lg mb-3" placeholder="اسم الأب">
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="text" id="P_GRAND_FATHER_NAME"
                                                    class="form-control form-control-lg mb-3" placeholder="اسم الجد">
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="text" id="P_FAMILY_NAME"
                                                    class="form-control form-control-lg mb-3" placeholder="العائلة">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-2 col-form-label required fw-bold fs-6">تاريخ الميلاد</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-4">
                                        <input type="text" name="P_BIRTH_DATE" id="P_BIRTH_DATE"
                                            class="form-control form-control-lg mb-3 mb-lg-0">
                                    </div>
                                    <label class="col-lg-2 col-form-label required fw-bold fs-6">الجنس</label>
                                    <div class="col-lg-4 fv-row">
                                        <select id="P_SEX_CD" data-control="select2" data-placeholder="اختر ..."
                                            class="form-select form-select-lg fw-bold">
                                            <option value="">اختر...</option>
                                            <option value="1">ذكر</option>
                                            <option value="2">أنثى</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-6">

                                    <label class="col-lg-2 col-form-label required fw-bold fs-6">الحالة
                                        الاجتماعية</label>
                                    <div class="col-lg-4 fv-row">
                                        <select id="P_social_status_id" data-control="select2"
                                            data-placeholder="اختر ..." class="form-select form-select-lg fw-bold">
                                            <option></option>
                                            <option value="1" selected="selected">أعزب</option>
                                            <option value="2">متزوج</option>
                                            <option value="3">مطلق</option>
                                            <option value="4">أرمل</option>
                                            <option value="5">متعدد الزوجات</option>
                                            {{-- @foreach ($marital_status as $marital)
                                                <option value="{{ $marital->ms_code }}">{{ $marital->ms_name_ar }}
                                                </option>
                                            @endforeach --}}
                                        </select>
                                    </div>

                                    <label class="col-lg-5 col-form-label required fw-bold fs-5">ساعات الحياة اذا كان
                                        المتوفي طفلاً عاش أقل من 24ساعة </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-1">
                                        <input type="text" name="P_DEAD_HOURS" id="P_DEAD_HOURS"
                                            class="form-control form-control-lg mb-3 mb-lg-0">
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-2 col-form-label required fw-bold fs-6">المهنة</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-4 fv-row">
                                        <select id="P_JOB_CD" data-control="select2" data-placeholder="اختر..."
                                            class="form-select form-select-lg fw-bold">
                                            <option value="">اختر...</option>
                                            @foreach ($jobs as $job)
                                                <option value="{{ $job->job_code }}">{{ $job->job_name_ar }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-lg-2 col-form-label required fw-bold fs-6">مكان الولادة</label>
                                    <div class="col-lg-4">
                                        <input type="text" name="P_BIRTH_PLACE" id="P_BIRTH_PLACE"
                                            class="form-control form-control-lg mb-3 mb-lg-0">
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-2 col-form-label required fw-bold fs-6">الديانة</label>
                                    <div class="col-lg-4 fv-row">
                                        <select id="P_religion_id" data-control="select2" data-placeholder="اختر ..."
                                            class="form-select form-select-lg fw-bold">
                                            <option></option>
                                            @foreach ($religion as $item)
                                                <option value="{{ $item->re_code }}">{{ $item->re_name_ar }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-lg-2 col-form-label required fw-bold fs-6">الجنسية</label>
                                    <div class="col-lg-4 fv-row">
                                        <select id="P_nationality_id" data-control="select2" data-placeholder="اختر ..."
                                            class="form-select form-select-lg fw-bold">
                                            <option></option>
                                            @foreach ($nationality as $item)
                                                <option value="{{ $item->nat_code }}">{{ $item->nat_name_ar }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">


                                    <label class="col-lg-2 col-form-label fw-bold fs-6">مكان الإقامة /
                                        المحافظة</label>
                                    <div class="col-lg-4 fv-row">
                                        <select id="P_region_id" data-control="select2" data-placeholder="اختر ..."
                                            class="form-select form-select-lg fw-bold">
                                            <option></option>
                                            @foreach ($region as $item)
                                                <option value="{{ $item->r_code }}">{{ $item->r_name_ar }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-lg-2 col-form-label required fw-bold fs-6">المدينة</label>
                                    <div class="col-lg-4 fv-row">
                                        <select id="P_city_id" data-control="select2" data-placeholder="اختر ..."
                                            class="form-select form-select-lg fw-bold">
                                            <option></option>
                                            {{-- @foreach ($city as $item)
                                                <option value="{{ $item->c_code }}">{{ $item->c_name_ar }}
                                                </option>
                                            @endforeach --}}
                                        </select>
                                    </div>

                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <label class="col-lg-2 col-form-label required fw-bold fs-6">مكان الوفاة</label>
                                    <div class="col-lg-4 fv-row">
                                        <select id="P_DEATH_PLACE_CD" data-control="select2" data-placeholder="اختر..."
                                            class="form-select form-select-lg fw-bold">
                                            <option value="0">غير معروف</option>
                                            <option value="1">غزة</option>
                                            <option value="5">شمال غزة</option>
                                            <option value="6">المنطقة الوسطى</option>
                                            <option value="7">خانيونس</option>
                                            <option value="8">رفح</option>
                                            <option value="2">الضفة الغربية</option>
                                            <option value="3">داخل الخط الأخضرو القدس</option>
                                            <option value="4">خارج البلاد</option>

                                        </select>
                                    </div>
                                    <label class="col-lg-2 col-form-label required fw-bold fs-6">المستشفى</label>
                                    <div class="col-lg-4 fv-row">
                                        <select id="P_hospital_id" data-control="select2" data-placeholder="اختر ..."
                                            class="form-select form-select-lg fw-bold">
                                            <option></option>
                                            @foreach ($hospitals as $hospital)
                                                <option value="{{ $hospital['DREF_CODE'] }}">
                                                    {{ $hospital['DREF_NAME_AR'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label class="col-lg-2 col-form-label required fw-bold fs-6">مكان الوفاة /
                                        الدولة</label>
                                    {{-- <div class="col-lg-2 fv-row">
                                        <select id="P_DEATH_COUNTRY" data-control="select2" data-placeholder="اختر ..."
                                            class="form-select form-select-lg fw-bold">
                                            <option></option>

                                        </select>
                                    </div> --}}
                                    <div class="col-lg-4 fv-row">
                                        <input class="form-control" id="P_DEATH_COUNTRY" />
                                    </div>
                                    <label class="col-lg-2 col-form-label required fw-bold fs-6">المحافظة</label>
                                    <div class="col-lg-4 fv-row">
                                        <select id="P_DEATH_REGION_PLACE" data-control="select2"
                                            data-placeholder="اختر ..." class="form-select form-select-lg fw-bold">
                                            <option value="0" selected="selected">غير معروف</option>
                                            <option value="1">غزة</option>
                                            <option value="2">جباليا</option>
                                            <option value="3">دير البلح</option>
                                            <option value="4">خان يونس</option>
                                            <option value="5">رفح</option>
                                            <option value="6">جنين</option>
                                            <option value="7">نابلس</option>
                                            <option value="8">طولكرم</option>
                                            <option value="9">رام الله</option>
                                            <option value="10">أريحا</option>
                                            <option value="11">بيت لحم</option>
                                            <option value="12">الخليل</option>
                                            <option value="13">قلقيلية</option>
                                            <option value="14">الرام</option>
                                            <option value="15">يطا</option>
                                            <option value="16">دورا</option>
                                            <option value="17">سلفيت</option>
                                            <option value="18">أبو ديس</option>
                                            <option value="19">الشعراوية</option>
                                            <option value="20">حلحول</option>
                                            <option value="21">خارج البلاد</option>
                                            {{-- @foreach ($region as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                </option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-6">

                                    <label class="col-lg-2 col-form-label required fw-bold fs-6">المدينة</label>
                                    <div class="col-lg-4 fv-row">
                                        <select id="P_DEATH_CITY_PLACE" data-control="select2"
                                            data-placeholder="اختر ..." class="form-select form-select-lg fw-bold">
                                            <option value="0" selected="selected">غير معروف</option>
                                            {{-- <option value="1">غزة</option>
                                            <option value="2">جباليا</option>
                                            <option value="3">دير البلح</option>
                                            <option value="4">خان يونس</option>
                                            <option value="5">رفح</option>
                                            <option value="6">جنين</option>
                                            <option value="7">نابلس</option>
                                            <option value="8">طولكرم</option>
                                            <option value="9">رام الله</option>
                                            <option value="10">أريحا</option>
                                            <option value="11">بيت لحم</option>
                                            <option value="12">الخليل</option>
                                            <option value="13">قلقيلية</option>
                                            <option value="14">الرام</option>
                                            <option value="15">يطا</option>
                                            <option value="16">دورا</option>
                                            <option value="17">سلفيت</option>
                                            <option value="18">أبو ديس</option>
                                            <option value="19">الشعراوية</option> --}}
                                            {{-- @foreach ($city as $item)
                                                <option value="{{ $item->c_code }}">{{ $item->c_name_ar }}
                                                </option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                    <label class="col-lg-2 col-form-label required fw-bold fs-6">تاريخ الوفاة</label>
                                    <div class="col-lg-4 fv-row">
                                        <input class="form-control" id="P_Date_dead" />
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">


                                    <label class="col-lg-2 col-form-label required fw-bold fs-6">تفاصيل الوفاة</label>
                                    <div class="col-lg-4 fv-row">
                                        <select id="DEAD_DETAILS_CD" data-control="select2" data-placeholder="اختر ..."
                                            class="form-select form-select-lg fw-bold">
                                            <option></option>
                                            @foreach ($entry_detail as $item)
                                                <option value="{{ $item->death_cause_code }}">
                                                    {{ $item->death_cause_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-lg-2 col-form-label  fw-bold fs-6">مكان الدفن</label>
                                    <div class="col-lg-4 fv-row">
                                        <input class="form-control" id="P_Burial_Place" />
                                    </div>
                                </div>
                                <div class="row mb-6">

                                    <label class="col-lg-2 col-form-label  fw-bold fs-6">رقم تصريح الدفن</label>
                                    <div class="col-lg-4 fv-row">
                                        <input class="form-control" id="P_Burial_Permit_NO" />
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <label class="col-lg-2 col-form-label  fw-bold fs-6">هوية الزوج/ة</label>

                                    <div class="col-lg-3 fv-row">
                                        <input type="number" name="P_Wife_ID" id="P_Wife_ID" maxLength="9"
                                            oninput="this.value=this.value.slice(0,this.maxLength)"
                                            class="form-control form-control-lg mb-3 mb-lg-0"
                                            onchange="get_partner_data();">
                                    </div>
                                    <div class="col-lg-7 fv-row">
                                        <input class="form-control" id="P_Wife_Name" disabled readonly>
                                    </div>

                                </div>

                                <!--end::Input group-->
                                <div class="fv-row mb-7">
                                    <label class="d-block fw-bold fs-6 mb-5 p-3 bg-success text-white">أسباب
                                        الوفاة</label>
                                    <div class="row mb-6">
                                        <label class="col-lg-2 col-form-label  fw-bold fs-6 ">السبب المباشر
                                            للوفاة</label>

                                        <div class="col-lg-3 fv-row">
                                            <select id="DEAD_ICD1_CD" data-control="select2" data-placeholder="اختر ..."
                                                class="form-select form-select-lg fw-bold">
                                                <option></option>

                                            </select>
                                        </div>
                                        <div class="col-lg-7 fv-row">
                                            <select id="DIAG1_NAME" data-control="select2" data-placeholder="اختر ..."
                                                class="form-select form-select-lg fw-bold">
                                                <option></option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-2 col-form-label  fw-bold fs-6">نتيجة من</label>

                                        <div class="col-lg-3 fv-row">
                                            <select id="DEAD_ICD2_CD" data-control="select2" data-placeholder="اختر ..."
                                                class="form-select form-select-lg fw-bold">
                                                <option></option>

                                            </select>
                                        </div>
                                        <div class="col-lg-7 fv-row">
                                            <select id="DIAG2_NAME" data-control="select2" data-placeholder="اختر ..."
                                                class="form-select form-select-lg fw-bold">
                                                <option></option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-2 col-form-label  fw-bold fs-6">نتيجة من</label>

                                        <div class="col-lg-3 fv-row">
                                            <select id="DEAD_ICD3_CD" data-control="select2" data-placeholder="اختر ..."
                                                class="form-select form-select-lg fw-bold">
                                                <option></option>

                                            </select>
                                        </div>
                                        <div class="col-lg-7 fv-row">
                                            <select id="DIAG3_NAME" data-control="select2" data-placeholder="اختر ..."
                                                class="form-select form-select-lg fw-bold">
                                                <option></option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-2 col-form-label  fw-bold fs-6"> نتيجة من المرض
                                            الأصلى</label>

                                        <div class="col-lg-3 fv-row">
                                            <select id="DEAD_ICD4_CD" data-control="select2" data-placeholder="اختر ..."
                                                class="form-select form-select-lg fw-bold">
                                                <option></option>

                                            </select>
                                        </div>
                                        <div class="col-lg-7 fv-row">
                                            <select id="DIAG4_NAME" data-control="select2" data-placeholder="اختر ..."
                                                class="form-select form-select-lg fw-bold">
                                                <option></option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="d-block fw-bold fs-6 mb-5  p-3 bg-success text-white">أسباب أخرى
                                        للوفاة</label>
                                    <div class="row mb-6">
                                        {{-- <input name='kt_tagify_6' class='some_class_name' placeholder='write some tags' value=''> --}}
                                        <select class="form-select form-select-solid" data-control="select2"
                                            data-placeholder="Select an option" data-allow-clear="true"
                                            multiple="multiple" id="P_OTHER_CAUSE" name="P_OTHER_CAUSE[]"
                                            onchange="get_limit_option();">
                                            <option></option>

                                        </select>
                                    </div>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="d-block fw-bold fs-6 mb-5  p-3">
                                        إذا كان المتوفي إمرأة في سن الإنجاب 15-49 هل كانت حاملاً أو أجهضت:

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                id="inlineRadio1" checked>
                                            <label class="form-check-label" for="inlineRadio1">لا</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                id="inlineRadio2">
                                            <label class="form-check-label" for="inlineRadio2">نعم</label>
                                        </div>
                                    </label>
                                </div>
                                <div class="fv-row mb-7" id="mydiv">
                                    <label class="d-block fw-bold fs-6 mb-5  p-3">
                                        إذا كان نعم ما هو عدد أسابيع الحمل :
                                        <div class="form-check form-check-inline">

                                            <input class="form-control text-center" id="P_week_no" value="0" />
                                        </div>
                                        <div class="form-check form-check-inline">

                                            <label class="d-block fw-bold fs-6 mb-5  p-3">
                                                هل توفيت خلال 42 يوماً بعد الولادة:
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="weekRadioOptions" id="weekRadio1" checked>
                                                    <label class="form-check-label" for="inlineRadio1">لا</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="weekRadioOptions" id="weekRadio2">
                                                    <label class="form-check-label" for="inlineRadio2">نعم</label>
                                                </div>
                                            </label>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="flex-column" data-kt-stepper-element="content">
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label fw-bold fs-6">اسم الطبيب</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-3">
                                    <input type="text" name="P_Doctor_Name" id="P_Doctor_Name"
                                        class="form-control form-control-lg mb-3 mb-lg-0">
                                </div>
                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label fw-bold fs-6">التخصص</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-4">
                                    <input type="text" name="P_Special" id="P_Special"
                                        class="form-control form-control-lg mb-3 mb-lg-0">
                                </div>
                            </div>
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label  fw-bold fs-6">عنوان الطبيب</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-9">
                                    <input type="text" name="P_Doctor_Address" id="P_Doctor_Address"
                                        class="form-control form-control-lg mb-3 mb-lg-0">
                                </div>

                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label  fw-bold fs-6">تاريخ بداية العلاج</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-3">
                                    <input type="text" name="P_Begin_Treatment" id="P_Begin_Treatment"
                                        class="form-control form-control-lg mb-3 mb-lg-0">
                                </div>
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label  fw-bold fs-6">تاريخ رؤية المتوفي آخر مرة
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-3">
                                    <input type="text" name="P_Show_dead_Date" id="P_Show_dead_Date"
                                        class="form-control form-control-lg mb-3 mb-lg-0">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label  fw-bold fs-6">تاريخ رؤية الطبيب للجثة
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-3">
                                    <input type="text" name="P_Show_Corpse_Date" id="P_Show_Corpse_Date"
                                        class="form-control form-control-lg mb-3 mb-lg-0">
                                </div>
                                <label class="col-lg-3 col-form-label  fw-bold fs-6">تشريح الجثة</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="fav_Anatomy"
                                            id="No_Anatomy" value="0" checked>
                                        <label class="form-check-label" for="لا">لا</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="fav_Anatomy"
                                            id="Yes_Anatomy" value="1">
                                        <label class="form-check-label" for="نعم">نعم</label>

                                    </div>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->

                                <label class="col-lg-2 col-form-label  fw-bold fs-6">تاريخ تشريح الجثة
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-3">
                                    <input type="text" name="P_Anatomy_Corpse_Date" id="P_Anatomy_Corpse_Date"
                                        class="form-control form-control-lg mb-3 mb-lg-0">
                                </div>
                            </div>
                        </div>
                        <div class="flex-column" data-kt-stepper-element="content">
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">رقم هوية المبلغ/ة</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-3">
                                    <!--begin::Col-->
                                    <input type="number" name="P_advertiser_ID_NO" id="P_advertiser_ID_NO"
                                        maxLength="9" oninput="this.value=this.value.slice(0,this.maxLength)"
                                        class="form-control form-control-lg mb-3 mb-lg-0"
                                        onchange="get_submitted_dead();">
                                    <!--end::Col-->
                                </div>
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">اسم مقدم التبليغ</label>
                                <div class="col-lg-5">
                                    <input type="text" name="P_advertiser_Name" id="P_advertiser_Name"
                                        class="form-control form-control-lg mb-3 mb-lg-0" disabled readonly>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">الجنس</label>
                                <div class="col-lg-3 fv-row">
                                    <select id="P_advertiser_gender" data-control="select2"
                                        data-placeholder="اختر الجنس..." class="form-select form-select-lg fw-bold">
                                        <option value="">اختر...</option>
                                        <option value="1">ذكر</option>
                                        <option value="2">أنثى</option>
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">الجنسية</label>
                                <div class="col-lg-3 fv-row">
                                    <select id="P_advertiser_nationality_id" data-control="select2"
                                        data-placeholder="اختر ..." class="form-select form-select-lg fw-bold">
                                        <option></option>
                                        @foreach ($nationality as $item)
                                            <option value="{{ $item->nat_code }}">{{ $item->nat_name_ar }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">صلة القرابة</label>
                                <div class="col-lg-3">
                                    <input type="text" name="P_advertiser_Rel" id="P_advertiser_Rel"
                                        class="form-control form-control-lg mb-3 mb-lg-0">
                                </div>
                                <label class="col-lg-2 col-form-label  fw-bold fs-6">العنوان</label>
                                <div class="col-lg-5">
                                    <input type="text" name="P_advertiser_Address" id="P_advertiser_Address"
                                        class="form-control form-control-lg mb-3 mb-lg-0">
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label  fw-bold fs-6">رقم التليفون</label>
                                <div class="col-lg-3">
                                    <input type="text" name="P_advertiser_Phone" id="P_advertiser_Phone"
                                        class="form-control form-control-lg mb-3 mb-lg-0">
                                </div>
                                <label class="col-lg-2 col-form-label  fw-bold fs-6">تاريخ التبليغ
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-3">
                                    <input type="text" name="P_advertise_Date" id="P_advertise_Date"
                                        class="form-control form-control-lg mb-3 mb-lg-0">
                                </div>
                            </div>
                        </div>
                        <div class="flex-column" data-kt-stepper-element="content">
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label  fw-bold fs-6">تاريخ استلام التبليغ
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-3">
                                    <input type="text" name="P_advertise_receive_Date" id="P_advertise_receive_Date"
                                        class="form-control form-control-lg mb-3 mb-lg-0">
                                </div>
                                <label class="col-lg-2 col-form-label fw-bold fs-6">اسم الموظف </label>
                                <div class="col-lg-5">
                                    <input type="text" name="P_receive_emp_Name" id="P_receive_emp_Name"
                                        class="form-control form-control-lg mb-3 mb-lg-0">
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label  fw-bold fs-6">تاريخ تسجيل الواقعة
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-3">
                                    <input type="text" name="P_registery_Date" id="P_registery_Date"
                                        class="form-control form-control-lg mb-3 mb-lg-0">
                                </div>
                                <label class="col-lg-2 col-form-label fw-bold fs-6">اسم الموظف </label>
                                <div class="col-lg-5">
                                    <input type="text" name="P_regisery_emp_Name" id="P_regisery_emp_Name"
                                        class="form-control form-control-lg mb-3 mb-lg-0">
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-bold fs-6">مكان اصدار الاشعار</label>
                                <div class="col-lg-3 fv-row">
                                    <select id="P_Issuing_notice_place" data-control="select2"
                                        data-placeholder="اختر ..." class="form-select form-select-lg fw-bold">
                                        <option></option>
                                        @foreach ($entry_reg_place as $entry_reg_places)
                                            <option value="{{ $entry_reg_places->dref_code }}">
                                                {{ $entry_reg_places->dref_name_ar }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--begin::Actions-->
                    <div class="d-flex flex-stack">
                        <!--begin::Wrapper-->
                        <div class="me-2">
                            <button type="button" class="btn btn-light btn-active-light-primary"
                                data-kt-stepper-action="previous">
                                الخلف
                            </button>
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Wrapper-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            @if (IsPermissionBtn(25))
                                <button type="button" class="btn btn-primary" data-kt-stepper-action="submit"
                                    id="save_btn" onclick="save_dead_data();">
                                    <span class="indicator-label">
                                        حفظ البيانات
                                    </span>
                                    <span class="indicator-progress">
                                        انتظر من فضلك... <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            @endif
                            @if (IsPermissionBtn(26))
                                <button type="button" class="btn btn-primary" data-kt-stepper-action="submit"
                                    id="update_btn" onclick="update_dead_data();">
                                    <span class="indicator-label">
                                        حفظ التعديلات
                                    </span>
                                    <span class="indicator-progress">
                                        انتظر من فضلك... <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            @endif
                            <button type="button" class="btn btn-primary" data-kt-stepper-action="next">
                                التالي
                            </button>
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Stepper-->

        </div>
        <!--begin::Card header-->

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/plugins/global/tagify.min.js') }} "></script>

    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script>
        var block_insert_dead = document.querySelector("#insert_dead_form");
        var block_insert_dead = new KTBlockUI(block_insert_dead);
    </script>
    <script>
        $(document).ready(function() {


            //السبب المباشر
            getDeadIcdToSelect_Byid($("#DEAD_ICD1_CD"));
            getDeadIcdToSelect_Byname($("#DIAG1_NAME"));
            getDeadIcdToSelect_Byid($("#DEAD_ICD2_CD"));
            getDeadIcdToSelect_Byname($("#DIAG2_NAME"));
            getDeadIcdToSelect_Byid($("#DEAD_ICD3_CD"));
            getDeadIcdToSelect_Byname($("#DIAG3_NAME"));
            getDeadIcdToSelect_Byid($("#DEAD_ICD4_CD"));
            getDeadIcdToSelect_Byname($("#DIAG4_NAME"));
            getDeadIcdToSelect_Byname($("#P_OTHER_CAUSE"));

            if ($("#P_DEAD_NUMBER").val() != 0 || $("#P_DEAD_NUMBER").val() != '') {
                getDataDeadInfoBy($("#P_DEAD_NUMBER").val());
                document.getElementById('save_btn').style.visibility = 'hidden';
                document.getElementById('update_btn').style.visibility = 'visible';

            } else {
                document.getElementById('save_btn').style.visibility = 'visible';
                document.getElementById('update_btn').style.visibility = 'hidden';
            }

        });
        //   var iArray = [1,2,3,4];




        function getDeadIcdToSelect_Byname(select_id) {
            select_id.select2({
                ajax: {
                    url: "{{ route('dead.getDeadIcd_name') }}",
                    method: 'post',
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term
                        }

                        // Query parameters will be ?search=[term]&type=user_search
                        return query;
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    }
                },
                cache: true,
                placeholder: 'ابحث عن أسباب الوفاة',
                minimumInputLength: 1
            });
        }

        function getDeadIcdToSelect_Byid(select_id) {
            select_id.select2({
                ajax: {
                    url: "{{ route('dead.getDeadIcd_id') }}",
                    method: 'post',
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term
                        }

                        // Query parameters will be ?search=[term]&type=user_search
                        return query;
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    }
                },
                cache: true,
                placeholder: 'ابحث عن أسباب الوفاة',
                minimumInputLength: 1
            });
        }

        $('#DEAD_ICD1_CD').change(function() {
            var P_ICD_CODE = $(this).val();
            $.ajax({
                url: "{{ route('dead.getDeadIcd_bycode') }}",
                method: "POST",
                data: {
                    P_ICD_CODE: P_ICD_CODE
                },
                success: function(data) {
                    console.log(data);
                    $('#DIAG1_NAME').empty();
                    $('#DIAG1_NAME').append('<option value="' + data[0].ICD_CODE + '" >' + data[
                        0].ICD_NAME_EN + '</option>');

                }
            });
        });

        $('#DIAG1_NAME').change(function() {
            var P_ICD_CODE = $(this).val();
            $.ajax({
                url: "{{ route('dead.getDeadIcd_bycode') }}",
                method: "POST",
                data: {
                    P_ICD_CODE: P_ICD_CODE
                },
                success: function(data) {
                    console.log(data);
                    $('#DEAD_ICD1_CD').empty();
                    $('#DEAD_ICD1_CD').append('<option value="' + data[0].ICD_CODE + '" >' + data[0]
                        .ICD_CD + '</option>');

                }
            });
        });

        $('#DEAD_ICD2_CD').change(function() {
            var P_ICD_CODE = $(this).val();
            $.ajax({
                url: "{{ route('dead.getDeadIcd_bycode') }}",
                method: "POST",
                data: {
                    P_ICD_CODE: P_ICD_CODE
                },
                success: function(data) {
                    console.log(data);
                    $('#DIAG2_NAME').empty();
                    $('#DIAG2_NAME').append('<option value="' + data[0].ICD_CODE + '" >' +
                        data[0].ICD_NAME_EN + '</option>');

                }
            });
        });

        $('#DIAG2_NAME').change(function() {
            var P_ICD_CODE = $(this).val();
            $.ajax({
                url: "{{ route('dead.getDeadIcd_bycode') }}",
                method: "POST",
                data: {
                    P_ICD_CODE: P_ICD_CODE
                },
                success: function(data) {
                    console.log(data);
                    $('#DEAD_ICD2_CD').empty();
                    $('#DEAD_ICD2_CD').append('<option value="' + data[0].ICD_CODE + '" >' + data[
                        0].ICD_CD + '</option>');

                }
            });
        });

        $('#DEAD_ICD3_CD').change(function() {
            var P_ICD_CODE = $(this).val();
            $.ajax({
                url: "{{ route('dead.getDeadIcd_bycode') }}",
                method: "POST",
                data: {
                    P_ICD_CODE: P_ICD_CODE
                },
                success: function(data) {
                    console.log(data);
                    $('#DIAG3_NAME').empty();
                    $('#DIAG3_NAME').append('<option value="' + data[0].ICD_CODE + '" >' +
                        data[0].ICD_NAME_EN + '</option>');

                }
            });
        });

        $('#DIAG3_NAME').change(function() {
            var P_ICD_CODE = $(this).val();
            $.ajax({
                url: "{{ route('dead.getDeadIcd_bycode') }}",
                method: "POST",
                data: {
                    P_ICD_CODE: P_ICD_CODE
                },
                success: function(data) {
                    console.log(data);
                    $('#DEAD_ICD3_CD').empty();
                    $('#DEAD_ICD3_CD').append('<option value="' + data[0].ICD_CODE + '" >' + data[
                        0].ICD_CD + '</option>');

                }
            });
        });
        $('#DEAD_ICD4_CD').change(function() {
            var P_ICD_CODE = $(this).val();
            $.ajax({
                url: "{{ route('dead.getDeadIcd_bycode') }}",
                method: "POST",
                data: {
                    P_ICD_CODE: P_ICD_CODE
                },
                success: function(data) {
                    console.log(data);
                    $('#DIAG4_NAME').empty();
                    $('#DIAG4_NAME').append('<option value="' + data[0].ICD_CODE + '" >' +
                        data[0].ICD_NAME_EN + '</option>');

                }
            });
        });

        $('#DIAG4_NAME').change(function() {
            var P_ICD_CODE = $(this).val();
            $.ajax({
                url: "{{ route('dead.getDeadIcd_bycode') }}",
                method: "POST",
                data: {
                    P_ICD_CODE: P_ICD_CODE
                },
                success: function(data) {
                    console.log(data);
                    $('#DEAD_ICD4_CD').empty();
                    $('#DEAD_ICD4_CD').append('<option value="' + data[0].ICD_CODE + '" >' +
                        data[0].ICD_CD + '</option>');

                }
            });
        });
        // Stepper lement
        var element = document.querySelector("#kt_stepper_example_basic");

        // Initialize Stepper
        var stepper = new KTStepper(element);

        // Handle next step
        stepper.on("kt.stepper.next", function(stepper) {
            stepper.goNext(); // go next step
        });

        // Handle previous step
        stepper.on("kt.stepper.previous", function(stepper) {
            stepper.goPrevious(); // go previous step
        });

        var P_DEAD_DATE = $("#P_Date_dead").flatpickr({
            enableTime: true,
            dateFormat: "d/m/Y H:i",
            maxDate: new Date(),
        });
        var P_BIRTH_DATE = $("#P_BIRTH_DATE").flatpickr({
            enableTime: true,
            dateFormat: "d/m/Y",
            maxDate: new Date(),

        });
        var DEAD_DATE_OF_REPORT = $("#P_advertise_Date").flatpickr({
            enableTime: true,
            dateFormat: "d/m/Y H:i",
            maxDate: new Date(),

        });

        var DEAD_D_RECEIVE_DATE = $("#P_advertise_receive_Date").flatpickr({
            enableTime: true,
            dateFormat: "d/m/Y H:i",
            maxDate: new Date(),

        });

        var DEAD_D_REGISTER_DATE = $("#P_registery_Date").flatpickr({
            enableTime: true,
            dateFormat: "d/m/Y H:i",
            maxDate: new Date(),

        });


        var DEAD_D_TREATMENT_DATE = $("#P_Begin_Treatment").flatpickr({
            enableTime: true,
            dateFormat: "d/m/Y H:i",
            maxDate: new Date(),

        });
        var DEAD_D_PREVIEW_DATE = $("#P_Show_dead_Date").flatpickr({
            enableTime: true,
            dateFormat: "d/m/Y H:i",
            maxDate: new Date(),

        });
        var DEAD_D_SEEING_CORPSE_DATE = $("#P_Show_Corpse_Date").flatpickr({
            enableTime: true,
            dateFormat: "d/m/Y H:i",
            maxDate: new Date(),

        });
        var DEAD_D_CORPSE_DESSECTION_DATE = $("#P_Anatomy_Corpse_Date").flatpickr({
            enableTime: true,
            dateFormat: "d/m/Y H:i",
            maxDate: new Date(),

        });


        function save_dead_data() {
            //dead data
            var date1 = new Date($("#P_BIRTH_DATE").val(), 'd/m/Y H:i');
            var date2 = new Date($("#P_Date_dead").val(), 'd/m/Y H:i');

            // Calculating the time difference
            // of two dates
            var Difference_In_Time =
                date2.getTime() - date1.getTime();

            // Calculating the no. of days between
            // two dates
            var Difference_In_Days = Math.round(Difference_In_Time / (1000 * 3600));

            // To display the final no. of days (result)
            if ((Difference_In_Days < 24) && ($('#P_DEAD_HOURS').val() == '') || (Difference_In_Days < 24) && ($(
                    '#P_DEAD_HOURS').val() == NULL)) {
                Swal.fire({
                    title: 'يوجد خطأ في عملية الإدخال !',
                    text: 'يرجى إدخال عدد ساعات الحياة',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });

            } else {

                var P_ID_NO = $('#P_ID_NO').val();
                var P_ID_TYPE = $('#P_ID_TYPE').val();
                var P_FIRST_NAME = $('#P_FIRST_NAME').val();
                var P_FATHER_NAME = $('#P_FATHER_NAME').val();
                var P_GRAND_FATHER_NAME = $('#P_GRAND_FATHER_NAME').val();
                var P_FAMILY_NAME = $('#P_FAMILY_NAME').val();
                var P_BIRTH_DATE = $('#P_BIRTH_DATE').val();
                var P_DEAD_HOURS = $('#P_DEAD_HOURS').val();
                var P_BIRTH_PLACE = $('#P_BIRTH_PLACE').val();
                var P_JOB_CD = $('#P_JOB_CD').val();
                var P_SEX_CD = $('#P_SEX_CD').val();
                var P_MARTIAL_STATUS_CD = $('#P_social_status_id').val();
                var P_NATIONALITY_CD = $('#P_nationality_id').val();
                var P_RELEGION_CD = $('#P_religion_id').val();
                var P_DEATH_PLACE_CD = $('#P_DEATH_PLACE_CD').val();
                var P_HOS_CD = $('#P_hospital_id').val();
                var P_DEATH_COUNTRY = $('#P_DEATH_COUNTRY').val();
                var P_DEATH_REGION_PLACE = $('#P_DEATH_REGION_PLACE').val();
                var P_DEATH_CITY_PLACE = $('#P_DEATH_CITY_PLACE').val();
                var P_REGION_CD = $('#P_region_id').val();
                var P_CITY_CD = $('#P_city_id').val();
                var P_DATE_DEATH = $('#P_Date_dead').val();
                var P_BURIAL_PLACE = $('#P_Burial_Place').val();
                var P_BURIAL_CODE = $('#P_Burial_Permit_NO').val();
                var P_PARTNER_ID = $('#P_Wife_ID').val();
                var P_PARTNER_NAME = $('#P_Wife_Name').val();
                var P_DEAD_DETAILS_CD = $('#DEAD_DETAILS_CD').val();
                //ICD data
                var P_ICD_1 = $('#DEAD_ICD1_CD').val();
                var P_ICD_2 = $('#DEAD_ICD2_CD').val();
                var P_ICD_3 = $('#DEAD_ICD3_CD').val();
                var P_ICD_4 = $('#DEAD_ICD4_CD').val();

                var select1 = document.getElementById("P_OTHER_CAUSE");
                var selected1 = [];
                for (var i = 0; i < select1.length; i++) {
                    if (select1.options[i].selected) selected1.push(select1.options[i].value);
                }
                var P_ICD5_CD = selected1[0] ?? '';
                var P_ICD6_CD = selected1[1] ?? '';
                var P_ICD7_CD = selected1[2] ?? '';
                var P_ICD8_CD = selected1[3] ?? '';

                var P_PREGNANCY_CD = $('#inlineRadioOptions').val();
                var P_GESTATIONAL_WEEK = $('#P_week_no').val();
                var P_AFTER_DELIVERY_CD = $('#weekRadioOptions').val();

                //doctor data

                var P_REPORT_DOC_BY = $('#P_Doctor_Name').val();
                var P_DOC_SPECIALIST = $('#P_Special').val();
                var P_DOC_ADDRESS = $('#P_Doctor_Address').val();
                var P_TREATMENT_DATE = $('#P_Begin_Treatment').val();
                var P_PREVIEW_DATE = $('#P_Show_dead_Date').val();
                var P_SEEING_CORPSE_DATE = $('#P_Show_Corpse_Date').val();
                var P_CORPSE_DISSECTION_CD = $('#fav_Anatomy').val();
                var P_CORPSE_DESSECTION_DATE = $('#P_Anatomy_Corpse_Date').val();

                //Reporter data

                var P_REPORT_SUBMITTED_ID = $('#P_advertiser_ID_NO').val();
                var P_REPORT_SUBMITTED_BY = $('#P_advertiser_Name').val();
                var P_REPORTER_SEX_CD = $('#P_advertiser_gender').val();
                var P_REPORTER_NATIONALITY_CD = $('#P_advertiser_nationality_id').val();
                var P_RELATIONSHIP = $('#P_advertiser_Rel').val();
                var P_REPORTER_ADDRESS = $('#P_advertiser_Address').val();
                var P_REPORTER_MOBILE = $('#P_advertiser_Phone').val();
                var P_DATE_OF_REPORT = $('#P_advertise_Date').val();

                //Interior data

                var P_RECEIVE_DATE = $('#P_advertise_receive_Date').val();
                var P_RECEIVER_NAME = $('#P_receive_emp_Name').val();
                var P_REGISTER_DATE = $('#P_registery_Date').val();
                var P_REGISTER_NAME = $('#P_regisery_emp_Name').val();
                var P_REGISTER_PLACE_CD = $('#P_Issuing_notice_place').val();
                var P_SOURSE = $('#P_SOURSE').val();



                block_insert_dead.block();


                var url = "{{ route('dead.save_dead_info') }}";
                $.ajax({
                    url: url,
                    type: 'json',
                    method: 'post',
                    data: {
                        'P_ID_NO': P_ID_NO,
                        'P_ID_TYPE': P_ID_TYPE,
                        'P_FIRST_NAME': P_FIRST_NAME,
                        'P_FATHER_NAME': P_FATHER_NAME,
                        'P_GRAND_FATHER_NAME': P_GRAND_FATHER_NAME,
                        'P_FAMILY_NAME': P_FAMILY_NAME,
                        'P_BIRTH_DATE': P_BIRTH_DATE,
                        'P_DEAD_HOURS': P_DEAD_HOURS,
                        'P_BIRTH_PLACE': P_BIRTH_PLACE,
                        'P_JOB_CD': P_JOB_CD,
                        'P_SEX_CD': P_SEX_CD,
                        'P_MARTIAL_STATUS_CD': P_MARTIAL_STATUS_CD,
                        'P_NATIONALITY_CD': P_NATIONALITY_CD,
                        'P_RELEGION_CD': P_RELEGION_CD,
                        'P_HOS_CD': P_HOS_CD,
                        'P_DEATH_PLACE_CD': P_DEATH_PLACE_CD,
                        'P_DEATH_COUNTRY': P_DEATH_COUNTRY,
                        'P_DEATH_REGION_PLACE': P_DEATH_REGION_PLACE,
                        'P_DEATH_CITY_PLACE': P_DEATH_CITY_PLACE,
                        'P_REGION_CD': P_REGION_CD,
                        'P_CITY_CD': P_CITY_CD,
                        'P_DATE_DEATH': P_DATE_DEATH,
                        'P_PARTNER_ID': P_PARTNER_ID,
                        'P_PARTNER_NAME': P_PARTNER_NAME,
                        'P_DEAD_DETAILS_CD': P_DEAD_DETAILS_CD,
                        'P_ICD_1': P_ICD_1,
                        'P_ICD_2': P_ICD_2,
                        'P_ICD_3': P_ICD_3,
                        'P_ICD_4': P_ICD_4,
                        'P_ICD5_CD': P_ICD5_CD,
                        'P_ICD6_CD': P_ICD6_CD,
                        'P_ICD7_CD': P_ICD7_CD,
                        'P_ICD8_CD': P_ICD8_CD,
                        'P_PREGNANCY_CD': P_PREGNANCY_CD,
                        'P_GESTATIONAL_WEEK': P_GESTATIONAL_WEEK,
                        'P_AFTER_DELIVERY_CD': P_AFTER_DELIVERY_CD,
                        'P_REPORT_DOC_BY': P_REPORT_DOC_BY,
                        'P_DOC_SPECIALIST': P_DOC_SPECIALIST,
                        'P_DOC_ADDRESS': P_DOC_ADDRESS,
                        'P_TREATMENT_DATE': P_TREATMENT_DATE,
                        'P_PREVIEW_DATE': P_PREVIEW_DATE,
                        'P_SEEING_CORPSE_DATE': P_SEEING_CORPSE_DATE,
                        'P_CORPSE_DISSECTION_CD': P_CORPSE_DISSECTION_CD,
                        'P_CORPSE_DESSECTION_DATE': P_CORPSE_DESSECTION_DATE,
                        'P_REPORT_SUBMITTED_ID': P_REPORT_SUBMITTED_ID,
                        'P_REPORT_SUBMITTED_BY': P_REPORT_SUBMITTED_BY,
                        'P_REPORTER_SEX_CD': P_REPORTER_SEX_CD,
                        'P_REPORTER_NATIONALITY_CD': P_REPORTER_NATIONALITY_CD,
                        'P_RELATIONSHIP': P_RELATIONSHIP,
                        'P_REPORTER_ADDRESS': P_REPORTER_ADDRESS,
                        'P_REPORTER_MOBILE': P_REPORTER_MOBILE,
                        'P_DATE_OF_REPORT': P_DATE_OF_REPORT,
                        'P_RECEIVE_DATE': P_RECEIVE_DATE,
                        'P_RECEIVER_NAME': P_RECEIVER_NAME,
                        'P_REGISTER_DATE': P_REGISTER_DATE,
                        'P_REGISTER_NAME': P_REGISTER_NAME,
                        'P_REGISTER_PLACE_CD': P_REGISTER_PLACE_CD,
                        'P_BURIAL_PLACE': P_BURIAL_PLACE,
                        'P_BURIAL_CODE': P_BURIAL_CODE,
                        'P_SOURSE': P_SOURSE,

                    },
                }).done(function(response) {
                    console.log(response);
                    if (response.success) {
                        if (response.success == 1) {
                            Swal.fire({
                                title: 'تمت عملية إضافة إشعار الوفاة بنجاح !',
                                text: response.results.message,
                                icon: "success",
                                confirmButtonText: 'موافق'
                            });
                            $('#P_DEAD_NUMBER').val(response['P_DEAD_NUMBER']);

                            clear_form();

                        } else {

                            toastr["error"](response.results.message);
                        }
                    } else {
                        console.log(response);

                        Swal.fire({
                            title: 'يوجد خطأ في عملية الإدخال !',
                            text: response.errors,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                });
            }
            block_insert_dead.release();

        }

        function check_dead_is_found() {
            var P_ID_NO = $('#P_ID_NO').val();
            var P_ID_TYPE = $('#P_ID_TYPE').val();
            if (P_ID_NO != '') {
                var url = "{{ route('dead.check_is_found') }}";
                $.ajax({
                    url: url,
                    type: 'json',
                    method: 'post',
                    data: {
                        'ID_NO': P_ID_NO,
                        'P_ID_TYPE': P_ID_TYPE
                    },
                }).done(function(response) {
                    console.log(response);
                    if (response.success) {
                        if (response.success == 1) {

                            check_dead_record();
                        }
                    } else {
                        Swal.fire({
                            title: 'يوجد خطأ في عملية الإدخال !',
                            text: response.results,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });


                    }
                });
            }
        }

        function getDataPersonalInfoBy() {
            var P_ID_NO = $('#P_ID_NO').val();
            block_insert_dead.block();

            var url = "{{ route('dead.get_person_query') }}";
            $.ajax({
                url: url,
                type: 'json',
                method: 'post',
                data: {
                    'P_ID_NO': P_ID_NO,
                },
            }).done(function(response) {
                console.log(response);
                if (response.success) {

                    if (response.success == 1) {

                        $('#P_FIRST_NAME').val(response.results.fname);
                        $('#P_FATHER_NAME').val(response.results.sname);
                        $('#P_GRAND_FATHER_NAME').val(response.results.tname);
                        $('#P_FAMILY_NAME').val(response.results.lname);
                        $('#P_BIRTH_PLACE').val(response.results.BIRTH_PLACE);

                        // P_BIRTH_DATE.setDate(new Date(response.results.birth_date));

                        $('#P_BIRTH_DATE').val(response.results.birth_date);
                        $('#P_SEX_CD').val(response.results.sex).change();

                        //  $("#P_religion_id").val(response.results[0]['']).change();

                        $("#P_social_status_id").val(response.results.DEAD_PERSONALITY_CODE_CD).change();


                        $("#P_region_id").val(response.results.REGION_CD).change();

                        $("#P_city_id").val(response.results.CITY_CD).change();


                        if (response.results.DEATH_DT != null) {
                            Swal.fire({
                                title: 'خطأ !',
                                text: 'هذا الشخص متوفي بتاريخ ' + response.results.death_date,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        }
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
                        title: 'يوجد خطأ في عملية الإدخال !',
                        text: response.results.message,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });

                    check_dead_record();

                    //    block_insert_dead.release();


                }
                block_insert_dead.release();
            });
        }



        //update data
        function update_dead_data() {
            //dead data
            var P_DEAD_NUMBER = $('#P_DEAD_NUMBER').val();
            var P_ID_NO = $('#P_ID_NO').val();
            var P_ID_TYPE = $('#P_ID_TYPE').val();
            var P_FIRST_NAME = $('#P_FIRST_NAME').val();
            var P_FATHER_NAME = $('#P_FATHER_NAME').val();
            var P_GRAND_FATHER_NAME = $('#P_GRAND_FATHER_NAME').val();
            var P_FAMILY_NAME = $('#P_FAMILY_NAME').val();
            var P_BIRTH_DATE = $('#P_BIRTH_DATE').val();
            var P_DEAD_HOURS = $('#P_DEAD_HOURS').val();
            var P_BIRTH_PLACE = $('#P_BIRTH_PLACE').val();
            var P_JOB_CD = $('#P_JOB_CD').val();
            var P_SEX_CD = $('#P_SEX_CD').val();
            var P_MARTIAL_STATUS_CD = $('#P_social_status_id').val();
            var P_NATIONALITY_CD = $('#P_nationality_id').val();
            var P_RELEGION_CD = $('#P_religion_id').val();
            var P_DEATH_PLACE_CD = $('#P_DEATH_PLACE_CD').val();
            var P_HOS_CD = $('#P_hospital_id').val();
            var P_DEATH_COUNTRY = $('#P_DEATH_COUNTRY').val();
            var P_DEATH_REGION_PLACE = $('#P_DEATH_REGION_PLACE').val();
            var P_DEATH_CITY_PLACE = $('#P_DEATH_CITY_PLACE').val();
            var P_REGION_CD = $('#P_region_id').val();
            var P_CITY_CD = $('#P_city_id').val();
            var P_DATE_DEATH = $('#P_Date_dead').val();
            var P_BURIAL_PLACE = $('#P_Burial_Place').val();
            var P_BURIAL_CODE = $('#P_Burial_Permit_NO').val();
            var P_PARTNER_ID = $('#P_Wife_ID').val();
            var P_PARTNER_NAME = $('#P_Wife_Name').val();
            var P_ICD_1 = $('#DEAD_ICD1_CD').val();
            var P_ICD_2 = $('#DEAD_ICD2_CD').val();
            var P_ICD_3 = $('#DEAD_ICD3_CD').val();
            var P_ICD_4 = $('#DEAD_ICD4_CD').val();

            var select1 = document.getElementById("P_OTHER_CAUSE");
            var selected1 = [];
            for (var i = 0; i < select1.length; i++) {
                if (select1.options[i].selected) selected1.push(select1.options[i].value);
            }
            var P_ICD5_CD = selected1[0] ?? '';
            var P_ICD6_CD = selected1[1] ?? '';
            var P_ICD7_CD = selected1[2] ?? '';
            var P_ICD8_CD = selected1[3] ?? '';



            var P_PREGNANCY_CD = $('#inlineRadioOptions').val();
            var P_GESTATIONAL_WEEK = $('#P_week_no').val();
            var P_AFTER_DELIVERY_CD = $('#weekRadioOptions').val();

            //doctor data

            var P_REPORT_DOC_BY = $('#P_Doctor_Name').val();
            var P_DOC_SPECIALIST = $('#P_Special').val();
            var P_DOC_ADDRESS = $('#P_Doctor_Address').val();
            var P_TREATMENT_DATE = $('#P_Begin_Treatment').val();
            var P_PREVIEW_DATE = $('#P_Show_dead_Date').val();
            var P_SEEING_CORPSE_DATE = $('#P_Show_Corpse_Date').val();
            var P_CORPSE_DISSECTION_CD = $('#fav_Anatomy').val();
            var P_CORPSE_DESSECTION_DATE = $('#P_Anatomy_Corpse_Date').val();

            //Reporter data

            var P_REPORT_SUBMITTED_ID = $('#P_advertiser_ID_NO').val();
            var P_REPORT_SUBMITTED_BY = $('#P_advertiser_Name').val();
            var P_REPORTER_SEX_CD = $('#P_advertiser_gender').val();
            var P_REPORTER_NATIONALITY_CD = $('#P_advertiser_nationality_id').val();
            var P_RELATIONSHIP = $('#P_advertiser_Rel').val();
            var P_REPORTER_ADDRESS = $('#P_advertiser_Address').val();
            var P_REPORTER_MOBILE = $('#P_advertiser_Phone').val();
            var P_DATE_OF_REPORT = $('#P_advertise_Date').val();

            //Interior data

            var P_RECEIVE_DATE = $('#P_advertise_receive_Date').val();
            var P_RECEIVER_NAME = $('#P_receive_emp_Name').val();
            var P_REGISTER_DATE = $('#P_registery_Date').val();
            var P_REGISTER_NAME = $('#P_regisery_emp_Name').val();
            var P_REGISTER_PLACE_CD = $('#P_Issuing_notice_place').val();



            var url = "{{ route('dead.update_dead_info') }}";
            $.ajax({
                url: url,
                type: 'json',
                method: 'post',
                data: {
                    'P_DEAD_NUMBER': P_DEAD_NUMBER,
                    'P_ID_NO': P_ID_NO,
                    'P_ID_TYPE': P_ID_TYPE,
                    'P_FIRST_NAME': P_FIRST_NAME,
                    'P_FATHER_NAME': P_FATHER_NAME,
                    'P_GRAND_FATHER_NAME': P_GRAND_FATHER_NAME,
                    'P_FAMILY_NAME': P_FAMILY_NAME,
                    'P_BIRTH_DATE': P_BIRTH_DATE,
                    'P_DEAD_HOURS': P_DEAD_HOURS,
                    'P_BIRTH_PLACE': P_BIRTH_PLACE,
                    'P_JOB_CD': P_JOB_CD,
                    'P_SEX_CD': P_SEX_CD,
                    'P_MARTIAL_STATUS_CD': P_MARTIAL_STATUS_CD,
                    'P_NATIONALITY_CD': P_NATIONALITY_CD,
                    'P_RELEGION_CD': P_RELEGION_CD,
                    'P_HOS_CD': P_HOS_CD,
                    'P_DEATH_PLACE_CD': P_DEATH_PLACE_CD,
                    'P_DEATH_COUNTRY': P_DEATH_COUNTRY,
                    'P_DEATH_REGION_PLACE': P_DEATH_REGION_PLACE,
                    'P_DEATH_CITY_PLACE': P_DEATH_CITY_PLACE,
                    'P_REGION_CD': P_REGION_CD,
                    'P_CITY_CD': P_CITY_CD,
                    'P_DATE_DEATH': P_DATE_DEATH,
                    'P_PARTNER_ID': P_PARTNER_ID,
                    'P_PARTNER_NAME': P_PARTNER_NAME,
                    'P_ICD_1': P_ICD_1,
                    'P_ICD_2': P_ICD_2,
                    'P_ICD_3': P_ICD_3,
                    'P_ICD_4': P_ICD_4,
                    'P_ICD5_CD': P_ICD5_CD,
                    'P_ICD6_CD': P_ICD6_CD,
                    'P_ICD7_CD': P_ICD7_CD,
                    'P_ICD8_CD': P_ICD8_CD,
                    'P_PREGNANCY_CD': P_PREGNANCY_CD,
                    'P_GESTATIONAL_WEEK': P_GESTATIONAL_WEEK,
                    'P_AFTER_DELIVERY_CD': P_AFTER_DELIVERY_CD,
                    'P_REPORT_DOC_BY': P_REPORT_DOC_BY,
                    'P_DOC_SPECIALIST': P_DOC_SPECIALIST,
                    'P_DOC_ADDRESS': P_DOC_ADDRESS,
                    'P_TREATMENT_DATE': P_TREATMENT_DATE,
                    'P_PREVIEW_DATE': P_PREVIEW_DATE,
                    'P_SEEING_CORPSE_DATE': P_SEEING_CORPSE_DATE,
                    'P_CORPSE_DISSECTION_CD': P_CORPSE_DISSECTION_CD,
                    'P_CORPSE_DESSECTION_DATE': P_CORPSE_DESSECTION_DATE,
                    'P_REPORT_SUBMITTED_ID': P_REPORT_SUBMITTED_ID,
                    'P_REPORT_SUBMITTED_BY': P_REPORT_SUBMITTED_BY,
                    'P_REPORTER_SEX_CD': P_REPORTER_SEX_CD,
                    'P_REPORTER_NATIONALITY_CD': P_REPORTER_NATIONALITY_CD,
                    'P_RELATIONSHIP': P_RELATIONSHIP,
                    'P_REPORTER_ADDRESS': P_REPORTER_ADDRESS,
                    'P_REPORTER_MOBILE': P_REPORTER_MOBILE,
                    'P_DATE_OF_REPORT': P_DATE_OF_REPORT,
                    'P_RECEIVE_DATE': P_RECEIVE_DATE,
                    'P_RECEIVER_NAME': P_RECEIVER_NAME,
                    'P_REGISTER_DATE': P_REGISTER_DATE,
                    'P_REGISTER_NAME': P_REGISTER_NAME,
                    'P_REGISTER_PLACE_CD': P_REGISTER_PLACE_CD,
                    'P_BURIAL_PLACE': P_BURIAL_PLACE,
                    'P_BURIAL_CODE': P_BURIAL_CODE,

                },
            }).done(function(response) {
                if (response.success) {
                    if (response.success == 1) {
                        Swal.fire({
                            title: 'تمت عملية تعديل إشعار الوفاة بنجاح !',
                            text: response.results.message,
                            icon: "success",
                            confirmButtonText: 'موافق'
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                let new_window =
                                    open(location, '_self');

                                // Close this window
                                new_window.close();
                            }
                        });


                    } else {

                        toastr["error"](response.results.message);
                    }




                } else {
                    console.log(response);

                    Swal.fire({
                        title: 'يوجد خطأ في عملية الإدخال !',
                        text: response.errors,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            });

        }

        function getDataDeadInfoBy(P_DEAD_NUMBER) {
            var url = "{{ route('dead.getDeadInfoByCodeNo') }}";
            $.ajax({
                url: url,
                type: 'json',
                method: 'post',
                data: {
                    'P_DEAD_NUMBER': P_DEAD_NUMBER
                },
            }).done(function(response) {
                console.log(response);
                $('#P_ID_TYPE').val(response.results[0]['DEAD_ID_TYPE']).change();
                $('#P_ID_NO').val(response.results[0]['DEAD_ID']);
                $('#P_FIRST_NAME').val(response.results[0]['DEAD_FIRST_NAME_AR']);
                $('#P_FATHER_NAME').val(response.results[0]['DEAD_FATHER_NAME_AR']);
                $('#P_GRAND_FATHER_NAME').val(response.results[0]['DEAD_GRANDFATHER_NAME_AR']);
                $('#P_FAMILY_NAME').val(response.results[0]['DEAD_LAST_NAME_AR']);

                P_BIRTH_DATE.setDate(new Date(response.results[0]['DEAD_DOB']));

                P_DEAD_DATE.setDate(new Date(response.results[0]['DEAD_DOD']));

                $('#P_DEAD_HOURS').val(response.results[0]['DEAD_HOURS']);
                $('#P_BIRTH_PLACE').val(response.results[0]['DEAD_D_BIRTH_PLACE']);
                $('#P_JOB_CD').val(response.results[0]['DEAD_D_JOB_CD']).change();
                $('#P_SEX_CD').val(response.results[0]['DEAD_SEX_CD']).change();
                $('#P_social_status_id').val(response.results[0]['DEAD_MARTIAL_STATUS_CD']).change();
                $('#P_nationality_id').val(response.results[0]['DEAD_NATIONALITY_CD']).change();
                $('#P_religion_id').val(response.results[0]['DEAD_D_RELEGION_CD']).change();
                $('#P_DEATH_PLACE_CD').val(response.results[0]['DEAD_DEATH_PLACE_CD']).change();
                $('#P_hospital_id').val(response.results[0]['DEAD_HOS_NAME_CD']).change();
                $('#P_DEATH_REGION_PLACE').val(response.results[0]['DEAD_DEATH_REGION_PLACE']).change();
                $('#P_DEATH_CITY_PLACE').val(response.results[0]['DEAD_DEATH_CITY_PLACE']).change();
                $('#P_region_id').val(response.results[0]['DEAD_REGION_CD']).change();
                $('#P_city_id').val(response.results[0]['DEAD_CITY_CD']).change();

                if (response.results[0]['DEAD_ICD1_CD'] != null) {

                    var option1 = new Option(response.results[0]['DEAD_ICD1_CODE'] ?? '', response.results[0][
                            'DEAD_ICD1_CD'
                        ] ?? '',
                        true, true);
                    $('#DEAD_ICD1_CD').append(option1).trigger('change');
                }
                if (response.results[0]['DEAD_ICD2_CD'] != null) {

                    var option2 = new Option(response.results[0]['DEAD_ICD2_CODE'], response.results[0][
                            'DEAD_ICD2_CD'
                        ],
                        true, true);
                    $('#DEAD_ICD2_CD').append(option2).trigger('change');
                }
                if (response.results[0]['DEAD_ICD3_CD'] != null) {

                    var option3 = new Option(response.results[0]['DEAD_ICD3_CODE'], response.results[0][
                            'DEAD_ICD3_CD'
                        ],
                        true, true);
                    $('#DEAD_ICD3_CD').append(option3).trigger('change');
                }
                if (response.results[0]['DEAD_ICD4_CD'] != null) {

                    var option4 = new Option(response.results[0]['DEAD_ICD4_CODE'], response.results[0][
                            'DEAD_ICD4_CD'
                        ],
                        true, true);
                    $('#DEAD_ICD4_CD').append(option4).trigger('change');
                }
                var options = [];
                if (response.results[0]['DEAD_ICD5_CD'] != null) {
                    var option5 = new Option(response.results[0]['DEAD_ICD5_NAME'], response.results[0][
                        'DEAD_ICD5_CD'
                    ], true, true);
                    options.push(option5);
                }
                if (response.results[0]['DEAD_ICD6_CD'] != null) {
                    var option6 = new Option(response.results[0]['DEAD_ICD6_NAME'], response.results[0][
                        'DEAD_ICD6_CD'
                    ], true, true);
                    options.push(option6);
                }
                if (response.results[0]['DEAD_ICD7_CD'] != null) {

                    var option7 = new Option(response.results[0]['DEAD_ICD7_NAME'], response.results[0][
                        'DEAD_ICD7_CD'
                    ], true, true);
                    options.push(option7);
                }
                if (response.results[0]['DEAD_ICD8_CD'] != null) {

                    var option8 = new Option(response.results[0]['DEAD_ICD8_NAME'], response.results[0][
                        'DEAD_ICD8_CD'
                    ], true, true);
                    options.push(option8);
                }
                $("#P_OTHER_CAUSE").append($(options));


                $("#P_Dead_Cause_id").val(response.results[0]['DEATH_DETAILS_CAUSE_CD']).change();
                $("#P_advertiser_gender").val(response.results[0]['DEAD_D_REPORTER_SEX_CD']).change();
                $("#P_advertiser_nationality_id").val(response.results[0]['DEAD_D_REPORTER_NATIONALITY_CD'])
                    .change();
                // $('#P_Date_dead').val(response.results[0]['DOD']);
                $('#P_DEATH_COUNTRY').val(response.results[0]['DEAD_DEATH_COUNTRY']);
                $('#P_Burial_Place').val(response.results[0]['DEAD_D_BURIAL_PLACE']);
                $('#P_Burial_Permit_NO').val(response.results[0]['DEAD_D_BURIAL_CODE']);
                $('#P_Wife_ID').val(response.results[0]['DEAD_D_PARTNER_ID']);
                $('#P_Wife_Name').val(response.results[0]['DEAD_D_PARTNER_NAME']);

                $('input[name="inlineRadioOptions"][value="' + response.results[0]['DEAD_D_PREGNANCY_CD'] + '"]')
                    .prop('checked', true);
                $('#P_week_no').val(response.results[0]['DEAD_D_GESTATIONAL_WEEK']);
                $('input[name="weekRadioOptions"][value="' + response.results[0]['DEAD_D_AFTER_DELIVERY_CD'] + '"]')
                    .prop('checked', true);
                $('#P_Doctor_Name').val(response.results[0]['DEAD_REPORT_DOC_BY']);
                $('#P_Special').val(response.results[0]['DEAD_D_DOC_SPECIALIST']);
                $('#P_Doctor_Address').val(response.results[0]['DEAD_D_DOC_ADDRESS']);
                //  $('#P_Begin_Treatment').val(response.results[0]['DEAD_D_TREATMENT_DATE']);
                // $('#P_Show_dead_Date').val(response.results[0]['DEAD_D_PREVIEW_DATE']);
                //$('#P_Show_Corpse_Date').val(response.results[0]['DEAD_D_SEEING_CORPSE_DATE']);
                $('input[name="fav_Anatomy"][value="' + response.results[0]['DEAD_D_CORPSE_DISSECTION_CD'] + '"]')
                    .prop('checked', true);
                //     $('#P_Anatomy_Corpse_Date').val(response.results[0]['DEAD_D_CORPSE_DESSECTION_DATE']);
                $('#P_advertiser_ID_NO').val(response.results[0]['DEAD_REPORT_SUBMITTED_ID']);
                $('#P_advertiser_Name').val(response.results[0]['DEAD_REPORT_SUBMITTED_BY']);

                $('#P_advertiser_Rel').val(response.results[0]['DEAD_D_RELATIONSHIP']);
                $('#P_advertiser_Address').val(response.results[0]['DEAD_D_REPORTER_ADDRESS']);
                $('#P_advertiser_Phone').val(response.results[0]['DEAD_D_REPORTER_MOBILE']);
                // $('#P_advertise_Date').val(response.results[0]['DEAD_DATE_OF_REPORT']);
                // $('#P_advertise_receive_Date').val(response.results[0]['DEAD_D_RECEIVE_DATE']);
                $('#P_receive_emp_Name').val(response.results[0]['DEAD_D_RECEIVER_NAME']);
                $('#P_registery_Date').val(response.results[0]['DEAD_D_REGISTER_DATE']);
                $('#P_regisery_emp_Name').val(response.results[0]['DEAD_D_REGISTER_NAME']);
                $('#P_Issuing_notice_place').val(response.results[0]['DEAD_REGISTER_PLACE_CD']).change();

                DEAD_DATE_OF_REPORT.setDate(new Date(response.results[0]['DEAD_DATE_OF_REPORT']));

                if (response.results[0]['DEAD_D_RECEIVE_DATE'] != null) {
                    DEAD_D_RECEIVE_DATE.setDate(new Date(response.results[0]['DEAD_D_RECEIVE_DATE']));
                }
                if (response.results[0]['DEAD_D_REGISTER_DATE'] != null) {
                    DEAD_D_REGISTER_DATE.setDate(new Date(response.results[0]['DEAD_D_REGISTER_DATE']));
                }



                if (response.results[0]['DEAD_D_TREATMENT_DATE'] != null) {
                    DEAD_D_TREATMENT_DATE.setDate(new Date(response.results[0]['DEAD_D_TREATMENT_DATE']));
                }
                if (response.results[0]['DEAD_D_PREVIEW_DATE'] != null) {
                    DEAD_D_PREVIEW_DATE.setDate(new Date(response.results[0]['DEAD_D_PREVIEW_DATE']));
                }


                if (response.results[0]['DEAD_D_SEEING_CORPSE_DATE'] != null) {
                    DEAD_D_SEEING_CORPSE_DATE.setDate(new Date(response.results[0]['DEAD_D_SEEING_CORPSE_DATE']));
                }
                if (response.results[0]['DEAD_D_CORPSE_DESSECTION_DATE'] != null) {
                    DEAD_D_CORPSE_DESSECTION_DATE.setDate(new Date(response.results[0][
                        'DEAD_D_CORPSE_DESSECTION_DATE'
                    ]));
                }


            });

        }

        function check_dead_record() {
            var form_date = new FormData($('#insert_dead_form')[0]);
            var url = "{{ route('check_records') }}";
            $.ajax({
                url: url,
                type: 'json',
                method: 'post',
                cache: false,
                processData: false,
                contentType: false,
                data: form_date,
            }).done(function(response) {
                console.log(response.results);

                if (response == 3) {
                    $('#P_FLAG').val('وفاة عادية (غير شهيد)');
                    $('#P_SOURSE').val(0);

                } else if (response == 0) {

                    if ($('#source').is(':checked') && ($('#P_ID_NO').val() != null || $('#P_ID_NO').val() != '')) {
                        $('#P_FLAG').val('متوفي لجنة');
                        $('#P_SOURSE').val(2);
                    } else {
                        $('#P_FLAG').val('وفاة عادية (غير شهيد)');
                        $('#P_SOURSE').val(0);
                    }


                } else if (response == 1) {
                    $('#P_FLAG').val('تبليغ ذوي الشهداء');
                    $('#P_SOURSE').val(1);

                    Swal.fire({
                        text: ' يرجى مراجعة نظم المعلومات او اللجنة القضائية   !',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                    block_insert_dead.block();
                    $('#save_btn').hide();

                } else if (response == 2) {
                    $('#P_FLAG').val('شهيد');
                    $('#P_SOURSE').val(1);


                }
                var foo = document.getElementById('div_input');

                foo.style.display = 'block';

                getDataPersonalInfoBy();

            });
        }


        function get_partner_data() {
            var P_ID_NO = $('#P_Wife_ID').val();
            block_insert_dead.block();

            var url = "{{ route('dead.get_person_query') }}";
            $.ajax({
                url: url,
                type: 'json',
                method: 'post',
                data: {
                    'P_ID_NO': P_ID_NO,
                },
            }).done(function(response) {
                console.log(response);
                if (response.success) {

                    if (response.success == 1) {

                        $('#P_Wife_Name').val(response.results.fname + ' ' + response.results.sname + ' ' + response
                            .results.tname + ' ' + response.results.lname);

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
                        title: 'يوجد خطأ في عملية الإدخال !',
                        text: response.results,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });




                }
                block_insert_dead.release();
            });
        }

        function get_submitted_dead() {
            var P_ID_NO = $('#P_advertiser_ID_NO').val();
            block_insert_dead.block();

            var url = "{{ route('dead.get_person_query') }}";
            $.ajax({
                url: url,
                type: 'json',
                method: 'post',
                data: {
                    'P_ID_NO': P_ID_NO,
                },
            }).done(function(response) {
                console.log(response);
                if (response.success) {

                    if (response.success == 1) {

                        $('#P_advertiser_Name').val(response.results.fname + ' ' + response.results.sname + ' ' +
                            response.results.tname + ' ' + response.results.lname);
                        $('#P_advertiser_gender').val(response.results.sex).change();

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
                        title: 'يوجد خطأ في عملية الإدخال !',
                        text: response.results,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });




                }
                block_insert_dead.release();
            });
        }

        function get_limit_option() {
            var selectedOptions = $("#P_OTHER_CAUSE").find('option:selected');
            var maxSelections = 4;
            if (selectedOptions.length > maxSelections) {
                // Disable excess selections
                alert("You can only select up to " + maxSelections + " options.");
                selectedOptions.slice(maxSelections).prop("disabled", true);

            }
        }

        /**************************************************************************************************************************************************************************************************/
        function clear_form() {
            $('#insert_dead_form')[0].reset();
            $('#insert_dead_form .form-select').val(' ').trigger('change');
            block_insert_dead.release();
        }
        /**************************************************************************************************************************************************************************************************/

        $('#P_DEATH_REGION_PLACE').change(function() {
            var region_cd = $(this).val();
            var url = "{{ route('dead.get_city') }}";
            $.ajax({
                url: url,
                type: 'json',
                method: 'post',
                async: false,
                data: {
                    region_cd: region_cd
                },
                success: function(data) {
                    console.log(data);
                    $('#P_DEATH_CITY_PLACE').empty();

                    $('#P_DEATH_CITY_PLACE').append('<option >  </option>');
                    $.each(data, function(key, value) {
                        // console.log(value.C_NAME_AR);

                        $('#P_DEATH_CITY_PLACE').append('<option value="' + value.C_CODE +
                            '" >' + value.C_NAME_AR + '</option>');
                    });

                }
            });
        });


        $('#P_region_id').change(function() {
            var region_cd = $(this).val();
            var url = "{{ route('dead.get_city') }}";
            $.ajax({
                url: url,
                type: 'json',
                method: 'post',
                async: false,
                data: {
                    region_cd: region_cd
                },
                success: function(data) {
                    console.log(data);
                    $('#P_city_id').empty();
                    console.log(3);
                    $('#P_city_id').append('<option >  </option>');
                    $.each(data, function(key, value) {
                        // console.log(value.C_NAME_AR);

                        $('#P_city_id').append('<option value="' + value.C_CODE +
                            '" >' + value.C_NAME_AR + '</option>');
                    });

                }
            });
        });

        function generate_number() {
            if ($('#P_ID_TYPE').val() == 2) {
                $('#P_ID_NO').val('');
                // var random_num = Math.floor(100000000 + Math.random() * 999999999);
                document.getElementById('P_ID_NO').readOnly = true;
                document.getElementById('P_FIRST_NAME').readOnly = false;
                document.getElementById('P_FATHER_NAME').readOnly = false;
                document.getElementById('P_GRAND_FATHER_NAME').readOnly = false;
                document.getElementById('P_FAMILY_NAME').readOnly = false;
                document.getElementById('P_BIRTH_DATE').readOnly = false;
                document.getElementById('P_city_id').disabled = false;
                document.getElementById('P_region_id').disabled = false;



            } else {
                $('#P_ID_NO').val('');
                document.getElementById('P_ID_NO').readOnly = false;
                document.getElementById('P_FIRST_NAME').readOnly = true;
                document.getElementById('P_FATHER_NAME').readOnly = true;
                document.getElementById('P_GRAND_FATHER_NAME').readOnly = true;
                document.getElementById('P_FAMILY_NAME').readOnly = true;
                document.getElementById('P_BIRTH_DATE').readOnly = true;
                document.getElementById('P_city_id').disabled = true;
                document.getElementById('P_region_id').disabled = true;
            }
        }
    </script>
@endpush
