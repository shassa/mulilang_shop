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
            $table->string('translation_lang');
            $table->string('name');
            $table->text('photo');
            $table->string("translation_of");
            $table->integer('price');
            $table->integer('is_slider')->default(0);
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('cascade');
            $table->string('sq_code');
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
