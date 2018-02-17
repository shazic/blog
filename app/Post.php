<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'featured', 'category_id', 'content',
    ];

    /**
     * Dates
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];
    
    /**
     * Defines an accessor for the column 'featured' on the Posts table
     * 
     * @return object a belongsTo relationship object
     */
    public function getFeaturedAttribute($featured)  {
        return asset($featured);
    }

    /**
     * Defines relationship with the categories table. A Post 'belongs to' only  one category.
     * Notice the singular category as the function name, since it belongs to only one category.
     * 
     * @return object a belongsTo relationship object
     */
    public function category()  {
        return $this->belongsTo('App\Category');
    }

    /**
     * Defines relationship with the tags table. A Post 'belongs to many' tags.
     * 
     * @return object a belongsTo relationship object
     */
    public function tags()  {
        return $this->belongsToMany('App\Tag');
    }
}
