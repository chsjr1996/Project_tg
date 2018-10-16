<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserSetup;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Create a new controller instance
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
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    // public function show($id)
    // {
    //     return view('user.profile', ['user' => User::findOrFail($id)]);
    // }

    /**
     * Show the profile for the given user.
     *
     * @return Response
     */
    public function setupAccount()
    {
        // Get current user (active)
        $id = $this->user->id;

        return view('user.setup', ['user' => User::findOrFail($id)]);
    }

    /**
     * Update data account
     * 
     */
    public function updateAccount(UserSetup $request)
    {
        // Get current user (active)
        $id = $this->user->id;

        // Find user
        $user = User::findOrFail($id);

        // Validate
        $validated = $request->validated();

        // Fields
        $user->name = $request->name;

        // Verify image upload
        if ($request->hasFile('user_photo')) {

            // Add time to photo name
            $photoName = time();
            
            // Concatenates time with extension
            $photoName.= "." . $request
            ->user_photo
            ->getClientOriginalExtension();
            
            // Move photo to server (public/avatars)
            $request->user_photo->move(
                public_path('avatars'),
                $photoName
            );

            $user->user_photo = $photoName;
        }

        // Update user data
        $user->save();

        // Success message
        \Session::flash('success', __('Successful update'));

        // Redirect
        return redirect('user/setup');
    }
}