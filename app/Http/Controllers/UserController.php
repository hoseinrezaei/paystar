<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator::make($request->json()->all(),[
            'email'  => 'required',
            'password'  => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'error'   => 17,
                'Message' => $validator->errors()->all()
            ], 400);
        }

        $user = User::where('email', $request->email)->first();

        if (Hash::check($request->password, $user->password))
        {
            return response()->json([
                "token" => $user->createToken('token')->accessToken
            ],200);
        }
        else
        {
            return response()->json([
                "msg"   => ["password is wrong"]
            ],400);
        }

    }
}
