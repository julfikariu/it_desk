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

                <form method="POST" action="{{ route('register') }}" class="login__create " id="login-up">
                    @csrf
                    <h1 class="login__title">Create Account</h1>

                    <div class="login__box">
                        <i class='bx bx-user login__icon'></i>
                        <input type="text" name="name" placeholder="Username" class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-at login__icon'></i>
                        <input type="text" name="email" placeholder="Email" class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" name="password" placeholder="Password" class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="login__input">
                    </div>

                    <button type="submit" class="login__button">{{ __('Sign Up') }}</button>
                    <div>
                        <span class="login__account">Already have an Account ?</span>
                        <a href="{{ route('login') }}" class=""> <span class="login__signup" >Sign In</span></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END SIGN-IN SECTION -->

@endsection

