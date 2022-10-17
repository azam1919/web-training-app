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
    @Include('layouts.links.admin.tutorial.sweet_alert.sweetalert')
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
        }, 5000);
    </script>


    <script src="/dist/js/tutorial/heading.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @extends('layouts.admin.master')
    @section('content')
        <div class="wrapper">
            <!-- Content Wrapper. Contains page content -->
            @foreach ($web_trainings as $web_training)
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
                            <div id="error" class="alert alert-default-danger alert-dismissible fade show"
                                role="alert" style="display: none">
                                <strong></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div id="success_info" class="alert alert-default-success alert-dismissible fade show"
                                role="alert" style="display: none">
                                <strong></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0">Create {{ $heading['0']->heading ?? ' ' }} Tutorials</h1>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item active">Create Tutorials</li>
                                    </ol>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
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
                                            value="{{ $web_training->heading }}" placeholder="..."
                                            aria-label="Recipient's username" aria-describedby="basic-addon2">

                                        <div class="input-group-append ml-3">
                                            <button type="submit" class="btn btn-secondary update_heading"
                                                style="background-color: #091e3e">Update</button>
                                        </div>
                                        <span id="heading_error" class="invalid-feedback"></span>
                                    </form>
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
                                                        <div class="col-lg-12" style="height: 350px; overflow: hidden; ">
                                                            <form method="post"
                                                                action="{{ url('tutorial/create/store') }}">
                                                                <div id="drag-drop-area" name="fancy_upload[]"></div>
                                                            </form>
                                                            <!-- <div class="fallback">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <form action="" id="formdata">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <input id="fancy_upload" type="file" name="fancy_upload"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        accept=".jpg, .png, image/jpeg, image/png" multiple>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </form>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div> -->
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
                                        <div class="card-body" id="upload_images">
                                            <div class="tab-content p-0">
                                                <div class="chart " id="revenue-chart"
                                                    style="position: relative; height: 315px; overflow-y: scroll;">
                                                    <ul style="list-style: none;" id="imagelist">
                                                        @foreach ($images as $get)
                                                            <li class="my-3 row w-auto">
                                                                <img src="{{ URL::to($get->image) }}" alt="image"
                                                                    width="50px" height="50px"
                                                                    style="object-fit: contain;" class="rounded" />
                                                                <input type="hidden" class="upload_img_id"
                                                                    value="{{ $get->id }}">
                                                                <input type="hidden" class="upload_img_description"
                                                                    value="{{ $get->description }}">
                                                                <input type="hidden" class="upload_img_latitude"
                                                                    value="{{ $get->latitude }}">
                                                                <input type="hidden" class="upload_img_longitude"
                                                                    value="{{ $get->longitude }}">
                                                                <input type="hidden" class="upload_img_height"
                                                                    value="{{ $get->height }}">
                                                                <input type="hidden" class="upload_img_width"
                                                                    value="{{ $get->width }}">
                                                                <input type="hidden" class="upload_description"
                                                                    value="{{ $get->description }}">
                                                                <span>{{ $get->image }} </span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- /.Left col -->
                                <!-- right col (We are only adding the ID to make the widgets sortable)-->

                                <section class="col-lg-7 connectedSortable" id="draggable">

                                    <!-- Edit Image Section -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                <i class="fas fa-edit mr-1"></i>
                                                Edit Images
                                            </h3>
                                        </div>
                                        <div class="card-body" id="card-body">
                                            @include('layouts.links.admin.tutorial.jcrop')
                                            <div class="editimage">
                                                <img src="{{ asset('dist/img/edit profile.jpg') }}" alt="image"
                                                    class="img-fluid" id="image">
                                            </div>
<<<<<<< HEAD
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                    <!-- Description card -->
                                    <div class="card">
                                        <form action="" method="post" id="actionUrl">
                                            @csrf
                                            <div class="card-header">
                                                <div style="display: flex; justify-content:space-between;">
                                                    <h3 class="card-title">
                                                        <i class="fas fa-edit mr-1"></i>
                                                        Description
                                                    </h3>
                                                    <input type="hidden" id="image_id">

                                                    <button
                                                        class="btn btn-primary btn-sm ml-auto update_crop swalDefaultSuccess"
                                                        type="submit">Save</button>
=======
                                            <div class="card-body">
                                                <div style="height: 250px; width: 100%;">
>>>>>>> 0a9472873cf028a5d5ded24ec196f2e0af9b566e
                                                </div>
                                            </div>

                                            <input type="text" name="description" id="description" value="" />
                                        </form>
                                    </div>
                                </section>
                            </div>
                            <!-- /.card -->
                            <!-- right col -->
                        </div>
                </div>
                </section>
            @endforeach
        </div>
        </div>
        <script>
            CKEDITOR.replace('description');
        </script>
        <!-- JQUery draggable -->
        <script>
            $(document).ready(function() {
                $('#imagelist li img').click(function() {
                    var imagepath = $(this).attr('src');
                    var _this = $(this).parents('li');
                    console.log(1);
                    // alert(imagepath);    
                    // $("#card-body").empty();
                    // $('.editimage img').empty();
                    // $('.editimage img').destroy();
                    // $(".editimage img").removeAttr("style");
                    $('.editimage img').attr('src', imagepath);
                    $('.editimage img').load(location.URL + '.editimage img');
                    $('#image_id').val(_this.find('.upload_img_id').val());
                    // var db_description = _this.find('.upload_description').val();

                    // var description = $("#description").val(db_description); //CKeditor
                    // CKEDITOR.replace(description);

                    // var description = $('#description').val(_this.find('.upload_description').val());
                    // $('#image_id').val($('#img_id').val());
                    // console.log(img_id);
                    // console.log(description);
                });
                $('.uppy-c-btn-primary').click(function() {
                    alerrt('jasdgf');
                });
                $(function() {
                    $("#draggable").draggable();
                });
            });
        </script>
        <script type="module">
            import {
                Uppy,
                Dashboard,
                XHRUpload,
                Tus
            } from "https://releases.transloadit.com/uppy/v3.0.1/uppy.min.mjs"
            var uppy = new Uppy()
            .use(Dashboard, {
                inline: true,
                target: '#drag-drop-area'
            })
            .use(XHRUpload, {
                endpoint: "{{ route('tutorial.create.store') }}",
                headers: {
                    'X-CSRF-Token': " {{ csrf_token() }} "
                },
                formData: true,
                fieldName: 'fancy_upload[]',

            })

            uppy.on('complete', (result) => {
                console.log('Upload complete! We’ve uploaded these files:', result.successful);
                location.reload();
            });
            // $("#upload_images").load(location.href + " #upload_images");
            // uppy.on('file-added', (file) => {
            // alert('Added file', file)
            // })
        </script>

        <!-- JCrop -->
        <script type="module">

            import Cropper from 'cropperjs';
            const image = document.getElementById('image');
            // image.reset();
            const cropper = new Cropper(image, {
                onChange: updatePreview,
                onSelect: updatePreview,
                onRelease: resetCoords,
                aspectRatio: 16 / 9,

                crop(event) {
                }, function(){jCropAPI = this}});
        </script>
    @endsection
    <script src="https://transloadit.edgly.net/releases/uppy/v1.6.0/uppy.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.fancy-fileupload.js') }}"></script>
<<<<<<< HEAD
    <script src="{{ asset('dist/js/pages/tutorial/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/tutorial/summer-note.js') }}"></script>
    <script src="/dist/js/tutorial/jcrop.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"
        integrity="sha512-ooSWpxJsiXe6t4+PPjCgYmVfr1NS5QXJACcR/FPpsdm6kqG1FmQ2SVyg2RXeVuCRBLr0lWHnWJP6Zs1Efvxzww=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- JQUERY Draggable -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    @Include('layouts.links.admin.foot')
    @Include('layouts.links.admin.tutorial.sweet_alert.foot')
=======
    <script>
        $(document).ready(function() {
            var token;
            // var file = $('#fancy_upload').val();

            $('#fancy_upload').FancyFileUpload({

                // send data to this url
                'url': "{{ route('tutorial.edit.update') }}",

                // key-value pairs to send to the server
                'params': {
                    _token: $('#formdata').find('input[name="_token"]').first().val(),
                },

                // editable file name?
                'edit': false,

                // max file size
                'maxfilesize': 1000000,
                'retries': 0,
                'showpreview': function(e, data, preview, previewclone) {
                    // do something
                },
                'hidepreview': function(e, data, preview, previewclone) {
                    // do something
                },
                'preinit': null,
                'postinit': null,
                'added': function(e, data) {
                    // do something
                },
                'startupload': function(SubmitUpload, e, data) {
                    // do something
                },
                'continueupload': function(e, data) {
                    // do something
                },
                'uploadcancelled': function(e, data) {
                    // do something
                },

                // called whenever an upload has successfully completed
                'uploadcompleted': function(e, data) {
                    // do something

                },



                // jQuery File Upload options

                'fileupload': {},





>>>>>>> 0a9472873cf028a5d5ded24ec196f2e0af9b566e


</body>

</html>
