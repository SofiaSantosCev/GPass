<?php

namespace App\Http\Controllers;

use App\Login;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;

class LoginController extends Controller
{
    const USER = 0;
    const PASS = 1;
    
    public function login()
    {
        $key = 'bHH2JilgwA3YxOqwn';

        $userDB = [
            self::USER => "julio", 
            self::PASS => "1234"
        ];
        

        if ($userDB[self::USER] == $_POST['user'] and $userDB[self::PASS] == $_POST['pass'])
        {
            $dataToken =[
                'user' => $userDB[self::USER], 
                'pass' => $userDB[self::PASS],
                'random' => time()
            ];

            $token = JWT::encode($dataToken, $key);
            return response()->json([
            'token' => $token
        ]);


        } else {
            response("na nai", 403);
        }
        
    }    
}