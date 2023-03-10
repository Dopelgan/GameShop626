<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelocateColumnAmount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('game_platforms', function (Blueprint $table) {
            $table->dropColumn('amount');
        });

        Schema::table('games', function (Blueprint $table) {
            $table->integer('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_platforms', function (Blueprint $table) {
            $table->integer('amount')->default('0');
        });

        Schema::table('games', function (Blueprint $table) {
            $table->dropColumn('amount');
        });
    }
}
