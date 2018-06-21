<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefault extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::table('frames', function (Blueprint $table) {
          $table->boolean('default')->default(false);

      });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::table('frames', function (Blueprint $table) {
          //
      });
  }
}
