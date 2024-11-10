@extends('layouts.main')
@section('title', 'المسح الضوئي لاشعار الوفاة')

@section('content')

    {{-- <script type="text/javascript" src="{{ asset('assets/js/ajax.js') }}"></script> --}}

    <script type="text/javascript" src="{{ asset('assets/js/ajax-dynamic-list_D.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('assets/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118') }} "></script>
 <script type="text/javascript" src="{{ asset('js/Resources2/dynamsoft.webtwain.initiate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/Resources2/dynamsoft.webtwain.config.js') }}"></script>

    <meta http-equiv="Content-Type" content="text/html; charset=windows-1256" />
    <meta name="description" content="Health care website">
    <meta name="keywords" content="health, care, healthcare">



    <div class="card mb-7">
        <!--begin::Card body-->
        <div class="card-body">
            <form class="form" action="#" method="post">
                <input id="ucode" type="hidden" value="{{$USER_CODE}}" />
                @csrf
                <div id="jsEnabled">
                    <div class="row mb-6">
                        <!--begin::Col-->
                        <label class="col-lg-2 col-form-label  fw-bold fs-6">الماسح الضوئي</label>

                        <div class="col-lg-4">
                            <select class="form-select" data-control="select2" id="source" name="source"
                            style="position:relative;width:146px" onChange="source_onchange()">

                            </select>
                        </div>
                        <div class="col-lg-2">
                            <label for = 'ShowUI'><input type='checkbox' id='ShowUI' checked />ShowUI&nbsp;</label>


                            <label for = 'ADF'><input type='checkbox' id='ADF' checked ?>ADF&nbsp;</label>
                        </div>
                        <div class="col-lg-2">

                            <label for = 'Duplex'><input type='checkbox' id='Duplex' checked />Duplex&nbsp;</label>
                            <label for = 'Color'><input type='checkbox' id='Color' checked />Color&nbsp;</label>

                        </div>

                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label  fw-bold fs-6">هوية المتوفي</label>

                        <div class="col-lg-2 fv-row">
                            <input type="number" name="DEAD_ID" id="DEAD_ID" maxLength="9"
                                oninput="this.value=this.value.slice(0,this.maxLength)"
                                class="form-control form-control-lg mb-3 mb-lg-0"
                                onchange="get_dead_name(this.value);">
                        </div>
                        <div class="col-lg-4 fv-row">
                            <input class="form-control" id="d_name" disabled readonly>
                        </div>

                        <div class="col-lg-4">
                            <!--begin::Col-->
                            @if (IsPermissionBtn(6))
                            <input type="hidden" name="scan_yes" id="scan_yes" value="0" />
                                <button type="button" class="btn btn-primary me-2" onclick="Simple_AcquireImage()">مسح ضوئي</button>
                            @endif
                            <button type="button" class="btn btn-dark me-2" onclick="()">مسح البيانات</button>

                            <!--end::Col-->
                        </div>
                    </div>

                </div>

        </div>
    </div>

    <div class="card mb-7">

        <!--begin::Card body-->
        <div class="card-body">
            <p align="center">
                  <table width="1040" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                          <td><div align="center">
                                      <div id="dwtcontrolContainer" align="center" ></div>
                                      </div>
                          </td>
                      </tr>
                  </table>
            </p>

        </div>
    </div>
@endsection
@push('scripts')

<script>
    Dynamsoft.WebTwainEnv.RegisterEvent('OnWebTwainReady',
        Dynamsoft_OnReady
    ); // Register OnWebTwainReady event. This event fires as soon as Dynamic Web TWAIN is initialized and ready to be used
    var DWObject;

    function Dynamsoft_OnReady() {

        DWObject = Dynamsoft.WebTwainEnv.GetWebTwain(
            'dwtcontrolContainer'
        ); // Get the Dynamic Web TWAIN object that is embeded in the div with id 'dwtcontrolContainer'

        var token = document.querySelector("meta[name='csrf-token']").getAttribute("content");
        DWObject.SetHTTPFormField('_token', token);
         if (DWObject) {
            DWObject.RegisterEvent('OnPostAllTransfers', Simple_SaveImage);
        }

        if (DWObject) {
            var count = DWObject.SourceCount;
            if (count == 0 && Dynamsoft.Lib.env.bMac) {
                DWObject.CloseSourceManager();
                DWObject.ImageCaptureDriverType = 0;
                DWObject.OpenSourceManager();
                count = DWObject.SourceCount;
            }

            for (var i = 0; i < count; i++)
                document.getElementById("source").options.add(new Option(DWObject.GetSourceNameItems(i), i));

            <?php if(isset($_GET['S'])){ ?>

            document.getElementById("source").getElementsByTagName("option")[<?php echo $_GET['S']; ?>].selected = 'selected';

            <?php } ?>
            /* if (count>0)
             $("#source").val($("#source option:first").val());*/
        }
    }

    var uploadfilename;

    function progress(percent, $element) {
        var progressBarWidth = percent * $element.width() / 100;
        $element.find('div').animate({
            width: progressBarWidth
        }, 500).html(percent + "% ");
    }



    function Simple_AcquireImage() {


        if (document.getElementById('DEAD_ID').value != '') {
            if (DWObject) {
                var OnAcquireImageSuccess, OnAcquireImageFailure;
                OnAcquireImageSuccess = OnAcquireImageFailure = function() {


                    // btnRemoveAllImages_onclick();

                    DWObject.CloseSource();
                };

                //DWObject.BrokerProcessType = 0;//use a separate process for document scanning
                //DWObject.SelectSource();
                DWObject.IfShowUI = document.getElementById("ShowUI").checked;
                //alert(bADFChecked);
                // DWObject.IfFeederEnabled = bADFChecked;
                var colorChecked = document.getElementById("Color").checked;
                var bDuplexChecked = document.getElementById("Duplex").checked;
                DWObject.IfDuplexEnabled = bDuplexChecked;

                //DWObject.SelectSourceByIndex(1);

                DWObject.OpenSource();
                var bDuplexChecked = document.getElementById("Duplex").checked;
                DWObject.IfDuplexEnabled = bDuplexChecked;

                var bADFChecked = document.getElementById("ADF").checked;
                DWObject.IfFeederEnabled = bADFChecked;
                if (document.getElementById("ADF").checked && DWObject.IfFeederEnabled ==
                    true) // if paper is NOT loaded on the feeder
                {
                    if (DWObject.IfFeederLoaded != true && DWObject.ErrorCode == 0) {
                        alert("No paper detected! Please load papers and try again!");
                        return;
                    }
                }
                if (colorChecked) {
                    DWObject.PixelType = 2;
                    DWObject.Resolution = 100;
                } else {
                    DWObject.PixelType = 0;
                    DWObject.Resolution = 300;
                }
                DWObject.JPEGQuality = 100;

                DWObject.AcquireImage();



            }

            uploadfilename = document.getElementById('ucode').value + "_" + document.getElementById('DEAD_ID').value +
                ".pdf";


        } else{
            Swal.fire({
                        title: 'يوجد خطأ في عملية الإدخال !',
                        text: 'أدخل هوية المتوفي صاحب الاشعار',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
        }

    }
    //-----------------------------------------------------------------------------
    var strHTTPServer = location.hostname;
    var sample_editable_1 = null;


    var CurrentPathName = unescape(location.pathname); // get current PathName in plain ASCII
    var CurrentPath = CurrentPathName.substring(0, CurrentPathName.lastIndexOf("/") + 1);
    //var strActionPage =  CurrentPath +"savetofiletest";//the ActionPage's file path
    var strActionPage = CurrentPath + "savetofile"; //the ActionPage's file path

    //alert(strActionPage+'KK');
    function checkErrorString() {
        if (DWObject.ErrorCode == 0) {
            appendMessage("<span style='color:#cE5E04'><b>" + DWObject.ErrorString + "</b></span><br />");

            return true;
        }
        if (DWObject.ErrorCode == -2115) //Cancel file dialog
            return true;
        else {
            if (DWObject.ErrorCode == -2003) {

                var ErrorMessageWin = window.open("", "ErrorMessage",
                    "height=500,width=750,top=0,left=0,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no"
                );
                ErrorMessageWin.document.writeln(DWObject.HTTPPostResponseString);
            }
            appendMessage("<span style='color:#cE5E04'><b>" + DWObject.ErrorString + "</b></span><br />");
            return false;
        }
    }

    function source_onchange() {


        if (document.getElementById("source"))
            DWObject.SelectSourceByIndex(document.getElementById("source").selectedIndex);
        DWObject.OpenSource();
        DWObject.IfDisableSourceAfterAcquire = true;



    }

    //----------------------------------------------------------------------------------------------

    function Simple_SaveImage() {





        DWObject.HTTPUploadAllThroughPostAsPDF(
            strHTTPServer,
            strActionPage,
            uploadfilename
        );
        document.getElementById('scan_yes').value = 1;


        /*if (checkIfImagesInBuffer()) {

        btnRemoveAllImages_onclick();

        }  */


    }

    function get_dead_name(cid) {

            var url = "{{ route('dead.Get_dead_name') }}";
            $.ajax({
                url: url,
                type: 'json',
                method: 'post',
                data: {
                    'ID_NUM': cid,
                },
            }).done(function(response) {
                console.log(response);
                if (response.success) {

                    if (response.success == 1) {

                        $('#d_name').val(response.results.dname);

                    }
                } else {
                    console.log(response);
                    $message = "";
                    $.each(response.errors, function(key, value) {
                        console.log(value);
                        console.log(key);
                        $message += value.join('-') + "\r\n";
                    });
                    Swal.fire({
                        title: 'يوجد خطأ في عملية الإدخال !',
                        text: response.results.message,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });


                }
            });
        }
</script>
@endpush
