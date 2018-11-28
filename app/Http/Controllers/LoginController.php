<?php

namespace App\Http\Controllers;

use App\Login;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use App\Users;
use Auth;

class LoginController extends Controller
{

    public function login()
    {
        $key = 'bHH2JilgwA3YxOqwn';

        $user = Users::where('email', $_POST['email'])->first();

        if ($user->email == $_POST['email'] and $user->password == $_POST['password'])
        {
            $dataToken =[
                'user' => $user, 
                'password' => $user->password,
                'random' => time()
            ];

            $token = JWT::encode($dataToken, $key);         

            $tokenDecoded = JWT::decode($token, $key, array('HS256'));

            return response()->json([
                
                'token' => $token
            ]);

        } else {
            response("ese usuario no existe", 403);
        }
        
    } 

    public static function decodeToken($token)
    {
        $key = 'bHH2JilgwA3YxOqwn';
        $tokenDecoded = JWT::decode($token, $key, array('HS256'));
        return $tokenDecoded;
    }

         
}