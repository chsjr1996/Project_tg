<?php

namespace App\Http\Controllers;

use App\Skills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SkillsController extends Controller
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
            
            // 
            $this->user = Auth::user();

            // Active data
            $this->setData();

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
     * View: Create a new skill
     * 
     * @return \Iluminate\Http\Response
     */
    public function new()
    {
        return view('admin.createSkills',['userData' => $this->data['userData']]);
    }

    /**
     * Create a new skill
     */
    public function create(Request $request)
    {

        // TODO: if possible, pass this method do validator class
        // Verify if skill already exists
        $ctrl = Skills::where('title', '=', $request->title)->first();
        
        // TODO: Improve return if already exists skills
        if (!$ctrl) {
            // Create a new skill
            Skills::create([
                'title' => $request->title
            ]);
        }

        return view('admin.createSkills',['userData' => $this->data['userData']]);
    }

    /**
     * Show skills list
     * 
     * @return \Iluminate\Http\Response
     */
    public function list()
    {
        $skills = DB::table('skills')->paginate(10);

        return view(
            'admin.skills',
            [
                'userData' => $this->data['userData'],
                'list'     => $skills
            ]
        );
    }
}
