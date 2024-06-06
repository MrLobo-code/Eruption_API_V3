<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\admin_user;
use App\Utils\Token;

class usersController extends Controller
{
    public function createUser(Request $request)
    {
        try {
            $credentials = $request->validate([
                'username' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);

            $new_admin_user = new admin_user();

            $new_admin_user->username = $credentials["username"];
            $new_admin_user->email = $credentials["email"];
            // $new_admin_user->user_password  = hash('sha512', $credentials["password"]);
            $new_admin_user->user_password  = $credentials["password"];

            $new_admin_user->save();

            return response()->json([
                'respose' => 'Usuario creado con éxito!'
            ], 201);
        } catch (Exception $e) {
            return response()->json(
                $e,
                500
            );
        }
    }
    public function userAuth(Request $request)
    {
        try {
            $credentials = $request->validate([
                'username' => 'required',
                'password' => 'required',
                // 'email' => 'required'
            ]);

            // $userExist = admin_user::select('admin_users.username', 'admin_users.user_password', 'admin_users.email')
            $userExist = admin_user::select('admin_users.username', 'admin_users.user_password')
                ->where('username', $credentials['username'])
                ->where('user_password', $credentials['password'])
                // ->where('email', $credentials['email'])
                ->first();

            if (!$userExist) {
                return response()->json([
                    'message' => 'Invalid username or password'
                ], 401); // Unauthorized status code 
            }

            $token = Token::generate($credentials['username'], $credentials['password']);
            return response()->json([
                'token' => $token,
                'username' => $credentials["username"],
                'message' => 'Bienvenid@ ' . $credentials["username"] . "!!!"

            ], 201);
        } catch (Exception $e) {
            return response()->json(
                $e,
                500
            );
        }
    }

    public function getUsers()
    {
        $users = admin_user::all();
        return response()->json($users, 200);
    }
}
