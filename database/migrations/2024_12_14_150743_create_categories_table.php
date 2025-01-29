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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Название категории')->unique();
            $table->timestamps();
        });
    }

    /**
     * Отмена миграции в обратном порядке
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
