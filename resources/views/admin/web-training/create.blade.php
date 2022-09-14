<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Web Training | Create Tutorials</title>
    {{-- @Include('layouts.favicon') --}}
    @Include('layouts.links.admin.head')
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{ asset('dist/css/tutorial/summernote-lite.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/tutorial/summernote.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @extends('layouts.admin.master')
    @section('content')
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Create Tutorials</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Create Tutorials</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <link rel="stylesheet" href="{{ asset('dist/css/imageupload/fancy_fileupload.css') }}">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <section class="col-lg-5 connectedSortable">
                            <!-- Custom tabs with image drag and drop -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-image mr-1"></i>
                                        Images
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="p-0">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-lg-12" style="height: 350px; overflow: hidden; overflow-y: scroll;">
                                                    <div class="fallback">
                                                        <input id="fancy_upload" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                            <!-- Uploaded images -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-image mr-1"></i>
                                        Uploaded Images
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content p-0">
                                        <div class="chart " id="revenue-chart" style="position: relative; height: 315px; overflow-y: scroll;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-7 connectedSortable">
                            <!-- Edit Image Section -->
                            <div class="card ">
                                <div class="card-header ">
                                    <h3 class="card-title">
                                        <i class="fas fa-edit mr-1"></i>
                                        Edit Images
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div style="height: 346px; width: 100%;">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                            <!-- Description card -->
                            <div class="card">
                                <div class="card-header ">
                                    <h3 class="card-title">
                                        <i class="fas fa-edit mr-1"></i>
                                        Description
                                    </h3>
                                </div>
                                <div class="card-body" id="summernote">
                                    <div style="height: 250px; width: 100%;">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </section>
                        <!-- right col -->
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // alert('hello');
            $('#fancy_upload').FancyFileUpload({

                // send data to this url
                'url': '',

                // key-value pairs to send to the server
                'params': {},

                // editable file name?
                'edit': true,

                // max file size
                'maxfilesize': -1,

                // a list of allowed file extensions
                'accept': null,

                // 'iec_windows', 'iec_formal', or 'si' to specify what units to use when displaying file sizes
                'displayunits': 'iec_windows',

                // adjust the final precision when displaying file sizes
                'adjustprecision': true,

                // the number of retries to perform before giving up
                'retries': 5,

                // the base delay, in milliseconds, to apply between retries
                'retrydelay': 500,

                // an object containing valid MediaRecorder options
                // https://developer.mozilla.org/en-US/docs/Web/API/MediaRecorder
                'audiosettings': {},

                // whether or not to display a toolbar button with a webcam icon for recording <a href="https://www.jqueryscript.net/tags.php?/video/">video</a> directly via the web browser 
                'recordvideo': false,

                // an object containing valid MediaRecorder options
                // https://developer.mozilla.org/en-US/docs/Web/API/MediaRecorder
                'videosettings': {},

                // A valid callback function that is called after the preview dialog appears. Useful for temporarily preventing unwanted UI interactions elsewhere.
                'showpreview': function(e, data, preview, previewclone) {
                    // do something
                },

                // A valid callback function that is called after the preview dialog disappears. 
                'hidepreview': function(e, data, preview, previewclone) {
                    // do something
                },

                // A valid callback function that is called during initialization to allow for last second changes to the settings. 
                // Useful for altering fileupload options on the fly. 
                'preinit': null,

                // A valid callback function that is called at the end of initialization of each instance. 
                'postinit': null,

                // called for each item after it has been added to the DOM
                'added': function(e, data) {
                    // do something
                },

                // called whenever starting the upload
                'startupload': function(SubmitUpload, e, data) {
                    // do something
                },

                // called whenever progress is up<a href="https://www.jqueryscript.net/time-clock/">date</a>d
                'continueupload': function(e, data) {
                    // do something
                },

                // called whenever an upload has been cancelled
                'uploadcancelled': function(e, data) {
                    // do something
                },

                // called whenever an upload has successfully completed
                'uploadcompleted': function(e, data) {
                    // do something
                },

                // jQuery File Upload options
                'fileupload': {},

                // translation strings here
                'lang<a href="https://www.jqueryscript.net/tags.php?/map/">map</a>': {}

            });
        });
    </script>
    @endsection
    @Include('layouts.links.admin.foot')
    <!-- <script src="{{ asset('dist/js/imageupload/jquery-1.12.4.min.js') }}"></script> -->
    <script src="{{ asset('dist/js/imageupload/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ asset('dist/js/pages/tutorial/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/tutorial/summer-note.js') }}"></script>

</body>

</html>