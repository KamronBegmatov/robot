<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserFromGoogle;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class UserFromGoogleController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function callback(){
        try {
            $userFromGoogle = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return response()->json('sorry');
        }
        // only allow people with @company.com to login
//            if(explode("@", $userFromGoogle->email)[1] !== 'company.com'){
//                return redirect()->to('/');
//            }
        // check if they're an existing user
        $existingUser = UserFromGoogle::where('email', $userFromGoogle->email)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $newUser                  = new UserFromGoogle();
            $newUser->name            = $userFromGoogle->name;
            $newUser->email           = $userFromGoogle->email;
            $newUser->google_id       = $userFromGoogle->id;
            $newUser->avatar          = $userFromGoogle->avatar;
            $newUser->avatar_original = $userFromGoogle->avatar_original;
            $newUser->save();
            auth()->login($newUser, true);
        }
        //return redirect()->to('localhost:8000');
        return response()->json('successfull');

        // $userFromGoogle->token
    }
}
