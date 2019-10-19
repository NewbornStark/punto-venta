<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    public $timestamps = false;

    protected $table = 'payment_method';

    protected $hidden = ['created_at', 'updated_at'];
}
