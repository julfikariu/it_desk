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

                <div class="card-body ">
                    @if($contact != null)
                        <form action="{{route('admin.view-contact', $contact->id)}}" method="POST" enctype="multipart/form-data"
                            class="wma-form">
                            @csrf
                            <p class="mb-1">Full Name: </p>
                            <div class="input-group input-group-lg  mb-3" >
                                <input type="text" name="name" value="{{$contact->f_name}}" class="form-control" aria-label="Large"
                                    aria-describedby="inputGroup-sizing-sm" placeholder="Full Name" disabled>
                            </div>

                            <p class="mb-1">Email: </p>
                            <div class="input-group input-group-lg mb-3">
                                <input type="text" name="email" value="{{$contact->email}}" class="form-control" aria-label="Large"
                                    aria-describedby="inputGroup-sizing-sm" placeholder="Email" disabled>
                            </div>

                            <p class="mb-1">Subject:  </p>
                            <div class="input-group input-group-lg mb-3">
                                <input type="text" name="subject" value="{{$contact->subject}}" class="form-control" aria-label="Large"
                                    aria-describedby="inputGroup-sizing-sm" placeholder="Subject" disabled>
                            </div>

                            <p class="mb-1">Message:</p>
                            <div class="form-group mb-3">
                                <div class="contact-textarea">
                                    <textarea class="form-control" rows="6" placeholder="Wright Message"
                                        id="message" name="message" required disabled>{{$contact->subject}}</textarea>
                                </div>
                            </div>

                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @include('admin.includes.message')
@endpush
