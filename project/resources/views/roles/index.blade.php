@extends('layouts.main')
@section('title', 'شاشات النظام')

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
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
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
            <div class="d-flex justify-content-end" data-kt-role-table-toolbar="base">
                @if (IsPermissionBtn(8))
                <!--begin::Add role-->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_role_page"
                onClick="clear_form()">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->بيانات شاشة</button>
                <!--end::Add role-->
                @endif
            </div>
            <!--end::Toolbar-->
            <!--begin::Group actions-->
            <div class="d-flex justify-content-end align-items-center d-none" data-kt-role-table-toolbar="selected">
                <div class="fw-bolder me-5">
                <span class="me-2" data-kt-role-table-select="selected_count"></span>Selected</div>
                <button type="button" class="btn btn-danger" data-kt-role-table-select="delete_selected">Delete Selected</button>
            </div>
            <!--end::Group actions-->
            <!--begin::Modal - Add task-->
            <div class="modal fade" id="add_role_page" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header" id="kt_modal_role_page_header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bolder">إضافة شاشة</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
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
                            <form id="role_page_form" class="form">
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_role_page_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_role_page_header" data-kt-scroll-wrappers="#kt_modal_role_page_scroll" data-kt-scroll-offset="300px">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">اسم الشاشة</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="hidden" id="page_id" name="page_id" class="form-control  mb-3 mb-lg-0"/>
                                        <input type="text" id="page_name" name="page_name" class="form-control  mb-3 mb-lg-0"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7" >
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">اسم الراوت</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" id="url" name="url" class="form-control mb-3 mb-lg-0"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fw-bold fs-6 mb-2">تتبع لشاشة </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select class="form-select form-control mb-3 mb-lg-0" data-control="select2"
                                        data-dropdown-parent="#add_role_page" id="follow_to_id" data-placeholder="اختر الشاشة">
                                            <option value="">شاشة رئيسية</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Scroll-->
                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="button" id="kt_new_role_submit" class="btn btn-lg btn-primary fw-bolder">
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
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body py-4">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="roles_tb">
            <!--begin::Table head-->
            <thead>
                <!--begin::Table row-->
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">#</th>
                    <th class="min-w-125px">الاسم</th>
                    <th class="min-w-125px">اسم الراوت</th>
                    <th class="min-w-125px">يتبع ل</th>
                    <th class="min-w-125px">تاريخ الإدخال</th>
                    <th class="text-end min-w-100px">الإجراءات</th>
                </tr>
                <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="text-gray-600 fw-bold">
                <!--begin::Table row-->
                @foreach ($roles as $role)
                <tr>
                    <!--begin::role=-->
                    <td>{{ $loop->index +1}}</td>
                    <td>{{$role->name}}</td>
                    <td>{{$role->url}}</td>
                    <td>{{$role->follow_to ? $role->follow_to->name :''}}</td>
                    <td>{{$role->created_at}}</td>
                    <!--begin::Action=-->
                    <td class="text-end">
                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">الإجراءات
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                        <span class="svg-icon svg-icon-5 m-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon--></a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a class="menu-link px-3" onclick="updateRolePage({{$role->id}},'{{$role->name}}','{{$role->url}}','{{$role->follow_to_id}}')" >تعديل</a>
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
    form = document.querySelector('#role_page_form');
    submitButton = document.querySelector('#kt_new_role_submit');

    handleForm();
    datatable = $('#roles_tb').DataTable();
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
                    'page_name': {
                        validators: {
                            notEmpty: {
                                message: 'حقل اسم الشاشة مطلوب'
                            },
                        }
                    },
                    'url': {
                        validators: {
                            notEmpty: {
                                message: 'حقل اسم الراوت مطلوب'
                            },
                        }
                    }
				},
				plugins: {
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
                        insert_new_role();
                    }, 1000);
                } else {
                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "عذراً, أدخل جميع الحقول المطلوبة.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "حسنا، حصلت عليه!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
		    });
        });
    }
    function insert_new_role()
    {
        var page_name = $('#page_name').val();
        var p_url = $('#url').val();
        var follow_to_id = $('#follow_to_id').val();
        var page_id = $('#page_id').val();
        var url = "{{route('roles.store')}}";
        $.ajax({
            url: url,
            type:'json',
            method: 'post',
            data: {'page_name' : page_name,'follow_to_id':follow_to_id, 'p_url':p_url,'page_id':page_id },
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
                        clear_form();
                        $('#add_role_page').modal('hide');
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
    function clear_form() {
        $('#role_page_form')[0].reset();
        $('#page_id').val('');
        $('#follow_to_id').val('').change();
    }

    function updateRolePage(id,name,url,follow_to_id)
    {
        $('#page_id').val(id);
        $('#page_name').val(name);
        $('#url').val(url);
        $('#follow_to_id').val(follow_to_id).change();
        $('#add_role_page').modal('show');

    }
</script>
@endpush
