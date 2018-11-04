<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
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
     * 
     * @return string
     */
    public function viewProfile($id = null)
    {

        if (!$id) $id = $this->user->id;

        $user = User::where('id', $id)->get(
            [
                'name',
                'email',
                'user_photo'
            ]
        );

        // User data
        $userData = array(
            'id'        => $id,
            'name'      => $user[0]->name,
            'email'     => $user[0]->email,
            'photo'     => $user[0]->user_photo,
            'user_type' => 2
        );

        // Render view
        return view(
            'profile', [
                'userData' => json_decode(json_encode($userData)),
                'language' => app()->getLocale(),
                'view'     => 'profile'
            ]
        );
    }

    /**
     * 
     * @return string
     */
    public function loadSections($id = null)
    {
        // Validation
        if (!$id) $id = $this->user->id;

        // Verify that the profile belongs to the logged in user,
        // then define if sections is editable
        $editable     = false;

        if ($id == $this->user->id)
            $editable = true;

        // Sections
        $arrSection   = array();

        // Names
        $arrName      = array(
            0 => __('home.About'),
            1 => __('home.Experience'),
            2 => __('home.Education'),
            3 => __('home.Skills'),
            4 => 'Comments'
        );

        // Icons
        $arrIcons     = array(
            0 => 'fa-book-open',
            1 => 'fa-suitcase',
            2 => 'fa-graduation-cap',
            3 => 'fa-clipboard-check',
            4 => 'fa-comments'
        );

        // User data
        $user         = User::where('id', $id)->get(
            [
                'about',
                'experience',
                'education',
                'skills'
            ]
        );

        // Content
        $arrContent   = array(
            0 => $user[0]->about,
            1 => $user[0]->experience,
            2 => $user[0]->education,
            3 => $user[0]->skills,
            4 => ''
        );

        // Populate arrSection
        foreach ($arrName as $index => $name) {
            $arrSection[$index] = array(
                'id'      => $index,
                'name'    => $name,
                'icon'    => $arrIcons[$index],
                'content' => $arrContent[$index]
            );
        }

        $return = array(
            'editable' => $editable,
            'sections' => $arrSection
        );

        return response()->json($return);
    }

    /**
     * Update profile section.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateSection(Request $request) {
        
        // Get current user (active)
        $user_id = $this->user->id;
        
        // Get model data
        $user    = User::findOrFail($user_id);  

        // Sections
        $arrSection = array(
            0 => 'about',
            1 => 'experience',
            2 => 'education',
            3 => 'skills'
        );

        // Update specific section
        $field        = $arrSection[$request->id];
        $user->$field = $request->content;

        // Save data
        $user->save();

        unset($user, $arrSection, $field);

        // Return
        return response()->json('ok');
    }

    /**
     * Search profiles
     * 
     * @return \Illuminate\Http\Response
     */
    public function search($query)
    {

        $search   = [
            ['name','like','%' . $query . '%'],
            ['name', 'not like', 'Admin']
        ];

        $qResults = User::where($search)->count();

        $results  = User::where($search)
        ->limit(5)
        ->orderBy('name')
        ->get(
            [
                'id',
                'name'
            ]
        );

        $data = array(
            "total"   => $qResults,
            "results" => $results
        );

        // Return
        return response()->json($data);
    }
}
