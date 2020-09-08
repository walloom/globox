<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBodegasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('bodegas', function (Blueprint $table) {

            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->string('photo', 50)->nullable();
            $table->string('name')->nullable();
            $table->double('occupation', 8, 2)->default(0);
            $table->string('address')->nullable();
            $table->foreignId('state_id')->constrained();
            $table->foreignId('city_id')->constrained();
            $table->string('telephone', 20)->nullable();
            $table->string('responsable', 100)->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('bodegas');
    }

}
