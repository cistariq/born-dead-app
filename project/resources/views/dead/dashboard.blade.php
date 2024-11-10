@extends('layouts.main')
@section('title', 'الاحصائيات')
@section('content')
    <div class="row m-12">
        <div class="col-lg-4">
            <!--begin::Callout-->
            <a href="#" class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                <div class="card-body">
                    <div class="d-flex align-items-center p-6">
                        <!--begin::Icon-->
                        <div class="mr-6">
                            <span class="svg-icon svg-icon-4x">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                        <path
                                            d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                        <path
                                            d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                            fill="#FFFFFF" fill-rule="nonzero"></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Content-->
                        <div class="d-flex flex-column">
                            <h3 class="text-white fw-bold fs-2 mb-2 mt-5">{{ $mayrtyrCount }}</h3>
                            <div class="fw-semibold text-white">{{ 'عدد الوفيات الكلي' }}</div>

                        </div>
                        <!--end::Content-->
                    </div>
                </div>
            </a>
            <!--end::Callout-->
        </div>
        <div class="col-lg-4">
            <!--begin::Callout-->
            <a href="#" class="card bg-danger hoverable card-xl-stretch mb-xl-8">
                <div class="card-body">
                    <div class="d-flex align-items-center p-6">
                        <!--begin::Icon-->
                        <div class="mr-6">
                            <span class="svg-icon svg-icon-4x">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                                <svg fill="#FFFFFF" width="800px" height="800px" viewBox="-10.5 0 32 32" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <title>female</title>
                                    <path
                                        d="M7.656 7.344c0-1.313-1.063-2.375-2.375-2.375-1.281 0-2.344 1.063-2.344 2.375s1.063 2.375 2.344 2.375c1.313 0 2.375-1.063 2.375-2.375zM8.969 11.219l1.563 4.906c0.156 0.406-0.094 0.844-0.5 0.969-0.406 0.156-0.844-0.094-1-0.5l-0.844-2.594c-0.125-0.406-0.5-0.75-0.844-0.75-0.313 0-0.469 0.344-0.344 0.75l1.813 5.594c0.125 0.406-0.125 0.75-0.563 0.75h-0.781v6.344c0 0.438-0.375 0.781-0.781 0.781-0.438 0-0.813-0.344-0.813-0.781v-6.344h-1.188v6.344c0 0.438-0.344 0.781-0.781 0.781s-0.781-0.344-0.781-0.781v-6.344h-0.781c-0.438 0-0.688-0.344-0.563-0.75l1.813-5.594c0.125-0.406-0.031-0.75-0.375-0.75-0.313 0-0.688 0.344-0.844 0.75l-0.844 2.594c-0.125 0.406-0.563 0.656-0.969 0.5-0.438-0.125-0.656-0.563-0.531-0.969l1.594-4.906c0.125-0.406 0.594-0.75 1.031-0.75h5.281c0.438 0 0.875 0.344 1.031 0.75z">
                                    </path>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Content-->
                        <div class="d-flex flex-column">
                            <h3 class="text-white fw-bold fs-2 mb-2 mt-5">{{ $mayrtyrCount_F }}</h3>
                            <div class="fw-semibold text-white">{{ 'عدد الشهداء الإناث' }}</div>

                        </div>
                        <!--end::Content-->
                    </div>
                </div>
            </a>
            <!--end::Callout-->
        </div>
        <div class="col-lg-4">
            <!--begin::Callout-->
            <a href="#" class="card bg-success hoverable card-xl-stretch mb-5 mb-xl-8">
                <div class="card-body">
                    <div class="d-flex align-items-center p-6">
                        <!--begin::Icon-->
                        <div class="mr-6">
                            <span class="svg-icon svg-icon-4x">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#FFFFFF" width="800px" height="800px"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M9.5,7H15a1,1,0,0,1,.949.684l2,6a1,1,0,0,1-1.9.632L14.5,9.662V22a1,1,0,0,1-2,0V16h-1v6a1,1,0,0,1-2,0V9.662L7.949,14.316a1,1,0,0,1-1.9-.632l2-6A1,1,0,0,1,9,7Zm0-3.5A2.5,2.5,0,1,0,12,1,2.5,2.5,0,0,0,9.5,3.5Z" />
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Content-->
                        <div class="d-flex flex-column">
                            <h3 class="text-white fw-bold fs-2 mb-2 mt-5">{{ $mayrtyrCount_M }}</h3>
                            <div class="fw-semibold text-white">{{ 'عدد الشهداء الذكور' }}</div>

                        </div>
                        <!--end::Content-->
                    </div>
                </div>
            </a>
            <!--end::Callout-->
        </div>

    </div>
    <div class="row m-12">

        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">أعداد الشهداء حسب مستشفيات قطاع غزة</h3>
                    </div>
                </div>
                <div class="card-body d-flex align-items-end px-0 pt-3 pb-5">
                    <!--begin::Chart-->
                    <div id="charts_18" class="h-325px w-100 min-h-auto ps-4 pe-6" style="min-height: 340px;"></div>
                    <!--end::Chart-->
                </div>
                {{-- <div class="card-body">
            <!--begin::Chart-->
            <div id="chart_2"></div>
            <!--end::Chart-->
        </div> --}}
            </div>
            <!--end::Card-->
        </div>
    </div>

    <div class="row m-12">

        <div class="col-lg-6">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">أعداد الشهداء حسب المحافظة</h3>
                    </div>
                </div>
                <div class="card-body d-flex align-items-end px-0 pt-3 pb-5">
                    <!--begin::Chart-->
                    <div id="charts_5" class="h-350px w-100 min-h-auto ps-4 pe-6" style="min-height: 340px;"></div>
                    <!--end::Chart-->
                </div>
                {{-- <div class="card-body">
            <!--begin::Chart-->
            <div id="chart_2"></div>
            <!--end::Chart-->
        </div> --}}
            </div>
            <!--end::Card-->
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            KTChartsWidget18.init();
            KTChartsWidget5.init();

            console.log('true');
            //  initChart();
        });

        // chart 18
        var KTChartsWidget18 = function() {
            var chart = {
                self: null,
                rendered: false
            };

            // Private methods
            var initChart = function(chart) {
                var element = document.getElementById("charts_18");

                if (!element) {
                    return;
                }

                var height = parseInt(KTUtil.css(element, 'height'));
                var labelColor = KTUtil.getCssVariableValue('--kt-gray-900');
                var borderColor = KTUtil.getCssVariableValue('--kt-border-dashed-color');

                var options = {
                    series: [{
                        name: 'Spent time',
                        data: [
                            @foreach ($chart_data as $one)
                                {{ $one['total'] }},
                            @endforeach
                        ]
                    }],
                    chart: {
                        fontFamily: 'inherit',
                        type: 'bar',
                        height: height,
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: ['30%'],
                            borderRadius: 5,
                            dataLabels: {
                                position: "top" // top, center, bottom
                            },
                            startingShape: 'flat'
                        },
                    },
                    legend: {
                        show: false
                    },
                    dataLabels: {
                        enabled: true,
                        offsetY: -28,
                        style: {
                            fontSize: '13px',
                            colors: [labelColor]
                        },
                        formatter: function(val) {
                            return val;
                        }
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: [
                            @foreach ($chart_data as $one)
                                "{{ $one['name'] }}",
                            @endforeach
                        ],
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            style: {
                                colors: KTUtil.getCssVariableValue('--kt-gray-500'),
                                fontSize: '10px'
                            }
                        },
                        crosshairs: {
                            fill: {
                                gradient: {
                                    opacityFrom: 0,
                                    opacityTo: 0
                                }
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: KTUtil.getCssVariableValue('--kt-gray-500'),
                                fontSize: '13px'
                            },
                            formatter: function(val) {
                                return val;
                            }
                        }
                    },
                    fill: {
                        opacity: 2
                    },
                    states: {
                        normal: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        hover: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        active: {
                            allowMultipleDataPointsSelection: false,
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        }
                    },
                    tooltip: {
                        style: {
                            fontSize: '12px'
                        },
                        y: {
                            formatter: function(val) {
                                return +val
                            }
                        },
                        enabled: false
                    },
                    colors: [KTUtil.getCssVariableValue('--kt-primary'), KTUtil.getCssVariableValue(
                        '--kt-primary-light')],
                    grid: {
                        borderColor: borderColor,
                        strokeDashArray: 4,
                        yaxis: {
                            lines: {
                                show: true
                            }
                        }
                    }
                };

                chart.self = new ApexCharts(element, options);

                // Set timeout to properly get the parent elements width
                setTimeout(function() {
                    chart.self.render();
                    chart.rendered = true;
                }, 200);
            }

            // Public methods
            return {
                init: function() {
                    initChart(chart);

                    // Update chart on theme mode change
                    KTThemeMode.on("kt.thememode.change", function() {
                        if (chart.rendered) {
                            chart.self.destroy();
                        }

                        initChart(chart);
                    });
                }
            }
        }();

        // chart 5

        var KTChartsWidget5 = function() {
            var chart = {
                self: null,
                rendered: false
            };

            // Private methods
            var initChart = function(chart) {
                var element = document.getElementById("charts_5");

                if (!element) {
                    return;
                }

                var borderColor = KTUtil.getCssVariableValue('--kt-border-dashed-color');
                var labelColor = KTUtil.getCssVariableValue('--kt-gray-900');

                var options = {
                    series: [{
                        data: [
                            @foreach ($region_data as $one2)
                                {{ $one2['total_city'] }},
                            @endforeach
                        ],
                        show: false
                    }],
                    chart: {
                        type: 'bar',
                        height: 330,
                        toolbar: {
                            show: true
                        }
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 2,
                            horizontal: true,
                            distributed: true,
                            columnWidth: ['30%'],
                            barHeight: 120,
                            dataLabels: {
                                position: "top" // top, center, bottom
                            },
                            startingShape: 'flat'
                        }
                    },

                    dataLabels: {
                        offsetX: 30,
style:{
    colors: [labelColor]
},
                        enabled: true

                    },
                    legend: {
                        show: true
                    },
                    colors: ['#3E97FF', '#F1416C', '#50CD89', '#FFC700', '#7239EA', '#50CDCD', '#3F4254',
                        '#000000', '#E3D0F3', '#A29999', '#27503D', '#F06E01', '#01F071', '#C70039',
                        '#DAF7A6'
                    ],
                    xaxis: {
                        categories: [
                            @foreach ($region_data as $one2)
                                "{{ $one2['name_city'] }}",
                            @endforeach
                        ],
                        labels: {
                            formatter: function(val) {
                                return val
                            },
                            style: {
                                colors: KTUtil.getCssVariableValue('--kt-gray-400'),
                                fontSize: '12px',
                                fontWeight: '330',
                                align: 'center'
                            }

                        },
                        axisBorder: {
                            show: false
                        }
                    },
                    tooltip: {
                        style: {
                            fontSize: '12px'
                        },
                        y: {
                            formatter: function(val) {
                                return +val
                            }
                        },
                        enabled: false
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: KTUtil.getCssVariableValue('--kt-gray-800'),
                                fontSize: '12px',
                                fontWeight: '330'
                            },
                            offsetY: 4,
                            align: 'center'
                        }
                    },
                    grid: {
                        borderColor: borderColor,
                        xaxis: {
                            lines: {
                                show: true
                            }
                        },
                        yaxis: {
                            lines: {
                                show: false
                            }
                        },
                        strokeDashArray: 4
                    }
                };

                chart.self = new ApexCharts(element, options);

                // Set timeout to properly get the parent elements width
                setTimeout(function() {
                    chart.self.render();
                    chart.rendered = true;
                }, 500);
            }

            // Public methods
            return {
                init: function() {
                    initChart(chart);

                    // Update chart on theme mode change
                    KTThemeMode.on("kt.thememode.change", function() {
                        if (chart.rendered) {
                            chart.self.destroy();
                        }

                        initChart(chart);
                    });
                }
            }
        }();

        // chart 22
    </script>
@endpush
