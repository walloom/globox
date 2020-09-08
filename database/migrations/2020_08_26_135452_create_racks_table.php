<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacksTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('racks', function (Blueprint $table) {

            $table->id();
            $table->foreignId('bodega_id')->constrained();
            $table->foreignId('section_id')->constrained();
            $table->string('name')->nullable();
            $table->string('alias')->nullable();
            $table->smallInteger('levels')->default(0);
            $table->smallInteger('modules')->default(0);
            $table->smallInteger('ubications')->default(0);
            $table->double('occupation', 8, 2)->default(0);
            $table->string('tons')->nullable();
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
        Schema::dropIfExists('racks');
    }

}
