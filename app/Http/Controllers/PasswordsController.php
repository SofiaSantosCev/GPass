<?php

namespace App\Http\Controllers;

use App\Passwords;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use App\User;

class PasswordsController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (parent::isLoggedIn())
            {   
                $passwords = Passwords::all();
                $passwordTitles = [];
                $passwordsIDs = [];

                if(empty($passwords))
                {
                    return parent::error(400,"There are no passwords created");
                } 

                foreach ($passwords as $password) {
                    array_push($passwordTitles, $passwords->title);
                    array_push($passwordsIDs, $passwords->id);
                } 
                return parent::success("Password created", [
                    
                ]);
            } else {
                return parent::error(403,"You don't have permission");
            }
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
        if (parent::isLoggedIn())
        {
            $title = $_POST['title'];

            if (!ctype_graph($title)) {
                return response("The title of the password cannot have any blank spaces", 400); exit;
            }

            if (empty($title)) {
                return response("The title of the password is empty", 400); exit;
            }

            $password = Passwords::where('title', $title)->first();

            if ($password != null) {
                if ($title != $password->title) {
                    return parent::error(400,"This password already exists"); exit;
                }
            }
                    
            $user_id = parent::getUserfromToken()->id; //id del usuario del token;

            $password = new Passwords;

            $password->title = $title;
            $password->user_id = $user_id;
            $password->category_id = $category_id

            $password->save();

        } else {
            return $this->error(403, "You don't have permission");
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Passwords  $passwords
     * @return \Illuminate\Http\Response
     */
    public function destroy(Passwords $passwords)
    {
        if (parent::isLoggedIn())
            {
                $passwordToDelete = Password::find($id);
                $passwordToDelete->delete();
            }
    }

    
}
