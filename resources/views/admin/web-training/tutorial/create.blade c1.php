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
                        @if (session('success'))
                            <div id="success" class="alert alert-default-success alert-dismissible fade show"
                                role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Create {{ $web_trainings['0']->heading }} Tutorials</h1>
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
                                                    <div class="col-lg-12"
                                                        style="height: 350px; overflow: hidden; overflow-y: scroll;">
                                                        <div class="fallback">
                                                            <form action="" id="formdata" method="post"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="action"
                                                                    value="{{ route('tutorial.create.store') }}">
                                                                <input id="fancy_upload" type="file" name="fancy_upload"
                                                                    accept=".jpg, .png, image/jpeg, image/png" multiple>
                                                            </form>
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
                                        <div class="card-body" >
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

            </div>
        </div>
    @endsection
    @Include('layouts.links.admin.foot')
    <!-- <script src="{{ asset('dist/js/imageupload/jquery-1.12.4.min.js') }}"></script> -->
    <script src="{{ asset('dist/js/imageupload/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.fancy-fileupload.js') }}"></script>
    <script>
        $(document).ready(function() {
            var token;
            // var file = $('#fancy_upload').val();

            $('#fancy_upload').FancyFileUpload({

                // send data to this url
                'url': "{{ route('tutorial.create.store') }}",

                // key-value pairs to send to the server
                'params': {
                    _token: $('#formdata').find('input[name="_token"]').first().val(),
                },

                // editable file name?
                'edit': true,

                // max file size
                // 'maxfilesize': -1,
                // 'maxNumberOfFiles': 6,
                'retries': 0,
                // 'minNumberOfFiles': 2,
                // 'option': {
                //     maxNumberOfFiles: 10
                // },
                'fileupload': {
                    // maxNumberOfFiles: 10,
                    singleFileUploads: false,

                },


            });
        });
    </script>

</body>

</html>
