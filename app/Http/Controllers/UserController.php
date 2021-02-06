<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Exception;

class UserController extends Controller
{

    public  function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        $users = User::all()->sortByDesc('role_id');

        if (Gate::allows('isAdmin', Auth::user())) {
            return view('users.index', [
                'users' => $users,
            ]);
        }else{
            return redirect()->route('properties.index')->with('message-denied', 'You are not authorised to access this page.'); 
        };
    }

    public function edit($userId) {

        $userId = User::findOrFail($userId);

        if (Gate::allows('isAdmin', Auth::user())) {
            return view('users.edit', [
                'userId' =>  $userId,
            ]);
        }else{
            return redirect()->route('properties.index')->with('message-denied', 'Easy there, tiger. Are you really trying to breach our state-of-the-art cyber security?'); 
        };
    }

    public function update(Request $request, $userId) {

        $validator = $this->validateUpdate($request);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $userId = User::findOrFail($userId);
        $userId->role_id = $request->get('role_id');

        $userId->save();

        return redirect()->route('users.index')->with('message', 'User successfully updated');        
    }

    private function validateUpdate(Request $request)
    {

        $requirements = array(
            'role_id' => 'digits:1|starts_with:1,2,3',
        );

        $customMessages = [
            'role_id.digits' => "Only 1 digit allowed.",
            'role_id.starts_with' => "'1' for Customer, '2' for Broker, '3' for Administrator.",
        ];

        return Validator::make($request->all(), $requirements, $customMessages);
    }
}
