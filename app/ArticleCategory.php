<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    public $timestamps = false;
    
    protected $table = 'article_categories';

    protected $fillable = ['id_article', 'id_category'];
}
