<?php
namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\LoginController;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //shows all categories 
    {
        if (parent::isLoggedIn())
        {   
            $categories = Category::all();
            $categoryNames = [];
            $categoryIDs = [];

            if(empty($categories))
            {
                return parent::error(400,"There are no categories created");
            } 

            foreach ($categories as $category) {
                array_push($categoryNames, $category->name);
                array_push($categoryIDs, $category->id);
            } 
            return response($categories);
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
            $name = $_POST['name'];

            if (!ctype_graph($name)) {
                return response("The name of the category can't have any blank space", 400);
            }

            if (empty($name)) {
                return response("The name of the category is empty", 400);
            }

            $category = Category::where('name', $name)->first();

            if ($category != null) {
                if ($name != $category->name) {
                    return parent::error(400,"This category already exists");
                }
            }
                    
            $user_id = parent::getUserfromToken()->id; //id del usuario del token;

            $category = new Category;

            $category->name = $name;
            $category->user_id = $user_id;

            $category->save();

            return parent::success("Categoria Creada","");

            } else {
                return $this->error(403, "You don't have permission");
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
        if (self::isLoggedIn()) 
        {

            //$name = $request->get('name');
            $name = "sofia";
            Category::where('id', $id)->update(['name' => $name]);
            $categories = Category::where('name', $name)->first();
                
            if ($categories != null)
            {
                if ($name != $categories->name)
                {
                    return parent::error(400, "This category already exists"); 
                }
            }

            if (!ctype_graph($name))
            {
                return parent::error(400, "The name of the category can't have any blank space"); 
            }

            if (empty($name))
            {
                return parent::error(400, "The name of the category is empty"); 
            }

        } else {
            return parent::error(403, "You don't have permission");
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
        if (parent::isLoggedIn())
        {
            $categoryToDelete = Category::find($id);
            $categoryToDelete->delete();
        }
    }
}
