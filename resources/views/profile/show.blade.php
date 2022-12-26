@extends('layouts.guest')

@section('title', 'Profile update')

@push('css')
    <style type="text/css">
        /*-- your custom css here --*/

    </style>
@endpush


@section('content')

<section class="hm-banner">
    <div class="container">
        <div class="col text-center mb-5">
            <h2>Profile</h2>
        </div>
    </div>
</section>
<section class="contact-details pb-70">
    <div class="container py-4">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 section-content">
                <div id="form-messages">
                    @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success') }}
                    </div>
                    @elseif(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('error') }}
                    </div>
                    @endif
                </div>

                <form method="post" action="{{route('user.profile.update')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="First Name" value="{{ $user->name}}" required>
                                @if ($errors->has('name'))
                                    <br><span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                        </div>

                        <div class="form-group col-md-12">
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Your Email" value="{{ $user->email }}" required>
                                @if ($errors->has('email'))
                                    <br><span class="text-danger">{{ $errors->email('email') }}</span>
                                @endif
                        </div>


                        <div class="form-group col-md-12">
                            <div class="img-favicon">
                                @if(!empty($user->profile_photo_path))
                                <img src="{{asset('upload/frontend/profile/'.$user->profile_photo_path)}}"
                                    alt="{{$user->name}}" class="img-thumbnail" width="150" height="150">
                                @else
                                    <img src="{{asset('upload/backend/noimage.jpg')}}" alt="Profile Image"
                                         class="img-thumbnail">
                                @endif
                            </div>

                        </div>

                        <div class=" col-md-12 col-sm-12">
                            <div class="form-group">
                                <div role="button" class="btn btn-light mr-2 w-100">
                                    <input type="file" title='Click to add Files' name="profile_photo_path" class=""/>
                                    <br>
                                    @if ($errors->has('profile_photo_path'))
                                        <span class="text-danger">{{ $errors->first('profile_photo_path') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Update Profile</button>
                        </div>

                    </div>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
    <script>
        // Your custom JavaScript here...
    </script>
@endpush
