<?php

namespace App\Http\Controllers;

use App\Events\NewUserRegisteredUsingSocial;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
       
            $finduser = User::where('google_id', $user->id)
                            ->orWhere('email', $user->email)->first();
       
            if($finduser){

                if($finduser->email == $user->email)
                {
                    $finduser->update([
                        'google_id'=> $user->id,
                    ]);
                }
       
                Auth::login($finduser);
      
                return redirect()->intended('home');
       
            }else{

                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => Hash::make('bla321'),
                ]);

                event(new NewUserRegisteredUsingSocial($user));
      
                Auth::login($newUser);
      
                return redirect()->intended('home');
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
