@extends('layouts.guest')

@section('title', 'Login')

@push('css')
<style type="text/css">
    /*-- your custom css here --*/
</style>
@endpush


@section('content')

<!-- SIGN-IN SECTION -->
<div class="">
    <div class="login__content ml-3">
        <div class="login__img notfound">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="">
                    <img src="{{asset('frontend/images/not-found-error.png')}}" class="img-fluid w-75 mx-auto" alt="">
                    <p class="text-center w-75 mx-auto mt-2 text-danger">The page you are looking for might have been removed had its name changed or is temporarily unavailable. </p>
                </div>
                
            </div>
        </div>

    </div>
</div>
<!-- END SIGN-IN SECTION -->

@endsection

@push('scripts')
<script src="{{asset('frontend/js/custom-js/sign-in.js')}}" defer></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush
