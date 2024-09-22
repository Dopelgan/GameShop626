<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeProductsYearToDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('year');  // Удаление поля year
            $table->date('date')->nullable()->after('price'); // Поле для даты
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('date', function (Blueprint $table) {
            $table->dropColumn('date');  // Удаление поля year
            $table->unsignedInteger('year')->default('0');
        });
    }
}
