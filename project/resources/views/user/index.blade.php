@extends('layouts.main')
@section('title', 'المستخدمين')

@section('content')

<!--begin::Card-->
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <input type="text" id="search" class="form-control form-control-solid w-250px ps-14" placeholder="بحث" />
            </div>
            <!--end::Search-->
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <!--begin::Add user-->
                @if (IsPermissionBtn(7))
                <button type="button" class="btn btn-primary" onclick="clearField()">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                    <span class="svg-icon svg-icon-2">
                        <svg  width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->إضافة مستخدم</button>
                @endif

                <!--end::Add user-->
            </div>
            <!--end::Toolbar-->
            <!--begin::Group actions-->
            <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                <div class="fw-bolder me-5">
                <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected</div>
                <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
            </div>
            <!--end::Group actions-->
            <!--begin::Modal - Add user-->
            <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header" id="kt_modal_add_user_header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bolder">إضافة المستخدم</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                            <!--begin::Form-->
                            <form id="add_user_form" class="form">
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">اسم المستخدم</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="user_name" id="p_user_name"
                                            class="form-control form-control-solid mb-3 mb-lg-0"  />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">رقم الهوية (اسم المستخدم)</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="number" name="p_id_no"  maxLength="9"
                                        oninput="this.value=this.value.slice(0,this.maxLength)"
                                        class="form-control form-control-solid mb-3 mb-lg-0" id="p_id_no" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">المستشفى التي يتبع لها</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select id="p_hospital_id" name="p_hospital_id" data-control="select2" data-placeholder="اختر ..." data-allow-clear="true"
                                            class="form-select form-select-solid form-select-lg fw-bold">
                                            <option></option>
                                            @foreach ($hospitals as $hospital)
                                                <option value="{{$hospital->dref_code}}">{{$hospital->dref_name_ar}}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7" data-kt-password-meter="true">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">كلمة المرور</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div class="position-relative mb-3">
                                            <input class="form-control form-control-lg form-control-solid" type="password"
                                                id="password" name="password" autocomplete="off" />
                                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                data-kt-password-meter-control="visibility">
                                                <i class="bi bi-eye-slash fs-2"></i>
                                                <i class="bi bi-eye fs-2 d-none"></i>
                                            </span>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group=-->
                                    <div class="fv-row mb-10">
                                        <label class="form-label fw-bolder text-dark fs-6">تأكيد كلمة المرور</label>
                                        <input class="form-control form-control-lg form-control-solid" type="password" placeholder=""
                                        id="password_confirmation" name="confirm-password" autocomplete="off" />
                                    </div>
                                    <!--end::Input group=-->
                                </div>
                                <!--end::Scroll-->
                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="button" id="kt_new_password_submit" class="btn btn-lg btn-primary fw-bolder">
                                        <span class="indicator-label">حفظ</span>
                                        <span class="indicator-progress">الرجاء الانتظار...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">إغلاق</button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - Add task-->
            <!--begin::Modal - update user-->
            <div class="modal fade" id="kt_modal_update_user" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header" id="kt_modal_update_user_header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bolder">تعديل بيانات المستخدم</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                            <!--begin::Form-->
                            <form id="update_user_form" class="form">
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <input type="hidden" name="u_id_user" id="u_id_user" />
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">اسم المستخدم</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="u_user_name" id="u_user_name"
                                            class="form-control form-control-solid mb-3 mb-lg-0"  />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">رقم الهوية (اسم المستخدم)</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="number" name="u_id_no"  maxLength="9"
                                        oninput="this.value=this.value.slice(0,this.maxLength)"
                                        class="form-control form-control-solid mb-3 mb-lg-0" id="u_id_no" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">المستشفى التي يتبع لها</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select id="u_hospital_id" name="u_hospital_id" data-control="select2" data-placeholder="اختر ..." data-allow-clear="true"
                                            class="form-select form-select-solid form-select-lg fw-bold">
                                            <option></option>
                                            @foreach ($hospitals as $hospital)
                                                <option value="{{$hospital->dref_code}}">{{$hospital->dref_name_ar}}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->

                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <label class="fw-bold fs-6 mb-2">حالة المستخدم</label>
                                            <input class="form-check-input ms-10" type="checkbox" value="1" id="u_status" >
                                        </label>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                </div>
                                <!--end::Scroll-->
                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="button" id="kt_update_user_submit" onclick="updateUser()" class="btn btn-lg btn-primary fw-bolder">
                                        <span class="indicator-label">حفظ</span>
                                        <span class="indicator-progress">الرجاء الانتظار...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">إغلاق</button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - update user-->
            <!--begin::Modal - change password-->
            <div class="modal fade" id="kt_modal_change_password" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header" id="kt_modal_change_password_header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bolder">تغيير كلمة المرور</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg  width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                            <!--begin::Form-->
                            <form id="update_password_form" class="form">
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_change_password_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_change_password_header" data-kt-scroll-wrappers="#kt_modal_change_password_scroll" data-kt-scroll-offset="300px">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <input type="hidden" name="pass_id_user" id="pass_id_user" />
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">اسم المستخدم</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="pass_user_name" id="pass_user_name"
                                            class="form-control form-control-solid mb-3 mb-lg-0"  readonly/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7" data-kt-password-meter="true">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">كلمة المرور</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div class="position-relative mb-3">
                                            <input class="form-control form-control-lg form-control-solid" type="password"
                                                id="pass_password" name="pass_password" autocomplete="off" />
                                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                            data-kt-password-meter-control="visibility">
                                                <i class="bi bi-eye-slash fs-2"></i>
                                                <i class="bi bi-eye fs-2 d-none"></i>
                                            </span>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group=-->
                                    <div class="fv-row mb-10">
                                        <label class="form-label fw-bolder text-dark fs-6">تأكيد كلمة المرور</label>
                                        <input class="form-control form-control-lg form-control-solid" type="password" placeholder=""
                                        id="pass_password_confirmation" name="pass_confirm-password" autocomplete="off" />
                                    </div>
                                    <!--end::Input group=-->
                                    <!--begin::Input group-->
                                </div>
                                <!--end::Scroll-->
                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="button" onclick="ChangePassword()" class="btn btn-lg btn-primary fw-bolder">
                                        <span class="indicator-label">حفظ</span>
                                        <span class="indicator-progress">الرجاء الانتظار...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">إغلاق</button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - change password-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body py-4">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="users_tb">
            <!--begin::Table head-->
            <thead>
                <!--begin::Table row-->
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">#</th>
                    <th class="min-w-125px">الاسم</th>
                    <th class="min-w-125px">اسم المستخدم</th>
                    {{-- <th class="min-w-125px">المستشفى</th> --}}
                    <th class="min-w-125px">تاريخ الإدخال</th>
                    <th class="min-w-125px">الحالة</th>
                    <th class="text-end min-w-100px">الإجراءات</th>
                </tr>
                <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="text-gray-600 fw-bold">
                <!--begin::Table row-->
                @foreach ($users as $user)
                <tr>

                    <!--begin::User=-->
                    <td>{{ $loop->index +1}}</td>
                    <td>{{$user->user_full_name}}</td>
                    <td>{{$user->user_username}}</td>
                    {{-- <td>{{$user->hospital ? $user->hospital ->name :''}}</td> --}}
                    <td>{{$user->created_at}}</td>
                    @if ($user->status == 1)
                    <td class="text-success">مفعل</td>
                    @else
                    <td class="text-danger">غير مفعل</td>
                    @endif

                    <!--begin::Action=-->
                    <td class="text-end">
                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">الإجراءات
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                        <span class="svg-icon svg-icon-5 m-0">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon--></a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a class="menu-link px-3" onclick="getDataUser({{$user->id}},'{{$user->name}}','{{$user->user_name}}',{{$user->status}},{{$user->hospital_id}})" >تعديل</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a class="menu-link px-3" onclick="ShowChangePassword({{$user->id}},'{{$user->name}}')" >تغيير كلمة المرور</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                    </td>
                    <!--end::Action=-->
                </tr>
                @endforeach
                <!--end::Table row-->
            </tbody>
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
@endsection
@push('scripts')
<script>
     var datatable;
     var form;
    var submitButton;
$(document).ready(function() {
    $('#add_user_form')[0].reset();
    form = document.querySelector('#add_user_form');
    submitButton = document.querySelector('#kt_new_password_submit');

    handleForm();
    datatable = $('#users_tb').DataTable();
    $('#search').on('keyup', function (e) {
        datatable.search(e.target.value).draw();
    });
});
    var handleForm = function(e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
			form,
			{
				fields: {
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'The password is required'
                            },
                            callback: {
                                message: 'Please enter valid password',
                                callback: function(input) {
                                    if (input.value.length > 0) {
                                        return validatePassword();
                                    }
                                }
                            }
                        }
                    },
                    'confirm-password': {
                        validators: {
                            notEmpty: {
                                message: 'The password confirmation is required'
                            },
                            identical: {
                                compare: function() {
                                    return form.querySelector('[name="password"]').value;
                                },
                                message: 'The password and its confirm are not the same'
                            }
                        }
                    }
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger({
                        event: {
                            password: false
                        }
                    }),
					bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',  // comment to enable invalid state icons
                        eleValidClass: '' // comment to enable valid state icons
                    })
				}
			}
		);

        submitButton.addEventListener('click', function (e) {
            e.preventDefault();

            validator.revalidateField('password');

            validator.validate().then(function(status) {
		        if (status == 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;

                    // Simulate ajax request
                    setTimeout(function() {
                        // Hide loading indication
                        submitButton.removeAttribute('data-kt-indicator');

                        // Enable button
                        submitButton.disabled = false;
                        insert_new_user();
                    }, 1000);
                } else {
                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
		    });
        });

        form.querySelector('input[name="password"]').addEventListener('input', function() {
            if (this.value.length > 0) {
                validator.updateFieldStatus('password', 'NotValidated');
            }
        });
    }
    function insert_new_user()
    {
        var user_full_name = $('#p_user_name').val();
        var user_username = $('#p_id_no').val();
        var user_dref_cd = $('#p_hospital_id').val();
        var password = $('#password').val();
        var password_confirmation = $('#password_confirmation').val();

        var url = "{{route('user.insert_user')}}";
        $.ajax({
            url: url,
            type:'json',
            method: 'post',
            data: {'user_full_name' : user_full_name ,'password':password,'password':password ,
                'password_confirmation':password_confirmation,'user_username':user_username , user_dref_cd:user_dref_cd
            },
        }).done(function (response) {
            console.log(response);
            if(response.success){
                if(response.success == 1){
                    Swal.fire({
                        title: 'تمت العملية بنجاح !',
                        text: response.results.message,
                        icon: "success",
                        confirmButtonText: 'موافق'
                        });
                    location.reload();
                }else{
                    toastr["error"](response.results.message);
                }
            }else{
                console.log(response);
                $message = "";
                $.each(response.errors, function (key, value) {
                    console.log(value);
                    console.log(key);
                    $message += value.join('-') + "\r\n";
                });
                Swal.fire({
                    title:  'خطأ !',
                    text: $message,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            }
        });
    }
    function clearField()
    {
        $('#add_user_form')[0].reset();
        $('#p_id_no').val('');
        $('#p_hospital_id').val('').change();
        $('#kt_modal_add_user').modal('show');
    }
    function getDataUser(id,name,user_name,status,hospital_id)
    {
        $('#u_id_user').val(id);
        $('#u_id_no').val(user_name);
        $('#u_user_name').val(name);
        $('#u_hospital_id').val(hospital_id).change();
        $('#u_status').prop('checked', status);
        $('#kt_modal_update_user').modal('show');
    }
    function updateUser()
    {
        var u_id_user =$('#u_id_user').val();
        var user_full_name = $('#u_user_name').val();
        var user_username = $('#u_id_no').val();
        var user_dref_cd = $('#u_hospital_id').val();
        var status = $('#u_status').is(":checked");
        if(status){
            status = 1;
        }else{
            status = 0;
        }
        var url = "{{route('user.update')}}";
        $.ajax({
            url: url,
            type:'json',
            method: 'post',
            data: {'user_full_name' : user_full_name ,'status':status
                ,'user_username':user_username , 'id_user':u_id_user,user_dref_cd:user_dref_cd
            },
        }).done(function (response) {
            console.log(response);
            if(response.success){
                if(response.success == 1){
                    Swal.fire({
                        title: 'تمت العملية بنجاح !',
                        text: response.results.message,
                        icon: "success",
                        confirmButtonText: 'موافق'
                        });
                    $('#kt_modal_update_user').modal('hide');
                    location.reload();
                }else{
                    toastr["error"](response.results.message);
                }
            }else{
                console.log(response);
                $message = "";
                $.each(response.errors, function (key, value) {
                    console.log(value);
                    console.log(key);
                    $message += value.join('-') + "\r\n";
                });
                Swal.fire({
                    title:  'خطأ !',
                    text: $message,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            }
        });
    }
    function ShowChangePassword(id,name)
    {
        $('#pass_id_user').val(id);
        $('#pass_user_name').val(name);
        $('#kt_modal_change_password').modal('show');
    }
    function ChangePassword()
    {
        var u_id_user =$('#pass_id_user').val();
        var pass_password = $('#pass_password').val();
        var pass_password_confirmation = $('#pass_password_confirmation').val();

        var url = "{{route('user.update_password')}}";
        $.ajax({
            url: url,
            type:'json',
            method: 'post',
            data: { 'id_user' : u_id_user ,
                    'password':pass_password,
                    'password_confirmation':pass_password_confirmation
            },
        }).done(function (response) {
            console.log(response);
            if(response.success){
                if(response.success == 1){
                    Swal.fire({
                        title: 'تمت العملية بنجاح !',
                        text: response.results.message,
                        icon: "success",
                        confirmButtonText: 'موافق'
                        });
                    $('#kt_modal_change_password').modal('hide');
                }else{
                    toastr["error"](response.results.message);
                }
            }else{
                console.log(response);
                $message = "";
                $.each(response.errors, function (key, value) {
                    console.log(value);
                    console.log(key);
                    $message += value.join('-') + "\r\n";
                });
                Swal.fire({
                    title:  'خطأ !',
                    text: $message,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            }
        });
    }
</script>
@endpush
