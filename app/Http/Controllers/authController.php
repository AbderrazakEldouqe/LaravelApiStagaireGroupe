<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\JWT;


class authController extends Controller
{
    public function login(Request $request)
    {
        $input = $request->all();
        $token = null;
        if (!$token =JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }
        public function register(Request $request)
        {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

       /*     if ($this->loginAfterSignUp) {
                return $this->login($request);
            }*/

            return response()->json([
                'success'   =>  true,
                'data'      =>  $user
            ], 200);
        }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }




}
