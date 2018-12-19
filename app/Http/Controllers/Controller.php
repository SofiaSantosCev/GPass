<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use \Firebase\JWT\JWT;
use App\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function error($code, $message)
    {
    	$json = ['message'=> $message];
    	$json = json_encode($json);
    	return response($json, $code)->header('Access-Control-Allow-Origin', '*');
    }

    protected function success($message, $data = [])
    {
    	$json = ['message'=> $message, 'data' => $data];
    	$json = json_encode($json);
    	return response($json, 200)->withHeaders([
            'Content-Type' => 'application/json',
            'Access-Control-Allow-Origin' => '*',
        ]);
    }

    protected function returnToken($dataToken)
    {
        $key = 'bHH2JilgwA3YxOqwn';

        $token = JWT::encode($dataToken, $key);         

        return $token;
    }

    protected function decodeToken($token)
    {
        $key = 'bHH2JilgwA3YxOqwn';
        $tokenDecoded = JWT::decode($token, $key, array('HS256'));
        return $tokenDecoded;
    }

    protected function IsLoggedIn()
    {
       	$headers = getallheaders();
        if (!isset($headers['Authorization'])) 
        {
            return false;
        } else {
            $user = self::getUserfromToken();
            var_dump($user);exit;
            $tokenDecoded = self::decodeToken($headers['Authorization']);
            if ($tokenDecoded->password == $user->password and $tokenDecoded->email == $user->email) 
            {
                return true;
            }
        }
    }

   	protected function getUserfromToken()
    {
        $headers = getallheaders();
        $tokenDecoded = self::decodeToken($headers['Authorization']);
        $email = $tokenDecoded->email;
        $user = User::where('email', $email)->first();
                var_dump($email);exit;

        return $user;
    }
}
