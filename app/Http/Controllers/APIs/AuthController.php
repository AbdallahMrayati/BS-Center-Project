<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    // Login API - POST (name, password)

    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'login' => 'required|string', // Can be name or email
            'password' => 'required|string',
        ]);

        // Determine if login is by email or name
        $credentials = $this->getCredentials($request);


        // Attempt authentication
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid credentials',
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Could not create token',
            ], 500);
        }

        // Authentication successful, return the token and user info
        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $token,
            'user' => Auth::user(),
        ]);
    }

    // Logout function
    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json([
                'status' => true,
                'message' => 'Successfully logged out',
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to log out, please try again',
            ], 500);
        }
    }

    // Helper function to determine if login is by email or name
    private function getCredentials(Request $request)
    {
        $login = $request->input('login');

        // Check if the login input is an email or name
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        return [
            $field => $login,
            'password' => $request->password,
        ];
    }


    // public function login(Request $request)
    // {
    //     try {
    //         // Check if name and password are present in the request
    //         if (!$request->has('name') || !$request->has('password')) {
    //             return response()->json(['message' => 'name and password are required'], 400);
    //         }

    //         // Validation
    //         $request->validate([
    //             "name" => "required|string",
    //             "password" => "required"
    //         ]);

    //         // Attempt to authenticate the user
    //         $token = auth()->attempt([
    //             "name" => $request->name,
    //             "password" => $request->password
    //         ]);

    //         if (!$token) {
    //             return response()->json([
    //                 "status" => false,
    //                 "message" => "Invalid login details"
    //             ], 401);
    //         }

    //         // Get the authenticated user
    //         $user = auth()->user();

    //         return response()->json([
    //             "status" => true,
    //             "message" => "User logged in",
    //             "token" => $token,
    //             "user" => $user,
    //         ]);
    //     } catch (Exception $e) {
    //         return response()->json([
    //             "status" => false,
    //             "message" => "An error occurred during login",
    //             "error" => $e->getMessage()
    //         ], 500);
    //     }
    // }
    // // Logout API - GET (JWT Auth Token)
    // public function logout()
    // {
    //     try {
    //         JWTAuth::invalidate(JWTAuth::getToken()); // Use JWT facade to invalidate token

    //         return response()->json([
    //             "status" => true,
    //             "message" => "User logged out"
    //         ]);
    //     } catch (Exception $e) {
    //         return response()->json([
    //             "status" => false,
    //             "message" => "An error occurred during logout",
    //             "error" => $e->getMessage()
    //         ], 500);
    //     }
    // }
}