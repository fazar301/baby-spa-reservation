<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            //change this
            // $finduser = User::where('gauth_id', $user->id)->first();

            //to this
            $finduser = User::where('email', $user->email)->first();

            if($finduser){
                if(!$finduser->email_verified_at){
                    User::where('email', $finduser->email)->update(['email_verified_at' => now()]);
                }
                Auth::login($finduser);

                // Check if there's an intended URL in the session
                if (session()->has('intended')) {
                    $intendedUrl = session()->get('intended');
                    session()->forget('intended');
                    return redirect()->to($intendedUrl);
                }

                return redirect('/dashboard');

            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => 'customer',
                    'gauth_id'=> $user->id,
                    'gauth_type'=> 'google',
                    'email_verified_at' => now(),
                    'password' => Hash::make('admin@123')
                ]);

                Auth::login($newUser);

                // Check if there's an intended URL in the session
                if (session()->has('intended')) {
                    $intendedUrl = session()->get('intended');
                    session()->forget('intended');
                    return redirect()->to($intendedUrl);
                }

                return redirect('/dashboard');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
