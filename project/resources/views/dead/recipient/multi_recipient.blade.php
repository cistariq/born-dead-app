@extends('layouts.main')
@section('title', 'تسجيل استلام الاشعارات')

@section('content')
    <div class="card mb-5 mb-xl-12">

        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">بيانات مستلم الاشعارات</h3>
            </div>
            <!--end::Card title-->
        </div>
        <div id="kt_account_settings_profile_details">

            <form action="#" id="recipient_form">

                <!--begin::Card-->
                <div class="card mb-12">
                    <!--begin::Card body-->
                    <div class="card-body">

                        <div class="d-flex align-items-center">
                            <!--begin::Input group-->
                            <div class="row mb-12">

                                <label class="col-lg-1 col-form-label required fw-bold fs-6">المنطقة</label>
                                <div class="col-lg-2 fv-row">
                                    <select id="P_city_id" name="P_city_id" data-control="select2" data-placeholder="اختر ..."
                                        class="form-select form-select-lg fw-bold">
                                        <option></option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!--begin::Label-->
                                <label class="col-lg-1 col-form-label required fw-bold fs-6">الهوية</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-2 fv-row">
                                    <!--begin::Col-->
                                    <input type="number" name="P_ID_NO" id="P_ID_NO" maxLength="9"
                                        oninput="this.value=this.value.slice(0,this.maxLength)"
                                        class="form-control form-control-lg mb-3 mb-lg-0" onchange="getRecipientInfoBy(this,$('#P_FULL_NAME'))">
                                    <!--end::Col-->
                                </div>
                                <label class="col-lg-1 col-form-label required fw-bold fs-6">الاسم</label>
                                <div class="col-lg-2 fv-row">
                                    <input type="text" name="P_FULL_NAME" id="P_FULL_NAME"
                                        class="form-control form-control-lg mb-3 mb-lg-0">
                                </div>
                                <label class="col-lg-1 col-form-label required fw-bold fs-6">رقم الجوال</label>
                                <div class="col-lg-2 fv-row">
                                    <input type="text" name="P_MOBILE" id="P_MOBILE"
                                        class="form-control form-control-lg mb-3 mb-lg-0">
                                </div>

                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <!--begin::Input group-->

                                <table class="table table-rounded table-striped border border-gray-500 " style="width: 100%" id="recipient_form">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-gray-800 border">
                                            <th width="20%"> هوية الشهيد</th>
                                            <th width="50%"> اسم الشهيد</th>
                                            <th width="5%"> اضافة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" name="P_id[]" id="P_id"
                                                    class="form-control form-control-lg mb-3 mb-lg-0" onchange="getPersonalInfoBy(this,$('#P_NAME'))">
                                            </td>
                                            <td>
                                                <input type="text" name="P_NAME[]" id="P_NAME"
                                                    class="form-control form-control-lg mb-3 mb-lg-0">
                                            </td>
                                            <td>
                                                <a class="btn btn-info btn-circle btn-icon-only" onclick="add_recipient();">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>

                        </div>
                        <!--begin:Action-->
                        <div class="d-flex align-items-center">
                            <button type="button" class="btn btn-primary me-5" onclick="save_new_recipient();">حفظ</button>
                            <button type="button" class="btn btn-outline-dark me-5" onclick="">جديد</button>

                        </div>
                        <!--end:Action-->
                        <!--end::Compact form-->
                    </div>
                    <!--end::Col-->
                </div>
            </form>
        </div>
    </div>

@endsection
@push('scripts')
    <script>


var i2 = 1;
    var recipientArrayr = [];

    function add_recipient() {
        i2++;
         var txtP_ID_NO = $('#P_id').val();
         var txtP_NAME = $('#P_NAME').val();


        if (P_id == "" || P_id === undefined || P_id == null) {
            ShowMessage('الرجاء ادخال رقم الهوية بشكل صحيح', 'error', 'Error');
        } else {

            var row = document.createElement("tr");
            row.setAttribute("class", "removeRecipientclass" + i2);
            row.innerHTML = `


<tr>

<td>
<input type='text' id='ddl_ID_NO${i2}' name="P_id[]" recipient-data='${txtP_ID_NO}' value='${txtP_ID_NO}' class='form-control' readonly='readonly'/>
</td>
<td>
<input type='text' id='ddl_NAME${i2}' name="P_NAME[]" recipient-data='${txtP_NAME}' value='${txtP_NAME}' class='form-control' readonly='readonly'/>
</td>


<td>
<button class='btn btn-danger btn-circle btn-icon-only delete-row' onclick='removeRecipient_row(${i2});'><i
        class='fa fa-minus'></i></button>
</td>
</tr>`;
            $("#recipient_form tbody").append(row);
                var obj = {
                id: i2,
                ID_NO: $(`#ddl_ID_NO${i2}`).attr('recipient-data'),
                NAME: $(`#ddl_NAME${i2}`).attr('recipient-data'),

                };

                recipientArrayr.push(obj);

             if (recipientArrayr.length > 0) {

                 $("#P_id").val('');
                $("#P_NAME").val('');

            }
                ;
           console.log("=======================");
            var myJsonString = JSON.stringify(recipientArrayr);
            console.log(myJsonString);
        }
    }

    function removeRecipient_row(i) {
        var valuee2 = $(`#recipient${i}`).attr('recipient-data');

        $('#recipientCods').val('');

        for (var i2 = 0; i2 < recipientArrayr.length; i2++) {
            if (recipientArrayr[i2] === valuee2) {
                recipientArrayr.splice(i2, 1);
                i2--;
            }
            if (recipientArrayr[i2] === 0) {
                recipientArrayr.splice(i2, 1);
                i3--;
            }
        }
        if (recipientArrayr.length > 0) {
            $('#recipientCods').val(recipientArrayr.join(','));
        } else {
            $('#recipientCods').val(null);
        }

        $('.removeRecipientclass' + i).remove();
    }
    function getPersonalInfoBy(e,id){
        var P_ID_NO = e.value;
        if(P_ID_NO){
           // blockUI.block();
            var url = "{{route('dead.recipient.getPersonalInfoByIdNo')}}";
            $.ajax({
                url: url,
                type:'json',
                method: 'post',
                data: {'id_no' : P_ID_NO },
            }).done(function (response) {
                console.log(response);
                if(response.success){
                    if(response.success == 1){
                        id.val(response.name);
                    }
                }else{
                    console.log(response);
                    $message = "";
                    $.each(response.errors, function (key, value) {
                        console.log(value);
                        console.log(key);
                        $message += value.join('-') + "\r\n";
                    });
                    Swal.fire({
                        title:  'خطأ !',
                        text: $message,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
               // blockUI.release();
            });
        }
    }

    function getRecipientInfoBy(e,id){
        var P_ID_NO = e.value;
        if(P_ID_NO){
          //  blockUI.block();
            var url = "{{route('constant.getPersonalInfoByIdNo')}}";
            $.ajax({
                url: url,
                type:'json',
                method: 'post',
                data: {'id_no' : P_ID_NO },
            }).done(function (response) {
                console.log(response);
                if(response.success){
                    if(response.success == 1){
                        id.val(response.results.fname+' '+response.results.sname+' '+
                            response.results.tname+' '+response.results.lname
                        );
                    }
                }else{
                    console.log(response);
                    $message = "";
                    $.each(response.errors, function (key, value) {
                        console.log(value);
                        console.log(key);
                        $message += value.join('-') + "\r\n";
                    });
                    Swal.fire({
                        title:  'خطأ !',
                        text: $message,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
                blockUI.release();
            });
        }
    }

    function save_new_recipient() {
        var form_date = new FormData($('#recipient_form')[0]);

        var url = "{{ route('dead.recipient.store') }}";

        $.ajax({
            url: url,
            method: 'post',
            cache: false,
            processData: false,
            contentType: false,
            data: form_date,
        }).done(function(response) {
            if (response.success) {
                $('#newApplicationModal').modal('hide');
                clear_form();
                toastr.success(response.results.message);
            } else{
                console.log(response);
                $message = "";
                $.each(response.errors, function (key, value) {
                    console.log(value);
                    console.log(key);
                    $message += value.join('-') + "\r\n";
                });
                Swal.fire({
                    title:  'خطأ !',
                    text: $message,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            }
        });
    }
    </script>
@endpush
