<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleArticles extends Model
{
    protected $table = 'sale_articles';

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = ['id_sale', 'name', 'description', 'sku', 'price', 'amount'];
}
