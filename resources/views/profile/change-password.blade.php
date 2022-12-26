@extends('layouts.guest')

@section('title', 'Change Password')

@push('css')
    <style type="text/css">
        /*-- your custom css here --*/

    </style>
@endpush


@section('content')

<section class="hm-banner">
    <div class="container">
        <div class="col text-center mb-5">
            <h2>Change Password</h2>
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

                <form method="post" action="{{route('user.update.password')}}">
                    @csrf
                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <input id="current_password" type="password" class="form-control" placeholder="Current-password" name="current_password" autocomplete="current-password">
                            @if ($errors->has('current_password'))
                                <br><span class="text-danger">{{ $errors->first('current_password') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-12">
                            <input id="password" type="password" placeholder="New Password" class="form-control" name="password" autocomplete="current-password">
                            @if ($errors->has('password'))
                                <br><span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-12">
                            <input id="password_confirmation" type="password" placeholder="New Confirm Password" class="form-control" name="password_confirmation" autocomplete="current-password">
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Update Password</button>
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
