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
                <div class="card-header">
                    <h6 class="card-title">{{$title}}</h6>
                </div>
                <div class="card-body ">
                    <form action="{{route('admin.store-create-user')}}" method="POST">
                        @csrf
                        <p class="mb-1">Full Name: </p>
                        <div class="input-group input-group-lg mb-3">
                            <input type="text" name="name"  class="form-control" aria-label="Large"
                                   aria-describedby="inputGroup-sizing-sm" placeholder="Full Name" >
                            <br>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <p class="mb-1">Email: </p>
                        <div class="input-group input-group-lg mb-3">
                            <input type="text" name="email"  class="form-control" aria-label="Large"
                                   aria-describedby="inputGroup-sizing-sm" placeholder="Email Name">
                            <br>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <p class="mb-1">User Type: </p>
                        <div class="input-group input-group-lg mb-3">
                            <select class="form-control form-control-lg" name="type">
                                <option value="1">USR</option>
                            </select>
                            <br>
                            @if ($errors->has('type'))
                                <span class="text-danger">{{ $errors->first('type') }}</span>
                            @endif
                        </div>


                        <p class="mb-1">Password: </p>
                        <div class="input-group input-group-lg mb-3">
                            <input type="password" name="password"  class="form-control" aria-label="Large"
                                   aria-describedby="inputGroup-sizing-sm" placeholder="Password" >
                            <br>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="wizard-action text-left">
                            <button class="btn btn-wave-light btn-danger btn-lg" type="submit">Create User</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection


@push('scripts')
    @include('admin.includes.message')
@endpush
