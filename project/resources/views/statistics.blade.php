@extends('layouts.main')
@section('title', 'احصائيات وفيات')

@section('content')

<div class="row gx-5 gx-xl-10">
    <!--begin::Col-->
    <div class="col-xl-6 mb-5 mb-xl-10">
        <!--begin::Chart widget 15-->
        <div class="card card-flush h-xl-100">
            <!--begin::Header-->
            <div class="card-header pt-7">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-900">Author Sales</span>
                    <span class="text-gray-500 pt-2 fw-semibold fs-6">Statistics by Countries</span>
                </h3>
                <!--end::Title-->
                <!--begin::Toolbar-->
                <div class="card-toolbar">
                    <div class="card-toolbar">
                        <a href="#" class="btn btn-sm btn-light">PDF Report</a>
                    </div>
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold w-100px py-4" data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">Remove</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">Mute</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">Settings</a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu-->
                    <!--end::Menu-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-5">
                <!--begin::Chart container-->
                <div id="kt_charts_widget_15_chart" class="min-h-auto ps-4 pe-6 mb-3 h-300px"><div style="position: relative; width: 100%; height: 100%;"><div aria-hidden="true" style="position: absolute; width: 553px; height: 300px;"><div><canvas class="am5-layer-0" width="553" height="300" style="position: absolute; top: 0px; left: 0px; width: 553px; height: 300px;"></canvas><canvas class="am5-layer-30" width="553" height="300" style="position: absolute; top: 0px; left: 0px; width: 553px; height: 300px;"></canvas></div></div><div class="am5-html-container" style="position: absolute; pointer-events: none; overflow: hidden; width: 553px; height: 300px;"></div><div class="am5-reader-container" role="alert" style="position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(1px, 1px, 1px, 1px);"></div><div class="am5-focus-container" role="graphics-document" style="position: absolute; pointer-events: none; top: 0px; left: 0px; overflow: hidden; width: 553px; height: 300px;"><div role="button" aria-label="Zoom Out" aria-hidden="true" style="position: absolute; pointer-events: none; top: -2px; left: -2px; width: 4px; height: 4px;"></div></div><div class="am5-tooltip-container"><div role="tooltip" aria-hidden="true" style="position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(1px, 1px, 1px, 1px); pointer-events: none;">US: 725</div><div role="tooltip" aria-hidden="false" style="position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(1px, 1px, 1px, 1px); pointer-events: none;">Created using amCharts 5</div></div></div></div>
                <!--end::Chart container-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Chart widget 15-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-6 mb-5 mb-xl-10">
        <!--begin::Table widget 11-->
        <div class="card card-flush h-xl-100">
            <!--begin::Header-->
            <div class="card-header pt-5">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">Top Queries by Clicks</span>
                    <span class="text-gray-500 pt-2 fw-semibold fs-6">Counted in Millions</span>
                </h3>
                <!--end::Title-->
                <!--begin::Toolbar-->
                <div class="card-toolbar">
                    <a href="#" class="btn btn-sm btn-light">PDF Report</a>
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between flex-column py-3">
                <!--begin::Block-->
                <div class="m-0"></div>
                <!--end::Block-->
                <!--begin::Table container-->
                <div class="table-responsive mb-n2">
                    <!--begin::Table-->
                    <table class="table table-row-dashed gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fs-7 fw-bold border-0 text-gray-500">
                                <th class="min-w-300px">KEYWORD</th>
                                <th class="min-w-100px">CLICKS</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td>
                                    <a href="#" class="text-gray-600 fw-bold text-hover-primary mb-1 fs-6">Buy phone online</a>
                                </td>
                                <td class="d-flex align-items-center border-0">
                                    <span class="fw-bold text-gray-800 fs-6 me-3">263</span>
                                    <div class="progress rounded-start-0">
                                        <div class="progress-bar bg-success m-0" role="progressbar" style="height: 12px;width: 166px" aria-valuenow="166" aria-valuemin="0" aria-valuemax="166px"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#" class="text-gray-600 fw-bold text-hover-primary mb-1 fs-6">Top 10 Earbuds</a>
                                </td>
                                <td class="d-flex align-items-center border-0">
                                    <span class="fw-bold text-gray-800 fs-6 me-3">238</span>
                                    <div class="progress rounded-start-0">
                                        <div class="progress-bar bg-success m-0" role="progressbar" style="height: 12px;width: 158px" aria-valuenow="158" aria-valuemin="0" aria-valuemax="158px"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#" class="text-gray-600 fw-bold text-hover-primary mb-1 fs-6">Cyber Monday</a>
                                </td>
                                <td class="d-flex align-items-center border-0">
                                    <span class="fw-bold text-gray-800 fs-6 me-3">189</span>
                                    <div class="progress rounded-start-0">
                                        <div class="progress-bar bg-success m-0" role="progressbar" style="height: 12px;width: 129px" aria-valuenow="129" aria-valuemin="0" aria-valuemax="129px"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#" class="text-gray-600 fw-bold text-hover-primary mb-1 fs-6">OLED TV in Amsterdam</a>
                                </td>
                                <td class="d-flex align-items-center border-0">
                                    <span class="fw-bold text-gray-800 fs-6 me-3">263</span>
                                    <div class="progress rounded-start-0">
                                        <div class="progress-bar bg-success m-0" role="progressbar" style="height: 12px;width: 112px" aria-valuenow="112" aria-valuemin="0" aria-valuemax="112px"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#" class="text-gray-600 fw-bold text-hover-primary mb-1 fs-6">Macbook M1</a>
                                </td>
                                <td class="d-flex align-items-center border-0">
                                    <span class="fw-bold text-gray-800 fs-6 me-3">263</span>
                                    <div class="progress rounded-start-0">
                                        <div class="progress-bar bg-success m-0" role="progressbar" style="height: 12px;width: 107px" aria-valuenow="107" aria-valuemin="0" aria-valuemax="107px"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#" class="text-gray-600 fw-bold text-hover-primary mb-1 fs-6">Best noise cancelation headsets</a>
                                </td>
                                <td class="d-flex align-items-center border-0">
                                    <span class="fw-bold text-gray-800 fs-6 me-3">263</span>
                                    <div class="progress rounded-start-0">
                                        <div class="progress-bar bg-success m-0" role="progressbar" style="height: 12px;width: 74px" aria-valuenow="74" aria-valuemin="0" aria-valuemax="74px"></div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Table Widget 11-->
    </div>
    <!--end::Col-->
</div>
@endsection
@push('scripts')
 
   
@endpush
