<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route to the user's home page
//Route::get('/home', 'HomeController@index')->name('home');

// Create a Route Group for Admin, for pages that would require an authenticated user:
Route::group( [
    'prefix'        => 'admin',
    'middleware'    => 'auth'

    ],    

    function()  {

        // Route to the user's home page
        Route::get('/home', 'HomeController@index')->name('home');

        // Route to display an index of all posts
        Route::get('posts', 'PostsController@index')->name('posts');
        //Route to view trashed posts
        Route::get('trashed', 'PostsController@trashedIndex')->name('trashed');
        // All routes for the PostsController
        Route::prefix('post')->group( function()  {
            // Route to the create post 
            Route::get('create', 'PostsController@create')->name('post.create');
            // Route to the store a new post 
            Route::post('store', 'PostsController@store')->name('post.store');
            //Route to edit an existing posts
            Route::get('edit{id}', 'PostsController@edit')->name('post.edit');
            //Route to update an existing posts
            Route::post('update{id}', 'PostsController@update')->name('post.update');
            //Route to delete an existing post (send to trash)
            Route::get('delete{id}', 'PostsController@softDestroy')->name('post.delete');
            //Route to restore trashed posts
            Route::get('restore{id}', 'PostsController@restore')->name('post.restore');
            //Route to permanently delete trashed posts
            Route::get('destroy{id}', 'PostsController@destroy')->name('post.destroy');
        });  

        // Route to display an index of all categories
        Route::get('categories', 'CategoriesController@index')->name('categories');
        // All routes for the CategoriesController actions
        Route::prefix('category')->group( function()    {
            //Route to create a new category
            Route::get('create', 'CategoriesController@create')->name('category.create');
            //Route to store a new category
            Route::post('store', 'CategoriesController@store')->name('category.store');
            //Route to edit an existing category
            Route::get('edit{id}', 'CategoriesController@edit')->name('category.edit');
            //Route to update an existing category
            Route::post('update{id}', 'CategoriesController@update')->name('category.update');
            //Route to delete an existing category
            Route::get('delete{id}', 'CategoriesController@destroy')->name('category.delete');
        });

        // Route to display an index of all tags
        Route::get('tags', 'TagsController@index')->name('tags');
        // All routes for the TagsController
        Route::prefix('tag')->group( function()  {
            // Route to the create tag 
            Route::get('create', 'TagsController@create')->name('tag.create');
            // Route to the store a new tag 
            Route::post('store', 'TagsController@store')->name('tag.store');
            //Route to edit an existing tags
            Route::get('edit{id}', 'TagsController@edit')->name('tag.edit');
            //Route to update an existing tags
            Route::post('update{id}', 'TagsController@update')->name('tag.update');
            //Route to delete an existing tag 
            Route::get('delete{id}', 'TagsController@destroy')->name('tag.delete');
        });  
});