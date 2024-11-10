@extends('layouts.main')
@section('title', 'ثوابت النظام')

@section('content')
<div class="row gy-5 g-xl-10">
    <div class="col-xl-6 mb-xl-10">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">الثوابت الرئيسية</span>
                </h3>
                <!--begin::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body py-4">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_constants">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th>#</th>
                            <th class="min-w-125px">اسم الثابت</th>
                            <th class="min-w-125px">تاريخ الإضافة</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                        @foreach ($contants as $contant)
                        <tr style="cursor: pointer" >
                            <td>{{$loop->index + 1}}</td>
                            <td onclick="selectConstatnDtl({{$contant->id}})">{{ $contant->name
                                }}</td>
                            <td>{{ $contant->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <div class="col-xl-6 mb-xl-10">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">تفاصيل الثابت</span>
                </h3>

            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body py-4">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="dtl_constant-tb">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th>رقم الثابت</th>
                            <th class="min-w-125px">اسم الثابت</th>
                            <th class="min-w-125px">يتبع ل</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                    </tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
</div>
@endsection
@push('scripts')
<script>
    function selectConstatnDtl(id)
    {
        var url = "{{ route('constant.get_constant_dtl') }}";
        dt = $("#dtl_constant-tb").DataTable({
            destroy: true,
            ajax: {
                url: url,
                method: 'post',
                data: {
                    parent_id: id,
                },
            },
            "dom":
                "<'row mb-2'" +
                "<'col-sm-6 d-flex align-items-center justify-conten-start dt-toolbar'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end dt-toolbar'f>" +
                ">" +

                "<'table-responsive'tr>" +

                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">"
        });
    }

</script>
@endpush
