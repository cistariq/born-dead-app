@extends('layouts.main')
@section('title', 'إضافة مولود جديد')

@section('content')

    <form action="#" id="new_born_form">
        <!--begin::Card-->
        <div class="card mb-7">
            <!--begin::Card body-->
            <div class="card-body">

                <!--begin::Compact form-->
                <div class="d-flex align-items-center">
                    <!--begin::Input group-->
                    <label class="col-lg-2 col-form-label required fw-bold fs-4">رقم هوية المولود
                    </label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-3">
                        <!--begin::Col-->
                        <input type="number" name="P_BI_ID" id="P_BI_ID" maxLength="9"
                            oninput="this.value=this.value.slice(0,this.maxLength)"
                            class="form-control form-control-lg mb-3 mb-lg-0" onchange="">
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                    <!--begin:Action-->
                    <div class="d-flex">
                        <button type="button" class="btn btn-primary me-5" onclick="check_born_record();">استعلام</button>

                        <button type="button" class="btn btn-outline-danger me-5" onclick="clear_form();">جديد</button>


                    </div>
                    <!--end:Action-->
                </div>
                <!--end::Compact form-->

            </div>
            <!--end::Col-->

        </div>

    </form>
    <form action="#" id="new_born_data" style="display: none;">
        <div class="card mb-7">
            <!--begin::Card body-->
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="row mb-12">

                        <label class="d-block fw-bold fs-6 mb-3 p-3 bg-success text-white">بيانات المولود
                        </label>

                        <div class="row mb-10">
                            <label class="col-form-label fw-bold col-lg-1">هوية رقم</label>
                            <div class="col-lg-2">
                                <input id="P_BI_NO" type="text" value=""
                                    class="form-control form-control-solid ps-8 required" onchange="check_born_id();" />
                            </div>
                            <label class="col-form-label fw-bold col-lg-2 required">اسم المولود الاول</label>
                            <div class="col-lg-2">
                                <input id="BI_FIRST_NAME" type="text" value=""
                                    class="form-control form-control-solid ps-8" />
                            </div>
                            <label class="col-form-label fw-bold col-lg-2 required">جنس المولود</label>
                            <div class="col-lg-2">
                                <select id="BI_SEX_CD" data-control="select2" data-placeholder="اختر ..."
                                    class="form-select form-select-lg fw-bold">
                                    <option value="">اختر...</option>
                                    <option value="1">ذكر</option>
                                    <option value="2">أنثى</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-10">

                            <label class="col-form-label fw-bold col-lg-1">ترتيب المولود</label>
                            <div class="col-lg-2">
                                <input id="BI_ORDER" type="text" value=""
                                    class="form-control form-control-solid ps-8" />
                            </div>
                            <label class="col-form-label fw-bold col-lg-2">وزن المولود بالجرام</label>
                            <div class="col-lg-2">
                                <input id="BI_WEIGHT_GM" type="text" value=""
                                    class="form-control form-control-solid ps-8" />
                            </div>
                            <label class="col-form-label fw-bold col-lg-2 required">ديانة المولود</label>
                            <div class="col-lg-2">
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
                        <label class="d-block fw-bold fs-6 mb-3 p-3 bg-success text-white">بيانات الولادة
                        </label>

                        <div class="row mb-10">

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
                            {{-- <input type="hidden" value="" name="B_CODE" id="B_CODE" /> --}}


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
                                        @foreach ($region as $item)
                                            <option value="{{ $item->r_code }}">{{ $item->r_name_ar }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label required fw-bold fs-6">الحي</label>
                                <div class="col-lg-2 fv-row">

                                    <select id="BORN_DETAILS_CITY_CD" data-control="select2" data-placeholder="الحي"
                                        class="form-select form-select-lg fw-bold">
                                        <option></option>

                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label fw-bold fs-6">المركز الصحي</label>
                                <div class="col-lg-2 fv-row">

                                    <select id="BORN_DETAILS_HEALTH_CENTER_CD" data-control="select2"
                                        data-placeholder="المركز الصحي" class="form-select form-select-lg fw-bold">

                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label fw-bold fs-6">رقم منزل الوالدين</label>
                                <!--end::Label-->
                                <div class="col-lg-2 fv-row">
                                    <input class="form-control text-center" id="BORN_DETAILS_HOME_NO">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label  fw-bold fs-6">تاريخ الزواج </label>
                                <!--end::Label-->
                                <div class="col-lg-2 fv-row">
                                    <input class="form-control text-center" id="BORN_DETAILS_MARRIAGE_DATE">
                                </div>
                                <label class="col-lg-2 col-form-label  fw-bold fs-6">رقم زواج الأم </label>
                                <!--end::Label-->
                                <div class="col-lg-2 fv-row">
                                    <input class="form-control text-center" id="BORN_DETAILS_MARRIAGE_NUMBER"
                                        value="1">
                                </div>
                                <label class="col-lg-2 col-form-label fw-bold fs-6">رقم تليفون الوالدين </label>
                                <!--end::Label-->
                                <div class="col-lg-2 fv-row">
                                    <input class="form-control text-center" id="BORN_DETAILS_PARENTS_TEL_NO">
                                </div>
                            </div>
                            <div class="row mb-6">

                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label fw-bold fs-6">عدد المواليد في الولادة
                                    الحالية</label>
                                <!--end::Label-->
                                <div class="col-lg-1 fv-row">
                                    <input type="number" name="BORN_DETAILS_PLURALITY" id="BORN_DETAILS_PLURALITY"
                                        maxLength="9" oninput="this.value=this.value.slice(0,this.maxLength)"
                                        class="form-control text-center form-control-lg mb-3 mb-lg-0" value="1"
                                        onchange="get_twins();">

                                </div>
                                <label class="col-lg-2 col-form-label fw-bold fs-6">توأم</label>
                                <div class="col-lg-2 fv-row mt-n1" style="position: relative;top: 10px;">

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
                                <label class="col-lg-3 col-form-label  fw-bold fs-6">عدد المواليد الأحياء من الزواج
                                    الحالي</label>
                                <!--end::Label-->
                                <div class="col-lg-1 fv-row">
                                    <input class="form-control text-center" id="BORN_DETAILS_CUR_MARRIAGE_LIVE">
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label  fw-bold fs-6">عدد المواليد الموتى من الزواج
                                    الحالي</label>
                                <!--end::Label-->
                                <div class="col-lg-1 fv-row">
                                    <input class="form-control text-center" id="BORN_DETAILS_CUR_MARRIAGE_DEAD">
                                </div>
                                <label class="col-lg-3 col-form-label  fw-bold fs-6">عدد المواليد الأحياء من الزواج
                                    السابق</label>
                                <!--end::Label-->
                                <div class="col-lg-1 fv-row">
                                    <input class="form-control text-center" id="BORN_DETAILS_PRE_MARRIAGE_LIVE"
                                        value="0">
                                </div>
                                <label class="col-lg-3 col-form-label  fw-bold fs-6">عدد المواليد الموتى من الزواج
                                    السابق</label>
                                <!--end::Label-->
                                <div class="col-lg-1 fv-row">
                                    <input class="form-control text-center" id="BORN_DETAILS_PRE_MARRIAGE_DEAD"
                                        value="0">
                                </div>
                            </div>
                        </div>
                        <label class="d-block fw-bold fs-6 mb-3 p-3 bg-success text-white">بيانات الأب
                        </label>
                        <div class="row mb-10">
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
                                    <button type="button" class="btn btn-outline-dark me-5"
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
                                                class="form-control text-center form-control-lg mb-3"
                                                placeholder="اسم الأب" disabled>
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
                                                {{-- @foreach ($city as $item)
                                                            <option value="{{ $item->c_code }}">{{ $item->c_name_ar }}
                                                            </option>
                                                        @endforeach --}}

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->

                        </div>
                        <label class="d-block fw-bold fs-6 mb-3 p-3 bg-success text-white">بيانات الأم
                        </label>
                        <div class="row mb-10">
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
                                    <button type="button" class="btn btn-outline-dark me-5"
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
                                                {{-- @foreach ($city as $item)
                                                            <option value="{{ $item->c_code }}">{{ $item->c_name_ar }}
                                                            </option>
                                                        @endforeach --}}
                                            </select>
                                        </div>
                                        <!--begin::Label-->

                                    </div>

                                </div>

                            </div>

                        </div>
                        <!--begin:Action-->
                        <div class="d-flex justify-content-center">

                            <button type="button" class="btn btn-primary me-5"
                                onclick="save_born_details_info();">حفظ</button>
                        </div>
                        <!--end:Action-->
                    </div>
                </div>

            </div>
        </div>
        </div>
    </form>

@endsection
@push('scripts')
    <script>
        function clear_form() {
            $('#new_born_form')[0].reset();
            $('#new_born_data')[0].reset();

        }

        function check_born_record() {
            var form_date = new FormData($('#new_born_form')[0]);
            var url = "{{ route('check_record_born') }}";
            $.ajax({
                url: url,
                type: 'json',
                method: 'post',
                cache: false,
                processData: false,
                contentType: false,
                async: false,
                data: form_date,
            }).done(function(response) {

                console.log(response.StatusCode);
                //alert(response.StatusCode);
                if (response.StatusCode == 1) {
                    document.getElementById("new_born_data").style.display = "block";
                    $('#P_BI_NO').val(response.Data.ID_NUM);
                    $('#BI_FIRST_NAME').val(response.Data.CHILD_NAME);
                    $('#BI_WEIGHT_GM').val(response.Data.BIRTH_WEIGHT);
                    if (response.Data.CHILD_SEX == 532) {
                        $('#BI_SEX_CD').val(1).change();
                    } else {
                        $('#BI_SEX_CD').val(2).change();
                    }
                    if (response.Data.FAHER_RELIGION == 539) {
                        $('#BI_RELEGION_CD').val(1).change();
                    } else {
                        $('#BI_RELEGION_CD').val(2).change();
                    }

                    $('#BORN_DETAILS_DELIVERY_DATE').val(response.Data.CHILD_DOB + " " + response.Data.BIRTH_HORS);
                    $('#P_FATHER_ID').val(response.Data.FAHER_ID);
                    getDataFatherInfoBy();
                    $('#P_MOTHER_ID').val(response.Data.MOTHER_ID);
                    getDataMotherInfoBy();
                    $('#BORN_DETAILS_PARENTS_TEL_NO').val(response.Data.MOBILENO);
                    $('#P_mother_phone').val(response.Data.MOBILENO);
                    $('#BORN_DETAILS_REGION_CD').val(response.Data.region_cd).change();
                    $('#BORN_DETAILS_CITY_CD').val(response.Data.city_cd).change();
                    if(response.Data.BIRTH_TYPE == 6573){
                        document.getElementById('weekRadio1').checked = true;

                        $('#BORN_DETAILS_TWINS').val(0);
                    }
                    else{
                        $('#BORN_DETAILS_TWINS').val(1);
                        document.getElementById('weekRadio2').checked = true;

                    }


                } else {
                    alert(response.Message);
                    $('#new_born_data')[0].reset();

                    document.getElementById("new_born_data").style.display = "none";

                }

            });
        }

        function getDataFatherInfoBy() {
            var P_FATHER_NO = $('#P_FATHER_ID').val();
            if (P_FATHER_NO) {
                var url = "{{ route('born.getFatherInfoByIdNo') }}";
                $.ajax({
                    url: url,
                    type: 'json',
                    method: 'post',
                    async: false,
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
                                $('#P_social_status_id').val(response.results.MARTIAL_STATUS_CD).change();
                                $('#P_social_status_name').val(response.results.MS_NAME);
                                $('#P_FATHER_JOB_CD').val(response.results.JOB_CD).change();
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

        $('#f_region_id').change(function() {
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
                    $('#f_city_id').empty();
                    console.log(3);
                    $('#f_city_id').append('<option >  </option>');
                    $.each(data, function(key, value) {
                        // console.log(value.C_NAME_AR);

                        $('#f_city_id').append('<option value="' + value.C_CODE +
                            '" >' + value.C_NAME_AR + '</option>');
                    });

                }
            });
        });

        function getDataMotherInfoBy() {
            var P_MOTHER_ID = $('#P_MOTHER_ID').val();
            if (P_MOTHER_ID) {
                var url = "{{ route('born.getMotherInfoByIdNo') }}";
                $.ajax({
                    url: url,
                    type: 'json',
                    method: 'post',
                    async: false,
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
                                $('#m_social_status_id').val(response.results.MARTIAL_STATUS_CD).change();
                                $('#m_social_status_name').val(response.results.MS_NAME);
                                $('#P_MOTHER_JOB_CD').val(response.results.JOB_CD).change();
                                $('#P_MOTHER_JOB_NAME').val(response.results.JOB_NAME);
                                $('#m_Year_Edu').val(response.results.YEAR_OF_EDUCATION);
                              //  $('#P_mother_phone').val(response.results.TEL);

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
        $('#m_region_id').change(function() {
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
                    $('#m_city_id').empty();
                    console.log(3);
                    $('#m_city_id').append('<option >  </option>');
                    $.each(data, function(key, value) {
                        // console.log(value.C_NAME_AR);

                        $('#m_city_id').append('<option value="' + value.C_CODE +
                            '" >' + value.C_NAME_AR + '</option>');
                    });

                }
            });
        });

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
                var B_CODE = $('#P_BI_CODE').val();


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
                var B_CODE = $('#P_BI_CODE').val();


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
                    console.log(response[0]['B_CODE']);
                    if (response.success) {
                        if (response.success == 1) {
                            Swal.fire({
                                title: 'تمت عملية إضافة إشعار الولادة بنجاح !',
                                text: response.results.message,
                                icon: "success",
                                confirmButtonText: 'موافق'
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    // alert(response[0]['B_CODE']);
                                    var F_ID = $('#P_FATHER_ID').val();
                                    var M_ID = $('#P_MOTHER_ID').val();
                                    $('#P_BI_CODE').val(response[0]['B_CODE']);
                                    $('#P_BI_ADMISSION_CD').val(response[0]['B_CODE']);
                                    edit_born_data();
                                  //  Upborn_data($('#P_BI_ADMISSION_CD').val());

                                }
                            });




                        } else {

                            toastr["error"](response.results.message);
                        }
                    } else {
                        // console.log(response);
                        $message = "";
                        $.each(response.errors, function(key, value) {
                            //  console.log(value);
                            //console.log(key);
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

        function Upborn_data(P_BI_ADMISSION_CD) {

            var url = "{{ route('born.is_born_found') }}";
            $.ajax({
                url: url,
                type: 'json',
                method: 'post',
                data: {
                    'P_BI_ADMISSION_CD': P_BI_ADMISSION_CD
                },
            }).done(function(response) {
                console.log(response);
                if (response.success) {
                    if (response.success == 1) {

                        if (response.results.FLAG == 1) {

                            var url = "{{ route('born.getBornInfoByNo') }}";
                            $.ajax({
                                url: url,
                                type: 'json',
                                method: 'post',
                                data: {
                                    'P_BI_ADMISSION_CD': P_BI_ADMISSION_CD
                                },
                            }).done(function(response) {
                                console.log(response);
                                if (response.success) {
                                    if (response.success == 1) {

                                        $('#P_BI_ID').val(response.results.BI_ID);
                                        $('#BI_ORDER').val(response.results.BI_ORDER);
                                        $('#BI_WEIGHT_GM').val(response.results
                                            .BI_WEIGHT_GM);
                                        $('#BI_FIRST_NAME').val(response.results
                                            .BI_FIRST_NAME);
                                        $('#BI_SEX_CD').val(response.results.BI_SEX_CD)
                                            .change();
                                        $('#BI_RELEGION_CD').val(response.results
                                            .BI_RELEGION_CD).change();
                                        $('#BI_PARTOGRAM_CD').val(response.results
                                            .BI_PARTOGRAM_CD);
                                        $('#BI_PRESENTATION_CD').val(response.results
                                            .BI_PRESENTATION_CD);
                                        $('#BI_OUT_COME_CD').val(response.results
                                            .BI_OUT_COME_CD);
                                        $('#BI_APAGAR_5').val(response.results
                                            .BI_APAGAR_5);
                                        $('#BI_APAGAR_1').val(response.results
                                            .BI_APAGAR_1);
                                        $('#BI_CONGENITAL_ANOMALIES_CD').val(response
                                            .results.BI_CONGENITAL_ANOMALIES_CD);
                                        $('#BI_EXAM_OUT_COME_CD').val(response.results
                                            .BI_EXAM_OUT_COME_CD);
                                        $('#BI_EXAM_BEFORE_CD').val(response.results
                                            .BI_EXAM_BEFORE_CD);
                                        $('#BI_ADMITTED_NICU_CD').val(response.results
                                            .BI_ADMITTED_NICU_CD);

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

        function check_born_id() {
            var P_BI_ID = $('#P_BI_NO').val();
            var url = "{{ route('born.check_born_id') }}";
            $.ajax({
                url: url,
                type: 'json',
                method: 'post',
                data: {
                    'P_BI_ID': P_BI_ID,
                },
            }).done(function(response) {
                console.log(response);
                if (response.success) {
                    edit_born_data();
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
                        text: 'رقم الهوية مدخل مسبقاً يرجى اختيار رقم آخر!',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            $('#P_BI_NO').val('');
                            document.getElementById("P_BI_NO").focus();

                        }
                    });

                }
            });
        }

        function edit_born_data() {
            //dead data
            if (($('#P_BI_NO').val() == null || $('#P_BI_NO').val() == undefined || $('#P_BI_NO').val() == '') || ($(
                    '#BI_ORDER').val() == null || $('#BI_ORDER').val() == undefined || $('#BI_ORDER').val() == '') || ($(
                        '#BI_WEIGHT_GM').val() == null || $('#BI_WEIGHT_GM').val() == undefined || $('#BI_WEIGHT_GM')
                    .val() == '') || ($(
                        '#BI_FIRST_NAME').val() == null || $('#BI_FIRST_NAME').val() == undefined || $('#BI_FIRST_NAME')
                    .val() == '') || ($(
                    '#BI_SEX_CD').val() == null || $('#BI_SEX_CD').val() == undefined || $('#BI_SEX_CD').val() == '') || ($(
                        '#BI_RELEGION_CD').val() == null || $('#BI_RELEGION_CD').val() == undefined || $('#BI_RELEGION_CD')
                    .val() == '')) {
                Swal.fire({

                    icon: 'info',
                    title: 'تنبيه',
                    text: 'يجب إدخال جميع البيانات الخاصة بالمولود! ',

                });
            } else {
                var P_BI_ADMISSION_CD = $('#BI_ADMISSION_CD').val();
                var P_BI_ID = $('#P_BI_NO').val();
                var P_BI_ORDER = $('#BI_ORDER').val();
                var P_BI_WEIGHT_GM = $('#BI_WEIGHT_GM').val();
                var P_BI_FIRST_NAME = $('#BI_FIRST_NAME').val();
                var P_BI_SEX_CD = $('#BI_SEX_CD').val();
                var P_BI_RELEGION_CD = $('#BI_RELEGION_CD').val();
                var P_BI_PARTOGRAM_CD = $('#BI_PARTOGRAM_CD').val();
                var P_BI_PRESENTATION_CD = $('#BI_PRESENTATION_CD').val();
                var P_BI_OUT_COME_CD = $('#BI_OUT_COME_CD').val();
                var P_BI_APAGAR_5 = $('#BI_APAGAR_5').val();
                var P_BI_APAGAR_1 = $('#BI_APAGAR_1').val();
                var P_BI_CONGENITAL_ANOMALIES_CD = $('#BI_CONGENITAL_ANOMALIES_CD').val();
                var P_BI_EXAM_OUT_COME_CD = $('#BI_EXAM_OUT_COME_CD').val();
                var P_BI_EXAM_BEFORE_CD = $('#BI_EXAM_BEFORE_CD').val();
                var P_BI_ADMITTED_NICU_CD = $('#BI_ADMITTED_NICU_CD').val();

                var url = "{{ route('born.save_born_info') }}";
                $.ajax({
                    url: url,
                    type: 'json',
                    method: 'post',
                    data: {
                        'P_BI_ID': P_BI_ID,
                        'P_BI_ADMISSION_CD': P_BI_ADMISSION_CD,
                        'P_BI_ORDER': P_BI_ORDER,
                        'P_BI_WEIGHT_GM': P_BI_WEIGHT_GM,
                        'P_BI_FIRST_NAME': P_BI_FIRST_NAME,
                        'P_BI_SEX_CD': P_BI_SEX_CD,
                        'P_BI_RELEGION_CD': P_BI_RELEGION_CD,
                        'P_BI_PARTOGRAM_CD': P_BI_PARTOGRAM_CD,
                        'P_BI_PRESENTATION_CD': P_BI_PRESENTATION_CD,
                        'P_BI_OUT_COME_CD': P_BI_OUT_COME_CD,
                        'P_BI_APAGAR_5': P_BI_APAGAR_5,
                        'P_BI_APAGAR_1': P_BI_APAGAR_1,
                        'P_BI_CONGENITAL_ANOMALIES_CD': P_BI_CONGENITAL_ANOMALIES_CD,
                        'P_BI_EXAM_OUT_COME_CD': P_BI_EXAM_OUT_COME_CD,
                        'P_BI_EXAM_BEFORE_CD': P_BI_EXAM_BEFORE_CD,
                        'P_BI_ADMITTED_NICU_CD': P_BI_ADMITTED_NICU_CD,

                    },
                }).done(function(response) {
                    console.log(response);
                    if (response.success) {
                        if (response.success == 1) {
                            Swal.fire({
                                title: 'تمت عملية تعديل بيانات المولود  بنجاح !',
                                text: response.results.message,
                                icon: "success",
                                confirmButtonText: 'موافق'
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    clear_form();
                                }
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
                            text: 'تأكد من البيانات المولود المدخلة!',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                });
            }
        }

        $('#BORN_DETAILS_CITY_CD').change(function() {
            var city_cd = $(this).val();
            var url = "{{ route('dead.get_helth_center') }}";
            $.ajax({
                url: url,
                type: 'json',
                method: 'post',
                async: false,
                data: {
                    city_cd: city_cd
                },
                success: function(data) {
                    console.log(data);
                    $('#BORN_DETAILS_HEALTH_CENTER_CD').empty();
                    console.log(3);
                    $('#BORN_DETAILS_HEALTH_CENTER_CD').append('<option >  </option>');
                    $.each(data, function(key, value) {
                        // console.log(value.C_NAME_AR);

                        $('#BORN_DETAILS_HEALTH_CENTER_CD').append('<option value="' + value
                            .dref_code +
                            '" >' + value.dref_name_ar + '</option>');
                    });

                }
            });
        });

        $('#BORN_DETAILS_REGION_CD').change(function() {
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
                    $('#BORN_DETAILS_CITY_CD').empty();
                    console.log(3);
                    $('#BORN_DETAILS_CITY_CD').append('<option >  </option>');
                    $.each(data, function(key, value) {
                        // console.log(value.C_NAME_AR);

                        $('#BORN_DETAILS_CITY_CD').append('<option value="' + value.C_CODE +
                            '" >' + value.C_NAME_AR + '</option>');
                    });

                }
            });
        });



        $('#BORN_DETAILS_CITY_CD').change(function() {
            var city_cd = $(this).val();
            var url = "{{ route('dead.get_helth_center') }}";
            $.ajax({
                url: url,
                type: 'json',
                method: 'post',
                async: false,
                data: {
                    city_cd: city_cd
                },
                success: function(data) {
                    console.log(data);
                    $('#BORN_DETAILS_HEALTH_CENTER_CD').empty();
                    console.log(3);
                    $('#BORN_DETAILS_HEALTH_CENTER_CD').append('<option >  </option>');
                    $.each(data, function(key, value) {
                        // console.log(value.C_NAME_AR);

                        $('#BORN_DETAILS_HEALTH_CENTER_CD').append('<option value="' + value
                            .dref_code +
                            '" >' + value.dref_name_ar + '</option>');
                    });

                }
            });
        });

        function get_twins() {
            if ($('#BORN_DETAILS_PLURALITY').val() > 1) {
                $('#weekRadio2').prop('checked', true);

                //alert(1);

            } else {
                $('#weekRadio1').prop('checked', true);

            }

        }
    </script>
@endpush
