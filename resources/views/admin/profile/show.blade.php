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
        <div class="card card-dark bg-dark py-1">

            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="h5">Profile Information</div>
                        <p class="">Update your account's profile information and email address.</p>
                    </div>
                    <div class="col-md-8">
                        <form action="{{route('admin.profile.update')}}" method="POST" enctype="multipart/form-data" class="wma-form">
                            @csrf
                            <div class="">

                                <p class="h6 mb-3">Photo</p>
                                <div class="row">
                                    <div class="col">
                                        <div class="img-favicon">
                                            @if(!empty($admin_user->profile_photo_path))
                                            <img src="{{asset('upload/backend/profile/'.$admin_user->profile_photo_path)}}"
                                                alt="{{$admin_user->profile_photo_path}}" class="img-fluid rounded-circle admin-avatar" >
                                            @else
                                                <img src="{{asset('upload/backend/mail_blank_avatar.jpg')}}" alt="Profile Image"
                                                    class="img-fluid rounded-circle">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col">
                                    <div class="">
                                            <div class="admin-image" id="admin_image">
                                                <div class="input-images"></div>
                                            </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <p class="mb-1">Admin Name: </p>
                                    <div class="input-group input-group-lg mb-3">
                                        <input type="text" name="name" value="{{$admin_user->name}}" class="form-control"
                                            aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                                        <br>
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>

                                    <p class="mb-1">Admin Email: </p>
                                    <div class="input-group input-group-lg mb-3">
                                        <input type="text" name="email" value="{{$admin_user->email}}" class="form-control"
                                            aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                                        <br>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <input type="hidden" name="id" value="{{$admin_user->id}}">
                                    <button class="btn btn-wave-light btn-danger btn-lg" type="submit">Save</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection


@push('scripts')
    @include('admin.includes.message')
    <script src="{{ asset('backend/assets/js/page-form-scripts.js') }}"></script>
    <script !src="">
        // -- your custom css here --

    </script>
@endpush
