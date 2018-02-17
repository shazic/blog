<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                        'tag'
    ];

    /**
     * Defines relationship with the posts table. A tag 'belongs to many' posts.
     * 
     * @return object a hasMany relationship object
     */
    public function posts() {
        return $this->belongsToMany('App\Post');
    }
}
