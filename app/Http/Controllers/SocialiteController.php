<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    //
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
    
            // Inspect the $googleUser object
            if (is_null($googleUser)) {
                return redirect('/login')->with('error', 'Failed to retrieve user from Google.');
            }
    
            $email = $googleUser->getEmail();
          
    
            // Find or create the user based on the email
            $user = User::where('email', $email)->first();
            if ($user) {
                Auth::login($user, true);
                return redirect('/dashboard'); // Redirect to the desired route for existing users
            }
            else {
                // User does not exist, create a new user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $email,
                    'google_id' => $googleUser->getId(),
                ]);
    
                // Log the new user in
                Auth::login($user, true);
                return redirect('/dashboard'); // Redirect to the home page for new users
            }

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Unable to login. Please try again. ' . $e->getMessage());
        }
    }
    
}

