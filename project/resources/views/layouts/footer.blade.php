{{-- <script> var hostUrl = "assets/";</script> --}}
		<!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{asset('assets/plugins/global/plugins.bundle.js')}} " ></script>
    <script src="{{asset('assets/js/scripts.bundle.js')}}" ></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used by this page)-->
    <script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}" ></script>
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}" ></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used by this page)-->
    <script src="{{asset('assets/js/widgets.bundle.js')}}" ></script>
    <script src="{{asset('assets/js/custom/widgets.js')}}" ></script>
    <script src="{{asset('assets/js/custom/apps/chat/chat.js')}}" ></script>
    <script src="{{asset('assets/js/custom/utilities/modals/upgrade-plan.js')}}" ></script>
    <script src="{{asset('assets/js/custom/utilities/modals/create-app.js')}}" ></script>
    <script src="{{asset('assets/js/custom/utilities/modals/new-target.js')}}" ></script>
    <script src="{{asset('assets/js/custom/utilities/modals/users-search.js')}}" ></script>
    {{-- <script src="{{asset('assets/plugins/global/tagify.min.js')}} "></script> --}}


    <!--end::Custom Javascript-->
    <!--end::Javascript-->
    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toastr-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        };
        @if(session('message'))
            Swal.fire({
                title: 'خطأ!',
                text: "{{session('message')}}",
                icon: "{{session('m-class',"error")}}",
            })
            {{Session::forget('message')}}
        @endif
    </script>
    @stack('scripts')
