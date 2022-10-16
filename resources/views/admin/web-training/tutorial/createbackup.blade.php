<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Web Training | Create Tutorials</title>
    {{-- @Include('layouts.favicon') --}}
    <link href="https://releases.transloadit.com/uppy/v3.0.1/uppy.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <!-- Uppy CDN -->
    <link href="https://releases.transloadit.com/uppy/v3.1.1/uppy.min.css" rel="stylesheet">
    <!-- Jquery Draggable Css -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!-- Jquery Draggable Css end  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.css"
        integrity="sha512-+VDbDxc9zesADd49pfvz7CgsOl2xREI/7gnzcdyA9XjuTxLXrdpuz21VVIqc5HPfZji2CypSbxx1lgD7BgBK5g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

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

        .uppy-Dashboard-innerWrap {
            max-height: 335px;
        }

        /* #card-body{
            display:flex;
            justify-content: center;
            align-items: center;
        }
        #card-body img{
            object-fit:cover;

        } */
        .jcrop-holder img {
            object-fit: contain;
        }

        .cropper-container {
            display: none !important;
        }
    </style>
    <script>
        setTimeout(function() {
            $('#success').slideUp('slow');
        }, 10000);
        $(document).ready(function() {
            $('.update_crop').click(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var description = CKEDITOR.instances['description'].getData();
                var id = $('#image_id').val();
                var description_result = description.replace(/(<p[^>]+?>|<p>|<\/p>)/img, "");
                console.log(id);
                console.log(description);

                const cropper = new Cropper(image, {
                    aspectRatio: 16 / 9,
                    crop(event) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('tutorial.create.store') }}",
                            // contentType: 'application/json',
                            // dataType: 'json',
                            data: {
                                'id': id,
                                'description': description_result,
                                'x': event.detail.x,
                                'y': event.detail.y,
                                'width': event.detail.width,
                                'height': event.detail.height,
                                'rotate': event.detail.rotate,
                                'scaleX': event.detail.scaleX,
                                'scaleY': event.detail.scaleY,
                            },
                            success: function(response) {
                                CKEDITOR.replace(response.description);
                                var description = CKEDITOR.instances
                                    .getData(response
                                        .description);
                            },
                            error: (error) => {
                                console.log(JSON.stringify(error));
                            }
                        });

                    },
                    function() {
                        jCropAPI = this
                    }
                });
            });
        });
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
                                <h1 class="m-0">Create {{ $heading['0']->heading ?? ' ' }} Tutorials</h1>
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
                                                    <div class="col-lg-12" style="height: 350px; overflow: hidden; ">
                                                        <form method="post" action="{{ url('tutorial/create/store') }}">
                                                            <div id="drag-drop-area" name="fancy_upload[]"></div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                                <!-- Uploaded images -->
                                <div class="card" id="upload_images">
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
                                                @foreach ($images as $get)
                                                    <ul class="list-group" style="list-style: none;" id="imagelist">
                                                        <!-- Images List Start Here -->
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-center">
                                                            <img src="{{ URL::to($get->image) }}" alt="image"
                                                                width="50px" height="50px" style="object-fit: contain;"
                                                                class="rounded" />
                                                            <input type="hidden" class="upload_img_id"
                                                                value="{{ $get->id }} ">
                                                            <input type="hidden" class="upload_description"
                                                                value="{{ $get->description }}">
                                                            <span class="badge badge-primary badge-pill">X</span>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                                <!-- <ul> -->
                                                <!-- Images List Ends here -->
                                                <!-- Foreach Start Here -->
                                                <!-- <li class="my-3 row w-auto">
                                                        <img src="URL::to($get->image)" alt="image" width="50px" height="50px" style="object-fit: contain;" class="rounded" /> -->
                                                <!-- <span>$get-image here </span> -->
                                                <!-- </li>  -->
                                                <!-- Foreach Ends here  -->
                                                <!-- </ul> -->
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
                                            <input type="hidden" name="img_id" id="img_id">
                                        </div>
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
                                                <button class="btn btn-primary btn-sm ml-auto update_crop"
                                                    type="submit">Save</button>
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

        </div>
        </div>

        <script>
            CKEDITOR.replace('description');
        </script>

        <script type="module">
        import {
            Uppy,
            Dashboard,
            XHRUpload,
            GoldenRetriever,
            Tus
        } from "https://releases.transloadit.com/uppy/v3.0.1/uppy.min.mjs"
        var uppy = new Uppy()
            .use(Dashboard, {
                inline: true,
                target: '#drag-drop-area',
                recoveredAllFiles: 'We restored all files. You can now resume the upload.',
                sessionRestored: 'Session restored',
            })
            .use(XHRUpload, {
                endpoint: "{{ route('tutorial.create.store') }}",
                headers: {
                    'X-CSRF-Token': " {{ csrf_token() }} "
                },
                formData: true,
                fieldName: 'fancy_upload[]',
            })
        //    Tus here 
            .use(GoldenRetriever)
        uppy.on('complete', (result) => {
            console.log('Upload complete! We’ve uploaded these files:', result.successful);
            $('#upload_images').load(document.URL + ' #upload_images');
        });
    </script>
        <!-- JQUery draggable -->

        <!-- JCrop -->
        <script type="module">
        import Cropper from 'cropperjs';
        const image = document.getElementById('image');
        const cropper = new Cropper(image, {
            onChange: updatePreview,
            onSelect: updatePreview,
            onRelease: resetCoords,
            aspectRatio: 16 / 9,

            crop(event) {},
            function() {
                jCropAPI = this
                jCropAPI.removeAttr('style');
            }
        });
    </script>
    @endsection
    <script>
        $(document).ready(function() {
            $('#imagelist li img').click(function() {
                var imagepath = $(this).attr('src');
                var _this = $(this).parents('li');
                // alert(imagepath);    
                $('.editimage img').attr('src', imagepath);
                $('.editimage img').load(document.URL + '.editimage img');
                var img_id = $('#img_id').val(_this.find('.upload_img_id').val());
                // var db_description = _this.find('.upload_description').val();

                // var description = $("#description").val(db_description); //CKeditor
                // CKEDITOR.replace(description);

                // var description = $('#description').val(_this.find('.upload_description').val());
                $('#image_id').val($('#img_id').val());
                console.log(img_id);
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
    <script src="https://transloadit.edgly.net/releases/uppy/v1.6.0/uppy.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.fancy-fileupload.js') }}"></script>
    <script src="/dist/js/tutorial/jcrop.js"></script>
    <!-- Uppy CDN -->
    <script src="https://releases.transloadit.com/uppy/v3.1.1/uppy.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"
        integrity="sha512-ooSWpxJsiXe6t4+PPjCgYmVfr1NS5QXJACcR/FPpsdm6kqG1FmQ2SVyg2RXeVuCRBLr0lWHnWJP6Zs1Efvxzww=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- JQUERY Draggable -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    @Include('layouts.links.admin.foot')

</body>

</html>
