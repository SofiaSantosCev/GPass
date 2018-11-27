<?php

namespace App\Http\Controllers;

use App\Login;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use App\Users;
use Auth;

class LoginController extends Controller
{
    //$loggedIn = false;

    public function login()
    {
        $key = 'bHH2JilgwA3YxOqwn';

        $user = Users::where('email', $_POST['email'])->first();

        if ($user->email == $_POST['email'] and $user->password == $_POST['password'])
        {
            $dataToken =[
                'user' => $user, 
                'pass' => $user->password,
                'random' => time()
            ];

            $token = JWT::encode($dataToken, $key);         

            $tokenDecoded = JWT::decode($token, $key, array('HS256'));

            return response()->json([
                
                'token' => $token
                /*$loggedIn = true;
                var_dump($loggedIn);*/
            ]);

        } else {
            response("ese usuario no existe", 403);
        }
        
    } 

   /* public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
        $loggedIn = false;
        var_dump($loggedIn);
    }

    public function resetPassword()
    {

    }*/
         
}