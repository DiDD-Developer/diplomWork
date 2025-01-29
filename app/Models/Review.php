<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
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
     * Связь с пользователем
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Связь с туристическим местом
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    /**
     * Отношение к реакциям на отзыв
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reactions()
    {
        return $this->hasMany(ReviewReaction::class);
    }

    /**
     * Количество лайков отзыва
     * @return int
     */
    public function likesCount()
    {
        return $this->reactions()->where('is_like', true)->count();
    }

    /**
     * Количество дизлайков отзыва
     * @return int
     */
    public function dislikesCount()
    {
        return $this->reactions()->where('is_like', false)->count();
    }
}
