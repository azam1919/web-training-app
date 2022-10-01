<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Web Training | Edit Tutorial Heading</title>
    {{-- @Include('layouts.favicon') --}}
    @Include('layouts.links.admin.head')

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script>
        setTimeout(function() {
            $('#success').slideUp('slow');
            $('#failed').slideUp('slow');
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
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Edit Tutorial Heading</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Edit Tutorial Heading</li>
                                </ol>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12 form-group px-4 my-4">
                                <form action="{{ route('heading.edit.update') }}" method="post">
                                    @csrf
                                    @error('heading')
                                        <div class="alert alert-default-danger alert-dismissible fade show" id="success">
                                            <strong>*</strong> {{ $message }}
                                        </div>
                                    @enderror
                                    @if (session('failed'))
                                        <div class="alert alert-default-danger alert-dismissible fade show" id="failed">
                                            <strong>*</strong> {{ session('failed') }}
                                        </div>
                                    @endif
                                    @foreach ($web_trainings as $web_training)
                                        <div class="form-group">
                                            <label for="">Heading</label>
                                            <input type="hidden" name="id" value="{{ $web_training->id }}">
                                            <input type="text" class="form-control" aria-label="Default"
                                                aria-describedby="inputGroup-sizing-default" name="heading"
                                                placeholder="..." value="{{ $web_training->heading }}">
                                        </div>
                                        <div class="form-check my-3">
                                            <input type="checkbox" name="status"
                                                {{ $web_training->status ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Status
                                            </label>
                                        </div>
                                    @endforeach
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
