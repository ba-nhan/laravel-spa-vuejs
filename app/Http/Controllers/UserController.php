<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray()
            ], 200);
    }

    public function show(Request $request, $id)
    {
        $user = User::find($id);

        return response()->json(
            [
                'status' => 'success',
                'user' => $user->toArray()
            ], 200);
    }

    public function getUser(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        $userId = $user->id;
        $response = array(
            'status' => 'error',
            'response_code' => 201,
            'message' => 'Not a valid user'
        );
        if ($user) {
            $response = array(
                'status' => 'success',
                'response_code' => 200,
                'message' => 'Get user profile',
                'data' => array()
            );
        }
        return response()->json($response);
    }
}