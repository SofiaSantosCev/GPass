<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\User;

class CategoryController extends Controller
{

    private function IsLoggedIn()
    {

        if (!isset($headers['Authorization'])) 
        {
            return response("No tienes permisos", 403);   
        }

        $headers = getallheaders();
        $password = User::where($headers['password'] == $tokenDecoded->password);
        $email = User::where($headers['email'] == $tokenDecoded->email);

        $tokenDecoded = decodeToken($request->header('Authorization'));

        if ($tokenDecoded->password == $user->password and $tokenDecoded->email == $user->email) 
        {
            return true;
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
        if (self::isLoggedIn())
        {
            $name = $_POST['name'];
            $user_id = $_POST['user_id'];

            $category = new Category;

            $category->name = $name;
            $category->user_id = $user_id;

            $category->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
