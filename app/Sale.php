<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sale';

    protected $attributes = [
        'discount' => 0
    ];

    protected $fillable = ['discount', 'payment_method'];

    public function articles()
    {
        return $this->hasMany('App\SaleArticles', 'id_sale', 'id');
    }
}
