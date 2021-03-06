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
     * @var array
     */
    private $data;

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
     * Magic methods
     */
    public function __set($prop, $value)
    {
        if ($prop && $value) $this->data[$prop] = $value;
    }

    public function __get($prop)
    {
        return isset($this->data[$prop]) ? $this->data[$prop] : null;
    }

    /**
     * Set user data
     * 
     * @return void
     */
    private function setData()
    {
        // TODO: Define a file to store this function, because this is used in multiples controllers
        // Verify user type (save in session in first time)
        if (!Session::get('user_type')) {
            $userType = UsersTypeR::where('user_id', '=', $this->user->id)->first();

            Session::put('user_type', $userType->user_type_id);

            unset($userType);
        }

        // User data
        $this->data['userData'] = json_decode(
            json_encode(
                array(
                    'id'        => $this->user->id,
                    'name'      => $this->user->name,
                    'email'     => $this->user->email,
                    'photo'     => $this->user->user_photo,
                    'user_type' => Session::get('user_type')
                )
            )
        );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Active setData
        $this->setData();

        // Render view
        return view(
            'home', [
                'userData' => $this->data['userData'],
                'language' => app()->getLocale(),
                'view'     => 'home'
            ]
        );
    }
}
