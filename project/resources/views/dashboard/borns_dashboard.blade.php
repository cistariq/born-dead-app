@extends('layouts.main')
@section('title', 'احصائيات المواليد')
@section('content')
    <div class="container-fluid">

        <!-- =================== FILTER =================== -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-end justify-content-end">

                    <div class="col-lg-2 col-md-4">
                        <label class="form-label">ت.الادخال من</label>
                        <input type="text" class="form-control text-center" id="P_ENTER_FROM"
                            value="{{ now()->format('d/m/Y') }}">
                    </div>

                    <div class="col-lg-2 col-md-4">
                        <label class="form-label">إلى</label>
                        <input type="text" class="form-control text-center" id="P_ENTER_TO"
                            value="{{ now()->format('d/m/Y') }}">
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <label class="form-label">مكان الولادة</label>
                        <select class="form-select" id="birth_place_no" data-control="select2" data-allow-clear="true" data-placeholder="مكان الولادة">
                            <option value=""></option>
                            <option value="1">خاص</option>
                            <option value="2">مستشفى حكومي</option>
                            <option value="3">مستشفى غير حكومي</option>


                        </select>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <label class="form-label">المستشفى</label>
                        <select class="form-select" data-control="select2" id="P_HOS_NO" data-placeholder="المستشفى"
                            data-allow-clear="true">
                            <option value=""></option>
                            @foreach ($hospitals as $hospital)
                                <option value="{{ $hospital->h_code }}">
                                    {{ $hospital->h_name_ar }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-4">
                        <button class="btn btn-primary w-100" onclick="getbirthStatistics()">استعلام</button>

                    </div>

                </div>
            </div>
        </div>

        <!-- =================== CARDS =================== -->
        <div class="row g-3 mb-4 text-center">
            <div class="col">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h2 id="totalBorns" style="font-size:25px;">0</h2>

                        <span style="font-size:18px;">عدد المواليد الكلي</span>

                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h2 id="maleCount" style="font-size:25px;">0</h2>

                        <span style="font-size:18px;">عدد الذكور</span>

                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h2 id="femaleCount" style="font-size:25px;">0</h2>

                        <span style="font-size:18px;">عدد الإناث</span>

                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h2 id="aliveCount" style="font-size:25px;">0</h2>

                        <span style="font-size:18px;">مواليد أحياء</span>

                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h2 id="deadCount" class="text-white" style="font-size:25px;">0</h2>
                        <span style="font-size:18px;">مواليد أموات</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- =================== HOSPITAL CHART =================== -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">أعداد المواليد حسب مستشفيات قطاع غزة</h3>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-3 pb-5">
                        <div id="charts_18" class="h-325px w-100 ps-4 pe-6" style="min-height: 340px;"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        $("#P_ENTER_FROM").flatpickr({
            dateFormat: "d/m/Y",
            maxDate: new Date(),
        });
        $("#P_ENTER_TO").flatpickr({
            dateFormat: "d/m/Y",
            maxDate: new Date(),
        });

        $(document).ready(function() {

            getbirthStatistics();
            console.log('true get data');
            //initChart();
        });
        // chart 18 
        var KTChartsWidget18 = {
            chart: {
                self: null,
                rendered: false
            },

            init: function(data) {

                var element = document.getElementById("charts_18");
                if (!element) {
                    return;
                }

                var height = parseInt(KTUtil.css(element, 'height'));

                // توليد ألوان حسب عدد البيانات
                function generateColors(count) {
                    var colors = [];
                    for (var i = 0; i < count; i++) {
                        var hue = Math.floor((360 / count) * i);
                        colors.push("hsl(" + hue + ", 70%, 50%)");
                    }
                    return colors;
                }

                var colors = generateColors(data.length);

                var options = {

                    series: [{
                        name: 'Total',
                        data: data.map(item => item.total)
                    }],

                    chart: {
                        fontFamily: 'inherit',
                        type: 'bar',
                        height: height,
                        toolbar: {
                            show: false
                        }
                    },

                    colors: colors,

                    plotOptions: {
                        bar: {
                            distributed: true,
                            columnWidth: '45%'
                        }
                    },

                    dataLabels: {
                        enabled: true
                    },

                    tooltip: {
                        enabled: false
                    },

                    xaxis: {
                        categories: data.map(item => item.name),
                        labels: {
                            show: false
                        }
                    },

                    yaxis: {
                        labels: {
                            style: {
                                colors: KTUtil.getCssVariableValue('--kt-gray-500'),
                                fontSize: '11px'
                            }
                        }
                    },

                    grid: {
                        borderColor: KTUtil.getCssVariableValue('--kt-border-dashed-color'),
                        strokeDashArray: 4
                    }

                };

                this.chart.self = new ApexCharts(element, options);

                setTimeout(() => {
                    this.chart.self.render();
                    this.chart.rendered = true;
                }, 200);
            }
        };
        // Get statistics function

        function getbirthStatistics() {
            // Get input values 
          //  alert(333);
            var P_ENTER_FROM = $('#P_ENTER_FROM').val();
            var P_ENTER_TO = $('#P_ENTER_TO').val();
            var hos_no = $('#P_HOS_NO').val();
            var birth_place_no = $('#birth_place_no').val();
            // Make an AJAX request to fetch the statistics 
            $.ajax({
                url: "{{ route('dashboard.getbirthStatistics') }}",
                method: 'GET',
                data: {
                    P_ENTER_FROM: P_ENTER_FROM,
                    P_ENTER_TO: P_ENTER_TO,
                    hos_no: hos_no,
                    birth_place_no: birth_place_no,
                },
                success: function(response) {
                    console.log(response); // Update the dashboard with the new statistics 
                    $('#totalBorns').text(response.TOTAL_COUNT);

                    // ================== الذكور والاناث ==================
                    let male = 0;
                    let female = 0;

                    response.gender.forEach(function(g) {
                        if (g.SEX_NAME_AR == 'ذكر') {
                            male = g.GENDER_COUNT;
                        } else {
                            female = g.GENDER_COUNT;
                        }
                    });

                    $('#maleCount').text(male);
                    $('#femaleCount').text(female);


                    // ================== الاحياء والاموات ==================
                    let alive = 0;
                    let dead = 0;


                    response.outcome.forEach(function(o) {
                        if (o.OUTECOMED.trim() == 'حى') {
                            alive = o["COUNT(0)"];
                        } else if (o.OUTECOMED.trim() == 'متوفي') {
                            dead = o["COUNT(0)"];
                        }
                    });

                    $('#aliveCount').text(alive);
                    $('#deadCount').text(dead);

                    if (KTChartsWidget18.chart && KTChartsWidget18.chart.rendered) {
                        KTChartsWidget18.chart.self.destroy();

                    }
                    KTChartsWidget18.init(response.chart_data);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching statistics:', error);
                }

            });
        }
    </script>
@endpush
