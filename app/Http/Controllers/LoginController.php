<?php

namespace App\Http\Controllers;

use App\Login;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use App\User;
use Auth;

class LoginController extends Controller
{
    public function login()
    {
        $key = 'bHH2JilgwA3YxOqwn';

        $user = User::where('email', $_POST['email'])->first();

        $verifiedPassword = password_verify($_POST['password'], $user->password);
        if ($user->email == $_POST['email'] and $verifiedPassword)
        {
            $dataToken =[
                'email' => $user->email, 
                'password' => $user->password,
                'random' => time()
            ];

            $token = JWT::encode($dataToken, $key);         

            $tokenDecoded = JWT::decode($token, $key, array('HS256'));


            return response()->json([
                'token' => $token

            ]);

        } else {
            return response("ese usuario no existe", 403); 
        }
    }

    public static function decodeToken($token)
    {
        $key = 'bHH2JilgwA3YxOqwn';
        $tokenDecoded = JWT::decode($token, $key, array('HS256'));
        return $tokenDecoded;
    }
         
}