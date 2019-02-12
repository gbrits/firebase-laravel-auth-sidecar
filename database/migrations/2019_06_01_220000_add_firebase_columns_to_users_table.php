<?php

/**
 * Adding some Firebase related fields to your existing Laravel implementation
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFirebaseColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->string('firebase_uid')->nullable();
          $table->string('name')->nullable();
          $table->string('photo_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ppe', function (Blueprint $table) {
            $table->dropColumn('firebase_uid');
            $table->dropColumn('name');
            $table->dropColumn('photo_url');
        });
    }
}
