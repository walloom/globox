<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBodegaUserTable extends Migration {

    public function up() {
        Schema::create('bodega_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bodega_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

   
    public function down() {
        Schema::dropIfExists('bodega_user');
    }

}
