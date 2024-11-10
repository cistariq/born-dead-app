
<!DOCTYPE html>
<html direction="rtl" dir="rtl" style="direction: rtl">
<!--begin::Head-->
<head>
    <meta charset="utf-8" />
    <title>تسجيل الدخول | {{config('app.name')}} </title>
    <!--begin::Fonts-->
    <!--end::Fonts-->
    <link href="{{asset('assets/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />

    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="bg-body">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Logo-->
                {{-- <a href="#" class="mb-12">
                    <img alt="Logo" src="assets/media/logos/logo-1.svg" class="h-40px" />
                </a> --}}
                <!--end::Logo-->
                <!--begin::Wrapper-->
                <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto" >
                    <!--begin::Form-->
                    <x-flash-error />
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST" action="{{route('login.check')}}">
                        @csrf
                        <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <!--begin::Title--><strong>
                            <h1 class="text-dark mb-3">نظام المواليد والوفيات</h1> </strong>
                            <!--end::Title-->
                        </div>
                        <div class="text-center mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">تسجيل الدخول</h1>
                            <!--end::Title-->
                        </div>
                        <!--begin::Heading-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="form-label fs-6 fw-bolder text-dark">اسم المستخدم</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-lg form-control-solid" type="text" name="user_name" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack mb-2">
                                <!--begin::Label-->
                                <label class="form-label fw-bolder text-dark fs-6 mb-0">كلمة المرور</label>
                                <!--end::Label-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Input-->
                            <input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <!--begin::Submit button-->
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                                <span class="indicator-label">تسجيل الدخول</span>
                                <span class="indicator-progress">انتظر قليلاً...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Submit button-->

                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
            <div class="d-flex flex-center flex-column-auto p-10">
                <!--begin::Links-->

                <!--end::Links-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <!--end::Main-->
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{ asset('assets/js/custom/authentication/sign-in/general1.js') }}"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->
</html>
