<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the users list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
                    ->join('users_type_rs', 'users.id', '=', 'users_type_rs.user_id')
                    ->paginate(10);

        return view('admin.users', ['users' => $users]);
    }
}
