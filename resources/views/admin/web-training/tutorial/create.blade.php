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
    <!-- <link href="{{ asset('dist/css/cropper.min.css') }}" rel="stylesheet" /> -->
    <!-- Jquery Draggable Css end  -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.css"
        integrity="sha512-+VDbDxc9zesADd49pfvz7CgsOl2xREI/7gnzcdyA9XjuTxLXrdpuz21VVIqc5HPfZji2CypSbxx1lgD7BgBK5g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.0/cropper.min.css" rel="stylesheet" /> -->
    <!-- <link rel="stylesheet" href="https://unpkg.com/jcrop/dist/jcrop.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.15/css/jquery.Jcrop.css">

    @Include('layouts.links.admin.head')
    @Include('layouts.links.admin.tutorial.sweet_alert.sweetalert')
    @Include('layouts.links.admin.tutorial.sweet_alert.head')
    <!-- <link rel="stylesheet" href="{{ asset('dist/css/tutorial/summernote-lite.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/tutorial/summernote.min.css') }}"> -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
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
    </script>
    <script src="/dist/js/tutorial/heading.js"></script>
    <!-- JQUery draggable -->



</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @extends('layouts.admin.master')
    @section('content')
    <div class="wrapper">
        <section>
            @foreach ($web_trainings as $web_training)
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        @if (session('success'))
                        <div id="success" class="alert alert-default-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Create {{ $heading[0]->heading ?? ' ' }} Tutorials</h1>
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
                                <form action="{{ route('heading.edit.update') }}" class="input-group" method="post" id="actionUrl">
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{ $web_training->id }}">
                                    <div class="input-group-append">
                                        <select name="status" id="status" class="form-control">
                                            <option value="@if ($web_training->status == 0) 0 @else 1 @endif" hidden selected>
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
                                    <input type="text" class="form-control" id="heading" value="{{ $web_training->heading }}" placeholder="..." aria-label="Recipient's username" aria-describedby="basic-addon2">

                                    <div class="input-group-append ml-3">
                                        <button type="submit" class="btn btn-secondary update_heading" style="background-color: #091e3e">Update</button>
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
                                    <div class="card-body statusimages">
                                        <div class="p-0">
                                            <div class="container-fluid">
                                                <form method="post" action="{{ url('tutorial/create/store') }}">
                                                    <button type="button" class="btn btn-primary btn-lg btn-block form-group" data-toggle="modal" data-target="#myModal">Upload</button>
                                                </form>
                                                <div class="row">
                                                    <div class="col-lg-12" style="height: 300px; overflow-y: scroll; justify-content:center; ">
                                                        <ul class="list-group sortable" id="imagelist">
                                                            @foreach ($statusImages as $image)
                                                            <li class="list-group-item d-flex justify-content-between align-items-center" data-index="{{ $image->id }}" data-position="{{ $image->position }}" role="button">
                                                                <img src="{{ URL::to($image->image) }}" alt="image" width="30px" height="30px" style="object-fit: contain;" role="button">
                                                                <span class="badge">
                                                                    <button class="btn-primary">x</button>
                                                                </span>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                        <!-- <ul style="list-style: none;" id="imagelist">
                                                            @foreach ($images as $get)
                                                            <li class="my-3 row w-auto">
                                                                <img src="{{ URL::to($get->image) }}" alt="image" width="50px" height="50px" style="object-fit: contain;" class="rounded" />
                                                                <input type="hidden" class="upload_img_id" value="{{ $get->id }}">
                                                                <input type="hidden" class="upload_img_lat" value="{{ $get->latitude }}">
                                                                <input type="hidden" class="upload_img_lang" value="{{ $get->longitude }}">
                                                                <input type="hidden" class="upload_img_width" value="{{ $get->width }}">
                                                                <input type="hidden" class="upload_img_height" value="{{ $get->height }}">
                                                                <input type="hidden" class="upload_description" value="{{ $get->description }}">
                                                                <span>{{ $get->image }} </span>
                                                            </li>
                                                            @endforeach
                                                        </ul> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                                <!-- Uploaded images -->
                                <div class="card statusimages" id="upload_images">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-image mr-1"></i>
                                            Uploaded Images
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content p-0">
                                            <div style="position: relative; height: 315px; overflow-y: scroll;">
                                                <ul class="list-group sortable" id="imagelist">
                                                    @foreach ($images as $get)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" data-index="{{ $get->id }}" data-position="{{ $get->position }}" role="button">
                                                        <img src="{{ URL::to($get->image) }}" alt="image" width="30px" height="30px" style="object-fit: contain;" role="button">
                                                        <span class="badge">
                                                            <button class="btn-primary">x</button>
                                                        </span>
                                                        <input type="hidden" class="upload_img_id" value="{{ $get->id }}">
                                                        <input type="hidden" class="upload_img_lat" value="{{ $get->latitude }}">
                                                        <input type="hidden" class="upload_img_lang" value="{{ $get->longitude }}">
                                                        <input type="hidden" class="upload_img_width" value="{{ $get->width }}">
                                                        <input type="hidden" class="upload_img_height" value="{{ $get->height }}">
                                                        <input type="hidden" class="upload_description" value="{{ $get->description }}">
                                                        <span>{{ $get->image }} </span>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                        <!-- right col -->
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
                                            <img src="{{ asset('img/white_background.png') }}" alt="image" style="height:100%;width:100%;" class="img-fluid" id="image">
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
                                                @foreach ($images as $get)
                                                <input type="hidden" id="web_tr_id" class="upload_img_parent_id" value="{{ $get->web_tr_id }}">
                                                <input type="hidden" id="image_id" class="upload_img_id" value="{{ $get->id }}">
                                                <input type="hidden" id="image_lat" class="upload_img_lat" value="{{ $get->latitude }}">
                                                <input type="hidden" id="image_lang" class="upload_img_lang" value="{{ $get->longitude }}">
                                                <input type="hidden" id="image_width" class="upload_img_width" value="{{ $get->width }}">
                                                <input type="hidden" id="image_height" class="upload_img_height" value="{{ $get->height }}">
                                                <input type="hidden"  class="upload_description" value="{{ $get->description }}">
                                                @endforeach
                                                <!-- <input type="hidden" id="image_id">
                                                <input type="hidden" id="image_id">
                                                <input type="hidden" id="image_id">
                                                <input type="hidden" id="image_id"> -->

                                                <button class="btn btn-primary btn-sm ml-auto update_crop" type="submit">Save</button>
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
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Upload image</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="drag-drop-area" name="fancy_upload[]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </section>
    </div>

    <script>
        CKEDITOR.replace('description');
    </script>

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
    <!-- JQUery draggable -->
    <script>
        $('#imagelist li img').click(function(e) {
            var imagepath = $(this).attr('src');
            var _this = $(this).parents('li');
            var image = $('.editimage img').attr('src', imagepath);
            // $('.editimage img').load(document.URL + '.editimage img ');
            // $('.editimage list-group').load(document.URL + '.editimage list-group li img');
            $('.statusimages #imagelist').load(document.URL + '.statusimages #imagelist li img');
            var img_id = $('#img_id').val(_this.find('.upload_img_id').val());
            // var db_description = _this.find('.upload_description').val();

            // var description = $("#description").val(db_description); //CKeditor
            // CKEDITOR.replace(description);

            // var description = $('#description').val(_this.find('.upload_description').val());
            let id = $('#image_id').val(_this.find('.upload_img_id').val());
            let x = $('#image_lat').val(_this.find('.upload_img_lat').val());
            let y = $('#image_lang').val(_this.find('.upload_img_lang').val());
            let w = $('#image_width').val(_this.find('.upload_img_width').val());
            let h = $('#image_height').val(_this.find('.upload_img_height').val());

            console.log(_this.find('.upload_img_id').val());
            console.log(_this.find('.upload_img_lat').val());
            console.log(_this.find('.upload_img_lang').val());
            console.log(_this.find('.upload_img_width').val());
            console.log(_this.find('.upload_img_height').val());

            const rect = Jcrop.Rect.fromPoints([x, y], [w, h]);
            jcrop.newCropper(rect, {
                aspectRatio: rect.aspect
            });

            // const rect = Jcrop.Rect.create(x, y, w, h);
            // const options = {
            //     x: _this.find('.upload_img_lat').val(),
            //     y: _this.find('.upload_img_lang').val(),
            //     width: _this.find('.upload_img_width').val(),
            //     height: _this.find('.upload_img_height').val()
            // };
            // jcrop.newWidget(rect, options);
            // var $image = $(".editimage img"),
            //     $dataX = $(".upload_img_lat"),
            //     $dataY = $(".upload_img_lang"),
            //     $dataHeight = $(".upload_img_height"),
            //     $dataWidth = $(".upload_img_width");
            // $image.cropper({
            //     aspectRatio: 16 / 9,
            //     data: {
            //         x: _this.find('.upload_img_lat').val(),
            //         y: _this.find('.upload_img_lang').val(),
            //         width: _this.find('.upload_img_width').val(),
            //         height: _this.find('.upload_img_height').val()
            //     },
            //     done: function(data) {
            //         $dataX.val(Math.round(data.x));
            //         $dataY.val(Math.round(data.y));
            //         $dataHeight.val(Math.round(data.height));
            //         $dataWidth.val(Math.round(data.width));
            //     },
            //     function() {
            //         jCropAPI = this
            //     }
            // });
            // console.log(img_id);
            console.log(window.Cropper);
            // console.log(description);
            // $('.uppy-c-btn-primary').click(function() {
            //     alerrt('jasdgf');
            // });
            $(function() {
                $("#draggable").draggable();
            });
        });
    </script>

    <!-- Uppy Plugin -->

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
            .use(GoldenRetriever)
        uppy.on('complete', (result) => {
            console.log('Upload complete! We’ve uploaded these files:', result.successful);
            window.location.reload(true);
            $('#upload_images #imagelist').empty().load(document.URL + '#upload_images #imagelist li img');
            $('.statusimages #imagelist').empty().load(document.URL + '.statusimages #imagelist li img');
        });
    </script>

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

    <!-- Sortable -->

    <script type="text/javascript">
        $(document).ready(function() {
            var parentid = "{{Session('web_tr_id')}}";
            $(".sortable").sortable({
                update: function(event, ui) {
                    $(this).children().each(function(index) {
                        if ($(this).attr('data-position') != (index + 1)) {
                            $(this).attr('data-position', (index + 1)).addClass('updated');
                        }
                    });
                    saveNewPositions(parentid);
                }
            });
        });

        function saveNewPositions(parentid) {
            var positions = [];
            $('.updated').each(function() {
                positions.push([$(this).attr('data-index'), $(this).attr('data-position')]);
                $(this).removeClass('updated');
            });
            $.ajax({
                url: "{{ route('updatePosition') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    update: 1,
                    parentid: parentid,
                    positions: positions
                },
                success: function(response) {
                    if (response == true) {
                        alert('updated Successfully ');
                    } else {
                        alert('not updated');
                    }
                    // console.log(response);
                }
            });
        }
    </script>

    @endsection

    <script src="https://unpkg.com/jcrop"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.15/js/jquery.Jcrop.js"></script> -->
    <script src="https://transloadit.edgly.net/releases/uppy/v1.6.0/uppy.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <script src="{{ asset('dist/js/imageupload/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ asset('dist/js/pages/tutorial/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/tutorial/summer-note.js') }}"></script> -->
    <script src="/dist/js/tutorial/jcrop.js"></script>
    <!-- <script src="{{ asset('dist/js/cropper.min.js') }}"></script> -->
    <!-- Uppy CDN -->
    <script src="https://releases.transloadit.com/uppy/v3.1.1/uppy.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js" integrity="sha512-ooSWpxJsiXe6t4+PPjCgYmVfr1NS5QXJACcR/FPpsdm6kqG1FmQ2SVyg2RXeVuCRBLr0lWHnWJP6Zs1Efvxzww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- JQUERY Draggable -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->
    @Include('layouts.links.admin.foot')
    @Include('layouts.links.admin.tutorial.sweet_alert.foot')


</body>

</html