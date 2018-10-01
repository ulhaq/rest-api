<?php
namespace App\Http\Controllers\Api;

use JWTAuth;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
            $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'), 201);
    }

    /**
     * API Login, on success return JWT Auth token
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make($credentials, $rules);

        if($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->messages()
            ]);
        }

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'We can`t find an account with this credentials.'
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to login, please try again.'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'data'=> [
                'token' => $token
            ]
        ]);
    }

    /**
     * Logout
     * Invalidate the token. User have to relogin to get a new token.
     * @param Request $request 'header'
     */
    public function logout(Request $request)
    {
        $token = $request->header('Authorization');

        try {
            JWTAuth::invalidate($token);

            return response()->json([
                'status' => 'success',
                'message'=> "User successfully logged out."
            ]);

        } catch (JWTException $e) {
            return response()->json([
              'status' => 'error',
              'message' => 'Failed to logout, please try again.'
            ], 500);
        }
    }
}
