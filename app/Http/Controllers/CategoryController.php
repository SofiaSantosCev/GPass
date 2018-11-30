<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\LoginController;

class CategoryController extends Controller
{

    private function IsLoggedIn()
    {
        $headers = getallheaders();
        if (!isset($headers['Authorization'])) 
        {
            return false;

        } else {
            
            $tokenDecoded = LoginController::decodeToken($headers['Authorization']);
            $user = User::where('email', $tokenDecoded->email)->first();
    
            if ($tokenDecoded->password == $user->password and $tokenDecoded->email == $user->email) 
            {
                return true;
            }
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //shows all categories 
    {
        if (self::isLoggedIn())
        {   
            $categories = Category::all();
            $categoryNames = [];

            if(empty($categories))
            {
                return response("There are no categories created",400);
            } else {
                foreach ($categories as $category) {
                    array_push($categoryNames, $category->name);
                } 
            }
            

        } else {
            return response("You don't have permission", 403);
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
        if (self::isLoggedIn())
        {
            $name = $_POST['name'];

            if (!ctype_graph($name)) {
                return response("The name of the category can't have any blank space", 400); exit;
            }

            if (empty($name)) {
                return response("The name of the category is empty", 400); exit;
            }

            $category = Category::where('name', $name)->first();

            if ($category != null) {
                if ($name != $category->name) {
                    return response("This category already exists",400); exit;
                }
            }
            

            $user_id = $_POST['user_id'];

            $category = new Category;

            $category->name = $name;
            $category->user_id = $user_id;

            $category->save();

        } else {
            return response("You don't have permission", 403);
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
    public function update($id, Request $request)
    {
        if (self::isLoggedIn()) {
             
            //$name = $request->get('name');
            $name = "sofia"; //Here must be the value introduced through the body
            Category::where('id', $id)->update(['name' => $name]);
            $categories = Category::where('name', $name)->first();
            
            if ($categories != null) {
                if ($name != $categories->name) {
                    return response("This category already exists",400); exit;
                }
            }

            if (!ctype_graph($name)) {
                return response("The name of the category can't have any blank space", 400); exit;
            }

            if (empty($name)) {
                return response("The name of the category is empty", 400); exit;
            }

        } else {
            return response("You don't have permission", 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (self::isLoggedIn()) {

            $categoryToDelete = Category::find($id);
            $categoryToDelete->delete();
        }

    }
}
