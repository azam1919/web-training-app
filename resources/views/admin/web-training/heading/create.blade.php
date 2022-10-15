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
                            <h1 class="m-0">Create Heading</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Create Heading</li>
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
                                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="heading" placeholder="...">
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
                                    <button type="submit" class="btn btn-primary" id="inputGroup-sizing-default">Save</button>
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
</body>
</html>