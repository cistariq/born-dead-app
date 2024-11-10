@extends('layouts.main')
@section('title', 'تقارير خاصة بالمواليد')
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

            padding-top: 1px;
            padding-bottom: 1px;
            border: solid black;
            border-width: thin;
        }

        th {

            padding-top: 1px;
            padding-bottom: 1px;
            text-align: center;

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
                        <label class="control-label col-md-1">التاريخ من</label>
                        <div class="position-relative w-md-300px me-md-1">

                            <div class="row mb-4">
                                <div class="col-lg-10">

                                    <input type="text" class="form-control form-control ps-10" name="Birth_date_frm"
                                        id="Birth_date_frm" value="{{ date('d/m/Y') }}">

                                </div>
                            </div>
                        </div>

                        <label class="control-label col-md-1">التاريخ إلى</label>
                        <div class="position-relative w-md-300px me-md-1">

                            <div class="row mb-4">
                                <div class="col-lg-10">

                                    <input type="text" class="form-control form-control ps-10" name="Birth_date_to"
                                        id="Birth_date_to" value="{{ date('d/m/Y') }}">

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
                        <h3 class="fw-bolder m-0">التقارير</h3>
                        <br>
                    </div>
                    <table id="result_tb" class="table table-striped dt-responsive table-row-bordered gy-5 gs-7"
                        style="width:100%">
                        <tr>
                            <td width="258"><a href='#' onclick="Daily_Born();"><strong> تقرير يومي للمواليد حسب
                                        تاريخ الادخال </strong></a></td>

                        </tr>
                        <tr>
                            <td>
                                <a href="#" onclick="Daily_Report_Birth_Place();"> <strong> تقرير يومي للمواليد حسب
                                        مكان الولادة </strong> </a>
                            </td>

                        </tr>
                        <tr>
                            <td width="260" height="7" scope="col">
                                <a href="#" onclick="Daily_Born_Delivery();"> <strong> تقرير يومي للمواليد حسب تاريخ
                                        الولادة </strong></a>
                            </td>
                        </tr>

                    </table>
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
            $("#Birth_date_frm").flatpickr({
                enableTime: true,
                dateFormat: "d/m/Y",
                maxDate: "today",
            });

            $("#Birth_date_to").flatpickr({
                enableTime: true,
                dateFormat: "d/m/Y",
                maxDate: "today",

            });


            function Daily_Born() {

                var query = {
                    date_F: $('#Birth_date_frm').val(),
                    date_T: $('#Birth_date_to').val(),


                }
                var base_url = "{{ URL::to('Report/Daily_Born') }}?" + $.param(query);
                // window.location = base_url;

                $('#MyModal .modal-body').load(base_url, function() {
                    /* load finished, show dialog */
                    $('#MyModal').modal('show')
                });

            }

            function Daily_Report_Birth_Place() {

                var query = {
                    date_F: $('#Birth_date_frm').val(),
                    date_T: $('#Birth_date_to').val(),


                }
                var base_url = "{{ URL::to('Report/Daily_Report_Birth_Place') }}?" + $.param(query);
                // window.location = base_url;

                $('#MyModal .modal-body').load(base_url, function() {
                    /* load finished, show dialog */
                    $('#MyModal').modal('show')
                });

            }

            function Daily_Born_Delivery() {

                var query = {
                    date_F: $('#Birth_date_frm').val(),
                    date_T: $('#Birth_date_to').val(),


                }
                var base_url = "{{ URL::to('Report/Daily_Born_Delivery') }}?" + $.param(query);
                // window.location = base_url;

                $('#MyModal .modal-body').load(base_url, function() {
                    /* load finished, show dialog */
                    $('#MyModal').modal('show')
                });

            }
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

        function Daily_Born_Print() {

var query = {
    date_F: $('#Birth_date_frm').val(),
    date_T: $('#Birth_date_to').val(),


}
var base_url = "{{ URL::to('Report/Daily_Born_Print') }}?" + $.param(query);
// window.location = base_url;

$('#MyModal .modal-body').load(base_url, function() {
    /* load finished, show dialog */
    $('#MyModal').modal('show')
});

}

        </script>
    @endpush
