<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                "name" => "required|string",
                "surname" => "required|string",
                "birth_date" => "required|date",
                "email" => "required|email",
                "password" => "required|string",
            ]
        );

        $user = User::create($data);

        
    }

}
