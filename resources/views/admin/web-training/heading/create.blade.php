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
    <script>
        setTimeout(function() {
            $('#heading').slideUp('slow');
        }, 10000);
    </script>
    @Include('layouts.links.admin.tutorial.select.selectpciker')
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
                                <h1 class="m-0">Create Tutorial Heading</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Create Tutorial Heading</li>
                                </ol>
                            </div>
                        </div>


                        <div class="row mb-2">
                            <div class="col-12 form-group px-4 my-4">
                                <form action="{{ route('heading.create.store') }}" method="post">
                                    @csrf
                                    @if (isset($errors) && count($errors) > 0)
                                        <div class="alert alert-default-danger fade show" id="heading">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="">Heading</label>
                                        <input type="text" class="form-control" aria-label="Default"
                                            aria-describedby="inputGroup-sizing-default" name="heading" placeholder="...">
                                    </div>
                                    <div class="form-group my-3">
                                        <label> Status </label>
                                        <select name="status" id="" class="form-control">
                                            <option value="" hidden selected disabled>SELECT</option>
                                            <option value="0">Draft</option>
                                            <option value="1">Publish</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"
                                            id="inputGroup-sizing-default">Save</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
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
                        'url': '/admin/web-training/create',
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
