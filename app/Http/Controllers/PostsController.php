<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Category;
use App\Http\Controllers\AlertsController as Alert;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get all categories
        $categories = Category::all();

        // Check if categories exist
        if ( $categories->count() == 0 )    {
            Alert::flashMessage(false,
                                null,
                                'You need to add a category before creating a post', 
                                'info');
            return redirect()->back();
        }

        return view('admin.posts.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate user data
        $this->validate( $request, [
            'title'         => 'required|max:200',  // must be less than 200 chars
            'featured'      => 'image',             // uploaded file must be an image file
            'category_id'   => 'required',
            'content'       => 'required'
        ]);
        
        $featured = $request->featured;

        // Add a timestamp to the filename to avoid name conflicts
        $featured_new_name = time().$featured->getClientOriginalName();
        
        // Save the contents in the uploads folder
        $featured->move('uploads/posts', $featured_new_name);

        // Create the record in the database
        $post = Post::create([
            'title'         => $request->title,
            'slug'          => str_slug($request->title),
            'content'       => $request->content,
            'featured'      => 'uploads/posts/'.$featured_new_name,
            'category_id'   => $request->category_id
        ]);
        

        // display success/failure message
        Alert::flashMessage($post, 'Post successfully created');

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
        $post = Post::find($id);
        $categories = Category::all();
        //$back = redirect()->back();

        return view('admin.posts.edit')->with('post', $post)
                                       ->with('categories', $categories)
        //                               ->with('goback', $back->targetUrl) // $targetUrl is protected, cannot access directly
        ;
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
        // Validate user data
        $this->validate( $request, [
            'title'         => 'required|max:200',  // must be less than 200 chars
            'category_id'   => 'required',
            'content'       => 'required'
        ]);
        
        $post = Post::find($id);

        if ($request->hasFile('featured'))  {
            $featured = $request->featured;

            // Add a timestamp to the filename to avoid name conflicts
            $featured_new_name = time().$featured->getClientOriginalName();
        
            // Save the contents in the uploads folder
            $featured->move('uploads/posts', $featured_new_name);

            $post->featured = 'uploads/posts/'.$featured_new_name;   
        }

        $post->title        = $request->title;
        $post->category_id  = $request->category_id;
        $post->content      = $request->content;
        
        $result = $post->save();

        Alert::flashMessage($result, 'Post update successfully');

        return redirect()->back();
    }

    /**
     * Remove (soft delete) the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function softDestroy($id)
    {
        $post = Post::find($id);

        $result = $post->delete();

        Alert::flashMessage($result, 'Post successfully moved to trash');

        return redirect()->back();

    }

    /**
     * Display a listing of the trashed (soft-deleted) resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashedIndex()
    {
        $posts = Post::onlyTrashed()->get();

        return view('admin.posts.trashed')->with('posts', $posts);
    }

    /**
     * Restore the specified resource on the storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $post = Post::onlyTrashed()->find($id);

        $result = $post->restore();

        Alert::flashMessage($result, 'Post successfully restored');

        return redirect()->back();

    }

    /**
     * Remove (permanent delete) the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::onlyTrashed()->find($id);
        //$post = Post::withTrashed()->where('id', $id)->first();  // alternate method

        $result = $post->forceDelete();

        Alert::flashMessage($result, 'Post removed permanently');

        return redirect()->back();

    }
}
