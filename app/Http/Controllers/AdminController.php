<?php

namespace App\Http\Controllers;

use App\Skills;
use App\User;
use App\UsersTypeR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpParser\JsonDecoder;

class AdminController extends Controller
{
    /**
     * @var object
     */
    private $user;
    private $userData;

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
        $this->userData = array(
            'id'        => $this->user->id,
            'name'      => $this->user->name,
            'email'     => $this->user->email,
            'photo'     => $this->user->user_photo,
            'user_type' => Session::get('user_type')
        );
    }

    /**
     * Show the users list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show users list
     *
     * @return \Iluminate\Http\Response
     */
    public function listUsers()
    {
        // Active setData
        $this->setData();

        $users = DB::table('users')
                    ->join('users_type_rs', 'users.id', '=', 'users_type_rs.user_id')
                    ->paginate(10);

        return view(
            'admin.users',
            [
                'userData' => json_decode(json_encode($this->userData)),
                'list' => $users,
            ]
        );
    }
}
