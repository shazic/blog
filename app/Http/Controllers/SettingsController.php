<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Http\Controllers\AlertsController as Alert;

class SettingsController extends Controller
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
        $settings = Setting::first();

        return view('admin.settings.index')->with('settings', $settings);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        
        $this->validate( request(), [
            'site_name'         => 'required',
            'contact_number'    => 'required',
            'contact_email'     => 'required',
            'address'           => 'required'
        ]);

        $current_settings = Setting::first();

        if (request('site_name')        != $current_settings->site_name
            ||
            request('contact_number')   != $current_settings->contact_number
            ||
            request('contact_email')    != $current_settings->contact_email
            ||
            request('address')          != $current_settings->address
        )   {
            $current_settings->site_name        = request('site_name');
            $current_settings->contact_number   = request('contact_number');
            $current_settings->contact_email    = request('contact_email');
            $current_settings->address          = request('address');
            
            $result = $current_settings->save();

            Alert::flashMessage($result, "Settings successfully saved");

            return redirect()->back();
        }

        Alert::flashMessage(false, null, "No changes detected", "info");

        return redirect()->back();

        
    }

    
}
