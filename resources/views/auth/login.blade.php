@extends('layouts.guest')

@section('title', 'Login')

@push('css')
<style type="text/css">
    /*-- your custom css here --*/
</style>
@endpush


@section('content')

<!-- SIGN-IN SECTION -->
<div class="login">
    <div class="login__content">


        <div class="login__forms">
            @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
            @endif
            <form method="POST" action="{{ route('login') }}" class="login__registre" id="login-in">
                @csrf
                <h1 class="login__title">Sign In</h1>

                <div class="login__box">
                    <i class="fa fa-user login__icon" aria-hidden="true"></i>
                    <input type="email" placeholder="{{ __('Email') }}" class="login__input" name="email" id="email" required>
                </div>

                <div class="login__box">
                    <i class="fa fa-lock login__icon" aria-hidden="true"></i>
                    <input type="password" name="password" autocomplete="current-password" placeholder="{{ __('Password') }}" class="login__input" required>
                </div>
                <div class="row mt-4">
                    <div class="col text-left mt-2">
                        <input type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            id="remember_me" name="remember">
                        <span class="ml-1 text-sm text-gray-600">Remember me</span>
                    </div>
                    <div class="col">
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="login__forgot">{{ __('Forgot your password?') }}</a>
                        @endif
                    </div>
                </div>


                <button type="submit" class="login__button" id="login-button">{{ __('Log in') }}</button>




                <div>
                    <span class="login__account">Don't have an Account ?</span>
                    <a href="{{ route('register') }}" class=""><span class="login__signin" >Sign Up</span></a>

                </div>
            </form>

        </div>
    </div>
</div>
<!-- END SIGN-IN SECTION -->

@endsection


