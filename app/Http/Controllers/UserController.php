<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("auth", ["except" => ["store"]]);
    }

    public function index()
    {
        $users = User::all();
        return $this->success($users, 200);
    }

    public function store(Request $request)
    {
        $userData = $this->validateRequest($request);
        $userData['password'] = Hash::make($userData['password']);
        $user = User::create($userData);
        return $this->success("The user with id {$user->id} has been created", 200);
    }

    public function show()
    {
        //
    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        //
    }

    public function validateRequest(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ];

        return $this->validate($request, $rules);
    }
}
