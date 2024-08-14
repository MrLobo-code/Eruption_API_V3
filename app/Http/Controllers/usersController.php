<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\admin_user;
use App\Models\productCart;
use App\Utils\Token;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class usersController extends Controller
{
    public function deleteCartItem(Request $request)
    {
        try {
            $credentials = $request->validate([
                'id' => 'required',
                'username' => 'required'
            ]);

            // $smartphone = DB::table($credentials["username"] . '_cart')->where('id', $credentials["username"])->delete();
            DB::table($credentials["username"] . '_cart')->where('id', $credentials["id"])->delete();
            return response()->json(
                [
                    'message' => 'Registro eliminado con éxito!!!'
                ],
                200
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    $e->getMessage()
                ],
                200
            );
        }
    }
    public function getCartItems(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
        ]);
        $wordlist = DB::table($credentials["username"] . '_cart')->select()->get();
        return response()->json($wordlist, 201);
    }
    public function cartProductCounter(Request $request)
    {
        try {
            $credentials = $request->validate([
                'username' => 'required',
            ]);
            // $wordlist = DB::table($credentials["username"])->where('id', '<=', $correctedComparisons)
            $wordlist = DB::table($credentials["username"] . '_cart')->select()->get();
            $wordCount = $wordlist->count();

            return response()->json([
                // 'message' => $wordCount
                $wordCount
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error al consultar items del carrito de compra',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function addToCart(Request $request)
    {
        try {
            $credentials = $request->validate([
                'username' => 'required',
                'ProductName' => 'required',
                'productDescription' => 'required',
                'Price' => 'required',
                'imgPath' => 'required'
            ]);

            DB::table($credentials["username"] . '_cart')->insert([
                'ProductName' => $request->ProductName,
                'productDescription' => $request->productDescription,
                'Price' => $request->Price,
                'imgPath' => $request->imgPath,
                // 'imgPath' => 'Empty temporarily...',
            ]);

            return response()->json([
                'respose' => 'Product added to the cart',
            ], 201);
        } catch (Exception $e) {
            return response()->json(
                [
                    'error' => 'Error adding product to the cart: ',
                    'message' => $e->getMessage(),
                    500
                ]
            );
        }
    }

    public function newUserCart($username)
    {
        $tablename = $username . '_cart';
        Schema::create($tablename, function (Blueprint $table) {
            $table->increments('id');
            $table->string('ProductName');
            $table->string('productDescription');
            $table->decimal('Price');
            $table->string('imgPath');
            // $table->id();
            // $table->string('name');
            // $table->string('email');
            // $table->timestamps();
        });
    }

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
            $new_admin_user->user_password  = hash::make($credentials["password"]);
            // $new_admin_user->user_password  = $credentials["password"];

            $new_admin_user->save();

            self::newUserCart($credentials["username"]);

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
                // ->where('user_password', $credentials['password'])
                ->first();

            if (!$userExist) {
                return response()->json([
                    // 'message' => 'Invalid username or password'
                    'message' => 'Invalid username'
                ], 401); // Unauthorized status code 
            }


            if (!Hash::check($credentials['password'], $userExist->user_password)) {
                return response()->json(
                    ['message' => 'Invalid password'], // Mensaje más claro
                    401
                );
            }

            $token = Token::generate($credentials['username'], $credentials['password']);
            return response()->json([
                'token' => $token,
                'username' => $credentials["username"],
                'message' => 'Bienvenid@ ' . $credentials["username"] . "!!!"

            ], 201);
        } catch (Exception $e) {
            return response()->json(
                ['message' => $e->getMessage()],
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
