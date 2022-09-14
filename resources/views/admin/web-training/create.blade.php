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
    <link rel="stylesheet" href="{{ asset('dist/css/tutorial/summernote-lite.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/tutorial/summernote.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <style>
        .dropzone {
            min-height: 100px !important;
            max-height: 100px !important;
            border-color: #b2afaf;
            border-style: dashed;
        }

        .dz-message {
            margin: 1em 0 !important;
        }
    </style>
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
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Create Tutorials</li>
                                </ol>
                            </div>
                            <!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <!-- Main row -->
                        <form action="">
                            <div class="row">
                                <!-- Left col -->
                                <section class="col-lg-4 connectedSortable">
                                    <!-- Custom tabs (Charts with tabs)-->
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                <i class="fas fa-image mr-1"></i>
                                                Images
                                            </h3>
                                        </div><!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="p-0">
                                                <!-- Image -->
                                                <div class="container-fluid">
                                                    <form action="/file-upload" class="dropzone">
                                                        <div class="fallback" style="display: none" {{-- style="height: 130px; border-color: #b2afaf;  border-style: dashed;" --}}>
                                                        </div>
                                                    </form>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <form action="/file-upload" class="dropzone">
                                                                <div class="fallback">
                                                                    <input name="file" type="file" multiple />
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div id="showhere"
                                                                style="position: relative; height: 200px; overflow-y: scroll;">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <p></p>

                                            </div>
                                        </div><!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                    <!-- Uploaded images -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                <i class="fas fa-image mr-1"></i>
                                                Uploaded Images
                                            </h3>
                                        </div><!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="tab-content p-0">
                                                <!-- Morris chart - Sales -->
                                                <div class="chart " id="revenue-chart"
                                                    style="position: relative; height: 300px; overflow-y: scroll;">
                                                    <!-- <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas> -->
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                        Laboriosam
                                                        culpa similique qui. Voluptates excepturi necessitatibus ullam
                                                        et
                                                        error aliquid natus amet odit culpa dicta, in unde hic dolor a!
                                                        Sapiente.</p>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                        Laboriosam
                                                        culpa similique qui. Voluptates excepturi necessitatibus ullam
                                                        et
                                                        error aliquid natus amet odit culpa dicta, in unde hic dolor a!
                                                        Sapiente.</p>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                        Laboriosam
                                                        culpa similique qui. Voluptates excepturi necessitatibus ullam
                                                        et
                                                        error aliquid natus amet odit culpa dicta, in unde hic dolor a!
                                                        Sapiente.</p>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                        Laboriosam
                                                        culpa similique qui. Voluptates excepturi necessitatibus ullam
                                                        et
                                                        error aliquid natus amet odit culpa dicta, in unde hic dolor a!
                                                        Sapiente.</p>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                        Laboriosam
                                                        culpa similique qui. Voluptates excepturi necessitatibus ullam
                                                        et
                                                        error aliquid natus amet odit culpa dicta, in unde hic dolor a!
                                                        Sapiente.</p>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                        Laboriosam
                                                        culpa similique qui. Voluptates excepturi necessitatibus ullam
                                                        et
                                                        error aliquid natus amet odit culpa dicta, in unde hic dolor a!
                                                        Sapiente.</p>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                        Laboriosam
                                                        culpa similique qui. Voluptates excepturi necessitatibus ullam
                                                        et
                                                        error aliquid natus amet odit culpa dicta, in unde hic dolor a!
                                                        Sapiente.</p>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                        Laboriosam
                                                        culpa similique qui. Voluptates excepturi necessitatibus ullam
                                                        et
                                                        error aliquid natus amet odit culpa dicta, in unde hic dolor a!
                                                        Sapiente.</p>
                                                </div>
                                            </div>
                                        </div><!-- /.card-body -->
                                    </div>
                                    <!--Uploaded images -->
                                </section>
                                <!-- /.Left col -->
                                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                                <section class="col-lg-8 connectedSortable">
                                    <!-- Map card -->
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
                                        <!-- /.card-body-->
                                    </div>
                                    <!-- /.card -->

                                    <!-- Map card -->
                                    <div class="card">
                                        <div class="card-header ">
                                            <h3 class="card-title">
                                                <i class="fas fa-edit mr-1"></i>
                                                Description
                                            </h3>
                                        </div>
                                        <div class="card-body" id="summernote">
                                            <div style="height: 232px; width: 100%;">
                                            </div>
                                        </div>
                                        <!-- /.card-body-->
                                    </div>
                                    <!-- /.card -->
                                </section>
                                <!-- right col -->
                            </div>
                        </form>
                        <!-- /.row (main row) -->
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
        </div>
    @endsection
    <script type="text/javascript">
        Dropzone.options.dropzone = {
            maxFilesize: 12,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + file.name;
            },
            previewsContainer: "#showhere",
            clickable: "#showhere",
            dictDefaultMessage: "",
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 5000,
            success: function(file, response) {
                console.log(response);
            },
            error: function(file, response) {
                return false;
            }
        };
    </script>
    @Include('layouts.links.admin.foot')
    <script src="{{ asset('dist/js/pages/tutorial/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/tutorial/summer-note.js') }}"></script>

</body>

</html>
