<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function socialLoginRedirect($platform)
    {
        try {

            return Socialite::driver($platform)->redirect();
        } catch (\Exception $th) {
//            return back()->with('error', $th->getMessage());
            return view('error.404');
        }
    }

    public function socialLoginCallback($platform)
    {
        $user = Socialite::driver($platform)->user();

        $existingUser = User::where('email', $user->email)->first();
        if ($existingUser) {
            //login and redirect
            Auth::login($existingUser);
            //mocking route and redirect to prefered dashboard
            return redirect()->route('login');
        }

        try {

            $user = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => now(),
                'profile_photo' => $user->avatar,
                'user_type' => 'USR',
                'provider' => $platform,
                'oauth_token' => $user->token
            ]);

            $user = User::find($user->id);

            //login and redirect
            Auth::login($user);
        } catch (\Exception $th) {
//            return back()->with('error', $th->getMessage());
            return view('error.404');
        }

        //mocking route and redirect to prefered dashboard
        return redirect()->route('/');
    }
}
