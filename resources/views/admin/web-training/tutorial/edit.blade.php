<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Web Training | Edit Tutorials</title>
    {{-- @Include('layouts.favicon') --}}
    @Include('layouts.links.admin.head')
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{ asset('dist/css/tutorial/summernote-lite.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/tutorial/summernote.min.css') }}">
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 8px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        #Turorial_heading:focus {
            outline: none;
        }
    </style>
    <script>
        setTimeout(function() {
            $('#success').slideUp('slow');
        }, 10000);
    </script>
    @Include('layouts.links.admin.tutorial.select.selectpciker')
    @Include('layouts.links.admin.tutorial.sweet_alert.sweetalert')

    <script src="/dist/js/tutorial/heading.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @extends('layouts.admin.master')
    @section('content')
        <div class="wrapper">
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                @foreach ($web_trainings as $web_training)
                    <div class="content-header">
                        <div class="container-fluid">
                            @if (session('success'))
                                <div class="alert alert-default-success alert-dismissible fade show" id="success"
                                    role="alert">
                                    {{ session('success') }}
                                </div>
                            @elseif (session('failed'))
                                <div class="alert alert-default-danger alert-dismissible fade show" id="failed">
                                    <strong>*</strong> {{ session('failed') }}
                                </div>
                            @else
                            @endif
                            @error('heading')
                                <div class="alert alert-default-danger alert-dismissible fade show" id="success">
                                    <strong>*</strong> {{ $message }}
                                </div>
                            @enderror

                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <h1 class="m-0">Edit Tutorials</h1>
                                </div>
                                <div class="col-sm-4">
                                    <form action="{{ route('heading.edit.update') }}" class="input-group" method="post"
                                        id="actionUrl">
                                        @csrf
                                        <input type="hidden" name="id" id="id" value="{{ $web_training->id }}">
                                        <div class="input-group-append">
                                            <select name="status" id="status" class="form-control">
                                                <option value="@if ($web_training->status == 0) 0 @else 1 @endif" hidden
                                                    selected>
                                                    @if ($web_training->status == 0)
                                                        Draft
                                                    @else
                                                        Publish
                                                    @endif
                                                </option>
                                                <option value="0">Draft</option>
                                                <option value="1">Publish</option>
                                            </select>
                                        </div>
                                        <input type="text" class="form-control" id="heading"
                                            value="{{ $web_training->heading }}" placeholder="Recipient's username"
                                            aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-secondary update_heading"
                                                style="background-color: #091e3e">Update</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-4">
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
                                                        <div class="col-lg-12"
                                                            style="height: 350px; overflow: hidden; overflow-y: scroll;">
                                                            <div class="fallback">
                                                                <input id="fancy_upload" type="file" name="file"
                                                                    accept=".jpg, .png, image/jpeg, image/png" multiple>
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
                                                <div class="chart " id="revenue-chart"
                                                    style="position: relative; height: 315px; overflow-y: scroll;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- /.Left col -->
                                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                                <section class="col-lg-7 connectedSortable">
                                    <form action="" method="post">
                                        <!-- Edit Image Section -->
                                        <div class="card ">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    <i class="fas fa-edit mr-1"></i>
                                                    Edit Images
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <div style="height: 346px; width: 100%;">
                                                    @include('layouts.links.admin.tutorial.jcrop')
                                                    <img src="{{ asset('dist/img/edit profile.jpg') }}" alt=""
                                                        id="image" style="height: 346px; width: 100%;">
                                                    <script src="/dist/js/tutorial/jcrop.js"></script>
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
                                    </form>
                                </section>
                                <!-- right col -->
                            </div>
                        </div>
                    </section>
                @endforeach


            </div>
        </div>
    @endsection
    @Include('layouts.links.admin.foot')
    <script>
        $(document).ready(function() {
            var token;
            // var file = $('#fancy_upload').val();
            $('#fancy_upload').FancyFileUpload({

                // send data to this url
                // 'url': 'admin/web-training/create',

                // key-value pairs to send to the server
                'params': {
                    action: 'fileuploader'
                },

                // editable file name?
                'edit': true,

                // max file size
                'maxfilesize': -1,

                // called whenever starting the upload
                'startupload': function(SubmitUpload, e, data) {
                    $.ajax({
                        'headers': {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        'type': 'post',
                        'url': "{{ route('tutorial.create.store') }}",
                        'dataType': 'json',
                        'contentType': 'multipart/form-data',
                        'data': {
                            'file': $('#fancy_upload').val(),
                        },
                        'cache': false,
                        'processData': false,
                        'contentType': false,
                        'success': function(response) {
                            alert('Yes')
                            // SubmitUpload();
                        }
                    });
                },

                // called whenever progress is up<a href="https://www.jqueryscript.net/time-clock/">date</a>d
                'continueupload': function(e, data) {
                    // do something
                },

                // called whenever an upload has been cancelled
                'uploadcancelled': function(e, data) {
                    console.log('Are You your');
                    alert('Are You your');
                },

                // called whenever an upload has successfully completed
                'uploadcompleted': function(e, data) {
                    // do something
                },

                // jQuery File Upload options
                'fileupload': {
                    singleFileUploads: true
                },

                // translation strings here
                'lang<a href="https://www.jqueryscript.net/tags.php?/map/">map</a>': {}

                // 'continueupload': function(e, data) {
                //     var ts = Math.round(new Date().getTime() / 1000);

                //     // Alternatively, just call data.abort() or return false here to terminate the upload but leave the UI elements alone.
                //     if (token.expires < ts) data.ff_info.RemoveFile();
                // },
                // 'uploadcompleted': function(e, data) {
                //     data.ff_info.RemoveFile();
                // }
            });
        });
    </script>
    {{-- <!-- <script src="{{ asset('dist/js/imageupload/jquery-1.12.4.min.js') }}"></script> --> --}}
    <script src="{{ asset('dist/js/imageupload/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ asset('dist/js/pages/tutorial/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/tutorial/summer-note.js') }}"></script>

</body>

</html>
