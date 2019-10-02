<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $timestamps = false;

    protected $table = 'payment_method';
}
