<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Запуск миграции для создания таблицы reviews в БД
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained('users')->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Place::class)->constrained('places')->cascadeOnDelete();
            $table->text('text')->comment('Текст отзыва');
            $table->tinyInteger('rating')->unsigned()->comment('Оценка тур. места (от 1 до 5)');
            $table->timestamps();
        });
    }

    /**
     * Отмена миграции в обратном порядке
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
