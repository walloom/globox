<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('profiles', function (Blueprint $table) {
      $table->id();

      $table->unsignedBigInteger('user_id')->nullable();

      $table->string('photo', 50)->nullable();

      $table->enum('document_type', ['nit', 'cedula', 'cedula-ext', 'tarjeta-iden', 'pasaporte', 'otro']);
      $table->string('document', 15)->unique()->nullable();
      $table->string('email', 100)->unique()->nullable();
      $table->string('name');
      $table->string('profesion')->nullable();
      $table->string('sector')->nullable();
      $table->string('state', 50);
      $table->string('city', 50);
      $table->string('telephone', 100)->nullable();
      $table->string('responsibility', 100)->nullable();
      $table->text('notes')->nullable();
      $table->foreign('user_id')->references('id')->on('users');

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
    Schema::dropIfExists('profiles');
  }
}
