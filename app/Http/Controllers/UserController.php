<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_name'  => 'required',
            'password'  => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'error'   => 17,
                'Message' => $validator->errors()->all()
            ], 400);
        }

        $user = User::where('user_name', $request->user_name)->first();

        if ($user->status == "new")
        {
            if (Hash::check($request->password, $user->password))
            {
                return response()->json([
                    "token" => "Bearer ".$user->createToken('token')->accessToken
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
}
