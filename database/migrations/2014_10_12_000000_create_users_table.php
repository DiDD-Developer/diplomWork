<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Запуск миграции для создания таблицы users в БД
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Имя пользователя');
            $table->string('surname')->comment('Фамилия пользователя');
            $table->string('patronymic')->nullable()->comment('Отчество пользователя (не обязательно указывать)');
            $table->string('avatar')->default('images/default-avatar.png')->comment('Аватар пользователя');
            $table->string('email')->unique()->comment('Эл. почта пользователя');
            $table->string('phone')->unique()->comment('Номер телефона пользователя');
            $table->string('login')->unique()->comment('Логин пользователя');
            $table->string('password')->comment('Пароль пользователя');
            $table->boolean('isAdmin')->default(false)->comment('Статус администратора (1 - Да, 0 - Нет)');
            $table->timestamps();
        });
    }

    /**
     * Отмена миграции в обратном порядке
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
