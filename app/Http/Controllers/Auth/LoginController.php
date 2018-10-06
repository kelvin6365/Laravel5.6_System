<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $userSocial = Socialite::driver('facebook')->user();
       

        //$newar = dd($user); show all data from fb
        $user = User::Where('email',$userSocial->user['email'])->first();
        if($user){
            if(Auth::loginUsingId($user->id)){

                return redirect()->route('home');
            }
            
        }
       
       $userSignup = User::create([
            'name' =>$userSocial->user['name'],
            'email'=>$userSocial->user['email'],
            'password'=>bcrypt('1234'),
            'avatar'=>$userSocial->avatar,
            'active'=>1,
            'reby' => 2,
         //   'facebook_profile'=>$userSocial->user['link'],
         //   'gender'=>$userSocial->user['gender'],

       ]);
    

       if($userSignup){
            if(Auth::loginUsingId($userSignup->id)){
                return redirect()->route('home');
            }
       }
        // $user->token;
     
    }
}
