<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'avatar', 'facebook', 'youtube', 'twitter', 'about'
    ];

    /**
     * Defines relationship with the users table. A Profile 'belongs to' only  one user.
     * 
     * @return object a belongsTo relationship object
     */
    public function user()  {
        return $this->belongsTo('App\User');
    }

    /**
     * Defines an accessor for the column 'avatar' on the Profile table
     * 
     * @return object an asset
     */
    public function getAvatarAttribute($avatar)  {
        return asset($avatar);
    }
}
