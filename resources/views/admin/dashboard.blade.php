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
    <div class="col-xl-3 col-sm-6">
        <div class="card card-dark bg-danger">

            <div class="card-body d-flex">
                <i class="display-2 material-icons">people</i>
                <div class="ml-auto align-self-center text-right">
                    <span class="card-title mb-1">total users</span>
                    <h3 class="card-title font-montserrat mb-0">{{$totalUser}}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card card-dark bg-dark">

            <div class="card-body d-flex">
                <i class="display-2 material-icons">mail</i>
                <div class="ml-auto align-self-center text-right">
                    <span class="card-title mb-1">contact messages</span>
                    <h3 class="card-title font-montserrat mb-0">{{$contactMessage}}</h3>
                </div>

            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card card-dark bg-info">

            <div class="card-body d-flex">
                <i class="display-2 material-icons">folder</i>
                <div class="ml-auto align-self-center text-right">
                    <span class="card-title mb-1">KNOWLEDGE</span>
                    <h3 class="card-title font-montserrat mb-0">{{$totalKnowledge}}</h3>
                </div>

            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card card-dark bg-primary">

            <div class="card-body d-flex">
                <i class="display-2 material-icons">text_fields</i>
                <div class="ml-auto align-self-center text-right">
                    <span class="card-title mb-1">TICKETS</span>
                    <h3 class="card-title font-montserrat mb-0">{{$totalTicket}}</h3>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card card-justify">
            <div id="calendar_dark"></div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

@include('admin.includes.dashboard-js')
<script>
    // Your custom JavaScript here...
</script>
@endpush