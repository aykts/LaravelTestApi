<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id');
            $table->string('name');
            $table->string('gtin_code');
            $table->tinyInteger('stock_unit')->default(0);
            $table->decimal('weight')->default(0);
            $table->tinyInteger('brand')->default(0);
            $table->tinyInteger('cargo_day')->default(-1);
            $table->tinyInteger('free_shipping')->default(0);
            $table->set('status', ['active', 'passive'])->default('passive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
