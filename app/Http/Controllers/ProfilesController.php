<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Http\Controllers\AlertsController as Alert;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        return view('admin.users.profile')->with( 'user', $user );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request)
    {
        $userInfoChanged = false;       // Checks if the user entered something that needs to be updated to the Users table
        $userProfileChanged = false;    // Checks if the user entered something that needs to be updated to the Profiles table

        // Validate user inputs

        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email'

        ]);

        // Get the current authenticated user
        $user = Auth::user();
        
        // Check if file exists. If yes, then concatenate with timestamp and save to disk.
        if( $request->hasFile('avatar') )   {
            
            $userProfileChanged = true;     // Profile needs update

            $avatar             = $request->avatar;
            $avatar_new_name    = time().$avatar->getClientOriginalName();
            $avatar->move('uploads/avatars', $avatar_new_name);

            $user->profile->avatar = 'uploads/avatars'.$avatar_new_name;
        }

        // Update user info, if user has changed it
        if  (   $user->name     != $request->name 
            ||  $user->email    != $request->email 
            ||  $request->has('password')
            ) 
        {
        
            $userInfoChanged = true;        // User table needs to be updated
        
            $user->name      = $request->name;
            $user->email     = $request->email;

            if( $request->has('password') )  {
                $user->password = bcrypt( $request->password );
            }
        }

        // Update profile info

        // Update profile info, if user has changed it
        if  (   $user->profile->facebook != $request->facebook 
            ||  $user->profile->youtube  != $request->youtube 
            ||  $user->profile->twitter  != $request->twitter 
            ||  $user->profile->about    != $request->about 
            ) 
        {
            $userProfileChanged = true;     // Profile needs update

            $user->profile->facebook = $request->facebook; 
            $user->profile->youtube  = $request->youtube; 
            $user->profile->twitter  = $request->twitter; 
            $user->profile->about    = $request->about; 
        }

        // Save the updates to the Users table if something has changed
        if ($userInfoChanged)   {
            
            $userSaved = $user->save();

            if ( !$userSaved ) {
                Alert::flashMessage(false,null,'Could not save changes', 'failed');
                return redirect()->back();
            }
        }

        // Save the updates to the Users table if something has changed
        if($userProfileChanged) {

            $profileSaved = $user->profile->save();

            if ( !$profileSaved ) {
                Alert::flashMessage(false,null,'Could not save changes', 'failed');
                return redirect()->back();
            }
        }
        

        if( !$userInfoChanged && !$userProfileChanged ) {
            Alert::flashMessage(false,null,'Nothing changed', 'info');
        }

        Alert::flashMessage(true, 'User Profile successfully updated');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
