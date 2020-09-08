<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('catalogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('customer_id')->constrained();
            $table->string('name');
            $table->string('ean')->nullable();
            $table->unsignedBigInteger('plu')->nullable();
            $table->unsignedBigInteger('presentation_id')->nullable();
            $table->unsignedBigInteger('color_id')->nullable();
            $table->unsignedBigInteger('size_id')->nullable();
            $table->string('dimension')->nullable();
            $table->unsignedBigInteger('reference_type_id')->nullable();
            $table->boolean('active')->default(true);
            //
            $table->unsignedBigInteger('catalog_category_id')->nullable();
            $table->unsignedBigInteger('catalog_class_id')->nullable();
            $table->unsignedBigInteger('catalog_type_id')->nullable();
            $table->string('standar')->nullable();
            $table->double('standard_cost')->nullable();
            $table->double('last_cost')->nullable();
            $table->double('average_cost')->nullable();
            $table->date('opening_date')->nullable();
            //
            $table->unsignedBigInteger('unit_one_id')->nullable();
            $table->integer('quantity_unit_one')->nullable();
            $table->unsignedBigInteger('unit_two_id')->nullable();
            $table->integer('quantity_unit_two')->nullable();
            $table->enum('priority', [1, 2, 3])->nullable();
            $table->double('weight')->nullable();
            $table->double('volume')->nullable();
            $table->integer('stock_min')->nullable();
            $table->integer('stock_max')->nullable();
           

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('catalogs');
    }

}
