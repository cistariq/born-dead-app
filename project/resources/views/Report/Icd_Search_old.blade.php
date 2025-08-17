@extends('layouts.main')
@section('title', 'استعلام عن ICD10 ')

@section('content')

    <form action="#" id="icd10_form">
        <!--begin::Card-->
        <div class="card mb-7">
            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Compact form-->
                <div class="d-flex align-items-center">
                    <!--begin::Input group-->
                    <label class="col-lg-1 col-form-label  fw-bold fs-6">ICD10 Code</label>

                    <div class="position-relative w-md-300px me-md-1">
                        <div class="row mb-4">
                            <div class="col-lg-10">
                                <select id="ICD_CD" data-control="select2" data-placeholder="اختر ..."
                                    class="form-select form-select-lg fw-bold">
                                    <option></option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <label class="col-lg-1 col-form-label  fw-bold fs-7">ICD10 Name</label>

                    <div class="position-relative w-md-600px me-md-1">
                        <div class="row mb-4">
                            <div class="col-lg-10">
                                <select id="DIAG_NAME" data-control="select2" data-placeholder="اختر ..."
                                    class="form-select form-select-lg fw-bold">
                                    <option></option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->
                </div>

                <!--end::Compact form-->
                <!--end::Compact form-->


                <div class="float-end">


                    <button type="button" class="btn btn-dark me-5" onclick="clear_form();">جديد</button>

                </div>

            </div>
        </div>
    </form>

    <!--end::Row-->
    <!--end::Card-->



@endsection


@push('scripts')
    <script>
        $(document).ready(function() {


            //السبب المباشر
            getDeadIcdToSelect_Byid($("#ICD_CD"));
            getDeadIcdToSelect_Byname($("#DIAG_NAME"));
        });

        function getDeadIcdToSelect_Byid(select_id) {
            select_id.select2({
                ajax: {
                    url: "{{ route('dead.getDeadIcd_id') }}",
                    method: 'post',
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term
                        }

                        // Query parameters will be ?search=[term]&type=user_search
                        return query;
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    }
                },
                cache: true,
                placeholder: 'ابحث عن  التشخيص',
                minimumInputLength: 1
            });
        }

        function getDeadIcdToSelect_Byname(select_id) {
            select_id.select2({
                ajax: {
                    url: "{{ route('dead.getDeadIcd_name') }}",
                    method: 'post',
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term
                        }

                        // Query parameters will be ?search=[term]&type=user_search
                        return query;
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    }
                },
                cache: true,
                placeholder: 'ابحث عن  التشخيص',
                minimumInputLength: 1
            });
        }
        $('#ICD_CD').change(function() {
            var P_ICD_CODE = $(this).val();
            if (P_ICD_CODE) {

                $.ajax({
                    url: "{{ route('dead.getDeadIcd_bycode') }}",
                    method: "POST",
                    data: {
                        P_ICD_CODE: P_ICD_CODE
                    },
                    success: function(data) {
                        console.log(data);
                        $('#DIAG_NAME').empty();
                        $('#DIAG_NAME').append('<option value="' + data[0].ICD_CODE + '" >' + data[
                            0].ICD_NAME_EN + '</option>');

                    }
                });
            }

        });

        $('#DIAG_NAME').change(function() {
            var P_ICD_CODE = $(this).val();
            if (P_ICD_CODE) {
                $.ajax({
                    url: "{{ route('dead.getDeadIcd_bycode') }}",
                    method: "POST",
                    data: {
                        P_ICD_CODE: P_ICD_CODE
                    },
                    success: function(data) {
                        console.log(data);
                        $('#ICD_CD').empty();
                        $('#ICD_CD').append('<option value="' + data[0].ICD_CODE + '" >' + data[0]
                            .ICD_CD + '</option>');

                    }
                });
            }
        });
        /**************************************************************************************************************************************************************************************************/
        function clear_form() {
            $('#icd10_form')[0].reset();
            $('#icd10_form .form-select').val('').trigger('change');
        }
    </script>
@endpush
