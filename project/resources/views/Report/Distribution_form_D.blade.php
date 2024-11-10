@extends('layouts.main')
@section('title', 'تقارير الوفيات')

@section('content')
    <style>
        @media screen {
            #printSection {
                display: none;
            }
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #printSection,
            #printSection * {
                visibility: visible;
            }

            #printSection {
                position: absolute;
                left: 0;
                right: 0;
                top: 0;
            }
        }

        td {

            padding-top: 0%;
            padding-bottom: 0%;
        }

        th {

            padding-top: 1px;
            padding-bottom: 1px;
            text-align: center;

        }
        .st_h3 {
        text-align: right;
    }
    </style>
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">استعلام جديد</h3>
            </div>
            <!--end::Card title-->
        </div>
        <form action="" id="Query_birth" method="POST">
            <!--begin::Card-->
            <div class="card mb-7">
                <!--begin::Card body-->
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <!--begin::Input group-->
                        <label class="control-label col-md-1">الجنس</label>

                        <div class="position-relative w-md-200px me-md-1">
                            <div class="row mb-4">
                                <div class="col-lg-10">
                                    <select class="form-select" data-control="select2" id="Sex"
                                        data-placeholder="اختر الجنس">
                                        <option></option>
                                        <option value="0">غير معروف</option>
                                        <option value="1">ذكر</option>
                                        <option value="2">انثى</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <label class="control-label col-md-1">رقم الهوية</label>
                        <div class="position-relative w-md-200px me-md-1">

                            <div class="row mb-4">
                                <div class="col-lg-10">
                                    <i
                                        class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle ms-6"><span
                                            class="path1"></span><span class="path2"></span></i>
                                    <input type="text" class="form-control form-control ps-10" name="Dead_ID"
                                        id="Dead_ID" value="" placeholder="رقم الهوية">

                                </div>
                            </div>
                        </div>
                        <label class="control-label col-md-1">العمر بالأيام من</label>
                        <div class="position-relative w-md-200px me-md-1">

                            <div class="row mb-4">
                                <div class="col-lg-10">

                                    <input type="text" class="form-control form-control ps-10" name="Age_From"
                                        id="Age_From" value="" placeholder="العمر من">

                                </div>
                            </div>
                        </div>
                        <label class="control-label col-md-1">العمر بالأيام إلى</label>
                        <div class="position-relative w-md-200px me-md-1">

                            <div class="row mb-4">
                                <div class="col-lg-10">

                                    <input type="text" class="form-control form-control ps-10" name="Age_To"
                                        id="Age_To" value="" placeholder="العمر إلى">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="control-label col-md-1">التشخيص من</label>
                        <div class="position-relative w-md-200px me-md-1">

                            <div class="row mb-4">
                                <div class="col-lg-10">

                                    <input type="text" class="form-control form-control ps-10" name="Diag_From"
                                        id="Diag_From" value="" placeholder="التشخيص من">

                                </div>
                            </div>
                        </div>
                        <label class="control-label col-md-1">التشخيص إلى</label>
                        <div class="position-relative w-md-200px me-md-1">

                            <div class="row mb-4">
                                <div class="col-lg-10">

                                    <input type="text" class="form-control form-control ps-10" name="Diag_To"
                                        id="Diag_To" value="" placeholder="التشخيص إلى">

                                </div>
                            </div>
                        </div>
                        <label class="control-label col-md-1">السنة من</label>
                        <div class="position-relative w-md-200px me-md-1">

                            <div class="row mb-4">
                                <div class="col-lg-10">

                                    <input type="text" class="form-control form-control ps-10" name="Year_From"
                                        id="Year_From" value="" placeholder="السنة من">

                                </div>
                            </div>
                        </div>
                        <label class="control-label col-md-1">السنة إلى</label>
                        <div class="position-relative w-md-200px me-md-1">

                            <div class="row mb-4">
                                <div class="col-lg-10">

                                    <input type="text" class="form-control form-control ps-10" name="Year_To"
                                        id="Year_To" value="" placeholder="السنة إلى">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <label class="control-label col-md-2">ت.الوفاة من</label>
                                <div class="col-lg-4">

                                    <input type="text" class="form-control text-center form-control-lg mb-3"
                                        id="Death_date_frm" name="Death_date_frm">
                                </div>
                                <div class="input-group-prepend">

                                    <span class="input-group-text">إلى</span>
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control text-center form-control-lg mb-3"
                                        id="Death_date_to" name="Death_date_to">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="card mb-7">
        <!--begin::Card body-->
        <div class="card-body">
            <div class="card-body">
                <!--begin::datatable-->
                <div class="table-responsive">
                    <div class="float-right">
                        <h3 class="fw-bolder m-0 st_h3">التقارير</h3>
                        <br>
                    </div>
                    <table id="result_tbss" class="table table-striped dt-responsive table-row-bordered gy-5 gs-7"
                        style="width:100%">
                        <tr>
                            <td>
                                <a href='#' onclick="GET_Distribution_Region_Ages();">1.توزيع
                                    الوفيات تبعا للفئة العمرية والمحافظة</a>
                            </td>

                            <td>
                                <a href='#' onclick="GET_Distribution_Death_Place();">2.توزيع
                                    الوفيات تبعا لمكان الوفاة</a>
                            </td>

                        </tr>
                        <tr>

                            <td>
                                <a href="#" onclick="GET_Distribution_Region_Kids();"> - النموذج
                                    الأول - أطفال</a>
                            </td>
                            <td>

                                <a href="#" onclick="GET_Distribution_Death_Place_Kids();"> -النموذج
                                    الأول - أطفال</a>
                            </td>
                        </tr>



                        <tr>
                            <td>
                                <a href="#" onclick="GET_Distribution_Region_Ages1();"> -النموذج
                                    الثاني</a>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" onclick="GET_Distribution_Region_Ages2();"> -النموذج
                                    الثالث</a>
                            </td>
                            <td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" onclick="GET_Distribution_Region_Ages3();"> - النموذج
                                    الرابع</a>
                                <br>
                            </td>
                            <td>
                                <a href="#" onclick="GET_Distribution_Death_Hosp();">4.توزيع
                                    الوفيات تبعا لمستشفى الوفاة</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" onclick="GET_Distribution_sex_D();">3.توزيع
                                    الوفيات تبعا للجنس </a>
                            </td>
                            <td>

                                <a href="#" onclick="GET_Distribution_Death_Hos_Kids();"> -النموذج
                                    الأول - أطفال</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" onclick="GET_Daily_Report_D();">5.تقرير
                                    يومي خاص بالوفيات حسب تاريخ الوفاة</a>
                            </td>
                            <td>

                                <a href="#" onclick="GET_Daily_Dead_Rep_2();">
                                    6.تقرير يومي خاص بالوفيات حسب تاريخ الادخال</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" onclick="GET_Deads_non_Diagnosable();">7.تقرير
                                    للوفيات بتشخيص غير مدخل</a>
                            </td>
                            <td>
                                <a href="#" onclick="GET_Distribution_Diagnosis();">8.تقارير
                                    المجلة</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" onclick="GET_Unknown_Region_Deaths();">9.تقرير
                                    بأسماء الوفيات بمكان سكن غير معروف</a>

                            </td>
                            <td>
                                <a href="#" onclick="GET_Total_In_Diagnosis();">10.تقرير
                                    بأعداد الوفيات الكلية حسب التشخيص</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" onclick="GET_Distribution_MS_D();">11.توزيع
                                    الوفيات تبعا للحالة الاجتماعية </a>
                            </td>
                            <td>
                                <a href="#" onclick="GET_Distribution_ICD_Ages();">12.توزيع
                                    الوفيات حسب الفئات العمرية والمرض</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" onclick="GET_Scanned_files_rep();">13.سجلات
                                    الوفاة ممسوحة ضوئيا</a>
                            </td>
                            <td>
                                <a href="#" onclick="GET_Distribution_ICD_Ages_sample2();"><strong> - النموذج
                                        الثاني</strong></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" onclick="GET_NotScanned_files_rep();">14.سجلات
                                    الوفاة الغير ممسوحة ضوئيا</a>
                            </td>
                            <td>
                                <a href="#" onclick="GET_Death_updated_rep();">15.سجلات
                                    الوفاة المعدل عليها حسب تاريخ التعديل</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-xl" id="MyModal" aria-hidden="true" tabindex="-1" style="width: 100%;height:100%">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
                <!--end::Close-->
                <div class="modal-body" id="printThis">

                </div>
                <div class="modal-footer">
                    <button id="btnPrint" type="button" class="btn btn-outline-primary">Print</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $("#Death_date_frm").flatpickr({
            enableTime: true,
            dateFormat: "d/m/Y",
            maxDate: new Date(),
        });

        $("#Death_date_to").flatpickr({
            enableTime: true,
            dateFormat: "d/m/Y",
            maxDate: new Date(),

        });

        function GET_Distribution_Death_Place() {

            var query = {
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),

            }
            var base_url = "{{ URL::to('Report/Distribution_Death_Place') }}?" + $.param(query);
            // window.location = base_url;

            $('#MyModal .modal-body').load(base_url, function() {
                /* load finished, show dialog */
                $('#MyModal').modal('show')
            });

        }

        //---------------------------------------------------------------------------------
        function GET_Distribution_Region_Ages() {
            var query = {
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),

            }
            var base_url = "{{ URL::to('Report/Distribution_Region_Ages') }}?" + $.param(query);
            $('#MyModal .modal-body').load(base_url, function() {
                /* load finished, show dialog */
                $('#MyModal').modal('show')
            });
        }

        //---------------------------------------------------------------------------------
        function GET_Distribution_Death_Place_Kids() {
            var query = {
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),

            }
            var base_url = "{{ URL::to('Report/GET_Distribution_Death_Place_Kids') }}?" + $.param(query);
            $('#MyModal .modal-body').load(base_url, function() {
                /* load finished, show dialog */
                $('#MyModal').modal('show')
            });
        }
        //---------------------------------------------------------------------------------
        function GET_Distribution_Region_Kids() {
            var query = {
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),

            }
            var base_url = "{{ URL::to('Report/GET_Distribution_Region_Kids') }}?" + $.param(query);
            $('#MyModal .modal-body').load(base_url, function() {
                /* load finished, show dialog */
                $('#MyModal').modal('show')
            });
        }
        //---------------------------------------------------------------------------------
        function GET_Distribution_Region_Ages1() {
            var query = {
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),

            }
            var base_url = "{{ URL::to('Report/GET_Distribution_Region_Ages1') }}?" + $.param(query);
            $('#MyModal .modal-body').load(base_url, function() {
                /* load finished, show dialog */
                $('#MyModal').modal('show')
            });
        }
        //---------------------------------------------------------------------------------
        function GET_Distribution_Region_Ages2() {
            var query = {
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),

            }
            var base_url = "{{ URL::to('Report/GET_Distribution_Region_Ages2') }}?" + $.param(query);
            $('#MyModal .modal-body').load(base_url, function() {
                /* load finished, show dialog */
                $('#MyModal').modal('show')
            });
        }
        //---------------------------------------------------------------------------------
        function GET_Distribution_Death_Hosp() {
            var query = {
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),

            }
            var base_url = "{{ URL::to('Report/GET_Distribution_Death_Hosp') }}?" + $.param(query);
            $('#MyModal .modal-body').load(base_url, function() {
                /* load finished, show dialog */
                $('#MyModal').modal('show')
            });
        }
        //---------------------------------------------------------------------------------
        function GET_Distribution_Region_Ages3() {
            var query = {
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),

            }
            var base_url = "{{ URL::to('Report/GET_Distribution_Region_Ages3') }}?" + $.param(query);
            $('#MyModal .modal-body').load(base_url, function() {
                /* load finished, show dialog */
                $('#MyModal').modal('show')
            });
        }
        //---------------------------------------------------------------------------------
        function GET_Distribution_Death_Hos_Kids() {
            var query = {
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),

            }
            var base_url = "{{ URL::to('Report/GET_Distribution_Death_Hos_Kids') }}?" + $.param(query);
            $('#MyModal .modal-body').load(base_url, function() {
                /* load finished, show dialog */
                $('#MyModal').modal('show')
            });
        }
        //---------------------------------------------------------------------------------
        function GET_Distribution_sex_D() {
            var query = {
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),

            }
            var base_url = "{{ URL::to('Report/GET_Distribution_sex_D') }}?" + $.param(query);
            $('#MyModal .modal-body').load(base_url, function() {
                /* load finished, show dialog */
                $('#MyModal').modal('show')
            });
        }
        //---------------------------------------------------------------------------------
        function GET_Daily_Dead_Rep_2() {
            var query = {
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),

            }
            var base_url = "{{ URL::to('Report/GET_Daily_Dead_Rep_2') }}?" + $.param(query);
            window.open(base_url, true);

        }
        //---------------------------------------------------------------------------------
        function GET_Daily_Report_D() {
            var query = {
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),

            }
            var base_url = "{{ URL::to('Report/GET_Daily_Report_D') }}?" + $.param(query);
            window.open(base_url, true);

        }
        //---------------------------------------------------------------------------------
        function GET_Distribution_Diagnosis() {
            var query = {
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),

            }
            var base_url = "{{ URL::to('Report/GET_Distribution_Diagnosis') }}?" + $.param(query);
            $('#MyModal .modal-body').load(base_url, function() {
                /* load finished, show dialog */
                $('#MyModal').modal('show')
            });
        }
        //---------------------------------------------------------------------------------
        function GET_Deads_non_Diagnosable() {
            var query = {
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),

            }
            var base_url = "{{ URL::to('Report/GET_Deads_non_Diagnosable') }}?" + $.param(query);
            $('#MyModal .modal-body').load(base_url, function() {
                /* load finished, show dialog */
                $('#MyModal').modal('show')
            });
        }
        //---------------------------------------------------------------------------------
        function GET_Total_In_Diagnosis() {
            var query = {
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),

            }
            var base_url = "{{ URL::to('Report/GET_Total_In_Diagnosis') }}?" + $.param(query);
            $('#MyModal .modal-body').load(base_url, function() {
                /* load finished, show dialog */
                $('#MyModal').modal('show')
            });
        }
        //---------------------------------------------------------------------------------
        function GET_Unknown_Region_Deaths() {
            var query = {
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),

            }
            var base_url = "{{ URL::to('Report/GET_Unknown_Region_Deaths') }}?" + $.param(query);
            $('#MyModal .modal-body').load(base_url, function() {
                /* load finished, show dialog */
                $('#MyModal').modal('show')
            });
        }
        //---------------------------------------------------------------------------------
        function GET_Distribution_ICD_Ages() {
            var query = {
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),

            }
            var base_url = "{{ URL::to('Report/GET_Distribution_ICD_Ages') }}?" + $.param(query);
            $('#MyModal .modal-body').load(base_url, function() {
                /* load finished, show dialog */
                $('#MyModal').modal('show')
            });
        }
        //---------------------------------------------------------------------------------
        function GET_Distribution_MS_D() {
            var query = {
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),

            }
            var base_url = "{{ URL::to('Report/GET_Distribution_MS_D') }}?" + $.param(query);
            $('#MyModal .modal-body').load(base_url, function() {
                /* load finished, show dialog */
                $('#MyModal').modal('show')
            });
        }


        //---------------------------------------------------------------------------------
        function GET_Distribution_ICD_Ages_sample2() {
            if (($('#Sex').val() == null || $('#Sex').val() == undefined || $('#Sex').val() == '') && ($(
                    '#Dead_ID').val() == null || $('#Dead_ID').val() == undefined || $('#Dead_ID').val() == '') &&
                ($('#Age_From').val() == null || $('#Age_From').val() == undefined || $(
                    '#Age_From').val() == '') &&
                ($('#Age_To').val() == null || $('#Age_To').val() == undefined || $(
                    '#Age_To').val() == '') && ($('#Diag_From').val() == null || $('#Diag_From').val() ==
                    undefined || $('#Diag_From').val() == '') &&
                ($('#Diag_To').val() == null || $('#Diag_To').val() == undefined || $(
                    '#Diag_To').val() == '') &&
                ($('#Year_From').val() == null || $('#Year_From').val() == undefined || $('#Year_From').val() ==
                    '') && ($('#Year_To').val() == null || $('#Year_To').val() == undefined || $('#Year_To').val() ==
                    '') &&
                ($('#Death_date_frm').val() == null || $('#Death_date_frm').val() == undefined || $('#Death_date_frm')
                    .val() == '') && ($(
                        '#Death_date_to').val() == null || $('#Death_date_to').val() == undefined || $('#Death_date_to')
                    .val() ==
                    '')
            ) {

                Swal.fire({

                    icon: 'info',
                    title: 'تنبيه',
                    text: 'يجب إدخال أحد الحقول',

                });
            } else {
                var query = {
                    Sex: $('#Sex').val(),
                    Dead_ID: $('#Dead_ID').val(),
                    Age_From: $('#Age_From').val(),
                    Age_To: $('#Age_To').val(),
                    Diag_From: $('#Diag_From').val(),
                    Diag_To: $('#Diag_To').val(),
                    Year_From: $('#Year_From').val(),
                    Year_To: $('#Year_To').val(),
                    Death_date_frm: $('#Death_date_frm').val(),
                    Death_date_to: $('#Death_date_to').val(),

                }
                var base_url = "{{ URL::to('Report/GET_Distribution_ICD_Ages_sample2') }}?" + $.param(query);
                $('#MyModal .modal-body').load(base_url, function() {
                    /* load finished, show dialog */
                    $('#MyModal').modal('show')
                });
            }
        }


        //---------------------------------------------------------------------------------
        function GET_Scanned_files_rep() {
            var query = {
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),

            }
            var base_url = "{{ URL::to('Report/GET_Scanned_files_rep') }}?" + $.param(query);
            window.open(base_url, true);

        }


        //---------------------------------------------------------------------------------
        function GET_Death_updated_rep() {
            var query = {
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),

            }
            var base_url = "{{ URL::to('Report/GET_Death_updated_rep') }}?" + $.param(query);
            window.open(base_url, true);

        }


        //---------------------------------------------------------------------------------
        function GET_NotScanned_files_rep() {
            var query = {
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),

            }
            var base_url = "{{ URL::to('Report/GET_NotScanned_files_rep') }}?" + $.param(query);
            window.open(base_url, true);

        }
        //---------------------------------------------------------------------------------

        document.getElementById("btnPrint").onclick = function() {
            printElement(document.getElementById("printThis"));
        };

        function printElement(elem) {
            var domClone = elem.cloneNode(true);
            var $printSection = document.createElement("div");
            $printSection.id = "printSection";
            document.body.appendChild($printSection);
            $printSection.innerHTML = "";
            $printSection.appendChild(domClone);
            window.print();
        }
    </script>
@endpush
