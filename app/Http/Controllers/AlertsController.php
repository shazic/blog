<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class AlertsController extends Controller
{
    //

    /**
     * Set a session flash message. Sets 'success' if a successful call, else sets 'failure message.
     * 
     * @param boolean $event    - true or false
     * @param string  $success  - the message to be flashed if true
     * @param string  $failure  - the message to be flashed if false
     * @param string  $level    - level of failure: 'failed', 'info' or 'warning'
     * 
     */
    public static function flashMessage($event, $success, $failure='Oops, something went wrong!', $level='failed')   {
        
        if($event)  {

            Session::flash('success',$success);
        }
        else{
            Session::flash($level, $failure);
        }
    }
}
