<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('companies', function (Blueprint $table) {
      $table->id();
      
      $table->string('logo', 50)->nullable();
      $table->string('primary', 20)->nullable();
      $table->string('secondary', 20)->nullable();
      $table->string('primary_text', 20)->nullable();
      $table->string('secondary_text', 20)->nullable();

      $table->text('settings')->nullable();
      
      $table->string('name')->nullable();
      $table->string('sector')->nullable();
      $table->string('state', 50)->nullable();
      $table->string('city', 50)->nullable();
      $table->string('telephone', 100)->nullable();
      $table->string('responsibility', 100)->nullable();
      $table->text('notes')->nullable();

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
    Schema::dropIfExists('companies');
  }
}
