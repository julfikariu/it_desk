@extends('admin.layouts.master')

@section('title', $title)

@push('css')
<style type="text/css">
    /*-- your custom css here --*/
</style>
@endpush

@section('content')


<div class="row">
    <div class="col">
        <nav class="breadcrumb justify-content-sm-start justify-content-center text-center text-light bg-dark ">
            <a class="breadcrumb-item text-white" href="{{route('admin.dashboard')}}">Home</a>
            <span class="breadcrumb-item active">{{$title}}</span>
            <span class="breadcrumb-info" id="time"></span>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-dark bg-dark">

            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <h6 class="card-title lh-35">{{$title}}</h6>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive style-scroll">
                    <table id="example" class="table table-striped table-bordered miw-500" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="10%">SL No.</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $key => $data)
                            <tr>
                                <th>{{$key+1}}</th>
                                <th>{{$data->f_name}}</th>
                                <td>{{$data->email}}</td>
                                <td>{{$data->subject}}</td>
                                <td>{{$data->message}}</td>
                                <td>{{$data->status == 1? "Unread" : "Read"}}</td>
                                <td>
                                    <a href="{{route('admin.view-contact', $data->id)}}" class="btn btn-info  btn-circle">
                                        <i class="material-icons">visibility</i>
                                    </a>
                                    <a href="{{route('admin.delete-contact', $data->id)}}" title="Delete"
                                        onclick="return confirm('Are you sure, would you like to delete this item?');">
                                        <button class="btn btn-danger  btn-circle">
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="{{asset('backend/assets/js/tables-datatable.js')}}"></script>
    @include('admin.includes.message')
@endpush
