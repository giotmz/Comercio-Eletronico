<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rules\Password;
use Illuminate\Http\{
    JsonResponse, Request
};
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'require|email|unique:users',
            'password' => ['required', Password::min(8)],
            'address' => 'string',
        ]);

        return ;
    }
}
