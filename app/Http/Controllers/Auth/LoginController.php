<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use App\User;
use App\Playlist;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

        /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */

      public function home()
    {
        $playlists = Playlist::orderBy('created_at','desc')->get();
        return view('home',['playlists'=>$playlists]);
    }
       
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        $playlists = Playlist::all();
      //  $userName = $user->getName();
        return view('home',['playlists'=>$playlists]);
       // return $user->getEmail();

        // $user->token;
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_user_id',$user->id)->first();
        if($authUser)
            return $authUser;
        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'provider' => $provider,
            'provider_user_id' => $user->id
            ]);
    }

    public function logout()
    {
       // return "Goodbye!";
        Auth::logout();
        return view('home');
    }
}
