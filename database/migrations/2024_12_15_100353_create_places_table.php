<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Запуск миграции для создания таблицы places в БД
     */
    public function up(): void
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Название тур. места');
            $table->string('image')->comment('Путь к фото тур. места');
            $table->text('short_description')->comment('Краткое описание тур. места для карточки');
            $table->text('description')->comment('Подробное описание тур. места');
            $table->string('address')->comment('Адрес тур. места');
            $table->foreignIdFor(\App\Models\Category::class)->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Отмена миграции в обратном порядке
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
