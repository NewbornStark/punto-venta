<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_method')->insert([
            ['name' => 'Tarjeta de crédito'],
            ['name' => 'Tarjeta de débito'],
            ['name' => 'Efectivo'],
        ]);
    }
}
