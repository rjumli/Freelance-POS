<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->string('brand')->nullable();
            $table->decimal('price',12,2);
            $table->integer('stock')->default(0);
            $table->integer('reorder')->default(0);
            $table->longText('information');
            $table->boolean('is_visible')->default(0);
            $table->tinyInteger('price_id')->unsigned()->index();
            $table->foreign('price_id')->references('id')->on('dropdowns')->onDelete('cascade');
            $table->tinyInteger('unit_id')->unsigned()->nullable();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->tinyInteger('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
};
