@extends('layouts.main')
@section('title', 'مسح ضوئي لإشعار الوفاة')

@section('content')
<!--begin::Card-->
<div class="card mb-7">
    <!--begin::Card body-->
    <div class="card-body">
        <!--begin::Form-->
        <form class="form" action="#" method="post">
            <!--begin::Input group-->
            <div class="form-group row">
                <!--begin::Label-->
                <label class="col-lg-2 col-form-label text-lg-right">أختر المرفقات المراد رفعها</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-10">
                    <!--begin::Dropzone-->
                    <div class="dropzone dropzone-queue mb-2" id="kt_dropzonejs_example_2">
                        <!--begin::Controls-->
                        <div class="dropzone-panel mb-lg-0 mb-2">
                            <a class="dropzone-select btn btn-sm btn-primary me-2">رفع الملفات</a>
                            <a class="dropzone-upload btn btn-sm btn-light-primary me-2">رفع الكل</a>
                            <a class="dropzone-remove-all btn btn-sm btn-light-primary">حذف الكل</a>
                        </div>
                        <!--end::Controls-->

                        <!--begin::Items-->
                        <div class="dropzone-items wm-200px">
                            <div class="dropzone-item" style="display:none">
                                <!--begin::File-->
                                <div class="dropzone-file">
                                    <div class="dropzone-filename">
                                        <span data-dz-name></span>
                                        <strong>(<span data-dz-size>340kb</span>)</strong>
                                    </div>

                                    <div class="dropzone-error" data-dz-errormessage></div>
                                    <div class="dropzone-success" style="color: #65f073"></div>
                                </div>
                                <!--end::File-->

                                <!--begin::Progress-->
                                <div class="dropzone-progress">
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0"
                                            aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Progress-->

                                <!--begin::Toolbar-->
                                <div class="dropzone-toolbar">
                                    <span class="dropzone-start"><i class="bi bi-play-fill fs-3"></i></span>
                                    <span class="dropzone-cancel" data-dz-remove style="display: none;"><i
                                            class="bi bi-x fs-3"></i></span>
                                    <span class="dropzone-delete" data-dz-remove><i class="bi bi-x fs-1"></i></span>
                                </div>
                                <!--end::Toolbar-->
                            </div>
                        </div>
                        <!--end::Items-->
                    </div>
                    <!--end::Dropzone-->

                    <!--begin::Hint-->
                    <span class="form-text text-muted">الحد الأقصى لحجم الملف هو 4 ميجابايت والحد الأقصى لعدد الملفات هو 50.</span>
                    <!--end::Hint-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->

@endsection
@push('scripts')
    <script>
        // set the dropzone container id
        const id = "#kt_dropzonejs_example_2";
        const dropzone = document.querySelector(id);

        // set the preview element template
        var previewNode = dropzone.querySelector(".dropzone-item");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);

        var myDropzone = new Dropzone(id, { // Make the whole body a dropzone
            url: "{{ route('scan_file.store_multi_file') }}", // Set the url for your upload script location
            parallelUploads: 20,
            maxFiles: 50,
            previewTemplate: previewTemplate,
            maxFilesize: 7, // Max filesize in MB
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: id + " .dropzone-items", // Define the container to display the previews
            clickable: id +
                " .dropzone-select", // Define the element that should be used as click trigger to select files.
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (file, response) {
                if(response.success){

                    file.previewElement.querySelector(id + " .dropzone-success").innerHTML= response.results;
                }else{
                    file.previewElement.querySelector(id + " .dropzone-error").innerHTML= response.errors;
                }

            },
        });

        myDropzone.on("addedfile", function(file) {
            // Hookup the start button
            file.previewElement.querySelector(id + " .dropzone-start").onclick = function() {
                myDropzone.enqueueFile(file);
            };
            const dropzoneItems = dropzone.querySelectorAll('.dropzone-item');
            dropzoneItems.forEach(dropzoneItem => {
                dropzoneItem.style.display = '';
            });
            dropzone.querySelector('.dropzone-upload').style.display = "inline-block";
            dropzone.querySelector('.dropzone-remove-all').style.display = "inline-block";
        });

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function(progress) {
            const progressBars = dropzone.querySelectorAll('.progress-bar');
            progressBars.forEach(progressBar => {
                progressBar.style.width = progress + "%";
            });
        });

        myDropzone.on("sending", function(file) {
            // Show the total progress bar when upload starts
            const progressBars = dropzone.querySelectorAll('.progress-bar');
            progressBars.forEach(progressBar => {
                progressBar.style.opacity = "1";
            });
            // And disable the start button
            file.previewElement.querySelector(id + " .dropzone-start").setAttribute("disabled", "disabled");
        });

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("complete", function(progress) {
            const progressBars = dropzone.querySelectorAll('.dz-complete');
            setTimeout(function() {
                progressBars.forEach(progressBar => {
                    progressBar.querySelector('.progress-bar').style.opacity = "0";
                    progressBar.querySelector('.progress').style.opacity = "0";
                    progressBar.querySelector('.dropzone-start').style.opacity = "0";
                });
            }, 300);
        });

        // Setup the buttons for all transfers
        dropzone.querySelector(".dropzone-upload").addEventListener('click', function() {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
        });

        // Setup the button for remove all files
        dropzone.querySelector(".dropzone-remove-all").addEventListener('click', function() {
            dropzone.querySelector('.dropzone-upload').style.display = "none";
            dropzone.querySelector('.dropzone-remove-all').style.display = "none";
            myDropzone.removeAllFiles(true);
        });

        // On all files completed upload
        myDropzone.on("queuecomplete", function(progress) {
            const uploadIcons = dropzone.querySelectorAll('.dropzone-upload');
            uploadIcons.forEach(uploadIcon => {
                uploadIcon.style.display = "none";
            });
        });

        // On all files removed
        myDropzone.on("removedfile", function(file) {
            if (myDropzone.files.length < 1) {
                dropzone.querySelector('.dropzone-upload').style.display = "none";
                dropzone.querySelector('.dropzone-remove-all').style.display = "none";
            }
        });
    </script>
@endpush
