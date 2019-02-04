<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $user = User::create([
            "name" => $request->get("name"),
            "email" => $request->get("email")
        ]);

        return response()->json(["message" => "The user with id {$user->id} has been successfully created." ], 201);
    }

    public function getusers()
    {
        $users = User::all();
        return $users;
    }

    public function getUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(["message" => "User not found."], 404);
        }

        return $user;

    }
}
