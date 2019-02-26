<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'user_id', 'product_image', 'description','category_id'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function alternateimages()
    {
        return $this->hasMany('App\ProductsImage');
    }

    public function banners()
    {
        return $this->hasMany('App\Banner');
    }
    

    // public function size()
    // {
    //     return $this->belongsTo('App\Size');
    // }

    public function attributes()
    {
        return $this->hasMany('App\ProductsAttribute','product_id');
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function getUrlAttribute()
    {
        return route('questions.show', $this->slug);
    }

    // public function getProductImageAttribute($file)
    // {   
    //     return $this->uploads . $file;

    // }

}
