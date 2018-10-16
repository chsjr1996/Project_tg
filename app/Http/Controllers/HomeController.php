<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\UsersTypeR;
use App\User;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  

        // Verify user type (save in session in first time)
        if (!Session::get('user_type')) {
            $userType = UsersTypeR::where('user_id', '=', $this->user->id)->first();
            
            Session::put('user_type', $userType->user_type_id);

            unset($userType);
        }

        // User data
        $userData = array(
            'id'        => $this->user->id,
            'name'      => $this->user->name,
            'email'     => $this->user->email,
            'photo'     => $this->user->user_photo,
            'user_type' => Session::get('user_type')
        );

        // Render view
        return view(
            'home', [
                'userData' => json_decode(json_encode($userData)),
                'language' => app()->getLocale(),
                'view'     => 'home'
            ]
        );
    }
}
