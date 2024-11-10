@extends('layouts.main')

@section('title', 'منح صلاحيات الشاشة')

@section('content')
    <form action="#" id="roles_form">
        <!--begin::Card-->
        <div class="card  mb-7">
            <!--begin::Card body-->
            <div class="card-body py-4">
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label required fw-bold fs-6">المستخدم</label>
                    <div class="col-lg-9">
                        <select class="form-select select2-accessible" data-control="select2" id="P_USER_NO"
                            data-placeholder="اختر المستخدم" onchange="get_role_user();">
                            <option></option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
        <!--begin::Card-->
        <div class="card" id="role_user">

        </div>
        <!--end::Card-->
    </form>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

        });

        function get_role_user() {
            var user_id = $('#P_USER_NO').val();
            var url = "{{ route('roles.getUserPageByUserId') }}";
            $.ajax({
                url: url,
                method: 'post',
                data: {
                    user_id: user_id
                },
            }).done(function(response) {
                $('#role_user').html(response);
            });
        }
    </script>
@endpush
