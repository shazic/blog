<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Http\Controllers\AlertsController as Alert;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the request:
        $this->validate($request,[
            'name'  => 'required'
        ]);
        
        // create a new instance of the Category Model
        $category = new Category;
        $category->name = $request->name;

        // save to database
        $result = $category->save();

        // display success/failure message
        Alert::flashMessage($result, 'Category successfully created');

        // return to the create category page
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.categories.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate the request:
        $this->validate($request,[
            'name'  => 'required'
        ]);
        
        $category = Category::find($id);
        $category->name = $request->name;

        $result = $category->save();

        // display success/failure message
        Alert::flashMessage($result, 'Category successfully updated');

        return redirect()->route('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        // Delete all posts associated with the category, or else they would be left hanging in the database.
        
        foreach( $category->posts as $post) {
            $post->forceDelete(); // Since delete() will only soft delete the post.
        }

        $result=$category->delete();
        
        // display success/failure message
        Alert::flashMessage($result, 'Category successfully deleted');

        return redirect()->route('categories');
    }
}
