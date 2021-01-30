<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public  function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        $users = User::all()->sortBy('name');

        return view('users.index', [
            'users' => $users,
        ]);
    }
}
