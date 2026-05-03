@extends('layouts.main')
@section('title', 'استعلام إشعارات الوفاة الغير معتمدة')

@section('content')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        td {
            font-family: "Times New Roman", Times, sans-serif;

            padding-top: 1px;
            padding-bottom: 1px;
            border: solid black;
            border-width: thin;
            text-align: center;
        }

        .dataTables_empty {
            color: red !important;
            font-weight: bold;
        }

        .alert-signal {
            font-weight: bold;
            font-size: 16px;
            text-align: center;
            border-radius: 8px;
            padding: 10px;
            background-color: #dc3545;
            /* أحمر */
            color: white;
            animation: flash 1s infinite;
            /* تضوي وتطفي */
        }

        @keyframes flash {

            0%,
            50%,
            100% {
                opacity: 1;
            }

            /* مضوي */
            25%,
            75% {
                opacity: 0;
            }

            /* مطفي */
        }
    </style>


    <form action="#" id="dead_form">
        <!--begin::Card-->
        <div class="card mb-7">
            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Compact form-->
                <div class="d-flex align-items-center">
                    <!--begin::Input group-->
                    <label class="control-label col-md-1">رقم الهوية</label>
                    <div class="position-relative w-md-200px me-md-1">

                        <div class="row mb-4">
                            <div class="col-lg-10">
                                <i
                                    class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle ms-6"><span
                                        class="path1"></span><span class="path2"></span></i>
                                <input type="text" class="form-control form-control ps-10" name="search" id="P_ID"
                                    value="" placeholder="رقم الهوية" maxLength="9"
                                    oninput="this.value=this.value.slice(0,this.maxLength)" onchange="get_dead_data();">

                            </div>
                        </div>
                    </div>

                    <!--end::Input group-->

                </div>

                <!--end::Compact form-->

                <div class="row mb-6">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <label class="control-label col-md-2" style="margin-top: 20px;">ت.الوفاة من</label>
                            <div class="col-lg-4">

                                <input type="text" class="form-control text-center form-control-lg mb-3"
                                    id="P_DATE_FROM" name="P_DATE_FROM">
                            </div>
                            <div class="input-group-prepend">

                                <span class="input-group-text">إلى</span>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control text-center form-control-lg mb-3"
                                    id="P_DATE_TO" name="P_DATE_TO">
                            </div>
                        </div>
                    </div>

                </div>



                <!--end::Compact form-->
                <!--begin:Action-->

                <!--begin::Input group-->

                <div class="float-end">
                    <button type="button" class="btn btn-primary me-5" onclick="get_dead_data();">استعلام</button>

                    <button type="button" class="btn btn-outline-dark me-5" onclick="reset_form();">جديد</button>

                </div>
                <!--end::Input group-->
                <!--begin::Input group-->

            </div>
        </div>
    </form>
    <!--end::Col-->
    <div class="card mb-7">

        <!--begin::Card body-->
        <div class="card-body">

            <!--begin::datatable-->
            <div class="table-responsive">
                {{-- <form action="{{ route('dead.export_excel') }}" method="get">
                    @csrf --}}

                <div class="float-right">
                        <button class="btn btn-success" type="button" onclick="" style="display: none"
                            id="excel_btn"><i class="fa fa-file"></i>تحميل
                            ملف اكسل</button>
                </div>
                {{-- </form> --}}
                <table id="result_tb" class="table table-striped table-responsive" style="width:100%">
                    <thead>
                        <tr class="fw-semibold fs-6 text-muted">

                            <th scope="col" width="5" style="text-align: center">#</th>
                            <th scope="col" width="5" style="text-align: center">الهوية</th>
                            <th scope="col" width="20" style="text-align: center">تاريخ الميلاد</th>
                            <th scope="col" width="20" style="text-align: center">تاريخ الوفاة</th>
                            <th scope="col" width="5" style="text-align: center">الجنس</th>
                            <th scope="col" width="20" style="text-align: center">اسم المتوفى</th>
                            <th scope="col" width="20" style="text-align: center">المستشفى</th>
                            <th scope="col" width="20" style="text-align: center">كود سبب الوفاة</th>
                            <th scope="col" width="20" style="text-align: center">سبب الوفاة</th>
                            <th scope="col" width="30" style="text-align: center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
            <!--end::datatable-->
        </div>
        <!--end::Compact form-->
    </div>

    <!--end::Row-->
    <!--end::Card-->


@endsection


@push('scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

    <script>
        var block_search_dead = document.querySelector("#dead_form");
        var block_search_dead = new KTBlockUI(block_search_dead);

        $("#P_DATE_FROM").flatpickr({
            dateFormat: "d/m/Y",
            maxDate: new Date(),
        });

        $("#P_DATE_TO").flatpickr({
            dateFormat: "d/m/Y",
            maxDate: new Date(),
        });

        $("#P_ENTER_FROM").flatpickr({
            dateFormat: "d/m/Y",
            maxDate: new Date(),
        });

        $("#P_ENTER_TO").flatpickr({
            dateFormat: "d/m/Y",
            maxDate: new Date(),
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            get_dead_data();

        });

        function get_dead_data() {
            const fields = {
                P_ID: '#P_ID',
                P_DATE_FROM: '#P_DATE_FROM',
                P_DATE_TO: '#P_DATE_TO'
            };

            function getValue(selector) {
                return $(selector).val();
            }

            function isEmpty(selector) {
                const value = getValue(selector);
                return value === null || value === undefined || value === '';
            }

            function allEmpty(selectors) {
                return selectors.every(isEmpty);
            }

            const allSelectors = Object.values(fields);

            const nonNameSelectors = [
                fields.P_ID,
                fields.P_DATE_FROM,
                fields.P_DATE_TO
            ];



            if (allEmpty(allSelectors)) {
                Swal.fire({
                    icon: 'info',
                    title: 'تنبيه',
                    text: 'يجب إدخال أحد الحقول'
                });
                return;
            }


            const formData = {
                P_ID: getValue(fields.P_ID),
                P_DATE_FROM: getValue(fields.P_DATE_FROM),
                P_DATE_TO: getValue(fields.P_DATE_TO)
            };

            if ($.fn.DataTable.isDataTable('#result_tb')) {
                $('#result_tb').DataTable().destroy();
            }

            $('#result_tb tbody').empty();
            $.fn.dataTable.ext.errMode = 'none';

            $('#result_tb').off('error.dt').on('error.dt', function(e, settings, techNote, message) {
                console.log('An error has been reported by DataTables:', message);
                block_search_dead.release();
            });

            block_search_dead.block();

            $('#result_tb').DataTable({
                processing: true,
                serverSide: true,
                paging: true,
                ordering: false,
                ajax: {
                    url: "{{ route('dead.getDeadMccdResult') }}",
                    type: "POST",
                    data: formData,
                    dataSrc: function(json) {
                        block_search_dead.release();

                        if (json.data && json.data.length > 0) {
                            $('#excel_btn').show();
                        } else {
                            $('#excel_btn').hide();
                        }

                        return json.data || [];
                    },
                    error: function() {
                        block_search_dead.release();
                        $('#excel_btn').hide();
                    }
                },
                language: {
                    emptyTable: '',
                    zeroRecords: ''
                },
                drawCallback: function() {
                    const api = this.api();
                    const json = api.ajax.json();

                    if (json && (!json.data || json.data.length === 0)) {
                        $('#result_tb tbody td.dataTables_empty').html(
                            '<div class="alert alert-danger alert-signal m-2 text-center">' +
                            '⚠️ ' + (json.results || 'لم يعثر على أية سجلات') +
                            '</div>'
                        );
                    }
                }
            });
        }

        /**************************************************************************************************************************************************************************************************/
        function reset_form() {
            $('#dead_form')[0].reset();
            document.getElementById("excel_btn").style.display = 'none';

            $('#result_tb').DataTable().destroy();
            $('#result_tb tbody').empty();
            //$('#out_records_num').empty();
          //  $('#dead_form .form-select').val(' ').trigger('change');
            block_search_dead.release();
        }

    </script>
@endpush
