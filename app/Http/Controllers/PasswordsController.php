<?php

namespace App\Http\Controllers;

use App\Passwords;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use App\User;

class PasswordsController extends Controller
{

    private function IsLoggedIn()
    {
        $headers = getallheaders();

        if (!isset($headers['Authorization'])) 
        {
            return response("No tienes permisos", 403);   
        }

        $headers = User::getallheaders();
        $password = User::where($headers['password'] == $user->password);
        $email = User::where($headers['email'] == $user->email);

        $tokenDecoded = decodeToken($request->header('Authorization');

        if ($tokenDecoded->password == $user->password and $tokenDecoded->email == $user->email) 
        {
            
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($loggedIn)
        {
            $title = $_POST['title'];
            $password = $_POST['password'];
            $category_id = $_POST['category_id'];
            $user_id = $_POST['user_id']; //asignar id del usuario que lo crea

            $newPassword = new Passwords;

            $newPassword->title = $title;
            $newPassword->password = $password;
            $newPassword->category_id = $category_id;
            $newPassword->user_id = $user_id;

            $newPassword->save();
        
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Passwords  $passwords
     * @return \Illuminate\Http\Response
     */
    public function show(Passwords $passwords)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Passwords  $passwords
     * @return \Illuminate\Http\Response
     */
    public function edit(Passwords $passwords)
    {
        if ($loggedIn)
        {
            
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Passwords  $passwords
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Passwords $passwords)
    {
        if ($loggedIn)
        {
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Passwords  $passwords
     * @return \Illuminate\Http\Response
     */
    public function destroy(Passwords $passwords)
    {
        if ($loggedIn)
        {
            
        }
    }

    
}
