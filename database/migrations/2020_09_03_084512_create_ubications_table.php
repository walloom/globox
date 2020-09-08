<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUbicationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('ubications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rack_id')->constrained();
            $table->string('code');
            $table->string('x');
            $table->string('y');
            $table->string('z');
            $table->string('kg');
            $table->boolean('available')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('ubications');
    }

}
