@extends('layouts.main')
@section('title', 'إضافة إشعار ولادة')

@section('content')
    <style>
        .mt-n1 {
            margin-top: 10px !important;
        }
    </style>
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
                                بيانات الأب
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
                                بيانات الأم
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
                                بيانات الولادة
                            </h3>
                        </div>

                        <!--end::Label-->
                    </div>
                    <!--begin::Step 4-->

                    <!--end::Step 3-->
                </div>
                <!--end::Nav-->

                <!--begin::Form-->
                <form class="form fv-plugins-bootstrap5 fv-plugins-framework mx-auto" novalidate="novalidate"
                    id="kt_stepper_example_basic_form">
                    <input type="hidden" value="{{ @$P_BI_CODE }}" id="P_BI_CODE" name="P_BI_CODE">

                    <!--begin::Group-->
                    <div class="mb-6">
                        <!--begin::Step 1-->
                        <div class="flex-column current" data-kt-stepper-element="content">
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">نوع الوثيقة</label>
                                <!--end::Label-->
                                <div class="col-lg-2 fv-row">
                                    <select id="f_type_id" name="f_type_id" data-control="select2"
                                        data-placeholder="اختر ..." class="form-select form-select-lg fw-bold">
                                        <option></option>
                                        <option value="1" selected>هوية </option>
                                        <option value="2">جواز سفر </option>
                                    </select>
                                </div>
                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">رقم الهوية</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-2">
                                    <!--begin::Col-->
                                    <input type="number" name="P_FATHER_ID" id="P_FATHER_ID" maxLength="9"
                                        oninput="this.value=this.value.slice(0,this.maxLength)"
                                        class="form-control text-center form-control-lg mb-3 mb-lg-0"
                                        placeholder="رقم الهوية" onchange="getDataFatherInfoBy();">
                                    <!--end::Col-->
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-primary"
                                        onclick="edit_father_data();">تحديث</button>
                                    <input name="FATHER_DATA_FRM_MOI" type="hidden" id="FATHER_DATA_FRM_MOI"
                                        value="0" />
                                    <input name="FATHER_NUMBER" type="hidden" id="FATHER_NUMBER" value="" />

                                </div>
                            </div>
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label  fw-bold fs-6">اسم الأب رباعي</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <input type="text" id="IN_FIRST_NAME"
                                                class="form-control text-center form-control-lg mb-3"
                                                placeholder="الاسم الأول" disabled>
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="text" id="IN_SECOND_NAME"
                                                class="form-control text-center form-control-lg mb-3" placeholder="اسم الأب"
                                                disabled>
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="text" id="IN_THIRD_NAME"
                                                class="form-control text-center form-control-lg mb-3"
                                                placeholder="اسم الجد" disabled>
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="text" id="IN_LAST_NAME"
                                                class="form-control text-center form-control-lg mb-3"
                                                placeholder="العائلة" disabled>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label  fw-bold fs-6">تاريخ ميلاد الأب</label>
                                <div class="col-lg-2 fv-row">
                                    <input class="form-control text-center" id="P_FATHER_BIRTH_DATE" disabled>
                                </div>

                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">مكان ميلاد الأب</label>
                                <div class="col-lg-2">
                                    <!--begin::Col-->
                                    <input type="text" name="P_birth_state" id="P_birth_state"
                                        class="form-control text-center form-control-lg mb-3 mb-lg-0" disabled>
                                    <!--end::Col-->
                                </div>
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">مكان ميلاد والد الأب</label>
                                <div class="col-lg-2">
                                    <!--begin::Col-->
                                    <input type="text" name="f_birth_state" id="f_birth_state"
                                        class="form-control text-center form-control-lg mb-3 mb-lg-0" disabled>
                                    <!--end::Col-->
                                </div>

                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label fw-bold fs-6">الحالة الاجتماعية للأب</label>
                                <div class="col-lg-2 fv-row">
                                    <input class="form-control text-center" id="P_social_status_name" disabled
                                        type="hidden">

                                    <select id="P_social_status_id" data-control="select2"
                                        data-placeholder="الحالة الاجتماعية" class="form-select form-select-lg fw-bold">
                                        <option></option>
                                        @foreach ($marital_status as $item)
                                            <option value="{{ $item->ms_code }}">{{ $item->ms_name_ar }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                                <!--begin::Label-->

                                <label class="col-lg-2 col-form-label  fw-bold fs-6">مهنة الأب</label>
                                <div class="col-lg-2 fv-row">
                                    <input class="form-control text-center" id="P_FATHER_JOB_NAME" type="hidden">
                                    <select id="P_FATHER_JOB_CD" data-control="select2" data-placeholder="المهنة"
                                        class="form-select form-select-lg fw-bold">
                                        <option></option>
                                        @foreach ($jobs as $item)
                                            <option value="{{ $item->job_code }}">{{ $item->job_name_ar }}
                                            </option>
                                        @endforeach

                                    </select>

                                </div>

                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">عدد سنوات دراسة الأب</label>
                                <div class="col-lg-2">
                                    <!--begin::Col-->
                                    <input type="text" name="f_Year_Edu" id="f_Year_Edu"
                                        class="form-control text-center form-control-lg mb-3 mb-lg-0">
                                    <!--end::Col-->
                                </div>
                            </div>
                            <div class="row mb-6">

                                <label class="col-lg-2 col-form-label  fw-bold fs-6">العنوان كاملاً</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <select id="f_region_id" data-control="select2" data-placeholder="المحافظة"
                                                class="form-select form-select-lg fw-bold">
                                                <option></option>
                                                @foreach ($region as $item)
                                                    <option value="{{ $item->r_code }}">{{ $item->r_name_ar }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-4">
                                            <select id="f_city_id" data-control="select2" data-placeholder="المدينة"
                                                class="form-select form-select-lg fw-bold">
                                                <option></option>
                                                @foreach ($city as $item)
                                                    <option value="{{ $item->c_code }}">{{ $item->c_name_ar }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--begin::Step 1-->

                        <!--begin::Step 1-->
                        <div class="flex-column" data-kt-stepper-element="content">
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">نوع الوثيقة</label>
                                <!--end::Label-->
                                <div class="col-lg-2 fv-row">
                                    <select id="P_type_id" name="m_type_id" data-control="select2"
                                        data-placeholder="اختر ..." class="form-select form-select-lg fw-bold">
                                        <option></option>
                                        <option value="1" selected>هوية </option>
                                        <option value="2">جواز سفر </option>
                                    </select>
                                </div>
                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">رقم الهوية</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-2">
                                    <!--begin::Col-->
                                    <input type="number" name="P_MOTHER_ID" id="P_MOTHER_ID" maxLength="9"
                                        oninput="this.value=this.value.slice(0,this.maxLength)"
                                        class="form-control text-center form-control-lg mb-3 mb-lg-0"
                                        placeholder="رقم الهوية" onchange="getDataMotherInfoBy();">
                                    <!--end::Col-->
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-primary"
                                        onclick="edit_mother_data();">تحديث</button>
                                    <input name="MOTHER_DATA_FRM_MOI" type="hidden" id="MOTHER_DATA_FRM_MOI"
                                        value="0" />
                                    <input name="MOTHER_NUMBER" type="hidden" id="MOTHER_NUMBER" value="" />
                                </div>

                            </div>
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label  fw-bold fs-6">اسم الأم رباعي</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <input type="text" id="M_FIRST_NAME"
                                                class="form-control text-center form-control-lg mb-3"
                                                placeholder="الاسم الأول" disabled>
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="text" id="M_SECOND_NAME"
                                                class="form-control text-center form-control-lg mb-3"
                                                placeholder="اسم الأب" disabled>
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="text" id="M_THIRD_NAME"
                                                class="form-control text-center form-control-lg mb-3"
                                                placeholder="اسم الجد" disabled>
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="text" id="M_LAST_NAME"
                                                class="form-control text-center form-control-lg mb-3"
                                                placeholder="العائلة" disabled>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label  fw-bold fs-6">تاريخ ميلاد الأم</label>
                                <div class="col-lg-2 fv-row">
                                    <input class="form-control text-center" id="M_BIRTH_DATE" disabled>
                                </div>

                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">مكان ميلاد الأم</label>
                                <div class="col-lg-2">
                                    <!--begin::Col-->
                                    <input type="text" name="m_birth_state" id="m_birth_state"
                                        class="form-control text-center form-control-lg mb-3 mb-lg-0" disabled>
                                    <!--end::Col-->
                                </div>
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">مكان ميلاد والد الأم</label>
                                <div class="col-lg-2">
                                    <!--begin::Col-->
                                    <input type="text" name="mf_birth_state" id="mf_birth_state"
                                        class="form-control text-center form-control-lg mb-3 mb-lg-0" disabled>
                                    <!--end::Col-->
                                </div>

                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label fw-bold fs-6">الحالة الاجتماعية للأم</label>
                                <div class="col-lg-2 fv-row">
                                    <input class="form-control text-center" id="m_social_status_name" disabled
                                        type="hidden">
                                    <select id="m_social_status_id" data-control="select2"
                                        data-placeholder="الحالة الاجتماعية" class="form-select form-select-lg fw-bold">
                                        <option></option>
                                        @foreach ($marital_status as $item)
                                            <option value="{{ $item->ms_code }}">{{ $item->ms_name_ar }}
                                            </option>
                                        @endforeach

                                    </select>

                                </div>
                                <!--begin::Label-->

                                <label class="col-lg-2 col-form-label  fw-bold fs-6">مهنة الأم</label>
                                <div class="col-lg-2 fv-row">
                                    <input class="form-control text-center" id="P_MOTHER_JOB_NAME" type="hidden">
                                    <select id="P_MOTHER_JOB_CD" data-control="select2" data-placeholder="المهنة"
                                        class="form-select form-select-lg fw-bold">
                                        <option></option>
                                        @foreach ($jobs as $item)
                                            <option value="{{ $item->job_code }}">{{ $item->job_name_ar }}
                                            </option>
                                        @endforeach

                                    </select>

                                </div>

                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">عدد سنوات دراسة الأم</label>
                                <div class="col-lg-2">
                                    <!--begin::Col-->
                                    <input type="text" name="m_Year_Edu" id="m_Year_Edu"
                                        class="form-control text-center form-control-lg mb-3 mb-lg-0">
                                    <!--end::Col-->
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">رقم تليفون الأم</label>
                                <div class="col-lg-2">
                                    <!--begin::Col-->
                                    <input type="text" name="P_mother_phone" id="P_mother_phone"
                                        class="form-control text-center form-control-lg mb-3 mb-lg-0">
                                    <!--end::Col-->
                                </div>
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">اسم عائلة الأم</label>
                                <div class="col-lg-2">
                                    <!--begin::Col-->
                                    <input type="text" name="P_mother_family" id="P_mother_family"
                                        class="form-control text-center form-control-lg mb-3 mb-lg-0">
                                    <!--end::Col-->
                                </div>
                            </div>
                            <div class="row mb-6">

                                <label class="col-lg-2 col-form-label  fw-bold fs-6">العنوان كاملاً</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <select id="m_region_id" data-control="select2" data-placeholder="المحافظة"
                                                class="form-select form-select-lg fw-bold">
                                                <option></option>
                                                @foreach ($region as $item)
                                                    <option value="{{ $item->r_code }}">{{ $item->r_name_ar }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-4">
                                            <select id="m_city_id" data-control="select2" data-placeholder="المدينة"
                                                class="form-select form-select-lg fw-bold">
                                                <option></option>
                                                @foreach ($city as $item)
                                                    <option value="{{ $item->c_code }}">{{ $item->c_name_ar }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--begin::Label-->

                                    </div>

                                </div>

                            </div>
                        </div>
                        <!--begin::Step 1-->

                        <!--begin::Step 1-->
                        <div class="flex-column" data-kt-stepper-element="content">
                            <!--begin::Input group-->
                            <!-- input hidden -->
                            <input type="hidden" value="" name="BORN_DETAILS_DELIVERY_CD"
                                id="BORN_DETAILS_DELIVERY_CD" />
                            <input type="hidden" value="" name="BORN_DETAILS_DELIVERY_COMPLI_C"
                                id="BORN_DETAILS_DELIVERY_COMPLI_C" />
                            <input type="hidden" name="BORN_DETAILS_MOTHER_EXAM_CD" id="BORN_DETAILS_MOTHER_EXAM_CD" />
                            <input type="hidden" value="" name="BORN_DETAILS_PAIN_RELIEF_CD"
                                id="BORN_DETAILS_PAIN_RELIEF_CD" />
                            <input type="hidden" value="" name="BORN_DETAILS_PLACENTA_COND_CD"
                                id="BORN_DETAILS_PLACENTA_COND_CD" />
                            <input type="hidden" value="" name="BORN_DETAILS_GENERATOR_CD"
                                id="BORN_DETAILS_GENERATOR_CD" />
                            <input type="hidden" name="BORN_DETAILS_TWINS" id="BORN_DETAILS_TWINS" dir="rtl"
                                value="0" readonly="readonly" />
                            <input type="hidden" value="" name="BORN_DETAILS_REASON_CD"
                                id="BORN_DETAILS_REASON_CD" />
                            <input type="hidden" value="" name="BORN_DETAILS_BLOOD_TRANS_CD"
                                id="BORN_DETAILS_BLOOD_TRANS_CD" />
                            <input type="hidden" value="" name="BORN_DETAILS_MOTHER_RESULT_CD"
                                id="BORN_DETAILS_MOTHER_RESULT_CD" />
                            <input type="hidden" value="" name="BORN_DETAILS_CATALYST_CD"
                                id="BORN_DETAILS_CATALYST_CD" />
                            <input type="hidden" name="BORN_DETAILS_GESTATIONAL_WEEKS"
                                style="background-color:#FFFFFF;border-top-width:thin; border-style:groove"
                                id="BORN_DETAILS_GESTATIONAL_WEEKS" value="" />
                            <input type="hidden" name="BORN_DETAILS_ABORTION"
                                style="background-color:#FFFFFF;border-top-width:thin; border-style:groove"
                                id="BORN_DETAILS_ABORTION" tabindex="33" dir="rtl" value="" />
                            <input type="hidden" name="BORN_DETAILS_PARITY"
                                style="background-color:#FFFFFF;border-top-width:thin; border-style:groove"
                                id="BORN_DETAILS_PARITY" tabindex="32" dir="rtl" value="" />
                            <input type="hidden" name="BORN_DETAILS_GRAVID"
                                style="background-color:#F0F0F0;border-top-width:thin; border-style:groove"
                                id="BORN_DETAILS_GRAVID" value="" />
                            <input type="hidden" value="" name="B_CODE" id="B_CODE" />


                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">تاريخ وساعة الولادة</label>
                                <!--end::Label-->
                                <div class="col-lg-2 fv-row">
                                    <input class="form-control text-center" id="BORN_DETAILS_DELIVERY_DATE">
                                </div>
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">مكان الولادة</label>
                                <div class="col-lg-2 fv-row">
                                    <select id="BORN_DETAILS_BIRTH_PLACE_CD" data-control="select2"
                                        data-placeholder="مكان الولادة" class="form-select form-select-lg fw-bold">
                                        <option value="0" selected="selected">غير معرف</option>
                                        <option value="9">مستشفى الهلال الإماراتي</option>
                                        <option value="3">مستشفى ناصر الطبي</option>
                                        <option value="6">مستشفى شهداء الأقصى</option>
                                        <option value="1">مستشفى الشفاء بغزة</option>
                                        <option value="2">مستشفى العودة</option>
                                        <option value="90">مستشفى الكرامة التخصصي</option>
                                        <option value="77">مستشفى القدس</option>
                                        <option value="87">مستشفى أصدقاء المريض</option>
                                        <option value="99">مستشفى مجمع الصحابة الطبي</option>
                                        <option value="78">مستشفى بلسم العسكري</option>
                                        <option value="105">عبسان الكبيرة العسكري</option>
                                        <option value="106">مهدي</option>
                                        <option value="96">مستشفى الخدمة العامة</option>
                                        <option value="101">مستشفى دار السلآم</option>
                                        <option value="102">مستشفى الامل</option>
                                        <option value="103">مستشفى الكويت التخصصي</option>
                                        <option value="100">مستشفى يافا</option>
                                        <option value="88">طبيب خاص</option>

                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">مدينة الوالدين</label>
                                <div class="col-lg-2 fv-row">

                                    <select id="BORN_DETAILS_REGION_CD" data-control="select2" data-placeholder="المدينة"
                                        class="form-select form-select-lg fw-bold">
                                        <option value="0" selected="selected">غير معرف</option>
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

                                    </select>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">الحي</label>
                                <div class="col-lg-2 fv-row">

                                    <select id="BORN_DETAILS_CITY_CD" data-control="select2" data-placeholder="الحي"
                                        class="form-select form-select-lg fw-bold">
                                        <option></option>
                                        @foreach ($city as $item)
                                            <option value="{{ $item->c_code }}">{{ $item->c_name_ar }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">المركز الصحي</label>
                                <div class="col-lg-2 fv-row">

                                    <select id="BORN_DETAILS_HEALTH_CENTER_CD" data-control="select2"
                                        data-placeholder="المركز الصحي" class="form-select form-select-lg fw-bold">
                                        <option></option>
                                        @foreach ($HEALTH_CENTER as $item)
                                            <option value="{{ $item->dref_code }}">{{ $item->dref_name_ar }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">رقم منزل الوالدين</label>
                                <!--end::Label-->
                                <div class="col-lg-2 fv-row">
                                    <input class="form-control text-center" id="BORN_DETAILS_HOME_NO">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">تاريخ الزواج </label>
                                <!--end::Label-->
                                <div class="col-lg-2 fv-row">
                                    <input class="form-control text-center" id="BORN_DETAILS_MARRIAGE_DATE">
                                </div>
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">رقم زواج الأم </label>
                                <!--end::Label-->
                                <div class="col-lg-2 fv-row">
                                    <input class="form-control text-center" id="BORN_DETAILS_MARRIAGE_NUMBER" value="1">
                                </div>
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">رقم تليفون الوالدين </label>
                                <!--end::Label-->
                                <div class="col-lg-2 fv-row">
                                    <input class="form-control text-center" id="BORN_DETAILS_PARENTS_TEL_NO">
                                </div>
                            </div>
                            <div class="row mb-6">

                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label required fw-bold fs-6">عدد المواليد في الولادة
                                    الحالية</label>
                                <!--end::Label-->
                                <div class="col-lg-1 fv-row">
                                    <input class="form-control text-center" id="BORN_DETAILS_PLURALITY" value="1">
                                </div>
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">توأم</label>
                                <div class="col-lg-2 fv-row mt-n1">

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="BORN_DETAILS_TWINS"
                                            id="weekRadio1" checked disabled>
                                        <label class="form-check-label" for="inlineRadio1">لا</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="BORN_DETAILS_TWINS"
                                            id="weekRadio2" disabled>
                                        <label class="form-check-label" for="inlineRadio2">نعم</label>
                                    </div>
                                </div>
                                <label class="col-lg-3 col-form-label required fw-bold fs-6">عدد المواليد الأحياء من الزواج
                                    الحالي</label>
                                <!--end::Label-->
                                <div class="col-lg-1 fv-row">
                                    <input class="form-control text-center" id="BORN_DETAILS_CUR_MARRIAGE_LIVE">
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label required fw-bold fs-6">عدد المواليد الموتى من الزواج
                                    الحالي</label>
                                <!--end::Label-->
                                <div class="col-lg-1 fv-row">
                                    <input class="form-control text-center" id="BORN_DETAILS_CUR_MARRIAGE_DEAD">
                                </div>
                                <label class="col-lg-3 col-form-label required fw-bold fs-6">عدد المواليد الأحياء من الزواج
                                    السابق</label>
                                <!--end::Label-->
                                <div class="col-lg-1 fv-row">
                                    <input class="form-control text-center" id="BORN_DETAILS_PRE_MARRIAGE_LIVE" value="0">
                                </div>
                                <label class="col-lg-3 col-form-label required fw-bold fs-6">عدد المواليد الموتى من الزواج
                                    السابق</label>
                                <!--end::Label-->
                                <div class="col-lg-1 fv-row">
                                    <input class="form-control text-center" id="BORN_DETAILS_PRE_MARRIAGE_DEAD" value="0">
                                </div>
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Step 4-->
                        <div class="flex-column" data-kt-stepper-element="content">
                            <input type="hidden" value="" name="BI_PARTOGRAM_CD" id="BI_PARTOGRAM_CD" />
                            <input type="hidden" value="" name="BI_PRESENTATION_CD" id="BI_PRESENTATION_CD" />
                            <input type="hidden"  name="BI_OUT_COME_CD" id="BI_OUT_COME_CD" />
                            <input name="BI_APAGAR_5"
                                style="background-color:#FFFFFF;border-top-width:thin; border-style:groove" type="hidden"
                                id="BI_APAGAR_5" tabindex="15" value="" dir="rtl"
                                onblur="check_digits(1,this.value,this.id)" />
                            <input name="BI_APAGAR_1"
                                style="background-color:#FFFFFF;border-top-width:thin; border-style:groove" type="hidden"
                                id="BI_APAGAR_1" tabindex="14" dir="rtl" value=""
                                onblur="check_digits(1,this.value,this.id)" />
                            <input type="hidden" value="" name="BI_CONGENITAL_ANOMALIES_CD"
                                id="BI_CONGENITAL_ANOMALIES_CD" />
                            <input type="hidden"  name="BI_EXAM_OUT_COME_CD" id="BI_EXAM_OUT_COME_CD" />
                            <input type="hidden"  name="BI_EXAM_BEFORE_CD" id="BI_EXAM_BEFORE_CD" />
                            <input type="hidden"  name="BI_ADMITTED_NICU_CD" id="BI_ADMITTED_NICU_CD" />
                            <input type="hidden"  name="BI_ADMISSION_CD" id="BI_ADMISSION_CD" />
                            <div class="row mb-6">

                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">هوية المولود</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-2">
                                    <!--begin::Col-->
                                    <input type="number" name="P_BI_ID" id="P_BI_ID" maxLength="9"
                                        oninput="this.value=this.value.slice(0,this.maxLength)"
                                        class="form-control text-center form-control-lg mb-3 mb-lg-0"
                                        placeholder="رقم الهوية">
                                    <!--end::Col-->
                                </div>
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">ترتيب المولود</label>
                                <div class="col-lg-2">
                                    <!--begin::Col-->
                                    <input type="text" name="BI_ORDER" id="BI_ORDER"
                                        class="form-control text-center form-control-lg mb-3 mb-lg-0">
                                    <!--end::Col-->
                                </div>
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">وزن المولود بالجرام</label>
                                <div class="col-lg-2">
                                    <!--begin::Col-->
                                    <input type="text" name="BI_WEIGHT_GM" id="BI_WEIGHT_GM"
                                        class="form-control text-center form-control-lg mb-3 mb-lg-0">
                                    <!--end::Col-->
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">اسم المولود الاول</label>
                                <div class="col-lg-2">
                                    <!--begin::Col-->
                                    <input type="text" name="BI_FIRST_NAME" id="BI_FIRST_NAME"
                                        class="form-control text-center form-control-lg mb-3 mb-lg-0">
                                    <!--end::Col-->
                                </div>
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">جنس المولود</label>
                                <div class="col-lg-2">
                                    <!--begin::Col-->
                                    <select id="BI_SEX_CD" data-control="select2" data-placeholder="اختر ..."
                                        class="form-select form-select-lg fw-bold">
                                        <option value="">اختر...</option>
                                        <option value="1">ذكر</option>
                                        <option value="2">أنثى</option>
                                    </select>
                                    <!--end::Col-->
                                </div>
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">جنس المولود</label>
                                <div class="col-lg-2">
                                    <!--begin::Col-->
                                    <select id="BI_RELEGION_CD" data-control="select2" data-placeholder="اختر ..."
                                        class="form-select form-select-lg fw-bold">
                                        <option value="">اختر...</option>
                                        @foreach ($religion as $item)
                                            <option value="{{ $item->re_code }}">{{ $item->re_name_ar }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>


                        </div>
                    </div>
                    <!--end::Group-->

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
                            @if (IsPermissionBtn(30))

                            <button type="button" class="btn btn-primary" data-kt-stepper-action="submit"
                                id="save_btn" onclick="save_born_details_info();">
                                <span class="indicator-label">
                                    حفظ البيانات
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
    <script src="assets/js/scripts.bundle.js"></script>

    <script>
        var P_FATHER_BIRTH_DATE = $("#P_FATHER_BIRTH_DATE").flatpickr({
            // enableTime: true,
            // dateFormat: "d/m/Y H:i",
            dateFormat: "d/m/Y",

        });

        var M_BIRTH_DATE = $("#M_BIRTH_DATE").flatpickr({
            //  enableTime: true,
            //dateFormat: "d/m/Y H:i",
            dateFormat: "d/m/Y",

        });


        $(document).ready(function() {

            if ($("#P_BI_CODE").val() != 0 || $("#P_BI_CODE").val() != '') {
                getDataBornInfoBy($("#P_BI_CODE").val());
                document.getElementById('save_btn').style.visibility = 'hidden';
                document.getElementById('update_btn').style.visibility = 'visible';



            } else {
                document.getElementById('save_btn').style.visibility = 'visible';
                document.getElementById('update_btn').style.visibility = 'hidden';

            }

        });
        //date init

        var BORN_DETAILS_DELIVERY_DATE = $("#BORN_DETAILS_DELIVERY_DATE").flatpickr({
            enableTime: true,
            dateFormat: "d/m/Y H:i",

        });


        var BORN_DETAILS_MARRIAGE_DATE = $("#BORN_DETAILS_MARRIAGE_DATE").flatpickr({
            enableTime: true,
            dateFormat: "d/m/Y",
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

        // add born info

        function save_born_details_info() {
            if (($("#FATHER_NUMBER").val() != 0 || $("#FATHER_NUMBER").val() != '') && ($("#MOTHER_NUMBER").val() != 0 || $(
                    "#MOTHER_NUMBER").val() != '')) {
                var BORN_DETAILS_REASON_CD = $("#BORN_DETAILS_REASON_CD").val();
                var BORN_DETAILS_GRAVID = $("#BORN_DETAILS_GRAVID").val();
                var BORN_DETAILS_PARITY = $("#BORN_DETAILS_PARITY").val();
                var BORN_DETAILS_ABORTION = $("#BORN_DETAILS_ABORTION").val();
                var BORN_DETAILS_GESTATIONAL_WEEKS = $("#BORN_DETAILS_GESTATIONAL_WEEKS").val();
                var BORN_DETAILS_DELIVERY_DATE = $("#BORN_DETAILS_DELIVERY_DATE").val();
                var BORN_DETAILS_DELIVERY_CD = $("#BORN_DETAILS_DELIVERY_CD").val();
                var BORN_DETAILS_PLURALITY = $("#BORN_DETAILS_PLURALITY").val();
                var BORN_DETAILS_DELIVERY_COMPLI_C = $("#BORN_DETAILS_DELIVERY_COMPLI_C").val();
                var BORN_DETAILS_CATALYST_CD = $("#BORN_DETAILS_CATALYST_CD").val();
                var BORN_DETAILS_MOTHER_EXAM_CD = $("#BORN_DETAILS_MOTHER_EXAM_CD").val();
                var BORN_DETAILS_MOTHER_RESULT_CD = $("#BORN_DETAILS_MOTHER_RESULT_CD").val();
                var BORN_DETAILS_PAIN_RELIEF_CD = $("#BORN_DETAILS_PAIN_RELIEF_CD").val();
                var BORN_DETAILS_BLOOD_TRANS_CD = $("#BORN_DETAILS_BLOOD_TRANS_CD").val();
                var BORN_DETAILS_PLACENTA_COND_CD = $("#BORN_DETAILS_PLACENTA_COND_CD").val();
                var BORN_DETAILS_MARRIAGE_DATE = $("#BORN_DETAILS_MARRIAGE_DATE").val();
                var BORN_DETAILS_MARRIAGE_NUMBER = $("#BORN_DETAILS_MARRIAGE_NUMBER").val();
                var BORN_DETAILS_CUR_MARRIAGE_LIVE = $("#BORN_DETAILS_CUR_MARRIAGE_LIVE").val();
                var BORN_DETAILS_CUR_MARRIAGE_DEAD = $("#BORN_DETAILS_CUR_MARRIAGE_DEAD").val();
                var BORN_DETAILS_PRE_MARRIAGE_LIVE = $("#BORN_DETAILS_PRE_MARRIAGE_LIVE").val();
                var BORN_DETAILS_PRE_MARRIAGE_DEAD = $("#BORN_DETAILS_PRE_MARRIAGE_DEAD").val();
                var BORN_DETAILS_GENERATOR_CD = $("#BORN_DETAILS_GENERATOR_CD").val();
                var BORN_DETAILS_TWINS = $("#BORN_DETAILS_TWINS").val();
                var BORN_DETAILS_FATH_CD = $("#FATHER_NUMBER").val();
                var BORN_DETAILS_MOTHER_CD = $("#MOTHER_NUMBER").val();
                var BORN_DETAILS_CITY_CD = $("#BORN_DETAILS_CITY_CD").val();
                var BORN_DETAILS_REGION_CD = $("#BORN_DETAILS_REGION_CD").val();
                var BORN_DETAILS_HOME_NO = $("#BORN_DETAILS_HOME_NO").val();
                var BORN_DETAILS_PARENTS_TEL_NO = $("#BORN_DETAILS_PARENTS_TEL_NO").val();
                var BORN_DETAILS_HEALTH_CENTER_CD = $("#BORN_DETAILS_HEALTH_CENTER_CD").val();
                var BORN_DETAILS_BIRTH_PLACE_CD = $("#BORN_DETAILS_BIRTH_PLACE_CD").val();


                var url = "{{ route('born.save_born_details_info') }}";
                $.ajax({
                    url: url,
                    type: 'json',
                    method: 'post',
                    data: {
                        'BORN_DETAILS_REASON_CD': BORN_DETAILS_REASON_CD,
                        'BORN_DETAILS_GRAVID': BORN_DETAILS_GRAVID,
                        'BORN_DETAILS_PARITY': BORN_DETAILS_PARITY,
                        'BORN_DETAILS_ABORTION': BORN_DETAILS_ABORTION,
                        'BORN_DETAILS_GESTATIONAL_WEEKS': BORN_DETAILS_GESTATIONAL_WEEKS,
                        'BORN_DETAILS_DELIVERY_DATE': BORN_DETAILS_DELIVERY_DATE,
                        'BORN_DETAILS_DELIVERY_CD': BORN_DETAILS_DELIVERY_CD,
                        'BORN_DETAILS_PLURALITY': BORN_DETAILS_PLURALITY,
                        'BORN_DETAILS_DELIVERY_COMPLI_C': BORN_DETAILS_DELIVERY_COMPLI_C,
                        'BORN_DETAILS_CATALYST_CD': BORN_DETAILS_CATALYST_CD,
                        'BORN_DETAILS_MOTHER_EXAM_CD': BORN_DETAILS_MOTHER_EXAM_CD,
                        'BORN_DETAILS_MOTHER_RESULT_CD': BORN_DETAILS_MOTHER_RESULT_CD,
                        'BORN_DETAILS_PAIN_RELIEF_CD': BORN_DETAILS_PAIN_RELIEF_CD,
                        'BORN_DETAILS_BLOOD_TRANS_CD': BORN_DETAILS_BLOOD_TRANS_CD,
                        'BORN_DETAILS_PLACENTA_COND_CD': BORN_DETAILS_PLACENTA_COND_CD,
                        'BORN_DETAILS_MARRIAGE_DATE': BORN_DETAILS_MARRIAGE_DATE,
                        'BORN_DETAILS_MARRIAGE_NUMBER': BORN_DETAILS_MARRIAGE_NUMBER,
                        'BORN_DETAILS_CUR_MARRIAGE_LIVE': BORN_DETAILS_CUR_MARRIAGE_LIVE,
                        'BORN_DETAILS_CUR_MARRIAGE_DEAD': BORN_DETAILS_CUR_MARRIAGE_DEAD,
                        'BORN_DETAILS_PRE_MARRIAGE_LIVE': BORN_DETAILS_PRE_MARRIAGE_LIVE,
                        'BORN_DETAILS_PRE_MARRIAGE_DEAD': BORN_DETAILS_PRE_MARRIAGE_DEAD,
                        'BORN_DETAILS_GENERATOR_CD': BORN_DETAILS_GENERATOR_CD,
                        'BORN_DETAILS_TWINS': BORN_DETAILS_TWINS,
                        'BORN_DETAILS_FATH_CD': BORN_DETAILS_FATH_CD,
                        'BORN_DETAILS_MOTHER_CD': BORN_DETAILS_MOTHER_CD,
                        'BORN_DETAILS_CITY_CD': BORN_DETAILS_CITY_CD,
                        'BORN_DETAILS_REGION_CD': BORN_DETAILS_REGION_CD,
                        'BORN_DETAILS_HOME_NO': BORN_DETAILS_HOME_NO,
                        'BORN_DETAILS_PARENTS_TEL_NO': BORN_DETAILS_PARENTS_TEL_NO,
                        'BORN_DETAILS_HEALTH_CENTER_CD': BORN_DETAILS_HEALTH_CENTER_CD,
                        'BORN_DETAILS_BIRTH_PLACE_CD': BORN_DETAILS_BIRTH_PLACE_CD,


                    },
                }).done(function(response) {
                    console.log(response);
                    if (response.success) {
                        if (response.success == 1) {
                            Swal.fire({
                                title: 'تمت عملية إضافة إشعار الولادة بنجاح !',
                                text: response.results.message,
                                icon: "success",
                                confirmButtonText: 'موافق'
                            });
                            clear_form();
                            // $('#B_CODE').val(response.results.B_CODE);

                        } else {

                            toastr["error"](response.results.message);
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
                            text: $message,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                });

            } else {
                save_born_father_info();
            }


        }

        function edit_father_data() {

            if ($("#FATHER_NUMBER").val() != 0 || $("#FATHER_NUMBER").val() != '') {
                var F_NUMBER = $("#FATHER_NUMBER").val();
                var F_ID = $('#P_FATHER_ID').val();
                var F_FIRST_NAME_AR = $('#IN_FIRST_NAME').val();
                var F_FATHER_NAME_AR = $('#IN_SECOND_NAME').val();
                var F_GRANDFATHER_NAME_AR = $('#IN_THIRD_NAME').val();
                var F_LAST_NAME_AR = $('#IN_LAST_NAME').val();
                var F_DOB = $('#P_FATHER_BIRTH_DATE').val();
                var F_BIRTH_PLACE = $('#P_birth_state').val();
                var F_FATHER_BIRTH_PLACE = $('#f_birth_state').val();
                var F_JOB_CD = $('#P_FATHER_JOB_CD').val();
                var F_MARTIAL_STATUS_CD = $('#P_social_status_id').val();
                var F_YEAR_OF_EDUCATION = $('#f_Year_Edu').val();
                var F_REGION_CD = $('#f_region_id').val();
                var F_CITY_CD = $('#f_city_id').val();
                var F_DATA_FRM_MOI = $('#FATHER_DATA_FRM_MOI').val();
                var F_ID_TYPE = $('#f_type_id').val();
                var B_CODE = $('#B_CODE').val();


                var url = "{{ route('born.update_father_info') }}";
                $.ajax({
                    url: url,
                    type: 'json',
                    method: 'post',
                    data: {
                        'F_NUMBER': F_NUMBER,
                        'F_ID': F_ID,
                        'F_FIRST_NAME_AR': F_FIRST_NAME_AR,
                        'F_FATHER_NAME_AR': F_FATHER_NAME_AR,
                        'F_GRANDFATHER_NAME_AR': F_GRANDFATHER_NAME_AR,
                        'F_LAST_NAME_AR': F_LAST_NAME_AR,
                        'F_DOB': F_DOB,
                        'F_BIRTH_PLACE': F_BIRTH_PLACE,
                        'F_FATHER_BIRTH_PLACE': F_FATHER_BIRTH_PLACE,
                        'F_JOB_CD': F_JOB_CD,
                        'F_MARTIAL_STATUS_CD': F_MARTIAL_STATUS_CD,
                        'F_YEAR_OF_EDUCATION': F_YEAR_OF_EDUCATION,
                        'F_REGION_CD': F_REGION_CD,
                        'F_CITY_CD': F_CITY_CD,
                        'F_DATA_FRM_MOI': F_DATA_FRM_MOI,
                        'F_ID_TYPE': F_ID_TYPE,
                        'B_CODE': B_CODE,


                    },
                }).done(function(response) {
                    console.log(response);
                    if (response.success) {
                        if (response.success == 1) {
                            Swal.fire({
                                title: 'تمت عملية تعديل بيانات الأب بنجاح !',
                                text: response.results.message,
                                icon: "success",
                                confirmButtonText: 'موافق'
                            });

                        } else {

                            toastr["error"](response.results.message);
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
                    }
                });

            }
        }


        function edit_mother_data() {

            if ($("#MOTHER_NUMBER").val() != 0 || $("#MOTHER_NUMBER").val() != '') {
                var MOTHER_NUMBER = $("#MOTHER_NUMBER").val();
                var MOTHER_ID = $('#P_MOTHER_ID').val();
                var MOTHER_FIRST_NAME_AR = $('#M_FIRST_NAME').val();
                var MOTHER_FATHER_NAME_AR = $('#M_SECOND_NAME').val();
                var MOTHER_GRANDFATHER_NAME_AR = $('#M_THIRD_NAME').val();
                var MOTHER_LAST_NAME_AR = $('#M_LAST_NAME').val();
                var MOTHER_DOB = $('#P_MOTHER_BIRTH_DATE').val();
                var MOTHER_BIRTH_PLACE = $('#m_birth_state').val();
                var MOTHER_FATHER_BIRTH_PLACE = $('#mf_birth_state').val();
                var MOTHER_JOB = $('#P_MOTHER_JOB_NAME').val();
                var MOTHER_MARTIAL_STATUS_CD = $('#m_social_status_id').val();
                var MOTHER_YEAR_OF_EDUCATION = $('#m_Year_Edu').val();
                var MOTHER_REGION_CD = $('#m_region_id').val();
                var MOTHER_CITY_CD = $('#m_city_id').val();
                var MOTHER_TEL = $('#P_mother_phone').val();
                var MOTHER_FAMILY_NAME = $('#P_mother_family').val();
                var MOTHER_DATA_FRM_MOI = $('#MOTHER_DATA_FRM_MOI').val();
                var MOTHER_ID_TYPE = $('#m_type_id').val();
                var B_CODE = $('#B_CODE').val();


                var url = "{{ route('born.update_mother_info') }}";
                $.ajax({
                    url: url,
                    type: 'json',
                    method: 'post',
                    data: {
                        'MOTHER_NUMBER': MOTHER_NUMBER,
                        'MOTHER_ID': MOTHER_ID,
                        'MOTHER_FIRST_NAME_AR': MOTHER_FIRST_NAME_AR,
                        'MOTHER_FATHER_NAME_AR': MOTHER_FATHER_NAME_AR,
                        'MOTHER_GRANDFATHER_NAME_AR': MOTHER_GRANDFATHER_NAME_AR,
                        'MOTHER_LAST_NAME_AR': MOTHER_LAST_NAME_AR,
                        'MOTHER_DOB': MOTHER_DOB,
                        'MOTHER_BIRTH_PLACE': MOTHER_BIRTH_PLACE,
                        'MOTHER_FATHER_BIRTH_PLACE': MOTHER_FATHER_BIRTH_PLACE,
                        'MOTHER_JOB': MOTHER_JOB,
                        'MOTHER_MARTIAL_STATUS_CD': MOTHER_MARTIAL_STATUS_CD,
                        'MOTHER_YEAR_OF_EDUCATION': MOTHER_YEAR_OF_EDUCATION,
                        'MOTHER_REGION_CD': MOTHER_REGION_CD,
                        'MOTHER_CITY_CD': MOTHER_CITY_CD,
                        'MOTHER_TEL': MOTHER_TEL,
                        'MOTHER_FAMILY_NAME': MOTHER_FAMILY_NAME,
                        'MOTHER_DATA_FRM_MOI': MOTHER_DATA_FRM_MOI,
                        'MOTHER_ID_TYPE': MOTHER_ID_TYPE,
                        'B_CODE': B_CODE,


                    },
                }).done(function(response) {
                    console.log(response);
                    if (response.success) {
                        if (response.success == 1) {
                            Swal.fire({
                                title: 'تمت عملية تعديل بيانات الأم بنجاح !',
                                text: response.results.message,
                                icon: "success",
                                confirmButtonText: 'موافق'
                            });

                        } else {

                            toastr["error"](response.results.message);
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
                    }
                });

            }
        }

        function save_born_father_info() {
            // add father data

            if ($("#FATHER_NUMBER").val() == 0 || $("#FATHER_NUMBER").val() == '') {
                var FATHER_ID = $('#P_FATHER_ID').val();
                var FATHER_FIRST_NAME_AR = $('#IN_FIRST_NAME').val();
                var FATHER_FATHER_NAME_AR = $('#IN_SECOND_NAME').val();
                var FATHER_GRANDFATHER_NAME_AR = $('#IN_THIRD_NAME').val();
                var FATHER_LAST_NAME_AR = $('#IN_LAST_NAME').val();
                var FATHER_DOB = $('#P_FATHER_BIRTH_DATE').val();
                var FATHER_BIRTH_PLACE = $('#P_birth_state').val();
                var FATHER_FATHER_BIRTH_PLACE = $('#f_birth_state').val();
                var FATHER_JOB = $('#P_FATHER_JOB_CD').val();
                var FATHER_MARTIAL_STATUS_CD = $('#P_social_status_id').val();
                var FATHER_YEAR_OF_EDUCATION = $('#f_Year_Edu').val();
                var FATHER_REGION_CD = $('#f_region_id').val();
                var FATHER_CITY_CD = $('#f_city_id').val();
                var FATHER_DATA_FRM_MOI = $('#FATHER_DATA_FRM_MOI').val();
                var FATHER_ID_TYPE = $('#f_type_id').val();

                var url = "{{ route('born.ADD_BORN_FATHER_DATA') }}";
                $.ajax({
                    url: url,
                    type: 'json',
                    method: 'post',
                    data: {
                        'FATHER_ID': FATHER_ID,
                        'FATHER_FIRST_NAME_AR': FATHER_FIRST_NAME_AR,
                        'FATHER_FATHER_NAME_AR': FATHER_FATHER_NAME_AR,
                        'FATHER_GRANDFATHER_NAME_AR': FATHER_GRANDFATHER_NAME_AR,
                        'FATHER_LAST_NAME_AR': FATHER_LAST_NAME_AR,
                        'FATHER_DOB': FATHER_DOB,
                        'FATHER_BIRTH_PLACE': FATHER_BIRTH_PLACE,
                        'FATHER_FATHER_BIRTH_PLACE': FATHER_FATHER_BIRTH_PLACE,
                        'FATHER_JOB': FATHER_JOB,
                        'FATHER_MARTIAL_STATUS_CD': FATHER_MARTIAL_STATUS_CD,
                        'FATHER_YEAR_OF_EDUCATION': FATHER_YEAR_OF_EDUCATION,
                        'FATHER_REGION_CD': FATHER_REGION_CD,
                        'FATHER_CITY_CD': FATHER_CITY_CD,
                        'FATHER_DATA_FRM_MOI': FATHER_DATA_FRM_MOI,
                        'FATHER_ID_TYPE': FATHER_ID_TYPE,


                    },
                }).done(function(response) {
                    console.log(response);
                    if (response.success) {
                        if (response.success == 1) {

                            $('#FATHER_NUMBER').val(response.results.FATHER_NUMBER);
                            save_born_mother_info();

                        } else {

                            toastr["error"](response.results.message);
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
                            text: $message,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                });

            } else {
                save_born_mother_info();
            }
        }

        function save_born_mother_info() {
            // add mother data

            if ($("#MOTHER_NUMBER").val() == 0 || $("#MOTHER_NUMBER").val() == '') {
                var MOTHER_ID = $('#P_MOTHER_ID').val();
                var MOTHER_FIRST_NAME_AR = $('#M_FIRST_NAME').val();
                var MOTHER_FATHER_NAME_AR = $('#M_SECOND_NAME').val();
                var MOTHER_GRANDFATHER_NAME_AR = $('#M_THIRD_NAME').val();
                var MOTHER_LAST_NAME_AR = $('#M_LAST_NAME').val();
                var MOTHER_DOB = $('#P_MOTHER_BIRTH_DATE').val();
                var MOTHER_BIRTH_PLACE = $('#m_birth_state').val();
                var MOTHER_FATHER_BIRTH_PLACE = $('#mf_birth_state').val();
                var MOTHER_JOB = $('#P_MOTHER_JOB_NAME').val();
                var MOTHER_MARTIAL_STATUS_CD = $('#m_social_status_id').val();
                var MOTHER_YEAR_OF_EDUCATION = $('#m_Year_Edu').val();
                var MOTHER_REGION_CD = $('#m_region_id').val();
                var MOTHER_CITY_CD = $('#m_city_id').val();
                var MOTHER_TEL = $('#P_mother_phone').val();
                var MOTHER_FAMILY_NAME = $('#P_mother_family').val();
                var MOTHER_DATA_FRM_MOI = $('#MOTHER_DATA_FRM_MOI').val();
                var MOTHER_ID_TYPE = $('#m_type_id').val();

                var url = "{{ route('born.ADD_BORN_MOTHER_DATA') }}";
                $.ajax({
                    url: url,
                    type: 'json',
                    method: 'post',
                    data: {
                        'MOTHER_ID': MOTHER_ID,
                        'MOTHER_FIRST_NAME_AR': MOTHER_FIRST_NAME_AR,
                        'MOTHER_FATHER_NAME_AR': MOTHER_FATHER_NAME_AR,
                        'MOTHER_GRANDFATHER_NAME_AR': MOTHER_GRANDFATHER_NAME_AR,
                        'MOTHER_LAST_NAME_AR': MOTHER_LAST_NAME_AR,
                        'MOTHER_DOB': MOTHER_DOB,
                        'MOTHER_BIRTH_PLACE': MOTHER_BIRTH_PLACE,
                        'MOTHER_FATHER_BIRTH_PLACE': MOTHER_FATHER_BIRTH_PLACE,
                        'MOTHER_JOB': MOTHER_JOB,
                        'MOTHER_MARTIAL_STATUS_CD': MOTHER_MARTIAL_STATUS_CD,
                        'MOTHER_YEAR_OF_EDUCATION': MOTHER_YEAR_OF_EDUCATION,
                        'MOTHER_REGION_CD': MOTHER_REGION_CD,
                        'MOTHER_CITY_CD': MOTHER_CITY_CD,
                        'MOTHER_TEL': MOTHER_TEL,
                        'MOTHER_FAMILY_NAME': MOTHER_FAMILY_NAME,
                        'MOTHER_DATA_FRM_MOI': MOTHER_DATA_FRM_MOI,
                        'MOTHER_ID_TYPE': MOTHER_ID_TYPE,

                    },
                }).done(function(response) {
                    console.log(response);
                    if (response.success) {
                        if (response.success == 1) {

                            $('#MOTHER_NUMBER').val(response.results.MOTHER_NUMBER);
                            save_born_details_info();

                        } else {

                            toastr["error"](response.results.message);
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
                            text: $message,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                });

            } else {
                save_born_details_info();
            }

        }

        function getDataFatherInfoBy() {
            var P_FATHER_NO = $('#P_FATHER_ID').val();
            if (P_FATHER_NO) {
                var url = "{{ route('born.getFatherInfoByIdNo') }}";
                $.ajax({
                    url: url,
                    type: 'json',
                    method: 'post',
                    data: {
                        'P_FATHER_NO': P_FATHER_NO
                    },
                }).done(function(response) {
                    console.log(response);
                    if (response.success) {
                        if (response.success == 1) {
                            if (response.results.sex == 2) {
                                Swal.fire({
                                    title: 'خطأ !',
                                    text: 'يرجى إدخال رقم هوية خاص بالأب!!!',
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                });
                            } else {

                                $('#IN_FIRST_NAME').val(response.results.fname);
                                $('#IN_SECOND_NAME').val(response.results.sname);
                                $('#IN_THIRD_NAME').val(response.results.tname);
                                $('#IN_LAST_NAME').val(response.results.lname);
                                $('#P_FATHER_BIRTH_DATE').val(response.results.birth_date.replace("00:00:00", ""));
                                $('#P_birth_state').val(response.results.birth_place);
                                $('#f_birth_state').val(response.results.father_birth_place);
                                $('#P_social_status_id').val(response.results.MARTIAL_STATUS_CD);
                                $('#P_social_status_name').val(response.results.MS_NAME);
                                $('#P_FATHER_JOB_CD').val(response.results.JOB_CD);
                                $('#P_FATHER_JOB_NAME').val(response.results.JOB_NAME);
                                $('#f_Year_Edu').val(response.results.YEAR_OF_EDUCATION);
                                $("#f_region_id").val(response.results.REGION_CD).change();
                                $("#f_city_id").val(response.results.CITY_CD).change();
                                $('#FATHER_NUMBER').val(response.results.FATHER_NUMBER);

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
                            title: 'خطأ !',
                            text: $message,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                });
            }
        }

        function getDataMotherInfoBy() {
            var P_MOTHER_ID = $('#P_MOTHER_ID').val();
            if (P_MOTHER_ID) {
                var url = "{{ route('born.getMotherInfoByIdNo') }}";
                $.ajax({
                    url: url,
                    type: 'json',
                    method: 'post',
                    data: {
                        'P_MOTHER_ID': P_MOTHER_ID
                    },
                }).done(function(response) {
                    console.log(response);
                    if (response.success) {
                        if (response.success == 1) {
                            if (response.results.sex == 1) {
                                Swal.fire({
                                    title: 'خطأ !',
                                    text: 'يرجى إدخال رقم هوية خاص بالأم!!!',
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                });
                            } else {
                                $('#M_FIRST_NAME').val(response.results.fname);
                                $('#M_SECOND_NAME').val(response.results.sname);
                                $('#M_THIRD_NAME').val(response.results.tname);
                                $('#M_LAST_NAME').val(response.results.lname);
                                $('#M_BIRTH_DATE').val(response.results.birth_date.replace("00:00:00", ""));
                                $('#m_birth_state').val(response.results.birth_place);
                                $('#mf_birth_state').val(response.results.father_birth_place);
                                $('#m_social_status_id').val(response.results.MARTIAL_STATUS_CD);
                                $('#m_social_status_name').val(response.results.MS_NAME);
                                $('#P_MOTHER_JOB_CD').val(response.results.JOB_CD);
                                $('#P_MOTHER_JOB_NAME').val(response.results.JOB_NAME);
                                $('#m_Year_Edu').val(response.results.YEAR_OF_EDUCATION);
                                $('#P_mother_phone').val(response.results.TEL);
                                $('#P_mother_family').val(response.results.FAMILY_NAME);
                                $("#m_region_id").val(response.results.REGION_CD).change();
                                $("#m_city_id").val(response.results.CITY_CD).change();
                                $('#MOTHER_NUMBER').val(response.results.MOTHER_NUMBER);
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
                            title: 'خطأ !',
                            text: $message,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                });
            }
        }

        function getDataBornInfoBy(P_BI_CODE) {
            var url = "{{ route('born.getBornInfoByCodeNo') }}";
            $.ajax({
                url: url,
                type: 'json',
                method: 'post',
                data: {
                    'P_BI_CODE': P_BI_CODE
                },
            }).done(function(response) {
                console.log(response);
                //Father data
                $('#P_FATHER_ID').val(response.results[0]['FATHER_ID']);
                $('#IN_FIRST_NAME').val(response.results[0]['FATHER_FIRST_NAME_AR']);
                $('#IN_SECOND_NAME').val(response.results[0]['FATHER_FATHER_NAME_AR']);
                $('#IN_THIRD_NAME').val(response.results[0]['FATHER_GRANDFATHER_NAME_AR']);
                $('#IN_LAST_NAME').val(response.results[0]['FATHER_LAST_NAME_AR']);
                //$('#P_FATHER_BIRTH_DATE').val(response.results[0]['FATHER_DOB'].replace("00:00:00", ""));
                P_FATHER_BIRTH_DATE.setDate(new Date(response.results[0]['FATHER_DOB']));

                //  $('#P_FATHER_BIRTH_DATE').val(response.results[0]['FATHER_DOB']);
                $('#P_birth_state').val(response.results[0]['FATHER_BIRTH_PLACE']);
                $('#f_birth_state').val(response.results[0]['FATHER_FATHER_BIRTH_PLACE']);
                $('#P_social_status_id').val(response.results[0]['FATHER_MARTIAL_STATUS_CD']).change();
                $('#P_social_status_name').val(response.results[0]['FATHER_MARTIAL_STATUS']);
                $('#P_FATHER_JOB_CD').val(response.results[0]['FATHER_JOB_CD']).change();
                $('#P_FATHER_JOB_NAME').val(response.results[0]['FATHER_JOB']);
                $('#f_Year_Edu').val(response.results[0]['FATHER_YEAR_OF_EDUCATION']);
                $("#f_region_id").val(response.results[0]['FATHER_REGION_CD']).change();
                $("#f_city_id").val(response.results[0]['FATHER_CITY_CD']).change();
                $('#FATHER_NUMBER').val(response.results[0]['FATHER_CODE']);
                $('#FATHER_DATA_FRM_MOI').val(response.results[0]['FATHER_DATA_FRM_MOI']);


                //mother data
                $('#P_MOTHER_ID').val(response.results[0]['MOTHER_ID']);
                $('#M_FIRST_NAME').val(response.results[0]['MOTHER_FIRST_NAME_AR']);
                $('#M_SECOND_NAME').val(response.results[0]['MOTHER_FATHER_NAME_AR']);
                $('#M_THIRD_NAME').val(response.results[0]['MOTHER_GRANDFATHER_NAME_AR']);
                $('#M_LAST_NAME').val(response.results[0]['MOTHER_LAST_NAME_AR']);
                M_BIRTH_DATE.setDate(new Date(response.results[0]['MOTHER_DOB']));

                $('#m_birth_state').val(response.results[0]['MOTHER_BIRTH_PLACE']);
                $('#mf_birth_state').val(response.results[0]['MOTHER_FATHER_BIRTH_PLACE']);
                $('#m_social_status_id').val(response.results[0]['MOTHER_MARTIAL_STATUS_CD']).change();
                $('#m_social_status_name').val(response.results[0]['MOTHER_MARTIAL_STATUS']);
                $('#P_MOTHER_JOB_CD').val(response.results[0]['MOTHER_JOB_CD']).change();
                $('#P_MOTHER_JOB_NAME').val(response.results[0]['MOTHER_JOB']);
                $('#m_Year_Edu').val(response.results[0]['MOTHER_YEAR_OF_EDUCATION']);
                $('#P_mother_phone').val(response.results[0]['MOTHER_TEL']);
                $('#P_mother_family').val(response.results[0]['MOTHER_FAMILY_NAME']);
                $("#m_region_id").val(response.results[0]['MOTHER_REGION_CD']).change();
                $("#m_city_id").val(response.results[0]['MOTHER_CITY_CD']).change();
                $('#MOTHER_NUMBER').val(response.results[0]['MOTHER_CODE']);
                $('#MOTHER_DATA_FRM_MOI').val(response.results[0]['MOTHER_DATA_FRM_MOI']);

                //BORN DETAILS data
                $("#BORN_DETAILS_REASON_CD").val(response.results[0]['BORN_DETAILS_REASON_CD']);
                $("#BORN_DETAILS_GRAVID").val(response.results[0]['BORN_DETAILS_GRAVID']);
                $("#BORN_DETAILS_PARITY").val(response.results[0]['BORN_DETAILS_PARITY']);
                $("#BORN_DETAILS_ABORTION").val(response.results[0]['BORN_DETAILS_ABORTION']);
                $("#BORN_DETAILS_GESTATIONAL_WEEKS").val(response.results[0]['BORN_DETAILS_GESTATIONAL_WEEKS']);
                BORN_DETAILS_DELIVERY_DATE.setDate(new Date(response.results[0]['BORN_DETAILS_DELIVERY_DATE']));

                $("#BORN_DETAILS_DELIVERY_CD").val(response.results[0]['BORN_DETAILS_DELIVERY_CD']);
                $("#BORN_DETAILS_PLURALITY").val(response.results[0]['BORN_DETAILS_PLURALITY']);
                $("#BORN_DETAILS_DELIVERY_COMPLI_C").val(response.results[0]['BORN_DETAILS_DELIVERY_COMPLI_C']);
                $("#BORN_DETAILS_CATALYST_CD").val(response.results[0]['BORN_DETAILS_CATALYST_CD']);
                $("#BORN_DETAILS_MOTHER_EXAM_CD").val(response.results[0]['BORN_DETAILS_MOTHER_EXAM_CD']);
                $("#BORN_DETAILS_MOTHER_RESULT_CD").val(response.results[0]['BORN_DETAILS_MOTHER_RESULT_CD']);
                $("#BORN_DETAILS_PAIN_RELIEF_CD").val(response.results[0]['BORN_DETAILS_PAIN_RELIEF_CD']);
                $("#BORN_DETAILS_BLOOD_TRANS_CD").val(response.results[0]['BORN_DETAILS_BLOOD_TRANS_CD']);
                $("#BORN_DETAILS_PLACENTA_COND_CD").val(response.results[0]['BORN_DETAILS_PLACENTA_COND_CD']);
                if (response.results[0]['BORN_DETAILS_MARRIAGE_DATE'] != null) {
                    BORN_DETAILS_MARRIAGE_DATE.setDate(new Date(response.results[0]['BORN_DETAILS_MARRIAGE_DATE']));
                }

                $("#BORN_DETAILS_MARRIAGE_NUMBER").val(response.results[0]['BORN_DETAILS_MARRIAGE_NUMBER']);
                $("#BORN_DETAILS_CUR_MARRIAGE_LIVE").val(response.results[0]['BORN_DETAILS_CUR_MARRIAGE_LIVE']);
                $("#BORN_DETAILS_CUR_MARRIAGE_DEAD").val(response.results[0]['BORN_DETAILS_CUR_MARRIAGE_DEAD']);
                $("#BORN_DETAILS_PRE_MARRIAGE_LIVE").val(response.results[0]['BORN_DETAILS_PRE_MARRIAGE_LIVE']);
                $("#BORN_DETAILS_PRE_MARRIAGE_DEAD").val(response.results[0]['BORN_DETAILS_PRE_MARRIAGE_DEAD']);
                $("#BORN_DETAILS_GENERATOR_CD").val(response.results[0]['BORN_DETAILS_GENERATOR_CD']);
                $("#BORN_DETAILS_TWINS").val(response.results[0]['BORN_DETAILS_TWINS']);
                $("#FATHER_NUMBER").val(response.results[0]['BORN_DETAILS_FATH_CD']);
                $("#MOTHER_NUMBER").val(response.results[0]['BORN_DETAILS_MOTHER_CD']);
                $("#BORN_DETAILS_CITY_CD").val(response.results[0]['BORN_DETAILS_CITY_CD']).change();
                $("#BORN_DETAILS_REGION_CD").val(response.results[0]['BORN_DETAILS_REGION_CD']).change();
                $("#BORN_DETAILS_HOME_NO").val(response.results[0]['BORN_DETAILS_HOME_NO']);
                $("#BORN_DETAILS_PARENTS_TEL_NO").val(response.results[0]['BORN_DETAILS_PARENTS_TEL_NO']);
                $("#BORN_DETAILS_HEALTH_CENTER_CD").val(response.results[0]['BORN_DETAILS_HEALTH_CENTER_CD'])
                    .change();
                $("#BORN_DETAILS_BIRTH_PLACE_CD").val(response.results[0]['BORN_DETAILS_BIRTH_PLACE_CD']).change();
            });

        }

  /**************************************************************************************************************************************************************************************************/
  function clear_form() {
            $('#kt_stepper_example_basic_form')[0].reset();
            $('#kt_stepper_example_basic_form .form-select').val(' ').trigger('change');
        }


    </script>
@endpush
