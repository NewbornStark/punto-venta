<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSaleArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sale_articles', function(Blueprint $table) {
            $table->unsignedBigInteger('id_sale')->after('id');
            $table->foreign('id_sale')->references('id')->on('sale');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sale_articles', function(Blueprint $table) {
            $table->dropColumn('id_sale');
        });
    }
}
