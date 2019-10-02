<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';

    protected $fillable = ['name', 'description', 'sku', 'price'];

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'article_categories', 'id_article', 'id_category');
    }
}
