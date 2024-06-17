<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFullNamePhoneNumberAndAddressToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name')->nullable()->after('id'); // Поле для фамилии
            $table->string('first_name')->nullable()->after('last_name'); // Поле для имени
            $table->string('middle_name')->nullable()->after('first_name'); // Поле для отчества
            $table->string('address')->nullable(); // Поле для адреса
            $table->string('phone_number')->unique()->nullable(); // Поле для номера телефона
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_name'); // Удаление поля для фамилии
            $table->dropColumn('first_name'); // Удаление поля для имени
            $table->dropColumn('middle_name'); // Удаление поля для отчества
            $table->dropColumn('address'); // Удаление поля для адреса
            $table->dropColumn('phone_number'); // Удаление поля для номера телефона
        });
    }
}
