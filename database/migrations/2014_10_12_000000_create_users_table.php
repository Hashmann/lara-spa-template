<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name')->nullable();
      $table->string('surname')->nullable();
      $table->string('patronymic')->nullable();
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->string('gender')->nullable();
      $table->string('birth_date')->nullable();
      $table->string('avatar')->nullable();
      $table->string('status')->nullable();
      $table->string('theme')->default('DARK')->nullable();
      $table->string('locale')->default('ru-RU')->nullable();
      $table->string('currency')->default('RUB')->nullable();
      $table->boolean('logout')->default(false);
      $table->string('ban')->default(false);
      $table->timestamp("last_activity_at")->useCurrent();
      $table->rememberToken();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('users');
  }
};
