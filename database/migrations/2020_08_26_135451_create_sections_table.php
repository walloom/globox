<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sections', function (Blueprint $table) {

            $table->id();
            $table->foreignId('bodega_id')->constrained();
            $table->string('name')->nullable();
            $table->string('alias')->nullable();
            $table->string('x')->default(0);
            $table->string('y')->default(0);
            $table->string('w')->default(0);
            $table->string('h')->default(0);
            $table->enum('type', ['rack', 'separator', 'door']);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('sections');
    }

}
