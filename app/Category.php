<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Defines relationship with the posts table. A Category 'has many' posts.
     * 
     * @return object a hasMany relationship object
     */
    public function posts() {
        return $this->hasMany('App\Post');
    }
}
