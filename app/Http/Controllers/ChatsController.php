<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    /**
     * Render chat view
     * 
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
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
            'chat', [
                'userData' => json_decode(json_encode($userData)),
                'language' => app()->getLocale(),
                'receptor' => json_encode(array("id" => $id, "name" => $userData['name'])),
                'view'     => 'chat'
            ]
        );
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages($receptor_id)
    {

        // Get send messages
        $searchTo = [
            ['user_id', '=', $this->user->id],
            ['receptor_id', '=', $receptor_id]
        ];

        // Get receiver messages
        $searchFrom = [
            ['user_id', '=', $receptor_id],
            ['receptor_id', '=', $this->user->id]
        ];

        $messages = Message::where($searchTo)->orWhere($searchFrom)->get();

        // Get receptor's name
        $receptor    = User::where('id', $receptor_id)->orderBy('created_at')->get(['name']);

        // Array for message data
        $data        = array();

        // Array for names
        $arrNames    = array(
            $this->user->id => 'Me',
            $receptor_id    => $receptor[0]->name
        );

        foreach ($messages as $key => $value) {

            $data[] = array(
                'id'         => $value->id,
                'user_id'    => $value->user_id,
                'user_name'  => $arrNames[$value->user_id],
                'created_at' => $value->created_at,
                'text'       => $value->message
            );
        }

        return json_encode($data);
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        // Save message
        $message = Message::create([
            'user_id'     => $this->user->id,
            'receptor_id' => $request->data['receptor'],
            'message'     => $request->data['text']
        ]);

        return response()->json('ok');        
    }
}
