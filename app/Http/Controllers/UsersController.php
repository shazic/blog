<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Http\Controllers\AlertsController as Alert;

class UsersController extends Controller
{

    /**
     * Constructor function for class.
     * 
     * @return void
     */
    public function __construct()   {
        
        // This class should only offer functionality to the admin users.

        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email'
        ]);

        $user = User::create([
            'name'  => $request->name,
            'email' => $request->email,
            'password'  => bcrypt('Password1$')
        ]);

        $profile = Profile::create([
            'user_id'   => $user->id,
            'avatar'    => 'uploads/avatars/default-avatar.jpg'
        ]);

        Alert::flashMessage($user, 'User created successfully');

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->back();
    }

    /**
     * Promote the specified user as admin.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admin($id)
    {
        $user = User::find($id);

        if (!$user)     {
            Alert::flashMessage(false,null, "User not found");
            return redirect()->back();    
        }

        $user->admin = 1;

        $user->save();

        Alert::flashMessage($user,"User successfully promoted as an admin");

        return redirect()->back();
    }

    /**
     * Demote the specified user from an admin to a regular user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function demote($id)
    {
        $user = User::find($id);

        if (!$user)     {
            Alert::flashMessage(false,null, "User not found");
            return redirect()->back();    
        }

        $user->admin = 0;

        $user->save();

        Alert::flashMessage($user,"User successfully demoted as a regular user");

        return redirect()->back();
    }
}
