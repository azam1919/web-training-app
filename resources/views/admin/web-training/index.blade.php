<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Web Training | List</title>
    <style>
        .flex-wrap {
            float: right !important;
        }
    </style>
    @Include('layouts.favicon')
    @Include('layouts.links.admin.head')
    @Include('layouts.links.datatable.head')
    @Include('layouts.links.admin.tutorial.sweet_alert.sweetalert')
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
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Web Tutorials</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Web Tutorials</li>
                                </ol>
                            </div>
                            <div class="col-sm-6 mt-3">
                                <a href="{{ route('heading.create.show') }}" class="border px-2 btn"
                                    style="background-color: #091E3E;color: white">
                                    Create Tutorial
                                </a>
                            </div>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-default-success alert-dismissible fade show" id="success"
                                role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Web Tutorials List</h3>

                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Heading</th>
                                                    <th>Status</th>
                                                    <th style="width: 75px;">Action</th>
                                                    <th style="width: 75px;">Copy</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $count = 0;
                                                @endphp
                                                @foreach ($web_trainings as $web_training)
                                                    <tr class="parent">
                                                        <td>
                                                            {{ ++$count }}
                                                        </td>
                                                        <td>
                                                            {{ $web_training->heading }}
                                                        </td>
                                                        <td>
                                                            @if ($web_training->status == 1)
                                                                <span class="badge badge-pill badge-success">
                                                                    Publish
                                                                </span>
                                                            @else
                                                                <span class="badge badge-pill badge-danger">
                                                                    Draft
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-secondary dropdown-toggle"
                                                                    type="button" id="dropdownMenuButton"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    Action
                                                                </button>
                                                                <div class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('tutorial.edit.show', ['id' => $web_training->id]) }}">Edit</a>
                                                                    {{-- <a class="dropdown-item"
                                                                        href="{{ route('tutorial.edit.show', ['id' => $web_training->id]) }}">Edit
                                                                        Tutorial</a> --}}

                                                                    <form action="{{ route('heading.delete') }}"
                                                                        method="POST" class="ms-2" id="actionUrl">
                                                                        @csrf
                                                                        <input type="hidden" name="id" class="id"
                                                                            value="{{ $web_training->id }}">
                                                                        <button type="submit"
                                                                            class="btn btn-danger delete_tutorial dropdown-item">
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td ><button class="btn btn-link">Copy URL</button></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <!-- <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Heading</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                    <th></th>
                                                </tr>
                                            </tfoot> -->
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
        </div>
    @endsection
    @Include('layouts.links.datatable.foot')
</body>

</html>
