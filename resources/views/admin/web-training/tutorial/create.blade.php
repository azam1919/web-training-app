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
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://releases.transloadit.com/uppy/v3.0.1/uppy.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <!-- Jquery Draggable Css -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!-- Jquery Draggable Css end  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.css" integrity="sha512-+VDbDxc9zesADd49pfvz7CgsOl2xREI/7gnzcdyA9XjuTxLXrdpuz21VVIqc5HPfZji2CypSbxx1lgD7BgBK5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @Include('layouts.links.admin.head')


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
                    <div id="success" class="alert alert-default-success alert-dismissible fade show" role="alert">
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
                                                    <!-- <div class="fallback">
                                                            <form action="" id="formdata">
                                                                @csrf
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
                                <div class="card-body">
                                    <div class="tab-content p-0">
                                        <div class="chart " id="revenue-chart" style="position: relative; height: 315px; overflow-y: scroll;">
                                            @php
                                            $images = DB::table('web_trainings_assets')->where('web_tr_id' , 9)->get();
                                            @endphp

                                            <ul style="list-style: none;" id="imagelist">
                                                @foreach( $images as $get )
                                                <li class="bg-primary">
                                                    <img src="{{ URL::to($get->image) }}" alt="image" width="100px" style="object-fit: contain;" />
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
                            <div class="card" >
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-edit mr-1"></i>
                                        Edit Images
                                    </h3>
                                </div>
                                <div class="card-body" id="card-body">
                                    @include('layouts.links.admin.tutorial.jcrop')
                                    <div class="editimage">
                                        <img src="{{ asset('dist/img/edit profile.jpg') }}" alt="image" class="img-fluid" id="image">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                            <!-- Description card -->
                            <div class="card">
                                <form action="" method="post">
                                    <div class="card-header ">
                                        <div style="display: flex; justify-content:space-between;">
                                            <h3 class="card-title">
                                                <i class="fas fa-edit mr-1"></i>
                                                Description
                                            </h3>
                                            <button class="btn btn-primary btn-sm ml-auto" type="submit">Save</button>
                                        </div>
                                    </div>
                                    <textarea name="ckeditor"></textarea>
                                    <!-- <div class="card-body" id="summernote">
                                        <div style="height: 250px; width: 100%;">
                                    </div> -->
                            </div>
                            </form>
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
        CKEDITOR.replace('ckeditor');
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
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        })
        // uppy.on('file-added', (file) => {
        // alert('Added file', file)
        // })
    </script>
    //
    <!-- JQUery draggable -->
    <script>
        $(document).ready(function() {

            $('#imagelist li img').click(function() {
                var imagepath = $(this).attr('src');
                // alert(imagepath);    
                // $("#card-body").empty();
                // $('.editimage img').empty();
                // $('.editimage img').destroy();
                // $(".editimage img").removeAttr("style");
                $('.editimage img').attr('src', imagepath);

            });
            $('.uppy-c-btn-primary').click(function() {
                alerrt('jasdgf');
            });
            $(function() {
                $("#draggable").draggable();
            });
        });
    </script>
    <!-- JCrop -->
    <script type="module">
        import Cropper from 'cropperjs';
        const image = document.getElementById('image');
        // image.reset();
        const cropper = new Cropper(image, {
            onRelease: resetCoords,
            aspectRatio: 16 / 9,
            crop(event) {
                console.log(event.detail.x);
                console.log(event.detail.y);
                console.log(event.detail.width);
                console.log(event.detail.height);
                console.log(event.detail.rotate);
                console.log(event.detail.scaleX);
                console.log(event.detail.scaleY);
            },

        });
        function resetCoords() {
            $('#x1').val("0");
            $('#y1').val("0");
            $('#width').val("0");
            $('#height').val("0");
        };

    </script>
    
    @endsection
    <script src="https://transloadit.edgly.net/releases/uppy/v1.6.0/uppy.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('dist/js/imageupload/jquery.fancy-fileupload.js') }}"></script>
    <script src="/dist/js/tutorial/jcrop.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js" integrity="sha512-ooSWpxJsiXe6t4+PPjCgYmVfr1NS5QXJACcR/FPpsdm6kqG1FmQ2SVyg2RXeVuCRBLr0lWHnWJP6Zs1Efvxzww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- JQUERY Draggable -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    @Include('layouts.links.admin.foot')
  
</body>

</html>