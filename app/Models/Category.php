<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Защита поля 'id' в таблице users, чтобы предотвратить
     * случайное изменение идентификатора пользователя
     * при создании или обновлении модели.
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * Связь с моделью Place
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function places()
    {
        return $this->hasMany(Place::class);
    }
}
